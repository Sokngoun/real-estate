<div class="app-wrapper bg-light">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<style>
				.msg_validation {
					color: red;
				}
			</style>

			<?php
			$msg1 = $msg2 = $msg3 = '';

			if (isset($_POST['btnsave'])) {
				$property_name = $_POST['txt_property_name'];
				$property_price =  $_POST['txt_property_price'];
				$property_description = $_POST['txt_property_description'];
				$property_location = $_POST['txt_property_location'];
				$property_type_id = $_POST['txt_property_type_id'];
				$property_status_id = $_POST['txt_property_status_id'];

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
								$sql = "insert into tbl_property(image,property_name,property_description,property_price,property_location,property_type_id,property_status_id) values('$filename','$property_name','$property_description','$property_price','$property_location','$property_type_id','$property_status_id')";
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
			}
			?>
			<!-- action="<?php $_SERVER['PHP_SELF'] ?>" -->
			<form class="settings-form app-card app-card-settings shadow-sm p-4 w-50" method="post" enctype="multipart/form-data">
				<h4>ចូលបំពេញអចលនទ្រព្យខាងក្រោម</h4>
				<input type="hidden" value="insert_property" name="p">
				<!-- <input type="hidden" name="p" value="property" id="insert"> -->
				<div class="d-flex justify-content-between gap-4">
					<div class="mb-3 w-50">
						<label for="txt_property_name" class="form-label">ឈ្មោះអចលនទ្រព្យ<span>*</span></label>
						<input type="text" class="form-control" id="txt_property_name" name="txt_property_name" value="">
						<?php echo $msg1 ?>
					</div>
					<div class="mb-3 w-50">
						<label for="txt_property_price" class="form-label">តម្លៃអចលនទ្រព្យ<span>*</spn></label>
						<input type="text" class="form-control" id="txt_property_price" name="txt_property_price" value="">
						<?php echo $msg2 ?>
					</div>
				</div>
				<div class="mb-3">
					<label for="txt_property_description" class="form-label">បរិយាយ</label>
					<textarea class="form-control" id="txt_property_description" name="txt_property_description" row="3" name="tar_desc" style="height: 100px;"></textarea>
				</div>
				<div class="mb-3">
					<label for="txt_property_location" class="form-label">ទីតាំងអចលនទ្រព្យ<span>*</spn></label>
					<input type="text" class="form-control" id="txt_porperty_location" name="txt_property_location" value="" required>
				</div>
				<div class="d-flex w-auto gap-4 mb-4 justify-content-between">
					<div class="w-100">
						<label for="property_image" class="form-label">ស្ថានភាពអចលនទ្រព្យ<span>*</spn></label>
						<select class="form-select w-100" id="txt_property_status" name="txt_property_status_id">
							<option selected value="" disabled>ស្ថានភាពអចលនទ្រព្យ</option>
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
					<div class="w-100">
						<label for="property_image" class="form-label">ប្រភេទអចលនទ្រព្យ<span>*</spn></label>
						<select class="form-select w-100" id="txt_property_type" name="txt_property_type_id">
							<option selected value="" disabled>ប្រភេទអចលនទ្រព្យ</option>
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
				<?php echo $msg3 ?>

				<button type="submit" name="btnsave" class="btn app-btn-primary">រក្សាទុក</button>
			</form>
		</div>
	</div>
</div>