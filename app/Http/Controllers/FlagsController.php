<?php

namespace App\Http\Controllers;

use App\Models\Flags;

use Illuminate\Http\Request;

class FlagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Flags::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field = $request->validate([
        'listing_id'=>'required',
        'flag_reason'=>'required',
        'flag_status'=>'required',
        'flag_admin_note'
        ]);
        $flag = $request->user()->flag()->create($field);

        return ['Flags' => $flag];
    }

    /**
     * Display the specified resource.
     */
    public function show(Flags $flags)
    {
        return  $flags;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flags $flag)
    {
        $fields = $request->validate([
            'listing_id'=>'required',
        'flag_reason'=>'required',
        'flag_status'=>'required',
        'flag_admin_note'=>'required'
            ]);
            $flag ->update($fields);
            return ['flags' => $flag];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flags $flags)
    {
        $flags->delete();
        return ['message' => 'Flag deleted'];
    }
}
