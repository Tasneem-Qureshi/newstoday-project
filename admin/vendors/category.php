<?php
include "inc/header.php";
?>
<!-- new category add -->
<?php
$err_msg='';
if(isset($_POST['add_cat'])){
	
	$name      = $_POST['name'];
	$p_cat_id  = $_POST['p_cat_id'];
	$status    = $_POST['status'];
$file_name =  $_FILES['image']['name'];
	$tmp_name =  $_FILES['image']['tmp_name'];
	
	if(empty($p_cat_id)){
		$p_cat_id = 0;
	}
	$extns = array('jpg', 'png', 'jpeg');
	$var_parts = explode('.',$_FILES['image']['name']);
	$extension = strtolower(end($var_parts));
	if(in_array($extension , $extns) === true){
		$random = rand();
		$updated_img = $random.$file_name;
		move_uploaded_file($tmp_name, 'images/category/'.$updated_img);
$cat_insert = "INSERT INTO category (c_name, c_image, is_sub, c_status) VALUES ('$name', '$updated_img', '$p_cat_id', '$status')";
	$insert_res = mysqli_query($db,$cat_insert);
	
	if($insert_res){
		header('Location: category.php');
	}else{
		die('category insert error!'.mysqli_error($db));
	}
	}else{
		$err_msg = 'Please select an image(png,jpg,jpeg)';
	}
}
?>
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			
			<div class="col-md-5 grid-margin stretch-card">

				<?php
				if(isset($_GET['edit_id'])){
					$edit_id = $_GET['edit_id'];
					$cat_sql = "SELECT * FROM category WHERE c_id = '$edit_id'";
					$cat_res = mysqli_query($db,$cat_sql);
					$serial = 0;
					$row = mysqli_fetch_assoc($cat_res);
					$c_id2  		= $row['c_id'];
					$c_name2  	= $row['c_name'];
					$c_image2  	= $row['c_image'];
					$is_sub2  	= $row['is_sub'];
					$c_status2  	= $row['c_status'];
					$serial++;
					?>

					<div class="card">
					<div class="card-body">
						<h4 class="card-title">Edit Category Information</h4>
						
						<form class="forms-sample" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="cat_name">Category Name</label>
								<input type="text" class="form-control" id="cat_name" value="<?php echo $c_name2;?>" placeholder="Category Name" name="name" required>
							</div>
							<div class="form-group">
								<label for="parent_cat">Select Parent Category</label>
								<select class="form-control form-control-sm" id="parent_cat" name="p_cat_id">
									<option>Select Parent Category</option>
									
									<?php
										$cat_sql3 = "SELECT * FROM category WHERE c_status = '1' AND is_sub = '0'";
										$cat_res3 = mysqli_query($db,$cat_sql3);
										
										while($row = mysqli_fetch_assoc($cat_res3)){
													$c_id  		= $row['c_id'];
												$c_name  	= $row['c_name'];
												$is_sub  	= $row['is_sub'];
									?>
									<option value="<?php echo $c_id;?>" <?php if($is_sub2 == $c_id)echo 'selected';?>><?php echo $c_name;?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="c_status">Category Status</label>
								<select class="form-control form-control-sm" id="c_status" name="status">
									<option value="1" <?php if($c_status2 == 1) echo 'selected';?>>Active</option>
									<option value="0" <?php if($c_status2 == 0) echo 'selected';?>>Inactive</option>
								</select>
							</div>
							<div class="form-group">
								<input type="file" id="choose-file" name="image" class="form-control" accept="image/*" />
								<small class="text-danger"><?php echo $err_msg;?></small>
								<div id="img-preview" class="my-3"></div>
								<?php
									if(!empty($c_image2)){
								?>
								<img src="images/category/<?php echo $c_image2;?>" width="150">
								<?php
								}
								?>
							</div>
							
							
							<button type="submit" class="btn btn-primary mr-2" name="update_cat">Submit</button>
							<button class="btn btn-light">Cancel</button>
						</form>
						<?php
							if(isset($_POST['update_cat'])){
											$name 			= $_POST['name'];
									$p_cat_id 	= $_POST['p_cat_id'];
										$status 		= $_POST['status'];
									$file_name 	= $_FILES['image']['name'];
									$tmp_name 	= $_FILES['image']['tmp_name'];
								if(!empty($file_name)){
									$extns = array('jpg', 'png', 'jepg');
									$var_parts = explode('.', $_FILES['image']['name']);
									$extension = strtolower(end($var_parts));
									if(in_array($extension,$extns) === true){
										$random = rand();
										$file_name = $random.$file_name;
										
										move_uploaded_file($tmp_name, 'images/category/'.$file_name);
										$edit_sql = "UPDATE category SET c_name='$name', c_image='$file_name', is_sub='$p_cat_id', c_status='$status' WHERE c_id='$edit_id'";
									}else{
										$err_msg = 'Please insert an image file (png,jpg,jpeg)!';
									}
								}else{
									$edit_sql = "UPDATE category SET c_name='$name', is_sub='$p_cat_id', c_status='$status' WHERE c_id='$edit_id'";
								}
								$edit_res = mysqli_query($db, $edit_sql);
								if($edit_res){
									header('Location: category.php');
								}else{
									die('Category Edit Error!'.mysqli_error($db));
								}
								
							}
						?>
					</div>
				</div>


				<?php
				}else{
					?>

									<div class="card">
					<div class="card-body">
						<h4 class="card-title">Add New Category</h4>
						
						<form class="forms-sample" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="cat_name">Category Name</label>
								<input type="text" class="form-control" id="cat_name" placeholder="Category" name="name">
							</div>
							
							<div class="form-group">
								<label for="parent_cat">Select Parent Category</label>
								<select class="form-control form-control-sm" id="parent_cat"name="p_cat_id">
									<option selected>Select Parent Category</option>
									<?php
									$cat_sql3 = "SELECT * FROM category WHERE c_status ='1' AND is_sub = '0'";
										$cat_res3 = mysqli_query($db,$cat_sql3);
										$serial = 0;
										while($row = mysqli_fetch_assoc($cat_res3)){
																	$c_id  		= $row['c_id'];
														$c_name  	= $row['c_name'];
														$is_sub  	= $row['is_sub'];
									?>
									<option value="<?php echo $c_id; ?>"><?php echo $c_name;?></option>
									<?php
									is_sub_cat($c_id);
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="c_status">Category Status</label>
								<select class="form-control form-control-sm" id="c_status" name="status">
									
									<option value="1" selected>Active</option>
									<option value="0">inactive</option>
								</select>
							</div>
							<!-- image preview code -->
							<div class="form-group">
								<label>Set Category Thumbnail</label>
								<input type="file" id="choose-file" name="image" accept="image/*" / class="form-control" width="48" height="48">
								<small class="text-danger"><?php echo $err_msg;?></small>
								<div id="img-preview"class="my-3"></div>
							</div>
							
							
							<button type="submit" class="btn btn-primary mr-2" name="add_cat">Submit</button>
							<button class="btn btn-light">Cancel</button>
						</form>
					</div>
				</div>

					<?php
				}
				?>
			</div>
			<div class="col-md-7 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<p class="card-title mb-0">All Categories</p>
						<div class="table-responsive">
							<table class="table table-striped table-borderless">
								<thead>
									<tr>
										<th>#</th>
										<th>Icon</th>
										<th>Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									
									<?php
										$cat_sql = "SELECT * FROM category WHERE is_sub = '0'";
										$cat_res = mysqli_query($db,$cat_sql);
										$serial = 0;
										while($row = mysqli_fetch_assoc($cat_res)){
																	$c_id  		= $row['c_id'];
														$c_name  	= $row['c_name'];
														$c_image  	= $row['c_image'];
														$is_sub  	= $row['is_sub'];
														$c_status  	= $row['c_status'];
											$serial++;
									?>
									<tr>
										<td><?php echo $serial;?></td>
										<td><img src="images/category/<?php echo $c_image;?>"></td>
										<td><?php echo $c_name;?></td>
										<td>
											<?php
											if($c_status ==1){
												echo '<span class="badge badge-success">Active</span>';
											}else{
												echo '<span class="badge badge-danger">Inactive</span>';
											}
											?>
											
										</td>
										<td class="font-weight-medium">
											<a href="category.php?edit_id=<?php echo $c_id;?>"><i class="fa fa-pencil text-success"></i></a>
											<a href="" data-toggle="modal" data-target="#delete_id<?php echo $c_id;?>" type="button"><i class="fa fa-trash text-danger ml-3"></i></a>
										</td>
										<!-- modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<h3 class="modal-title text-center" id="exampleModalLabel">Are You Sure?</h3>
													<div class="modal-body text-center">
														<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-danger ml-3">Confirm</button>
													</div>
												</div>
											</div>
										</div>
									</tr>
									<?php
									subcategory($c_id);
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		// delete operation
		if (isset($_GET['delete_id'])) {
			$del_id = $_GET['delete_id'];
			// find image name
			$res = mysqli_query($db,"SELECT c_image from category WHERE c_id='$del_id'");
			$row = mysqli_fetch_assoc($res);
			$file_name = $row['c_image'];
			unlink('images/category/'.$file_name);
			$del_sql = "DELETE FROM category WHERE c_id='$del_id'";
			$del_res = mysqli_query($db,$del_sql);
			if($del_res){
				header('Location: category.php');
			}else{
				echo 'category delete error!';
			}
		}
		?>
	</div>
	<!-- content-wrapper ends -->
	<?php
	include "inc/footer.php";
	?>