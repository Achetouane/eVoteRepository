<?php

namespace App\Http\Controllers\Admin;

use App\Models\TypeElection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TypeElectionController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $type_elections = TypeElection::paginate(5);

        return view("admin.type_election.index", compact('type_elections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.type_election.create");
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
            "name"           => ["required", "string", "min:2", "max:255", "unique:type_elections,name" ]
        ],
        [
            "name.required"  => "Le titre est obligatoire.",
            "name.string"    => "Veuillez entrer une chaine de caractéres.",
            "name.min"       => "Veuillez entrer au minimum 2 caractéres.",
            "name.max"       => "Veuillez entrer au maximum 255 caractéres.",
            "name.unique"    => "Ce type d'élection existe déja."
        ]);
        //dd($validator);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        TypeElection::create([
            "name"  => $request->name
        ]);

        return redirect()->route('admin.type_election.index')->with([
            "message"  => "Ce type d'élection a été ajouté avec succès.",
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
        $type_election = TypeElection::find($id);
        if (empty($type_election))
        {
            return redirect()->route('admin.type_election.index')->with([
                "message"  => "Ce type d'élection n'esxite pas.",
                "color"    => "warning"
            ]);
        }
        return view('admin.type_election.edit', compact('type_election'));
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

        $type_election = TypeElection::find($id);
        

        $validator = Validator::make($request->all(),
        [
            "name"           => ["required", "string", "min:2", "max:255", Rule::unique('type_elections')->ignore($type_election->id) ]
        ],
        [
            "name.required"  => "Le titre est obligatoire.",
        
        ]);

//dd($validator->fails());
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $type_election->slug = null;

        $type_election->update([
            "name"  => $request->name
        ]);

        return redirect()->route('admin.type_election.index')->with([
            "message"  => "Ce type d'élection vient d'être modifié.",
            "color"    => "success"
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
        $type_election = TypeElection::find($id);
       
               
        if(empty($type_election))
        {
            return redirect()->route('admin.type_election.index')->with([
                "message" => "Ce type d'élection n'existe pas.",
                "color"   => "warning"
            ]);
        }


        $votes = $type_election->votes()->get();

        foreach ($votes as $vote)
        {
            $vote->delete();
        }

        $type_election->delete();

        return redirect()->route('admin.type_election.index')->with([
            "message" => "Ce type d'élection a été bien supprimé.",
            "color"   => "success"
        ]);


    }
}


