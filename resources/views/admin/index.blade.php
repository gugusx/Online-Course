@extends('layouts.app')
@section('content')

@include('sweet::alert')


      <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.min.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.print.min.css')}}" media='print'>
        <script src="{{asset('js/jquery-2.1.4.js')}}"></script>
      <script src="{{asset('js/moment.min.js')}}"></script>
      <script src="{{asset('js/fullcalendar.min.js')}}"></script>
      
      <style>

        #calendar {
          max-width: 900px;
          margin: 0 auto;
        }

      </style>
<?php
$date  = $tahun;
$bulan = [];
for ($i = 01; $i <= 12; $i++) {
    $bulan[] = $i;
}


?>
<!--<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>-->

<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Admin Dashboard </div>
				<div class="panel-body">

				<div class="alert alert-info">Hallo Selamat Datang 	 <strong> {{ Auth::user()->name}} </strong> </div>
				
				<div class="row" align="center">
				    <div class="col-md-3">
                        <p style="line-height: 34px;"><i class="glyphicon glyphicon-user" style="color: grey"></i> <b>{{ ($users - 1) }}</b> User</p>
                    </div>
                    <div class="col-md-3 hidden-xs">
                        <p style="line-height: 34px;"><i class="glyphicon glyphicon-user" style="color: dodgerblue"></i> <b>{{ $users_premium }}</b> User Premium</p>
                    </div>
                    <div class="col-md-3">
                        <p style="line-height: 34px;"><i class="glyphicon glyphicon-book" style="color: #9E4B4B"></i> <b>{{ $moduls }}</b> Modul Belajar</p>
                    </div>
                    <div class="col-md-3">
                        <p style="line-height: 34px;"><i class="glyphicon glyphicon-facetime-video" style="color: #6E1D9E"></i> <b>{{ $videos }}</b> Video</p>
                    </div>
                </div>
                
                <!--<span style="color: red;"><b><sup>*</sup>Grafik masih dalam tahap perbaikan</b></span>-->
                <div class="row">
                    <div class="col-md-12">
                        <h4 align="center">Grafik User Per Bulan <br> Pilih Tahun :</h4> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <select class="form-control" onchange="filter_grafik_user(this.value)" style="width: 28%; margin: auto;">
                                              <?php
                    for ($i = date('Y'); $i >= 2018; $i--) {
                        ?>
                            <option value="<?php echo $i; ?>" <?php if ($i == $date) {
                            echo "selected";
                        }?>><?php echo $i; ?></option>
                                  <?php }?>
                          </select>
                    </div>
                </div>
                <?php for ($j = $date; $j <= $date; $j++) {
    ?>
                <canvas id="bar_user_<?=$j?>" width="300" height="100px"></canvas>
                <script>
    
                var ctx = document.getElementById('bar_user_<?=$j?>').getContext('2d');
                var myChartx = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            <?php
                $ct = count($bulan);
                    for ($i = 0; $i < $ct; $i++) {
                        echo '"';
                
                        if ($bulan[$i] == 1) {
                            echo "Jan";
                        } else if ($bulan[$i] == 2) {
                            echo "Feb";
                        } else if ($bulan[$i] == 3) {
                            echo "Mar";
                        } else if ($bulan[$i] == 4) {
                            echo "Apr";
                        } else if ($bulan[$i] == 5) {
                            echo "Mei";
                        } else if ($bulan[$i] == 6) {
                            echo "Jun";
                        } else if ($bulan[$i] == 7) {
                            echo "Jul";
                        } else if ($bulan[$i] == 8) {
                            echo "Agu";
                        } else if ($bulan[$i] == 9) {
                            echo "Sep";
                        } else if ($bulan[$i] == 10) {
                            echo "Okt";
                        } else if ($bulan[$i] == 11) {
                            echo "Nov";
                        } else if ($bulan[$i] == 12) {
                            echo "Des";
                        }
                
                        echo '",';
                    }
                    ?>],
                         datasets: [{
                        label: "User Premium",
                        backgroundColor: "#FC9775",
                        data: [
                                  <?php
                            $ct = count($bulan);
                            for ($i = 0; $i < $ct; $i++) {
                            $data = DB::table('users')
                                ->whereRaw('SUBSTR(created_at, 6, 2) = ' . $bulan[$i] . ' ')
                                ->whereRaw('SUBSTR(created_at, 1, 4) = ' . $j . ' ')
                                ->where('level', 'Premium')
                                ->count();
                        
                            echo '"' . $data . '",';
                            }
                            ?>
                            ]
                    }, {
                        label: "User",
                        backgroundColor: "#5A69A6",
                        data: [
                                  <?php
                            $ct = count($bulan);
                            for ($i = 0; $i < $ct; $i++) {
                            $data = DB::table('users')
                                ->whereRaw('SUBSTR(created_at, 6, 2) = ' . $bulan[$i] . ' ')
                                ->whereRaw('SUBSTR(created_at, 1, 4) = ' . $j . ' ')
                                ->where('level', 'Free')
                                ->count();
                        
                            echo '"' . $data . '",';
                            }
                            ?>
                            ]
                    }],
                    
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                </script>
     <?php }?>
     
     <br>
     <!--<h4 align="center">Grafik Pengunjung Modul</h4> -->
     <div class="row">
        <div class="col-md-12" style="overflow-y: overlay">
            <canvas id="myChartx" style="padding-right: 15%;" width="500" height="250"></canvas>
        </div>
     </div>
    <br>
<!--<p align="justify">-->
<!--    <canvas id="myChart" width="400" height="150px"></canvas>-->
<!--<p>-->

<!--
    <div class="col-md-7 " style="padding-top:20px">




        <div id='calendar'></div>


  </div>

-->

    <script>
    var ctx = document.getElementById('myChartx').getContext('2d');
    var myChartx = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [

              @foreach($modul as $r)
    
              '{{$r->judul}}',
    
              @endforeach()
            ],
            datasets: [{
                label: 'Grafik Pengunjung Modul ',
                data: [
                  @foreach($modul as $c)
    
                  {{$c->count}},
    
                  @endforeach()
                ],
                backgroundColor: [
                  'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
    
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                  'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
    
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
         options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    
    </script>
  

				</div>
			</div>
		</div>
	</div>
</div>



<script>
function filter_grafik_user(val) {
    if (val != '') {
        window.location.href = '{{ url('filtergrafik') }}/'+val; 
    }
}

</script>


@endsection
