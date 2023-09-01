<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnonceUserRequest;
use App\Http\Requests\UpdateAnnonceUserRequest;
use App\Models\AnnonceUser;

class AnnonceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAnnonceUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnnonceUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnnonceUser  $annonceUser
     * @return \Illuminate\Http\Response
     */
    public function show(AnnonceUser $annonceUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnnonceUserRequest  $request
     * @param  \App\Models\AnnonceUser  $annonceUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnnonceUserRequest $request, AnnonceUser $annonceUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnnonceUser  $annonceUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnonceUser $annonceUser)
    {
        //
    }
}
