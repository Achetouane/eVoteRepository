<?php

namespace App\Http\Controllers\Electeur;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GererCompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        return view('electeur.gerer_compte.index');
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

//dd($validator->fails());
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    

        Auth::user()->update([
            "name"  => $request->name,
            "email"  => $request->email
            
        ]);

        return redirect()->route('electeur.gerer_compte.index')->with([
            "message"  => "Tes modifications sont enregistrés.",
            "color"    => "success"
        ]);
    }

    public function updatePassword(Request $request, $id)
    {

       
        $validator = Validator::make( $request->all(),
        [
            'password' => ['required', 'min:8',],     
            'confirm_password' => ['required', 'min:8','same:password']
        
            
        ],
        [
            "password.required"  => "Le mot de passe est obligatoire.",
            "password.min"  => "Le mot de passe doit avoir minimum 8 caractéres.",
          

            "confirm_password.required"  => "La confirmation de mot passe est obligatoire.",
            "confirm_password.min"  => "Le mot de passe doit avoir minimum 8 caractéres.",
            "confirm_password.same"  => "Le mot de passe doit être le même.",
          
        ]);


        if ($validator->fails())
        {
            
           
            return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->route('electeur.gerer_compte.index')->with([
                "message"  => "Le nouveau mot de passe est incorrect.",
                "color"    => "danger"
            ]);
        }
        //dd($validator->fails()); 
//dd(Auth::user());
        Auth::user()->update([
            "password"  => Hash::make($request->password)
        ]);

        return redirect()->route('electeur.gerer_compte.index')->with([
            "message"  => "Votre mot de passe vient d'être changé.",
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
