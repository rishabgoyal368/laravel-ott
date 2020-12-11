<?php

namespace App\Http\Controllers;

//use App\Movie;
use App\MovieComment;
use App\MovieSubcomment;
use Auth;
use Illuminate\Http\Request;

class TVCommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {

        if (!is_null($request->email)) {
            $email = $request->email;
        } else {
            $email = Auth::user()->email;
        }

        $input = $request->all();
        $input['tv_series_id'] = $id;
        $input['user_id'] = Auth::user()->id;
        $input['name'] = Auth::user()->name;
        $input['email'] = $email;
        $data = MovieComment::create($input);

        return back()->with('added', 'Your Comment has been added');

    }

    public function reply(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $input = $request->all();
        $input['comment_id'] = $id;
        $input['user_id'] = $user_id;
        $data = MovieSubcomment::create($input);
        return back()->with('added', 'Your reply has been added');
    }

    public function deletecomment($id)
    {

        $comment_delete = MovieComment::findOrFail($id);
        if (isset($comment_delete->subcomment)) {
            foreach ($comment_delete->subcomment as $sub) {
                $sub->delete();
            }
        }

        $comment_delete->delete();
        return back()->with('deleted', 'Comment has been deleted');
    }

    public function deletesubcomment($cid)
    {
        $subcomment = MovieSubcomment::findOrFail($cid);
        $subcomment->delete();
        return back()->with('SubComment has been deleted');
    }

}
