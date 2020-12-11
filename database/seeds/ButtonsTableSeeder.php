<?php

use Illuminate\Database\Seeder;

class ButtonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('buttons')->delete();
        
        \DB::table('buttons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'rightclick' => 1,
                'inspect' => 1,
                'goto' => 1,
                'color' => 0,
                'uc_browser' => 1,
                'comming_soon' => 0,
                'created_at' => '2018-07-31 11:30:00',
                'updated_at' => '2020-11-02 12:05:14',
                'commingsoon_enabled_ip' => NULL,
                'comming_soon_text' => NULL,
                'ip_block' => 0,
                'block_ips' => NULL,
                'remove_subscription' => 0,
                'protip' => 1,
            ),
        ));
        
        
    }
}