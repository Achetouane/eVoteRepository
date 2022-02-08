@extends('admin.template')

@section('mycontent')
    <h2 class="text-evote text-center my-3"> Modifier une régle de vote </h2>

    <div class="container">
        <form action="{{ route('admin.regle.update', $regle->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group my-3 mt-5">
                <label for="name">Titre :</label>
                <input type="text"  name="name" id="name" class="form-control"  value="{{old('name') ?? $regle->name }} "/>
                <div class=text-danger>{{ $errors->first('name', ":message") }}</div>
            </div>
            <div class="form-group my-3 mt-5">
                <label for="description">Description :</label>
                <textarea type="text" name="description" id="description" class="form-control" rows="10">{{old('description') ?? $regle->description }}</textarea>
                <div class=text-danger>{{ $errors->first('description', ":message") }}</div>
            </div>
            
             <div class="form-group my-3 text-center">
                <input type="submit"  class="btn btn-success" value="Envoyer"/>
             </div>
        </form>
    </div>
  
@endsection