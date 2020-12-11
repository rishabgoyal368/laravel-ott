<?php

namespace App\Http\Controllers;

use App\Audio;
use App\AudioLanguage;
use App\Genre;
use App\Menu;
use App\MenuVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $audio = \DB::table('audio')->select('id', 'title', 'thumbnail', 'poster', 'rating', 'featured')->get();
        if ($request->ajax()) {
            return \Datatables::of($audio)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($audio) {
                    $html = '<div class="inline">
        <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $audio->id . '" id="checkbox' . $audio->id . '">
        <label for="checkbox' . $audio->id . '" class="material-checkbox"></label>
        </div>';

                    return $html;
                })
                ->addColumn('thumbnail', function ($audio) {
                    if ($audio->thumbnail) {
                        $thumnail = '<img src="' . asset('/images/audio/thumbnails/' . $audio->thumbnail) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else if ($audio->poster) {
                        $thumnail = '<img src="' . asset('/images/audio/posters/' . $audio->poster) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else {
                        $thumnail = '<img  src="http://via.placeholder.com/70x70" alt="Pic" width="70px" class="img-responsive">';
                    }

                    return $thumnail;

                })
                ->addColumn('rating', function ($audio) {

                    return 'IMDB ' . $audio->rating;
                })
                ->addColumn('featured', function ($audio) {
                    if ($audio->featured == 1) {
                        $featured = 'Y';
                    } else {
                        $featured = '-';
                    }
                    return $featured;
                })

                ->addColumn('action', function ($audio) {

                    $btn = ' <div class="admin-table-action-block">
        <a href="' . url('audio/detail', $audio->id) . '" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>';

                    $btn .= ' <a href="' . route('audio.edit', $audio->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $audio->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $audio->id . '" class="delete-modal modal fade" role="dialog">
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
        <form method="POST" action="' . route("audio.destroy", $audio->id) . '">
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

        return view('admin.audio.index', compact('audio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        $genre_ls = Genre::pluck('name', 'id')->all();
        $a_lans = AudioLanguage::pluck('language', 'id')->all();

        return view('admin.audio.create', compact('menus', 'a_lans', 'genre_ls'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        if (!isset($input['featured'])) {
            $input['featured'] = 0;
        }

        $thumbnail = null;
        $poster = null;

        if ($file = $request->file('thumbnail')) {

            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            if ($request->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/audio/thumbnails/' . $request->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/audio/thumbnails/" . $request->thumbnail);
                }
            }
            $file->move(public_path() . '/images/audio/thumbnails', $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }

        if ($file = $request->file('poster')) {
            $poster = 'poster_' . time() . $file->getClientOriginalName();
            if ($request->poster != null) {
                $content = @file_get_contents(public_path() . '/images/audio/posters/' . $request->poster);
                if ($content) {
                    unlink(public_path() . "/images/audio/posters/" . $request->poster);
                }
            }
            $file->move(public_path() . '/images/audio/posters', $poster);
            $input['poster'] = $poster;
        }

        if ($file = $request->file('upload_audio')) {
            $upload_audio = 'audio_' . time() . $file->getClientOriginalName();
            if ($request->upload_audio != null) {
                $content = @file_get_contents(public_path() . '/audio/' . $request->upload_audio);
                if ($content) {
                    unlink(public_path() . "/audio/" . $request->upload_audio);
                }
            }
            $file->move(public_path() . '/audio', $upload_audio);
            $input['upload_audio'] = $upload_audio;
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

        $created_movie = Audio::create($input);

        return back()->with('added', 'Audio has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $menus = Menu::all();

        $genre_ls = Genre::all();
        $all_languages = AudioLanguage::all();
        $audio = Audio::findOrFail($id);

        // get old audio language values
        $old_lans = collect();
        $a_lans = collect();
        if ($audio->a_language != null) {
            $old_list = explode(',', $audio->a_language);
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

        // get old genre list
        $old_genre = collect();
        if ($audio->genre_id != null) {
            $old_list = explode(',', $audio->genre_id);
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

        return view('admin.audio.edit', compact('audio', 'genre_ls', 'a_lans', 'old_lans',
            'old_genre', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $audio = Audio::findOrFail($id);

        $menus = null;

        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
        }

        $input = $request->except('a_language', 'genre_id', 'audio_id');

        $a_lans = $request->input('a_language');
        if ($a_lans) {
            $a_lans = implode(',', $a_lans);
            $input['a_language'] = $a_lans;
        } else {
            $input['a_language'] = null;
        }

        if (!isset($input['featured'])) {
            $input['featured'] = 0;
        }

        $thumbnail = null;
        $poster = null;
        $keyword = $request->keyword;

        $genre_ids = $request->input('genre_id');
        if ($genre_ids) {
            $genre_ids = implode(',', $genre_ids);
            $input['genre_id'] = $genre_ids;
        } else {
            $input['genre_id'] = null;
        }

        if ($file = $request->file('thumbnail')) {
            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            if ($audio->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/audio/thumbnails/' . $audio->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/audio/thumbnails/" . $audio->thumbnail);
                }
            }

            $image = $request->file('thumbnail');
            $file_name = 'thumb_' . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = '../public/images/audio/thumbnails';
            $image->move($destinationPath, $file_name);
            $input['thumbnail'] = $file_name;
        }

        if ($file = $request->file('poster')) {
            $poster = 'thumb_' . time() . $file->getClientOriginalName();
            if ($audio->poster != null) {
                $content = @file_get_contents(public_path() . '/images/audio/posters/' . $audio->poster);
                if ($content) {
                    unlink(public_path() . "/images/audio/posters/" . $audio->poster);
                }
            } else {
                $file->move(public_path() . '/images/audio/posters', $poster);
            }

            $input['poster'] = $poster;
        }

        if (isset($request->is_protect)) {
            $input['is_protect'] = 1;
        } else {
            $input['is_protect'] = 0;
        }

        if ($request->slug != null) {
            $input['slug'] = $request->slug;
        } else {
            $slug = str_slug($input['title'], '-');
            $input['slug'] = $slug;
        }

        $audio->update($input);

        if ($menus != null) {
            if (count($menus) > 0) {
                if (isset($audio->menus) && count($audio->menus) > 0) {
                    foreach ($audio->menus as $key => $value) {
                        $value->delete();
                    }
                }
                foreach ($menus as $key => $value) {
                    MenuVideo::create([
                        'menu_id' => $value,
                        'audio_id' => $audio->id,
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

        return redirect('/admin/audio')->with('updated', 'Audio has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $audio = Audio::findOrFail($id);
        $audio->delete();

        return back()->with('deleted', 'Audio has been deleted');

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

            $audio = Audio::findOrFail($checked);

            if ($audio->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/audio/thumbnails/' . $audio->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/audio/thumbnails/" . $audio->thumbnail);
                }
            }
            if ($audio->poster != null) {
                $content = @file_get_contents(public_path() . '/images/audio/posters/' . $audio->poster);
                if ($content) {
                    unlink(public_path() . "/images/audio/posters/" . $audio->poster);
                }
            }

            $id = $checked;

            Audio::destroy($checked);
        }

        return back()->with('deleted', 'Audio has been deleted');
    }
}
