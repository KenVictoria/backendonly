<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FacultyController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Faculty::query()->orderBy('name')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:faculties,email'],
            'employee_id' => ['required', 'string', 'max:64', 'unique:faculties,employee_id'],
            'department' => ['required', 'string', 'in:BSIT,BSCS'],
        ]);

        $faculty = Faculty::query()->create($data);

        return response()->json($faculty, Response::HTTP_CREATED);
    }

    public function show(Faculty $faculty): JsonResponse
    {
        return response()->json($faculty);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            // Debug: Log faculty ID and request data
            \Log::info('Updating faculty', ['faculty_id' => $id, 'request_data' => $request->all()]);
            
            // Find faculty manually to avoid route model binding issues
            $faculty = Faculty::find($id);
            
            if (!$faculty) {
                \Log::error('Faculty not found', ['faculty_id' => $id]);
                return response()->json(['error' => 'Faculty not found'], 404);
            }
            
            $data = $request->validate([
                'name' => ['sometimes', 'string', 'max:255'],
                'email' => ['sometimes', 'email', 'max:255', 'unique:faculties,email,'.$faculty->id],
                'employee_id' => ['sometimes', 'string', 'max:64', 'unique:faculties,employee_id,'.$faculty->id],
                'department' => ['sometimes', 'string', 'in:BSIT,BSCS'],
            ]);

            $faculty->update($data);

            \Log::info('Faculty updated successfully', ['faculty_id' => $faculty->id]);
            return response()->json($faculty->fresh());
            
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Database error updating faculty', [
                'faculty_id' => $faculty->id,
                'error' => $e->getMessage(),
                'sql' => $e->getSql()
            ]);
            return response()->json([
                'error' => 'Database constraint error',
                'message' => 'This faculty cannot be updated due to existing schedules or other constraints'
            ], 422);
        } catch (\Exception $e) {
            \Log::error('General error updating faculty', [
                'faculty_id' => $faculty->id,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'error' => 'Update failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            \Log::info('Deleting faculty', ['faculty_id' => $id]);
            
            // Find faculty manually to avoid route model binding issues
            $faculty = Faculty::find($id);
            
            if (!$faculty) {
                \Log::error('Faculty not found', ['faculty_id' => $id]);
                return response('', 404);
            }
            
            // Check if faculty has related schedules
            $scheduleCount = $faculty->schedules()->count();
            if ($scheduleCount > 0) {
                \Log::error('Cannot delete faculty with existing schedules', [
                    'faculty_id' => $faculty->id,
                    'schedule_count' => $scheduleCount
                ]);
                return response('', 422);
            }

            $faculty->delete();
            \Log::info('Faculty deleted successfully', ['faculty_id' => $faculty->id]);
            
            return response()->noContent();
            
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Database error deleting faculty', [
                'faculty_id' => $id,
                'error' => $e->getMessage()
            ]);
            return response('', 422);
        } catch (\Exception $e) {
            \Log::error('General error deleting faculty', [
                'faculty_id' => $id,
                'error' => $e->getMessage()
            ]);
            return response('', 500);
        }
    }
}
