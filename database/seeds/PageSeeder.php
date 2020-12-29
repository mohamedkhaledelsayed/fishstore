<?php

use App\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages= [
        
            [
              'phone_number'=>"01234567891",
              'link'=>'www.facebook.com',
              
              'en'  => ['text' => 'A fish is an animal which lives and breathes in water. All fish are vertebrates (have a backbone) and most breathe through gills and have fins and scales.Fish make up about half of all known vertebrate species. Fish have been on the earth for more than 500 million years. Fish were well established long before dinosaurs roamed the earth.The 25,000 known species of fish are divided into three main groups. There are three classes of fish: jawless, cartilaginous, and bony. All fish have a backbone.It is estimated that there may still be over 15,000 fish species that have not yet been identified. There are more species of fish than all the species of amphibians, reptiles, birds and mammals combined.Fish are cold-blooded, which means their internal body temperature changes as the surrounding temperature changes.40% of all fish species inhabit fresh water, yet less than .01% of the earth’s water is fresh water. Tropical fish are one of the most popular pets in the U.S.Some fish like sharks don’t possess an air bladder to help keep them afloat and must either swim continually or rest on the bottom. '],
              'ar'  => ['text' => ' السمكة حيوان يعيش ويتنفس في الماء. جميع الأسماك فقاريات (لها عمود فقري) وتتنفس معظمها من خلال الخياشيم ولها زعانف وقشور.
              تشكل الأسماك حوالي نصف جميع أنواع الفقاريات المعروفة. كانت الأسماك موجودة على الأرض منذ أكثر من 500 مليون سنة. كانت الأسماك راسخة قبل فترة طويلة من تجول الديناصورات على الأرض.25000 نوع معروف من الأسماك مقسمة إلى ثلاث مجموعات رئيسية. هناك ثلاث فئات من الأسماك: عديم الفك ، غضروفي ، وعظمي. كل الأسماك لها عمود فقري
              تشير التقديرات إلى أنه ربما لا يزال هناك أكثر من 15000 نوع من الأسماك التي لم يتم تحديدها بعد. هناك أنواع من الأسماك أكثر من جميع أنواع البرمائيات والزواحف والطيور والثدييات مجتمعة.
              الأسماك من ذوات الدم البارد ، مما يعني أن درجة حرارة الجسم الداخلية تتغير مع تغير درجة الحرارة المحيطة.40٪ من جميع أنواع الأسماك تعيش في المياه العذبة ، ولكن أقل من 0.01٪ من مياه الأرض هي مياه عذبة. تعتبر الأسماك الاستوائية من أشهر الحيوانات الأليفة في الولايات المتحدة.
              لا تمتلك بعض الأسماك مثل أسماك القرش المثانة الهوائية للمساعدة في إبقائها طافية ويجب إما أن تسبح باستمرار أو تستريح في القاع. يمكن لبعض أنواع الأسماك أن تطير (تنزلق) ويمكن للآخرين القفز على طول السطح ويمكن للآخرين حتى تسلق الصخور.']
            ]
            ];

            foreach ($pages as $page) {
              Page::create( $page);
            }

            

    }
}
