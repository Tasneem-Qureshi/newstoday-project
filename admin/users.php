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
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">All Users Information</h4>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Posts</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $user_sql = "SELECT * FROM users";
                  $user_res = mysqli_query($db,$user_sql);
                  $serial = 0;
                  while($row      = mysqli_fetch_assoc($user_res)){
                  $u_id        = $row['u_id'];
                  $u_name      = $row['u_name'];
                  $u_email     = $row['u_email'];
                  $u_phone     = $row['u_phone'];
                  $u_gender    = $row['u_gender'];
                  $u_posts     = $row['u_posts'];
                  $u_thumbnail = $row['u_thumbnail'];
                  $user_type   = $row['user_type'];
                  $u_status    = $row['u_status'];
                  $serial++;
                  ?>
                  <tr>
                    <td><?php echo $serial;?></td>
                    <td class="py-1">
                      <img src="images/users/<?php echo $u_thumbnail;?>" alt="image">
                    </td>
                    <td><?php echo $u_name;?></td>
                    <td><?php echo $u_email;?></td>
                    <td><?php echo $u_phone;?></td>
                    <td><?php if($u_gender ==0){
                      echo 'Female';
                      }else if($u_gender ==1){
                      echo 'Male';
                      }else if($u_gender ==2){
                      echo 'Others';
                      }else{
                      echo 'Not Selected';
                      }
                    ?></td>
                    <td><?php echo $u_posts;?></td>
                    <td><?php if($user_type ==0){
                      echo '<span class="badge bg-success text-white" >Subscriber</span>';
                      }else if($user_type ==1){
                      echo '<span class="badge bg-success text-white" >Editor</span>';
                      }else if($user_type ==2){
                      echo '<span class="badge bg-danger text-white" >Admin</span>';
                      }
                    ?></td>
                    <td><?php if($u_status ==0){
                      echo '<span class="badge bg-danger text-white" >Inactive</span>';
                      }else if($u_status ==1){
                      echo '<span class="badge bg-success text-white" >Active</span>';
                      }
                    ?></td>
                    <td>
                      <a href="" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fa fa-eye text-black"></i></a>
                      <a href="" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil text-success mx-2"></i></a>
                      <a href="users.php?do=delete&delete_id=<?php echo $u_id;?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash text-danger"></i></a>
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
    ?>
    <div class="row">
      <div class="col-10 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add New User</h4>
            <form class="forms-sample" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="username">Name</label>
                <input type="text" class="form-control" id="username" placeholder="Name" name="username">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail3">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" name="useremail">
              </div>
              <div class="form-group">
                <label for="password">Set Password</label>
                <input type="password" class="form-control" id="password" placeholder="Set Password" name="password">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" placeholder="phone" name="phone">
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                  <option selected value="3">Select Gender</option>
                  <option value="0">Female</option>
                  <option value="1">Male</option>
                  <option value="2">Others</option>
                </select>
              </div>
              <div class="form-group">
                <label>Set User Photo</label>
                <input type="file" id="choose-file" name="image" class="form-control" accept="image/*" />
                <small class="text-danger"><?php //echo $err_msg;?></small>
                <div id="img-preview" class="my-3" style="width: 200px;"></div>
                <style>#img-preview img{width: 220px !important;}</style>
                <div class="form-group">
                  <label for="role">User Role</label>
                  <select class="form-control" name="userrole">
                    <option value="0" selected>Subscriber</option>
                    <option value="1">Editor</option>
                    <option value="2">Admin</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="biodata">Biodata</label>
                  <textarea class="form-control" id="biodata" rows="6" name="biodata"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2" name="add_user">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
              <?php
              if(isset($_POST['add_user'])){
              $username   = $_POST['username'];
              $useremail  = $_POST['useremail'];
              $password   = $_POST['password'];
              $phone      = $_POST['phone'];
              $gender     = $_POST['gender'];
              $userrole   = $_POST['userrole'];
              $biodata    = $_POST['biodata'];
              $file_name  = $_FILES['image']['name'];
              $file_size  = $_FILES['image']['size'];
              $tmp_name   = $_FILES['image']['tmp_name'];

              $hass_pass  = sha1($password);

              if(empty($useremail) || empty($password)){
                echo 'please Insert Email and Password';
              }
              else{



                $extns = array('jpg', 'png', 'jpeg');
                $var_parts = explode('.', $_FILES['image']['name']);
                $extension = strtolower(end($var_parts));

                if(in_array($extension,$extns) === true){

                $random = rand();
                $updated_img = $random.$file_name;  

                move_uploaded_file($tmp_name, 'images/users/'.$updated_img);

                $user_insert = "INSERT INTO users (u_name, u_email, u_pass, u_phone, u_gender, u_biodata, u_posts, u_thumbnail, user_type, u_status) VALUES ('$username', '$useremail', '$hass_pass', '$phone', '$gender', '$biodata' , '0', '$updated_img', '$userrole', '1')";
                $insert_res = mysqli_query($db,$user_insert);

                if($insert_res){
                header('Location: users.php');
                }else{
                die('user insert error!'.mysqli_error($db));
                }
                }else{
                  echo 'Please Insert an image file(png,jpg,jpeg)';
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
      }
      if($do =='update'){
      }
      if($do =='delete'){
      if(isset($_GET['delete_id'])){
      $del_id = $_GET['delete_id'];
      file_delete('u_thumbnail', 'users', 'u_id', $del_id, 'images/users/');
      delete('users', 'u_id', $del_id, 'users.php');
      }
      }
      ?>
    </div>
    <!-- content-wrapper ends -->
    <?php
    include "inc/footer.php";
    ?>