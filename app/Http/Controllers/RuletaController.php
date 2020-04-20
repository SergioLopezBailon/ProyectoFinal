<?php

namespace App\Http\Controllers;

use App\Ruleta;
use Illuminate\Http\Request;

class RuletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ruleta.index');
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
     * @param  \App\Ruleta  $ruleta
     * @return \Illuminate\Http\Response
     */
    public function show(Ruleta $ruleta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ruleta  $ruleta
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruleta $ruleta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ruleta  $ruleta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruleta $ruleta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruleta  $ruleta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruleta $ruleta)
    {
        //
    }
}
