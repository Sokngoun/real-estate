<?php
	$page = 1;
	$totalPage = 1;
	$itemsPerPage = 4;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	$sql= 'select * from tbl_property';
	$items = mysqli_query($conn, $sql);
	$totalPage = ceil($items->num_rows / $itemsPerPage); 
?>


<div class="app-wrapper kh-font">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<style>
				.msg_validation {
					color: red;
				}
			</style>

			<?php
			$msg1 = $msg2 = $msg3 = '';
			$filter = '';
			if (isset($_POST['btnUpdate'])) {
				$property_id= $_POST['txt_property_id'];
				$property_name = $_POST['txt_property_name'];
				$property_price =  $_POST['txt_property_price'];
				$property_description = $_POST['txt_property_description'];
				$property_location = $_POST['txt_property_location'];
				$property_type_id = 2;
				$property_status_id = 21;
				// $property_status = $_POST['txt_property_status'];
				// $porperty_type = $_POST['txt_property_type'];
				$msg_name = "<div class='msg_validation'>សូមបញ្ចូលឈ្មោះអចលនទ្រព្យ</div>";
				$msg_price = "<div class='msg_validation'>សូមបញ្ចូលតម្លៃអចលនទ្រព្យ</div>";
				$msg_image = "<p class='msg_validation'>សូមជ្រើសរើសរូបអចនទ្រព្យ</p>";

				$filetmp = $_FILES['property_img']['tmp_name'];
				$filename = $_FILES['property_img']['name'];
				$filetype = $_FILES['property_img']['type'];
				$filesize = $_FILES['property_img']['size'];

				$fileExtension  = explode(".", $filename);
				$file_lower = strtolower(end($fileExtension));
				$extension = array('jpg', 'png', 'jpeg');

				// checking text file if emplty
				if (trim($property_name) == '') {
					$msg1 = $msg_name;
				}
				if (trim($property_price) == '') {
					$msg2 = $msg_price;
				}
				if ($filename == '') {
					$msg3 = $msg_image;
				} else {
					if ($filesize > 2097152) {
						echo msg_style("File size must be excately 2 MB", "info");
					} else {
						if (in_array($file_lower, $extension) === false) {
							echo msg_style("Extension not allowed, pls choose a jpeg, jpg, png!", "info");
						} else {
							if ($property_name != '' && $property_price != ''  && $filename != '') {
								move_uploaded_file($filetmp, "./assets/img/" . $filename);
								$sql = "update tbl_property set image='".$filenmae."',property_name='".$property_name."',property_description='".$property_description."',property_price='".$property_price."', property_location
								='".$property_location."',property_type_id=1,property_status_id=1 where property_id = '".$property_id."'"; 
								if (mysqli_query($conn, $sql)) {
									echo msg_style("បញ្ចូលទិន្នន័យបានជោគជ័យ", "success");
								} else {
									echo "Error Inserting data .$sql" . mysqli_error($conn);
								}
								//close connection 
								mysqli_close($conn);
							}
						}
					}
				}
				$sql = "update tbl_property set property_name='".$property_name."',property_description='".$property_description."',property_price='".$property_price."', property_location
								='".$property_location."',property_type_id=2,property_status_id=21 where property_id = '".$property_id."'"; 
				if (mysqli_query($conn, $sql)) {
					echo msg_style("កែប្រែទិន្នន័យបានជោគជ័យ", "success");
				} else {
					echo "Error Inserting data " . $sql . mysqli_error($conn);
				}
				//close connection 
				// mysqli_close($conn); 
			}
			
			if (isset($_POST['btnDelete'])) {
				$deleteId = $_POST['txt_property_id'];
				$sql = "delete from tbl_property where property_id = '$deleteId'";
				if (mysqli_query($conn, $sql)) {
					echo msg_style("លុបទិន្នន័យបានជោគជ័យ", "success");
				} else {
					echo "Error Inserting data " . $sql . mysqli_error($conn);
				}
			}
			if (isset($_POST['btnSearch'])) {
				// echo $_POST['txt_property_type_id'];
				$property_type_id = $_POST['txt_property_type_id'];
				$property_status_id = $_POST['txt_property_status_id'];
				$property_search_id = $_POST['txt_property_search'];
				if ($property_type_id != '') {
					$filter .= ' where p.property_type_id = "' . $property_type_id . '"';
				}

				if ($property_status_id != '' && $property_type_id != '') {
					$filter .= ' and p.property_status_id = "' . $property_status_id . '"';
				}

				if ($property_type_id == '' && $property_status_id != '') {
					$filter .= ' where p.property_status_id = "' . $property_status_id . '"';
				}



				if ($property_search_id != '' && $property_status_id == '' && $property_type_id != '') {
					$filter	.=  ' where p.property_type_id = "' . $property_type_id . '"' . ' and p.property_name like "%' . $property_search_id . '%"';
				}
				if ($property_search_id != '' && $property_status_id != '' && $property_type_id == '') {
					$filter	.= ' where p.property_status_id = "' . $property_status_id . '"' . ' and p.property_name like "%' . $property_search_id . '%"';
				}


				if ($property_search_id != '' && $property_status_id != '' && $property_type_id != '') {
					$filter	.= ' and p.property_name like "%' . $property_search_id . '%"';
				}

				if ($property_search_id != '' && $property_status_id == '' && $property_type_id == '') {
					$filter	.= ' where p.property_name like "%' . $property_search_id . '%"';
				}
			}
			?>
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">អចលនទ្រព្យ</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<form class="table-search-form row gx-1 align-items-center" method="post">
									<div class="col-auto">
										<select class="form-select w-auto" name="txt_property_type_id">
											<option selected value="">ជ្រើសរើសប្រភេទអចលនទ្រព្យ</option>
											<?php
											$result = mysqli_query($conn, "select * from tbl_property_type");
											while ($row = mysqli_fetch_array($result)) {
											?>
												<option value="<?= $row[0]; ?>"> <?php echo $row[2]; ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="col-auto">
										<select class="form-select w-auto" name="txt_property_status_id">
											<option value="">ជ្រើសរើសស្ថានភាពអចលនទ្រព្យ</option>
											<?php
											$result = mysqli_query($conn, "select * from tbl_property_status");
											while ($row = mysqli_fetch_array($result)) {
											?>
												<option value="<?= $row[0]; ?>"> <?php echo $row[1]; ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<input type="hidden" name="p" value="property">
									<div class="col-auto">
										<input type="text" id="search-orders" name="txt_property_search" class="form-control search-orders" placeholder="Search" value="">
									</div>
									<div class="col-auto">
										<button type="submit" class="btn app-btn-secondary" name="btnSearch">Search</button>
									</div>
								</form>
							</div>
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-secondary" href="#">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
										<path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
									</svg>
									Download CSV
								</a>
							</div>
						</div><!--//row-->
					</div><!--//table-utilities-->
				</div><!--//col-auto-->
			</div><!--//row-->
			<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				<a class="flex-sm-fill text-sm-center nav-link active" id="property_type_list_tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">បញ្ចីប្រភេទនៃអចលនទ្រព្យ</a>
				<!-- <a class="flex-sm-fill text-sm-center nav-link" id="order-pending-tab" data-bs-toggle="tab" href="#order-paid" role="tab" aria-controls="orders-paid" aria-selected="false">បង្កើតប្រភេទអចលនទ្រព្យថ្មី</a> -->
				<!-- <a class="flex-sm-fill text-sm-center nav-link active" id="property_type_list" data-bs-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true">បញ្ចីអចលនទ្រព្យ</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#insert" role="tab" aria-controls="insert" aria-selected="true">បង្កើតអចលនទ្រព្យ</a> -->
			</nav>
			<div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="property_type_list">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<table class="table app-table-hover mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">#</th>
											<th class="cell">រូបភាព</th>
											<th class="cell">ឈ្មោះអចលនទ្រព្យ</th>
											<th class="cell">តម្លៃអចលនទ្រព្យ</th>
											<th class="cell">បរិយាយ</th>
											<th class="cell">ប្រភេទអចលនទ្រព្យ</th>
											<th class="cell">ស្ថានភាព</th>
										</tr>
									</thead>
									<?php
									$sql = "select p.property_id,p.property_name,p.property_description,p.property_price,p.property_description,pt.property_type_kh,ps.property_status_name,p.image from tbl_property p
									inner join tbl_property_type pt on pt.property_type_id = p.property_type_id
									left join tbl_property_status ps on ps.property_status_id = p.property_status_id";
									if ($filter != '') {
										$sql .= $filter;
									}

									$per_page_record = 4;  // Number of entries to show in a page.   
									// Look for a GET variable page if not found default is 1.        
								   
									// if(isset($_POST['btnSearch'])){
									// 	$sql .= ' order by p.property_id desc LIMIT ' .$page.','. $itemsPerPage;
									// }

									$offset = ($page-1) * $itemsPerPage;
									$sql .= ' order by p.property_id asc LIMIT ' .$offset.','. $itemsPerPage;

									// $start_from = ($page-1) * $per_page_record;     
									
									$result = mysqli_query($conn, $sql);
								
									if($result){
										$items = $result->num_rows;
									}
					
									// $row = mysqli_fetch_array($result, MYSQLI_NUM);
									while ($row = mysqli_fetch_array($result)) {
									?>
										<tbody>
											<form method="post">
												<tr>
													<td class="cell"><?= $row[0] ?></td>
													<td class="cell"><?= $row[7] == '' ? 'No Image' : '<img src="./assets/img/' . $row[7] . '" width="50" height="50" alt="img">' ?></td>
													<td class="cell"><?= $row[2] ?></td>
													<td class="cell"><?= $row[3] ?></td>
													<td class="cell"><?= $row[2] ?></td>
													<td class="cell"><?= $row[5] ?></td>
													<td class="cell"><span class="badge  <?php echo $row[6] == 'Booked' ? 'bg-success' : ($row[6] == 'Sold' ? 'bg-info' : ($row[6] == 'Availiable' ? 'bg-warning' : 'bg-danger')) ?>">
															<?= $row[6] != '' ? $row[6] : 'N/A' ?>
														</span></td>
													<td class="cell">
														<button type="button" class="btn-sm app-btn-secondary text-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-regular fa-eye"></i></button>
														<button type="button" class="btn-sm app-btn-secondary text-primary" data-toggle="modal" data-target="#exampleModalCenter<?= $row[0] ?>">
															<i class="fa-solid fa-pen-to-square"></i>
														</button>
														<input type="hidden" name="p" value="property">
														<input type="hidden" name="txt_property_id" value="<?= $row[0] ?>">
														<button class="btn-sm app-btn-secondary text-danger" value="<?= $row[0] ?>" name="btnDelete" id="btnDelete" onclick="return confirm('Are you sure to delete?')"><i class="fa-solid fa-trash"></i></button>
													</td>
												</tr>
											</form>
											</tr>
										</tbody>
										<!-- Modal -->
										<!-- action="<?php $_SERVER['PHP_SELF'] ?>" -->
										<form method="post" enctype="multipart/form-data">
											<div class="modal fade" id="exampleModalCenter<?= $row[0] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">Edit Number <input class="form-control border-0" readonly type="text" name="txt_property_id" value="<?= $row[0] ?>" /></h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<!-- <input type="hidden" name="p" value="property" id="insert"> -->
															<div class="mb-3">
																<label for="txt_property_name" class="form-label">ឈ្មោះអចលនទ្រព្យ<span>*</span></label>
																<input type="text" class="form-control" id="txt_property_name" name="txt_property_name" value="<?= $row[2] ?>">
															</div>
															<div class="mb-3">
																<label for="txt_property_price" class="form-label">តម្លៃអចលនទ្រព្យ<span>*</spn></label>
																<input type="text" class="form-control" id="txt_property_price" name="txt_property_price" value="<?= $row[3] ?>">
															</div>
															<div class="mb-3">
																<label for="txt_property_description" class="form-label">បរិយាយ</label>
																<textarea class="form-control" id="txt_property_description" name="txt_property_description" row="3" name="tar_desc" style="height: 100px;"><?= $row[4] ?></textarea>
															</div>
															<div class="d-flex">
																<div class="mb-3 p-2">
																	<label for="txt_property_location" class="form-label">ទីតាំងអចលនទ្រព្យ<span>*</spn></label>
																	<input type="text" class="form-control" id="txt_porperty_location" name="txt_property_location" value="<?= $row[5] ?>" required>
																</div>
																<div class="mb-3 p-2">
																	<label for="txt_property_location" class="form-label">ស្ថានភាព<span>*</spn></label>
																	<input type="text" class="form-control" id="txt_porperty_location" name="txt_property_location" value="<?= $row[5] ?>" required>
																</div>
															</div>
															<label for="property_image" class="form-label">រូបភាពអចលនទ្រព្យ<span>*</spn></label>
															<div class="input-group mb-3">
																<div class="input-group-prepend">
																	<span class="input-group-text">Upload</span>
																</div>
																<div class="custom-file">
																	<input type="file" class="custom-file-input" id="property_img" name="property_img">
																	<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary" name="btnUpdate">Save changes</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									<?php
									}
									?>
									<?php
									if (mysqli_num_rows($result) < 1) {
									?>
										<td colspan="8" class="text-center">មិនមានទិន្នន័យទេ</td>
									<?php
									}
									?>
								</table>
							</div><!--//table-responsive-->

						</div><!--//app-card-body-->
					</div><!--//app-card-->
					<nav class="app-pagination">
			
						<ul class="pagination justify-content-center">
							<li class="page-item <?= $_GET['page'] <= 1 ? "disabled":""?>">
								<a class="page-link"  href="index.php?p=property&page=<?=$_GET['page']-1?>" >Previous</a>
							</li>
							<?php
								for($i=1; $i <= $totalPage; $i++){
							?>
								<li class="page-item <?= $_GET['page'] == $i ? "active" :""?>" ><a class="page-link" href="index.php?p=property&page=<?=$i?>"><?=$i?></a></li>
							<?php
								}
							?>
							<li class="page-item  <?= $_GET['page'] >= $totalPage ? "disabled":""?>">
								<a class="page-link" href="index.php?p=property&page=<?=$_GET['page']+1?>">Next</a>
							</li>
						</ul>
					
					</nav><!--//app-pagination-->

				</div><!--//tab-pane-->

			</div><!--//tab-content-->
		</div><!--//container-fluid-->
	</div><!--//app-content-->
	<footer class="app-footer">
		<div class="container text-center py-3">
			<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			<small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="https://my-portfolio-ten-tawny.vercel.app/" target="_blank">Chan Sokngoun</a> for developers</small>
		</div>
	</footer><!--//app-footer-->
</div><!--//app-wrapper-->


