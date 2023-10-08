<?php
$user_id = "";
$user_name = "";
$user_password = "";
$user_role = "";
$email = "";
$phone = "";
$location = "";
$image = "";

$msg = "";
// session_start();


if (isset($_SESSION['user_name'])) {
	$user_name = $_SESSION['user_name'];
	$sql = "select u.user_id, u.user_name, u.user_password, r.role_name,u.email, u.phone,u.location from tbl_user u
			left join tbl_role r 
			on u.role_id = r.role_id 
			where user_name = '" . $user_name . "'  ;";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_array($result)) {
		$user_id = $row[0];
		$user_password = $row[2];
		$user_role = $row[3];
		$email = $row[4];
		$phone = $row[5];
		$location = $row[6];
	}
}


if (isset($_POST['btnChangeName'])) {
	$user_name =$_POST['txt_user_name'] ;
	$sql = "update tbl_user set user_name ='" . $user_name . "' where user_id = '" . $user_id . "';";
	if (mysqli_query($conn, $sql)) {
		// $_SESSION['user_name'] = $user_name;
		session_destroy();
		// setcookie('user_name',"", time()-3600,"/");
		// setcookie('user_password', "", time()-3600,"/");
		$msg = "កែប្រែឈ្មោះបានជោគជ័យ " . $user_name;
	} else {
		echo "Error Inserting data " . $sql . mysqli_error($conn);
	}
}

if (isset($_POST['btnChangeEmail'])) {
	// $sql = "update tbl_user set phone ='" . $_POST['txt_user_phone'] . "' where user_id = '" . $user_id . "';";
	$email =  $_POST['txt_user_email'];
	$sql ="update tbl_user set email = '".$email."' where user_id = '".$user_id."';";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$msg = "កែប្រែបានជោគជ័យ " . $_POST['txt_user_email'];
	} else {
		echo "Error Inserting data " . $sql . mysqli_error($conn);
	}
}

if (isset($_POST['btnChangePhone'])) {
	// $sql = "update tbl_user set phone ='" . $_POST['txt_user_phone'] . "' where user_id = '" . $user_id . "';";
	$phone =  $_POST['txt_user_phone'];
	$sql ="update tbl_user set phone = '".$phone."' where user_id = '".$user_id."';";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$msg = "កែប្រែបានជោគជ័យ " . $_POST['txt_user_phone'];
	} else {
		echo "Error Inserting data " . $sql . mysqli_error($conn);
	}
}

if (isset($_POST['btnChangeLocation'])) {
	// $sql = "update tbl_user set phone ='" . $_POST['txt_user_phone'] . "' where user_id = '" . $user_id . "';";
	$location = $_POST['txt_user_location'];
	$sql ="update tbl_user set location = '".$location ."' where user_id = '".$user_id."';";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$msg = "កែប្រែបានជោគជ័យ " . $_POST['txt_user_location'];
	} else {
		echo "Error Inserting data " . $sql . mysqli_error($conn);
	}
}

if (isset($_POST['btnChangeRole'])) {
	// $sql = "update tbl_user set phone ='" . $_POST['txt_user_phone'] . "' where user_id = '" . $user_id . "';";
	$sql ="update tbl_user set role = '". $_POST['txt_user_role']."' where user_id = '".$user_id."';";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$_SESSION['user_password'] = $_POST['txt_user_password'];
		unset($_COOKIE['user_password']);
		$msg = "កែប្រែបានជោគជ័យ " . $_POST['txt_user_role'];
	} else {
		echo "Error Inserting data " . $sql . mysqli_error($conn);
	}
}


if (isset($_POST['btnChangePassword'])) {
	// $sql = "update tbl_user set phone ='" . $_POST['txt_user_phone'] . "' where user_id = '" . $user_id . "';";
	$sql ="update tbl_user set user_password = '". $_POST['txt_user_password']."' where user_id = '".$user_id."';";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$msg = "កែប្រែបានជោគជ័យ" . $_POST['txt_user_password'];
	} else {
		echo "Error Inserting data " . $sql . mysqli_error($conn);
	}
}

?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<h1 class="app-page-title">My Account</h1>	
			<?= $msg !== "" ? msg_style($msg, "success") : "" ?>
			<!--Modal--->
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="p" value="account" />
				<div class="modal fade" id="changeName" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Edit Name</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- <input type="hidden" name="p" value="property" id="insert"> -->
								<div class="mb-3">
									<label for="txt_property_name" class="form-label">ឈ្មោះ<span>*</span></label>
									<input type="text" class="form-control" id="txt_property_name" name="txt_user_name" value="<?= $user_name ?>">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="btnChangeName">Save changes</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="chnageEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Edit Email</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- <input type="hidden" name="p" value="property" id="insert"> -->
								<div class="mb-3">
									<label for="txt_user_email" class="form-label">សារ<span>*</span></label>
									<input type="text" class="form-control" id="txt_user_email" name="txt_user_email" value="<?= $email ?>">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="btnChangeEmail">Save changes</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="changePhone" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Edit Phone</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- <input type="hidden" name="p" value="property" id="insert"> -->
								<div class="mb-3">
									<label for="txt_user_phone" class="form-label">លេខទូរស័ព្ទ<span>*</span></label>
									<input type="text" class="form-control" id="txt_user_phone" name="txt_user_phone" value="<?= $phone ?>">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="btnChangePhone">Save changes</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="changeLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Edit Email</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<!-- <input type="hidden" name="p" value="property" id="insert"> -->
								<div class="mb-3">
									<label for="txt_user_location" class="form-label">សារ<span>*</span></label>
									<input type="text" class="form-control" id="txt_user_location" name="txt_user_location" value="<?= $location ?>">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="btnChangeLocation">Save changes</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--Modal--->
			<div class="row gy-4">
				<div class="col-12 col-lg-6">
					<div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
						<div class="app-card-header p-3 border-bottom-0">
							<div class="row align-items-center gx-3">
								<div class="col-auto">
									<div class="app-icon-holder">
										<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
										</svg>
									</div><!--//icon-holder-->

								</div><!--//col-->
								<div class="col-auto">
									<h4 class="app-card-title">User ID : <?= $user_id ?></h4>
								</div><!--//col-->
							</div><!--//row-->
						</div><!--//app-card-header-->
						<div class="app-card-body px-4 w-100">
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label mb-2"><strong>Photo</strong></div>
										<div class="item-data"><img class="profile-image" src="assets/images/user.png" alt=""></div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Change</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Name</strong></div>
										<div class="item-data"><?= $user_name !== "" ? ucfirst($user_name) : "No User Name" ?></div>
									</div><!--//col-->
									<div class="col text-end">
										<btton class="btn-sm app-btn-secondary" type="button" data-toggle="modal" data-target="#changeName">Change</button>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Email</strong></div>
										<div class="item-data"><?= $email !== "" ? ucfirst($email) : "No Email"; ?></div>
									</div><!--//col-->
									<div class="col text-end">
									<btton class="btn-sm app-btn-secondary" type="button" data-toggle="modal" data-target="#chnageEmail">Change</button>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Phone</strong></div>
										<div class="item-data"><?= $phone !== "" ? ucfirst($phone) : "No Phone" ?></div>
									</div><!--//col-->
									<div class="col text-end">
										<btton class="btn-sm app-btn-secondary" type="button" data-toggle="modal" data-target="#changePhone">Change</button>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Location</strong></div>
										<div class="item-data">
											<?= $location !== "" ? ucfirst($location) : "No Location"; ?>
										</div>
									</div><!--//col-->
									<div class="col text-end">
									<btton class="btn-sm app-btn-secondary" type="button" data-toggle="modal" data-target="#changeLocation">Change</button>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Role</strong></div>
										<div class="item-data">
											<?= $user_role !== "" ? ucfirst($user_role) : "No Role"; ?>
										</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Change</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
						</div><!--//app-card-body-->
						<div class="app-card-footer p-4 mt-auto">
							<a class="btn app-btn-secondary" href="#">Manage Profile</a>
						</div><!--//app-card-footer-->

					</div><!--//app-card-->
				</div><!--//col-->
				<div class="col-12 col-lg-6">
					<div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
						<div class="app-card-header p-3 border-bottom-0">
							<div class="row align-items-center gx-3">
								<div class="col-auto">
									<div class="app-icon-holder">
										<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
										</svg>
									</div><!--//icon-holder-->

								</div><!--//col-->
								<div class="col-auto">
									<h4 class="app-card-title">Preferences</h4>
								</div><!--//col-->
							</div><!--//row-->
						</div><!--//app-card-header-->
						<div class="app-card-body px-4 w-100">

							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Language </strong></div>
										<div class="item-data">English</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Change</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Time Zone</strong></div>
										<div class="item-data">Central Standard Time (UTC-6)</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Change</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Currency</strong></div>
										<div class="item-data">$(US Dollars)</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Change</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Email Subscription</strong></div>
										<div class="item-data">Off</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Change</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>SMS Notifications</strong></div>
										<div class="item-data">On</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Change</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
						</div><!--//app-card-body-->
						<div class="app-card-footer p-4 mt-auto">
							<a class="btn app-btn-secondary" href="#">Manage Preferences</a>
						</div><!--//app-card-footer-->

					</div><!--//app-card-->
				</div><!--//col-->
				<div class="col-12 col-lg-6">
					<div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
						<div class="app-card-header p-3 border-bottom-0">
							<div class="row align-items-center gx-3">
								<div class="col-auto">
									<div class="app-icon-holder">
										<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z" />
											<path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
										</svg>
									</div><!--//icon-holder-->

								</div><!--//col-->
								<div class="col-auto">
									<h4 class="app-card-title">Security</h4>
								</div><!--//col-->
							</div><!--//row-->
						</div><!--//app-card-header-->
						<div class="app-card-body px-4 w-100">

							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Password</strong></div>
										<div class="item-data">
											<input type="password" class="form-control border-0" name="user_password" value="<?= $user_password !== "" ? ucfirst($user_password) : "No Password"; ?>" />
										</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Change</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><strong>Two-Factor Authentication</strong></div>
										<div class="item-data">You haven't set up two-factor authentication. </div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Set up</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
						</div><!--//app-card-body-->

						<div class="app-card-footer p-4 mt-auto">
							<a class="btn app-btn-secondary" href="#">Manage Security</a>
						</div><!--//app-card-footer-->

					</div><!--//app-card-->
				</div>
				<div class="col-12 col-lg-6">
					<div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
						<div class="app-card-header p-3 border-bottom-0">
							<div class="row align-items-center gx-3">
								<div class="col-auto">
									<div class="app-icon-holder">
										<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-credit-card" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
											<path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
										</svg>
									</div><!--//icon-holder-->

								</div><!--//col-->
								<div class="col-auto">
									<h4 class="app-card-title">Payment methods</h4>
								</div><!--//col-->
							</div><!--//row-->
						</div><!--//app-card-header-->
						<div class="app-card-body px-4 w-100">

							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><i class="fab fa-cc-visa me-2"></i><strong>Credit/Debit Card </strong></div>
										<div class="item-data">1234*******5678</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Edit</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
							<div class="item border-bottom py-3">
								<div class="row justify-content-between align-items-center">
									<div class="col-auto">
										<div class="item-label"><i class="fab fa-paypal me-2"></i><strong>PayPal</strong></div>
										<div class="item-data">Not connected</div>
									</div><!--//col-->
									<div class="col text-end">
										<a class="btn-sm app-btn-secondary" href="#">Connect</a>
									</div><!--//col-->
								</div><!--//row-->
							</div><!--//item-->
						</div><!--//app-card-body-->
						<div class="app-card-footer p-4 mt-auto">
							<a class="btn app-btn-secondary" href="#">Manage Payment</a>
						</div><!--//app-card-footer-->

					</div><!--//app-card-->
				</div>
			</div><!--//row-->

		</div><!--//container-fluid-->
	</div><!--//app-content-->
	<footer class="app-footer">
		<div class="container text-center py-3">
			<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			<small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>

		</div>
	</footer><!--//app-footer-->
</div><!--//app-wrapper-->