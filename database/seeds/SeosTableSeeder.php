<?php

use Illuminate\Database\Seeder;

class SeosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('seos')->delete();
        
        \DB::table('seos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'author' => '{"en":"Nexthour"}',
                'fb' => NULL,
                'google' => NULL,
                'metadata' => '{"en":"this ts a next hour"}',
                'description' => '{"en":null}',
                'keyword' => '{"en":null}',
                'created_at' => NULL,
                'updated_at' => '2020-11-02 12:09:28',
            ),
        ));
        
        
    }
}