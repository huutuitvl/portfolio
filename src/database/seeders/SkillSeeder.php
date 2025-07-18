<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->insert([
            [
                'name'       => 'PHP',
                'level'      => 'Advanced',
                'icon'       => 'fab fa-php',
                'order'      => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Laravel',
                'level'      => 'Advanced',
                'icon'       => 'fab fa-laravel',
                'order'      => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'JavaScript',
                'level'      => 'Intermediate',
                'icon'       => 'fab fa-js',
                'order'      => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'React',
                'level'      => 'Intermediate',
                'icon'       => 'fab fa-react',
                'order'      => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
