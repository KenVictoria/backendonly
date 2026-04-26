<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Computer Lab 1',
                'building' => 'IT Building',
                'floor' => '2nd Floor',
                'capacity' => 40,
                'type' => 'Laboratory',
                'equipment' => json_encode(['Desktop Computers', 'Projector', 'Whiteboard', 'Air Conditioning']),
            ],
            [
                'name' => 'Computer Lab 2',
                'building' => 'IT Building',
                'floor' => '3rd Floor',
                'capacity' => 35,
                'type' => 'Laboratory',
                'equipment' => json_encode(['Desktop Computers', 'Projector', 'Whiteboard', 'Air Conditioning']),
            ],
            [
                'name' => 'Lecture Hall A',
                'building' => 'Main Building',
                'floor' => '1st Floor',
                'capacity' => 100,
                'type' => 'Lecture Hall',
                'equipment' => json_encode(['Projector', 'Microphone', 'Sound System', 'Whiteboard']),
            ],
            [
                'name' => 'Lecture Hall B',
                'building' => 'Main Building',
                'floor' => '2nd Floor',
                'capacity' => 80,
                'type' => 'Lecture Hall',
                'equipment' => json_encode(['Projector', 'Microphone', 'Sound System', 'Whiteboard']),
            ],
            [
                'name' => 'Classroom 101',
                'building' => 'Academic Building',
                'floor' => '1st Floor',
                'capacity' => 30,
                'type' => 'Classroom',
                'equipment' => json_encode(['Projector', 'Whiteboard', 'Air Conditioning']),
            ],
            [
                'name' => 'Classroom 102',
                'building' => 'Academic Building',
                'floor' => '1st Floor',
                'capacity' => 30,
                'type' => 'Classroom',
                'equipment' => json_encode(['Projector', 'Whiteboard', 'Air Conditioning']),
            ],
            [
                'name' => 'Classroom 201',
                'building' => 'Academic Building',
                'floor' => '2nd Floor',
                'capacity' => 25,
                'type' => 'Classroom',
                'equipment' => json_encode(['Projector', 'Whiteboard']),
            ],
            [
                'name' => 'Classroom 202',
                'building' => 'Academic Building',
                'floor' => '2nd Floor',
                'capacity' => 25,
                'type' => 'Classroom',
                'equipment' => json_encode(['Projector', 'Whiteboard']),
            ],
            [
                'name' => 'Conference Room',
                'building' => 'Admin Building',
                'floor' => '3rd Floor',
                'capacity' => 20,
                'type' => 'Conference Room',
                'equipment' => json_encode(['Projector', 'Video Conferencing', 'Whiteboard']),
            ],
            [
                'name' => 'Library Study Room',
                'building' => 'Library',
                'floor' => '2nd Floor',
                'capacity' => 15,
                'type' => 'Study Room',
                'equipment' => json_encode(['Whiteboard', 'Study Tables']),
            ],
        ];

        foreach ($rooms as $room) {
            Room::query()->updateOrCreate(
                ['name' => $room['name']],
                $room
            );
        }

        $this->command->info('Successfully seeded rooms!');
    }
}
