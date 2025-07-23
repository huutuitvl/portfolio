<?php

namespace App\Modules\Profile\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Profile\Domain\Entities\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'full_name' => 'Cậu Chủ Laravel',
            'headline' => 'Senior Laravel Developer',
            'bio' => 'Chuyên backend Laravel, kiến trúc Clean, GraphQL, Docker, AWS.',
            'avatar' => 'https://i.pravatar.cc/150?img=5',
            'email' => 'boss@example.com',
            'phone' => '0123456789',
            'location' => 'TP.HCM, Việt Nam',
            'birthday' => '1990-01-01',
            'social_links' => [
                'github' => 'https://github.com/cauchularavel',
                'linkedin' => 'https://linkedin.com/in/cauchularavel'
            ],
            'created_by' => 1,
        ]);
    }
}
