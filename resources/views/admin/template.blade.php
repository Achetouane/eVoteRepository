@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="sidebar col-md-2 bg-evote text-center mt-3">
            <ul class="list-group">
                <li class="list-group-item bg-evote" ><a href="{{ route('admin.index') }}" 
                   class="text-decoration-none ">Accueil</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('admin.type_election.index') }}" 
                   class="text-decoration-none ">Type d'élection</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('admin.vote.index') }}" 
                   class="text-decoration-none ">Liste des votes</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('admin.liste_candidat.index') }}" 
                   class="text-decoration-none ">Liste des candidats</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('admin.liste_partie.index') }}" 
                   class="text-decoration-none ">Liste des parties</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('admin.liste_electeur.index') }}" 
                   class="text-decoration-none ">Liste des électeurs</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('admin.regle.index') }}" 
                   class="text-decoration-none ">régles de vote</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('admin.statistiques.index') }}" 
                   class="text-decoration-none ">Statistiques</a></li>
               <li class="list-group-item bg-evote" ><a href="{{ route('admin.resultats.index') }}" 
                   class="text-decoration-none ">Résultats de vote</a></li>
           </ul>
        </div>
        <div class="col-md-10">
            @yield('mycontent')
        </div>
    </div>  
@endsection