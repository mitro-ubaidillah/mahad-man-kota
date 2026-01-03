<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Activity;
use App\Models\Santri;
use App\Models\Kelas;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $attendances = Attendance::with(['santri','activity'])->orderBy('created_at','desc')->paginate(20);
        $kelasList = Kelas::orderBy('name')->get();
        return view('attendances.index', compact('attendances','kelasList'));
    }

    public function export(Request $request)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $query = Attendance::with(['santri.kelas','activity'])
            ->orderBy('created_at');

        $query->whereDate('created_at', '>=', $data['start_date'])
              ->whereDate('created_at', '<=', $data['end_date']);

        if (!empty($data['kelas_id'])) {
            $query->whereHas('santri', function($q) use ($data) {
                $q->where('kelas_id', $data['kelas_id']);
            });
        }

        $attendances = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header row
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'Kelas');
        $sheet->setCellValue('D1', 'NIS');
        $sheet->setCellValue('E1', 'Nama Santri');
        $sheet->setCellValue('F1', 'Kegiatan');
        $sheet->setCellValue('G1', 'Status');
        $sheet->setCellValue('H1', 'Catatan');

        $row = 2;
        foreach ($attendances as $index => $attendance) {
            $sheet->setCellValue('A'.$row, $index + 1);
            $sheet->setCellValue('B'.$row, optional($attendance->created_at)->format('Y-m-d'));
            $sheet->setCellValue('C'.$row, optional(optional($attendance->santri)->kelas)->name);
            $sheet->setCellValue('D'.$row, optional($attendance->santri)->nis);
            $sheet->setCellValue('E'.$row, optional($attendance->santri)->name);
            $sheet->setCellValue('F'.$row, optional($attendance->activity)->title);
            $sheet->setCellValue('G'.$row, $attendance->status);
            $sheet->setCellValue('H'.$row, $attendance->note);
            $row++;
        }

        foreach (range('A','H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'rekap-absensi-'.$data['start_date'].'_sampai_'.$data['end_date'].'.xlsx';

        return response()->streamDownload(function() use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function create()
    {
        $activities = Activity::orderByRaw("COALESCE(start_date, activity_date) DESC")->get();
        $kelasList = Kelas::orderBy('name')->get();
        // For large datasets we don't load all santris here; the UI will fetch santris per kelas via AJAX.
        return view('attendances.create', compact('activities','kelasList'));
    }

    /**
     * Show bulk attendance form for a given kelas.
     */
    public function createForKelas(Kelas $kelas)
    {
        $santris = Santri::where('kelas_id', $kelas->id)->orderBy('name')->get();
        $activities = Activity::where('kelas_id', $kelas->id)->orderByRaw("COALESCE(start_date, activity_date) DESC")->get();
        return view('attendances.create_for_kelas', compact('kelas','santris','activities'));
    }

    /**
     * Store bulk attendance for a kelas.
     * Expects input: activity_id (nullable) or activity_title to create, date (optional), statuses[santri_id] => status
     */
    public function storeForKelas(Request $request, Kelas $kelas)
    {
        $data = $request->validate([
            'activity_id' => 'nullable|exists:activities,id',
            'activity_title' => 'nullable|string|max:255',
            'activity_date' => 'nullable|date',
            'statuses' => 'required|array',
            // allowed statuses: present (masuk), absent (tidak masuk tanpa keterangan), sick (sakit), izin (izin)
            'statuses.*' => 'in:present,absent,sick,izin',
            'notes' => 'nullable|array',
            'notes.*' => 'nullable|string|max:500',
        ]);

        // Determine activity
        if (!empty($data['activity_id'])) {
            $activity = Activity::find($data['activity_id']);
        } else {
            $title = $data['activity_title'] ?? ('Absensi ' . $kelas->name . ' ' . ($data['activity_date'] ?? now()->format('Y-m-d')));
            $activity = Activity::create([
                'title' => $title,
                'activity_date' => $data['activity_date'] ?? null,
                'kelas_id' => $kelas->id,
                'recurrence_type' => 'single',
            ]);
        }

        $created = 0;
        foreach ($data['statuses'] as $santriId => $status) {
            // ensure santri belongs to kelas
            $santri = Santri::where('id', $santriId)->where('kelas_id', $kelas->id)->first();
            if (! $santri) {
                continue;
            }

            $note = $data['notes'][$santriId] ?? null;

            // Upsert attendance: update existing record for same activity+santri or create new
            Attendance::updateOrCreate(
                ['activity_id' => $activity->id, 'santri_id' => $santri->id],
                ['status' => $status, 'note' => $note]
            );
            $created++;
        }

        return redirect()->route('attendances.index')->with('success', __('Created :count attendance records for :kelas', ['count' => $created, 'kelas' => $kelas->name]));
    }

    public function store(Request $request)
    {
        // Support both single attendance and bulk attendance via kelas
        if ($request->has('kelas_id') && $request->has('statuses')) {
            $data = $request->validate([
                'kelas_id' => 'required|exists:kelas,id',
                'activity_id' => 'nullable|exists:activities,id',
                'activity_title' => 'nullable|string|max:255',
                'activity_date' => 'nullable|date',
                'statuses' => 'required|array',
                'statuses.*' => 'in:present,absent,sick,izin',
                'notes' => 'nullable|array',
                'notes.*' => 'nullable|string|max:500',
            ]);

            $kelas = Kelas::find($data['kelas_id']);

            // Determine or create activity
            if (!empty($data['activity_id'])) {
                $activity = Activity::find($data['activity_id']);
            } else {
                $title = $data['activity_title'] ?? ('Absensi ' . $kelas->name . ' ' . ($data['activity_date'] ?? now()->format('Y-m-d')));
                $activity = Activity::create([
                    'title' => $title,
                    'activity_date' => $data['activity_date'] ?? null,
                    'kelas_id' => $kelas->id,
                    'recurrence_type' => 'single',
                ]);
            }

            $created = 0;
            foreach ($data['statuses'] as $santriId => $status) {
                $santri = Santri::where('id', $santriId)->where('kelas_id', $kelas->id)->first();
                if (! $santri) {
                    continue;
                }
                $note = $data['notes'][$santriId] ?? null;
                Attendance::updateOrCreate(
                    ['activity_id' => $activity->id, 'santri_id' => $santri->id],
                    ['status' => $status, 'note' => $note]
                );
                $created++;
            }

            return redirect()->route('attendances.index')->with('success', __('Updated :count attendance records for :kelas', ['count' => $created, 'kelas' => $kelas->name]));
        }

        // fallback: single attendance (status/note optional because single form no longer includes them)
        $data = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'santri_id' => 'required|exists:santris,id',
            'status' => 'nullable|in:present,absent,sick,izin,late',
            'note' => 'nullable|string',
        ]);

        // default to present if status not provided by the single form
        if (empty($data['status'])) {
            $data['status'] = 'present';
        }

        Attendance::create($data);
        return redirect()->route('attendances.index')->with('success', __('Attendance created'));
    }

    /**
     * Return JSON list of santri for a kelas (used by AJAX in attendance create page)
     */
    public function santrisForKelas(Kelas $kelas)
    {
        $santris = Santri::where('kelas_id', $kelas->id)->orderBy('name')->get(['id','name','nis']);
        return response()->json($santris);
    }

    public function edit(Attendance $attendance)
    {
        $activities = Activity::orderByRaw("COALESCE(start_date, activity_date) DESC")->get();
        $santris = Santri::orderBy('name')->get();
        return view('attendances.edit', compact('attendance','activities','santris'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'santri_id' => 'required|exists:santris,id',
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $attendance->update($data);
        return redirect()->route('attendances.index')->with('success', __('Attendance updated'));
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', __('Attendance deleted'));
    }
}
