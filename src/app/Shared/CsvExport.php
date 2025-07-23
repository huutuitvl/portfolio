<?php

namespace App\Shared;

use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvExport
{
    const LIMIT_RECORD = 500;

    /**
     * Export data to CSV via StreamedResponse.
     *
     * @param Builder $builder
     * @param array $headerJp
     * @param array $headerEn
     * @param string $fileName
     * @param callable|null $handleFunction
     * @param int $chunkSize
     * @return StreamedResponse
     */
    public static function downloadCsv(
        Builder $builder,
        array $headerJp,
        array $headerEn,
        string $fileName,
        callable $handleFunction = null,
        int $chunkSize = self::LIMIT_RECORD
    ): StreamedResponse {
        return response()->streamDownload(function () use ($builder, $headerJp, $headerEn, $handleFunction, $chunkSize) {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                throw new \RuntimeException('Failed to open output stream');
            }

            // Write headers
            if (!empty($headerJp)) {
                fputcsv($handle, $headerJp);
            }

            if (!empty($headerEn)) {
                fputcsv($handle, $headerEn);
            }

            $builder->chunk($chunkSize, function ($list) use ($handle, $handleFunction) {
                foreach ($list as $item) {
                    $data = $item->toArray();
                    $row = $handleFunction ? call_user_func($handleFunction, $data) : $data;
                    fputcsv($handle, $row);
                }
            });

            fclose($handle);
        }, $fileName, ['Content-Type' => 'text/csv']);
    }

    /**
     * Generate CSV filename with current timestamp.
     *
     * @param string|null $fileName
     * @return string
     */
    public static function generateCsvFilename(string $fileName = 'export'): string
    {
        $timestamp = now()->format('Y-m-d_H-i-s'); // avoid ":" in filename
        return sprintf('%s_%s.csv', $fileName, $timestamp);
    }
}
