<?php

namespace App\Http\Controllers\Admin;

use App\Models\Regle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regles = Regle::all();
        return view("admin.regle.index", compact('regles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.regle.create");
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
            "name"           => ["required", "string", "min:2", "max:255", "unique:regles,name" ],
            "description"   =>   ["required", "string"]
        ],
        [
            "name.required"  => "Le titre est obligatoire.",
            "name.string"    => "Veuillez entrer une chaine de caractéres.",
            "name.min"       => "Veuillez entrer au minimum 2 caractéres.",
            "name.max"       => "Veuillez entrer au maximum 255 caractéres.",
            "name.unique"    => "Ce type d'élection existe déja.",

            "description.required"      => "La description de  la régle est obligatoire.",
            "description.string"        => "Veuillez entrer une chaine de caractéres valide.",
        ]);
        //dd($validator);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Regle::create([
            "name"  => $request->name,
            "description"  => $request->description
        ]);

        return redirect()->route('admin.regle.index')->with([
            "message"  => "Cette régle a été ajoutée avec succèes.",
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
        $regle = Regle::find($id);
        if (empty($regle))
        {
            return redirect()->route('admin.regle.index')->with([
                "message"  => "Cette régle n'esxite pas.",
                "color"    => "warning"
            ]);
        }
        return view('admin.regle.edit', compact('regle'));
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
        $regle = Regle::find($id);

        $validator = Validator::make($request->all(),
        [
            "name"           => ["required", "string", "min:2", "max:255", Rule::unique('regles')->ignore($regle->id) ],
            "description"   =>   ["required", "string"]
        ],
        [
            "name.required"  => "Le titre est obligatoire.",
            "name.string"    => "Veuillez entrer une chaine de caractéres.",
            "name.min"       => "Veuillez entrer au minimum 2 caractéres.",
            "name.max"       => "Veuillez entrer au maximum 255 caractéres.",
            "name.unique"    => "Ce type d'élection existe déja.",

            "description.required"      => "La description de  la régle est obligatoire.",
            "description.string"        => "Veuillez entrer une chaine de caractéres valide.",
        ]);

//dd($validator->fails());
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $regle->slug = null;

        $regle->update([
            "name"  => $request->name,
            "description"  => $request->description
        ]);

        return redirect()->route('admin.regle.index')->with([
            "message"  => "Cette régle de vote vient d'être modifiée.",
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
        $regle = Regle::find($id);
       
               
        if(empty($regle))
        {
            return redirect()->route('admin.regle.index')->with([
                "message" => "Cette régle de vote n'existe pas.",
                "color"   => "warning"
            ]);
        }

      $regle->delete();

        return redirect()->route('admin.regle.index')->with([
            "message" => "Cette régle de vote vient d'être supprimée.",
            "color"   => "success"
        ]);
    }
}
