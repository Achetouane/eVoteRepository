@extends('electeur.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Gérer mon compte </h1>
    @component('layouts.components.alert')
        {{ session('message') }}
    @endcomponent

    <div class="container">
        <form action="{{ route('electeur.gerer_compte.update',  Auth::user()->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group my-3 mt-5">
                <label for="name">Nom :</label>
                <input type="text"  name="name" id="name" class="form-control"  value="{{old('name') ?? Auth::user()->name}}"/>
                <div class=text-danger>{{ $errors->first('name', ":message") }}</div>
            </div>
            <div class="form-group my-3">
                <label for="email">Email :</label>
                <input type="text"  name="email" id="email" class="form-control"  value="{{old('email') ?? Auth::user()->email}}"/>
                <div class=text-danger>{{ $errors->first('email', ":message") }}</div>
            </div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Changer mon mot de passe
              </button>
              
             <div class="form-group my-3 text-center">
                <input type="submit"  class="btn btn-success" value="Envoyer"/>
             </div>
        </form>

           <form action="{{ route('electeur.gerer_compte.updatePassword',  Auth::user()->id) }}" method="post" >
            @csrf
            @method('put')
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Changer mon mot de passe :</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-3 ">
                            <label for="password">Nouveau mot de passe:</label>
                            <input type="password"  name="password" id="password" class="form-control" value=""/>
                            <div class=text-danger>{{ $errors->first('password', ":message") }}</div>

                            <label for="confirm_password">Confirmer nouveau mot de passe:</label>
                            <input type="password"  name="confirm_password" id="confirm_password" class="form-control" value=""/>
                            <div class=text-danger>{{ $errors->first('confirm_password', ":message") }}</div>
                                                     
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


       
       
    </div>
    
@endsection