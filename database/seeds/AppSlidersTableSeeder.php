<?php

use Illuminate\Database\Seeder;

class AppSlidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('app_sliders')->delete();
        
        \DB::table('app_sliders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'movie_id' => NULL,
                'tv_series_id' => NULL,
                'slide_image' => 'app_slide_1606642528movie.jpg',
                'active' => 1,
                'position' => 1,
                'created_at' => '2020-11-29 14:47:00',
                'updated_at' => '2020-11-29 15:05:28',
            ),
            1 => 
            array (
                'id' => 2,
                'movie_id' => NULL,
                'tv_series_id' => NULL,
                'slide_image' => 'app_slide_1606642578tvshow.jpg',
                'active' => 1,
                'position' => 2,
                'created_at' => '2020-11-29 15:06:18',
                'updated_at' => '2020-11-29 15:06:18',
            ),
        ));
        
        
    }
}