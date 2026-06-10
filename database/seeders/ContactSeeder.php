<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Schema;

class ContactSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Contact::truncate();
        Contact::factory(100)->create();
        Schema::enableForeignKeyConstraints();
    }
}
