@extends('electeur.template')




@section('mycontent')
    <h1 class="text-evote text-center my-3"> Voter un candidat</h1>
    

    @if(! $index->exists())
        <h4 class="text-center my-3"> Choisir un candidat dans la liste ci-dessous après confirmer ton vote en cliquant sur valider en bas :</h4>
        <div class="container">

            <div id="div" class="container-fluid mt-2"  >
                <div class="table-responsive">
                    <form action="{{ route('electeur.effectuer_vote.vote') }}" method="post" >
                        @csrf
                    <table class="table table-striped table-hover  text-center">
                        <thead class="bg-evote text-white">
                            <tr> 
                                <th>Photo</th>
                                <th>Name</th>                            
                                <th>Partie</th>
                                <th>Voter</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            
                            @foreach ($vote->candidats as $candidat)
                                <tr>
                                    
                                    <td><img src="{{ asset($candidat->image) }}" alt="" width="110"  height="110"></td>
                                    <td>{{  $candidat->name }}</td>
                                    <td>{{$candidat->partie->name}}</td>
                                    <th>
                                       
                                            <label class="custom-radio">
                                            <input id="row_{{ $candidat->id}}" type="radio"  name="candidatId" onclick="selectionnerCandidat('{{ $candidat->name}}', '{{ $candidat->partie->name}}')" value="{{ $candidat->id}}" />
                                            </label>
                                
                                        
                                    </th>
                                </tr>                  
                            @endforeach  
                                  
                           
                        </tbody>
                    </table>
                    <div class="text-center">
    
                        <label for="candidat_id"></label>       
            
                        <input type="submit" id='btn'  class="btn btn-primary" value="Valider"/>
                    </div>
                       </form> 
                </div>
            </div>
    
         
    
        </div>




    
   
    @else
    <h4 class="text-center my-3"> Vous avez voté le  {{ $candidat->name  }} pour le  {{ $vote->name }}</h4>

    <div class="container">

        <div id="div" class="container-fluid mt-2"  >
            <div class="table-responsive">
               
                  
                <table class="table table-striped table-hover  text-center">
                    <thead class="bg-evote text-white">
                        <tr> 
                            <th>Photo</th>
                            <th>Name</th>                            
                            <th>Partie</th>
                            <th>Voter</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        
                        @foreach ($vote->candidats as $candidat)
                            <tr>
                                
                                <td><img src="{{ asset($candidat->image) }}" alt="" width="110"  height="110"></td>
                                <td>{{  $candidat->name }}</td>
                                <td>{{$candidat->partie->name}}</td>
                                <th>
                                 
                            
                                    @if ($vote->users()->where('user_id', $users->id)->first()->pivot->candidat_id == $candidat->id)                        
                                    <i class="material-icons unchecked" style="color:green">done</i>  
                                    
                                    @else
                                    <i class="material-icons checked" style="color:red">close</i>
                                    @endif
                                </th>
                            </tr>                  
                        @endforeach  
                              
                       
                    </tbody>
                </table>
               
            </div>
        </div>

     

    </div>
    @endif 


   

    

     

    </div>

    <script>
        var currentCandidat = "";
       
        function selectionnerCandidat(nom, partie) {
                      
           currentCandidat = 'candidat: ' + nom + ' ' + 'partie: ' + partie ;

             
    }
        //console.log(listCandidats);
    </script>

    <script>
        
            const btn = document.querySelector('#btn');        
        //const radioButtons = document.querySelectorAll('input[name="candidatId"]:');
        //console.log(radioButtons);
        btn.addEventListener("click", () => {
           // let selectedSize;
            //for (const radioButton of radioButtons) {
                if (! $('input[name=candidatId]:checked').length > 0) {
                    if( ! alert('Aucun candidat selectionné'))
                    {
                        event.preventDefault();
                    }
                }else
                {
                    if ( ! confirm('Voulez vous valider ton choix : ? ' + currentCandidat) )
                    {
                        event.preventDefault();
                    }
                    
                }
                    
           
            // show the output:
            //output.innerText = selectedSize ? `You selected ${selectedSize}` : `You haven't selected any size`;
        });
        
       
    </script>
    
    {{-- <script>
        function myFunction() {
           
               confirm('Tu veux confirmer?'); 
        
        }
     </script> --}}


       
@endsection