<?php

namespace App\Http\Controllers;

use App\LiveEvent;
use App\Menu;
use App\MenuVideo;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LiveEventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $liveevent = \DB::table('live_events')->select('id', 'title', 'thumbnail', 'organized_by', 'slug')->where('status', '1')->get();

        if ($request->ajax()) {
            return \Datatables::of($liveevent)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($liveevent) {
                    $html = '<div class="inline">
      <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $liveevent->id . '" id="checkbox' . $liveevent->id . '">
      <label for="checkbox' . $liveevent->id . '" class="material-checkbox"></label>
      </div>';

                    return $html;
                })
                ->addColumn('thumbnail', function ($liveevent) {
                    if ($liveevent->thumbnail) {
                        $thumnail = '<img src="' . asset('/images/events/thumbnails/' . $liveevent->thumbnail) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else if ($liveevent->poster) {
                        $thumnail = '<img src="' . asset('/images/events/posters/' . $liveevent->poster) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else {
                        $thumnail = '<img  src="http://via.placeholder.com/70x70" alt="Pic" width="70px" class="img-responsive">';
                    }

                    return $thumnail;

                })
                ->addColumn('organized_by', function ($liveevent) {

                    return $liveevent->organized_by;
                })

                ->addColumn('action', function ($liveevent) {
                    $btn = ' <div class="admin-table-action-block">
      <a href="' . url('event/detail', $liveevent->slug) . '" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
      <a href="' . route('liveevent.edit', $liveevent->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $liveevent->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $liveevent->id . '" class="delete-modal modal fade" role="dialog">
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
      <form method="POST" action="' . route("liveevent.destroy", $liveevent->id) . '">
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
                ->rawColumns(['checkbox', 'thumbnail', 'title', 'organized_by', 'action'])
                ->make(true);
        }

        return view('admin.liveevent.index', compact('liveevent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $menus = Menu::all();

        $all_liveevent = LiveEvent::where('status', '1')->get();

        return view('admin.liveevent.create', compact('menus', 'all_liveevent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        // $request->validate([
        //    'title' => 'required',
        //     'slug'=>'required|unique:liveevents,slug',
        //    ]);

        $menus = null;

        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
        }

        $newevent = new LiveEvent;

        $input = $request->all();

        if (isset($request->status)) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $thumbnail = null;
        $poster = null;

        if ($file = $request->file('thumbnail')) {

            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            if ($request->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/events/thumbnails/' . $request->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/events/thumbnails/" . $request->thumbnail);
                }
            }
            $file->move('images/events/thumbnails', $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }

        if ($file = $request->file('poster')) {
            $poster = 'poster_' . time() . $file->getClientOriginalName();
            if ($request->poster != null) {
                $content = @file_get_contents(public_path() . '/images/events/posters/' . $request->poster);
                if ($content) {
                    unlink(public_path() . "/images/events/posters/" . $request->poster);
                }
            }
            $file->move('images/events/posters', $poster);
            $input['poster'] = $poster;
        }

        $input['start_time'] = date('Y-m-d H:i:s', strtotime($request->start_time));
        $input['end_time'] = date('Y-m-d H:i:s', strtotime($request->end_time));

        $description = $request->description;
        $slug = str_slug($input['title'], '-');
        $input['slug'] = $slug;

        if ($request->selecturl == "iframeurl") {

            $input['iframeurl'] = $request->iframeurl;
            $input['type'] = 'iframeurl';
            $input['readyurl'] = null;

        } else if ($request->selecturl == "customurl") {

            $input['iframeurl'] = null;
            $input['type'] = 'readyurl';
            $input['readyurl'] = $request->ready_url;

        }

        $created_liveevents = LiveEvent::create($input);

// return $input;
        if ($menus != null) {
            if (count($menus) > 0) {
                foreach ($menus as $key => $value) {
                    MenuVideo::create([
                        'menu_id' => $value,
                        'live_event_id' => $created_liveevents->id,
                    ]);
                }
            }
        }

        return back()->with('added', 'LiveEvent has been added');
    }

/**
 * Display the specified resource.
 *
 * @param  int  $url
 * @return \Illuminate\Http\Response
 */

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit($id)
    {

        $menus = Menu::all();

        $liveevent = LiveEvent::findOrFail($id);

        // get old audio language values

        return view('admin.liveevent.edit', compact('menus', 'liveevent'));
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

        $liveevent = LiveEvent::findOrFail($id);

        $menus = null;

        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
        }

        if (!isset($input['status'])) {
            $input['status'] = 0;
        }

        $input = $request->all();

        $slug = str_slug($input['title'], '-');
        $input['slug'] = $slug;

        $input['start_time'] = date('Y-m-d H:i:s', strtotime($request->start_time));

        $input['end_time'] = date('Y-m-d H:i:s', strtotime($request->end_time));

        $thumbnail = null;
        $poster = null;

        if ($file = $request->file('thumbnail')) {

            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            if ($liveevent->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/events/thumbnails/' . $liveevent->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/events/thumbnails/" . $liveevent->thumbnail);
                }
            }
            $file->move('images/events/thumbnails', $thumbnail);
        }

        if ($file = $request->file('poster')) {
            $poster = 'poster_' . time() . $file->getClientOriginalName();
            if ($liveevent->poster != null) {
                $content = @file_get_contents(public_path() . '/images/events/posters/' . $liveevent->poster);
                if ($content) {
                    unlink(public_path() . "/images/events/posters/" . $liveevent->poster);
                }
            }
            $file->move('images/events/posters', $poster);
        }
        $description = $request->description;

        if ($file = $request->file('thumbnail')) {
            $thumbnail = 'thumb_' . time() . $file->getClientOriginalName();
            if ($liveevent->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/events/thumbnails/' . $liveevent->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/events/thumbnails/" . $liveevent->thumbnail);
                }
            } else {
                $file->move('images/events/thumbnails', $thumbnail);
            }

            $input['thumbnail'] = $thumbnail;
        }

        if ($file = $request->file('poster')) {
            $poster = 'thumb_' . time() . $file->getClientOriginalName();
            if ($liveevent->poster != null) {
                $content = @file_get_contents(public_path() . '/images/events/posters/' . $liveevent->poster);
                if ($content) {
                    unlink(public_path() . "/images/events/posters/" . $liveevent->poster);
                }
            } else {
                $file->move('images/events/posters', $poster);
            }

            $input['poster'] = $poster;
        }

        if ($request->selecturl == "iframeurl") {

            $input['iframeurl'] = $request->iframeurl;
            $input['ready_url'] = null;
            $input['type'] = 'iframeurl';

        } else {

            $input['iframeurl'] = null;
            $input['ready_url'] = $request->ready_url;
            $input['type'] = 'readyurl';

        }

        $liveevent->update($input);

        if ($menus != null) {
            if (count($menus) > 0) {
                if (isset($liveevent->menus) && count($liveevent->menus) > 0) {
                    foreach ($liveevent->menus as $key => $value) {
                        $value->delete();
                    }
                }
                foreach ($menus as $key => $value) {
                    MenuVideo::create([
                        'menu_id' => $value,
                        'live_event_id' => $liveevent->id,
                    ]);
                }
            }
        } else {
            if (isset($liveevent->menus) && count($liveevent->menus) > 0) {
                foreach ($liveevent->menus as $key => $value) {
                    $value->delete();
                }
            }
        }

        return redirect('/admin/liveevent')->with('updated', 'LiveEvent has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $liveevent = LiveEvent::findOrFail($id);

        if ($liveevent->thumbnail != null) {
            $content = @file_get_contents(public_path() . '/images/events/thumbnails/' . $liveevent->thumbnail);
            if ($content) {
                unlink(public_path() . "/images/events/thumbnails/" . $liveevent->thumbnail);
            }
        }
        if ($liveevent->poster != null) {
            $content = @file_get_contents(public_path() . '/images/events/posters/' . $liveevent->poster);
            if ($content) {
                unlink(public_path() . "/images/events/posters/" . $movie->poster);
            }
        }

        $liveevent->delete();

        return back()->with('deleted', 'LiveEvent has been deleted');
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

            $liveevent = LiveEvent::findOrFail($checked);

            if ($liveevent->thumbnail != null) {
                $content = @file_get_contents(public_path() . '/images/events/thumbnails/' . $liveevent->thumbnail);
                if ($content) {
                    unlink(public_path() . "/images/events/thumbnails/" . $liveevent->thumbnail);
                }
            }
            if ($liveevent->poster != null) {
                $content = @file_get_contents(public_path() . '/images/events/posters/' . $liveevent->poster);
                if ($content) {
                    unlink(public_path() . "/images/events/posters/" . $liveevent->poster);
                }
            }

            LiveEvent::destroy($checked);
        }

        return back()->with('deleted', 'LiveEvent has been deleted');
    }

    /**
     * Translate the specified resource from storage.
     * Translate all tmdb movies on one click
     * @return \Illuminate\Http\Response
     */

}
