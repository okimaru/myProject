<?php
include("connect.php");
$error = "";
$message = "";

session_start();
if($_SESSION['security_level'] != 'employee' and $_SESSION['security_level'] != 'admin' and  $_SESSION['security_level'] != 'manager') {
    header('Location: login_user.php');
    exit;
}


if(!$connect){
    $error = 'Not connected to server or database!!';
}

//$sql = "SELECT * FROM container";
$sql = "SELECT id,serial_number,container_size,container_color,nature_of_goods,client,DATE(date_delivered) AS date,delivered_by,mobile,truck_number_plate,storage_location,status FROM container ORDER BY id DESC";
$record = mysqli_query($connect,$sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS - Containers</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../dataTables/daterangepicker.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <link rel="stylesheet" href="../dataTables/buttons.bootstrap4.min.css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../css/style2.css" rel="stylesheet">

    <style>
        td{
            font-size: 13px;
        }
    </style>




</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Container management</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- navbar-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
                <?php
                echo $_SESSION['username'];
                ?>
            </a>


            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="userDropdown">

                <a class="dropdown-item text-warning disabled"  href="#">
                    <?php
                    echo $_SESSION['security_level'];
                    ?>
                </a>
                <a class="dropdown-item text-success disabled" href="#">
                    <?php
                    echo $_SESSION['username'];
                    ?>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
        </li>
    </ul>


</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav ">

        <li class="nav-item">
            <a class="nav-link" href="storage_layout.php">
                <i class="fa fa-building"></i>
                <span>Storage Layout</span></a>
        </li>

        <?php
        if($_SESSION['security_level'] == 'admin' or $_SESSION['security_level'] ==  'manager') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="report.php">
                    <i class="fa fa-desktop"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-receipt"></i>
                    <span>Reports</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="reports/client_wise.php">Clients-wise</a>
                    <a class="dropdown-item" href="reports/general_report.php">General</a>
                </div>
            </li>

        <?php
        }
        ?>

        <?php
        if($_SESSION['security_level'] == 'admin' or $_SESSION['security_level'] == 'manager') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="a_staff.php">
                    <i class="fa fa-user"></i>
                    <span>Staff</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="a_clients.php">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Clients</span></a>
            </li>

        <?php
        }
        ?>

        <?php
        if($_SESSION['security_level'] == 'employee') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="check-in.php">
                    <i class="fa fa-check-double"></i>
                    <span>Check-in</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="transferContainer.php">
                    <i class="fa fa-dolly"></i>
                    <span>Transfer</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="check_out.php">
                    <i class="fa fa-truck-loading"></i>
                    <span>Check-out</span>
                </a>
            </li>



            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-edit"></i>
                    <span>Edit</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="edit_checked_in_containers.php">checked-in containers</a>
                    <a class="dropdown-item" href="edit_checked_out_containers.php">checked-out containers</a>
                </div>
            </li>

        <?php
        }
        ?>

<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="storage.php">-->
<!--                <i class="fa fa-store"></i>-->
<!--                <span>Storage</span></a>-->
<!--        </li>-->

        <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-eye"></i>
                <span>View</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item active" href="view_all_containers.php">All containers</a>
                <a class="dropdown-item" href="view_checked_in_containers.php">Containers in Store</a>
                <a class="dropdown-item" href="view_checked_out_containers.php">checked-out containers</a>
<!--                <a class="dropdown-item" href="view_container_audit.php">container audit</a>-->
                <!-- <a class="dropdown-item active" href="view_transfered_containers.php">Transferred Containers </a>-->
            </div>
        </li>

    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-center">
                    <a href="#">Checked-in Containers</a>
                </li>
                <li class="breadcrumb-item active">Container Details</li>
            </ol>

            <div class="check-container ">

                <div class="container" align="center">
                        <a class="btn btn-outline-dark active" type="button" href="view_all_containers.php">ALL CONTAINERS</a>
                        <a class="btn btn-outline-dark" type="button" href="view_checked_in_containers.php">CHECKED IN</a>
                        <a class="btn btn-outline-dark" type="button" href="view_checked_out_containers.php">CHECKED OUT</a>
<!--                        <a class="btn btn-outline-dark" type="button" href="view_container_audit.php">CONTAINER AUDIT </a>-->
                        <!--  <a class="btn btn-outline-dark" type="button" href="view_transfered_containers.php">Transferred Containers </a>-->
                </div>

                <div class="table-responsive">

                    <div class="row col-md-10 mb-3 mt-2">
                        <div class="col-md-5">
                            <input class="form-control" name="min" id="min" type="text" placeholder="From date">
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="min" id="max" type="text" placeholder="To date">
                        </div>
                        <!-- <div><button class=" btn btn-warning clear" id="clear">X</button></div>-->
                    </div>


                    <table id="order_data" class="table table-striped table-bordered " style="width:100%;">
                        <thead style="font-size: 12px;">
                        <tr>
                            <th>id</th>
                            <th>serial n.o</th>
                            <th>size</th>
                            <th>color</th>
                            <th>nature of goods</th>
                            <th>client</th>
                            <th>date received</th>
                            <th>Driver</th>
                            <th>contacts</th>
                            <th>n.o plate</th>
                            <th>storage location</th>
                            <th>status</th>
                        </tr>
                        </thead>
                        <?php
                        while($row = mysqli_fetch_array($record))
                        {
                            echo '
                              <tr>
                               <td>'.$row["id"].'</td>
                               <td>'.$row["serial_number"].'</td>
                               <td>'.$row["container_size"].'</td>
                               <td>'.$row["container_color"].'</td>
                               <td>'.$row["nature_of_goods"].'</td>
                               <td>'.$row["client"].'</td>
                               <td>'.$row["date"].'</td>
                               <td>'.$row["delivered_by"].'</td>
                               <td>'.$row["mobile"].'</td>
                               <td>'.$row["truck_number_plate"].'</td>
                               <td>'.$row["storage_location"].'</td>
                               <td>'.$row["status"].'</td>
                              </tr>
                              ';
                        }
                        ?>
                    </table>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © CMS 2018</span>
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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logOut.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--daterange-->
<script src="../dataTables/moment.min.js"></script>
<script src="../dataTables/daterangepicker.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../dataTables/daterangepicker.js"></script>


<!--dataTables-->
<script rel="script" src="../dataTables/jquery.dataTables.min.js"></script>
<script rel="script" src="../dataTables/dataTables.bootstrap4.min.js"></script>
<script src="../dataTables/dataTables.buttons.min.js"></script>
<script src="../dataTables/buttons.bootstrap4.min.js"></script>
<script src="../dataTables/jszip.min.js"></script>
<script src="../dataTables/pdfmake.min.js"></script>
<script src="../dataTables/vfs_fonts.js"></script>
<script src="../dataTables/buttons.print.min.js"></script>
<script src="../dataTables/buttons.colVis.min.js"></script>
<script src="../dataTables/buttons.html5.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin.min.js"></script>



<script>
    $(document).ready(function() {

        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = $('#min').datepicker("getDate");
                var max = $('#max').datepicker("getDate");
                var startDate = new Date(data[6]);
                if (min == null && max == null) { return true; }
                if (min == null && startDate <= max) { return true;}
                if(max == null && startDate >= min) {return true;}
                if (startDate <= max && startDate >= min) { return true; }
                return false;
            }
        );




        var table = $('#order_data').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pageLength',
                    className: 'btn btn-outline-success mr-1 text-dark'
                },
                {
                    extend: 'colvis',
                    className: 'btn btn-dark  text-white'
                },
                {
                    extend : 'excel',
                    className: 'btn btn-success btn-sm ml-1 mr-1 text-white',
                    text: '<i class="fa fa-file-excel text-white"></i> excel',
                    messageTop: 'Containers Checked In',
                    messageBottom: '<?php echo $_SESSION['username']; ?>'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm mr-1 text-white',
                    text: '<i class="fa fa-file-pdf text-white"></i> pdf',
                    messageTop: 'Containers Checked In',
                    messageBottom: '<?php echo 'served by ' ,$_SESSION['username']; ?>'
                },
                {
                    extend: 'print',
                    className: 'btn btn-warning btn-sm text-white',
                    text: '<i class="fa fa-print text-white"></i> print',
                    messageTop: '<h2 align="center" class="text-primary">Containers Checked In</h2>',
                    messageBottom: '<h4 align="center" class="text-primary"><?php echo $_SESSION['username']; ?></h4>'
                }
            ]
        } );


        $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });

// Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').change(function () {
            table.draw();
        });




    } );
</script>
</body>
</html>



