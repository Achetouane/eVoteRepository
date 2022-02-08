<?php

namespace App\Http\Controllers\Candidat;

use App\Models\Vote;
use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GererCandidatureController extends Controller
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
        $votes = Vote::all();
//dd($users->email);
        //foreach($candidatss as $candidat1){

           foreach($candidats as $candidat2){
             
               if($users->email=== $candidat2->email)
                
               { 
                
                 return view('candidat.gerer_candidature.index', compact('candidat2', 'votes'));
                 break;
              
               }

                             
              }
              $candidat2 = $users;
            return view('candidat.gerer_candidature.index', compact('candidat2')); 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $votes= Vote::find($id);
        $candidat = Candidat::find($request->candidat_id);

               
        //dd($request->vote_id);
        $candidat->votes()->detach($id); 

        return redirect()->route('candidat.gerer_candidature.index')->with([
            "message" => "Cette candidature a été bien supprimée.",
            "color"   => "success"
        ]);
    }

    public function candidate(Request $request)
    {
        
       // $candidat = Candidat::find($id);
  
        //dd( $voteCandidats );
      //dd($request->vote_id);

 
      $users = Auth::user();
      $candidats = Candidat::all();
      $votes = Vote::all();
//dd($users->email);
      //foreach($candidatss as $candidat1){

         foreach($candidats as $candidat2){
           
             if($users->email=== $candidat2->email)
              
             { 
              
                $voteCandidats =  $candidat2->votes()->get();
                break;
            
             }

                           
            }
           


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
            
            return redirect()->route('candidat.gerer_candidature.index')->with([
                "message"  => "Cette candidature existe dèja",
                "color"    => "danger"
            ]);
        }
       
        $candidat2->votes()->attach($request->vote_id); 
        dd($candidat2);

        return redirect()->route('candidat.gerer_candidature.index')->with([
            "message"  => "Cette candidature a été bien ajoutée",
            "color"    => "success"
            ]);
        
        return view("candidat.gerer_candidature.index", compact('candidat2', 'votes'));
       

    }
}
