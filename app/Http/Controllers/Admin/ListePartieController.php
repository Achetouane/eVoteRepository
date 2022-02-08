<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ListePartieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Partie::paginate(5);
        return view("admin.liste_partie.index", compact('parties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parties = Partie::all();
        return view("admin.liste_partie.create", compact('parties'));
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
            "name"          =>   ["required", "string", "unique:parties,name"],
            "email"         =>   ["required", "email", "unique:parties,email"],
            "phone"         =>   ["required", "regex:/^[0-9\-\+\s\.\(\)]{6,30}$/", "unique:parties,phone"],
            "image"         =>   ["required", "image"],
            "description"   =>   ["required", "string"]

        ],
        [

            "name.required"            => "Le nom de la partie est obligatoire.",
            "name.string"              => "Veuillez entrer une chaine de caractéres.",
            "name.unique"              => "Ce nom de partie existe déja.",

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
        $image->move("uploads/parties/images/", $image_complete_name);

        Partie::create([
            "name"                   => $request->name,
            "email"                  =>$request->email,
            "phone"                  => $request->phone,
            "image"                  => "uploads/parties/images/" . $image_complete_name,
            "description"            => $request->description           

        ]);

        return redirect()->route('admin.liste_partie.index')->with([
            "message"  => "Cette partie a été ajoutée avec succès.",
            "color"    => "success"
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function show()
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
        $partie = Partie::find($id);
        if(empty($partie))
        {
            return redirect()->route('admin.liste_partie.index')->with([
                "message"  => "Cette partie n'existe pas",
                "color"    => "warning"
            ]);
        }
        return view("admin.liste_partie.edit", compact('partie'));
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
        $partie = Partie::find($id);
        
        if (empty($partie))
        {
            return redirect()->route('admin.vote.index')->with([
                "message"  =>"cette partie n'existe pas",
                "color"    =>"warning"
            ]);
        }

        $validator = Validator::make($request->all(),
        [
            "name"          =>   ["required", "string", Rule::unique('parties')->ignore($partie->id)],
            "email"         =>   ["required", "email", Rule::unique('parties')->ignore($partie->id)],
            "phone"         =>   ["required", "regex:/^[0-9\-\+\s\.\(\)]{6,30}$/", Rule::unique('parties')->ignore($partie->id)],
            "image"         =>   ["image"],
            "description"   =>   ["required", "string"]

        ],
        [

            "name.required"            => "Le nom de la partie est obligatoire.",
            "name.string"              => "Veuillez entrer une chaine de caractéres.",
            "name.unique"              => "Ce nom de partie existe déja.",

            "email.required"            => "L'email est obligatoire.",
            "email.email"               => "Veuillez entrer un email valide.",
            "email.unique"              => "Cet email existe déja.",

            "phone.required"            => "Le numéro de téléphone est obligatoire.",
            "phone.unique"              => "Ce numéro de téléphone déja.",
            "phone.regex"               => "Veuillez entrer un numéro de téléphone valide.",

            "image.image"               => "Veuillez entrer une image.",
            
            "description.required"      => "La description de  la partie est obligatoire.",
            "description.string"        => "Veuillez entrer une chaine de caractéres valide.",
        ]);

    
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $partie->slug = null;
        if ($request->image)
        {
            $path = parse_url($partie->image);
            File::delete(public_path($path['path']));

            $image = $request->image;

        $image_complete_name = time() . "_" . rand(0,999999) . "_" . $image->getClientOriginalName();

        $image->move("uploads/parties/images/", $image_complete_name);

        $partie->update([
            "name"                   =>$request->name,
            "email"                  =>$request->email,
            "phone"                  => $request->phone,
            "image"                  => "uploads/parties/images/" . $image_complete_name,
            "description"            => $request->description           

        ]);
        }
        else
        {   
            $partie->update([
                "name"                   => $request->name,
                "email"                  => $request->email,
                "phone"                  => $request->phone,
                "description"            => $request->description           
            ]);
        }

        return redirect()->route('admin.liste_partie.index')->with([
            "message"  => "Cette partie a été bien modifiée.",
            "color"    => "success"
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $partie = Partie::find($id);


        if(empty($partie))
        {
            return redirect()->route('admin.liste_partie.index')->with([
                "message" => "Cette partie n'existe pas.",
                "color"   => "warning"
            ]);
        }
        
      

            $candidats = $partie->candidats()->get();

            foreach ($candidats as $candidat)
            {
                $candidat->delete();
                $candidat->votes()->detach();
            }

         $path = parse_url($partie->image);
            File::delete(public_path($path['path']));
       
        $partie->delete([
            "name"                   => $request->name,
            "email"                  => $request->email,
            "phone"                  => $request->phone,
            "description"            => $request->description   ,    
            ]);
   

        return redirect()->route('admin.liste_partie.index')->with([
            "message" => "Cette partie a été bien supprimée.",
            "color"   => "success"
        ]);
    }
}
