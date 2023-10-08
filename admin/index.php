<?php 
	session_start();
	date_default_timezone_set('Asia/Phnom_Penh');

	include_once './config/config.php';

	include './pages/head.php';
	$p="";

	if(isset($_GET['p'])){
		$p=$_GET['p']; 
	}

	if(!($_SESSION['user_name']=="admin")){
		header('location:login.php');
	}
	
	
?>

<body class="app">   
<?php 
	include './pages/header.php';
?>
    
    
   
	<?php 
	if(isset($_GET['p'])){

		$p=$_GET['p']; 
		include  $_GET['p'] . '.php';
	}else{
		include './dashboard.php';
	}
	
	?>
 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script> 
    <script src="assets/js/index-charts.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 
    <script src="assets/js/charts-demo.js"></script> 
    <script src="assets/js/index-charts.js"></script> 
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>	
</html> 

