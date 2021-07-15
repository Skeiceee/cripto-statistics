@extends('layouts.app')
@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">

        <div id="stadistic" class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div><i class="fas fa-chart-line"></i><span class="font-weight-bold ml-2">Dashboard</span></div>
                    </div>
                    <hr class="my-3">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <span class="mx-3 mt-3 text-muted">Valor del Bitcoin</span>
                                <hr class="mt-1 mx-3">

                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <span class="fa-stack">
                                        <i class="fas fa-fw fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-dollar-sign fa-stack-1x fa-inverse faa-shake animated"></i>
                                    </span>

                                    <span class="text-muted">USD</span>

                                    <div class="d-flex align-items-center">
                                        <span id="USD" style="font-size: 30px;">0</span><span class="ml-3" id="indicator"></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <span class="text-muted">Grafica</span>
                                    <hr>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <canvas id="moneyChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ mix('js/chart.min.js') }}"></script>
@push('scripts')
<script>
$(document).ready(function(){
    var i = null;

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    var ctx = document.getElementById('moneyChart').getContext('2d');
    var moneyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'USD',
                    data: [],
                    fill: false,
                    borderColor: "rgb(25, 146, 208)",
                    lineTension: 0
                }
            ]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Monedas'
            }
        }
    });

    $.ajaxSetup({
        timeout: 2000, 
        retryAfter: 10000
    });

    function moneyGraph(param){
            $.ajax({
            type: "post",
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            url: "{{ url('bitcoin/data') }}",
            dataType: "json",
            success: function(data){
                let oldData = parseInt(($('#USD').text()).replaceAll(".", ""));
                let active = $('#USD').html(numberWithCommas(data.value))

                if(oldData <= data.value){
                    $('#indicator').html('<i class="fas fa-arrow-up text-success"></i>')
                }else{
                    $('#indicator').html('<i class="fas fa-arrow-down text-danger"></i>')
                }

                let limit = 30;
                let today = new Date();
                let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                moneyChart.data.datasets[0].data.push(data.value);
                moneyChart.data.labels.push(time)

                while(moneyChart.data.datasets[0].data.length > limit && moneyChart.data.labels.length > limit){
                    moneyChart.data.datasets[0].data.shift()
                    moneyChart.data.labels.shift()
                }

                moneyChart.update();
                setTimeout(function(){ 
                    moneyGraph(param) 
                }, $.ajaxSetup().retryAfter)
            },
            error: function(){
                setTimeout(function(){
                    moneyGraph(param) 
                }, $.ajaxSetup().retryAfter)
            }
        })
    }
    
    moneyGraph()

});
</script>
@endpush