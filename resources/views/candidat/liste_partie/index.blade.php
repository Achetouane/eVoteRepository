@extends('candidat.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Liste parties </h1>

    <div class="container">

         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
         Selectionner le vote
        </button>
       

       
        

      

    </div>

    {{-- <script>
        function myFunction() {
        var x = document.getElementById("div");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }
        </script> --}}

<form action="{{ route('candidat.liste_partie.edit') }}" method="post" >
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
            <input type="submit"  class="btn btn-primary" value="Valider"/>
            </div>
        </div>
        </div>
    </div>
</form>       
    
       

   
   
      
    
    
@endsection