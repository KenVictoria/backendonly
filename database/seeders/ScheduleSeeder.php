<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Room;
use App\Models\Section;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing data
        $courses = Course::all();
        $faculties = Faculty::all();
        $rooms = Room::all();
        $sections = Section::all();

        if ($courses->isEmpty() || $faculties->isEmpty() || $rooms->isEmpty()) {
            $this->command->error('Cannot seed schedules: missing courses, faculties, or rooms');
            return;
        }

        $schedules = [
            // Monday schedules
            [
                'course_id' => $courses->where('code', 'CCS101')->first()->id ?? 1,
                'faculty_id' => $faculties->where('email', 'roberto.santos@ccs.edu')->first()->id ?? 1,
                'room_id' => $rooms->where('name', 'Computer Lab 1')->first()->id ?? 1,
                'section_id' => $sections->first()?->id,
                'day_of_week' => 'Monday',
                'start_time' => '08:00',
                'end_time' => '10:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],
            [
                'course_id' => $courses->where('code', 'CCS102')->first()->id ?? 2,
                'faculty_id' => $faculties->where('email', 'maria.reyes@ccs.edu')->first()->id ?? 2,
                'room_id' => $rooms->where('name', 'Computer Lab 2')->first()->id ?? 2,
                'section_id' => $sections->skip(1)->first()?->id,
                'day_of_week' => 'Monday',
                'start_time' => '10:30',
                'end_time' => '12:30',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],
            [
                'course_id' => $courses->where('code', 'CCS103')->first()->id ?? 3,
                'faculty_id' => $faculties->where('email', 'john.martinez@ccs.edu')->first()->id ?? 3,
                'room_id' => $rooms->where('name', 'Lecture Hall A')->first()->id ?? 3,
                'section_id' => $sections->skip(2)->first()?->id,
                'day_of_week' => 'Monday',
                'start_time' => '13:00',
                'end_time' => '15:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],

            // Tuesday schedules
            [
                'course_id' => $courses->where('code', 'CCS104')->first()->id ?? 4,
                'faculty_id' => $faculties->where('email', 'christine.delfin@ccs.edu')->first()->id ?? 4,
                'room_id' => $rooms->where('name', 'Classroom 101')->first()->id ?? 5,
                'section_id' => $sections->skip(3)->first()?->id,
                'day_of_week' => 'Tuesday',
                'start_time' => '08:00',
                'end_time' => '10:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],
            [
                'course_id' => $courses->where('code', 'MATH101')->first()->id ?? 5,
                'faculty_id' => $faculties->where('email', 'antonio.cruz@ccs.edu')->first()->id ?? 5,
                'room_id' => $rooms->where('name', 'Lecture Hall B')->first()->id ?? 4,
                'section_id' => $sections->skip(4)->first()?->id,
                'day_of_week' => 'Tuesday',
                'start_time' => '10:30',
                'end_time' => '12:30',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],
            [
                'course_id' => $courses->where('code', 'COMM101')->first()->id ?? 6,
                'faculty_id' => $faculties->where('email', 'lisa.flores@ccs.edu')->first()->id ?? 6,
                'room_id' => $rooms->where('name', 'Classroom 102')->first()->id ?? 6,
                'section_id' => $sections->skip(5)->first()?->id,
                'day_of_week' => 'Tuesday',
                'start_time' => '14:00',
                'end_time' => '16:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],

            // Wednesday schedules
            [
                'course_id' => $courses->where('code', 'CCS105')->first()->id ?? 7,
                'faculty_id' => $faculties->where('email', 'david.garcia@ccs.edu')->first()->id ?? 7,
                'room_id' => $rooms->where('name', 'Computer Lab 1')->first()->id ?? 1,
                'section_id' => $sections->skip(6)->first()?->id,
                'day_of_week' => 'Wednesday',
                'start_time' => '09:00',
                'end_time' => '11:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],
            [
                'course_id' => $courses->where('code', 'CCS106')->first()->id ?? 8,
                'faculty_id' => $faculties->where('email', 'sarah.lopez@ccs.edu')->first()->id ?? 8,
                'room_id' => $rooms->where('name', 'Classroom 201')->first()->id ?? 7,
                'section_id' => $sections->skip(7)->first()?->id,
                'day_of_week' => 'Wednesday',
                'start_time' => '11:30',
                'end_time' => '13:30',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],

            // Thursday schedules
            [
                'course_id' => $courses->where('code', 'CCS107')->first()->id ?? 9,
                'faculty_id' => $faculties->where('email', 'roberto.santos@ccs.edu')->first()->id ?? 1,
                'room_id' => $rooms->where('name', 'Computer Lab 2')->first()->id ?? 2,
                'section_id' => $sections->skip(8)->first()?->id,
                'day_of_week' => 'Thursday',
                'start_time' => '08:00',
                'end_time' => '10:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],
            [
                'course_id' => $courses->where('code', 'CCS108')->first()->id ?? 10,
                'faculty_id' => $faculties->where('email', 'maria.reyes@ccs.edu')->first()->id ?? 2,
                'room_id' => $rooms->where('name', 'Conference Room')->first()->id ?? 9,
                'section_id' => $sections->skip(9)->first()?->id,
                'day_of_week' => 'Thursday',
                'start_time' => '13:00',
                'end_time' => '15:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],

            // Friday schedules
            [
                'course_id' => $courses->where('code', 'NSTP1')->first()->id ?? 11,
                'faculty_id' => $faculties->where('email', 'john.martinez@ccs.edu')->first()->id ?? 3,
                'room_id' => $rooms->where('name', 'Lecture Hall A')->first()->id ?? 3,
                'section_id' => $sections->skip(10)->first()?->id,
                'day_of_week' => 'Friday',
                'start_time' => '08:00',
                'end_time' => '11:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],
            [
                'course_id' => $courses->where('code', 'PE101')->first()->id ?? 12,
                'faculty_id' => $faculties->where('email', 'christine.delfin@ccs.edu')->first()->id ?? 4,
                'room_id' => $rooms->where('name', 'Classroom 101')->first()->id ?? 5,
                'section_id' => $sections->skip(11)->first()?->id,
                'day_of_week' => 'Friday',
                'start_time' => '14:00',
                'end_time' => '16:00',
                'semester' => '1st',
                'school_year' => 2024,
                'status' => 'scheduled',
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::query()->updateOrCreate(
                [
                    'course_id' => $schedule['course_id'],
                    'faculty_id' => $schedule['faculty_id'],
                    'room_id' => $schedule['room_id'],
                    'day_of_week' => $schedule['day_of_week'],
                    'start_time' => $schedule['start_time'],
                ],
                $schedule
            );
        }

        $this->command->info('Successfully seeded schedules!');
    }
}
