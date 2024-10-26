<?php

namespace App\Http\Controllers;

use App\Models\Inquiries;
use App\Http\Requests\StoreInquiriesRequest;
use App\Http\Requests\UpdateInquiriesRequest;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inquiries::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field = $request -> validate([
            'listing_id' => 'required',
            'inquiry_status' => 'required'
        ]);
        $inquiry = Inquiries::create($field);
        return ['inquiries' =>  $inquiry];
    }

    /**
     * Display the specified resource.
     */
    public function show(Inquiries $inquiries)
    {
        return  $inquiries;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inquiries $inquiries)
    {
        $field = $request -> validate([
            'listing_id' => 'required',
            'inquiry_status' => 'required'
        ]);
        $inquiries->update($field);
        return ['inquiries' =>  $inquiries];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inquiries $inquiries)
    {
        $inquiries->delete();
        return ['message' => 'Inquiry deleted successfully'];
    }
}
