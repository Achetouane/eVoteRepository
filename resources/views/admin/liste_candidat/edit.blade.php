@extends('admin.template')

@section('mycontent')
    <h2 class="text-evote text-center my-3"> Modifier un candidat </h2>

    <div class="container">
        <form action="{{ route('admin.liste_candidat.update', $candidat->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group my-3 mt-5">
                <label for="name">Nom :</label>
                <input type="text"  name="name" id="name" class="form-control"  value="{{old('name') ?? $candidat->name}}"/>
                <div class=text-danger>{{ $errors->first('name', ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="email">Email :</label>
                <input type="text"  name="email" id="email" class="form-control"  value="{{old('email') ?? $candidat->email}}"/>
                <div class=text-danger>{{ $errors->first('email', ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="phone">Téléphone :</label>
                <input type="text"  name="phone" id="phone" class="form-control"  value="{{old('phone') ?? $candidat->phone}}"/>
                <div class=text-danger>{{ $errors->first('phone', ":message") }}</div>
            </div>
            <div class="form-group my-3 ">
                <label for="partie_id">Partie :</label>
                <select name="partie_id" id="partie_id" class="form-control">

                    @foreach ($parties as $partie)
                    <option value="{{ $partie->id }}" {{ ($partie->id === $candidat->partie_id) ? 'selected' : '' }}>{{ $partie->name }}</option>
                    @endforeach
                </select>
                <div class=text-danger>{{ $errors->first('partie_id', ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <div class="col-md-6 text-center">
                    <img src="{{ asset($candidat->image) }}" alt="" width='120' height='120'>
                </div>
                <div class="col-md-6 ">
                    <label for="image">Image :</label> <br>
                    <input type="file"  name="image" id="image" class="form-control-file" />
                    <div class=text-danger>{{ $errors->first('image', ":message") }}</div>
                </div>
            </div>
            
            
             <div class="form-group my-3 text-center">
                <input type="submit"  class="btn btn-success" value="Envoyer"/>
             </div>
        </form>
       
    </div>
  
@endsection