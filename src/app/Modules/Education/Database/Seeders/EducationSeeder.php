<?php

namespace  App\Modules\Education\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Education\Domain\Entities\Education;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        Education::truncate(); // Xoá dữ liệu cũ (chỉ nên dùng ở local/dev)

        Education::insert([
            [
                'school_name'   => 'University of Laravel',
                'major'         => 'Web Development',
                'degree'        => 'Bachelor',
                'description'   => 'Graduated with honors in full-stack PHP development.',
                'start_date'    => '2015-09-01',
                'end_date'      => '2019-06-30',
                'is_current'    => false,
                'order'         => 1,
                'created_by'    => 1,
                'updated_by'    => null,
                'deleted_by'    => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'school_name'   => 'Golang Institute',
                'major'         => 'Backend Engineering',
                'degree'        => 'Master',
                'description'   => 'Advanced backend services with Golang.',
                'start_date'    => '2020-01-01',
                'end_date'      => null,
                'is_current'    => true,
                'order'         => 2,
                'created_by'    => 1,
                'updated_by'    => null,
                'deleted_by'    => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        ]);
    }
}
