<?php

namespace App\Http\Controllers\Candidat;

use DateTime;
use App\Models\Vote;
use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EffectuerVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateTime = new DateTime();
        $dateNow = $dateTime->format('Y.m.d H:i:s'); 
        // dd($date);
        //$dateStandard = '2022-02-10 07:00:00';
        //$dateTime->format('j M Y H:i:s');
        //dd($dateStandard );

        $votes = Vote::where('published', '=', '1' )
                        ->where('date_debut', '<=', $dateNow )
                        ->where('date_fin', '>=', $dateNow )
                        ->get();
        //dd($votes);
                           

        //$votes = Vote::all();
        $candidats = Candidat::all();
        return view('candidat.effectuer_vote.index', compact('votes', 'candidats')); 
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
        $users = Auth::user();

        //dd( $users->nomPrenomCiv());
        $vote = Vote::find($request->vote_id);

        session()->put('currentVoteId', $request->vote_id);
        
        $candidat = null;
    
      
        //dd($this->currentVote);
        $candidats = Candidat::all();
        //dd(Candidat::find(1)->name);
        
        $index=$vote->users()->where('user_id', $users->id);
        if($index->exists()){
            $candidatId= $vote->users()->where('user_id', $users->id)->first()->pivot->candidat_id;
            $candidat = Candidat::find($candidatId);
        }
        
       // dd(session()->get('currentVoteId'));

        //$x=$vote->users()->where('user_id', $users->id)->first()->pivot->candidat_id;
        //dd($vote->users());


        $votes = Vote::all();

       
      
        return view('candidat.effectuer_vote.edit', compact('vote','votes', 'candidats','users', 'index', 'candidat')); 
    }

    public function vote(Request $request)
    {
        $users = Auth::user();
        //dd( $users->nomPrenomCiv());
        $votes = Vote::all();
        $candidats = Candidat::all();
     
       $vote = Vote::find(session()->get('currentVoteId'));
       //dd(session()->get('currentVote'));
        
       //$candidatd = $request->id;
       //dd($vote);

       $users->votes()->attach($vote->id, ['candidat_id' => $request->candidatId]); 
       //dd($vote->users()->wherePivot('candidat_id', 4)->get());
       //dd($vote->users()->where('candidat_id', 4)->get());
       //$x=$vote->users()->where('user_id', $users->id)->exists();
       //dd(count($x));
     // dd(($x));

      
     $candidat = null;


     $index=$vote->users()->where('user_id', $users->id);
     //dd($index->exists());
     if($index->exists()){
         
         $candidatId= $vote->users()->where('user_id', $users->id)->first()->pivot->candidat_id;
         $candidat = Candidat::find($candidatId);
        // dd($candidat);
     }

    //  return redirect()->route('electeur.effectuer_vote.edit')->with([
    //     "message"  => "Merci sur votre participation.",
    //     "color"    => "success"
    // ]);

        return view('candidat.effectuer_vote.edit', compact('votes', 'candidats', 'vote','index','users','candidat')); 
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
