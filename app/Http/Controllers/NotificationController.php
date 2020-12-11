<?php

namespace App\Http\Controllers;

use App\Director;
use App\Notifications\MyNotification;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Notification;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors = Director::all();
        return view('admin.director.index', compact('directors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required',
        ]);
        if ($request->movie_id == "" && $request->tv_id == "" && $request->livetv == "") {

            $request->validate([
                'movie_id' => 'required',
                'tv_id' => 'required',
                'livetv' => 'required',
            ],
                [
                    'movie_id.required' => 'Please select at least one',
                    'tv_id.required' => 'Please select at least one tv series',
                    'livetv.required' => 'Please select at least one livetv',
                ]);
            return back()->with('deleted', 'Notification has not been Sent. Please select atleast one movie,tvserie and live tv.');
        } else {

            $user = User::all();
            $input = $request->all();

            $title = $request->title;
            $desc = $request->description;
            if ($request->movie_id != "") {
                $movie_id = $request->movie_id;
            } else {
                $movie_id = $request->livetv;
            }

            $tvid = $request->tv_id;

            $alluser[] = $input['user_id'];

            if (in_array("0", $input['user_id'])) {

                foreach ($user as $key => $value) {
                    $alluser[] = $value->id;
                    User::find($value->id)->notify(new MyNotification($title, $desc, $movie_id, $tvid, $alluser));

                }
                array_shift($alluser);
                $input['user_id'] = $alluser;

            } else {

                foreach ($input['user_id'] as $singleuser) {
                    User::find($singleuser)->notify(new MyNotification($title, $desc, $movie_id, $tvid, $alluser));
                }
                $input['user_id'] = $alluser;
            }

            return back()->with('added', 'Notification has been Sent');
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

    public function sendNotification()
    {
        $user = User::first();

        $details = [
            'title' => 'title',
            'description' => 'description',

        ];

        Notification::send($user, new MyNotification($details));
        return back()->with('added', 'Notification is Sent');

    }

    public function notificationread($id)
    {

        $userunreadnotification = auth()->
            user()->unreadNotifications->
            where('id', $id)->first();

        if ($userunreadnotification) {
            $userunreadnotification->markAsRead();
        }

        return 'Done';

    }

}
