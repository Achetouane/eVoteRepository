<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vote;
use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatistiquesController extends Controller
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
        return view('admin.statistiques.index', compact('votes', 'candidats')); 
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
        //dd($users);
        //$vote = Vote::find($request->vote_id);
        session()->put('currentVoteId', $request->vote_id);
        $vote = Vote::find(session()->get('currentVoteId'));
       // dd($vote);
       // $candidats = Candidat::all();

        // $villes = array(
        //     'Fontainebleau' => 77,
        //     'Paris' => 75,
        //     'Lyon' => 69
        //  );
        //  dd($villes);

        //$index=$vote->users()->where('user_id', $users->id);
       // $candidatId= $vote->users()->where('user_id', $users->id)->first()->pivot->candidat_id;
        //dd($vote->users()->with('candidat_id'));
        //dd(count($vote->users()->where('candidat_id', 1)->get()));
         //dd($vote->users()->get());
         //dd($vote->users()->get('candidat_id'));
         //dd($vote->users()->get());
         
         $resultats = \DB::table('user_vote')->where('vote_id', '=', $vote->id )
                                                ->groupBy('candidat_id')
                                                ->selectRaw('count(*) as total, candidat_id')
                                                ->orderBy( 'total', 'desc')
                                                ->get();

                                               
        $electeurs=count($vote->users()->get())   ;                            
        //dd($resultats);                        
        $candidats=array();

        //  foreach($resultats as $resultat)
        //  {
        //     $g=$resultat->candidat_id;
        //     array_push($candidats, Candidat::find($g));
            
        //  }
        $taux = array();
        $colors= array();
         foreach($resultats as $resultat)
         {
            $candidatId=$resultat->candidat_id;
            $tau=round($resultat->total/$electeurs*100, 2);
            array_push($candidats, Candidat::find($candidatId)->name);
            array_push($taux,$tau);
            $color='rgba('.rand(0,255).', '.rand(0,255).', '.rand(0,255).', 0.73)';
            array_push($colors,$color);
 
         }

    //     //$listeElecteur = $vote->users;
    //dd($colors);
     //dd($taux);
      
        //dd($vote->candidats); 

        // foreach($vote->users as $user){
        // dd($user->name); 
        // }


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
        $classement= 0;
        return view('admin.statistiques.edit', compact('vote','votes', 'candidats','colors','taux')); 
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
