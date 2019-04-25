<?php
	session_start();
 
	if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
		}
    include('../common/SqlConnection.php');
    $id=$_SESSION['id'];
    $check_username=mysqli_query($conn, "SELECT * FROM userdetails WHERE id='$id'");
    $numrows=mysqli_num_rows($check_username);
    $row = mysqli_fetch_array($check_username);
      
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
  <link href="../js/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css" rel="stylesheet"> 
  

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
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="#">Reports</a>
          </li>
          <li class="breadcrumb-item active">Cheque Returns</li>
        </ol>

        <!-- Page Content -->
      <div class="card mb-3">
       <div class="card-header">
              
				<div class="row" id="filter-panel">
		       <div class="panel" style="width: 1100px">
						<div class="panel-body"> 
						<form id="ChequeReturnform"role="form">
              <div class="form-inline form-row">
               	<div class="form-group col-md-5"  id="container-BUnit" style="display: -webkit-inline-box;" >
									<label class="filter-col " style="margin-right: 0 ;"	for="businessUnit">Business Unit: </label>
                    <select name="sltBusinessUnit" id="sltBusinessUnit" class="form-control text-capitalize" style="width:300px;margin-left: 40px;"> 
                      <option value="" selected>- Choose Business Unit -</option>
                      <?php $selectOption = "BusinessUnit";
                        include "../common/fetchDropDown.php";
                      ?> 
                    </select>
								</div><br>
								<div class="form-group col-md-4"  id="container-AcctGroup" style="display: -webkit-inline-box;" >
                <label class="filter-col" style="margin-right: 0;" for="AcctGroup">Account Group: </label>
                   <select name="sltAccountGroup" id="sltAccountGroup" class="form-control text-capitalize" style="width: 300px;margin-left: 27px">
                 	</select>	
								</div><br><br> 
              </div>
              <div class="form-inline form-row">
                <div class="form-group col-md-5"  id="container-SalesExecutive" style="display: -webkit-inline-box;" >
							    <label class="filter-col" style="margin-right: 0;" for="SalesExecutiveCode">Sales Executive: </label> 
                  <select name="sltSalesExecutiveCode" id="sltSalesExecutiveCode" class="form-control text-capitalize" style="width: 300px; margin-left: 27px;">
                  </select>
                </div><br>
                <div class="form-group col-md-5"  id="container-Date" style="display: -webkit-inline-box;"  >
                  <label class="filter-col" style="margin-right: 0;"	for="AsOnDate">As on Date: </label>
                  <div class="input-group date" id="dpAsOnDate" data-provide="datepicker">
                    <input type="text" class="form-control datepicker" name="txtAsOnDate" autocomplete="off" id="txtAsOnDate" placeholder="Choose Date" aria-describedby="basic-addon2"  style="width: 240px; margin-left: 58px;">
                     <div class="input-group-addon text-pointer">
                     <i class=" btn btn-primary fas fa fa-calendar"></i>
                     </div>
                  </div>
                  <!-- <div class="input-append date" style="width: 240px; margin-left: 30px;">
									<span class="fas fa-fw fa fa-calendar"></span>
									<input class="form-control text-capitalize datepicker" type="text" placeholder="Select Date" name="dpAsOnDate" autocomplete="off" id="dpAsOnDate"  style="width: 210px;">
									</div> -->
                </div><br><br>
                <div class="form-group col-md-1">
								 <input type="button" name="findCheque" id="findCheque" class="btn btn-info" value="Find" style=" margin-left: 10px;"> 
                </div>
              </div>
     		  	</form> 
			 </div> 
				</div>
				</div>
				</div>
         <div  class="card-body">
           <div id= "tableNoRecdiv"></div>
            <div id= "tablediv">
              <table id="CRetreport" class="table table-striped table-bordered text-capitalize"  style="width:100%" ></table>
            </div>
          </div>
		
			
	<!-- /#wrapper -->
		</div>
	</div>
</div>
</div>
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top"> <i
		class="fas fa-angle-up"></i>
	</a>

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

  <!-- /#wrapper -->
  <!-- Cheque Details Modal -->
  <div id="chequeDetailModal" class="modal hide" role="dialog">
   <!-- Modal content-->
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title float-right">Cheque Details</h5>
      </div>
      <div class="modal-body">
      <table id="chequeDetailTable" class="table table-striped table-bordered text-capitalize" ></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
  </div>


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script> 
<script type="text/javascript" src="../js/DataTables/datatables.min.js"></script>
<script src="../js/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../js/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../js/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>

<script src="../js/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="../js/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script src="../js/DataTables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="../js/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="../js/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
 <!-- Custom scripts for all pages-->
  <script src="../jsscripts/CReturnReport.js"></script>
  <script src="../js/sb-admin.min.js"></script>
  

</body>

</html>
