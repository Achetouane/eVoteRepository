@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Liste des votes </h1>

    @component('layouts.components.alert')
        {{ session('message') }}
    @endcomponent

    <div class="container-fluid">
          <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.vote.create') }}" class="btn btn-primary">Ajouter</a>
          </div>
    </div>

    @if (count($votes) === 0)
        <h2 class="text-center mt-5">Aucun vote existant</h2>
    @else

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
                            <th>Publier</th>
                            <th>Options</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($votes as $vote)
                        <tr>
                            <td>{{  $vote->id }}</td>
                            <td>{{  $vote->name }}</td>
                            <td>{{  $vote->type_election->name }}</td>
                            <td>{{  $vote->date_debut }}</td>
                            <td>{{  $vote->date_fin }}</td>
                       
                            <td>
                                <span>{{  ($vote->published == 1) ? 'Oui' : 'Non'  }} </span>
                                    
                               <form action="{{ route('admin.vote.published', $vote->id ) }}" method="post">
                                   @csrf
                                   @method('put')
                                   <div class="form-switch ">
                                        <input name="published" onchange="this.form.submit()" class="form-check-input" 
                                        type="checkbox" id="flexSwitchCheckDefault{{ $vote->id }}" {{ ($vote->published  == 1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckDefault{{ $vote->id }}"></label>
                                    </div> 
                               </form>                               
                            </td>
                            <td>
                                <a href="{{ route('admin.vote.edit', $vote->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                                <form action="{{ route('admin.vote.delete', $vote->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Supprimer" 
                                    onclick="return confirm('Cette action supprimera ce vote et tous les candidature qui lui sont associés.confirmer ?')"/> 
                                </form>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
        
                </table>
                <div class="d-flex justify-content-end align-items-center">
                    {{ $votes->links() }}
                </div>
            </div>
        </div>
   @endif
   
  
@endsection