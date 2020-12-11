<?php

use Illuminate\Database\Seeder;

class HomeSlidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('home_sliders')->delete();
        
        \DB::table('home_sliders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'movie_id' => NULL,
                'tv_series_id' => NULL,
                'slide_image' => 'slide_1604308881movie.jpg',
                'active' => 1,
                'position' => 1,
                'created_at' => '2020-11-02 14:51:21',
                'updated_at' => '2020-11-02 14:51:21',
            ),
            1 => 
            array (
                'id' => 2,
                'movie_id' => NULL,
                'tv_series_id' => NULL,
                'slide_image' => 'slide_1604308927tvshow.jpg',
                'active' => 1,
                'position' => 2,
                'created_at' => '2020-11-02 14:52:07',
                'updated_at' => '2020-11-02 14:52:07',
            ),
        ));
        
        
    }
}