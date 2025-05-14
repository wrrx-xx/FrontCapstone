<?php

namespace App\Http\Controllers;

use App\Models\SupportMessages;
use App\Http\Requests\StoreSupportMessagesRequest;
use App\Http\Requests\UpdateSupportMessagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load support conversations for the logged-in user (tenant)
        $user = Auth::user();
        // Filter by sender_id instead of user_id
        $conversations = SupportMessages::where('sender_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('message.message', compact('conversations'));
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
        $field['sender_id'] = $request->user()->id;
        $suppmess = SupportMessages::create($field);
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
