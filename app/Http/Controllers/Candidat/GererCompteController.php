<?php

namespace App\Http\Controllers\Candidat;

use App\Models\User;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GererCompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();
        $candidats = Candidat::all();
//dd($users->email);
        //foreach($candidatss as $candidat1){

           foreach($candidats as $candidat2){
             
               if($users->email=== $candidat2->email)
                
               { 
                
                 return view('candidat.gerer_compte.index', compact('candidat2'));
              
               }
               
               
                
             

               
                             
              }
              $candidat2 = $users;
                 return view('candidat.gerer_compte.index', compact('candidat2')); 
         // }

        
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
    public function edit($id)
    {
        //
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
        $users = User::find($id);
        //dd($users->email);
        $validator = Validator::make($request->all(),
        [
            "name"           => ["required", "string", "min:2", "max:255" ],
            "email"           => ["required","email", Rule::unique('users')->ignore($users->id) ]
        ],
        [
            "name.required"  => "Le nom est obligatoire.",
            "email.required"  => "L'email est obligatoire.",
            "email.email"    => "Veuillez entrer un e-mail valide"
        
        ]);

        //$candidatss = Auth::user()->where('role', 'candidat')->get();
        $candidats = Candidat::all();

        //foreach($candidatss as $candidat1){

           foreach($candidats as $candidat2){
             
               if($users->email == $candidat2->email)
                
               { 
                   
                 
                   $candidat2->update([
                  "name"      => $request->name,
                  "email"     => $request->email,
                  "phone"     => $request->phone,
                  
              ]);
              
               }
                             
              //}
          }

//dd($validator->fails());
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    

        Auth::user()->update([
            "name"  => $request->name,
            "email"  => $request->email
            
        ]);

        

        


        return redirect()->route('candidat.gerer_compte.index')->with([
            "message"  => "Tes modifications sont enregistrés.",
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
        //
    }
}
