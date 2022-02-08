@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Liste d'électeurs </h1>

    <div class="container ">
        <div id="div" class="container-fluid mt-2 text-center"  >
       
            <form action="{{ route('admin.liste_electeur.edit') }}" method="post" >
                @csrf
            
                    
                            <div class="form-group my-3 ">
                                <label for="vote_id">Selectionner un vote : </label>
                                <select name="vote_id" id="vote_id"  onchange="this.form.submit()">
                                    <option selected disabled>---</option>
                                        @foreach ($votes as $vote1)
                                            @if ($vote1->published == true)
                                                <option value="{{ $vote1->id }}">{{ $vote1->name }}</option>
                                            @endif     
                                        @endforeach
                                </select>
                            </div>

            </form>   
         </div>    


        <h3 class="text-evote text-center my-3"> --------------   {{ $vote->name }}   --------------</h3>
        
        <div id="div" class="container-fluid mt-2"  >
            <div class="table-responsive">
                <table class="table table-striped table-hover  text-center">
                    <thead class="bg-evote text-white">
                        <tr> 
                            <th>Name</th>      
                            <th>Email</th>                        
                        </tr>
                        
                    </thead>
                    <tbody>
                        
                        @foreach ($vote->users as $user)
                            <tr>
                                <td>{{  $user->name }}</td>
                                <td>{{  $user->email  }}</td> 
                            </tr>                  
                        @endforeach  
                              
                       
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Selectionner le vote
       </button>
      
       <form action="{{ route('admin.liste_electeur.edit') }}" method="post" >
           @csrf
       
           <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Selection vote :</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div class="form-group my-3 ">
                           <label for="vote_id">Votes : </label>
                           <select name="vote_id" id="vote_id" class="form-control">
                               <option selected disabled>---</option>
                                   @foreach ($votes as $vote1)
                                       @if ($vote1->published == true)
                                            <option value="{{ $vote1->id }}">{{ $vote1->name }}</option>
                                       @endif     
                                   @endforeach
                           </select>
                       </div>
                   </div>
       
                   <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                   <input type="submit"  class="btn btn-primary"  value="Valider"/>
                   </div>
               </div>
               </div>
           </div>
       </form>        --}}




@endsection