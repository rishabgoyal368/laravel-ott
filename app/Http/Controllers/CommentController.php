<?php

namespace App\Http\Controllers;

//use App\Movie;
use App\Comment;
use App\Subcomment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        // return $request;

        $request->validate([
            'name' => 'required',

            'comment' => 'required',

        ]);
        if (!is_null($request->email)) {
            $email = $request->email;
        } else {
            $email = Auth::user()->email;
        }

        $input = $request->all();
        $input['blog_id'] = $id;
        $input['email'] = $email;
        $input['user_id'] = Auth::user()->id;
        $data = Comment::create($input);

        return back()->with('added', 'Your Comment has been added');

    }

    public function reply(Request $request, $id, $bid)
    {

        $request->validate([

            'reply' => 'required',

        ]);
        $user_id = Auth::user()->id;
        $input = $request->all();
        $input['comment_id'] = $id;
        $input['blog_id'] = $bid;
        $input['user_id'] = $user_id;
        $data = Subcomment::create($input);
        return back()->with('added', 'Your reply has been added');
    }

    public function deletecomment($id)
    {

        $comment_delete = Comment::findOrFail($id);
        if (isset($comment_delete->subcomments)) {
            foreach ($comment_delete->subcomments as $sub) {
                $sub->delete();
            }
        }

        $comment_delete->delete();
        return back()->with('deleted', 'Comment has been deleted');
    }

    public function deletesubcomment($bid)
    {
        $subcomment = Subcomment::findOrFail($bid);
        $subcomment->delete();
        return back()->with('SubComment has been deleted');
    }

}
