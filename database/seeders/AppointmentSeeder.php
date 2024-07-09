<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->delete();
        $appointments = [
            ['name'=>'الأحد'],
            ['name'=>'الاثنين'],
            ['name'=>'الثلاثاء'],
            ['name'=>'الأربعاء'],
            ['name'=>'الخميس'],
            ['name'=>'الجمعة'],
            ['name'=>'السبت'],
        ];
        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }

    }
}
