<?php

namespace App\Http\Controllers;

use App\Models\Verification;
use App\Http\Requests\StoreVerificationRequest;
use App\Http\Requests\UpdateVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Verification::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field = $request->validate([
        'id_type'=> 'required',
        'id_number'=> 'required',
        'selfie_upload'=> 'required',
        'status'=> 'required',
        'admin_note'=> 'required'
        ]);
        $verify = $request->user()->verify()->create($field);
        return ['verifications' => $verify];
    }

    /**
     * Display the specified resource.
     */
    public function show(Verification $verification)
    {
        return ['verifications' => $verification];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Verification $verification)
    {
        $fields = $request->validate([
            'id_type'=> 'required',
        'id_number'=> 'required',
        'selfie_upload'=> 'required',
        'status'=> 'required',
        'admin_note'=> 'required'
        ]);

        $verification->update($fields);

        return ['verifications' => $verification];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Verification $verification)
    {
        $verification->delete();

        return ['message' => 'The post was deleted'];
    }
}
