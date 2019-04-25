<?php
	session_start();
 
	// if (!isset($_SESSION['id'])) {
  //       header('location: login.php');
  //       exit();
	// 	}
  //   include('../common/SqlConnection.php');
  //   $id=$_SESSION['id'];
  //   $check_username=mysqli_query($conn, "SELECT * FROM userdetails WHERE id='$id'");
  //   $numrows=mysqli_num_rows($check_username);
  //   $row = mysqli_fetch_array($check_username);
      
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ocean Group</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../js/DataTables/datatables.min.css"/>

</head>

<body id="page-top">

<?php include '../common/navbar.php';?>

<div id="wrapper">

  <!-- Sidebar -->
  <?php include '../common/sidebar.php';?>

  <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <div >
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Dealer-S.Executives</li>
            </ol>
        </div>
        <div class="auto-ml">
            <!-- <input class="btn btn-primary" type="button" id="addRow" name="addRow" data-toggle="modal" data-target="#addRowModal" value="Add Row"> -->
            <input class="btn btn-primary pull-left" type="button" id="updateRow" name="updateRow" value="Update">
            <span id=alertMsg></span>
          </div>
        <!-- Page Content -->
        <div class="card mb-3">
        <div class="card-header">
        <div class="row" id="filter-panel">
					<div class="panel panel-default">
						  <div class="panel-body">
                 	
                  <table id="mapTable" class="table table-bordered table-striped text-capitalize" width="100%" ></table>		
				      </div> 
				    </div>
				</div>
			</div>
    </div>
	</div>
</div>
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top"> <i
		class="fas fa-angle-up"></i>
	</a>


      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<!-- Add Modal-->
<!-- <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" data-target="myModalLabel"  aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title float-right" id="myModalLabel">Add new record</h5>
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  </div>
  <div class="modal-body">
    <form id="addMaptableForm" method = "POST">
        <div class="form-group">
            <label for="lblBusinessUnit">BusinessUnit:</label>
            <select name="sltBusinessUnit" id="sltBusinessUnit" class="form-control text-capitalize" > 
                      <option value="" selected>- Choose Business Unit -</option>
                      <?php $selectOption = "BusinessUnit";
                        include "../common/fetchDropDown.php";
                      ?> 
            </select>
        </div>
        <div class="form-group">
            <label for="lblAccountGroup">AccountGroup:</label>
            <select name="sltAccountGroup" id="sltAccountGroup" class="form-control text-capitalize">  style="width: 240px; margin-left: 4px;"
                      <option value="" selected>- Choose AccountGroup -</option>
                      <?php $selectOption = "AccountGroup";
                        include "../common/fetchDropDown.php";
                      ?> 
                    </select>
        </div>
        <div class="form-group">
            <label for="lblDealers">Dealer:</label>
            <select name="sltDealers" id="sltDealers" class="form-control text-capitalize" > 
                      <option value="" selected>- Choose Dealers-</option>
                      <?php $selectOption = "Dealers";
                        include "../common/fetchDropDown.php";
                      ?> 
            </select>
        </div>
        <div class="form-group">
            <label for="lblSalesExecutiveCode">SalesExecutiveCode:</label>
            <select name="sltSalesExecutiveCode" id="sltSalesExecutiveCode" class="form-control text-capitalize"> 
                    <option value="" selected>- Choose Sales Executive -</option>
                    <?php $selectOption = "SalesExecutiveCode";
                      include "../common/fetchDropDown.php";
                    ?> 
                  </select>
        </div>
  </div>
  <div class="modal-footer">
  <button type="submit"  class="btn btn-success" onclick="AddNewRow()" name="save">Insert</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   
  </div>
  </form>
  </div> -->


  

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="../js/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="../js/dataTables.cellEdit.js"></script> 
<<script src="../js/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../js/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../js/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>

<script src="../js/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="../js/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script src="../js/DataTables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="../js/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="../js/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>

  

  <!-- Custom scripts for all pages-->
  <script src="../jsscripts/masterData.js"></script>
  <script src="../js/sb-admin.min.js"></script>
 
</body>

</html>
