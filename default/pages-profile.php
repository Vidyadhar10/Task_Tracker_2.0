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
    <title>Profile | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, , maximum-scale=1.0, user-scalable=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- swiper css -->
    <link rel="stylesheet" href="assets/libs/swiper/swiper-bundle.min.css">

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
                    <div class="profile-foreground position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg">
                            <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
                        </div>
                    </div>
                    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
                        <div class="row g-4">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    <img src="assets/images/users/avatar-1.jpg" id="EmployeeProfilePhoto" alt="user-img" class="img-thumbnail rounded-circle" />
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col">
                                <div class="p-2">
                                    <h3 class="text-white mb-1 EmployeeName"></h3>
                                    <p class="text-white-75 EmployeeDesignation"></p>
                                    <div class="hstack text-white-50 gap-1">
                                        <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i><span class="EmployeeAddress"></span></div>
                                        <!-- <div>
                                            <i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>Themesbrand
                                        </div> -->
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div class="d-flex profile-wrapper">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Overview</span>
                                            </a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                                                <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Activities</span>
                                            </a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#subtasksDetails" role="tab">
                                                <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Subtasks Details</span>
                                            </a>
                                        </li>

                                    </ul>
                                    <?php
                                    if (base64_encode($Admin_id) == $_GET['id']) {
                                    ?>
                                        <div class="flex-shrink-0">
                                            <a href="pages-profile-settings.php?eid=<?php echo $_GET['id']; ?>" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content pt-4 text-muted">
                                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                        <div class="row">
                                            <div class="col-xxl-4">


                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">Info</h5>
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Full Name :</th>
                                                                        <td class="text-muted EmployeeName"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Mobile :</th>
                                                                        <td class="text-muted MobileNum"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">E-mail :</th>
                                                                        <td class="text-muted empEmail"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="ps-0" scope="row">Location :</th>
                                                                        <td class="text-muted EmployeeAddress">California, United States
                                                                        </td>
                                                                    </tr>
                                                                    <!-- <tr>
                                                                        <th class="ps-0" scope="row">Joining Date</th>
                                                                        <td class="text-muted">24 Nov 2021</td>
                                                                    </tr> -->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->

                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-4">Portfolio</h5>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <div>
                                                                <a href="javascript:void(0);" id="twitter-link" target="blank" class="avatar-xs d-block">
                                                                    <span class="avatar-title rounded-circle fs-16 bg-dark text-light">
                                                                        <i class="ri-twitter-fill"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="javascript:void(0);" id="facebook-link" target="blank" class="avatar-xs d-block">
                                                                    <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                                        <i class="ri-facebook-fill"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="javascript:void(0);" id="instagram-link" target="blank" class="avatar-xs d-block">
                                                                    <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                                        <i class="ri-instagram-fill"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="javascript:void(0);" id="linkedin-link" target="blank" class="avatar-xs d-block">
                                                                    <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                                        <i class="ri-linkedin-box-fill"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->

                                                <!-- <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-4">Skills</h5>
                                                        <div class="d-flex flex-wrap gap-2 fs-15">
                                                            <a href="javascript:void(0);" class="badge badge-soft-primary">Photoshop</a>
                                                            <a href="javascript:void(0);" class="badge badge-soft-primary">illustrator</a>
                                                            <a href="javascript:void(0);" class="badge badge-soft-primary">HTML</a>
                                                            <a href="javascript:void(0);" class="badge badge-soft-primary">CSS</a>
                                                            <a href="javascript:void(0);" class="badge badge-soft-primary">Javascript</a>
                                                            <a href="javascript:void(0);" class="badge badge-soft-primary">Php</a>
                                                            <a href="javascript:void(0);" class="badge badge-soft-primary">Python</a>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- end card -->



                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-8">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-3">About</h5>
                                                        <p class="AboutEmployee">

                                                        </p>
                                                        <div class="row">
                                                            <div class="col-6 col-md-4">
                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                                            <i class="ri-user-2-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 overflow-hidden">
                                                                        <p class="mb-1">Designation :</p>
                                                                        <h6 class="text-truncate mb-0 EmployeeDesignation"></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <!-- <div class="col-6 col-md-4">
                                                                <div class="d-flex mt-4">
                                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                        <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                                            <i class="ri-global-line"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 overflow-hidden">
                                                                        <p class="mb-1">Website :</p>
                                                                        <a href="#" class="fw-semibold">www.velzon.com</a>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <!--end card-body-->
                                                </div><!-- end card -->


                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>

                                    <!-- <div class="tab-pane fade" id="activities" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Activities</h5>
                                                <div class="acitivity-timeline">
                                                    <div class="acitivity-item d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Oliver Phillips <span class="badge bg-soft-primary text-primary align-middle">New</span></h6>
                                                            <p class="text-muted mb-2">We talked about a project on linkedin.</p>
                                                            <small class="mb-0 text-muted">Today</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                            <div class="avatar-title bg-soft-success text-success rounded-circle">
                                                                N
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Nancy Martino <span class="badge bg-soft-secondary text-secondary align-middle">In Progress</span></h6>
                                                            <p class="text-muted mb-2"><i class="ri-file-text-line align-middle ms-2"></i> Create new project Buildng product</p>
                                                            <div class="avatar-group mb-2">
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Christi">
                                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs" />
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Frank Hook">
                                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xs" />
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title=" Ruby">
                                                                    <div class="avatar-xs">
                                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                                            R
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="more">
                                                                    <div class="avatar-xs">
                                                                        <div class="avatar-title rounded-circle">
                                                                            2+
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <small class="mb-0 text-muted">Yesterday</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Natasha Carey <span class="badge bg-soft-success text-success align-middle">Completed</span>
                                                            </h6>
                                                            <p class="text-muted mb-2">Adding a new event with attachments</p>
                                                            <div class="row">
                                                                <div class="col-xxl-4">
                                                                    <div class="row border border-dashed gx-2 p-2 mb-2">
                                                                        <div class="col-4">
                                                                            <img src="assets/images/small/img-2.jpg" alt="" class="img-fluid rounded" />
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <img src="assets/images/small/img-3.jpg" alt="" class="img-fluid rounded" />
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <small class="mb-0 text-muted">25 Nov</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Bethany Johnson</h6>
                                                            <p class="text-muted mb-2">added a new member to velzon dashboard</p>
                                                            <small class="mb-0 text-muted">19 Nov</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs acitivity-avatar">
                                                                <div class="avatar-title rounded-circle bg-soft-danger text-danger">
                                                                    <i class="ri-shopping-bag-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Your order is placed <span class="badge bg-soft-danger text-danger align-middle ms-1">Out of Delivery</span></h6>
                                                            <p class="text-muted mb-2">These customers can rest assured their order has been placed.</p>
                                                            <small class="mb-0 text-muted">16 Nov</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Lewis Pratt</h6>
                                                            <p class="text-muted mb-2">They all have something to say
                                                                beyond the words on the page. They can come across as
                                                                casual or neutral, exotic or graphic. </p>
                                                            <small class="mb-0 text-muted">22 Oct</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item py-3 d-flex">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs acitivity-avatar">
                                                                <div class="avatar-title rounded-circle bg-soft-info text-info">
                                                                    <i class="ri-line-chart-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">Monthly sales report</h6>
                                                            <p class="text-muted mb-2">
                                                                <span class="text-danger">2 days left</span> notification to submit the monthly sales report. <a href="javascript:void(0);" class="link-warning text-decoration-underline">Reports Builder</a>
                                                            </p>
                                                            <small class="mb-0 text-muted">15 Oct</small>
                                                        </div>
                                                    </div>
                                                    <div class="acitivity-item d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle acitivity-avatar" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">New ticket received <span class="badge bg-soft-success text-success align-middle">Completed</span></h6>
                                                            <p class="text-muted mb-2">User <span class="text-secondary">Erica245</span> submitted a ticket.</p>
                                                            <small class="mb-0 text-muted">26 Aug</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!--end tab-pane-->
                                    <div class="tab-pane fade" id="subtasksDetails" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    SubTasks Assigned
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">


                                                    <div class="col-xxl-12 col-sm-6">
                                                        <div class="table-responsive table-card">
                                                            <table class="table table-nowrap mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th scope="col">Sr No</th>
                                                                        <th scope="col">Title</th>
                                                                        <th scope="col">Key</th>
                                                                        <th scope="col">Priority</th>
                                                                        <th scope="col">Assigned Date</th>
                                                                        <th scope="col">Due Date</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="subtaks-table-body">



                                                                </tbody>
                                                            </table>
                                                            <div class="noresult" style="display: none">
                                                                <div class="text-center">
                                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                                    <h5 class="mt-2">Sorry! No Subtasks Yet</h5>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="mt-4">
                                                            <ul class="pagination pagination-separated justify-content-center mb-0" id="pagination">
                                                                <li class="page-item" id="prev-page">
                                                                    <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                                                </li>
                                                                <!--asdf  -->
                                                                <li class="page-item" id="next-page">
                                                                    <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!--end card-body-->
                                        </div>
                                        <!--end card-->
                                    </div>
                                    <!--end tab-pane-->

                                </div>
                                <!--end tab-content-->
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

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
        </div><!-- end main content-->

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



    <!-- JAVASCRIPT -->
    <!-- ajax cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- master js file  -->
    <script src="./assets/js/master.js"></script>
    <!-- moment.js cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
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
        //your scripts here
        var empid = atob('<?php echo $_GET['id']; ?>');

        ShowEmployeeData();

        function ShowEmployeeData() {
            $.ajax({
                url: './php/GetEmployeeData.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    empid: empid,
                },
                success: function(data) {
                    $.each(data, function(index, item) {
                        $('#EmployeeProfilePhoto').attr('src', item.ProfilePhoto == null ? 'assets/images/users/avatar-blank.jpg' : item.ProfilePhoto)
                        $('.EmployeeName').html(item.EmpName);
                        $('.EmployeeDesignation').html(item.Position)
                        $('.EmployeeAddress').html(item.Address)
                        $('.MobileNum').html(item.MobileNo)
                        $('.empEmail').html(item.Email)
                        $('.AboutEmployee').html(item.About)

                        //links
                        var twitterUnm;
                        var fbUnm;
                        var instaUnm;
                        var linkedinUnm;

                        item.Twitter != '' ? twitterUnm = item.Twitter : twitterUnm = '#';
                        item.Facebook != '' ? fbUnm = item.Facebook : fbUnm = '#';
                        item.Instagram != '' ? instaUnm = item.Instagram : instaUnm = '#';
                        item.Linkedin != '' ? linkedinUnm = item.Linkedin : linkedinUnm = '#';


                        $('#twitter-link').attr('href', twitterUnm)
                        $('#facebook-link').attr('href', fbUnm)
                        $('#instagram-link').attr('href', instaUnm)
                        $('#linkedin-link').attr('href', linkedinUnm)
                    })
                }
            })
        }

        function ShowEmployeeTaskData() {
            $.ajax({
                url: './php/GetEmployeeSubtasks.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    empid: empid,
                },
                success: function(result) {
                    // console.log(result);
                    if (result.length <= 0) {
                        $('.noresult').css('display', 'block');
                    } else {
                        $('.noresult').css('display', 'none');
                        var srno = 1;
                        $.each(result, function(ind, it) {
                            var tableRowString = `<tr>
                                                  <td class="text-right"><a href="#" class="fw-semibold">${srno++}</a></td>
                                                  <td>${it.subtaskname}</td>
                                                  <td>${it.SubTaskKeyText}</td>
                                                  <td><span class="badge bg-success">${it.Sub_Priority}</span></td>
                                                  <td>${moment(it.Created_Date).format('D MMM, YYYY hh:mm A')}</td>
                                                  <td>${moment(it.subtaskDue).format('D MMM, YYYY hh:mm A')}</td>
                                                  <td><span class="badge bg-primary">${it.stages}</span></td>
                                                  <td>
                                                      <button type="button" class="btn btn-sm btn-light" onclick="SubtaskDetailsNavigation(${it.subtask_ID})">Details</button>
                                                  </td>
                                              </tr>`;
                            $('#subtaks-table-body').append(tableRowString);

                        })
                    }
                }
            })
        }

        // pagination code starts here
        const itemsPerPage = 10; // Number of items to show per page
        const tableBody = $('#subtaks-table-body');
        const rows = tableBody.find('tr');
        const pagination = $('#pagination');

        function updatePagination(pageNumber) {
            const startIndex = (pageNumber - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            rows.hide();
            rows.slice(startIndex, endIndex).show();
        }

        function createPaginationButtons(totalPages) {
            pagination.empty();

            for (let page = 1; page <= totalPages; page++) {
                const li = $('<li>').addClass('page-item');
                if (page === 1) {
                    li.addClass('active');
                }

                const link = $('<a>').addClass('page-link').attr('href', 'javascript:void(0);').text(page);

                link.on('click', function() {
                    updatePagination(page);
                    pagination.find('.active').removeClass('active');
                    li.addClass('active');
                });

                li.append(link);
                pagination.append(li);
            }
        }

        $(document).ready(function() {
            ShowEmployeeTaskData();
            updatePagination(1);
            const totalPages = Math.ceil(rows.length / itemsPerPage);
            createPaginationButtons(totalPages);
        });
    </script>


    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- swiper js -->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- profile init js -->
    <script src="assets/js/pages/profile.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>