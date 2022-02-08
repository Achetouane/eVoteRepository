@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Liste des parties</h1>

    @component('layouts.components.alert')
        {{ session('message') }}
    @endcomponent

    <div class="container-fluid">
        <div class="d-flex justify-content-end align-items-center">
          <a href="{{ route('admin.liste_partie.create') }}" class="btn btn-primary">Ajouter</a>
        </div>
    </div>

    @if (count($parties) === 0)
        <h2 class="text-center mt-5">Aucune partie existante</h2>
    @else
        <div class="container-fluid mt-2">
            <div class="table-responsive">
                <table class="table table-striped table-hover  text-center">
                    <thead class="bg-evote text-white">
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>téléphone</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($parties as $partie)
                        <tr>
                            <td  class="align-middle">{{  $partie->id }}</td>
                            <td  class="align-middle"><img src="{{ asset($partie->image) }}" alt="" width="70"  height="70"></td>
                            <td  class="align-middle">{{  $partie->name }}</td>
                            <td  class="align-middle">{{  $partie->email }}</td>
                            <td  class="align-middle">{{  $partie->phone }}</td>
                            <td  class="align-middle">{!! $partie->description !!}</td>

                            <td  class="align-middle">
                                <a href="{{ route('admin.liste_partie.edit', $partie->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                                <form action="{{ route('admin.liste_partie.delete', $partie->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')                                
                                 <input type="submit" class="btn btn-sm btn-danger" value="Supprimer" 
                                    onclick="return confirm('Cette action supprimera cette Partie  et tous les candidats qui lui sont associés.confirmer ?')"/> 
                                </form>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
        
                </table>
                <div class="d-flex justify-content-end align-items-center">
                    {{ $parties->links() }}
                </div>
            </div>
        </div>
    @endif

@endsection