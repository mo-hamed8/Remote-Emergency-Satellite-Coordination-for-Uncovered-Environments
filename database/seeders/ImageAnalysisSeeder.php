<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SateliteImage;
use App\Models\ImageAnalysis;
use App\Models\User;

class ImageAnalysisSeeder extends Seeder
{
    
    public function run(): void
    {
        $user = User::first();
        $images = SateliteImage::all();

        foreach ($images as $image) {

            ImageAnalysis::create([
                'image_id' => $image->id,
                'analyzed_by' => $user->id,

                'point' => 'X:' . rand(10, 90) . ', Y:' . rand(10, 90),

                'description' => fake()->randomElement([
                    'يُحتمل وجود آثار أقدام بشرية في المنطقة المحددة.',
                    'تم رصد مسار مركبة باتجاه الجنوب الشرقي.',
                    'وجود جسم غير واضح قد يكون مخلفات تخييم.',
                    'لا توجد مؤشرات واضحة في هذه الصورة.',
                    'آثار إطارات تبدو حديثة نسبياً.',
                ]),

                'status' => fake()->randomElement([
                    'pending',
                    'reviewed',
                    'confirmed',
                ]),
            ]);
        }
    }
}
