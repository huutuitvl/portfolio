<?php

namespace App\Modules\Experience\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Experience\Domain\Entities\Experience;
use Illuminate\Support\Carbon;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::truncate();

        $data = [
            [
                'company_name' => 'Google Inc.',
                'position'    => 'Senior Backend Developer',
                'start_date'  => '2018-01-01',
                'end_date'    => '2021-12-31',
                'description' => 'Worked on scalable microservices using Laravel and Golang.',
                'is_current'  => false,
                'order'       => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'company_name'     => 'Amazon Web Services',
                'position'    => 'DevOps Engineer',
                'start_date'  => '2022-01-01',
                'end_date'    => null,
                'is_current'  => true,
                'order'       => 2,
                'description' => 'Built CI/CD pipelines and infrastructure as code with Terraform.',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ];

        Experience::insert($data);
    }
}
