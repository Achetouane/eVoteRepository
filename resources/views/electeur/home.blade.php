@extends('electeur.template')

@section('mycontent')
<h2 class="dashbord text-center mt-2">Tableau de bord</h2>
<div class="row mb-3 m-3">
            <div class="col-xl-6 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Effectuer un vote</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('electeur.effectuer_vote.index') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Gérer mon compte</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('electeur.gerer_compte.index') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Liste des candidats</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('electeur.liste_candidat.index') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Liste des parties</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('electeur.liste_partie.index') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 ">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">Statistiques</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('electeur.statistiques.index') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

    </div>
  
@endsection