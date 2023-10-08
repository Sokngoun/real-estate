<?php
session_start();

include_once './config/config.php';

include './pages/head.php';


	if(isset($_POST['btnLogIn'])){
		$user_name = $_POST['txt_user_name'];
		$user_password = md5($_POST['txt_user_password']);
		
		$sql = "select * from tbl_user where user_name = '$user_name' and user_password = '$user_password';";
		$result = mysqli_query($conn, $sql);

		if(isset($_POST['chk_remember'])){
			if(isset($_COOKIE['user_name']) == '' && isset($_COOKIE['user_password']) == ''){
				// setcookie('user_name', $_POST['txt_user_id'], time() + 60*60*24*30);
				setcookie('user_name', $_POST['txt_user_name'], time() + 60*60*24*30);
				setcookie('user_password', $_POST['txt_user_password'], time() + 60*60*24*30);
			}
		}else{
			if(isset($_COOKIE['user_name']) !== '' && isset($_COOKIE['user_password']) !== ''){
				// setcookie('user_name', $_POST['txt_user_id'], time() + 60*60*24*30);
				setcookie('user_name', $_POST['txt_user_name'], time());
				setcookie('user_password', $_POST['txt_user_password'], time());
			}
		}
		
		if(mysqli_fetch_array($result)){
			// $_SESSION['user_id'] = "1";
			if(isset($_SESSION['user_name']) && isset($_SESSION['user_password'])){
				unset($_SESSION['user_name']);
				unset($_SESSION['user_password']);
			}
			else{
				$_SESSION['user_name'] = $_POST['txt_user_name'];
				$_SESSION['user_password'] = $_POST['txt_user_password'];
			}
			header('location:index.php');
		}else{
			if($_POST['txt_user_name'] == "" && $_POST['txt_user_password'] == ""){
				echo "<script>alert('Please enter your user name and password!')</script>";
			}else if($_POST['txt_user_name'] == ""){
				echo "<script>alert('Please enter your user name!')</script>";
			}else if($_POST['txt_user_password'] == ""){
				echo "<script>alert('Please enter your password!')</script>";
			}else{
				echo "<script>alert('Your user name or password is incorrect!')</script>";
			}
		}
	}
?>


<body class=" w-full flex align-content-center justify-content-center">
		<div class="row g-0 app-auth-wrapper">
			<div class="col-12 auth-main-col text-center p-5">
				<div class="d-flex flex-column align-content-end">
					<div class="app-auth-body mx-auto">
						<div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
						<h2 class="auth-heading text-center mb-5">Log in to Portal</h2>
						<div class="auth-form-container text-start">
							<form class="auth-form login-form" method="post">
								<div class="user mb-3">
									<label class="sr-only" for="signin-email">User Name</label>
									<input id="signin-email" name="txt_user_name" type="text" class="form-control signin-email" placeholder="User Name" required="required" value="<?php if(isset($_COOKIE['user_name'])){ echo $_COOKIE['user_name'];}else{ echo "";}?>">
								</div><!--//form-group-->
								<div class="password mb-3">
									<label class="sr-only" for="signin-password">Password</label>
									<input id="signin-password" name="txt_user_password" type="password" class="form-control signin-password" placeholder="Password" required="required" value="<?php if(isset($_COOKIE['user_password'])){ echo $_COOKIE['user_password'];}else{ echo "";}?>">
									<div class="extra mt-3 row justify-content-between">
										<div class="col-6">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="RememberPassword" name="chk_remember" <?= isset($_COOKIE['user_name']) != "" ?  "checked":"" ?> >
												<label class="form-check-label" for="RememberPassword">
													Remember me
												</label>
											</div>
										</div><!--//col-6-->
										<div class="col-6">
											<div class="forgot-password text-end">
												<a href="reset-password.html">Forgot password?</a>
											</div>
										</div><!--//col-6-->
									</div><!--//extra-->
								</div><!--//form-group-->
								<div class="text-center">
									<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto" name="btnLogIn">Log In</button>
								</div>
							</form>

							<div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.php">here</a>.</div>
						</div><!--//auth-form-container-->

					</div><!--//auth-body-->

					<footer class="app-auth-footer">
						<div class="container text-center py-3">
							<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
							<small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>

						</div>
					</footer><!--//app-auth-footer-->
				</div><!--//flex-column-->
			</div><!--//auth-main-col-->


		</div><!--//row-->



</body>

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