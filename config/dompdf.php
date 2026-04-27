<?php

return [
    /*
    |--------------------------------------------------------------------------
    | DomPDF Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may specify DomPDF configuration options.
    |
    */

    'orientation' => 'portrait',
    'defaults' => [
        'font' => 'sans-serif',
        'size' => 'A4',
    ],
    'font_cache' => storage_path('fonts'),
    'temp_dir' => storage_path('app/public/temp'),
    'log_output_file' => storage_path('logs/dompdf.log'),
    'options' => [
        'defaultFont' => 'sans-serif',
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => false,
        'isFontSubsettingEnabled' => true,
        'pdfBackend' => 'CPDF',
        'defaultPaperSize' => 'a4',
    ],
];
