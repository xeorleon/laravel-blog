<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda', 'Kariyer', 'Vizyon', 'Misyon'];
        $count = 0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Praesent blandit rhoncus lorem a ullamcorper. Maecenas non purus feugiat,
                 tincidunt dolor porttitor, semper lectus. Nunc varius justo nec sapien aliquet tempus.
                  Duis nunc nulla, iaculis vel odio id, varius condimentum nunc. Integer et dignissim tortor.
                   Praesent in magna varius tellus euismod eleifend a nec velit. Nullam euismod scelerisque bibendum.
                    Phasellus tempus elit nec efficitur vulputate. Aliquam sed arcu vel enim eleifend dapibus.
                     Aliquam id pulvinar orci, non vestibulum dui. Vestibulum at accumsan velit. Phasellus diam velit,
                      maximus ac arcu et, convallis scelerisque tellus. Suspendisse malesuada purus nec enim interdum,
                       eget elementum erat lobortis.',
                'image' => 'https://www.resultsmanagementgroup.com/wp-content/uploads/2017/06/Business-wallpaper-HD-Free.jpg',
                'order' =>  $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
