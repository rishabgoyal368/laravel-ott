<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Config;
use App\LiveEvent;
use App\Movie;
use App\MovieSeries;
use App\MultipleLinks;
use App\Season;
use App\TvSeries;
use App\User;
use Auth;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Http\Request;

class PrimeDetailController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showMovie($slug)
    {


        $movie = Movie::where('slug', $slug)->where('status', 1)->first();
        $type_check = "M";
        $movies = Movie::all();
        $config = Config::findOrFail(1);
        $filter_series = collect();
        $age = 0;

        SEOTools::setDescription(strip_tags($movie->detail));
        SEOMeta::addKeyword([$movie->title, $movie->keyword]);
        SEOTools::opengraph()->addProperty('type', 'webpage');
        OpenGraph::addImage(url('images/movies/thumbnails/'.$movie->thumbnail));
        SEOTools::twitter()->setSite(url('/'));


        if (!isset($movie)) {
            return 'Movie Is Not Available right now, Please comeback later !';
        }

        if ($config->age_restriction == 1) {
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            }
        } else {
            $age = 100;
        }

        views($movie)->record();

        if ($movie->series == 1) {
            $single_series_list = MovieSeries::where('series_movie_id', $movie->id)->first();
            if (isset($single_series_list)) {

                $main_movie_series = Movie::where('id', $single_series_list->movie_id)->first();
                $filter_series->push($main_movie_series);
                $series_list = (MovieSeries::where([['movie_id', $main_movie_series->id], ['series_movie_id', '!=', $movie->id]])->get());
                foreach ($series_list as $item) {
                    $filter_movie_exc_self = Movie::where('id', $item->series_movie_id)->first();
                    $filter_series->push($filter_movie_exc_self);
                }
            }
        }

        if ($config->prime_movie_single == 1) {
            return view('movie_single_prime', compact('movie', 'movies', 'filter_series', 'type_check', 'age', 'config'));
        } else {
            return view('movie_single', compact('movie', 'movies', 'filter_series', 'type_check', 'age', 'config'));
        }
    }

    public function showSeasons($season_slug)
    {

        $season = Season::where('season_slug', $season_slug)->first();

        $type_check = "S";
        $movies = Movie::all();
        views($season)->record();
        $config = Config::findOrFail(1);
        $age = 0;

        SEOTools::setDescription(strip_tags($season->description));
        SEOMeta::addKeyword([$season->title, $season->keyword]);
        SEOTools::opengraph()->addProperty('type', 'webpage');
        OpenGraph::addImage(url('images/tvseries/thumbnails/'.$season->thumbnail));
        SEOTools::twitter()->setSite(url('/'));

        if ($season->tvseries->status != 1) {
            return 'This Season is not available right now, Please comeback later !';
        }

        if ($config->age_restriction == 1) {
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            }
        } else {
            $age = 100;
        }

        if ($config->prime_movie_single == 1) {
            return view('movie_single_prime', compact('season', 'age', 'movies', 'type_check', 'config'));
        } else {
            return view('movie_single', compact('season', 'age', 'movies', 'config', 'type_check'));
        }
    }

    public function moviedownload($upload_video)
    {

        $file = $upload_video;

        $path = public_path() . "/movies_upload/" . $upload_video;
        $headers = array(
            'Content-Type : application/pdf',
        );
        return response()->download($path, $file, $headers);
    }

    public function seasondownload($upload_video)
    {

        $file = $upload_video;

        $path = public_path() . "/tvshow_upload/" . $upload_video;
        $headers = array(
            'Content-Type : application/pdf',
        );
        return response()->download($path, $file, $headers);

    }

    public function updateclick(Request $request)
    {
        $link = MultipleLinks::find($request->id);

        if (isset($link)) {
            $link->clicks = $link->clicks + 1;
            $link->save();

            return response()->json('Updated !');
        } else {
            return response()->json('Oops error');
        }
    }

    public function eventshow($slug)
    {
        $liveevent = LiveEvent::where('status', '=', '1')->where('slug', $slug)->first();
        if (!isset($liveevent)) {
            return abort(404);
        }

        return view('event_detail', compact('liveevent'));

    }

    public function audioshow($id)
    {
        $audio = Audio::where('id', $id)->first();
        if (!isset($audio)) {
            return abort(404);
        }

        return view('audio_detail', compact('audio'));

    }

}
