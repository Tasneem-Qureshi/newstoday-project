<?php include"connection.php";
function subcategory($c_id){
	global $db;
	$cat_sql2 = "SELECT * FROM category WHERE is_sub = '$c_id'";
	$cat_res2 = mysqli_query($db,$cat_sql2);
	$serial = '-';
	while($row = mysqli_fetch_assoc($cat_res2)){
			$c_id  		= $row['c_id'];
		$c_name  	= $row['c_name'];
		$c_image  	= $row['c_image'];
		$is_sub  	= $row['is_sub'];
		$c_status  	= $row['c_status'];		






										
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
		<a href="category.php?edit_it=<?php echo $c_id;?>"><i class="fa fa-pencil text-success"></i></a>
		<a href="" data-toggle="modal" data-target="#delete_id<?php echo $c_id;?>" type="button"><i class="fa fa-trash text-danger ml-3"></i></a>
	</td>
</tr>
<?php
}
}

// is sub function 
function is_sub_cat($c_id){

	global $db;

$cat_sql3 = "SELECT * FROM category WHERE c_status ='1' AND is_sub = '$c_id'";
$cat_res3 = mysqli_query($db,$cat_sql3);
$serial = 0;
while($row = mysqli_fetch_assoc($cat_res3)){
$c_id  		= $row['c_id'];
$c_name  	= $row['c_name'];
$is_sub  	= $row['is_sub'];
?>
<option value="<?php echo $c_id; ?>"><?php echo '-'.$c_name;?></option>
<?php

}
}

