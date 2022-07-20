<?php
include "inc/header.php";
?>
<div class="main-panel">
  <div class="content-wrapper">
    
    <?php
    $do = '';
    if(isset($_GET['do'])){
    $do = $_GET['do'];
    }else{
    $do ='show';
    }
    if($do =='show'){
    ?>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">View All Posts</h4>
            
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Tags</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $post_sql = "SELECT * FROM posts";
                  $post_res =  mysqli_query($db,$post_sql);
                  $serial=0;
                  while($row = mysqli_fetch_assoc($post_res)){
                  $p_id         = $row['p_id'];
                  $p_title      = $row['p_title'];
                  $p_desc       = $row['p_desc'];
                  $p_thumbnail  = $row['p_thumbnail'];
                  $p_tags       = $row['p_tags'];
                  $p_category   = $row['p_category'];
                  $p_author     = $row['p_author'];
                  $p_date       = $row['p_date'];
                  $p_comment    = $row['p_comment'];
                  $p_status     = $row['p_status'];
                  $serial++;
                  ?>
                  <tr>
                    <td><?php echo $serial;?></td>
                    <td class="py-1">
                      <img src="images/posts/<?php echo $p_thumbnail;?>" alt="image">
                    </td>
                    <td><?php echo substr($p_title, 0,25).'...';?></td>
                    <td>
                      <?php
                      find_name('c_name', 'category', 'c_id', $p_category);
                      ?>
                    </td>
                    <td>
                      
                      <?php
                      find_name('u_name', 'users', 'u_id', $p_author);
                      ?>
                      
                    </td>
                    <td>
                      <?php
                      
                      $post_tags = explode(',', $p_tags);
                      foreach ($post_tags as $item){
                      echo '<a href="" class= "badge bg-info text-white mr-1">'.$item.'</a>';
                      }
                    ?></td>
                    <td><?php
                      if($p_status ==1)
                      echo '<span class="badge bg-success text-white">Active</span>';
                      else echo'<span class="badge bg-danger text-white">Inactive</span>';?></td>
                      <td>
                        <a href="posts.php?do=edit&edit_id=<?php echo $p_id;?>"><i class="fa fa-pencil"></i></a>
                        <a href="posts.php?do=delete&delete_id=<?php echo $p_id;?>"><i class="fa fa-trash text-danger ml-3"></i></a>
                      </td>
                    </tr>
                    <?php
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
      }
      if($do =='add'){
      $err_msg = '';
      ?>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add A New Post</h4>
              <form class="forms-sample" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="post_title">Post Title</label>
                  <input type="text" class="form-control" id="post_title" placeholder="Title" name="title">
                </div>
                <div class="form-group">
                  <label>Post Description</label>
                  <textarea rows="9" class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                  <label for="parent_cat">Select Category</label>
                  <select class="form-control form-control-sm" id="parent_cat" name="p_cat_id">
                    <option selected>Select Category</option>
                    
                    <?php
                    $cat_sql3 = "SELECT * FROM category WHERE c_status = '1' AND is_sub = '0'";
                    $cat_res3 = mysqli_query($db,$cat_sql3);
                    $serial = 0;
                    while($row = mysqli_fetch_assoc($cat_res3)){
                    $c_id     = $row['c_id'];
                    $c_name   = $row['c_name'];
                    $is_sub   = $row['is_sub'];
                    ?>
                    <option value="<?php echo $c_id;?>"><?php echo $c_name;?></option>
                    
                    <?php
                    $cat_sql4 = "SELECT * FROM category WHERE c_status = '1' AND is_sub = $c_id";
                    $cat_res4 = mysqli_query($db,$cat_sql4);
                    while($row = mysqli_fetch_assoc($cat_res4)){
                    $sub_id     = $row['c_id'];
                    $sub_name   = $row['c_name'];
                    ?>
                    <option value="<?php echo $sub_id;?>"><?php echo '--'.$sub_name;?></option>
                    <?php
                    }
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tags</label>
                  <input type="text" id="tag-input1" class="form-control" name="tags">
                </div>
                <div class="form-group">
                  <input type="file" id="choose-file" name="image" class="form-control" accept="image/*" required />
                  <small class="text-danger"><?php //echo $err_msg;?></small>
                  <div id="img-preview" class="my-3" style="width: 200px;"></div>
                  <style>#img-preview img{width: 220px !important;}</style>
                  <button type="submit" class="btn btn-primary mr-2" name="add_post">Add Post</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
                <?php echo $err_msg;?>
                
                <?php
                if(isset($_POST['add_post'])){
                $title        = mysqli_real_escape_string($db, $_POST['title']);
                $description  = mysqli_real_escape_string($db, $_POST['description']);
                $category     = $_POST['p_cat_id'];
                $tags         = $_POST['tags'];
                $file_name    = $_FILES['image']['name'];
                $file_size    = $_FILES['image']['size'];
                $tmp_name     = $_FILES['image']['tmp_name'];
                if(empty($title) || empty($description) || empty($category) || empty($tags) || empty($file_name)){
                echo '<span class="badge bg-danger">Please Insert All The Information!</span>';
                }else{
                $extns = array('jpg', 'png', 'jpeg');
                $var_parts = explode('.', $_FILES['image']['name']);
                $extension = strtolower(end($var_parts));
                $mb_size = ($file_size/1024)/1024;
                if(in_array($extension,$extns) === true && $mb_size < 2){
                $random = rand();
                $updated_img = $random.$file_name;
                
                move_uploaded_file($tmp_name, 'images/posts/'.$updated_img);
                $insert_sql = "INSERT INTO posts (p_title, p_desc, p_thumbnail, p_tags, p_category, p_author, p_date, p_status) VALUES ('$title', '$description', '$updated_img', '$tags' , '$category' , '1' , now(), '1')";
                $insert_res = mysqli_query($db, $insert_sql);
                if($insert_res){
                header('Location: posts.php');
                }else{
                die('category insert error!'.mysqli_error($db));
                }
                }else{
                echo '<span class="badge bg-danger">Please select an image (png,jpg,jpeg)! and it must be below 2 MB!</span>';
                }
                }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        if($do =='edit'){
        
        if(isset($_GET['edit_id'])){
        $edit_id = $_GET['edit_id'];
        $post_sql = "SELECT * FROM posts WHERE p_id = '$edit_id'";
        $post_res =  mysqli_query($db,$post_sql);
        $serial=0;
        while($row = mysqli_fetch_assoc($post_res)){
        $p_id         = $row['p_id'];
        $p_title      = $row['p_title'];
        $p_desc       = $row['p_desc'];
        $p_thumbnail  = $row['p_thumbnail'];
        $p_tags       = $row['p_tags'];
        $p_category   = $row['p_category'];
        $p_author     = $row['p_author'];
        $p_date       = $row['p_date'];
        $p_comment    = $row['p_comment'];
        $p_status     = $row['p_status'];
        $serial++;
        }
        ?>
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Edit Post Information</h4>
                <form class="forms-sample" method="POST" enctype="multipart/form-data" action="posts.php?do=update">
                  <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" value="<?php echo $p_title;?>" class="form-control" id="post_title" placeholder="Title" name="title">
                  </div>
                  <div class="form-group">
                    <label>Post Description</label>
                    <textarea rows="9" class="form-control" name="description"><?php echo $p_desc;?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="parent_cat">Select Category</label>
                    <select class="form-control form-control-sm" id="parent_cat" name="p_cat_id">
                      <option selected>Select Category</option>
                      
                      <?php
                      $cat_sql3 = "SELECT * FROM category WHERE c_status = '1' AND is_sub = '0'";
                      $cat_res3 = mysqli_query($db,$cat_sql3);
                      $serial = 0;
                      while($row = mysqli_fetch_assoc($cat_res3)){
                      $c_id     = $row['c_id'];
                      $c_name   = $row['c_name'];
                      $is_sub   = $row['is_sub'];
                      ?>
                      <option value="<?php echo $c_id;?>"<?php if ($p_category == $c_id) echo 'selected';?>><?php echo $c_name;?></option>
                      
                      <?php
                      $cat_sql4 = "SELECT * FROM category WHERE c_status = '1' AND is_sub = $c_id";
                      $cat_res4 = mysqli_query($db,$cat_sql4);
                      while($row = mysqli_fetch_assoc($cat_res4)){
                      $sub_id     = $row['c_id'];
                      $sub_name   = $row['c_name'];
                      ?>
                      <option value="<?php echo $sub_id;?>" <?php if ($p_category == $sub_id) echo 'selected';?>><?php echo '--'.$sub_name;?></option>
                      <?php
                      }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tags</label>
                    <input type="text"  class="form-control" name="tags" value="<?php echo $p_tags;?>">
                  </div>
                  <div class="form-group">
                    <?php
                    if(!empty($p_thumbnail)){
                    ?>
                    <img src="images/posts/<?php echo $p_thumbnail;?>" width="200">
                    <?php
                    }
                    ?>
                    <input type="file" id="choose-file" name="image" class="form-control" accept="image/*" />
                    <small class="text-danger"><?php //echo $err_msg;?></small>
                    <div id="img-preview" class="my-3" style="width: 200px;"></div>
                    <style>#img-preview img{width: 220px !important;}</style>
                    <input type="number" value="<?php echo $edit_id;?>" name="edit_post_id" hidden>
                    <button type="submit" class="btn btn-primary mr-2" name="update_post">Update</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                  </div>
              </div>
            </div>
          </div>
                  <?php
                  }
                  }
                  if($do =='update'){
                  
                  if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $p_id           = $_POST['edit_post_id'];        
        $title        = mysqli_real_escape_string($db, $_POST['title']);
        $description  = mysqli_real_escape_string($db, $_POST['description']);
        $category     = $_POST['p_cat_id'];
        $tags         = $_POST['tags'];
        $file_name    = $_FILES['image']['name'];
        $tmp_name     = $_FILES['image']['tmp_name'];

        if(empty($file_name)){

        $update_sql ="UPDATE posts SET p_title ='$title', p_desc = '$description', p_tags = '$tags', p_category = '$category' WHERE p_id='$p_id'";
        $update_res = mysqli_query($db,$update_sql);

        if($update_res){
          header('Location: posts.php');
        }else{
          die('Post Update Error'.mysqli_error($db));
        }
        }else{
                $extns = array('jpg', 'png', 'jepg');
                $var_parts = explode('.', $_FILES['image']['name']);
                $extension = strtolower(end($var_parts));
                if(in_array($extension,$extns) === true){
                $random = rand();
                $updated_img = $random.$file_name;
                
                move_uploaded_file($tmp_name, 'images/posts/'.$updated_img);
                file_delete('p_thumbnail', 'posts', 'p_id', $p_id, 'images/posts/');
                $update_sql = "UPDATE posts SET p_title ='$title', p_desc = '$description', p_thumbnail='$updated_img', p_tags = '$tags', p_category = '$category' WHERE p_id='$p_id'";
                $update_res = mysqli_query($db, $update_sql);
                if($update_res){
                header('Location: posts.php');
                }else{
                die('posts update error!'.mysqli_error($db));
                }
                }else{
                echo '<span class="badge bg-danger">Please select an image (png,jpg,jpeg)! and it must be below 2 MB!</span>';
                }
        }
                  }
                  }
                  if($do =='delete'){
                  
                  if (isset($_GET['delete_id'])) {
                  $del_id = $_GET['delete_id'];
                  //filename, table name, id, delete id, file path
                  file_delete('p_thumbnail', 'posts', 'p_id', $del_id, 'images/posts/');
                  delete('posts', 'p_id', $del_id ,'posts.php');
                  }
                  }
                  
                  ?>
                </div>

                
                <!-- content-wrapper ends -->
                <?php
                include "inc/footer.php";
                ?>