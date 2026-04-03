<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use App\Models\Kelas;

class KelasImportService
{
    /**
     * Import uploaded file (CSV or XLSX) and return result array.
     * Returns ['success' => int, 'errors' => array]
     */
    public function importUploadedFile(UploadedFile $file): array
    {
        $ext = strtolower($file->getClientOriginalExtension());
        if (in_array($ext, ['csv','txt'])) {
            return $this->importCsv($file);
        }

        if (in_array($ext, ['xls','xlsx'])) {
            if (!class_exists('\\PhpOffice\\PhpSpreadsheet\\IOFactory')) {
                return ['success' => 0, 'errors' => [__('XLS/XLSX import requires the PhpSpreadsheet package. Please upload CSV or install phpoffice/phpspreadsheet.')]];
            }

            try {
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file->getRealPath());
                $spreadsheet = $reader->load($file->getRealPath());
                $sheet = $spreadsheet->getActiveSheet();
                // Use formatted values so dates and numbers come through as readable strings
                $rows = $sheet->toArray(null, true, true, false);

                // write to temp CSV
                $tmp = tmpfile();
                $meta = stream_get_meta_data($tmp);
                $tmpPath = $meta['uri'];
                $fh = fopen($tmpPath, 'w');
                foreach ($rows as $row) {
                    fputcsv($fh, $row);
                }
                fclose($fh);

                $uploaded = new UploadedFile($tmpPath, 'import.csv', null, null, true);
                $result = $this->importCsv($uploaded);
                @fclose($tmp);
                return $result;
            } catch (\Exception $e) {
                return ['success' => 0, 'errors' => [sprintf(__('Failed to parse Excel file: %s'), $e->getMessage())]];
            }
        }

        return ['success' => 0, 'errors' => [__('Unsupported file type. Please upload a CSV or XLSX file.')]];
    }

    /**
     * Parse CSV uploaded file and import rows.
     */
    public function importCsv(UploadedFile $file): array
    {
        $success = 0;
        $errors = [];

        $path = $file->getRealPath();
        if (!is_file($path) || !is_readable($path)) {
            return ['success' => 0, 'errors' => [__('Unable to read uploaded CSV file.')]];
        }

        if (($handle = fopen($path, 'r')) === false) {
            return ['success' => 0, 'errors' => [__('Unable to read uploaded CSV file.')]];
        }

        $rowNum = 0;
        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            $rowNum++;
            if ($rowNum === 1) {
                $first = strtolower(trim($row[0] ?? ''));
                if (in_array($first, ['id','nama kelas','name','kelas'])) {
                    continue; // Skip header
                }
            }

            $name = isset($row[0]) && trim($row[0]) !== '' ? trim($row[0]) : null;
            $description = isset($row[1]) && trim($row[1]) !== '' ? trim($row[1]) : null;

            if (!$name) {
                // If name is completely empty, it might be an empty trailing row
                if ($rowNum > 1 && empty(array_filter($row))) {
                    continue; 
                }
                $errors[] = "Baris {$rowNum}: Nama kelas wajib diisi.";
                continue;
            }

            $data = [
                'name' => $name,
                'description' => $description,
            ];

            $v = Validator::make($data, [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            if ($v->fails()) {
                $errors[] = "Baris {$rowNum}: " . implode('; ', $v->errors()->all());
                continue;
            }

            try {
                $k = Kelas::where('name', $name)->first();
                if ($k) {
                    $k->update(['description' => $description]);
                } else {
                    Kelas::create($data);
                }
                $success++;
            } catch (\Exception $e) {
                $errors[] = "Baris {$rowNum}: " . $e->getMessage();
            }
        }

        fclose($handle);

        return ['success' => $success, 'errors' => $errors];
    }
}
