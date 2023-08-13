<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\Admin\Category;
use App\Models\Favourites;
use App\Models\Gaza\Area;
use App\Models\Gaza\Region;
use App\Models\Owner\Owner;
use App\Models\Period;
use App\Models\the_period;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin=Admin::create(['email'=>'a@a.com',"password"=>Hash::make('123')]);
//      ------------------------------------


        Category::create([
            "title"=>"محل ملابس",
            "explorer"=>"0",
            "description"=>"ملابس",
            "hashcode"=>"3000"
        ]);
        Category::create([
            "title"=>"مطاعم",
            "explorer"=>"0",
            "description"=>"طاعم",
            "hashcode"=>"4000"
        ]);
        Category::create([
            "title"=>"صيدلية",
            "explorer"=>"0",
            "description"=>"خاص بالمخالات صيدلية",
            "hashcode"=>"5000"
        ]);
        Category::create([
            "title"=>"شاليهات",
            "explorer"=>"0",
            "description"=>"خاص بالشاليهات",
            "hashcode"=>"8000"
        ]);
        Category::create([
            "title"=>"محل تجاري(سوبر ماركت)",
            "explorer"=>"0",
            "description"=>"خاص بالمخالات التجارية",
            "hashcode"=>"9000"
        ]);
        //      ------------------------------------

        $admin=Owner::create(["name"=>"معتصم كروان",'email'=>'os@o.com',"password"=>Hash::make('123'),"re_password"=>"123","phone"=>"0599413265","category_id"=>1]);
        the_period::create(["title"=>"على مدار الساعة","time"=>"24/24"]);

        the_period::create(["title"=>"فترة صباحية","time"=>"12 ص- م12"]);
        the_period::create(["title"=>"فترة مسائية","time"=>"12 م-ص 12"]);
        DB::table("days")->insert([
            'day'=>"السبت"
            ,"day_en"=>"Saturday"
        ]);
        DB::table("days")->insert([
            'day'=>"الاحد"
            ,"day_en"=>"Sunday"
        ]);
        DB::table("days")->insert([
            'day'=>"الاثنين"
            ,"day_en"=>"Monday"
        ]);
        DB::table("days")->insert([
            'day'=>"الثلاثاء"
            ,"day_en"=>"Tuesday"
        ]);
        DB::table("days")->insert([
            'day'=>"الاربع"
            ,"day_en"=>"Wednesday"
        ]);
        DB::table("days")->insert([
            'day'=>"الخميس"
            ,"day_en"=>"Thursday"
        ]);
        DB::table("days")->insert([
            'day'=>"الجمعة"
            ,"day_en"=>"Friday"
        ]);
//      ------------------------------------

        $regions=[["region"=>"شمال غزة"],["region"=>"الوسطى"],["region"=>"جنوب غزة"]];
        $db_region=Region::insert($regions);

     $areas=[["area"=>"جباليا","region_id"=>"1",],
            ["area"=>"مخيم الشاطئ","region_id"=>"1",],
            ["area"=>"شجاعية","region_id"=>"1",],
            ["area"=>"غير ذالك","region_id"=>"1",],


            ["area"=>"البريج","region_id"=>"2",],
            ["area"=>"النصيرات","region_id"=>"2",],
            ["area"=>"المغازي","region_id"=>"2",],
            ["area"=>"دير البلح","region_id"=>"2",],

         ["area"=>"خانيونس","region_id"=>"3",],
         ["area"=>"رفح","region_id"=>"3",],
         ["area"=>"قرارة","region_id"=>"3",],];

        $db_areas=Area::insert($areas);
        //      ------------------------------------

        $data=[["title"=>"صحة ودواء"],["title"=>"شاليهات"],["title"=>"مطاعم"]];
        $favourest=Favourites::insert($data);

    }
}
