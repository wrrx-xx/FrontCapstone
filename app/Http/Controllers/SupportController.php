<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Support::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field = $request -> validate([
        'request_title'=> 'required',
        'request_body'=> 'required',
        'request_status'=> 'required',
        ]);
        $support = $request->user()->requestedBy()->create($field);
        return ['supports' =>  $support];
    }

    /**
     * Display the specified resource.
     */
    public function show(Support $support)
    {
        return  $support;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Support $support)
    {
        $field = $request -> validate([
            'request_title'=> 'required',
            'request_body'=> 'required',
            'request_status'=> 'required',
            ]);
            $support->update($field);
            return ['supports' =>  $support];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Support $support)
    {
        $support->delete();
        return ['message' => 'Support deleted successfully'];
    }
}
