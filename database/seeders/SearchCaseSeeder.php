<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SearchCase;
use App\Models\User;

class SearchCaseSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::first();

        SearchCase::create([
            'title' => 'فقدان شخص في الربع الخالي',
            'description' => 'تم الإبلاغ عن فقدان شخص أثناء رحلة برية في الربع الخالي، آخر تواصل كان قبل يومين ولا يزال البحث جارٍ.',
            'status' => 'in_progress',
            'created_by' => $user->id,
        ]);

        SearchCase::create([
            'title' => 'انقطاع الاتصال بمتنزه في صحراء النفود الكبير',
            'description' => 'فُقد الاتصال بشخص أثناء التخييم في صحراء النفود شمال المملكة، ولم يتم العثور عليه حتى الآن.',
            'status' => 'open',
            'created_by' => $user->id,
        ]);

        SearchCase::create([
            'title' => 'مفقود في صحراء الدهناء',
            'description' => 'بلاغ عن شخص ضل طريقه أثناء القيادة في صحراء الدهناء، لا يزال البحث مستمرًا من قبل فرق الإنقاذ.',
            'status' => 'in_progress',
            'created_by' => $user->id,
        ]);

        SearchCase::create([
            'title' => 'فقدان مركبة وشخصين جنوب حافة طويق',
            'description' => 'انقطع الاتصال بمركبة تقل شخصين بالقرب من حافة طويق، ولم يتم تحديد موقعهم حتى الآن.',
            'status' => 'on_hold',
            'created_by' => $user->id,
        ]);

        
        SearchCase::create([
            'title' => 'مفقود قرب محمية عروق بني معارض',
            'description' => 'تم الإبلاغ عن فقدان شخص أثناء رحلة استكشافية بالقرب من المحمية، والبحث لا يزال جارياً.',
            'status' => 'open',
            'created_by' => $user->id,
        ]);
    }
}
