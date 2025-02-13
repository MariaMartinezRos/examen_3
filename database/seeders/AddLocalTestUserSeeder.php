<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Role;

class AddLocalTestUserSeeder extends Seeder
{
    public function run(): void
    {
        if (App::environment() === 'local') {
            ///////////////////USUARIO DE PRUEBA ADMINISTRADOR
            $user = User::create([
                'name' => 'Test User Admin',
                'email' => 'test@mail.es',
                'password' => bcrypt('12345678'),
            ]);

            $user->assignRole('admin');
            $courses = Course::all();
            $user->purchasedCourses()->attach($courses);


            ////////////////////CLIENTE
            $client = User::create([
                'name' => 'Test User Client',
                'email' => 'client@mail.es',
                'password' => bcrypt('12345678'),
            ]);

            $client->assignRole('client');
            $courses = Course::all();
            $client->purchasedCourses()->attach($courses);
        }
    }
}
