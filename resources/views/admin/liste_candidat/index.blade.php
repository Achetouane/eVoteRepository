@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Liste des candidats </h1>
    @component('layouts.components.alert')
        {{ session('message') }}
    @endcomponent

    <div class="container-fluid">
        <div class="d-flex justify-content-end align-items-center">
          <a href="{{ route('admin.liste_candidat.create') }}" class="btn btn-primary">Ajouter</a>
        </div>
    </div>

    @if (count($candidats) === 0)
        <h2 class="text-center mt-5">Aucun candidat existant</h2>
    @else
        <div class="container-fluid mt-2">
            <div class="table-responsive">
                <table class="table table-striped table-hover  text-center">
                    <thead class="bg-evote text-white">
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Partie</th>
                            <th>Email</th>
                            <th>téléphone</th>
                            <th>Options</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($candidats as $candidat)
                        <tr>
                            <td  class="align-middle">{{  $candidat->id }}</td>
                            <td  class="align-middle"><img src="{{ asset($candidat->image) }}" alt="" width="70"  height="70"></td>
                            <td  class="align-middle">{{  $candidat->name }}</td>
                            <td  class="align-middle">{{  $candidat->partie->name }}</td>
                            <td  class="align-middle">{{  $candidat->email }}</td>
                            <td  class="align-middle">{{  $candidat->phone }}</td>

                            <td  class="align-middle">
                                <a href="{{ route('admin.liste_candidat.edit', $candidat->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                                <form action="{{ route('admin.liste_candidat.delete', $candidat->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')                                
                                 <input type="submit" class="btn btn-sm btn-danger" value="Supprimer" 
                                    onclick="return confirm('Cette action supprimera ce candidat  et tous les candidature qui lui sont associés.confirmer ?')"/> 

                                </form>
                                <a href="{{ route('admin.liste_candidat.details', $candidat->id) }}" class="btn btn-sm btn-success">details</a>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
        
                </table>
                <div class="d-flex justify-content-end align-items-center">
                    {{ $candidats->links() }}
                </div>
            </div>
        </div>
    @endif

@endsection