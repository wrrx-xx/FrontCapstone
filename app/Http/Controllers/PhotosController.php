<?php

namespace App\Http\Controllers;

use App\Models\Photos;
use App\Http\Requests\StorePhotosRequest;
use App\Http\Requests\UpdatePhotosRequest;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Photos $photos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotosRequest $request, Photos $photos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photos $photos)
    {
        //
    }
}
