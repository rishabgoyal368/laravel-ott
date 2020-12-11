<?php

use Illuminate\Database\Seeder;

class ChatSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('chat_settings')->delete();
        
        \DB::table('chat_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'messanger',
                'enable_messanger' => 0,
                'script' => NULL,
                'mobile' => NULL,
                'text' => NULL,
                'header' => NULL,
                'color' => NULL,
                'size' => NULL,
                'enable_whatsapp' => 0,
                'position' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'whatsapp',
                'enable_messanger' => 0,
                'script' => NULL,
                'mobile' => '9999999999',
                'text' => 'Hey! We can help you?',
                'header' => 'Chat with us',
                'color' => '#111',
                'size' => 30,
                'enable_whatsapp' => 0,
                'position' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}