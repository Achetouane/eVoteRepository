<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('/', [App\Http\Controllers\Front\WelcomeController::class, 'index'])->name('front.index');

Auth::routes();


Route::middleware(['auth', 'user'])->group(function(){
Route::get('/electeur/index', [App\Http\Controllers\Electeur\HomeController::class, 'index'])->name('electeur.index');

//effectuer un vote

Route::get('/electeur/effectuer_vote/index', [App\Http\Controllers\Electeur\EffectuerVoteController::class, 'index'])->name('electeur.effectuer_vote.index');
Route::post('/electeur/effectuer_vote/edit', [App\Http\Controllers\Electeur\EffectuerVoteController::class, 'edit'])->name('electeur.effectuer_vote.edit');
Route::post('/electeur/effectuer_vote/vote', [App\Http\Controllers\Electeur\EffectuerVoteController::class, 'vote'])->name('electeur.effectuer_vote.vote');

//Gérer Compte

Route::get('/electeur/gerer_compte/index', [App\Http\Controllers\Electeur\GererCompteController::class, 'index'])->name('electeur.gerer_compte.index');
Route::put('/electeur/gerer_compte/updatePassword/{id}', [App\Http\Controllers\Electeur\GererCompteController::class, 'updatePassword'])->name('electeur.gerer_compte.updatePassword');
Route::put('/electeur/gerer_compte/update/{id}', [App\Http\Controllers\Electeur\GererCompteController::class, 'update'])->name('electeur.gerer_compte.update');

//Liste candidats
Route::get('/electeur/liste_candidat/index', [App\Http\Controllers\Electeur\ListeCandidatController::class, 'index'])->name('electeur.liste_candidat.index');
Route::post('/celecteur/liste_candidat/edit', [App\Http\Controllers\Electeur\ListeCandidatController::class, 'edit'])->name('electeur.liste_candidat.edit');

//Liste parties
Route::get('/electeur/liste_partie/index', [App\Http\Controllers\Electeur\ListePartieController::class, 'index'])->name('electeur.liste_partie.index');
Route::post('/electeur/liste_partie/edit', [App\Http\Controllers\Electeur\ListePartieController::class, 'edit'])->name('electeur.liste_partie.edit');

//Statistiques

Route::get('/electeur/statistiques/index', [App\Http\Controllers\Electeur\StatistiquesController::class, 'index'])->name('electeur.statistiques.index');

});

Route::middleware(['auth', 'candidat'])->group(function(){
Route::get('/candidat/index', [App\Http\Controllers\Candidat\HomeController::class, 'index'])->name('candidat.index');

//Effectuer un vote
Route::get('/candidat/effectuer_vote/index', [App\Http\Controllers\Candidat\EffectuerVoteController::class, 'index'])->name('candidat.effectuer_vote.index');
Route::post('/candidat/effectuer_vote/edit', [App\Http\Controllers\Candidat\EffectuerVoteController::class, 'edit'])->name('candidat.effectuer_vote.edit');
Route::post('/candidat/effectuer_vote/vote', [App\Http\Controllers\Candidat\EffectuerVoteController::class, 'vote'])->name('candidat.effectuer_vote.vote');

//Gérer Compte
Route::get('/candidat/gerer_compte/index', [App\Http\Controllers\Candidat\GererCompteController::class, 'index'])->name('candidat.gerer_compte.index');
Route::put('/candidat/gerer_compte/updatePassword/{id}', [App\Http\Controllers\Candidat\GererCompteController::class, 'updatePassword'])->name('candidat.gerer_compte.updatePassword');
Route::put('/candidat/gerer_compte/update/{id}', [App\Http\Controllers\Candidat\GererCompteController::class, 'update'])->name('candidat.gerer_compte.update');
});


//Gérer mes candidature
Route::get('/candidat/gerer_candidature/index', [App\Http\Controllers\Candidat\GererCandidatureController::class, 'index'])->name('candidat.gerer_candidature.index');
Route::post('/candidat/gerer_candidature/index', [App\Http\Controllers\Candidat\GererCandidatureController::class, 'candidate'])->name('candidat.gerer_candidate.candidate');
Route::delete('/candidat/gerer_candidature/delete/{id}', [App\Http\Controllers\Candidat\GererCandidatureController::class, 'destroy'])->name('candidat.gerer_candidature.delete');

//Liste candidats
Route::get('/candidat/liste_candidat/index', [App\Http\Controllers\Candidat\ListeCandidatController::class, 'index'])->name('candidat.liste_candidat.index');
Route::post('/candidat/liste_candidat/edit', [App\Http\Controllers\Candidat\ListeCandidatController::class, 'edit'])->name('candidat.liste_candidat.edit');

//Liste parties
Route::get('/candidat/liste_partie/index', [App\Http\Controllers\Candidat\ListePartieController::class, 'index'])->name('candidat.liste_partie.index');
Route::post('/candidat/liste_partie/edit', [App\Http\Controllers\Candidat\ListePartieController::class, 'edit'])->name('candidat.liste_partie.edit');

Route::middleware(['auth', 'admin'])->group(function(){

    Route::get('/admin/index', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.index');

    //typeElection

    Route::get('/admin/type_election/index', [App\Http\Controllers\Admin\TypeElectionController::class, 'index'])->name('admin.type_election.index');
    Route::get('/admin/type_election/create', [App\Http\Controllers\Admin\TypeElectionController::class, 'create'])->name('admin.type_election.create');
    Route::post('/admin/type_election/store', [App\Http\Controllers\Admin\TypeElectionController::class, 'store'])->name('admin.type_election.store');
    Route::get('/admin/type_election/edit/{id}', [App\Http\Controllers\Admin\TypeElectionController::class, 'edit'])->name('admin.type_election.edit');
    Route::put('/admin/type_election/update/{id}', [App\Http\Controllers\Admin\TypeElectionController::class, 'update'])->name('admin.type_election.update');
    Route::delete('/admin/type_election/delete/{id}', [App\Http\Controllers\Admin\TypeElectionController::class, 'destroy'])->name('admin.type_election.delete');
    
    //Vote
    Route::get('/admin/vote/index', [App\Http\Controllers\Admin\VoteController::class, 'index'])->name('admin.vote.index');
    Route::get('/admin/vote/create', [App\Http\Controllers\Admin\VoteController::class, 'create'])->name('admin.vote.create');
    Route::post('/admin/vote/store', [App\Http\Controllers\Admin\VoteController::class, 'store'])->name('admin.vote.store');
    Route::put('/admin/vote/published/{id}', [App\Http\Controllers\Admin\VoteController::class, 'published'])->name('admin.vote.published');
    Route::get('/admin/vote/edit/{id}', [App\Http\Controllers\Admin\VoteController::class, 'edit'])->name('admin.vote.edit');
    Route::put('/admin/vote/update/{id}', [App\Http\Controllers\Admin\VoteController::class, 'update'])->name('admin.vote.update');
    Route::delete('/admin/vote/delete/{id}', [App\Http\Controllers\Admin\VoteController::class, 'destroy'])->name('admin.vote.delete');

    //Parties
    Route::get('/admin/liste_partie/index', [App\Http\Controllers\Admin\ListePartieController::class, 'index'])->name('admin.liste_partie.index');
    Route::get('/admin/liste_partie/create', [App\Http\Controllers\Admin\ListePartieController::class, 'create'])->name('admin.liste_partie.create');
    Route::post('/admin/liste_partie/store', [App\Http\Controllers\Admin\ListePartieController::class, 'store'])->name('admin.liste_partie.store');
    Route::get('/admin/liste_partie/edit/{id}', [App\Http\Controllers\Admin\ListePartieController::class, 'edit'])->name('admin.liste_partie.edit');
    Route::put('/admin/liste_partie/update/{id}', [App\Http\Controllers\Admin\ListePartieController::class, 'update'])->name('admin.liste_partie.update');
    Route::delete('/admin/liste_partie/delete/{id}', [App\Http\Controllers\Admin\ListePartieController::class, 'destroy'])->name('admin.liste_partie.delete');

    //Candidat
    Route::get('/admin/liste_candidat/index', [App\Http\Controllers\Admin\ListeCandidatController::class, 'index'])->name('admin.liste_candidat.index');
    Route::get('/admin/liste_candidat/create', [App\Http\Controllers\Admin\ListeCandidatController::class, 'create'])->name('admin.liste_candidat.create');
    Route::post('/admin/liste_candidat/store', [App\Http\Controllers\Admin\ListeCandidatController::class, 'store'])->name('admin.liste_candidat.store');
    Route::get('/admin/liste_candidat/edit/{id}', [App\Http\Controllers\Admin\ListeCandidatController::class, 'edit'])->name('admin.liste_candidat.edit');
    Route::put('/admin/liste_candidat/update/{id}', [App\Http\Controllers\Admin\ListeCandidatController::class, 'update'])->name('admin.liste_candidat.update');
    Route::get('/admin/liste_candidat/details/{id}', [App\Http\Controllers\Admin\ListeCandidatController::class, 'details'])->name('admin.liste_candidat.details');
    Route::post('/admin/liste_candidat/details/{id}', [App\Http\Controllers\Admin\ListeCandidatController::class, 'candidate'])->name('admin.liste_candidat.details.candidate');
    Route::delete('/admin/liste_candidat/details/delete/{id}', [App\Http\Controllers\Admin\ListeCandidatController::class, 'destroyCandidate'])->name('admin.liste_candidat.details.delete');
    Route::delete('/admin/liste_candidat/delete/{id}', [App\Http\Controllers\Admin\ListeCandidatController::class, 'destroy'])->name('admin.liste_candidat.delete');

    //Regle
    Route::get('/admin/regle/index', [App\Http\Controllers\Admin\RegleController::class, 'index'])->name('admin.regle.index');
    Route::get('/admin/regle/create', [App\Http\Controllers\Admin\RegleController::class, 'create'])->name('admin.regle.create');
    Route::post('/admin/regle/store', [App\Http\Controllers\Admin\RegleController::class, 'store'])->name('admin.regle.store');
    Route::get('/admin/regle/edit/{id}', [App\Http\Controllers\Admin\RegleController::class, 'edit'])->name('admin.regle.edit');
    Route::put('/admin/regle/update/{id}', [App\Http\Controllers\Admin\RegleController::class, 'update'])->name('admin.regle.update');
    Route::delete('/admin/regle/delete/{id}', [App\Http\Controllers\Admin\RegleController::class, 'destroy'])->name('admin.regle.delete');

    //liste électeurs

    Route::get('/admin/liste_electeur/index', [App\Http\Controllers\Admin\ListeElecteurController::class, 'index'])->name('admin.liste_electeur.index');
    Route::post('/admin/liste_electeur/edit', [App\Http\Controllers\Admin\ListeElecteurController::class, 'edit'])->name('admin.liste_electeur.edit');
    
    //statistiques
    Route::get('/admin/statistiques/index', [App\Http\Controllers\Admin\StatistiquesController::class, 'index'])->name('admin.statistiques.index');
    Route::post('/admin/statistiques/edit', [App\Http\Controllers\Admin\StatistiquesController::class, 'edit'])->name('admin.statistiques.edit');

      //Résultats
    Route::get('/admin/resultats/index', [App\Http\Controllers\Admin\ResultatsController::class, 'index'])->name('admin.resultats.index');
    Route::post('/admin/resultats/edit', [App\Http\Controllers\Admin\ResultatsController::class, 'edit'])->name('admin.resultats.edit');
    


});

