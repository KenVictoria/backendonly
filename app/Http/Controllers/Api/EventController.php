<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    public function index(): JsonResponse
    {
        $events = Event::query()->orderBy('event_date')->orderBy('title')->get();
        return response()->json($events);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'venue' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'in:BSIT,BSCS,GENERAL'],
            'event_type' => ['required', 'string', 'in:Gaming,Programming,Sports,Literature,Other'],
            'event_date' => ['required', 'date'],
        ]);

        $event = Event::query()->create($data);
        return response()->json($event, Response::HTTP_CREATED);
    }

    public function show($id): JsonResponse
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }
        return response()->json($event);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'venue' => ['sometimes', 'string', 'max:255'],
            'department' => ['sometimes', 'string', 'in:BSIT,BSCS,GENERAL'],
            'event_type' => ['sometimes', 'string', 'in:Gaming,Programming,Sports,Literature,Other'],
            'event_date' => ['sometimes', 'date'],
        ]);

        $event->update($data);
        return response()->json($event->fresh());
    }

    public function destroy($id): JsonResponse
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
