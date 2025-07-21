<?php

namespace App\Shared;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CsvImport
{
    /**
     * Import CSV data and return results.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param array $rules Validation rules for each row
     * @param callable $createFunction Function to handle batch creation
     * @param int $batchSize Number of records to process in a single batch
     * @return array
     */
    public static function importCsv($file, array $rules, callable $createFunction, int $batchSize = 100): array
    {
        $successCount = 0;
        $errorCount = 0;
        $errors = [];

        // Read CSV into array
        $data = array_map('str_getcsv', file($file->getRealPath()));

        if (empty($data) || count($data) < 2) {
            return [
                'success_count' => 0,
                'error_count' => 0,
                'errors' => ['File is empty or missing data.'],
                'error_log_path' => null,
            ];
        }

        $headers = array_map('trim', $data[0]);

        // Check if all required headers exist
        $missing = array_diff(array_keys($rules), $headers);
        if (!empty($missing)) {
            return [
                'success_count' => 0,
                'error_count' => 0,
                'errors' => ['Missing required headers: ' . implode(', ', $missing)],
                'error_log_path' => null,
            ];
        }

        // Prepare log file
        $errorLogFile = 'cms/import_errors_' . now()->format('Ymd_His') . '_' . Str::random(6) . '.log';
        $logPath = storage_path('app/' . $errorLogFile);
        $logHandle = fopen($logPath, 'w');

        $batch = [];
        $rowNumber = 2;

        foreach (array_slice($data, 1) as $row) {
            $rowData = array_combine($headers, $row);

            // Validate each row based on provided rules
            $validator = Validator::make($rowData, $rules);

            if ($validator->fails()) {
                $errorMsg = "Row $rowNumber: " . implode(', ', $validator->errors()->all());
                fwrite($logHandle, $errorMsg . PHP_EOL);
                Log::channel('import')->error($errorMsg);
                $errors[] = $errorMsg;
                $errorCount++;
                $rowNumber++;

                continue;
            }

            $batch[] = $rowData;

            // Batch insert
            if (count($batch) === $batchSize) {
                try {
                    call_user_func($createFunction, $batch);
                    $successCount += count($batch);
                } catch (\Throwable $e) {
                    foreach ($batch as $item) {
                        $errorMsg = "Row $rowNumber: Exception - " . $e->getMessage();
                        fwrite($logHandle, $errorMsg . PHP_EOL);
                        Log::channel('import')->error($errorMsg);
                        $errors[] = $errorMsg;
                        $errorCount++;
                        $rowNumber++;
                    }
                }
                $batch = [];
            }

            $rowNumber++;
        }

        // Insert remaining
        if (!empty($batch)) {
            try {
                call_user_func($createFunction, $batch);
                $successCount += count($batch);
            } catch (\Throwable $e) {
                foreach ($batch as $item) {
                    $errorMsg = "Row $rowNumber: Exception - " . $e->getMessage();
                    fwrite($logHandle, $errorMsg . PHP_EOL);
                    Log::channel('import')->error($errorMsg);
                    $errors[] = $errorMsg;
                    $errorCount++;
                    $rowNumber++;
                }
            }
        }

        fclose($logHandle);

        return [
            'success_count' => $successCount,
            'error_count' => $errorCount,
            'errors' => $errors,
            'error_log_path' => $errorCount > 0
                ? asset('storage/' . str_replace('app/', '', $logPath))
                : null,
        ];
    }
}
