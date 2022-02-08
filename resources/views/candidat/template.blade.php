@extends('layouts.app_candidat')

@section('content')
    <div class="row">
        <div class="sidebar col-md-2 bg-evote text-center mt-3">
            <ul class="list-group">
                <li class="list-group-item bg-evote" ><a href="{{ route('candidat.index') }}" 
                    class="text-decoration-none ">Accueil</a></li>
                <li class="list-group-item bg-evote" ><a href="{{ route('candidat.gerer_candidature.index') }}" 
                    class="text-decoration-none ">Gérer mes candidatures</a></li>
                <li class="list-group-item bg-evote" ><a href="{{ route('candidat.effectuer_vote.index') }}" 
                    class="text-decoration-none ">Effectuer un vote</a></li>
                <li class="list-group-item bg-evote" ><a href="{{ route('candidat.liste_candidat.index') }}" 
                    class="text-decoration-none ">Liste des candidats</a></li>
                <li class="list-group-item bg-evote" ><a href="{{ route('candidat.liste_partie.index') }}" 
                    class="text-decoration-none ">Liste des parties</a></li>
                <li class="list-group-item bg-evote" ><a href="{{ route('candidat.gerer_compte.index') }}" 
                    class="text-decoration-none ">Gérer mon compte</a></li>
                <li class="list-group-item bg-evote" ><a href="{{ route('admin.liste_electeur.index') }}" 
                    class="text-decoration-none ">Statistiques</a></li>
           </ul>
        </div>
        <div class="col-md-10">
            @yield('mycontent')
        </div>
    </div>  
@endsection