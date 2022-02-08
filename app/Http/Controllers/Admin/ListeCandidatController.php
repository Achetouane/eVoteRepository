<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vote;
use App\Models\Partie;
use App\Models\Candidat;
use App\Models\TypeElection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ListeCandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidats = Candidat::paginate(5);

        return view("admin.liste_candidat.index", compact('candidats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parties = Partie::all();
        return view("admin.liste_candidat.create", compact('parties'));
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
            "name"          =>   ["required", "string"],
            "email"         =>   ["required", "email", "unique:candidats,email"],
            "phone"         =>   ["required", "regex:/^[0-9\-\+\s\.\(\)]{6,30}$/", "unique:candidats,phone"],
            "partie_id"     =>   ["required", "numeric", "integer", "exists:parties,id"],
            "image"         =>   ["required", "image"]
            
        ],
        [

            "name.required"            => "Le nom de la partie est obligatoire.",
            "name.string"              => "Veuillez entrer une chaine de caractéres.",
        

            "email.required"            => "L'email est obligatoire.",
            "email.email"               => "Veuillez entrer un email valide.",
            "email.unique"              => "Cet email existe déja.",

            "phone.required"            => "Le numéro de téléphone est obligatoire.",
            "phone.unique"              => "Ce numéro de téléphone déja.",
            "phone.regex"               => "Veuillez entrer un numéro de téléphone valide.",

            "image.required"            => "L'image de la partie est obligatoire.",
            "image.image"               => "Veuillez entrer une image.",
            
            "description.required"      => "La description de  la partie est obligatoire.",
            "description.string"        => "Veuillez entrer une chaine de caractéres valide.",

            "partie_id.required"        =>"La partie est obligatoire",
            "partie_id.numeric"         =>"Veuillez entrer un nombre",
            "partie_id.integer"         =>"Veuillez entrer un entier",
            "partie_id.exists"          =>"Cette partie n'existe pas",
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // On recupère l'image.

        $image = $request->image;

         /**
         * On génére le nom de l'image.
         * L'object étant de le rendre unique
         */ 

        $image_complete_name = time() . "_" . rand(0,999999) . "_" . $image->getClientOriginalName();

        /**
         *  je déplace le fichier qui est image dans le dossier "public/uploads/posts/images/"
         * la méthode move me permet de me placer automatiquement dans le dossier public
         */ 
        $image->move("uploads/candidats/images/", $image_complete_name);

        Candidat::create([
            "name"                   => $request->name,
            "email"                  => $request->email,
            "phone"                  => $request->phone,
            "image"                  => "uploads/candidats/images/" . $image_complete_name,
            "partie_id"              => $request->partie_id,
                    

        ]);

        return redirect()->route('admin.liste_candidat.index')->with([
            "message"  => "Ce Candidat a été ajouté avec succès.",
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
        
        $candidat = Candidat::find($id);
        $parties= Partie::all();
        if(empty($candidat))
        {
            return redirect()->route('admin.liste_candidat.index')->with([
                "message"  => "Ce candidat n'existe pas",
                "color"    => "warning"
            ]);
        }

        return view("admin.liste_candidat.edit", compact('candidat', 'parties'));
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
        
        $candidat = Candidat::find($id);
        //dd($candidat);

        if (empty($candidat))
        {
            return redirect()->route('admin.liste_candidat.index')->with([
                "message"  =>"ce candidat n'existe pas",
                "color"    =>"warning"
            ]);
        }
        $validator = Validator::make($request->all(),
        [
            "name"          =>   ["required", "string"],
            "email"         =>   ["required", "email", Rule::unique('candidats')->ignore($candidat->id)],
            "phone"         =>   ["required", "regex:/^[0-9\-\+\s\.\(\)]{6,30}$/", Rule::unique('candidats')->ignore($candidat->id)],
            "partie_id"     =>   ["required", "numeric", "integer", "exists:parties,id"],
            "image"         =>   ["image"]
            
        ],
        [

            "name.required"            => "Le nom de la partie est obligatoire.",
            "name.string"              => "Veuillez entrer une chaine de caractéres.",
           

            "email.required"            => "L'email est obligatoire.",
            "email.email"               => "Veuillez entrer un email valide.",
            "email.unique"              => "Cet email existe déja.",

            "phone.required"            => "Le numéro de téléphone est obligatoire.",
            "phone.unique"              => "Ce numéro de téléphone déja.",
            "phone.regex"               => "Veuillez entrer un numéro de téléphone valide.",

            "image.image"               => "Veuillez entrer une image.",
            
            "description.required"      => "La description de  la partie est obligatoire.",
            "description.string"        => "Veuillez entrer une chaine de caractéres valide.",

            "partie_id.required"        =>"La partie est obligatoire",
            "partie_id.numeric"         =>"Veuillez entrer un nombre",
            "partie_id.integer"         =>"Veuillez entrer un entier",
            "partie_id.exists"          =>"Cette partie n'existe pas",
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $candidat->slug = null;
        if ($request->image)
        {
            $path = parse_url($candidat->image);
            File::delete(public_path($path['path']));

            $image = $request->image;

        $image_complete_name = time() . "_" . rand(0,999999) . "_" . $image->getClientOriginalName();

        $image->move("uploads/candidats/images/", $image_complete_name);
        $candidat->update([
                "name"                   => $request->name,
                "email"                  => $request->email,
                "phone"                  => $request->phone,
                "image"                  => "uploads/candidats/images/" . $image_complete_name,
                "partie_id"              => $request->partie_id,    
        ]);
        }
        else
        {   
            $candidat->update([
                
                
                "name"                   => $request->name,
                "email"                  => $request->email,
                "phone"                  => $request->phone,
                "partie_id"              => $request->partie_id,
            ]);
        }

        return redirect()->route('admin.liste_candidat.index')->with([
            "message"  => "Ce candidat a été bien modifiée.",
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
        $candidat = Candidat::find($id);
       
               
        if(empty($candidat))
        {
            return redirect()->route('admin.liste_candidat.index')->with([
                "message" => "Ce candidat n'existe pas.",
                "color"   => "warning"
            ]);
        }


        $candidat->votes()->detach(); 

        $candidat->delete();

        return redirect()->route('admin.liste_candidat.index')->with([
            "message" => "Ce candidat a été bien supprimé.",
            "color"   => "success"
        ]);
    }

    

    public function details($id)
    {
        $votes = Vote::all();


        $candidat = Candidat::find($id);
        $parties= Partie::all();
        if(empty($candidat))
        {
            return redirect()->route('admin.liste_candidat.index')->with([
                "message"  => "Ce candidat n'existe pas",
                "color"    => "warning"
            ]);
        }

        return view("admin.liste_candidat.details", compact('candidat', 'votes'));
    }

    
    
    //--------------------------------------candidater----------------------------------

    public function candidate(Request $request, $id)
    {
        $votes = Vote::all();
        $candidat = Candidat::find($id);
        $voteCandidats =  $candidat->votes()->get();
        //dd( $voteCandidats );
      //dd($request->vote_id);

        $idvote = $request->vote_id;
        $exist =false;

        foreach ($voteCandidats as $voteCandidat){
            if( $voteCandidat->id == $idvote){

                $exist = true;

                break;

            }
        }

        if($exist)
        {
            
            return redirect()->route('admin.liste_candidat.details', [$id])->with([
                "message"  => "Cette candidature existe dèja",
                "color"    => "danger"
            ]);
        }

        // return redirect()->route('admin.liste_candidat.details', [$id])->with([
        //     "message"  => "Cette candidature a été bien ajoutée",
        //     "color"    => "success"
        // ]);

     //dd($exist);
       
        $candidat->votes()->attach($request->vote_id); 
        
    
       
        return redirect()->route('admin.liste_candidat.details', [$id])->with([
            "message"  => "Cette candidature a été bien ajoutée",
            "color"    => "success"
            ]);

             return view("admin.liste_candidat.details", compact('candidat', 'votes'));   

    }
    //----------------------------dstroyCandidats-------------------------

    public function destroyCandidate(Request $request, $id){
        $votes= Vote::find($id);
        $candidat = Candidat::find($request->candidat_id);

               
        //dd($request->vote_id);
        $candidat->votes()->detach($id); 

        return redirect()->route('admin.liste_candidat.details', [$request->candidat_id])->with([
            "message" => "Cette candidature a été bien supprimée.",
            "color"   => "success"
        ]);
    }
}


