<?php

namespace App\Http\Controllers;

use App\Actor;
use App\AudioLanguage;
use App\Director;
use App\Genre;
use App\Menu;
use App\MenuVideo;
use App\Movie;
use App\MovieSeries;
use App\Subtitles;
use App\User;
use App\Videolink;
use App\WatchHistory;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LiveTvController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (Auth::user()->is_assistant != 1) {
            $movies = \DB::table('movies')->select('id', 'title', 'slug', 'thumbnail', 'poster', 'rating', 'tmdb', 'featured', 'status', 'created_by')->where('live', 1)->get();
        } else {
            $movies = \DB::table('movies')->select('id', 'title', 'slug', 'thumbnail', 'poster', 'rating', 'tmdb', 'featured', 'status', 'created_by')->where('created_by', Auth::user()->id)->where('live', 1)->get();
        }

        if ($request->ajax()) {
            return \Datatables::of($movies)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($movies) {
                    $html = '<div class="inline">
        <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $movies->id . '" id="checkbox' . $movies->id . '">
        <label for="checkbox' . $movies->id . '" class="material-checkbox"></label>
        </div>';

                    return $html;
                })
                ->addColumn('thumbnail', function ($movies) {
                    if ($movies->thumbnail) {
                        $thumnail = '<img src="' . asset('/images/movies/thumbnails/' . $movies->thumbnail) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else if ($movies->poster) {
                        $thumnail = '<img src="' . asset('/images/movies/posters/' . $movies->poster) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else {
                        $thumnail = '<img  src="http://via.placeholder.com/70x70" alt="Pic" width="70px" class="img-responsive">';
                    }

                    return $thumnail;

                })
                ->addColumn('rating', function ($movies) {

                    return 'IMDB ' . $movies->rating;
                })
                ->addColumn('featured', function ($movies) {
                    if ($movies->featured == 1) {
                        $featured = 'Y';
                    } else {
                        $featured = '-';
                    }
                    return $featured;
                })
                ->addColumn('tmdb', function ($movies) {
                    if ($movies->tmdb == 'Y') {
                        $tmdb = '<i class="material-icons done">done</i>';
                    } else {
                        $tmdb = '-';
                    }
                    return $tmdb;
                })
                ->addColumn('addedby', function ($movies) {
                    $username = User::find($movies->created_by);

                    if (isset($username)) {
                        return $username->name;
                    } else {
                        return 'User deleted';
                    }

                })
                ->addColumn('status', function ($movies) {
                    if (Auth::user()->is_assistant != 1) {
                        if ($movies->status == 1) {
                            return "<a href=" . route('quick.movie.status', $movies->id) . " class='btn btn-sm btn-success'>Active</a>";
                        } else {
                            return "<a href=" . route('quick.movie.status', $movies->id) . " class='btn btn-sm btn-danger'>Deactive</a>";
                        }
                    } else {
                        if ($movies->status == 1) {
                            return "<a class='btn btn-sm btn-success'>Active</a>";
                        } else {
                            return "<a class='btn btn-sm btn-danger'>Deactive</a>";
                        }
                    }
                })
                ->addColumn('action', function ($movies) {
                    if ($movies->status == 1) {
                        $btn = ' <div class="admin-table-action-block">
        <a href="' . url('movie/detail', $movies->slug) . '" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';
                    } else {
                        $btn = ' <div class="admin-table-action-block">
        <a style="cursor: not-allowed" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';
                    }
                    $btn .= ' <a href="' . route('livetv.edit', $movies->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $movies->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $movies->id . '" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="delete-icon"></div>
        </div>
        <div class="modal-body text-center">
        <h4 class="modal-heading">Are You Sure ?</h4>
        <p>Do you really want to delete these records? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
        <form method="POST" action="' . route("livetv.destroy", $movies->id) . '">
        ' . method_field("DELETE") . '
        ' . csrf_field() . '
        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
        </form>
        </div>
        </div>
        </div>
        </div>';

                    return $btn;
                })
                ->rawColumns(['checkbox', 'rating', 'thumbnail', 'tmdb', 'rating', 'status', 'addedby', 'action'])
                ->make(true);
        }

        return view('admin.livetv.index', compact('movies'));
    }

    public function addedLiveTv(Request $request)
    {

        $movies = \DB::table('movies')->select('id', 'title', 'slug', 'thumbnail', 'poster', 'rating', 'tmdb', 'featured', 'status', 'created_by')->where('status', 0)->where('live', 1)->get();

        if ($request->ajax()) {
            return \Datatables::of($movies)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($movies) {
                    $html = '<div class="inline">
      <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $movies->id . '" id="checkbox' . $movies->id . '">
      <label for="checkbox' . $movies->id . '" class="material-checkbox"></label>
      </div>';

                    return $html;
                })
                ->addColumn('thumbnail', function ($movies) {
                    if ($movies->thumbnail) {
                        $thumnail = '<img src="' . asset('/images/movies/thumbnails/' . $movies->thumbnail) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else if ($movies->poster) {
                        $thumnail = '<img src="' . asset('/images/movies/posters/' . $movies->poster) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else {
                        $thumnail = '<img  src="http://via.placeholder.com/70x70" alt="Pic" width="70px" class="img-responsive">';
                    }

                    return $thumnail;

                })
                ->addColumn('rating', function ($movies) {

                    return 'IMDB ' . $movies->rating;
                })
                ->addColumn('featured', function ($movies) {
                    if ($movies->featured == 1) {
                        $featured = 'Y';
                    } else {
                        $featured = '-';
                    }
                    return $featured;
                })
                ->addColumn('tmdb', function ($movies) {
                    if ($movies->tmdb == 'Y') {
                        $tmdb = '<i class="material-icons done">done</i>';
                    } else {
                        $tmdb = '-';
                    }
                    return $tmdb;
                })
                ->addColumn('addedby', function ($movies) {
                    $username = User::find($movies->created_by);

                    if (isset($username)) {
                        return $username->name;
                    } else {
                        return 'User deleted';
                    }

                })
                ->addColumn('status', function ($movies) {
                    if (Auth::user()->is_assistant != 1) {
                        if ($movies->status == 1) {
                            return "<a href=" . route('quick.movie.status', $movies->id) . " class='btn btn-sm btn-success'>Active</a>";
                        } else {
                            return "<a href=" . route('quick.movie.status', $movies->id) . " class='btn btn-sm btn-danger'>Deactive</a>";
                        }
                    } else {
                        if ($movies->status == 1) {
                            return "<a class='btn btn-sm btn-success'>Active</a>";
                        } else {
                            return "<a class='btn btn-sm btn-danger'>Deactive</a>";
                        }
                    }
                })
                ->addColumn('action', function ($movies) {
                    if ($movies->status == 1) {
                        $btn = ' <div class="admin-table-action-block">
        <a href="' . url('movie/detail', $movies->slug) . '" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';
                    } else {
                        $btn = ' <div class="admin-table-action-block">
        <a style="cursor: not-allowed" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';
                    }
                    $btn .= '
      <a href="' . route('livetv.edit', $movies->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $movies->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $movies->id . '" class="delete-modal modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="delete-icon"></div>
      </div>
      <div class="modal-body text-center">
      <h4 class="modal-heading">Are You Sure ?</h4>
      <p>Do you really want to delete these records? This process cannot be undone.</p>
      </div>
      <div class="modal-footer">
      <form method="POST" action="' . route("livetv.destroy", $movies->id) . '">
      ' . method_field("DELETE") . '
      ' . csrf_field() . '
      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
      <button type="submit" class="btn btn-danger">Yes</button>
      </form>
      </div>
      </div>
      </div>
      </div>';

                    return $btn;
                })
                ->rawColumns(['checkbox', 'rating', 'thumbnail', 'tmdb', 'rating', 'status', 'addedby', 'action'])
                ->make(true);
        }

        return view('admin.livetv.addedindex', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();

        $director_ls = Director::pluck('name', 'id')->all();
        $actor_ls = Actor::pluck('name', 'id')->all();
        $genre_ls = Genre::pluck('name', 'id')->all();
        $a_lans = AudioLanguage::pluck('language', 'id')->all();

        $all_movies = Movie::all();
        $series_list = MovieSeries::all();
        $movie_list_exc_series = collect();
        $movie_list_with_only_series = collect();
        if (count($series_list) > 0) {
            foreach ($series_list as $item) {
                $series = Movie::where('id', $item->series_movie_id)->first();
                $movie_list_with_only_series->push($series);
            }
            $movie_list_exc_series = $all_movies->toBase()->diff($movie_list_with_only_series->toBase());
            $movie_list_exc_series = $movie_list_exc_series->flatten()->pluck('title', 'id');
            $movie_list_exc_series = json_decode($movie_list_exc_series, true);
        } else {
            $movie_list_exc_series = Movie::pluck('title', 'id')->all();
        }

        return view('admin.livetv.create', compact('menus', 'director_ls', 'a_lans', 'director_ls', 'actor_ls', 'genre_ls', 'movie_list_exc_series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        $menus = null;
        $request->validate(['title' => 'required']);

        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
        }

        $input = $request->except('a_language', 'subtitle_list', 'movie_id');

        $a_lans = $request->input('a_language');
        if ($a_lans) {
            $a_lans = implode(',', $a_lans);
            $input['a_language'] = $a_lans;
        } else {
            $input['a_language'] = null;
        }

        $subtitles = $request->input('subtitle_list');
        if ($subtitles) {
            $subtitles = implode(',', $subtitles);
            $input['subtitle_list'] = $subtitles;
        } else {
            $input['subtitle_list'] = null;
        }

        if (!isset($input['subtitle'])) {
            $input['subtitle'] = 0;
        }
        if (!isset($input['featured'])) {
            $input['featured'] = 0;
        }
        if (!isset($input['livetvicon'])) {
            $input['livetvicon'] = 0;
        }
        if (!isset($input['series'])) {
            $input['series'] = 0;
        }

        if ($request->slug != null) {
            $input['slug'] = $request->slug;
        } else {
            $slug = str_slug($input['title'], '-');
            $input['slug'] = $slug;
        }

          if (isset($request->is_protect)) {
            $input['is_protect'] = 1;
        } else {
            $input['is_protect'] = 0;
        }

        $input['created_by'] = Auth::user()->id;

        if (Auth::user()->is_assistant == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $input['status'] = $status;

        $thumbnail = null;
        $poster = null;

        if ($file = $request->file('thumbnail')) {

            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            if ($request->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/movies/thumbnails/' . $request->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/movies/thumbnails/" . $request->thumbnail);
                }
            }
            $file->move(public_path() . '/images/movies/thumbnails', $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }

        if ($file = $request->file('poster')) {
            $poster = 'poster_' . time() . $file->getClientOriginalName();
            if ($request->poster != null) {
                $content = @file_get_contents(public_path() . '/images/movies/posters/' . $request->poster);
                if ($content) {
                    unlink(public_path() . "/images/movies/posters/" . $request->poster);
                }
            }
            $file->move(public_path() . '/images/movies/posters', $poster);
            $input['poster'] = $poster;
        }

        if ($sub_file = $request->file('subtitle_files')) {
            $name = 'sub' . time() . $sub_file->getClientOriginalName();
            $sub_file->move(public_path() . '/subtitles', $name);
            $input['subtitle_files'] = $name;
        } else {
            $input['subtitle_files'] = null;
        }

        $keyword = $request->keyword;
        $description = $request->description;

        $genre_ids = $request->input('genre_id');
        if ($genre_ids) {
            $genre_ids = implode(',', $genre_ids);
            $input['genre_id'] = $genre_ids;
        } else {
            $input['genre_id'] = null;
        }

        $input['ready_url'] = $request->ready_url;

        $created_movie = Movie::create($input);

// subtitle add
        if ($request->has('sub_t')) {
            foreach ($request->file('sub_t') as $key => $image) {

                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/subtitles/', $name);

                $form = new Subtitles();
                $form->sub_lang = $request->sub_lang[$key];
                $form->sub_t = $name;
                $form->m_t_id = $created_movie->id;
                $form->save();
            }
        }

        if ($request->selecturl == "iframeurl") {

            VideoLink::create([
                'movie_id' => $created_movie->id,
                'iframeurl' => $input['iframeurl'],
                'type' => 'iframeurl',
            ]);

        } else if ($request->selecturl == "customurl") {

            VideoLink::create([
                'movie_id' => $created_movie->id,
                'ready_url' => $input['ready_url'],
                'type' => 'readyurl',
            ]);

        }

// return $input;
        if ($menus != null) {
            if (count($menus) > 0) {
                foreach ($menus as $key => $value) {
                    MenuVideo::create([
                        'menu_id' => $value,
                        'movie_id' => $created_movie->id,
                    ]);
                }
            }
        }

        return back()->with('added', 'LiveTv has been added');
    }

/**
 * Display the specified resource.
 *
 * @param  int  $url
 * @return \Illuminate\Http\Response
 */
    public function get_http_response_code($url)
    {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit($id)
    {
        $menus = Menu::all();
        $director_ls = Director::all();
        $actor_ls = Actor::all();
        $genre_ls = Genre::all();
        $all_languages = AudioLanguage::all();
        $movie = Movie::findOrFail($id);

        $all_movies = Movie::all();
        $series_list = MovieSeries::all();
        $movie_list_exc_series = collect();
        $movie_list_with_only_series = collect();
        if (count($series_list) > 0) {
            foreach ($series_list as $item) {
                $series = Movie::where('id', $item->series_movie_id)->first();
                $movie_list_with_only_series->push($series);
            }

            $movie_list_exc_series = $all_movies->toBase()->diff($movie_list_with_only_series->toBase());
            $movie_list_exc_series = $movie_list_exc_series->flatten()->pluck('title', 'id');
            $movie_list_exc_series = json_decode($movie_list_exc_series, true);

        } else {
            $movie_list_exc_series = Movie::pluck('title', 'id')->all();
        }
        // get old audio language values
        $old_lans = collect();
        $a_lans = collect();
        if ($movie->a_language != null) {
            $old_list = explode(',', $movie->a_language);
            for ($i = 0; $i < count($old_list); $i++) {
                $old = AudioLanguage::find(trim($old_list[$i]));
                if (isset($old)) {
                    $old_lans->push($old);
                }
            }
        }
        $a_lans = $a_lans->filter(function ($value, $key) {
            return $value != null;
        });
        $a_lans = $all_languages->diff($old_lans);

        // get old subtitle language values
        $old_subtitles = collect();
        $a_subs = collect();
        if ($movie->subtitle == 1) {
            if ($movie->subtitle_list != null) {
                $old_list = explode(',', $movie->subtitle_list);
                for ($i = 0; $i < count($old_list); $i++) {
                    $old2 = AudioLanguage::find(trim($old_list[$i]));
                    if (isset($old2)) {
                        $old_subtitles->push($old2);
                    }
                }
            }
        }
        $a_subs = $a_subs->filter(function ($value, $key) {
            return $value != null;
        });
        $a_subs = $all_languages->diff($old_subtitles);

        // get old director list
        $old_director = collect();
        if ($movie->director_id != null) {
            $old_list = explode(',', $movie->director_id);
            for ($i = 0; $i < count($old_list); $i++) {
                $old3 = Director::find(trim($old_list[$i]));
                if (isset($old3)) {
                    $old_director->push($old3);
                }
            }
        }
        $director_ls = $director_ls->filter(function ($value, $key) {
            return $value != null;
        });
        $director_ls = $director_ls->diff($old_director);

        // get old actor list
        $old_actor = collect();
        if ($movie->actor_id != null) {
            $old_list = explode(',', $movie->actor_id);
            for ($i = 0; $i < count($old_list); $i++) {
                $old4 = Actor::find(trim($old_list[$i]));
                if (isset($old4)) {
                    $old_actor->push($old4);
                }
            }
        }
        $old_actor = $old_actor->filter(function ($value, $key) {
            return $value != null;
        });
        $actor_ls = $actor_ls->diff($old_actor);

        // get old genre list
        $old_genre = collect();
        if ($movie->genre_id != null) {
            $old_list = explode(',', $movie->genre_id);
            for ($i = 0; $i < count($old_list); $i++) {
                $old5 = Genre::find(trim($old_list[$i]));
                if (isset($old5)) {
                    $old_genre->push($old5);
                }
            }
        }
        $genre_ls = $genre_ls->filter(function ($value, $key) {
            return $value != null;
        });

        $genre_ls = $genre_ls->diff($old_genre);

        $this_movie_series = MovieSeries::where('series_movie_id', $id)->get();
        if (count($this_movie_series) > 0) {
            $this_movie_series_detail = Movie::where('id', $this_movie_series[0]->movie_id)->get();
        }

        $video_link = Videolink::where('movie_id', $id)->first();

        return view('admin.livetv.edit', compact('movie', 'director_ls', 'actor_ls', 'genre_ls', 'movie_list_exc_series', 'a_lans', 'old_lans', 'a_subs', 'video_link',
            'old_subtitles', 'old_director', 'old_actor', 'old_genre', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // ini_set('max_execution_time', 120);

        $movie = Movie::findOrFail($id);

        $menus = null;

        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
        }

        $input = $request->except('a_language', 'director_id', 'actor_id', 'genre_id', 'subtitle_list', 'movie_id');

        $a_lans = $request->input('a_language');
        if ($a_lans) {
            $a_lans = implode(',', $a_lans);
            $input['a_language'] = $a_lans;
        } else {
            $input['a_language'] = null;
        }

        $subtitles = $request->input('subtitle_list');
        if ($subtitles) {
            $subtitles = implode(',', $subtitles);
            $input['subtitle_list'] = $subtitles;
        } else {
            $input['subtitle_list'] = null;
        }

        if (!isset($input['subtitle'])) {
            $input['subtitle'] = 0;
        }
        if (!isset($input['featured'])) {
            $input['featured'] = 0;
        }
        if (!isset($input['series'])) {
            $input['series'] = 0;
        }

        $title = urlencode($input['title']);

        $thumbnail = null;
        $poster = null;

        if ($sub_file = $request->file('subtitle_files')) {

            $name = 'sub' . time() . $sub_file->getClientOriginalName();
            if ($movie->subtitle_files != null) {
                $content = @file_get_contents(public_path() . '/subtitles/' . $movie->subtitle_files);
                if ($content) {
                    unlink(public_path() . "/subtitles/" . $movie->subtitle_files);
                }
            }
            $sub_file->move('subtitles', $name);
            $input['subtitle_files'] = $name;
        }

        $keyword = $request->keyword;
        $description = $request->description;

        $genre_ids = $request->input('genre_id');
        if ($genre_ids) {
            $genre_ids = implode(',', $genre_ids);
            $input['genre_id'] = $genre_ids;
        } else {
            $input['genre_id'] = null;
        }

        if ($file = $request->file('thumbnail')) {
            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            if ($movie->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/movies/thumbnails/' . $movie->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/movies/thumbnails/" . $movie->thumbnail);
                }
            }

            $image = $request->file('thumbnail');
            $file_name = 'thumb_' . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = '../public/images/movies/thumbnails';
            $image->move($destinationPath, $file_name);
            $input['thumbnail'] = $file_name;
        }

        if ($file = $request->file('poster')) {
            $poster = 'thumb_' . time() . $file->getClientOriginalName();
            if ($movie->poster != null) {
                $content = @file_get_contents(public_path() . '/images/movies/posters/' . $movie->poster);
                if ($content) {
                    unlink(public_path() . "/images/movies/posters/" . $movie->poster);
                }
            } else {
                $file->move(public_path() . '/images/movies/posters', $poster);
            }

            $input['poster'] = $poster;
        }

        if ($input['series'] == 1 && $movie->series != 1) {
            MovieSeries::create([
                'movie_id' => $request->movie_id,
                'series_movie_id' => $movie->id,
            ]);
        }

        if (isset($request->is_protect)) {
            $input['is_protect'] = 1;
        } else {
            $input['is_protect'] = 0;
        }

        if ($request->slug != null) {
            $input['slug'] = $request->slug;
        } else {
            $slug = str_slug($request['title'], '-');
            $input['slug'] = $slug;
        }

        $movie->update($input);

        if (isset($movie->video_link)) {

            if ($request->selecturl == "iframeurl") {

                $movie->video_link->update([
                    'iframeurl' => $input['iframeurl'],
                    'ready_url' => null,
                    'url_360' => null,
                    'url_480' => null,
                    'url_720' => null,
                    'url_1080' => null,
                    'type' => 'iframeurl',
                ]);

            } else {

                if ($request->selecturl == "customurl") {

                    $movie->video_link->update([
                        'iframeurl' => null,
                        'type' => 'readyurl',
                        'ready_url' => $input['ready_url'],

                    ]);

                }

            }
        }

        if ($menus != null) {
            if (count($menus) > 0) {
                if (isset($movie->menus) && count($movie->menus) > 0) {
                    foreach ($movie->menus as $key => $value) {
                        $value->delete();
                    }
                }
                foreach ($menus as $key => $value) {
                    MenuVideo::create([
                        'menu_id' => $value,
                        'movie_id' => $movie->id,
                    ]);
                }
            }
        } else {
            if (isset($movie->menus) && count($movie->menus) > 0) {
                foreach ($movie->menus as $key => $value) {
                    $value->delete();
                }
            }
        }

        return redirect('/admin/livetv')->with('updated', 'LiveTv has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        $watched = WatchHistory::where('movie_id', $id)->delete();

        if ($movie->thumbnail != null) {
            $content = @file_get_contents(public_path() . '/images/movies/thumbnails/' . $movie->thumbnail);
            if ($content) {
                unlink(public_path() . "/images/movies/thumbnails/" . $movie->thumbnail);
            }
        }
        if ($movie->poster != null) {
            $content = @file_get_contents(public_path() . '/images/movies/posters/' . $movie->poster);
            if ($content) {
                unlink(public_path() . "/images/movies/posters/" . $movie->poster);
            }
        }
        if ($movie->subtitle_files != null) {
            $content = @file_get_contents(public_path() . '/subtitles/' . $movie->subtitle_files);
            if ($content) {
                unlink(public_path() . "/subtitles/" . $movie->subtitle_files);
            }
        }
        $videolink = VideoLink::where('movie_id', $id)->first();

        if (isset($videolink)) {
            $videolink->delete();
        }

        $movie->delete();

        return back()->with('deleted', 'LiveTv has been deleted');
    }

    public function bulk_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checked' => 'required',
        ]);

        if ($validator->fails()) {

            return back()->with('deleted', 'Please check one of them to delete');
        }

        foreach ($request->checked as $checked) {

            $movie = Movie::findOrFail($checked);
            $watched = WatchHistory::where('movie_id', $checked)->delete();

            if ($movie->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/movies/thumbnails/' . $movie->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/movies/thumbnails/" . $movie->thumbnail);
                }
            }
            if ($movie->poster != null) {
                $content = @file_get_contents(public_path() . '/images/movies/posters/' . $movie->poster);
                if ($content) {
                    unlink(public_path() . "/images/movies/posters/" . $movie->poster);
                }
            }
            if ($movie->subtitle_files != null) {
                $content = @file_get_contents(public_path() . '/subtitles/' . $movie->subtitle_files);
                if ($content) {
                    unlink(public_path() . "/subtitles/" . $movie->subtitle_files);
                }
            }
            $id = $checked;
            $videolink = VideoLink::where('movie_id', $id)->first();

            if (isset($videolink)) {
                $videolink->delete();
            }

            Movie::destroy($checked);
        }

        return back()->with('deleted', 'LiveTv has been deleted');
    }

    /**
     * Translate the specified resource from storage.
     * Translate all tmdb movies on one click
     * @return \Illuminate\Http\Response
     */
    public function tmdb_translations()
    {
        ini_set('max_execution_time', 1000);
        $all_movies = Movie::where('tmdb', 'Y')->get();
        $TMDB_API_KEY = env('TMDB_API_KEY');

        if ($TMDB_API_KEY == null || $TMDB_API_KEY == '') {
            return back()->with('deleted', 'Please provide your TMDB api key to translate');
        }

        if (isset($all_movies) && count($all_movies) > 0) {
            foreach ($all_movies as $key => $movie) {
                if (Session::has('changed_language')) {
                    $fetch_movie = @file_get_contents('https://api.themoviedb.org/3/movie/' . $movie->tmdb_id . '?api_key=' . $TMDB_API_KEY . '&language=' . Session::get('changed_language'));
                } else {
                    return back()->with('updated', 'Please Choose a language by admin panel top right side language menu');
                }

                $tmdb_movie = json_decode($fetch_movie, true);
                if (isset($tmdb_movie) && $tmdb_movie != null) {
                    $movie->update([
                        'detail' => $tmdb_movie['overview'],
                    ]);
                }
            }
            return back()->with('added', 'All Movies (only by TMDB) has been translated');
        } else {
            return back()->with('updated', 'Please create at least one LiveTv by TMDB option to translate');
        }
    }

}
