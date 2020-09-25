<?php

require_once(__DIR__."/application/connection/DBConnection.php");
$conn = DBConnection::getConnection();
$SQLStmt = "SELECT * FROM tbl_user WHERE IS_DELETED = FALSE";
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare($SQLStmt); 
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
$result = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Digital Knock</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Datta
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item">
  				</a>
            </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="images/AdminLTELogo.png" class="brand-image img-circle elevation-3"
           style="opacity: .8">
            <span class="brand-text font-weight-light">Digital Knock</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
		  <img src="images/avatar.png" class="img-circle elevation-2" alt="User Image">
		  Datta
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <li class="nav-item">
            <a href="" class="nav-link">
                 <i class="far fa-user nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
             
              <li> 
                

              </li>
          </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
	   
	<div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

	  <div class="col-md-12">
            <div class="card">
                <div class="card-header text-info">UserList</div>
                <div class="card-body">
                    <a class="btn btn-sm btn-info pull-right btnUser">Add User</a>
					<br><br>
					
                    <table class="table table-hover">
                        <thead>
                                <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col"> Phone </th>
                                <th scope="col"> Images </th>
                                <th scope="col"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
								<?php
									$intCount = count($result);
									if($intCount){
										for($i=0;  $i < $intCount; $i++){
											?>
											<tr id="<?php  echo $result[$i]['id']; ?>">
												<td><?php echo $i+1; ?></td>
												<td><?php echo $result[$i]['name']; ?></td>
												<td><?php  echo $result[$i]['email']; ?></td>
												<td><?php  echo $result[$i]['phone']; ?></td>
											    <td><button class="btn btn-primary btn-xs btn_img">View</button></td>
												<td> 
												<td><button class="btn btn-primary btn-sm btnEdit">Edit</button></td>
												<td><button class="btn btn-danger btn-sm btnDel" >Delete</button></td>
												</td>
											</tr>											
									<?php }

									}else{
									?>
									<tr>
										<td colspan="7" style="text-align:center;">No User Available</td>
									</tr>
										
								<?php	}
								?>
                                                   
                           </tbody>
                        </table>
                </div>
            </div>
        </div>


      </div>
      <!-- /.row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    
	
		

    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> -->
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- Models -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade modalSave"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">		
	  <form id="userSave">
		    <input type="hidden" id="uid" value="-1">
	  		<div class="form-group">
				<label for="exampleInputEmail1">Name</label>
				<input type="text" class="form-control" id="name" placeholder="Enter name" required>
			</div>
		   <div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" class="form-control" id="email"  placeholder="Enter email" required>
			</div>
			<div class="form-group">
				<label>Phone</label>
				<input type="number" class="form-control" id="phone" placeholder="Phone Number" required>
			</div>
			<button type="submit" class="btn btn-primary float-right">Save</button>
	  </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modalImage"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Image List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">		
	  <form id="imageSave">
		   <div class="form-inline row">
			    <input type="hidden" id="userImgId" value="">
				<label for="exampleInputEmail1">Upload Image</label>
				<input type="file" class="form-control" id="img" required >
				<button type="submit" class="btn btn-primary float-right">Save</button>
		   </div>			
	  </form>
	  <br>
	  <div class="row" style="height: 276px; overflow-x: scroll;">
			<table class="tblImage table">
				<thead><tr><th>Sl No</th><th> Image</th></tr></thead>
				<tbody>

				</tbody>
			</table>
	  </div>
      </div>
    </div>
  </div>
</div>






<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js'"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="js/default.js"></script>
</body>
</html>
