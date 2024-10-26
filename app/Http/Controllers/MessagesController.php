<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Http\Requests\StoreMessagesRequest;
use App\Http\Requests\UpdateMessagesRequest;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Messages::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field =  $request->validated([
        'inquiry_id'=> 'required',
        'message_body' => 'required',
        ]);
        $message = $request->user()->sender()->create($field);
        return ['messages'=> $message];
    }

    /**
     * Display the specified resource.
     */
    public function show(Messages $messages)
    {
        return $messages;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Messages $messages)
    {
        $field =  $request->validated([
            'inquiry_id'=> 'required',
            'message_body' => 'required',
            ]);
            $messages->update($field);
            return ['messages'=> $messages];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Messages $messages)
    {
        $messages->delete();
        return ['messages'=> $messages];
        
    }
}
