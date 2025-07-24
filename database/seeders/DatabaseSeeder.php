<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Major;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // Grade::factory(4)->create();

        $majors = [
            'PPLG' => 2,
            'Animasi 3D' => 3,
            'Animasi 2D' => 2,
            'DKV DG' => 3,
            'DKV TG' => 2
        ];

        $majorDescs = [
            'PPLG' => 'Programming, Computer Knowledge, Software Development, Web Development, dll',
            'Animasi 3D' => 'Modelling, Texturing, Rigging, Animation, dll',
            'Animasi 2D' => 'Pembuatan Komik, Storywriting & Storyboarding, Animasi 2D, 2D Compositing, dll',
            'DKV DG' => 'Desain Grafis, UI/UX, Fotografi, Desain Kemasan Barang, dll',
            'DKV TG' => 'Offset Printing, Digital Printing, Screen Printing, Packaging, dll'
        ];

        $grades = [10, 11, 12];

        foreach ($majors as $major => $classCount) {
            $majorModel = Major::create(['nama' => $major, 'desc' => $majorDescs[$major]]);

            foreach ($grades as $grade) {
                for ($classNumber = 1; $classNumber <= $classCount; $classNumber++) {
                    if (!Grade::where('class_number', $classNumber)
                        ->where('grade', $grade)
                        ->where('major_id', $majorModel->id)->exists()) {

                        Grade::factory()->create([
                            'grade' => $grade,
                            'class_number' => $classNumber,
                            'major_id' => $majorModel->id
                        ]);
                    }
                }
            }
        }

        Student::factory(100)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
