@extends('admin.template')

@section('tiny')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: 'textarea'
        });
      </script>
@endsection
@section('mycontent')
    <h2 class="text-evote text-center my-3"> Modifier une partie </h2>

    <div class="container">
        <form action="{{ route('admin.liste_partie.update', $partie->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group my-3 mt-5">
                <label for="name">Nom :</label>
                <input type="text"  name="name" id="name" class="form-control"  value="{{old('name') ?? $partie->name}}"/>
                <div class=text-danger>{{ $errors->first('name', ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="email">Email :</label>
                <input type="text"  name="email" id="email" class="form-control"  value="{{old('email') ?? $partie->email}}"/>
                <div class=text-danger>{{ $errors->first('email', ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="phone">Téléphone :</label>
                <input type="text"  name="phone" id="phone" class="form-control"  value="{{old('phone') ?? $partie->phone}}"/>
                <div class=text-danger>{{ $errors->first('phone', ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <div class="col-md-6 text-center">
                    <img src="{{ asset($partie->image) }}" alt="" width='120' height='120'>
                </div>
                <div class="col-md-6 ">
                    <label for="image">Image :</label> <br>
                    <input type="file"  name="image" id="image" class="form-control-file" />
                    <div class=text-danger>{{ $errors->first('image', ":message") }}</div>
                </div>
                
            </div>
            <div class="form-group my-3">
                <label for="description">Description :</label>
                <textarea type="text" name="description" id="description" class="form-control" rows="10">{{old('description') ?? $partie->description}}</textarea>
                <div class=text-danger>{{ $errors->first('description', ":message") }}</div>
            </div>
            
             <div class="form-group my-3 text-center">
                <input type="submit"  class="btn btn-success" value="Envoyer"/>
             </div>
        </form>
       
    </div>
  
@endsection