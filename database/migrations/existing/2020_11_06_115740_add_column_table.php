<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if ( Schema::hasTable('buttons') ) {

            Schema::table('buttons', function (Blueprint $table) {
                if (!Schema::hasColumn('buttons','comming_soon')){
                    $table->boolean('comming_soon')->default(1);
                }
               if (!Schema::hasColumn('buttons', 'commingsoon_enabled_ip')){
                    $table->longtext('commingsoon_enabled_ip')->nullable();
                }
                if (!Schema::hasColumn('buttons', 'ip_block')){
                    $table->boolean('ip_block')->default(1);
                }
                if (!Schema::hasColumn('buttons', 'block_ips')){
                    $table->longtext('block_ips')->nullable();
                }
                if (!Schema::hasColumn('buttons','maintenance')){
                  
                    $table->boolean('maintenance')->default(1);
                }
               
                if (!Schema::hasColumn('buttons', 'comming_soon_text')){
                    $table->longtext('comming_soon_text')->nullable();
                }
                if (!Schema::hasColumn('buttons', 'remove_subscription')){
                    $table->boolean('remove_subscription')->default(0);
                }
                 if (!Schema::hasColumn('buttons', 'protip')){
                    $table->boolean('protip')->default(1);
                }
                 if (!Schema::hasColumn('buttons', 'uc_browser')){
                    $table->boolean('uc_browser')->default(1);
                }
            });
        }

        if(Schema::hasTable('videolinks')){
            Schema::table('videolinks', function (Blueprint $table) {
                if (!Schema::hasColumn('videolinks', 'type')){
                    $table->string('type', 200)->nullable();
                }
            });
        }

         if(Schema::hasTable('package_menu')){
            Schema::table('package_menu', function (Blueprint $table) {
                if (!Schema::hasColumn('package_menu', 'pkg_id')){
                    $table->string('pkg_id', 200)->nullable();
                }
            });
        }

         if(Schema::hasTable('comments')){
            Schema::table('comments', function (Blueprint $table) {
                if (!Schema::hasColumn('comments', 'user_id')){
                    $table->integer('user_id');
                }
            });
        }

        if(Schema::hasTable('movie_comments')){
            Schema::table('movie_comments', function (Blueprint $table) {
                if (!Schema::hasColumn('movie_comments', 'user_id')){
                    $table->integer('user_id');
                }
            });
        }

        if ( Schema::hasTable('player_settings') ) {
            Schema::table('player_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('player_settings', 'player_google_analytics_id')){
                    $table->string('player_google_analytics_id', 199)->nullable();
                }
                 if (!Schema::hasColumn('player_settings', 'subtitle_font_size')){
                    $table->integer('subtitle_font_size')->nullable();
                }
                 if (!Schema::hasColumn('player_settings', 'subtitle_color')){
                   $table->string('subtitle_color', 191)->nullable();
                }
                 if (!Schema::hasColumn('player_settings', 'chromecast')){
                    $table->boolean('chromecast')->nullable()->after('subtitle_color');
                }
            });
        }

        if ( Schema::hasTable('genres') ) {
            Schema::table('genres', function (Blueprint $table) {
                if (!Schema::hasColumn('genres', 'position')){
                   $table->integer('position');
                }
                if (!Schema::hasColumn('genres', 'image')){
                    $table->string('image', 191)->nullable()->after('name');
                }

            });
        }

        if ( Schema::hasTable('users') ) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'amazon_id')){
                    $table->string('amazon_id', 191)->nullable()->unique('amazon_id')->after('gitlab_id');
                }
            });
        }

       

        if ( Schema::hasTable('live_events') ) {
            Schema::table('live_events', function (Blueprint $table) {
                if (!Schema::hasColumn('live_events', 'genre_id')){
                    $table->string('genre_id', 191)->nullable()->after('poster');
                }
                if (!Schema::hasColumn('live_events','detail')){
                    $table->longtext('detail')->nullable()->after('genre_id');
                }
            });
        }

        if ( Schema::hasTable('configs') ) {
            Schema::table('configs', function (Blueprint $table) {
                if (!Schema::hasColumn('configs', 'amazon_login')){
                    $table->boolean('amazon_login')->default(0)->after('captcha');
                }
                if (!Schema::hasColumn('configs', 'captcha')){
                    $table->boolean('captcha')->default(0)->before('created_at');
                }
                if (!Schema::hasColumn('configs', 'livetvicon')){
                    $table->string('livetvicon')->nullable()->after('favicon');
                }
            });
        }

        if ( Schema::hasTable('movies') ) {
            Schema::table('movies', function (Blueprint $table) {
                if (!Schema::hasColumn('movies', 'livetvicon')){
                    $table->boolean('livetvicon')->nullable();
                }
               if (!Schema::hasColumn('movies', 'slug')){
                    $table->string('slug', 191)->nullable()->after('title');
                }
                if (!Schema::hasColumn('movies', 'is_protect')){
                    $table->integer('is_protect')->default(0)->before('created_by');
                }
                if (!Schema::hasColumn('movies','password')){
                    $table->string('password',191)->nullable()->after('is_protect');
                }
               
            });
        }

        if ( Schema::hasTable('seasons') ) {
            Schema::table('seasons', function (Blueprint $table) {
                if (!Schema::hasColumn('seasons', 'season_slug')){
                    $table->string('season_slug', 191)->nullable()->after('season_no');
                }
                if (!Schema::hasColumn('seasons', 'is_protect')){
                    $table->integer('is_protect')->default(0)->after('type');
                }
                if (!Schema::hasColumn('seasons','password')){
                    $table->string('password',191)->nullable()->after('is_protect');
                }
                if (!Schema::hasColumn('seasons','trailer_url')){
                    $table->longtext('trailer_url',65535)->nullable()->after('type');
                }
            });
        }

        if ( Schema::hasTable('menu_videos') ) {
            Schema::table('menu_videos', function (Blueprint $table) {
                if (!Schema::hasColumn('menu_videos', 'live_event_id')){
                    $table->integer('live_event_id')->nullable()->after('tv_series_id');
                }
                if (!Schema::hasColumn('menu_videos', 'audio_id')){
                    $table->integer('audio_id')->nullable()->after('live_event_id');
                }
            });
        }

        if ( Schema::hasTable('subscriptions') ) {
            Schema::table('subscriptions', function (Blueprint $table) {
                if (!Schema::hasColumn('subscriptions', 'stripe_status')){
                    $table->string('stripe_status')->nullable()->after('stripe_id');
                }
            });
        }

        if ( Schema::hasTable('notifications') ) {
            Schema::table('notifications', function (Blueprint $table) {
                if (!Schema::hasColumn('notifications', 'title')){
                    $table->longtext('title')->nullable()->after('type');
                }
            });
        }

        if ( Schema::hasTable('subtitles') ) {
            Schema::table('subtitles', function (Blueprint $table) {
                if (!Schema::hasColumn('subtitles', 'ep_id')){
                    $table->integer('ep_id')->unsigned()->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('packages')){
            Schema::table('packages', function (Blueprint $table) {
                $table->dropColumn('genre_id');
                $table->dropColumn('detail');
            });
        }

        if(Schema::hasTable('subtitles')){
            Schema::table('subtitles', function (Blueprint $table) {
                $table->dropColumn('ep_id');
            });
        }
        if(Schema::hasTable('buttons')){
            Schema::table('buttons', function (Blueprint $table) {
                $table->dropColumn('comming_soon');
                $table->dropColumn('commingsoon_enabled_ip');
                $table->dropColumn('ip_block');
                $table->dropColumn('ipblock_ip');
                $table->dropColumn('maintenance');
                $table->dropColumn('comming_soon_text');
                $table->dropColumn('remove_subscription');
                $table->dropColumn('protip');
                $table->dropColumn('uc_browser');
            });
        }

        if(Schema::hasTable('videolinks')){
            Schema::table('videolinks', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
         if(Schema::hasTable('package_menu')){
            Schema::table('package_menu', function (Blueprint $table) {
                $table->dropColumn('pkg_id');
            });
        }
        if(Schema::hasTable('comments')){
            Schema::table('comments', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }

        if(Schema::hasTable('movie_comments')){
            Schema::table('movie_comments', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }

        if(Schema::hasTable('player_settings')){
            Schema::table('player_settings', function (Blueprint $table) {
                $table->dropColumn('player_google_analytics_id');
                $table->dropColumn('subtitle_font_size');
                $table->dropColumn('subtitle_color');
                $table->dropColumn('chromecast');
            });
        }


        if(Schema::hasTable('genres')){
            Schema::table('genres', function (Blueprint $table) {
                $table->dropColumn('position');
                $table->dropColumn('image');
            });
        }

        if(Schema::hasTable('users')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('amazon_id');
            });
        }
       
        if(Schema::hasTable('live_events')){
            Schema::table('live_events', function (Blueprint $table) {
                $table->dropColumn('genre_id');
                $table->dropColumn('detail');
            });
        }

        if(Schema::hasTable('configs')){
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn('livetvicon');
                $table->dropColumn('captcha');
                $table->dropColumn('amazon_login');
            });
        }

        if(Schema::hasTable('movies')){
            Schema::table('movies', function (Blueprint $table) {
                $table->dropColumn('livetvicon');
                 $table->dropColumn('slug');
                $table->dropColumn('is_protect');
                $table->dropColumn('password');
            });
        }

        if(Schema::hasTable('seasons')){
            Schema::table('seasons', function (Blueprint $table) {
                $table->dropColumn('season_slug');
                $table->dropColumn('is_protect');
                $table->dropColumn('password');
                $table->dropColumn('trailer_url');
            });
         }

        if(Schema::hasTable('menu_videos')){
            Schema::table('menu_videos', function (Blueprint $table) {
                $table->dropColumn('live_event_id');
                $table->dropColumn('audio_id');
            });
        }

        if(Schema::hasTable('subscriptions')){
            Schema::table('subscriptions', function (Blueprint $table) {
                $table->dropColumn('stripe_status');
            });
        }

        if(Schema::hasTable('notifications')){
            Schema::table('notifications', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
    }
}
