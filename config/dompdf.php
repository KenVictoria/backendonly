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
    'font_cache' => sys_get_temp_dir() . '/dompdf_fonts',
    'temp_dir' => sys_get_temp_dir() . '/dompdf_temp',
    'log_output_file' => sys_get_temp_dir() . '/dompdf.log',
    'options' => [
        'defaultFont' => 'sans-serif',
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => false,
        'isFontSubsettingEnabled' => true,
        'pdfBackend' => 'CPDF',
        'defaultPaperSize' => 'a4',
    ],
];
