@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Statistiques</h1>

    @component('layouts.components.alert')
        {{ session('message') }}
    @endcomponent

    <div id="div" class="container-fluid mt-2 text-center"  >
        <form action="{{ route('admin.statistiques.edit') }}" method="post" >
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
    
    
@endsection