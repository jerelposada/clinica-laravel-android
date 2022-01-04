<?php

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'Oftalmologia',
            'Pediatria',
            'Neurologia'
        ];

        foreach ($specialties as $specialtyName) {

          $specialty = Specialty::create([
                'name' =>$specialtyName
          ]);
          $specialty->users()->saveMany(
              factory(App\User::class,3)->state('doctor')->make()
          );
        }

    }
}
