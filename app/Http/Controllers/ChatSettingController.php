<?php

namespace App\Http\Controllers;

use App\ChatSetting;
use Illuminate\Http\Request;

class ChatSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $chat = ChatSetting::all();

        return view('admin.chat_setting.index',compact('chat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChatSetting  $chatSetting
     * @return \Illuminate\Http\Response
     */
    public function show(ChatSetting $chatSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChatSetting  $chatSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatSetting $chatSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChatSetting  $chatSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatSetting $chatSetting)
    {
       foreach($request->ids as $key => $k){
            ChatSetting::where('id','=',$key)->update([
                'script' => $k != 'whatsapp' && isset($request->script[$key]) ? $request->script[$key] : NULL,
                'mobile' => $k != 'messanger' && isset($request->mobile[$key]) ? $request->mobile[$key] : NULL,
                'text' => $k != 'messanger' && isset($request->text[$key]) ? $request->text[$key] : NULL,
                'header' => $k != 'messanger' && isset($request->header[$key]) ? $request->header[$key] : NULL,
                'size' => $k != 'messanger' && isset($request->size[$key]) ? $request->size[$key] : NULL,
                'enable_whatsapp' => $k != 'messanger' && isset($request->enable_whatsapp[$key]) ? 1 : 0,
                'enable_messanger' => $k != 'messanger' && isset($request->enable_messanger[$key]) ? 1 : 0,
                'position' => $k != 'messanger' && isset($request->position[$key]) && $request->position[$key] == 'left' ? 1 : 0
            ]); 
        }

        return back()->with('added','Chat settings successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChatSetting  $chatSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatSetting $chatSetting)
    {
        //
    }
}
