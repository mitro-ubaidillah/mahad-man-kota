<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Services\KelasImportService;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']);
    }

    public function index()
    {
        $kelas = Kelas::orderBy('name')->paginate(20);
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Kelas::create($data);
        return redirect()->route('kelas.index')->with('success', __('Kelas created'));
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $kelas->update($data);
        return redirect()->route('kelas.index')->with('success', __('Kelas updated'));
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', __('Kelas deleted'));
    }

    public function import(Request $request, KelasImportService $importService)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xls,xlsx|max:10240', // max 10MB
        ]);

        $result = $importService->importUploadedFile($request->file('file'));

        $success = $result['success'] ?? 0;
        $errors = $result['errors'] ?? [];

        $message = __('Imported :count rows', ['count' => $success]);
        if (count($errors)) {
            $message .= ' ' . __('with :count errors', ['count' => count($errors)]);
            session()->flash('error', implode(' | ', array_slice($errors, 0, 10)));
        }
        session()->flash('success', $message);

        return redirect()->route('kelas.index');
    }

    public function downloadTemplate()
    {
        $filename = 'template_import_kelas.xlsx';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header row matching expected columns
        $sheet->setCellValue('A1', 'Nama Kelas');
        $sheet->setCellValue('B1', 'Deskripsi (Opsional)');

        // Example row
        $sheet->setCellValue('A2', 'Kelas 10 IPA 1');
        $sheet->setCellValue('B2', 'Kelas unggulan MIPA');

        $sheet->setCellValue('A3', 'Kelas 10 IPS 2');
        $sheet->setCellValue('B3', '');

        // Auto-size columns
        foreach (range('A', 'B') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
