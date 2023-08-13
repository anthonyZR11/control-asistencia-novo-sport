
<?php 

 $today = date('Y-m-d');
  $year = date('Y');

  if(isset($_GET['year'])){
    $year = $_GET['year'];
   
  }
 ?>
<?php require_once "modelo/conexion.php"; ?>
<?php 
  include 'vista/modulos/timezone.php'; 
  $link = Conexion::conectar();
 
?>

<div class="content-wrapper">
  <section class="content-header"> 
    <h1>   
      Tablero
      <small>Panel de Control</small>    
    </h1>

    <ol class="breadcrumb">      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>    
      <li class="active">Dashbord</li>  
    </ol>
  </section>

  <section class="content">
    <div class="row">     
      <?php
      
        include "principal/cajas-superiores.php";
      
      ?>
    </div> 

    <?php if($_SESSION["perfil"] =="ADMINISTRADOR" || $_SESSION["perfil"] =="EDITOR"){ 
        echo '<div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Informe de asistencia mensual</h3>
                    <div class="box-tools pull-right">
                      <form class="form-inline">
                        <div class="form-group">
                          <label>Seleccionar Año: </label>
                          <select class="form-control input-sm" id="select_year2">';?>
                            <?php
                              for($i=2015; $i<=2065; $i++){
                                $selected = ($i==$year)?'selected':'';
                                echo "
                                  <option value='".$i."' ".$selected.">".$i."</option>

                                ";
                              
                              }
                            ?>
                      <?php echo '</select>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <br>
                      <div id="legend" class="text-center legend"></div>
                      <canvas id="barChart" style="height:250px"></canvas>
                    </div>
                  </div>
                </div>
              </div>
        </div>';
     }
    ?>
  </section> 
</div>

<?php
  $and = 'AND YEAR(fecAsistencia) = '.$year;
  $months = array();
  $ontime = array();
  $late = array();
  for( $m = 1; $m <= 12; $m++ ) {
    $sql = "SELECT count(*) FROM asistencia WHERE MONTH(fecAsistencia) = '$m' AND estadoAsistencia = 1 $and";
    $oquery = $link->query($sql);
    array_push($ontime, $oquery->fetchColumn());

    $sql = "SELECT count(*) FROM asistencia WHERE MONTH(fecAsistencia) = '$m' AND estadoAsistencia = 0 $and";
    $lquery = $link->query($sql);
    array_push($late, $lquery->fetchColumn());

    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $late = json_encode($late);
  $ontime = json_encode($ontime);

?>
<!-- End Chart Data -->

<script>
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Tarde',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : <?php echo $late; ?>
      },
      {
        label               : 'A tiempo',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $ontime; ?>
      }
    ]
  }
  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].fillColor%>\'></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
</script>
<script>
$(function(){
  $('#select_year2').change(function(){
    window.location = 'index.php?ruta=principal&year='+$(this).val();

  });
});


</script>


