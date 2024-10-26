<?php

namespace App\Http\Controllers;

use App\Models\SupportMessages;
use App\Http\Requests\StoreSupportMessagesRequest;
use App\Http\Requests\UpdateSupportMessagesRequest;
use Illuminate\Http\Request;

class SupportMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        SupportMessages::all();
        return view('message.message');
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field =  $request->validate([
            'support_id'=> 'required',
            'support_message' =>  'required',
        ]);
        $suppmess = $request->user()->suppId()->create($field);
        return ['support_messages' =>  $suppmess];
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportMessages $supportMessages)
    {
        return $supportMessages;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupportMessages $supportMessages)
    {
        $field =  $request->validate([
            'support_id'=> 'required',
            'support_message' =>  'required',
        ]);
        $supportMessages->update($field);
        return ['support_messages' =>  $supportMessages];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportMessages $supportMessages)
    {
        $supportMessages->delete();
        return ['message' => 'Support Message deleted'];
    }
}
