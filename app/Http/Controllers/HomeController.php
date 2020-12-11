<?php
namespace App\Http\Controllers;

use App\Actor;
use App\Adsense;
use App\AudioLanguage;
use App\Blog;
use App\Config;
use App\Director;
use App\FrontSliderUpdate;
use App\Genre;
use App\HomeBlock;
use App\HomeSlider;
use App\LandingPage;
use App\LiveEvent;
use App\Menu;
use App\MenuSection;
use App\MenuVideo;
use App\Movie;
use App\Package;
use App\PricingText;
use App\Season;
use App\TvSeries;
use App\User;
use App\WatchHistory;
use Auth;
use App\Button;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Stripe\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showall(Request $request, $menuid, $menuname)
    {

        $menu = Menu::findOrFail($menuid);

        $menu_items = $menu->menu_data;

        $menu_items = collect($menu_items)->sortByDesc('id');

        $items = collect();

        foreach ($menu_items as $value) {
            if ($value->movie_id != null) {

                $items->push(Movie::where('id', $value->movie_id)->where('status', 1)->first());

            } else {

                $ts = TvSeries::where('id', $value->tv_series_id)->where('status', 1)->first();
                if (isset($ts)) {
                    $x = count($ts->seasons);

                    if ($x == 0) {

                    } else {
                        $items->push($ts->seasons[0]);
                    }

                }

            }
        }

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $itemCollection = collect($items);

        // Define how many items we want to be visible in each page
        $perPage = 30;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());
        // return $paginatedItems;
        $ad = Adsense::first();

        $age = 0;
        $config = Config::first();
        if ($config->age_restriction == 1) {
            if (Auth::user()) {
                # code...
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            } else {
                $age = 100;
            }
        }

        return view('viewall', ['pusheditems' => $paginatedItems, 'menuu' => $menu, 'ad' => $ad, 'age' => $age]);

    }

    public function showallsinglemovies()
    {

        $movies = Movie::orderBy('id', 'DESC')->where('status', '=', 1)->paginate(30);
        $ad = Adsense::first();
        return view('viewall2', compact('movies', 'ad'));

        // return view('viewall',compact('movies'));

    }

    public function showallsingletvseries(Request $request)
    {

        $items = collect();

        $all_tvseries = TvSeries::where('status', '=', 1)->get();

        foreach ($all_tvseries as $series) {

            $x = count($series->seasons);

            if ($x == 0) {

            } else {
                $items->push($series->seasons[0]);
            }

        }

        $items = collect($items)->sortByDesc('id');

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $itemCollection = collect($items);

        // Define how many items we want to be visible in each page
        $perPage = 30;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

        // set url path for generted links
        $movies = $paginatedItems->setPath($request->url());

        $ad = Adsense::first();
        return view('viewall2', compact('movies', 'ad'));
    }

    public function guestindex(Request $request, $menu_slug)
    {

        $age = 0;
        $config = Config::first();
        if ($config->age_restriction == 1) {
            if (Auth::user()) {
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            }
        } else {
            $age = 100;
        }

        $sliderview = FrontSliderUpdate::all();

        $home_slides = HomeSlider::orderBy('position', 'asc')->get();

        $home_blocks = HomeBlock::where('is_active', 1)->get();

        $menu = Menu::whereSlug($menu_slug)->first();
        $withlogin = Config::findOrFail(1)->withlogin;
        //Slider get limit here and Front Slider order
        $liveevent = LiveEvent::orderby('id', 'desc')->where('status', '1')->get();
        $blogs = Blog::where('is_active', '1')->get();
        $catlog = Config::findOrFail(1)->catlog;
        $limit = FrontSliderUpdate::where('id', 1)->first();
        $config = Config::first();

        if (!isset($menu)) {
            return redirect('/');
        }

        $menuh = Menu::all();
        $subscribed = null;

        $ad = Adsense::first();
        $age = 0;

        $menu_data = \DB::table('menu_videos')->where('menu_id', $menu->id)->get();
        $recent_data = \DB::table('menu_videos')->where('menu_id', $menu->id)->orderBy('id', 'DESC')->get();

        $g = Genre::query();
        $getallgenre = Genre::orderBy('id', 'DESC')->get();
        $lang = AudioLanguage::query();
        $genres = $g->select('id', 'name')->paginate(10);
        $audiolanguages = $lang->select('id', 'language')->paginate(10);
        $section6 = MenuSection::where('section_id', '=', 6)->where('menu_id', '=', $menu->id)->first();
        $section = MenuSection::where('section_id', '=', 2)->where('menu_id', '=', $menu->id)->first();

        if ($config->prime_genre_slider == 1) {
            //Layout 1
            return view('home', compact('getallgenre', 'menu_data', 'recent_data', 'ad', 'sliderview', 'age', 'genres', 'menuh', 'catlog', 'withlogin', 'menu', 'subscribed', 'home_blocks', 'audiolanguages', 'section6', 'blogs', 'liveevent', 'home_slides', 'age'));
        } else {
            //Layout 2
            return view('home2', compact('getallgenre', 'menu_data', 'recent_data', 'ad', 'sliderview', 'age', 'genres', 'menuh', 'catlog', 'withlogin', 'menu', 'subscribed', 'home_blocks', 'audiolanguages', 'section6', 'blogs', 'liveevent', 'home_slides', 'age'));
        }

    }

    public function index(Request $request, $menu_slug)
    {

        $auth = Auth::user();
        $subscribed = null;

        if (isset($auth)) {
            $current_date = date("d/m/y");
            if ($auth->is_admin == 1) {
                $subscribed = 1;

            } else {
                if ($auth->stripe_id != null) {
                    $customer = Customer::retrieve($auth->stripe_id);
                }
                $paypal = $auth
                    ->paypal_subscriptions
                    ->sortBy('created_at');
                $plans = Package::all();
                $current_date = Carbon::now()->toDateString();
                if (isset($customer)) {
                    //return $alldata = $user->asStripeCustomer()->subscriptions->data;
                    $alldata = $auth->subscriptions;
                    $data = $alldata->last();
                }
                if (isset($paypal) && $paypal != null && count($paypal) > 0) {
                    $last = $paypal->last();
                }
                $stripedate = isset($data) ? $data->created_at : null;
                $paydate = isset($last) ? $last->created_at : null;
                if ($stripedate > $paydate) {
                    if ($auth->subscribed($data->name)) {
                        $subscribed = 1;
                    }
                } elseif ($stripedate < $paydate) {
                    if (date($current_date) <= date($last->subscription_to)) {
                        $subscribed = 1;
                    }
                }
            }
        }

        $home_blocks = HomeBlock::where('is_active', 1)->get();
        $home_slides = HomeSlider::orderBy('position', 'asc')->get();
        $subscribe = $menu = Menu::whereSlug($menu_slug)->first();
        $withlogin = Config::findOrFail(1)->withlogin;
        //Slider get limit here and Front Slider order

        $blogs = Blog::where('is_active', '1')->get();
        $catlog = Config::findOrFail(1)->catlog;
        $protip = Button::find(1)->protip;
        $limit = FrontSliderUpdate::where('id', 1)->first();

        $watchistory = WatchHistory::where('user_id', $auth->id)->get();

        $menuh = Menu::all();

        $ad = Adsense::first();

        $age = 0;
        $config = Config::first();
        if ($config->age_restriction == 1) {
            if (Auth::user()) {
                # code...
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            } else {
                $age = 100;
            }
        }
        $menu = Menu::whereSlug($menu_slug)->first();
         if (!isset($menu)) {
            return redirect('/');
        }

        $menu_data = \DB::table('menu_videos')->where('menu_id', $menu->id)->get();
        $recent_data = \DB::table('menu_videos')->where('menu_id', $menu->id)->orderBy('id', 'DESC')->get();
        $liveevent = LiveEvent::orderby('id', 'desc')->where('status', '1')->get();
        $g = Genre::query();
        $getallgenre = $g->orderBy('id', 'DESC')->get();
        $genres = $g->select('id', 'name')->paginate(10);
        $lang = AudioLanguage::query();
        $audiolanguages = $lang->select('id', 'language')->paginate(10);
        $section6 = MenuSection::where('section_id', '=', 6)->where('menu_id', '=', $menu->id)->first();
        $section = MenuSection::where('section_id', '=', 2)->where('menu_id', '=', $menu->id)->first();

        if ($config->prime_genre_slider == 1) {
            //Layout 1
            return view('home', compact('menu_data', 'recent_data', 'home_slides', 'ad', 'age', 'genres', 'menuh', 'catlog', 'withlogin', 'menu', 'subscribed', 'watchistory', 'home_blocks', 'audiolanguages', 'section6', 'getallgenre', 'blogs', 'liveevent','protip'));
        } else {
            //Layout 2
            return view('home2', compact('menu_data', 'recent_data', 'home_slides', 'ad', 'age', 'genres', 'menuh', 'catlog', 'withlogin', 'menu', 'subscribed', 'watchistory', 'home_blocks', 'audiolanguages', 'section6', 'getallgenre', 'blogs', 'liveevent','protip'));
        }

    }

    public function mainPage()
    {

        $plans = Package::all();
        $pricingTexts = PricingText::all();
        $blocks = LandingPage::orderBy('position', 'asc')->get();
        $catlog = Config::findOrFail(1)->catlog;
        $removelanding = Config::findOrFail(1)->remove_landing_page;
        $withlogin = Config::findOrFail(1)->withlogin;
        $menufirst = Menu::first();
        if ($removelanding == 1 && $catlog == 1) {
            if (isset($menufirst->slug)) {
                if (Auth::check()) {
                    return redirect()->route('home', $menufirst->slug);
                } else {
                    return redirect()->route('guests', $menufirst->slug);
                }

            } else {
                return view('auth.login');
            }

        } else if ($removelanding == 1 && $catlog == 0) {
            return view('auth.login');
        } else {
            if ($catlog == 1 && $withlogin == 0) {

                $menuh = Menu::all();
                return view('main', compact('pricingTexts', 'plans', 'blocks', 'menuh', 'catlog', 'withlogin'));
            } else if ($catlog == 1 && $withlogin == 1) {

                $menuh = Menu::all();
                return view('main', compact('pricingTexts', 'plans', 'blocks', 'menuh', 'catlog', 'withlogin'));
            } else {

                return view('main', compact('pricingTexts', 'plans', 'blocks', 'catlog', 'withlogin'));

            }
        }

    }

    public function showallgenre(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (isset($genre)) {
            $items = collect();
            $movies = Movie::where('genre_id', 'LIKE', '%' . $genre->id . '%')->where('status', 1)->get();

            foreach ($movies as $movie) {
                $items->push($movie);
            }

            $tvs = TvSeries::where('genre_id', 'LIKE', '%' . $genre->id . '%')->where('status', 1)->get();

            foreach ($tvs as $tv) {
                $items->push($tv);
            }

            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            $itemCollection = collect($items);

            // Define how many items we want to be visible in each page
            $perPage = 30;

            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

            // set url path for generted links
            $paginatedItems->setPath($request->url());

            $ad = Adsense::first();

            $age = 0;
            $config = Config::first();
            if ($config->age_restriction == 1) {
                if (Auth::user()) {
                    # code...
                    $user_id = Auth::user()->id;
                    $user = User::findOrfail($user_id);
                    $age = $user->age;
                } else {
                    $age = 100;
                }
            }

            return view('showallgenre', ['pusheditems' => $paginatedItems, 'ad' => $ad, 'genre' => $genre, 'age' => $age]);

        } else {
            return abort(404, 'Genre not found !');
        }
    }

    public function gusetshowallgenre(Request $request, $id)
    {

        $genre = Genre::find($id);

        if (isset($genre)) {
            $items = collect();
            $movies = Movie::where('genre_id', 'LIKE', '%' . $genre->id . '%')->where('status', 1)->get();

            foreach ($movies as $movie) {
                $items->push($movie);
            }

            $tvs = TvSeries::where('genre_id', 'LIKE', '%' . $genre->id . '%')->where('status', 1)->get();

            foreach ($tvs as $tv) {
                $items->push($tv);
            }

            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            $itemCollection = collect($items);

            // Define how many items we want to be visible in each page
            $perPage = 30;

            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

            // set url path for generted links
            $paginatedItems->setPath($request->url());

            $ad = Adsense::first();

            $age = 0;
            $config = Config::first();
            if ($config->age_restriction == 1) {
                if (Auth::user()) {
                    # code...
                    $user_id = Auth::user()->id;
                    $user = User::findOrfail($user_id);
                    $age = $user->age;
                } else {
                    $age = 100;
                }
            }

            return view('showallgenre', ['pusheditems' => $paginatedItems, 'ad' => $ad, 'genre' => $genre, 'age' => $age]);

        } else {
            return abort(404, 'Genre not found !');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $searchKey)
    {
        $config = Config::first();
        if ($config->age_restriction == 1) {
            if (Auth::user()) {
                # code...
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            } else {
                $age = 100;
            }
        }

        $all_movies = Movie::where('status', '1')->get();
        $all_tvseries = TvSeries::where('status', '1')->get();
        $searchKey = $searchKey->search;

        $tvseries = TvSeries::where('title', 'LIKE', "%$searchKey%")->where('status', 1)->get();
        $filter_video = collect();

        $tvseries = TvSeries::where('title', 'LIKE', "%$searchKey%")->where('status', 1)->get();

        foreach ($tvseries as $series) {
            $menuid = MenuVideo::where('tv_series_id', $series->id)
                ->get();

            if (isset($menus) && count($menus) > 0) {
                foreach ($menuid as $key => $value) {
                    for ($i = 0; $i < sizeof($menus); $i++) {
                        if ($value->menu_id == $menus[$i]) {
                            $season = Season::where('tv_series_id', $series->id)
                                ->get();
                            if (isset($season)) {
                                $filter_video->push($season[0]);
                            }
                        }
                    }

                }
            } else {
                $season = Season::where('tv_series_id', $series->id)->get();
                if (isset($season)) {
                    $filter_video->push($season[0]);
                }
            }

        }

        $movies = Movie::where('title', 'LIKE', "%$searchKey%")->where('status', '=', 1)->get();

        if (isset($movies) && count($movies) > 0) {
            foreach ($movies as $key => $movie) {
                $menuid = MenuVideo::where('movie_id', $movie->id)
                    ->get();
                if (isset($menus) && count($menus) > 0) {
                    foreach ($menuid as $key => $value) {
                        for ($i = 0; $i < sizeof($menus); $i++) {
                            if ($value->menu_id == $menus[$i]) {
                                $filter_video->push($movies);
                            }
                        }

                    }
                } else {
                    $filter_video->push($movies);
                }

            }

        }

        // if search key is actor
        $actor = Actor::where('name', 'LIKE', "%$searchKey%")->first();
        if (isset($actor) && $actor != null) {
            foreach ($all_movies as $key => $item) {
                if ($item->actor_id != null && $item->actor_id != '') {
                    $movie_actor_list = explode(',', $item->actor_id);
                    for ($i = 0; $i < count($movie_actor_list); $i++) {
                        $check = DB::table('actors')->where('id', '=', trim($movie_actor_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $actor->name) {
                            $filter_video->push($item);
                        }
                    }
                }
            }
            foreach ($all_tvseries as $key => $tv) {
                foreach ($tv->seasons as $key => $item) {
                    if ($item->actor_id != null && $item->actor_id != '') {
                        $season_actor_list = explode(',', $item->actor_id);
                        for ($i = 0; $i < count($season_actor_list); $i++) {
                            $check = DB::table('actors')->where('id', '=', trim($season_actor_list[$i]))->get();
                            if (isset($check[0]) && $check[0]->name == $actor->name) {
                                $filter_video->push($item);
                            }
                        }
                    }
                }
            }
        }

        // if search key is director
        $director = Director::where('name', 'LIKE', "%$searchKey%")->first();
        if (isset($director) && $director != null) {
            foreach ($all_movies as $key => $item) {
                if ($item->director_id != null && $item->director_id != '') {
                    $movie_director_list = explode(',', $item->director_id);
                    for ($i = 0; $i < count($movie_director_list); $i++) {
                        $check = DB::table('directors')->where('id', '=', trim($movie_director_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $director->name) {
                            $filter_video->push($item);
                        }
                    }
                }
            }
        }

        // if search key is genre
        $genre = Genre::where('name', 'LIKE', "%$searchKey%")->first();

        if (isset($genre) && $genre != null) {
            foreach ($all_movies as $key => $item) {
                if ($item->genre_id != null && $item->genre_id != '') {
                    $movie_genre_list = explode(',', $item->genre_id);
                    for ($i = 0; $i < count($movie_genre_list); $i++) {
                        $check = Genre::where('id', '=', trim($movie_genre_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $genre->name) {
                            $filter_video->push($item);
                        }
                    }
                }
            }

            foreach ($all_tvseries as $key => $item) {
                if ($item->genre_id != null && $item->genre_id != '') {
                    $tv_genre_list = explode(',', $item->genre_id);
                    for ($i = 0; $i < count($tv_genre_list); $i++) {
                        $check = Genre::where('id', '=', trim($tv_genre_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $actor['name']) {
                            $filter_video->push($item);
                        }
                    }
                }
            }
        }

        $filter_video = $filter_video->flatten();

        return view('search', compact('filter_video', 'searchKey', 'age'));
    }

    public function quicksearch(Request $request)
    {

        $search = $request->search;
        $result = array();

        $searchinmovie = \DB::table('movies')->where('title', 'LIKE', '%' . $search . '%')->select('id', 'title')->get();

        $searchintvshow = \DB::table('tv_series')->where('title', 'LIKE', '%' . $search . '%')->select('id', 'title')->get();

        foreach ($searchinmovie as $key => $value) {

            if (Auth::check()) {
                $result[] = ['id' => $value->id, 'value' => $value->title, 'url' => url('movie/guest/detail/' . $value->id)];
            } else {
                $result[] = ['id' => $value->id, 'value' => $value->title, 'url' => url('movie/detail/' . $value->id)];
            }

        }

        foreach ($searchintvshow as $key => $tvshow) {
            if (Auth::check()) {
                $result[] = ['id' => $tvshow->id, 'value' => $tvshow->title, 'url' => url('show/guest/detail/' . $tvshow->id)];
            } else {
                $result[] = ['id' => $tvshow->id, 'value' => $tvshow->title, 'url' => url('show/detail/' . $tvshow->id)];
            }
        }

        if (count($result) < 1) {
            $result[] = ['id' => 1, 'value' => 'No Result found !', 'url' => '#'];
        }

        return response()->json($result);

    }

    public function director_search($director_search)
    {
        $config = Config::first();
        if ($config->age_restriction == 1) {
            if (Auth::user()) {
                # code...
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            } else {
                $age = 100;
            }
        }

        $filter_video = collect();
        $all_movies = Movie::where('status', '1')->get();
        $tvseries = TvSeries::where('status', '1')->get();
        $searchKey = $director_search;
        $director = Director::where('name', 'LIKE', "%$director_search%")->first();

        if ($searchKey != null || $searchKey != '') {
            foreach ($all_movies as $item) {
                if ($item->director_id != null && $item->director_id != '') {
                    $movie_director_list = explode(',', $item->director_id);
                    for ($i = 0; $i < count($movie_director_list); $i++) {
                        $check = DB::table('directors')->where('id', '=', trim($movie_director_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $director->name) {
                            $filter_video->push($item);
                        }
                    }
                }
            }
        }

        $filter_video = $filter_video->filter(function ($value, $key) {
            return $value != null;
        });

        $filter_video = $filter_video->flatten();
        return view('search', compact('filter_video', 'searchKey', 'director', 'age'));
    }

    public function actor_search($actor_search)
    {
        $config = Config::first();
        if ($config->age_restriction == 1) {
            if (Auth::user()) {
                # code...
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            } else {
                $age = 100;
            }
        }

        $filter_video = collect();
        $all_movies = Movie::where('status', '1')->get();
        $tvseries = TvSeries::where('status', '1')->get();
        $searchKey = $actor_search;
        $actor = Actor::where('name', 'LIKE', "%$actor_search%")->first();

        if ($searchKey != null || $searchKey != '') {
            foreach ($all_movies as $item) {
                if ($item->actor_id != null && $item->actor_id != '') {
                    $movie_actor_list = explode(',', $item->actor_id);
                    for ($i = 0; $i < count($movie_actor_list); $i++) {
                        $check = DB::table('actors')->where('id', '=', trim($movie_actor_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $actor->name) {
                            $filter_video->push($item);
                        }
                    }
                }
            }
            if (isset($tvseries) && count($tvseries) > 0) {
                foreach ($tvseries as $series) {
                    if (isset($series->seasons) && count($series->seasons) > 0) {
                        foreach ($series->seasons as $item) {
                            if ($item->actor_id != null && $item->actor_id != '') {
                                $season_actor_list = explode(',', $item->actor_id);
                                for ($i = 0; $i < count($season_actor_list); $i++) {
                                    $check = DB::table('actors')->where('id', '=', trim($season_actor_list[$i]))->get();
                                    if (isset($check[0]) && $check[0]->name == $actor->name) {
                                        $filter_video->push($item);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $filter_video = $filter_video->filter(function ($value, $key) {
            return $value != null;
        });

        $filter_video = $filter_video->flatten();
        return view('search', compact('filter_video', 'searchKey', 'actor', 'age'));
    }

    public function genre_search($genre_search)
    {
        $config = Config::first();
        if ($config->age_restriction == 1) {
            if (Auth::user()) {
                # code...
                $user_id = Auth::user()->id;
                $user = User::findOrfail($user_id);
                $age = $user->age;
            } else {
                $age = 100;
            }
        }

        $all_genres = Genre::all();
        $all_movies = Movie::where('status', '1')->get();
        $all_tvseries = TvSeries::where('status', '1')->get();
        $filter_video = collect();

        if (isset($all_genres) && count($all_genres) > 0) {
            foreach ($all_genres as $key => $value) {
                if (trim($value->name) == trim($genre_search)) {
                    $genre = $value;
                }
            }
        }

        $searchKey = $genre_search;
        if ($genre != null) {
            foreach ($all_movies as $item) {
                if ($item->genre_id != null && $item->genre_id != '') {
                    $movie_genre_list = explode(',', $item->genre_id);
                    for ($i = 0; $i < count($movie_genre_list); $i++) {
                        $check = Genre::where('id', '=', trim($movie_genre_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $genre->name) {
                            $filter_video->push($item);
                        }
                    }
                }
            }

            if (isset($all_tvseries) && count($all_tvseries) > 0) {
                foreach ($all_tvseries as $series) {
                    if (isset($series->seasons) && count($series->seasons) > 0) {
                        if ($series->genre_id != null && $series->genre_id != '') {
                            $tvseries_genre_list = explode(',', $series->genre_id);
                            for ($i = 0; $i < count($tvseries_genre_list); $i++) {
                                $check = Genre::where('id', '=', trim($tvseries_genre_list[$i]))->get();
                                if (isset($check[0]) && $check[0]->name == $genre->name) {
                                    $filter_video->push($series->seasons);
                                }
                            }
                        }
                    }
                }
            }
        }

        $filter_video = $filter_video->filter(function ($value, $key) {
            return $value != null;
        });

        $filter_video = $filter_video->flatten();

        return view('search', compact('filter_video', 'searchKey', 'age'));
    }

    public function movie_genre($id)
    {
        $all_movies = Movie::where('status', '1')->get();
        $movies = collect();
        $genre = Genre::find($id);
        $searchKey = $genre->name;
        foreach ($all_movies as $item) {
            if ($item->imdb != 'Y') {
                if ($item->genre_id != null && $item->genre_id != '') {
                    $movie_genre_list = explode(',', $item->genre_id);
                    for ($i = 0; $i < count($movie_genre_list); $i++) {
                        $check = Genre::find(trim($movie_genre_list[$i]));
                        if (isset($check) && $check->id == $genre->id) {
                            $movies->push($item);
                        }
                    }
                }
            } else {
                if ($item->genre_id != null && $item->genre_id != '') {
                    $movie_genre_list = explode(',', $item->genre_id);
                    for ($i = 0; $i < count($movie_genre_list); $i++) {
                        $check = Genre::where('id', '=', trim($movie_genre_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $genre->name) {
                            $movies->push($item);
                        }
                    }
                }
            }
        }

        $filter_video = $movies;

        return view('search', compact('filter_video', 'searchKey'));
    }

    public function tvseries_genre($id)
    {
        $all_tvseries = TvSeries::where('status', '1')->get();
        $genre = Genre::find($id);
        $searchKey = $genre->name;
        $seasons = collect();
        foreach ($all_tvseries as $item) {
            if ($item->imdb != 'Y') {
                if ($item->genre_id != null && $item->genre_id != '') {
                    $tvseries_genre_list = explode(',', $item->genre_id);
                    for ($i = 0; $i < count($tvseries_genre_list); $i++) {
                        $check = Genre::find(trim($tvseries_genre_list[$i]));
                        if (isset($check) && $check->id == $genre->id) {
                            $seasons->push($item->seasons);
                        }
                    }
                }
            } else {
                if ($item->genre_id != null && $item->genre_id != '') {
                    $tvseries_genre_list = explode(',', $item->genre_id);
                    for ($i = 0; $i < count($tvseries_genre_list); $i++) {
                        $check = Genre::where('id', '=', trim($tvseries_genre_list[$i]))->get();
                        if (isset($check[0]) && $check[0]->name == $genre->name) {
                            $seasons->push($item->seasons);
                        }
                    }
                }
            }
        }

        $filter_video = $seasons->shuffle()
            ->flatten();
        return view('search', compact('filter_video', 'searchKey'));
    }

    public function movie_language($language_id)
    {
        $lang = AudioLanguage::findOrFail($language_id);
        $searchKey = $lang->language;
        $all_movies = Movie::where('status', '1')->get();
        $filter_video = collect();
        foreach ($all_movies as $item) {
            if ($item->a_language != null && $item->a_language != '') {
                $movie_lang_list = explode(',', $item->a_language);
                for ($i = 0; $i < count($movie_lang_list); $i++) {
                    $check = \App\Genre::find(trim($movie_lang_list[$i]));
                    if (isset($check) && $check->id == $lang->id) {
                        $filter_video->push($item);
                    }
                }
            }
        }

        return view('search', compact('filter_video', 'searchKey'));
    }

    public function tvseries_language($language_id)
    {
        $lang = AudioLanguage::findOrFail($language_id);
        $searchKey = $lang->language;
        $all_seasons = Season::all();
        $filter_video = collect();
        foreach ($all_seasons as $item) {
            if ($item->a_language != null && $item->a_language != '') {
                $season_lang_list = explode(',', $item->a_language);
                for ($i = 0; $i < count($season_lang_list); $i++) {
                    $check = \App\Genre::find(trim($season_lang_list[$i]));
                    if (isset($check) && $check->id == $lang->id) {
                        $filter_video->push($item);
                    }
                }
            }
        }

        return view('search', compact('filter_video', 'searchKey'));
    }

   

}
