<?php
include "inc/header.php";
?>
<?php
	// category add
	$err_msg = '';
	
	if(isset($_POST['add_cat'])){
				$name 		= $_POST['name'];
			$p_cat_id 	= $_POST['p_cat_id'];
			$status 	= $_POST['status'];
		$file_name  = $_FILES['image']['name'];
		$tmp_name   = $_FILES['image']['tmp_name'];
		if(empty($p_cat_id)){
			$p_cat_id = 0;
		}
		$extns = array('jpg', 'png', 'jepg');
		$var_parts = explode('.', $_FILES['image']['name']);
		$extension = strtolower(end($var_parts));
		if(in_array($extension,$extns) === true){
			$random = rand();
			$updated_img = $random.$file_name;
			
			move_uploaded_file($tmp_name, 'images/category/'.$updated_img);
			$cat_insert = "INSERT INTO category (c_name, c_image, is_sub, c_status) VALUES ('$name', '$updated_img', '$p_cat_id', '$status')";
			$insert_res = mysqli_query($db, $cat_insert);
			if($insert_res){
				header('Location: category.php');
			}else{
				die('category insert error!'.mysqli_error($db));
			}
		}else{
			$err_msg = 'Please select an image (png,jpg,jpeg)!';
		}
	}
?>
<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-md-5 grid-margin stretch-card">
				
				<?php
					if(isset($_GET['edit_id'])){
						$edit_id = $_GET['edit_id'];
						$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM category WHERE c_id = '$edit_id'"));
							$c_id2  	= $row['c_id'];
							$c_name2  	= $row['c_name'];
							$c_image2   = $row['c_image'];
							$is_sub2  	= $row['is_sub'];
							$c_status2  = $row['c_status'];
						
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

										file_delete('c_image', 'category', 'c_id', $edit_id, 'images/category/');


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
						<h4 class="card-title">Add new Category</h4>
						
						<form class="forms-sample" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="cat_name">Category Name</label>
								<input type="text" class="form-control" id="cat_name" placeholder="Category Name" name="name" required>
							</div>
							<div class="form-group">
								<label for="parent_cat">Select Parent Category</label>
								<select class="form-control form-control-sm" id="parent_cat" name="p_cat_id">
									<option selected>Select Parent Category</option>
									
									<?php
										$cat_sql3 = "SELECT * FROM category WHERE c_status = '1' AND is_sub = '0'";
										$cat_res3 = mysqli_query($db,$cat_sql3);
										$serial = 0;
										while($row = mysqli_fetch_assoc($cat_res3)){
													$c_id  		= $row['c_id'];
												$c_name  	= $row['c_name'];
												$is_sub  	= $row['is_sub'];
									?>
									<option value="<?php echo $c_id;?>"><?php echo $c_name;?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="c_status">Category Status</label>
								<select class="form-control form-control-sm" id="c_status" name="status">
									<option value="1" selected>Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
							<div class="form-group">
								<input type="file" id="choose-file" name="image" class="form-control" accept="image/*" required />
								<small class="text-danger"><?php echo $err_msg;?></small>
								<div id="img-preview" class="my-3"></div>
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
											if($c_status == 1){
												echo '<span class="badge badge-success">Active</span>';
											}else{
												echo '<span class="badge badge-danger">Inactive</span>';
											}
											?>
										</td>
										<td class="font-weight-medium">
											<a href="category.php?edit_id=<?php echo $c_id;?>"><i class="fa fa-pencil"></i></a>
											<a href="" data-toggle="modal" data-target="#delete_id<?php echo $c_id;?>" type="button"><i class="fa fa-trash text-danger ml-3"></i></a>
										</td>
										
										<!-- Modal -->
										<div class="modal fade" id="delete_id<?php echo $c_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h2 class="modal-title text-center mb-3" id="exampleModalLabel">Are you sure?</h2>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body text-center">
														
														<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
														<a type="button" href="category.php?delete_id=<?php echo $c_id;?>" class="btn btn-danger ml-3">Confirm</a>
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
			// delete
			if (isset($_GET['delete_id'])) {
				$del_id = $_GET['delete_id'];

				file_delete('c_image', 'category', 'c_id', $del_id, 'images/category/');

				delete('category', 'c_id', $del_id ,'category.php');
			}
		?>
		
		
	</div>
	<!-- content-wrapper ends -->
	<?php
	include "inc/footer.php";
	?>