<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SearchCase;
use App\Models\SateliteImage;

class SatelliteImageSeeder extends Seeder
{
    public function run(): void
    {
        
        $cases = SearchCase::all();

        if ($cases->isEmpty()) {
            return;
        }

        $imageNumber = 1;

        foreach ($cases as $case) {

            for ($i = 0; $i < 3; $i++) {

                SateliteImage::create([
                    'search_case_id' => $case->id,
                    'filename' => 's' . $imageNumber . '.png',
                    'path' => 'images/s' . $imageNumber . '.png',
                    'mime_type' => 'image/png',
                    'size' => 204800,
                ]);

                $imageNumber++;

                if ($imageNumber > 15) {
                    break 2;
                }
            }
        }
    }
}
