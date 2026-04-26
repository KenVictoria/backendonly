<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            [
                'name' => 'Dr. Roberto Santos',
                'email' => 'roberto.santos@ccs.edu',
                'employee_id' => 'FAC001',
                'department' => 'BSIT',
            ],
            [
                'name' => 'Prof. Maria Reyes',
                'email' => 'maria.reyes@ccs.edu',
                'employee_id' => 'FAC002',
                'department' => 'BSCS',
            ],
            [
                'name' => 'Dr. John Martinez',
                'email' => 'john.martinez@ccs.edu',
                'employee_id' => 'FAC003',
                'department' => 'BSIT',
            ],
            [
                'name' => 'Prof. Christine Delfin',
                'email' => 'christine.delfin@ccs.edu',
                'employee_id' => 'FAC004',
                'department' => 'BSCS',
            ],
            [
                'name' => 'Dr. Antonio Cruz',
                'email' => 'antonio.cruz@ccs.edu',
                'employee_id' => 'FAC005',
                'department' => 'BSIT',
            ],
            [
                'name' => 'Prof. Lisa Flores',
                'email' => 'lisa.flores@ccs.edu',
                'employee_id' => 'FAC006',
                'department' => 'BSCS',
            ],
            [
                'name' => 'Dr. David Garcia',
                'email' => 'david.garcia@ccs.edu',
                'employee_id' => 'FAC007',
                'department' => 'BSIT',
            ],
            [
                'name' => 'Prof. Sarah Lopez',
                'email' => 'sarah.lopez@ccs.edu',
                'employee_id' => 'FAC008',
                'department' => 'BSCS',
            ],
            [
                'name' => 'Dr. Michael Torres',
                'email' => 'michael.torres@ccs.edu',
                'employee_id' => 'FAC009',
                'department' => 'BSIT',
            ],
            [
                'name' => 'Prof. Anna Mendoza',
                'email' => 'anna.mendoza@ccs.edu',
                'employee_id' => 'FAC010',
                'department' => 'BSCS',
            ],
        ];

        foreach ($faculties as $faculty) {
            Faculty::query()->updateOrCreate(
                ['email' => $faculty['email']],
                $faculty
            );
        }

        $this->command->info('Successfully seeded faculty members!');
    }
}
