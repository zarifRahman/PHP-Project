<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Dashboard</small>
        </h1>

        <!-- PHP -->
        <?php
          
          // $user = Photo::find_by_id(14);
          // echo $user->filename;
          
          // $result_set = User::find_all_users();
          // while($row = mysqli_fetch_array($result_set)) {
          //     echo $row['username']. "<br>";
          // }

          // //find_user_by_id
          // $found_user = User::find_by_id(3);
          // $user = User::instantation($found_user);
          // echo $user->id;

          // $users = User::find_all();
          // foreach($users as $user) {
          //   echo $user->first_name. '<br>';
          // }

          // $found_user = User::find_user_by_id(1);
          // echo $found_user->username;


          // // create
          // $user = new User();
          // $user->username = "Suave";
          // $user->password = "12345";
          // $user->first_name = "Rico";
          // $user->last_name = "Suaves";
          // $user->create();

          // //update
          // $user = User::find_user_by_id(1);
          // $user->username = "David";
          // $user->password = "hiii";
          // $user->first_name = "Dave";
          // $user->last_name = "silva";
          // $user->update();


          // // //delete
          // $user = User::find_user_by_id(13);
          // var_dump($user);
          // $user->delete();

          // $user = User::find_user_by_id(6); //1
          // $user->username = "Johnny";
          // $user->save();


          // $user = new User(); //1
          // $user->username = "New User 2";
          // $user->save();

          // // create
          // $user = new User();
          // $user->username = "Students";
          // $user->password = "secret123";
          // $user->first_name = "jack";
          // $user->last_name = "Doe";
          // $user->create();
          
          // PHOTO Class starts //

          // $photos = Photo::find_all();
          // foreach($photos as $photo) {
          //   echo $photo->title. '<br>';
          // }

          // $photo = new Photo();
          // $photo->title = "hiii";
          // $photo->description = "flowers";
          // $photo->filename = "flowers blog";
          
          // $photo->size = 34;
          // $photo->create();


        ?>

       <!--extra file starts -->

      <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $session->count; ?></div>
                            <div>New Views</div>
                        </div>
                    </div>
                </div>

                <a href="#">
                    <div class="panel-footer">
                            <div>Page View from Gallery</div>
                        <span class="pull-left">View Details</span> 
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-photo fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo Photo::count_all() ?></div>
                            <div>Photos</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Total Photos in Gallery</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo User::count_all(); ?>

                            </div>

                            <div>Users</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Total Users</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo Comment::count_all(); ?></div>
                            <div>Comments</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Total Comments</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div> <!--First Row-->

    <div class="row">
      <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>

      <!-- extra file ends -->
        
      </div>
    </div>
    <!-- /.row -->
</div>
        
        <!-- /.container-fluid -->