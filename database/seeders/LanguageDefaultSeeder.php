<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use Illuminate\Support\Facades\DB;

class LanguageDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();
        $languages = [
            ['code' => 'jp', 'name' => 'Japanese', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'en', 'name' => 'English', 'created_at' => now(), 'updated_at' => now()],
        ];
        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
