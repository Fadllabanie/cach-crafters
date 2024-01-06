<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = Source::whereId(1)->first();
        if ($data) {
            return;
        }

        $iconFiles = File::files(public_path('icons'));

        foreach ($iconFiles as $file) {

            $name = pathinfo($file, PATHINFO_FILENAME);
            $iconPath = 'icons/' . $file->getFilename();
            $color = '#' . dechex(rand(0x000000, 0xFFFFFF));

            Source::create([
                'name_ar' => $name,
                'name_en' => $name,
                'icon' => $iconPath,
                'color' => $color,
            ]);
        }
    }
}
