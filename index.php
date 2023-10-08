<?php

  session_start();
  date_default_timezone_set("Asia/Phnom_Penh");
  include_once "./admin/config/config.php";

  if (isset($_GET['p'])) {
    $p=$_GET['p'];
  } else {
    $p='index';
  }
  
?>
<!-- start header -->
<?php include_once "pages/header.php" ?>
<!-- end header -->

<!-- Start Menu -->
<?php include_once "pages/menu.php" ?>
<!-- End Menu -->



<!-- Start Block Section -->
<?php
  if (isset($_GET['p'])) {
    include   "pages/" . $_GET['p'] . ".php";
  } else {
    include_once('pages/home.php'); 
  }
?>
<!-- End Block Section -->

<!-- Start Footer -->
<?php include_once('pages/footer.php'); ?>
<!-- End Footer -->

<div id="overlayer"></div>
<div class="loader">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jarallax.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/custom.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
</body>

</html>