<?php include"connection.php";

//*************
//subcategoy function for showing table
//*************

function subcategory($c_id){

	global $db;

	$cat_sql2 = "SELECT * FROM category WHERE is_sub = '$c_id'";
	$cat_res2 = mysqli_query($db,$cat_sql2);
	$serial ='-';
	while($row = mysqli_fetch_assoc($cat_res2)){
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
		<td><?php echo '__'.$c_name;?></td>
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


			<!-- Modal -->
<div class="modal fade" id="delete_id<?php echo $c_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <h3 class="modal-title text-center mb-3" id="exampleModalLabel">Are you sure?</h3>

        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        <a type="button" href="category.php?delete_id=<?php echo $c_id;?>" class="btn btn-danger ml-3">Confirm</a>
      </div>
    </div>
  </div>
</div>

		</td>
	</tr>

	<?php
		}

}

//*************
//find name function
//*************

function find_name($name, $table, $key, $p_category){

global $db;

	$name_sql = "SELECT $name FROM $table WHERE $key = '$p_category'";
  $name_res = mysqli_query($db,$name_sql);
  $row = mysqli_fetch_assoc($name_res);
  $name = $row[$name];
  echo $name;

}

//*************
//delete function
//*************

function delete($table, $p_key, $del_id, $redirect){

global $db;

$del_sql = "DELETE FROM $table WHERE $p_key='$del_id'";
$del_res = mysqli_query($db,$del_sql);
        if($del_res){header('Location:'.$redirect);
        }else{ echo 'Delete error!';}

}
//*************
//file delete function
//*************

function file_delete($file_name, $table, $p_key, $del_id, $file_path){


	global $db;


	$res = mysqli_query($db,"SELECT $file_name from $table WHERE $p_key='$del_id'");
	$row = mysqli_fetch_assoc($res);
	$filename = $row[$file_name];

	unlink($file_path.$filename);
}

//*************
//menu sub category function
//*************

function menu_sub_category($c_id){

global $db;

$cat_sql = "SELECT * FROM category WHERE c_status = '1' AND is_sub ='$c_id'";
$cat_res = mysqli_query($db,$cat_sql);

 ?><ul class="dropdown-menu"><?php

	while($row = mysqli_fetch_assoc($cat_res)){
				$s_id  		= $row['c_id'];
				$c_name  	= $row['c_name'];
				$c_image  	= $row['c_image'];
							?>

						
									<li class="nav-item">
							<a class="nav-link" href=""><?php echo $c_name;?></a>
						
						</li>
							



					
							<?php
							
					}
?></ul><?php
}

//*************
//child finding function
//*************
function has_child($c_id){
	global $db;

$cat_sql = "SELECT * FROM category WHERE c_status = '1' AND is_sub ='$c_id'";
$cat_res = mysqli_query($db,$cat_sql);
$no_of_child = mysqli_num_rows($cat_res);

if($no_of_child > 0){
	return 1;
}
else{
	return 0;
}

}