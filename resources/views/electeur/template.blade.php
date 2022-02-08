@extends('layouts.app_electeur')

@section('content')
    <div class="row">
        <div class="sidebar col-md-2 bg-evote text-center mt-3">
            <ul class="list-group">
                <li class="list-group-item bg-evote" ><a href="{{ route('electeur.index') }}" 
                   class="text-decoration-none ">Accueil</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('electeur.effectuer_vote.index') }}" 
                   class="text-decoration-none ">Effectuer un vote</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('electeur.gerer_compte.index') }}" 
                   class="text-decoration-none ">Gérer mon compte</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('electeur.liste_candidat.index') }}" 
                   class="text-decoration-none ">Liste des candidats</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('electeur.liste_partie.index') }}" 
                    class="text-decoration-none ">Liste des parties</a></li>
                <li class="list-group-item bg-evote" ><a href="{{ route('electeur.statistiques.index') }}" 
                    class="text-decoration-none ">Statistiques</a></li>
           </ul>
        </div>
        <div class="col-md-10">
            @yield('mycontent')
        </div>
    </div>  
@endsection