<?php

namespace App\Http\Controllers;

use App\Genre;
use Avatar;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $genres = \DB::table('genres')->select('id', 'name', 'image', 'created_at', 'updated_at')->orderBy('position', 'ASC')->get();

        if ($request->ajax()) {
            return \Datatables::of($genres)
                ->setRowAttr([
                    'data-id' => function ($genre) {
                        return $genre->id;
                    },
                ])
                ->setRowClass('row1')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($genre) {
                    $html = '<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $genre->id . '" id="checkbox' . $genre->id . '">
                    <label for="checkbox' . $genre->id . '" class="material-checkbox"></label>
                  </div>';

                    return $html;
                })
                ->addColumn('sort', function ($genre) {
                    return '<i class="fa fa-sort"></i>';
                })
                ->addColumn('name', function ($genre) {

                    return substr($genre->name, 7, -2);

                })
                ->addColumn('image', function ($genre) {

                    $photo = @file_get_contents('images/genre/' . $genre->image);

                    if ($photo) {
                        $image = '<img  src="' . url("images/genre/" . $genre->image) . '" width="70px" height="70px"/>';
                    } else {
                        $image = '<img width="70px" height="70px" src="' . Avatar::create($genre->name)->toBase64() . '"/>';
                    }
                    return $image;

                })->addColumn('created_at', function ($genre) {
                // $datetime = Carbon::parse($genre->created_at);
                 return date('F d, Y',strtotime($genre->created_at));
                 // return $datetime->diffForHumans();
                  // return $datetime;

            })
                ->addColumn('updated_at', function ($genre) {
                    // $datetime = Carbon::parse($genre->updated_at);
                  return date('F d, Y',strtotime($genre->updated_at));
                    // return $datetime->diffForHumans();
                   // return $datetime;

                })

                ->addColumn('action', function ($genre) {
                    $btn = ' <div class="admin-table-action-block">

                    <a href="' . route('genres.edit', $genre->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $genre->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $genre->id . '" class="delete-modal modal fade" role="dialog">
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
                      <form method="POST" action="' . route("genres.destroy", $genre->id) . '">
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
                ->rawColumns(['checkbox', 'sort', 'name', 'image', 'created_at', 'action', 'updated_at'])
                ->make(true);
        }

        //$genres = Genre::all();
        //$uname  = Genre::distinct()->get(['id','name','created_at','updated_at']);
        //$genres =  DB::table('genres')->select('id','name','created_at','updated_at')->distinct()->get();
        return view('admin.genre.index', compact('genre', 'uname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genre.create');
    }

    public function sort(Request $request)
    {

        $posts = Genre::all();

        foreach ($posts as $post) {

            foreach ($request->order as $order) {

                if ($order['id'] == $post->id) {

                    \DB::table('genres')->where('id', $post->id)->update(['position' => $order['position']]);

                }
            }
        }

        return response()->json('Update Successfully.', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:genres,name',
        ]);

        try {

            $input = $request->all();
            //return $input;
            if ($file = $request->file('image')) {

                $name = "genre_" . time() . $file->getClientOriginalName();
                $file->move('images/genre', $name);
                $input['image'] = $name;
            }

            $input['position'] = (Genre::count() + 1);
            //return $input;
            Genre::create($input);
            return back()->with('added', 'Genre has been created');

        } catch (\Exception $e) {

            return back()->with('deleted', 'Genre already Exist');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
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
        $genre = Genre::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:genres,name,' . $genre->id,
        ]);

        try {

            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = "genre_" . time() . $file->getClientOriginalName();
                if ($genre->image != null) {
                    $content = @file_get_contents(public_path() . '/images/genre/' . $genre->image);
                    if ($content) {
                        unlink(public_path() . "/images/genre/" . $genre->image);
                    }
                   
                      
                }
                $file->move('images/genre', $name);
                  
                 $input['image'] = $name;
              
            }

            $genre->update($input);
            return redirect('admin/genres')->with('updated', 'Genre has been updated');

        } catch (\Exception $e) {

            return back()->with('deleted', 'Genre already exist');
        }

    }

    public function updateAll()
    {
        if (Session::has('genre_changed')) {
            return back();
        }
        $all = DB::table('genres')->get();
        foreach ($all as $key => $value) {
            $get_genre = Genre::findOrFail($value->id);
            $get_genre->update([
                'name' => $value->name,
            ]);
        }
        Session::put('genre_changed', 'changed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        if ($genre->image != null) {
            $content = @file_get_contents(public_path() . '/images/genre/' . $genre->image);
            if ($content) {
                unlink(public_path() . "/images/genre/" . $genre->image);
            }
        }
        $genre->delete();
        return redirect('admin/genres')->with('deleted', 'Genre has been deleted');
    }

    public function bulk_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checked' => 'required',
        ]);

        if ($validator->fails()) {

            return back()->with('deleted', 'Please select one of them to delete');
        }

        foreach ($request->checked as $checked) {

            $genre = Genre::findOrFail($checked);
            if ($genre->image != null) {
                $content = @file_get_contents(public_path() . '/images/genre/' . $genre->image);
                if ($content) {
                    unlink(public_path() . "/images/genre/" . $genre->image);
                }
            }

            Genre::destroy($checked);
        }

        return back()->with('deleted', 'Genres has been deleted');
    }
}
