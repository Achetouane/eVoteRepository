@extends('admin.template')

@section('mycontent')
    <h2 class="text-evote text-center my-3"> Ajouter un vote </h2>

    <div class="container">
        <form action="{{ route('admin.vote.store') }}" method="post">
            @csrf
            <div class="form-group my-3 mt-5">
                <label for="name">Titre :</label>
                <input type="text"  name="name" id="name" class="form-control"  value="{{old('name')}}"/>
                <div class=text-danger>{{ $errors->first('name', ":message") }}</div>
            </div>
            <div class="form-group my-3 ">
                <label for="type_election_id">Type d'élection:</label>
                <select name="type_election_id" id="type_election_id" class="form-control">
                    <option selected disabled>---</option>
                    @foreach ($type_elections as $type_election)
                        <option value="{{ $type_election->id }}">{{ $type_election->name }}</option>
                    @endforeach
                </select>
                <div class=text-danger>{{ $errors->first('type_election_id', ":message") }}</div>
            </div>

            <div class="form-group my-3">
                <label for="date_debut">Date de début:</label><br>
                <input type="datetime-local"  name="date_debut" id="date_debut"   value="{{old('date_debut')}}"/>
   
            </div>
            <div class="form-group my-3">
                <label for="date_fin">Date de fin:</label><br>
                <input type="datetime-local"  name="date_fin" id="date_fin"  value="{{old('date_fin')}}"/>
 
            </div>
            
             <div class="form-group my-3 text-center">
                <input type="submit"  class="btn btn-success" value="Envoyer"/>
             </div>
        </form>
       
    </div>
  
@endsection