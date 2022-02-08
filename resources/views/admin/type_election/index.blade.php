@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Type d'élection </h1>

    @component('layouts.components.alert')
        {{ session('message') }}
    @endcomponent

    <div class="container-fluid">
          <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('admin.type_election.create') }}" class="btn btn-primary">Ajouter</a>
          </div>
    </div>

    @if (count($type_elections) === 0)
        <h2 class="text-center mt-5">Aucun type d'élection existant</h2>
    @else

        <div class="container-fluid mt-2">
            <div class="table-responsive">
                <table class="table table-striped table-hover  text-center">
                    <thead class="bg-evote text-white">
                        <tr>
                            <th>Id</th>
                            <th>Titre</th>
                            <th>Slug</th>
                            <th>Options</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($type_elections as $type_election)
                        <tr>
                            <td>{{  $type_election->id }}</td>
                            <td>{{  $type_election->name }}</td>
                            <td>{{  $type_election->slug }}</td>
                            <td>
                                <a href="{{ route('admin.type_election.edit', $type_election->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                                <form action="{{ route('admin.type_election.delete', $type_election->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Supprimer" 
                                    onclick="return confirm('Cette action supprimera ce type de vote et tous les votes qui lui sont associés.confirmer ?')"/> 
                                </form>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
        
                </table>
                <div class="d-flex justify-content-end align-items-center">
                    {{ $type_elections->links() }}
                </div>
            </div>
        </div>
   @endif

  
@endsection