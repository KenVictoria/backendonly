<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function filterOptions(): JsonResponse
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request): JsonResponse
{
    $perPage = $request->integer('per_page', 15);
    $perPage = max(5, min(100, $perPage));
    
    $query = Student::query()
        ->filtered($request)
        ->orderBy('name');
    
    // Add affiliation filter
    if ($request->filled('affiliation')) {
        $affiliation = $request->affiliation;
        $query->whereJsonContains('affiliations', $affiliation);
    }
    
    // Add violations filter
    if ($request->filled('has_violations')) {
        if ($request->has_violations === 'yes') {
            $query->whereNotNull('violations')->where('violations', '!=', '');
        } elseif ($request->has_violations === 'no') {
            $query->whereNull('violations')->orWhere('violations', '');
        }
    }
    
    // Add year level filter (if you have this field)
    if ($request->filled('year_level')) {
        // Adjust based on your schema
        $query->where('year_level', $request->year_level);
    }
    
    $students = $query->paginate($perPage);
    
    return response()->json($students);
}

    public function store(Request $request): JsonResponse
    {
        $data = $this->validated($request);
        $data['department'] = $data['department'] ?? 'BSIT';
        $data['password'] = $data['password'] ?? 'password';

        $student = Student::query()->create($data);

        return response()->json($student, Response::HTTP_CREATED);
    }

    public function show($id): JsonResponse
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }
        return response()->json($student);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $data = $this->validated($request, $student->id);

        $student->update($data);

        return response()->json($student->fresh());
    }

    public function destroy($id): JsonResponse
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?int $studentId = null): array
    {
        $r = $studentId === null ? 'required' : 'sometimes';

        $uniqueEmail = 'unique:students,email';
        $uniqueSid = 'unique:students,student_id';

        if ($studentId !== null) {
            $uniqueEmail .= ','.$studentId;
            $uniqueSid .= ','.$studentId;
        }

        return $request->validate([
            'name' => [$r, 'string', 'max:255'],
            'email' => [$r, 'email', 'max:255', $uniqueEmail],
            'student_id' => [$r, 'string', 'max:64', $uniqueSid],
            'affiliations' => ['nullable', 'array'],
            'affiliations.*' => ['string', 'max:255'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['string', 'max:255'],
            'hobby' => ['nullable', 'string', 'max:255'],
            'grade_remarks' => ['nullable', 'string', 'max:255'],
            'violations' => ['nullable', 'string'],
            'department' => ['nullable', 'string', 'max:16'],
            'password' => ['sometimes', 'string', 'min:6'],
        ]);
    }
}
