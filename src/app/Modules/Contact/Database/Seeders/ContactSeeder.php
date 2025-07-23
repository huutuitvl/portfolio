<?php

namespace App\Modules\Contact\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Contact\Domain\Entities\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Seed the contact table with dummy data.
     */
    public function run(): void
    {
        Contact::factory()->count(10)->create();
    }
}
