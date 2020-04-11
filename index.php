<?php
include "config.php";
header('Access-Control-Allow-Origin: *');
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://coronavirus-monitor.p.rapidapi.com/coronavirus/cases_by_particular_country.php?country=Bangladesh",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: coronavirus-monitor.p.rapidapi.com",
		"x-rapidapi-key: 1e84899570mshaee78d8ba1b9751p1f6eb4jsn25c241b69d6f"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//echo $response;
}

$data = json_decode($response);

$data = $data->stat_by_country;


mysqli_query($con,"TRUNCATE corona_update");

foreach ($data as $currentX) {
	$date = strtotime($currentX->record_date);
		////////////
		$date_ = date('d/m/Y', $date);
		$time = date('h:i:A', $date);
		$case = $currentX->total_cases;
		$death = $currentX->total_deaths;
		$recovered = $currentX->total_recovered;
		$caseperminute = $currentX->total_cases_per1m;
		$query = "INSERT INTO corona_update values (null,'{$date_}','{$time}','{$case}','{$death}','{$recovered}','{$caseperminute}')";
		mysqli_query($con,$query);
}

$temp_result = mysqli_query($con,"SELECT * FROM corona_update WHERE totalcase = (SELECT max(totalcase) from corona_update)  GROUP BY date ORDER BY date DESC");
$temp_row = mysqli_fetch_assoc($temp_result);

$last_date=$temp_row['date']." ".$temp_row['time'];
$total_case=$temp_row['totalcase'];
$total_death = $temp_row['deaths'];
$total_recovered=$temp_row['recovered'];
$total_cases_per1m=$temp_row['caseperminute'];



$query = "
SELECT *
FROM corona_update S 
WHERE totalcase=(
SELECT MAX(totalcase) 
FROM corona_update 
WHERE date = S.date) GROUP BY date  
ORDER BY `S`.`totalcase`  asc
"; 
$result = mysqli_query($con, $query);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'Date Time', 
  'type' => 'string'
 ),
 array(
  'label' => 'People affected by Corona in Bangladesh', 
  'type' => 'number'
 )
);

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $datetime = explode(".", $row["date"]);
 $sub_array[] =  array(
      "v" => $row["date"]
     );
 $sub_array[] =  array(
      "v" => $row["totalcase"]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable = json_encode($table);

?>

<!DOCTYPE html>
<html class="no-js" lang="en">

    <head>
        <!-- META DATA -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="Sabuj,Mehedi,Mehedi Hasan,Mehedi Hasan Sabuj,mehedi hasan sabuj,coronavirus,CoronaVirus,Coronavirus Bangladesh,bangladesh corona,Corona Virus Bangladesh Update">
        <meta name="author" content="Mehedi Hasan Sabuj">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
		
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
		
		<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
		
        <!-- TITLE OF SITE -->
        <title>Corona Virus Live Update Bangladesh</title>

        <!-- for title img -->
		<link rel="shortcut icon" type="image/icon" href="images\Final-logo.png"/>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!--linear icon css-->
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
		
		<!--animate.css-->
        <link rel="stylesheet" href="assets/css/animate.css">
		
		<!--hover.css-->
        <link rel="stylesheet" href="assets/css/hover-min.css">
		
		<!--vedio player css-->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">

		<!--owl.carousel.css-->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link href="assets/css/owl.theme.default.min.css" rel="stylesheet"/>


        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link href="assets/css/bootsnav.css" rel="stylesheet"/>	
        
        <!--style.css-->
        <link rel="stylesheet" href="assets/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link href="assets/datatables.bootstrap4.min.css" rel="stylesheet">
        <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=El+Messiri&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Pacifico&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Google+Sans"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="assets/extra/css/materializecss.css" />
    <link rel="stylesheet" href="assets/extra/css/style.css" />
    <link rel="stylesheet" href="assets/extra/css/darkMood.css" />
    <script src="renderer.js"></script>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <![endif]-->
        <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

    var options = {
     title:'Real time data Corona Case in Bangladesh',
     legend:{position:'bottom'},
     chartArea:{width:'60%', height:'65%'}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('line_chart'));

    chart.draw(data, options);
   }

     $(window).resize(function(){
   	drawChart();

   });
  </script>
  <style>
  .page-wrapper
  {
   width:1000px;
   margin:0 auto;
  }
  </style>
 </head> 

    </head>
	
	<body>
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

		
		
		<!--header end-->
		
		<!--menu start-->
		<section style="background-color: #7073D8;">
			<div class="container">
				<div class="menubar">
					
					
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="index.php">
								<img src="images/logo.png" alt="logo" style="width: 100px; margin-top: -30px;">
							</a>
						</div><!--/.navbar-header -->

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
								<h2 style="color:white;">Corona Virus Live Update Bangladesh</h2>
							
							</ul><!-- / ul -->
						</div><!-- /.navbar-collapse -->
					<!--/nav -->
				</div><!--/.menubar -->
			</div><!-- /.container -->

		</section><!--/#menu-->
		<!--menu end-->
		
		
		<!-- header-slider-area end -->

		<!-- Table Start Here -->
	
	
	 <div class="customContainer" id="home">
        <div class="row">
          <h4
            class="center-align gsans text-blue-grey text-darken-1 headerText"
          >
            COVID-19 in Bangladesh
          </h4>
          <div class="col s12 m4 l3">
            <div class="card round center-align">
              <div class="card-content">
                <div class="row">
                  <div class="col s12 m6 l6">
                    <img
                      class="responsive-img bannerSvg"
                      src="assets/extra/img/svg/infected.svg"
                      alt="infected"
                    />
                  </div>
                  <div class="col s12 m6 l6">
                    <span
                      class="countNumber count gsans"
                      style="color: rgb(0, 122, 204);"
                      id="worldInfected"
                      ><?php echo $total_case; ?></span
                    ><br />
                    <span class="countName gsans">Coronavirus cases</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12 m4 l3">
            <div class="card round center-align">
              <div class="card-content">
                <div class="row">
                  <div class="col s12 m6 l6">
                    <img
                      class="responsive-img bannerSvg"
                      src="assets/extra/img/svg/infected.svg"
                      alt="infected"
                    />
                  </div>
                  <div class="col s12 m6 l6">
                    <span
                      class="countNumber count gsans"
                      style="color: rgb(0, 122, 204);"
                      id="worldInfected"
                      ><?php echo ($total_case - ($total_recovered+$total_death)) ?></span
                    ><br />
                    <span class="countName gsans">Active cases</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12 m4 l3">
            <div class="card round center-align">
              <div class="card-content">
                <div class="row">
                  <div class="col s12 m6 l6">
                    <img
                      class="responsive-img bannerSvg"
                      src="assets/extra/img/svg/death.svg"
                      alt="death"
                    />
                  </div>
                  <div class="col s12 m6 l6">
                    <span
                      class="countNumber count gsans"
                      style="color: rgba(235, 34, 44, 0.89);"
                      id="worldDeath"
                      ><?php echo $total_death; ?></span
                    ><br />
                    <span class="countName gsans">Deaths</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12 m4 l3">
            <div class="card round center-align">
              <div class="card-content">
                <div class="row">
                  <div class="col s12 m6 l6">
                    <img
                      class="responsive-img bannerSvg"
                      src="assets/extra/img/svg/recovered.svg"
                      alt="recovered"
                    />
                  </div>
                  <div class="col s12 m6 l6">
                    <span
                      class="countNumber count gsans"
                      style="color: rgb(7, 219, 95);"
                      id="worldRecovered"
                      ><?php echo $total_recovered; ?></span
                    ><br />
                    <span class="countName gsans">Recovered</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

	<hr>
	 <h4
            class="center-align gsans text-blue-grey text-darken-1 headerText"
          >
            Charts
          </h4>
	<div class="page-wrapper">
   <br />
   <h2 align="center">Total Case of Corona in Bangladesh</h2>
   <div class="col s12 l6 m6">
            <div class="card round">
              <div class="card-content">
                <div
                  class="chart"
                  id="line_chart"
                  style="height: 376px; max-width: 920px; margin: 0px auto;"
                ></div>
              </div>
            </div>
          </div>
   <!--<div id="line_chart" style="height: 500px" class="col-"></div> -->
  </div>



 <div class="customContainer" id="charts">
        <div class="row">
        
          <div class="col s12 l6 m6">
            <div class="card round">
              <div class="card-content">
                <div
                  class="chart"
                  id="infectionWithDate"
                  style="height: 376px; max-width: 920px; margin: 0px auto;"
                ></div>
              </div>
            </div>
          </div>
          <div class="col s12 l6 m6">
            <div class="card round">
              <div class="card-content">
                <div
                  class="chart center-align"
                  id="deathWithDate"
                  style="height: 376px; max-width: 920px; margin: 0px auto;"
                ></div>
              </div>
            </div>
          </div>
          <div class="col s12 l6 m6">
            <div class="card round">
              <div class="card-content">
                <div
                  class="chart"
                  id="infectedDistrict"
                  style="height: 380px; width: 100%; margin: 0px auto;"
                ></div>
              </div>
            </div>
          </div>
          <div class="col s12 l6 m6">
            <div class="card round">
              <div class="card-content">
                <div
                  class="chart"
                  id="infectedArea"
                  style="height: 380px; max-width: 920px; margin: 0px auto;"
                ></div>
              </div>
            </div>
          </div>
           <div class="col s12 l6 m6">
            <div class="card round">
              <div class="card-content">
                <div
                  class="chart"
                  id="infected_Area"
                  style="height: 1600px; max-width: 920px; margin: 0px auto;"
                ></div>
              </div>
            </div>
          </div>
          <div class="col s12 l6 m6">
            <div class="card round">
              <div class="card-content">
                <div
                  class="chart"
                  id="gender"
                  style="height: 380px; max-width: 920px; margin: 0px auto;"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>


          <hr style="height: 10px;";>
    <div class="container">
		<table class="table table-bordered col-" id="dataTable" width="100%" cellspacing="0">
			<thead>
			<tr style="background-color: rgba(112,115,216,0.4)">
				<th width="20%">Date</th>
				<th width="20%">Time</th>
				<th width="20%">Total Case</th>
				<th width="20%">Total Deaths</th>
				<th width="20%">Total recovered</th>
				<th width="20%">Total Case Per one minute</th>
			</tr>
		</thead>
		<tfoot>
			<tr style="background-color: rgba(112,115,216,0.4)">
				<th width="20%">Date</th>
				<th width="20%">Time</th>
				<th width="20%">Total Case</th>
				<th width="20%">Total Deaths</th>
				<th width="20%">Total recovered</th>
				<th width="20%">Total Case Per one minute</th>
			</tr>
		</tfoot>

			<?php 
// "Name":"Pit, Loka"
//$current = $data->Current->Item; //"Current":{"Item":"16","test":"test","test":"84","test":"ok"}

$query = "SELECT * from corona_update ORDER BY `corona_update`.`deaths`  DESC";
$result = mysqli_query($con,$query);
while ($row = mysqli_fetch_assoc($result)) {

    echo "<tr><td>";
    echo $row['date']; 
    echo "</td><td>";
    echo $row['time'];
    echo "</td><td>";
    echo $row['totalcase'];
    echo "</td><td>";
    echo $row['deaths'];
    echo "</td><td>";
    echo $row['recovered'];
    echo "</td><td>";
    echo $row['caseperminute'];
    echo "</td></tr>";

}

?>
			
		</table>
	</div>



 
		<!-- Table Start Here -->
		
		<!-- footer-copyright start -->
		<footer class="footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="foot-copyright pull-left">
							<p>
								 | Copyright &copy;  Mehedi Hasan Sabuj
							</p>
						</div><!--/.foot-copyright-->
					</div><!--/.col-->
					<div class="col-sm-5">
						<div class="foot-menu pull-right
						">	  
						</div><!-- /.foot-menu-->
					</div><!--/.col-->
				</div><!--/.row-->
				<div id="scroll-Top">
					<i class="fa fa-angle-double-up return-to-top" id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
				</div><!--/.scroll-Top-->
			</div><!-- /.container-->

		</footer><!-- /.footer-copyright-->
		<!-- footer-copyright end -->



		<!-- jaquery link -->

		<script src="assets/js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        
        <!--modernizr.min.js-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		
		<!--bootstrap.min.js-->
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>
		
		<!-- for manu -->
		<script src="assets/js/jquery.hc-sticky.min.js" type="text/javascript"></script>

		
		<!-- vedio player js -->
		<script src="assets/js/jquery.magnific-popup.min.js"></script>


		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

		<!-- isotope js -->
		<!-- <script src="assets/js/masonry.min.js"></script>
		<script src="assets/js/isotop-custom.js"></script> -->

        <!--owl.carousel.js-->
        <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
		
		<!-- counter js -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>
		
        <!--Custom JS-->
        <script type="text/javascript" src="assets/js/jak-menusearch.js"></script>
        <script type="text/javascript" src="assets/js/custom.js"></script>



   

    <!-- Bootstrap core JavaScript-->
    <script src="assets/jquery.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="assets/jquery.datatables.min.js"></script>

    <script src="assets/datatables.bootstrap4.min.js"></script>
        <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>


	
    <script src="assets/extra/js/materialize.js"></script>
    <script src="assets/extra/js/coronaCounter.js"></script>
    <script src="assets/extra/js/canvas.min.js"></script>
    <script src="assets/extra/js/infectedpeoplechart.js"></script>
    <script src="assets/extra/js/plugin.js"></script>
    <script src="assets/extra/js/darkMood.js"></script>



    <script>
      window.onscroll = scroll1;
      function scroll1() {
        var toTop = document.getElementById("scrollTop");
        window.scrollY > 500
          ? (toTop.style.display = "Block")
          : (toTop.style.display = "none");
      }
      function toTop() {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      }
    </script>		

    </body>
	
</html>



<style type="text/css" media="screen">
td, th{height:40px; width:40px; }
table {  border:1px solid red; padding:0;   border-collapse: separate; border-radius:15px; border-spacing:0}
td, th  { text-align: center; vertical-align: middle;  border: none; }
td + td, th + th {border-left:1px solid #555}
th, tr td  {border-bottom:1px solid #555; }
tfoot td {border-bottom:none}
td:first-child {border-left:none}
td:last-child {border-right:none}
thead +tr td,  tr+ tr td, tfoot td{border-top:none;}

th:first-child { -webkit-border-radius:15px 0 0 0; border-left:none}
th:last-child{ -webkit-border-radius:0 15px 0 0;border-right:none }
tfoot td:first-child{  -webkit-border-radius:0 0 0 15px ;}
tfoot td:last-child{  -webkit-border-radius:0 0 15px 0;}
</style>


<style type="text/css">
	/* For desktop: */
.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}

@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }
}
</style>



