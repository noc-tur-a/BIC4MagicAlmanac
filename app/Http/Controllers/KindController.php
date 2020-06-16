<?php

namespace App\Http\Controllers;

use App\Kind;
use Illuminate\Http\Request;

class KindController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kinds = Kind::all()->load('spells');

        return view('kind.index', compact('kinds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kind.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Kind::create($request->validate([
            'name' => 'required',
            'description' => 'required'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function show(Kind $kind)
    {
        return view('kind.show', compact('kind'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function edit(Kind $kind)
    {
        return view('kind.edit', compact('kind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kind $kind)
    {
        if($kind->update($request->validate([
            'name' => 'required',
            'description' => 'required'
        ])))
            return response(['message' => "Kind successfully updated!"], 200)
                ->header('Content-Type', 'application/json');
        else
            abort('500');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kind $kind)
    {
        $kind->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return Kind::all()->load('spells');
    }
}
