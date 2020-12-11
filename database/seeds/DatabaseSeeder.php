<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call(UsersTableSeeder::class);
        $this->call(AdsensesTableSeeder::class);
        $this->call(AuthCustomizesTableSeeder::class);
        $this->call(ButtonsTableSeeder::class);
        $this->call(ConfigsTableSeeder::class);
        $this->call(HomeSlidersTableSeeder::class);
        $this->call(LandingPagesTableSeeder::class);
        $this->call(PlayerSettingsTableSeeder::class);
        $this->call(SocialIconsTableSeeder::class);
        $this->call(SeosTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(ChatSettingsTableSeeder::class);
        $this->call(AppConfigsTableSeeder::class);
        $this->call(AppSlidersTableSeeder::class);
        $this->call(SplashScreensTableSeeder::class);
    }
}
