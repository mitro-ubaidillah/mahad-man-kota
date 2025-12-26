<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SantriController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $perPage = request()->input('per_page', 20);
        $perPage = is_numeric($perPage) ? (int) $perPage : 20;
        $perPage = max(1, min(100, $perPage));

        $santris = Santri::orderBy('id', 'desc')->paginate($perPage)->withQueryString();
        return view('santris.index', compact('santris', 'perPage'));
    }

    public function create()
    {
        return view('santris.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => 'nullable|string|unique:santris,nis',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:santris,email',
            'phone' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
        ]);

        try {
            Santri::create($data);
            return redirect()->route('santris.index')->with('success', __('Santri created'));
        } catch (\Exception $e) {
            // log the exception and redirect back with an error flash
            logger()->error('Santri store failed: '.$e->getMessage());
            return back()->withInput()->with('error', __('Failed to create Santri. Please try again.'));
        }
    }

    public function edit(Santri $santri)
    {
    return view('santris.edit', compact('santri'));
    }

    public function update(Request $request, Santri $santri)
    {
        $data = $request->validate([
            'nis' => 'nullable|string|unique:santris,nis,' . $santri->id,
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:santris,email,' . $santri->id,
            'phone' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
        ]);

        try {
            $santri->update($data);
            return redirect()->route('santris.index')->with('success', __('Santri updated'));
        } catch (\Exception $e) {
            logger()->error('Santri update failed: '.$e->getMessage());
            return back()->withInput()->with('error', __('Failed to update Santri. Please try again.'));
        }
    }

    public function destroy(Santri $santri)
    {
        try {
            $santri->delete();
            return redirect()->route('santris.index')->with('success', __('Santri deleted'));
        } catch (\Exception $e) {
            logger()->error('Santri delete failed: '.$e->getMessage());
            return back()->with('error', __('Failed to delete Santri.'));
        }
    }

    /**
     * Download a CSV template for importing santri.
     */
    public function downloadTemplate()
    {
        @mkdir(public_path('templates'), 0755, true);

        // Prefer generating an XLSX template if PhpSpreadsheet is installed
        if (class_exists('\PhpOffice\PhpSpreadsheet\Spreadsheet')) {
            $xlsxPath = public_path('templates/santri_template.xlsx');
            try {
                $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $headers = ['nis','name','email','phone','kelas','birth_date'];
                $sheet->fromArray($headers, null, 'A1');
                // sample row
                $sheet->fromArray(['', 'Sample Name', 'example@example.com', '08123456789', '10A', '2008-01-01'], null, 'A2');

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save($xlsxPath);

                return response()->download($xlsxPath, 'santri_template.xlsx', [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ]);
            } catch (\Exception $e) {
                // fallback to CSV on any failure
                logger()->warning('Failed to generate XLSX template: '.$e->getMessage());
            }
        }

        // Fallback: generate CSV template
        $csvPath = public_path('templates/santri_template.csv');
        $headers = ['nis','name','email','phone','kelas','birth_date'];
        $content = implode(',', $headers) . "\n" . ",Sample Name,example@example.com,08123456789,10A,2008-01-01\n";
        file_put_contents($csvPath, $content);

        return response()->download($csvPath, 'santri_template.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    /**
     * Import santri from uploaded CSV/XLSX file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());

        $success = 0;
        $errors = [];

        if ($ext === 'csv' || $ext === 'txt') {
            $path = $file->getRealPath();
            if (($handle = fopen($path, 'r')) !== false) {
                $rowNum = 0;
                while (($row = fgetcsv($handle, 0, ',')) !== false) {
                    $rowNum++;
                    // skip header row if it looks like header
                    if ($rowNum === 1) {
                        $first = strtolower(trim($row[0] ?? ''));
                        if (in_array($first, ['nis','id','nama','name'])) {
                            continue;
                        }
                    }

                    // map columns: nis,name,email,phone,kelas,birth_date
                    $data = [
                        'nis' => $row[0] ?? null,
                        'name' => $row[1] ?? null,
                        'email' => $row[2] ?? null,
                        'phone' => $row[3] ?? null,
                        'kelas' => $row[4] ?? null,
                        'birth_date' => $row[5] ?? null,
                    ];

                    $v = Validator::make($data, [
                        'nis' => 'nullable|string|unique:santris,nis',
                        'name' => 'required|string|max:255',
                        'email' => 'nullable|email|unique:santris,email',
                        'phone' => 'nullable|string|max:50',
                        'kelas' => 'nullable|string|max:50',
                        'birth_date' => 'nullable|date',
                    ]);

                    if ($v->fails()) {
                        $errors[] = "Row {$rowNum}: " . implode('; ', $v->errors()->all());
                        continue;
                    }

                    try {
                        Santri::create($data);
                        $success++;
                    } catch (\Exception $e) {
                        $errors[] = "Row {$rowNum}: " . $e->getMessage();
                    }
                }
                fclose($handle);
            } else {
                return back()->with('error', __('Unable to read uploaded CSV file.'));
            }
        } elseif (in_array($ext, ['xls','xlsx'])) {
            // Try to use PhpSpreadsheet if available
            if (class_exists('\PhpOffice\PhpSpreadsheet\IOFactory')) {
                try {
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file->getRealPath());
                    $spreadsheet = $reader->load($file->getRealPath());
                    $sheet = $spreadsheet->getActiveSheet();
                    $rows = $sheet->toArray();
                    $rowNum = 0;
                    foreach ($rows as $row) {
                        $rowNum++;
                        if ($rowNum === 1) {
                            $first = strtolower(trim($row[0] ?? ''));
                            if (in_array($first, ['nis','id','nama','name'])) {
                                continue;
                            }
                        }

                        $data = [
                            'nis' => $row[0] ?? null,
                            'name' => $row[1] ?? null,
                            'email' => $row[2] ?? null,
                            'phone' => $row[3] ?? null,
                            'kelas' => $row[4] ?? null,
                            'birth_date' => $row[5] ?? null,
                        ];

                        $v = Validator::make($data, [
                            'nis' => 'nullable|string|unique:santris,nis',
                            'name' => 'required|string|max:255',
                            'email' => 'nullable|email|unique:santris,email',
                            'phone' => 'nullable|string|max:50',
                            'kelas' => 'nullable|string|max:50',
                            'birth_date' => 'nullable|date',
                        ]);

                        if ($v->fails()) {
                            $errors[] = "Row {$rowNum}: " . implode('; ', $v->errors()->all());
                            continue;
                        }

                        try {
                            Santri::create($data);
                            $success++;
                        } catch (\Exception $e) {
                            $errors[] = "Row {$rowNum}: " . $e->getMessage();
                        }
                    }
                } catch (\Exception $e) {
                    return back()->with('error', sprintf(__('Failed to parse Excel file: %s'), $e->getMessage()));
                }
            } else {
                return back()->with('error', __('XLS/XLSX import requires the PhpSpreadsheet package. Please upload CSV or install phpoffice/phpspreadsheet.'));
            }
        } else {
            return back()->with('error', __('Unsupported file type. Please upload a CSV or XLSX file.'));
        }

        $message = __('Imported :count rows', ['count' => $success]);
        if (count($errors)) {
            $message .= ' ' . __('with :count errors', ['count' => count($errors)]);
            // keep first 10 errors in the session
            $short = array_slice($errors, 0, 10);
            session()->flash('error', implode(' | ', $short));
        }
        session()->flash('success', $message);

        return redirect()->route('santris.index');
    }
}
