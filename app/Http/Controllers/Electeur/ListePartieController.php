<?php

namespace App\Http\Controllers\Electeur;

use App\Models\Vote;
use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListePartieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votes = Vote::all();
        $candidats = Candidat::all();
        return view('electeur.liste_partie.index', compact('votes', 'candidats')); 
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
         //$users = Auth::user();
         $vote = Vote::find($request->vote_id);
         //dd($vote);
         $candidats = Candidat::all();
       
         //dd($vote->candidats); 
 
        //$ff=$users->votes()->get();
         $votes = Vote::all();
        //dd($users->votes); 
         //foreach($users->votes as $vote){
         //dd($vote->name); 
         //}
         
         //$vote->candidats()->attach($request->vote_id);
      
 
         // if (empty($))
         // {
         //     return redirect()->route('admin.type_election.index')->with([
         //         "message"  => "Ce type d'élection n'esxite pas.",
         //         "color"    => "warning"
         //     ]);
         // }
         
         return view('electeur.liste_partie.edit', compact('vote','votes', 'candidats')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
