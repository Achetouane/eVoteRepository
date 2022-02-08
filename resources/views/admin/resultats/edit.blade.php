@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Résultats de vote </h1>

    <div class="container ">
        <div id="div" class="container-fluid mt-2 text-center"  >
       
            <form action="{{ route('admin.resultats.edit') }}" method="post" >
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


        <h3 class="text-evote text-center my-3"> --------------   {{ $vote->name }} Classement  --------------</h3>
        
        <div id="div" class="container-fluid mt-2"  >
            <div class="table-responsive">
                <table class="table table-striped table-hover  text-center">
                    <thead class="bg-evote text-white">
                        <tr> 
                         <div class="f-r form-group my-3">           
                            <th>Photo</th>    
                            <th>Name</th>      
                            <th>Partie</th>   
                            <th>Classement</th>
                        </tr>
                        
                    </thead>
                    <tbody>

                         <?php
                                    $compteur = 1;
                            ?>
                        @foreach ($candidats as $candidat)

                           
                
                            <tr>
                                <td><img src="{{ asset($candidat->image) }}" alt="" width="50"  height="50"></td>
                                <td class="align-middle">{{ $candidat->name}}</td>
                                <td class="align-middle">{{ $candidat->partie->name}}</td> 
                                <td class="align-middle">{{$compteur}}</td> 
                            </tr>     
                            
                            <?php
                                    $compteur =$compteur+1;
                            ?>
                        @endforeach  
                              
                       
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
   
@endsection