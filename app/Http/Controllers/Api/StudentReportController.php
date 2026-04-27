<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentReportController extends Controller
{
    public function meta(): JsonResponse
    {
        $skills = Student::query()
            ->whereNotNull('skills')
            ->pluck('skills')
            ->flatten()
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $remarks = Student::query()
            ->whereNotNull('grade_remarks')
            ->where('grade_remarks', '!=', '')
            ->distinct()
            ->orderBy('grade_remarks')
            ->pluck('grade_remarks')
            ->values();

        $departments = Student::query()
            ->distinct()
            ->orderBy('department')
            ->pluck('department')
            ->values();

        return response()->json([
            'skills' => $skills,
            'grade_remarks' => $remarks,
            'departments' => $departments,
        ]);
    }

    public function pdf(Request $request): Response
    {
        try {
            \Log::info('PDF export request', ['params' => $request->all()]);
            
            $students = Student::query()
                ->filtered($request)
                ->orderBy('name')
                ->get();

            \Log::info('Students retrieved for PDF', ['count' => $students->count()]);

            $pdf = Pdf::loadView('reports.students_pdf', [
                'students' => $students,
                'generatedAt' => now()->toDateTimeString(),
            ])->setPaper('a4', 'landscape')
             ->setOptions([
                 'defaultFont' => 'sans-serif',
                 'isHtml5ParserEnabled' => true,
                 'isRemoteEnabled' => false,
                 'isFontSubsettingEnabled' => true,
                 'pdfBackend' => 'CPDF',
                 'tempDir' => sys_get_temp_dir(),
             ]);

            $filename = 'ccs-student-report-'.now()->format('Y-m-d_His').'.pdf';

            \Log::info('PDF generated successfully', ['filename' => $filename]);

            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('PDF generation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_params' => $request->all()
            ]);
            
            return response()->json([
                'error' => 'PDF generation failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
