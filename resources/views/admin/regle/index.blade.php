@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Régles générale de vote </h1>

    @component('layouts.components.alert')
        {{ session('message') }}
    @endcomponent

    <div class="container-fluid">
        <div class="d-flex justify-content-end align-items-center">
          <a href="{{ route('admin.regle.create') }}" class="btn btn-primary">Ajouter</a>
        </div>
    </div>

    @if (count($regles) === 0)
    <h2 class="text-center mt-5">Aucune régle existante</h2>
@else

    <div class="container-fluid mt-2">
        <div class="table-responsive">
            <table class="table table-striped table-hover  text-center">
                <thead class="bg-evote text-white">
                    <tr>
                        <th>Id</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Options</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach ($regles as $regle)
                    <tr>
                        <td>{{  $regle->id }}</td>
                        <td>{{  $regle->name }}</td>
                        <td>{{  $regle->description }}</td>
                        <td>
                            <a href="{{ route('admin.regle.edit', $regle->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                            <form action="{{ route('admin.regle.delete', $regle->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-sm btn-danger" value="Supprimer" 
                                onclick="return confirm('Confirmation de la suppression ?')"/> 
                            </form>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
    
            </table>
        </div>
    </div>
@endif

@endsection