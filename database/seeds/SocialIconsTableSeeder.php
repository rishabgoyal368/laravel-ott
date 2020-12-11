<?php

use Illuminate\Database\Seeder;

class SocialIconsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('social_icons')->delete();
        
        \DB::table('social_icons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'url1' => '#',
                'url2' => '#',
                'url3' => '#',
                'created_at' => '2020-11-02 09:09:08',
                'updated_at' => '2020-11-02 09:10:18',
            ),
        ));
        
        
    }
}