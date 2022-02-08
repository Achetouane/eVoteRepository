@extends('admin.template')

@section('mycontent')
    <h1 class="text-evote text-center my-3"> Statistiques </h1>

    <div class="container-fluid ">
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


        <h4 class="text-evote text-center my-3"> --------------   {{ $vote->name }} Statistiques  --------------</h4>
        
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row">
                    <div class="container-fluid d-flex justify-content-center">
                        <div class="col-sm-8 col-md-6">
                            <div class="card">
                                <div class="card-header text-center">Taux (%)</div>
                                <div class="card-body" style="height: 420px" >
                                    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                        </div>
                                    </div> <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var ctx = $("#chart-line");
                var myLineChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?php echo json_encode($candidats ); ?>,
                        datasets: [{
                            data: <?php echo json_encode($taux); ?>,
                            backgroundColor: <?php echo json_encode($colors ); ?>
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: ' <?php echo $vote->name; ?>'
                        }
                    }
                });
            });
        </script>
       

    </div>
   
   
@endsection