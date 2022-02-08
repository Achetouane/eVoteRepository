<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vote;
use App\Models\TypeElection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votes = Vote::paginate(5);
   
        return view("admin.vote.index", compact('votes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_elections = TypeElection::all();
        return view('admin.vote.create', compact('type_elections'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            "name"                       => ["required", "string", "max:255", "unique:votes,name"],
            "type_election_id"           => ["required", "numeric", "integer", "exists:type_elections,id"]
        ],
       
        [
            "name.required"  => "Le titre est obligatoire.",
            "name.string"    => "Veuillez entrer une chaine de caractéres.",
            "name.max"       => "Veuillez entrer un maximum de 255 caractères.",
            "name.unique"    => "Ce vote existe déja.",

            "type_election_id.required"  =>"Le type d'élection est obligatoire",
            "type_election_id.numeric"   =>"Veuillez entrer un nombre",
            "type_election_id.integer"   =>"Veuillez entrer un entier",
            "type_election_id.exists"    =>"Ce type d'élection n'existe pas",
        ]);
 //dd($validator);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Vote::create([
            "name"                   => $request->name,
            "type_election_id"       =>$request->type_election_id,
            "date_debut"             => $request->date_debut,
            "date_fin"               => $request->date_fin,

        ]);

        return redirect()->route('admin.vote.index')->with([
            "message"  => "Ce vote a été ajouté avec succès.",
            "color"    => "success"
        ]);

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
    public function edit($id)
    {
        $vote = Vote::find($id);
        $type_elections= TypeElection::all();
        if(empty($vote))
        {
            return redirect()->route('admin.vote.index')->with([
                "message"  => "Ce vote n'existe pas",
                "color"    => "warning"
            ]);
        }

        return view("admin.vote.edit", compact('vote', 'type_elections'));
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

        $vote = Vote::find($id);

        if (empty($vote))
        {
            return redirect()->route('admin.vote.index')->with([
                "message"  =>"ce vote n'existe pas",
                "color"    =>"warning"
            ]);
        }

        $validator = Validator::make($request->all(),
        [
            "name"                       => ["required", "string", "max:255", Rule::unique('votes')->ignore($vote->id)],
            "type_election_id"           => ["required", "numeric", "integer", "exists:type_elections,id"]
        ],
       
        [
            "name.required"  => "Le titre est obligatoire.",
            "name.string"    => "Veuillez entrer une chaine de caractéres.",
            "name.max"       => "Veuillez entrer un maximum de 255 caractères.",

            "type_election_id.required"  =>"Le type d'élection est obligatoire",
            "type_election_id.numeric"   =>"Veuillez entrer un nombre",
            "type_election_id.integer"   =>"Veuillez entrer un entier",
            "type_election_id.exists"    =>"Ce type d'élection n'existe pas",
        ]);
 
        
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $vote->slug = null;
        
        $vote->update([
            "name"                   => $request->name,
            "type_election_id"       => $request->type_election_id,
            "date_debut"             => $request->date_debut,
            "date_fin"               => $request->date_fin

        ]);

        return redirect()->route('admin.vote.index')->with([
            "message"  =>"Le vote vient d'être modifié",
            "color"    =>"success"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function destroy($id)
    {
         
        $vote = Vote::find($id);

        if(empty($vote))
        {
            return redirect()->route('admin.vote.index')->with([
                "message" => "Ce Vote n'existe pas.",
                "color"   => "warning"
            ]);
        }
     
        $vote->candidats()->detach(); 
        
        $vote->delete();

        return redirect()->route('admin.vote.index')->with([
            "message" => "Ce vote a été bien supprimé.",
            "color"   => "success"
        ]);
    }

    Public function published(Request $request, $id)
    {
        $vote = Vote::find($id);

        if (empty($vote))
        {
            return redirect()->route('admin.vote.index')->with([
                "message"  =>"ce vote n'existe pas",
                "color"    =>"warning"
            ]);
        }

        if($request->has('published'))
        {
            $vote->update([
                "published"  =>true,
                "published_at" => now(),
            ]);

            return redirect()->route('admin.vote.index')->with([
                "message"  =>"ce vote vient d'être publié",
                "color"    =>"success"
            ]);
        }


        $vote->update([
            "published"  =>false,
            "published_at" => null,
        ]);

        return redirect()->route('admin.vote.index')->with([
            "message"  =>"ce vote vient d'être retiré de la liste des publications",
            "color"    =>"success"
        ]);
    }
       
}
