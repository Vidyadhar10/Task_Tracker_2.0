<?php
session_start();
include './php/connection.php';
if (isset($_SESSION['Mobile_No'])) {
    $Admin_mob = $_SESSION['Mobile_No'];
    $m = "SELECT * FROM employeedata WHERE $Admin_mob = MobileNo";
    $re5 = $con->query($m);
    while ($getAdminId = $re5->fetch_assoc()) {
        $Admin_id = $getAdminId['ID'];
        $Uname = $getAdminId['EmpName'];
        $UDesignation = $getAdminId['Position'];
        if (!empty($getAdminId['ProfilePhoto']) == null) {
            $profilePhoto = './assets/images/users/avatar-blank.jpg';
        } else {
            $profilePhoto =  $getAdminId['ProfilePhoto'];
        }
    }
} else {
    header("location:./php/logout.php");
}
$_SESSION['Admin_id'] = $Admin_id;
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Leave Applications | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- custom style  -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php
        include './php/Header.php';
        ?>

        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- ========== App Menu ========== -->
        <?php
        include './php/App_Menu.php';
        ?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Leaves</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Leaves</a></li>
                                        <li class="breadcrumb-item active">Applications</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-sm-4">
                                    <div class="d-md-flex align-items-center">
                                        <h5 class="card-title mb-3 mb-md-0 flex-grow-1">Leave Applications</h5>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-sm-auto ms-auto">
                                    <div class="list-grid-nav hstack gap-1">
                                        <button type="button" id="list-view-button" class="btn btn-soft-info nav-link  btn-icon fs-14 active filter-button" data-bs-toggle="tooltip" title="List View"><i class="ri-list-unordered"></i></button>
                                        <button type="button" id="grid-view-button" class="btn btn-soft-info nav-link btn-icon fs-14 filter-button" data-bs-toggle="tooltip" title="grid View"><i class="ri-grid-fill"></i></button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                    </div>

                    <div class="row" id="leaves-list-view">
                        <div class="col-lg-12">
                            <div class="card" id="applicationList">
                                <!-- <div class="card-header  border-0">
                                    <div class="d-md-flex align-items-center">
                                        <h5 class="card-title mb-3 mb-md-0 flex-grow-1">Leave Applications</h5>
                                    </div>
                                </div> -->
                                <div class="card-body border border-dashed border-end-0 border-start-0">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-xxl-5 col-sm-6">
                                                <div class="search-box">
                                                    <input type="text" class="form-control" id="search-input" placeholder="Search for Employee name, status, start date, end date or something...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-3 col-sm-6">
                                                <div>
                                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" id="demo-datepicker" placeholder="Select date">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-2 col-sm-4">
                                                <div>
                                                    <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                                        <option value="">Status</option>
                                                        <option value="all" selected>All</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Rejected">Rejected</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-xxl-2 col-sm-4">
                                                <div>
                                                    <button type="button" class="btn btn-primary w-100" id="filter-btn"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                        Filters
                                                    </button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <div class="card-body pt-0">
                                    <div>
                                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">

                                        </ul>

                                        <div class="table-responsive table-card mb-1">
                                            <table class="table table-nowrap align-middle border-bottom" id="LeaveApplicationsTable">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th class="sort" data-sort="id" style="width: 6.5%;">Sr No</th>
                                                        <th class="sort" data-sort="employee-name">Employee Name</th>
                                                        <th class="sort" data-sort="leave-start-date">Start Date</th>
                                                        <th class="sort" data-sort="leave-end-date">End Date</th>
                                                        <th class="sort" data-sort="leave-reason">Reason</th>
                                                        <th class="sort" data-sort="leave-type">Type</th>
                                                        <th class="sort" data-sort="leave-status">Status</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="form-check-all">

                                                </tbody>
                                            </table>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted">We've searched more than 150+ result We did not find jobs for you search.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled" href="#">
                                                    Previous
                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="#">
                                                    Next
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                    <div class="row row-cols-xxl-4 row-cols-lg-3 row-cols-1 d-none" id="leaves-grid-view">

                        <div class="col">
                            <div class="card card-body">
                                <div class="d-flex mb-4 align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-sm rounded-circle" />
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h5 class="card-title mb-1">Oliver Phillips</h5>
                                        <p class="text-muted mb-0">Digital Marketing</p>
                                    </div>
                                </div>
                                <a href="#" class="d-flex py-1 card-text align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="fs-13 mb-0 listname">Start Date</h5>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <span class="badge fs-13 bg-light text-primary">12 sep,2023</span>
                                    </div>
                                </a>
                                <a href="#" class="d-flex py-1 card-text align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="fs-13 mb-0 listname">End Date</h5>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <span class="badge fs-13 bg-light text-primary">12 sep,2023</span>
                                    </div>
                                </a>
                                <p class="card-text fs-13 mb-1 listname">Reason</p>
                                <p class="card-text text-muted mb-1">Expense Account</p>

                                <a href="#" class="d-flex py-1 mb-2 card-text align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="fs-13 mb-0 listname">Type</h5>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <span class="badge fs-13 bg-light text-primary text-uppercase">Personal</span>
                                    </div>
                                </a>
                                <div class="flex-shrink-0 ms-2 mb-2">
                                    <span class="badge fs-13 w-100 bg-light text-success text-uppercase">approved</span>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm"> <i class="ri-eye-line"></i> See Details</a>
                            </div>
                        </div>


                        <div class="row g-0 col-xxl-12 text-center text-sm-start align-items-center mb-4">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack grid-pg-wrap gap-2">
                                        <a class="page-item pagination-prev grid-prev-pg" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination grid-listjs-pgn mb-0"></ul>
                                        <a class="page-item pagination-next grid-next-pg" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>



    <!-- JAVASCRIPT -->
    <!-- ajax cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- master js file  -->
    <script src="./assets/js/master.js"></script>
    <!-- moment.js cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Sweet Alerts js -->
    <!-- <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script> -->
    <!-- sweet alert aimation cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- ckeditor -->
    <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <!-- form validation setup  -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#list-view-button').on('click', function() {
            $('#list-view-button').addClass('active')
            $('#grid-view-button').removeClass('active')

            $('#leaves-list-view').removeClass('d-none')
            $('#leaves-grid-view').addClass('d-none')
        })
        $('#grid-view-button').on('click', function() {
            $('#grid-view-button').addClass('active')
            $('#list-view-button').removeClass('active')

            $('#leaves-list-view').addClass('d-none')
            $('#leaves-grid-view').removeClass('d-none')

        })

        ShowAllLeaveApplications();

        function ShowAllLeaveApplications() {
            $.ajax({
                url: './php/GetAllLeaves.php',
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    $('#LeaveApplicationsTable tbody').empty();
                    $('#leaves-grid-view').empty();

                    if (data.length <= 0) {
                        $('.noresult').css('display', 'block');
                    }
                    var srno = 1;
                    $.each(data, function(ind, item) {

                        var tableString = ` <tr>
                                                <td class="id"><a href="#" class="fw-medium link-primary">${srno++}</a></td>
                                                <td class="employee-name">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="${item.ProfilePhoto == null ? 'assets/images/users/avatar-blank.jpg' : item.ProfilePhoto}" alt="" class="avatar-xxs rounded-circle image_src object-cover">
                                                        </div>
                                                        <div class="flex-grow-1 ms-2">${item.EmpName}</div>
                                                    </div>
                                                </td>
                                                <td class="leave-start-date">${moment(item.Startdate).format('D MMM, YYYY')}</td>
                                                <td class="leave-end-date">${moment(item.EndDate).format('D MMM, YYYY')}</td>
                                                <td class="leave-reason">${item.reason}</td>
                                                <td class="leave-type"><span class="badge badge-soft-info text-uppercase">${item.leave_category}</span>
                                                <td class="leave-status"><span class="badge badge-soft-${item.ApproveStatus == 0 ? 'danger':'success' && item.ApproveStatus == null ? 'primary' : 'success'} text-uppercase">${item.ApproveStatus == 0 ? 'Rejected':'Approved' && item.ApproveStatus == null ? 'Pending' : 'Approved'}</span>
                                                </td>
                                                <td>
                                                    <ul class=" hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                            <a href="leaves-details.php?leaveID=${btoa(item.id)}" class="text-primary d-inline-block">
                                                                <i class="ri-eye-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>`;
                        $('#LeaveApplicationsTable tbody').append(tableString);
                        TablePagination()
                        var CardString = ` <div class="col leaveCard">
                                                <div class="card card-body">
                                                    <div class="d-flex mb-4 align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="${item.ProfilePhoto == null ? 'assets/images/users/avatar-blank.jpg' : item.ProfilePhoto}" alt="" class="avatar-sm rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-2">
                                                            <h5 class="card-title mb-1">${item.EmpName}</h5>
                                                            <p class="text-muted mb-0">${item.Position}</p>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="d-flex py-1 card-text align-items-center" style="pointer-events:none;">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">Start Date</h5>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <span class="badge fs-13 bg-light text-primary">${moment(item.Startdate).format('D MMM, YYYY')}</span>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="d-flex py-1 card-text align-items-center" style="pointer-events:none;">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">End Date</h5>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <span class="badge fs-13 bg-light text-primary">${moment(item.EndDate).format('D MMM, YYYY')}</span>
                                                        </div>
                                                    </a>
                                                    <p class="card-text fs-13 mb-1 "> <h5 class="fs-13 mb-0 listname">Reason</h5></p>
                                                    <p class="card-text text-muted mb-1">${item.reason}</p>

                                                    <a href="#" class="d-flex py-1 mb-2 card-text align-items-center" style="pointer-events:none;">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">Type</h5>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <span class="badge fs-13 bg-light text-primary text-uppercase">${item.leave_category}</span>
                                                        </div>
                                                    </a>
                                                    <div class="flex-shrink-0 ms-2 mb-2">
                                                        <span class="badge fs-13 w-100 bg-light text-${item.ApproveStatus == 0 ? 'danger':'success' && item.ApproveStatus == null ? 'primary' : 'success'} text-uppercase">${item.ApproveStatus == 0 ? 'Rejected':'Approved' && item.ApproveStatus == null ? 'Pending' : 'Approved'}</span>
                                                    </div>
                                                    <a href="leaves-details.php?leaveID=${btoa(item.id)}" class="btn btn-primary btn-sm"> <i class="ri-eye-line"></i> See Details</a>
                                                </div>
                                            </div>`;
                        $('#leaves-grid-view').append(CardString)

                    })
                    var gridViewPagination = `  <div class="row g-0 col-xxl-12 text-center text-sm-start align-items-center mb-4">
                                                    <div class="col-sm-12">
                                                        <div class="d-flex justify-content-end">
                                                            <div class="pagination-wrap hstack grid-pg-wrap gap-2">
                                                                <a class="page-item pagination-prev grid-prev-pg" href="#">
                                                                    Previous
                                                                </a>
                                                                <ul class="pagination listjs-pagination grid-listjs-pgn mb-0"></ul>
                                                                <a class="page-item pagination-next grid-next-pg" href="#">
                                                                    Next
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`;
                    $('#leaves-grid-view').append(gridViewPagination)
                    GridPagination()

                }
            })
        }

        function TablePagination() {
            // Search functionality
            $("#search-input").on("keyup", function() {
                var searchText = $(this).val().toLowerCase();
                $("#LeaveApplicationsTable tbody tr").filter(function() {
                    // console.log(searchText);
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            const tableRows = $("#LeaveApplicationsTable tbody tr");
            $("#filter-btn").on("click", function() {
                const dateRange = $("#demo-datepicker").val(); // Get the date range string
                const startDate = dateRange.split(" to ")[0]; // Extract start date from the range
                const endDate = dateRange.split(" to ")[1];
                const status = $("#idStatus").val();

                tableRows.each(function() {
                    const date = $(this).find(".leave-start-date").text();
                    const leaveStatus = $(this).find(".leave-status").text().toLowerCase();

                    const matchesDate = startDate === "" || (date >= startDate && date <= endDate);
                    const matchesStatus = status === "" || status === "all" || leaveStatus === status;

                    $(this).toggle(matchesDate && matchesStatus);
                });
            });
            // Pagination initialization
            var itemsPerPage = 10;
            var currentPage = 1;
            var totalItems = $("#LeaveApplicationsTable tbody tr").length;
            var totalPages = Math.ceil(totalItems / itemsPerPage);

            function updatePagination() {
                $(".pagination-wrap .listjs-pagination").empty();
                for (var i = 1; i <= totalPages; i++) {
                    var activeClass = (i === currentPage) ? "active" : "";
                    $(".pagination-wrap .listjs-pagination").append(
                        '<li class="page-item ' + activeClass + '"><a class="page-link" href="#">' + i + '</a></li>'
                    );
                }
            }

            // Pagination click event
            $(".pagination-wrap .listjs-pagination").on("click", "a.page-link", function(e) {
                e.preventDefault();
                currentPage = parseInt($(this).text());
                updatePagination();
                updateTableRows();
            });
            $(".pagination-prev").on("click", function() {
                if (currentPage > 1) {
                    currentPage--;
                    updatePagination();
                    updateTableRows();
                }
            });

            $(".pagination-next").on("click", function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updatePagination();
                    updateTableRows();
                }
            });

            function updateTableRows() {
                var startIndex = (currentPage - 1) * itemsPerPage;
                var endIndex = startIndex + itemsPerPage;
                $("#LeaveApplicationsTable tbody tr").hide().slice(startIndex, endIndex).show();
            }

            // Initial setup
            updatePagination();
            updateTableRows();
        }

        function GridPagination() {
            const tableRows = $(".leaveCard");
            // Pagination initialization
            var itemsPerPage = 8;
            var currentPage = 1;
            var totalItems = $(".leaveCard").length;
            var totalPages = Math.ceil(totalItems / itemsPerPage);

            function updateGridPagination() {
                $(".grid-pg-wrap .grid-listjs-pgn").empty();
                for (var i = 1; i <= totalPages; i++) {
                    var activeClass = (i === currentPage) ? "active" : "";
                    $(".grid-pg-wrap .grid-listjs-pgn").append(
                        '<li class="page-item ' + activeClass + '"><a class="page-link" href="#">' + i + '</a></li>'
                    );
                }
            }

            // Pagination click event
            $(".grid-pg-wrap .grid-listjs-pgn").on("click", "a.page-link", function(e) {
                e.preventDefault();
                currentPage = parseInt($(this).text());
                updateGridPagination();
                updateGridRows();
            });
            $(".pagination-prev").on("click", function() {
                if (currentPage > 1) {
                    currentPage--;
                    updateGridPagination();
                    updateGridRows();
                }
            });

            $(".pagination-next").on("click", function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateGridPagination();
                    updateGridRows();
                }
            });

            function updateGridRows() {
                var startIndex = (currentPage - 1) * itemsPerPage;
                var endIndex = startIndex + itemsPerPage;
                $(".leaveCard").hide().slice(startIndex, endIndex).show();
            }

            // Initial setup
            updateGridPagination();
            updateGridRows();
        }
    </script>
    <!-- Your existing HTML content -->


    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- list.js min js -->
    <script src="assets/libs/list.js/list.min.js"></script>

    <!--list pagination js-->
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <!-- ecommerce-order init js -->
    <!-- <script src="assets/js/pages/job-application.init.js"></script> -->

    <!-- Sweet Alerts js -->
    <!-- <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script> -->

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>