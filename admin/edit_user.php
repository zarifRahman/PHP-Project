<?php include("includes/header.php"); ?>
<?php include("includes/photo_model.php"); ?>

<?php

    if(!$session->is_signed_in()){
        redirect("login.php");
    }

    if(empty($_GET['id'])) {
      redirect("users.php");
    }
    
    $user = User::find_by_id($_GET['id']);

    if(isset($_POST['update'])) {
      if($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        $user->set_file($_FILES['user_image']);
        $user->save_user_and_image();

      }
    }

    if(isset($_POST['delete'])) {
      if($user){
        $user->delete();
        redirect("users.php");
        
      }else {
        redirect("users.php");
      }
    }
?>



  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->

    <?php include('includes/top_nav.php') ?>


    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    
    <?php include('includes/side_nav.php'); ?>

    <!-- /.navbar-collapse -->
  </nav>

<!--  -->
  <div id="page-wrapper">
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                  User
                  <small>Subheading</small>
              </h1>
            
            <!-- Inlarge Image section -->
            <div class="col-md-6">
              <a href="#" data-toggle="modal" data-target="#photo-library">
                <img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt="">
              </a>
            </div>
            <!-- Inlarge Image section Ends-->

            <!-- Form starts -->
            <form action="" method="post" enctype="multipart/form-data">
              


              <div class="col-md-6">

                <div class="form-group">
                  <input type="file" name="user_image">
                </div>

                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                </div>

                <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                </div>

                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="text" name="password" class="form-control" >
                </div>

                <div class="info-box-update pull-right ">
                  <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                </div> 

                <div class="info-box-delete pull-left">
                  <a id="user-id" href="delete_photo.php?id=<?php echo $user->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                </div> 
              </div>
              <!-- End of table -->

              </div>
            </form>




          </div>
      </div>
      <!-- /.row -->

    </div>

<!-- /.container-fluid -->

</div>
  <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>