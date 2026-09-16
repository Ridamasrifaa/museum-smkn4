<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $jurusans = ['pplg', 'dkv', 'toi'];
        $jurusan = $this->faker->randomElement($jurusans);

        $techStack = match ($jurusan) {
            'pplg' => $this->faker->randomElement([
                'Laravel, Tailwind CSS, MySQL',
                'React.js, Node.js, Express',
                'Vue.js, Firebase, Bootstrap',
                'Flutter, Dart, REST API'
            ]),
            'dkv' => $this->faker->randomElement([
                'Adobe Photoshop, Illustrator, Premiere Pro',
                'Blender 3D, After Effects, Photoshop',
                'Figma, Canva, CorelDRAW'
            ]),
            'toi' => $this->faker->randomElement([
                'Arduino, IoT, C++, Sensor Suhu',
                'PLC, SCADA, Relay, Hydroponic Sensor',
                'ESP32, Microcontroller, Relay Module'
            ]),
        };

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'title' => 'Karya ' . strtoupper($jurusan) . ' - ' . $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(3),
            'jurusan' => $jurusan,
            'guru_pengampu' => 'Guru Pembimbing ' . $this->faker->numberBetween(1, 5),
            'technology_stack' => $techStack,
            'github_link' => ($jurusan === 'pplg') ? 'https://github.com/' . $this->faker->userName() . '/' . $this->faker->slug() : null,
            'live_link' => ($jurusan === 'pplg' && $this->faker->boolean(60)) ? $this->faker->url() : null,
            'file_path' => null,
            'file_type' => 'image',
            'status' => 'approved',
            'views_count' => $this->faker->numberBetween(10, 500),
            'likes_count' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}