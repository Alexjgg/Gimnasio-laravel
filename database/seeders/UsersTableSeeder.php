<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Exercise;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
    //     User::create([
    //         'name' => 'Admin',
    //         'email' => 'admin@example.com',
    //         'role' => 'admin',
    //         'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
    //     ]);
        
    //     User::create([
    //         'name' => 'Entrenador',
    //         'email' => 'Entrenador@example.com',
    //         'role' => 'trainer',
    //         'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
    //     ]);

    //     for ($i = 2; $i <= 10; $i++) {
    //         User::create([
    //             'name' => 'User ' . $i,
    //             'email' => 'user' . $i . '@example.com',
    //             'role' => 'user',
    //             'password' => bcrypt('password'), // Cambia 'password' por la contraseña deseada
    //         ]);
    //     }


        $exercises = [
            [
                'name' => 'Push-up',
                'description' => 'A basic exercise to strengthen the chest and triceps.',
                'repetitions' => '15',
                'duration' => '30' // duration in seconds
            ],
            [
                'name' => 'Squat',
                'description' => 'A fundamental lower body exercise.',
                'repetitions' => '20',
                'duration' => '45'
            ],
            [
                'name' => 'Plank',
                'description' => 'An exercise for core strength.',
                'repetitions' => '1',
                'duration' => '60'
            ],
            [
                'name' => 'Lunges',
                'description' => 'An effective lower body exercise.',
                'repetitions' => '15',
                'duration' => '50'
            ],
            [
                'name' => 'Burpees',
                'description' => 'A full body exercise that improves conditioning.',
                'repetitions' => '10',
                'duration' => '40'
            ],
            [
                'name' => 'Bicep Curl',
                'description' => 'An upper body exercise focusing on the biceps.',
                'repetitions' => '12',
                'duration' => '30'
            ],
            [
                'name' => 'Tricep Dips',
                'description' => 'An exercise to strengthen triceps.',
                'repetitions' => '15',
                'duration' => '35'
            ],
            [
                'name' => 'Sit-ups',
                'description' => 'A core exercise to strengthen abdominal muscles.',
                'repetitions' => '20',
                'duration' => '40'
            ],
            [
                'name' => 'Jumping Jacks',
                'description' => 'A cardiovascular exercise.',
                'repetitions' => '30',
                'duration' => '30'
            ],
            [
                'name' => 'Mountain Climbers',
                'description' => 'A full body exercise that improves endurance.',
                'repetitions' => '20',
                'duration' => '45'
            ]
        ];

        foreach ($exercises as $exercise) {
            Exercise::create([
                'user_id' => '1', // Always assign user_id as 1
                'name' => $exercise['name'],
                'description' => $exercise['description'],
                'repetitions' => $exercise['repetitions'],
                'duration' => $exercise['duration'],
            ]);
        }
    }
}
