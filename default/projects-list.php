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
    <title>Project List | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                                It!</button>
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
                                <h4 class="mb-sm-0">Project List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                        <li class="breadcrumb-item active">Project List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <a href="projects-create-project.php" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end gap-2">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control" placeholder="Search..." id="search-input">
                                    <i class="ri-search-line search-icon"></i>
                                </div>

                                <select class="form-control w-md" data-choices data-choices-search-false>
                                    <option value="All">All</option>
                                    <option value="Today">Today</option>
                                    <option value="Yesterday" selected>Yesterday</option>
                                    <option value="Last 7 Days">Last 7 Days</option>
                                    <option value="Last 30 Days">Last 30 Days</option>
                                    <option value="This Month">This Month</option>
                                    <option value="Last Year">Last Year</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row" id="project-list-cards">
                        <!-- project card  -->

                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <!-- <div class="row g-0 text-center text-sm-start align-items-center mb-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0 text-muted">Showing <span class="fw-semibold">1</span> to <span class="fw-semibold">10</span> of <span class="fw-semibold text-decoration-underline">12</span> entries</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                                <li class="page-item disabled">
                                    <a href="#" class="page-link">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item ">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">3</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">4</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">5</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <!-- end row -->
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
                            </script> © Task Tracker.
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div> -->
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- removeProjectModal -->
    <div id="removeProjectModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Project ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-project">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



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

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- project list init -->
    <script src="assets/js/pages/project-list.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <!-- jquery cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- master js file  -->
    <script src="./assets/js/master.js"></script>
    <!-- moment.js cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script>
        $(document).ready(function() {
            // Search input event listener
            $('#search-input').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                filterProjects(searchText);
            });

            // Dropdown event listener
            $('#time-frame').on('change', function() {
                var selectedValue = $(this).val();
                filterProjectsByTime(selectedValue);
            });

            // Initial filtering on page load (optional)
            filterProjects('');
            filterProjectsByTime($('#time-frame').val());
        });

        function filterProjects(searchText) {
            $('#project-list-cards .project-card').each(function() {
                var projectTitle = $(this).find('.project-title').text().toLowerCase();
                if (projectTitle.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        function filterProjectsByTime(timeFrame) {
            $('#project-list-cards .project-card').each(function() {
                var projectTime = $(this).find('.project-time').text().toLowerCase();
                if (timeFrame === 'All' || projectTime.includes(timeFrame.toLowerCase())) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            $.ajax({
                url: './php/GetProjectList.php',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        let cardString = `<div class="col-xxl-3 col-sm-6 project-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="p-3 mt-n3 mx-n3 bg-soft-secondary rounded-top">
                                        <div class="d-flex gap-1 align-items-center justify-content-end my-n2">
                                            <button type="button" class="btn avatar-xs p-0 favourite-btn active">
                                                <span class="avatar-title bg-transparent fs-15">
                                                    <i class="ri-star-fill"></i>
                                                </span>
                                            </button>
                                            <div class="dropdown">
                                                <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i data-feather="more-horizontal" class="icon-sm"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        View</a>
                                                    <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center pb-3">
                                            <img src="${item.ProjectLogo}" alt="" height="32">
                                        </div>
                                    </div>

                                    <div class="py-3">
                                        <h5 class="fs-14 mb-3"><a href="projects-overview.php?pid=${item.SrNo}" class="text-dark project-title">${item.ProjectName}</a></h5>
                                        <div class="row gy-3">
                                            <div class="col-12">
                                                <div>
                                                    <p class="text-muted mb-1">Created By</p>
                                                    <h5 class="fs-14 mb-1"><a href="apps-projects-overview.html" class="text-soft-dark">${item.EmpName}</a></h5>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    <p class="text-muted mb-1">Priority</p>
                                                    <div class="badge badge-soft-primary fs-12">${item.ProjectPriority}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    <p class="text-muted mb-1">Start Date</p>
                                                    <h5 class="fs-14">${moment(item.Start_Date).format('DD-MM-YYYY')}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gy-3">
                                            <div class="col-6">
                                                <div>
                                                    <p class="text-muted mb-1">Created Date</p>
                                                    <h5 class="fs-14">${moment(item.Created_Date).format('DD-MM-YYYY hh:mm A')}</h5>
                                                    <!-- <div class="badge badge-soft-warning fs-12">Inprogess</div> -->
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    <p class="text-muted mb-1">End Date</p>
                                                    <h5 class="fs-14">${moment(item.End_Date).format('DD-MM-YYYY')}</h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="d-flex mb-2">
                                            <div class="flex-grow-1">
                                                <div>Sub-Tasks</div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div><i class="ri-list-check align-bottom me-1 text-muted"></i> ${item.subtaskCompletedCount}/${item.subtaskCount}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm animated-progress">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="${item.subtaskCompletedCount/item.subtaskCount * 100}" aria-valuemin="0" aria-valuemax="100" style="width: ${item.subtaskCompletedCount/item.subtaskCount * 100}%;"></div>
                                            <!-- /.progress-bar -->
                                        </div><!-- /.progress -->
                                    </div>

                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>`;

                        $('#project-list-cards').append(cardString);
                    })
                }
            })
        })
    </script>

</body>

</html>