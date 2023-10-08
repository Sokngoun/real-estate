<div class="app-wrapper kh-font">

	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">ប្រភេទអចលនទ្រព្យ</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary">Search</button>
					                    </div>
					                </form>
							    </div><!--//col-->
							    <div class="col-auto">
								    <select class="form-select w-auto" >
										  <option selected value="option-1">All</option>
										  <option value="option-2">This week</option>
										  <option value="option-3">This month</option>
										  <option value="option-4">Last 3 months</option>	  
									</select>
							    </div>
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="#">
									    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
		  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
		</svg>
									    Download CSV
									</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="property_type_list_tab" 	data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">បញ្ចីប្រភេទនៃអចលនទ្រព្យ</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  		id="order-pending-tab" 	data-bs-toggle="tab" href="#order-paid" role="tab" aria-controls="orders-paid" aria-selected="false">បង្កើតប្រភេទអចលនទ្រព្យថ្មី</a>
				</nav>
				<?php
					#update
					if(isset($_POST['btnUpdate'])){
						$property_type_id = $_POST['txt_property_type_id'];
						$property_type_kh = $_POST['txt_property_type_kh'];
						$property_type_en = $_POST['txt_property_type_en'];
						$property_type_desc = $_POST['txt_property_type_desc'];
						if(trim($property_type_kh) != '' && trim($property_type_en) != ''){
							$sql = "update tbl_property_type 
							set property_type_en = '$property_type_en',
							property_type_kh = '$property_type_kh',
							property_type_desc = '$property_type_desc'
							where property_type_id = $property_type_id;";
							if(mysqli_query($conn,$sql)){
								msg_style("Update Data Row $property_type_id Successfuly. ","success");
							}
							else{
								msg_style("Update Data Fail.","info");

							}
		
						}
					}

					#delete 
					if(isset($_GET['btnDelete'])){

						$id = $_GET['txt_property_type_id'];
						$sql = mysqli_query($conn, "delete from tbl_property_type where property_type_id = $id;");
						if($sql){
							msg_style("Delete Data Row $id Successfuly.","success");
						}
						else{
							msg_style("Delete Data Fail.","info");

						}
						
					}
				?>
				<div class="tab-content" id="orders-table-tab-content">
					<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="property_type_list_tab">
							<div class="app-card app-card-orders-table shadow-sm mb-5">
								<div class="app-card-body">
									<div class="table-responsive">
										<table class="table app-table-hover mb-0 text-left">
											<thead>
												<tr>
													<th class="cell">#</th>
													<th class="cell">ប្រភេទអចលនទ្រព្យជាខ្មែរ</th>
													<th class="cell">ប្រភេទអចលនទ្រព្យជាអង់គ្លេស</th>
													<th class="cell">បរិយាយ</th>
													<th class="cell">សម្មភាព</th>
												</tr>
											</thead>
											<?php
												$sql = "Select * from tbl_property_type order by property_type_id desc";
												$result = mysqli_query($conn, $sql);
												// $row = mysqli_fetch_array($result, MYSQLI_NUM);
												while($row = mysqli_fetch_array($result)){
											
											?>
											<tbody>
												<form method='get' action="">
													<input type="hidden" value="property_type" name="p">
												<tr>
													<td class="cell"><input type="hidden" name="txt_property_type_id" id="txt_property_type_id" value="<?= $row['property_type_id'] ?>"><?= $row[0]?></td>
													<td class="cell"><span class="truncate"></span><?= $row[2]?></td>
													<td class="cell"><?= $row[1]?></td>
													<td class="cell"><span class=""><?= $row[3]?></span></td>
													<td class="cell">
														<a class="btn-sm app-btn-secondary text-primary" href="#" ><i class="fa-regular fa-eye"></i></a>
														<a class="btn-sm app-btn-secondary" href="#" data-toggle='modal' data-bs-toggle="modal" data-bs-target="#editModal<?= $row[0]?>">
															<i class="fa-solid fa-pen-to-square"></i>
														</a>
														<button class="btn-sm app-btn-secondary text-danger" href="" name="btnDelete" id="btnDelete" onclick="return confirm('Are you sure to delete?')"><i class="fa-solid fa-trash"></i></button></td>	
												</tr>
												</form>
											</tbody>
											<?php
											
												echo '
													<!-- Modal -->
													<div class="modal fade" id="editModal'.$row[0].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLongTitle">កែប្រែព័ត៍មានអចលនទ្រព្យខាងក្រោម</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form class="settings-form" method="post" action="#">
																	<input type="text" name="txt_property_type_id" id="txt_property_type_id" value="'.$row['property_type_id'].'" >
																	<div class="mb-3">
																		<label for="txt_property_type_kh" class="form-label">ប្រភេទអចលនទ្រព្យជាខ្មែរ<span>*</span></label>
																		<input type="text" class="form-control" id="txt_property_type_kh" name="txt_property_type_kh" value="'.$row['property_type_kh'].'" required>
																	</div>
																	<div class="mb-3">
																		<label for="txt_property_type_en" class="form-label">ប្រភេទអចលនទ្រព្យជាអង់គ្លេស<span>*</spn></label>
																		<input type="text" class="form-control" id="txt_property_type_en" name="txt_property_type_en" value="'.$row['property_type_en'].'" required>
																	</div>
																	<div class="mb-3">
																		<label for="txt_property_desc" class="form-label">បរិយាយ</label>
																		<textarea class="form-control" id="txt_property_desc" name="txt_property_type_desc" row="3" name="tar_desc"
																			style="height: 100px;">
																			'.$row['property_type_desc'].'
																		</textarea>
																	</div>
																	<div class="modal-footer">
																		<button type="cancel" class="btn btn-secondary" data-dismiss="modal">មិនកែប្រែ</button>
																		<button type="btn" class="btn btn-primary" name="btnUpdate">កែប្រែ</button>
																	</div>
																</form>
															</div>
														</div>
													
													</div>
													</div>
												';
												}
											?>
										</table>
									</div><!--//table-responsive-->
								
								</div><!--//app-card-body-->		
							</div><!--//app-card-->
							
							<nav class="app-pagination">
								<ul class="pagination justify-content-center">
									<li class="page-item disabled">
										<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
									</li>
									<li class="page-item active"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item">
										<a class="page-link" href="#">Next</a>
									</li>
								</ul>
							</nav><!--//app-pagination-->
					</div><!--//tab-pane-->
			        <div class="tab-pane fade" id="order-paid" role="tabpanel" aria-labelledby="order-pending-tab">
						<div class="col-12 col-md-8">
							<div class="app-card app-card-settings shadow-sm p-4">
								<div class="app-card-body">
									<?php
										// check connection 
										if($conn === false){
											die("Error! could not connect".mysqli_connect_error());
										}
										//performing inserting data into DB
										if(isset($_POST['btnsave'])){
											$property_type_kh = $_POST['txt_property_type_kh'];
											$property_type_en = $_POST['txt_property_type_en'];
											$property_type_des = $_POST['txt_property_type_desc'];
											$sql = "INSERT INTO `tbl_property_type` (`property_type_en`, `property_type_kh`, `property_type_desc`)
											 			VALUES ('$property_type_kh','$property_type_en','$property_type_des');";
											if(mysqli_query($conn,$sql)){
												msg_style("Insert Data Successfuly.","success");
											}else{
												echo "Error Inserting data .$sql".mysqli_error($conn);
											}
											//close connection 
											mysqli_close($conn);
										}
									?>
									<h4>ចូលបំពេញប្រភេទអចលនទ្រព្យខាងក្រោម</h4>
									
									<form class="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']?>">
										<div class="mb-3">
											<label for="txt_property_type_kh" class="form-label">ប្រភេទអចលនទ្រព្យជាខ្មែរ<span>*</span></label>
											<input type="text" class="form-control" id="txt_property_type_kh" name="txt_property_type_kh" value="" required>
										</div>
										<div class="mb-3">
											<label for="txt_property_type_en" class="form-label">ប្រភេទអចលនទ្រព្យជាអង់គ្លេស<span>*</spn></label>
											<input type="text" class="form-control" id="txt_property_type_en" name="txt_property_type_en" value="" required>
										</div>
										<div class="mb-3">
											<label for="txt_property_desc" class="form-label">បរិយាយ</label>
											<textarea class="form-control" id="txt_property_desc" name="txt_property_type_desc" row="3" name="tar_desc" 
												style="height: 100px;"></textarea>
										</div>
										<button type="submit" name="btnsave" class="btn app-btn-primary" >កត់ទុក</button>
									</form>
								</div><!--//app-card-body-->
							</div><!--//app-card-->
						</div>
			        </div><!--//tab-pane--> 
				</div><!--//tab-content-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
    </div><!--//app-wrapper-->    					

 

<!-- <script>
	
</script> -->

<script>
	$(document).ready(function(){
		$('#property_type_list_tab').click(function(){
			window.location.href='index.php?p=property_type';
		})
	})
</script>