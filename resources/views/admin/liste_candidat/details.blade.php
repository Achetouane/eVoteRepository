@extends('admin.template')

@section('mycontent')
    <h2 class="text-evote text-center my-3"> Candidater à un vote </h2>

    @component('layouts.components.alert')
    {{ session('message') }}
    @endcomponent


    <div class=text-danger>{{ $errors->first('vote', ":message") }}</div>
    <div class="container">
        <div id="div" class="container-fluid mt-2 "  >
            <div class="row ">
                <div class="col-md-2 " style="margin-right: 5px;">
                    <div class="f-r form-group my-3">
                        <img src="{{ asset($candidat->image) }}">
                    </div>
                </div>
           
                <div class="col-md-10 ">
                    <div class="form-group my-3 ">
                        <label for="name">Nom :</label>{{$candidat->name}}
                    </div>
                    <div class="form-group my-3">
                        <label for="email">Email :</label>{{$candidat->email}}
                    </div>
                    <div class="form-group my-3">
                        <label for="phone">Téléphone :</label>{{$candidat->phone}}
                    </div>
                    <div class="form-group my-3 ">
                        <label for="partie_id">Partie :</label>{{$candidat->partie->name}}
                    </div>
                    <div class="form-group my-3 ">
                        <label for="partie_id">ID :</label>{{$candidat->id}}
                    </div>
                </div>
                
                
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Ajouter candidature
              </button>
        </div>

            <div class="container-fluid mt-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover  text-center">
                        <thead class="bg-evote text-white">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Date de publication</th>
                                <th>Options</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            @foreach ($candidat->votes as $vote)
                                <tr>
                                    <td>{{  $vote->id }}</td>
                                    <td>{{  $vote->name }}</td>
                                    <td>{{  $vote->type_election->name }}</td>
                                    <td>{{  $vote->date_debut }}</td>
                                    <td>{{  $vote->date_fin }}</td>
                                    <td>{{  $vote->published_at }}</td>
                            
                                    <td>
                                        <form action="{{ route('admin.liste_candidat.details.delete', $vote->id ) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')     
                                            <label for="candidat_id"></label>   
                                            <input type="hidden"  name="candidat_id" id="candidat_id"  value="{{ $candidat->id}}"/>      
                                         <input type="submit"  class="btn btn-sm btn-danger" value="Supprimer" 
                                            onclick="return confirm('Confirmation la suppression?')"/> 
                                        </form>
                                        
                                    </td>
                                </tr>                  
                            @endforeach
                        </tbody>
            
                    </table>
                </div>
            </div>
       
    </div>

    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <form action="{{ route('admin.liste_candidat.details.candidate', $candidat->id) }}" method="post" >
    @csrf

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Selection vote :</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group my-3 ">
                    <label for="vote_id">Votes : </label>
                    <select name="vote_id" id="vote_id" class="form-control">
                        <option selected disabled>---</option>
                            @foreach ($votes as $vote)
                                @if ($vote->published == true)
                                     <option value="{{ $vote->id }}">{{ $vote->name }}</option>
                                @endif     
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <input type="submit"  class="btn btn-primary" value="Valider"/>
            </div>
        </div>
        </div>
    </div>
</form>
  
@endsection