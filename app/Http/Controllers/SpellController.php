<?php

namespace App\Http\Controllers;

use App\Kind;
use App\Spell;
use Illuminate\Http\Request;

class SpellController extends Controller
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

        $spell = Spell::all()->load('kind');

        return view('spell.index', compact('spell'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kinds = Kind::all()->load('spells');

        return view('spell.create', compact('kinds'));
        //return view('spell.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Spell::create($request->validate([
            'name' => 'required',
            'quote' => 'required',
            'description' => 'required',
            //'kind_id' => 'required|exists:App\kind_id'
            'kind_id' => 'required|exists:App\Kind,id'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spell  $spell
     * @return \Illuminate\Http\Response
     */
    public function show(Spell $spell)
    {
        return view('spell.show', compact('spell'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spell  $spell
     * @return \Illuminate\Http\Response
     */
    public function edit(Spell $spell)
    {
        return view('spell.edit', compact($spell));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spell  $spell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spell $spell)
    {
        return $spell->update($request->validate([
            'name' => 'required',
            'quote' => 'required',
            'description' => 'required',
            'kind_id' => 'required|exists:App\Kind,id'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spell  $spell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spell $spell)
    {
        return $spell->delete();
    }


    /**
     * Show form for searching.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Spell $spells)
    {
        $spells = Spell::all()->load('kind');

        return view('spell.search', compact('spells'));
        //$spell = Spell::all()->load('kinds');

        //return view('spell.search', compact('spell'));
        //return view('spell.search');
    }

    /**
     * Return search result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function query(Request $request)
    {
        $search = $request->validate([
            'q' => 'required'
        ])['q'];

        return Invention::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('quote', 'LIKE', "%{$search}%")
            ->orWhereHas('kind', function ($q) use ($search){
                $q  ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->with('kind')
            ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return Spell::all()->load('kind');
    }
}
