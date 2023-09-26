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
    <title>SubTask Details | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
                                <h4 class="mb-sm-0">SubTask Details</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks</a></li>
                                        <li class="breadcrumb-item active">SubTask Details</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xxl-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted">
                                        <h6 class="mb-3 fw-semibold text-uppercase">Title</h6>
                                        <p id="SubtaskTitle">
                                        </p>

                                        <div class="pt-3 border-top border-top-dashed mt-4">
                                            <h6 class="mb-3 fw-semibold text-uppercase">Description</h6>
                                            <p id="SubtaskDescription">
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                                    Comments (5)
                                                </a>
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                                    Attachments File (4)
                                                </a>
                                            </li> -->
                                            <!-- <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">
                                                    Time Entries (9 hrs 13 min)
                                                </a>
                                            </li> -->
                                        </ul>
                                        <!--end nav-->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home-1" role="tabpanel">
                                            <h5 class="card-title mb-4">Comments</h5>
                                            <div data-simplebar class="px-3 mx-n3 mb-2 ScrollBarCss" style="max-height: 400px; overflow:auto" id="CommentMsgBox">


                                                <div class="d-flex mb-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-13"><a href="pages-profile.html">Thomas Taylor</a> <small class="text-muted">24 Dec 2021 - 05:20PM</small></h5>
                                                        <p class="text-muted">If you have further questions, please contact Customer Support from the “Action Menu” on your <a href="javascript:void(0);" class="text-decoration-underline">Online Order Support</a>.</p>
                                                        <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-13"><a href="pages-profile.html">Tonya Noble</a> <small class="text-muted">26 min ago</small></h5>
                                                        <p class="text-muted">Your <a href="javascript:void(0)" class="text-decoration-underline">Online Order Support</a> provides you with the most current status of your order. To help manage your order refer to the “Action Menu” to initiate return, contact Customer Support and more.</p>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col-lg-1 col-sm-2 col-6">
                                                                <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded">
                                                            </div>
                                                            <div class="col-lg-1 col-sm-2 col-6">
                                                                <img src="assets/images/small/img-5.jpg" alt="" class="img-fluid rounded">
                                                            </div>
                                                        </div>
                                                        <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0">
                                                                <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle" />
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="fs-13"><a href="pages-profile.html">Nancy Martino</a> <small class="text-muted">8 sec ago</small></h5>
                                                                <p class="text-muted">Other shipping methods are available at checkout if you want your purchase delivered faster.</p>
                                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form class="mt-4">
                                                <div class="row g-3">
                                                    <div class="col-lg-12">
                                                        <label for="CommentTextarea" class="form-label">Leave a Comments</label><br>
                                                        <label for="replingCommenter" class="form-label d-none text-muted" id="ReplingCommenter" style="font-style: italic;"></label>
                                                        <textarea class="form-control bg-light border-light" id="CommentTextarea" rows="3" placeholder="Enter comments"></textarea>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-12">
                                                        <div class="text-start" id="attachedFiles">



                                                        </div>
                                                        <div class="text-end">
                                                            <input type="file" class="d-none" name="commentFileInput" id="commentFileInput">
                                                            <button type="button" onclick="OpenAttachment()" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i class="ri-attachment-line fs-16"></i></button>
                                                            <a href="javascript:void(0);" id="CommentPostBtn" class="btn btn-success">Post Comments</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="messages-1" role="tabpanel">
                                            <div class="table-responsive table-card">
                                                <table class="table table-borderless align-middle mb-0">
                                                    <thead class="table-light text-muted">
                                                        <tr>
                                                            <th scope="col">File Name</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Size</th>
                                                            <th scope="col">Upload Date</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                                            <i class="ri-file-zip-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0)">App pages.zip</a></h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>Zip File</td>
                                                            <td>2.22 MB</td>
                                                            <td>21 Dec, 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink1" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                                            <i class="ri-file-pdf-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Velzon admin.ppt</a></h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>PPT File</td>
                                                            <td>2.24 MB</td>
                                                            <td>25 Dec, 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div class="avatar-title bg-soft-info text-info rounded fs-20">
                                                                            <i class="ri-folder-line"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Images.zip</a></h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>ZIP File</td>
                                                            <td>1.02 MB</td>
                                                            <td>28 Dec, 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a></li>
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                                            <i class="ri-image-2-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Bg-pattern.png</a></h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>PNG File</td>
                                                            <td>879 KB</td>
                                                            <td>02 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink4" data-bs-toggle="dropdown" aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink4" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a></li>
                                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end table-->
                                            </div>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="profile-1" role="tabpanel">
                                            <h6 class="card-title mb-4 pb-2">Time Entries</h6>
                                            <div class="table-responsive table-card">
                                                <table class="table align-middle mb-0">
                                                    <thead class="table-light text-muted">
                                                        <tr>
                                                            <th scope="col">Member</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Duration</th>
                                                            <th scope="col">Timer Idle</th>
                                                            <th scope="col">Tasks Title</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xxs">
                                                                    <div class="flex-grow-1 ms-2">
                                                                        <a href="pages-profile.html" class="fw-medium">Thomas Taylor</a>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>02 Jan, 2022</td>
                                                            <td>3 hrs 12 min</td>
                                                            <td>05 min</td>
                                                            <td>Apps Pages</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                                                                    <div class="flex-grow-1 ms-2">
                                                                        <a href="pages-profile.html" class="fw-medium">Tonya Noble</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>28 Dec, 2021</td>
                                                            <td>1 hrs 35 min</td>
                                                            <td>-</td>
                                                            <td>Profile Page Design</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                                                                    <div class="flex-grow-1 ms-2">
                                                                        <a href="pages-profile.html" class="fw-medium">Tonya Noble</a>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>27 Dec, 2021</td>
                                                            <td>4 hrs 26 min</td>
                                                            <td>03 min</td>
                                                            <td>Ecommerce Dashboard</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end table-->
                                            </div>
                                        </div>
                                        <!--edn tab-pane-->

                                    </div>
                                    <!--end tab-content-->
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3">

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <!-- <label for="stageDropdown" class="mb-3 fw-semibold text-uppercase">Status</label> -->
                                        <select class="form-control" name="choices-single-default" id="stageDropdown" data-choices data-choices-search-false>
                                            <option value="">Select Stage</option>
                                            <?php
                                            include 'assets/php/connection.php';
                                            $query = "SELECT * FROM `subtask_stages`";
                                            $result = $con->query($query);
                                            $counter = 0;
                                            if ($result->num_rows > 0) {
                                                while ($optionData = $result->fetch_assoc()) {
                                                    $counter++;
                                                    $options = $optionData['stages'];
                                                    $Subtask_StageID = $optionData['id'];
                                            ?>
                                                    <option value="<?php echo $Subtask_StageID; ?>"><?php echo $options; ?></option>
                                            <?php }
                                            } ?>
                                            <?php mysqli_close($con); ?>
                                        </select>
                                    </div>
                                    <!-- <label for="" class="mb-4 fw-semibold text-uppercase">Details</label> -->

                                    <div class="table-card">

                                        <table class="table mb-0">
                                            <tbody>

                                                <!-- <tr>
                                                    <td class="fw-medium">Tasks Title</td>
                                                    <td>Profile Page Satructure</td>
                                                </tr> -->
                                                <tr>
                                                    <td class="fw-medium">Project Name</td>
                                                    <td id="SubtasksProjectName"></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">Priority</td>
                                                    <td><span class="badge badge-soft-danger" id="subtaskPriority">High</span></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td class="fw-medium">Status</td>
                                                    <td><span class="badge badge-soft-secondary">Inprogress</span></td>
                                                </tr> -->
                                                <tr>
                                                    <td class="fw-medium">Created Date</td>
                                                    <td id="CreatedDate">05 Jan, 2022</td>
                                                </tr>
                                                <tr>
                                                    <div id="created_By_ID" class="d-none"></div>
                                                    <td class="fw-medium">Created By</td>
                                                    <td id="CreatedByName" class="">
                                                        <!-- <a href="javascript: void(0);" class="avatar-group-item">
                                                            <div class="avatar-xs" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" id="AssigneeNameTitle" title="">
                                                                <img src="assets/images/users/avatar-2.jpg" alt="" id="AssigneePhoto" class="rounded-circle img-fluid">
                                                            </div>
                                                        </a> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">Due Date</td>
                                                    <td id="DueDate">05 Jan, 2022</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end table-->
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                            <div class="card mb-3">
                                <?php
                                if ($_SESSION['AdminStatus']) {
                                ?>
                                    <div class="card-header align-items-center d-flex border-bottom-dashed">
                                        <h4 class="card-title mb-0 flex-grow-1">Members</h4>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-soft-danger btn-sm" data-bs-toggle="modal" data-bs-target="#updateMembersModal"><i class="ri-repeat-2-line me-1 align-bottom"></i> Re-assign</button>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <h6 class="mb-0 flex-grow-1 fw-semibold text-uppercase">Assigned To</h6>
                                    </div>
                                    <ul class="list-unstyled vstack gap-3 mb-0">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-10.jpg" id="AssigneePhoto" alt="" class="avatar-xs rounded-circle">
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-1"><a href="pages-profile.html" id="AssigneeNm"></a></h6>
                                                    <p class="text-muted mb-0" id="AssigneeDesignation"></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body border-top border-top-dashed">
                                    <div class="d-flex mb-3">
                                        <h6 class="mb-0 flex-grow-1 fw-semibold text-uppercase">Report To</h6>
                                    </div>
                                    <ul class="list-unstyled vstack gap-3 mb-0">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-10.jpg" id="ReporterPhoto" alt="" class="avatar-xs rounded-circle">
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-1"><a href="pages-profile.html" id="ReporterNm">Tonya Noble</a></h6>
                                                    <p class="text-muted mb-0" id="ReporterDesignation">Full Stack Developer</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end card-->

                        </div>
                        <!---end col-->

                    </div>
                    <!--end row-->

                    <div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                                <div class="modal-header p-3 ps-4 bg-soft-success">
                                    <h5 class="modal-title" id="inviteMembersModalLabel">Team Members</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="search-box mb-3">
                                        <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>

                                    <div class="mb-4 d-flex align-items-center">
                                        <div class="me-2">
                                            <h5 class="mb-0 fs-13">Members :</h5>
                                        </div>
                                        <div class="avatar-group justify-content-center">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tonya Noble">
                                                <div class="avatar-xs">
                                                    <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Thomas Taylor">
                                                <div class="avatar-xs">
                                                    <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy Martino">
                                                <div class="avatar-xs">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                                        <div class="vstack gap-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid rounded-circle">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Nancy Martino</a></h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                                </div>
                                            </div>
                                            <!-- end member item -->
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <div class="avatar-title bg-soft-danger text-danger rounded-circle">
                                                        HB
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Henry Baird</a></h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                                </div>
                                            </div>
                                            <!-- end member item -->
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="img-fluid rounded-circle">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Frank Hook</a></h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                                </div>
                                            </div>
                                            <!-- end member item -->
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="img-fluid rounded-circle">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Jennifer Carter</a></h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                                </div>
                                            </div>
                                            <!-- end member item -->
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <div class="avatar-title bg-soft-success text-success rounded-circle">
                                                        AC
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Alexis Clarke</a></h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                                </div>
                                            </div>
                                            <!-- end member item -->
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="assets/images/users/avatar-7.jpg" alt="" class="img-fluid rounded-circle">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Joseph Parker</a></h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                                </div>
                                            </div>
                                            <!-- end member item -->
                                        </div>
                                        <!-- end list -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light w-xs" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success w-xs">Assigned</button>
                                </div>
                            </div>
                            <!-- end modal-content -->
                        </div>
                        <!-- modal-dialog -->
                    </div>
                    <!-- end modal -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <!-- Modal -->
            <div class="modal fade" id="updateMembersModal" tabindex="-1" aria-labelledby="updateMembersModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header p-3 ps-4 bg-soft-success">
                            <h5 class="modal-title" id="updateMembersModalLabel">Employees</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="search-box mb-3">
                                <input type="text" class="form-control bg-light border-light" placeholder="Search here..." id="EmployeeSearch">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                            <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                                <div class="vstack gap-3" id="EmployeeListToAdd">


                                </div>
                                <!-- end list -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light w-xs" data-bs-dismiss="modal">Cancel</button>
                            <!-- <button type="button" class="btn btn-success w-xs" onclick="showSelectedEmp()">Save</button> -->
                        </div>
                    </div>
                    <!-- end modal-content -->
                </div>
                <!-- modal-dialog -->
            </div>
            <!-- end modal -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Task Tracker.
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


    <script>
        //your js starts here
        GetSubTaskData()
        var assigneeReporterArray = [];

        function GetSubTaskData() {
            $.ajax({
                url: './php/GetSubTaskData.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    subid: '<?php echo $_GET['subid']; ?>',
                },
                success: function(data) {
                    $.each(data, function(ind, it) {

                        $('#SubtaskTitle').html(it.subtaskname);
                        $('#SubtaskDescription').html(it.subtaskDescription);
                        $('#SubtasksProjectName').html(it.ProjectName);
                        $('#stageDropdown').val(it.status);
                        localStorage.setItem('CurrentStageID', it.status)
                        localStorage.setItem('CurrentStageName', $('#stageDropdown').find('option:selected').text())

                        $('#subtaskPriority').html(it.Sub_Priority);

                        $('#CreatedByName').html(it.CreaterName);
                        $('#created_By_ID').html(it.Created_By);

                        $('#AssigneePhoto').attr('src', it.ProfileImageOfAssignee == null ? 'assets/images/users/avatar-blank.jpg' : it.ProfileImageOfAssignee);
                        $('#AssigneeNm').html(it.AssigneeName)
                        $('#AssigneeNm').attr('href', `pages-profile.php?id=${btoa(it.AssigneeID)}`)
                        $('#AssigneeDesignation').html(it.AssigneeDesignation)
                        assigneeReporterArray.push({
                            value: 'assignee',
                            key: it.AssigneeID
                        });

                        $('#ReporterPhoto').attr('src', it.ProfileImageOfReporter == null ? 'assets/images/users/avatar-blank.jpg' : it.ProfileImageOfReporter);
                        $('#ReporterNm').html(it.ReporterName)
                        $('#ReporterNm').attr('href', `pages-profile.php?id=${btoa(it.ReporterID)}`)
                        $('#ReporterDesignation').html(it.ReporterDesignation)
                        assigneeReporterArray.push({
                            key: it.ReporterID,
                            value: 'reporter'
                        });

                        $('#CreatedDate').html(moment(it.Created_Date).format('D MMM, YYYY hh:mm A'));
                        $('#DueDate').html(moment(it.subtaskDue).format('D MMM, YYYY hh:mm A'));
                    })
                }
            })
        }
        ShowEmployeeList()

        function ShowEmployeeList() {
            $.ajax({
                url: './php/GetAllEmployees.php',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#EmployeeListToAdd').html('');

                    $.each(data, function(index, item) {
                        var foundItem = assigneeReporterArray.find(obj => obj.key === item.ID);
                        if (foundItem) {
                            if (foundItem.value === 'assignee') {
                                var showingword = `<div class='text-danger'>Current Assignee</div>`;
                            } else if (foundItem.value === 'reporter') {
                                var showingword = `<div class='text-danger'>Current Reporter</div>`;
                            }
                        } else {
                            var showingword = `<button type="button" onclick="UpdateAssignee('${item.ID}', '${item.EmpName}')" class="btn btn-light btn-sm">Assign</button>`;

                        }
                        var employeeString = ` <div class="d-flex align-items-center EmpRowDiv">
                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                        <img src="${item.ProfilePhoto==null ? 'assets/images/users/avatar-blank.jpg' : item.ProfilePhoto}" alt="" class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 d-flex"><a href="#" class="text-body d-block fw-bold">${item.EmpName}</a> &nbsp;<span style="font-style:italic;">(${item.Position})</span></h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        ${showingword}
                                                    </div>
                                                </div>`;
                        $('#EmployeeListToAdd').append(employeeString);
                    })
                }
            })
        }

        function UpdateAssignee(id, newlyAssigneName) {
            Swal.fire({
                icon: "question",
                title: "Are you sure?",
                text: 'Would you like to update the assignee?',
                confirmButtonText: 'Yes',
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                showDenyButton: true,
                denyButtonText: `No`,
                denyButtonClass: "btn btn-danger w-xs mt-2",
                buttonsStyling: !1,
                focusConfirm: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: './php/UpdateEmployeeOnSubtask.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            subtaskID: '<?php echo $_GET['subid']; ?>',
                            empID: id
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Updated !',
                                    'Assignee has been updated Successfully !.',
                                    'success'
                                );
                                $('#updateMembersModal').modal('hide')
                                assigneeReporterArray.length = 0;
                                SendMailToNewAssignee(id, newlyAssigneName);
                                GetSubTaskData()
                                ShowEmployeeList()
                            }
                        }
                    })
                }
            })
        }

        function SendMailToNewAssignee(id, newlyAssigneName) {
            var subtaskName = $("#SubtaskTitle").html();
            var subtaskduedate = $("#DueDate").html();
            var assigneeName = newlyAssigneName;
            var assigneeID = id;
            var reporterName = $('#ReporterNm').text();

            $.get("./Email/email_subtaskadd.html", function(htmlCode) {
                htmlCode = htmlCode.replace("[Task Name]", subtaskName)
                    .replace("[Task Due]", subtaskduedate)
                    .replace("[Employee Name]", assigneeName)
                    .replace("[Report Person Name]", reporterName)
                    .replace("[Name of Report Person/Team Leader]", reporterName)
                    .replace("[Admin Name]", '<?php echo $Uname; ?>')
                    .replace("[Redirect_Link]", "http://134.209.156.101/Task_Manager/default/sub-tasks-details.php");
                var EmailBody = htmlCode;

                $.ajax({
                    url: "./Email/SendMail.php",
                    method: 'POST',
                    type: 'JSON',
                    data: {
                        email: 'abc@20gmail.com',
                        subject: 'An Existing task has been re-assigned to you !',
                        body: EmailBody,
                        assigneeID: assigneeID
                    },
                    success: function(result) {
                        // mail sent

                        // $.get("./Email/email_reporter_mail.html", function(htmlCode) {
                        //     htmlCode = htmlCode.replace("[Task Name]", subtaskName)
                        //         .replace("[Task Due]", subtaskduedate)
                        //         .replace("[Employee Name]", reporterName)
                        //         .replace("[assigned person Name]", assigneeName)
                        //         .replace("[Assigned Person Name]", assigneeName)
                        //         .replace("[Admin Name]", '<?php //echo $Uname; 
                                                                ?>')
                        //         .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/pages-login.html");
                        //     var EmailBody = htmlCode;
                        //     $.ajax({
                        //         url: "./Email/SendMail.php",
                        //         method: 'POST',
                        //         type: 'JSON',
                        //         data: {
                        //             email: 'abc@20gmail.com',
                        //             subject: 'You have been assigned as a reporter !',
                        //             body: EmailBody,
                        //             assigneeID: reporterID
                        //         },
                        //         success: function(result) {
                        //             $.get("./Email/email_admin_subtaskadded.html", function(htmlCode) {
                        //                 htmlCode = htmlCode
                        //                     .replace("[Admin Name]", '<?php //echo $Uname; 
                                                                            ?>')
                        //                     .replace("[reporter name]", reporterName)
                        //                     .replace("[Reporter Person Name]", reporterName)
                        //                     .replace("[Task Name]", subtaskName)
                        //                     .replace("[Task Due]", subtaskduedate)
                        //                     .replace("[assign person name]", assigneeName)
                        //                     .replace("[Assigned Person Name]", assigneeName)
                        //                     .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/pages-login.html");
                        //                 var EmailBody = htmlCode;
                        //                 $.ajax({
                        //                     url: "./Email/SendMail.php",
                        //                     method: 'POST',
                        //                     type: 'JSON',
                        //                     data: {
                        //                         email: 'abc@20gmail.com',
                        //                         subject: 'New subtask is created !',
                        //                         body: EmailBody,
                        //                         assigneeID: '<?php //echo $Admin_id; 
                                                                ?>'
                        //                     },
                        //                     success: function(result) {
                        //                         // mail sent
                        //                     }
                        //                 })
                        //             })
                        //         }
                        //     })
                        // })
                    }
                })
            })
        }
    </script>

    <script>
        //commenting section
        ShowAllComments()

        function ShowAllComments() {
            $.ajax({
                url: './php/GetAllMainCommentsData.php',
                type: 'POST',
                dataType: 'json',
                async: false,
                data: {
                    subid: '<?php echo $_GET['subid']; ?>',
                },
                success: function(data) {
                    $('#CommentMsgBox').empty();
                    $.each(data, function(index, it) {
                        if (data.length != 0) {
                            var commentHtml = `<div class="d-flex mb-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="${it.main_comment_author_profile_photo == null ? 'assets/images/users/avatar-blank.jpg' : it.main_comment_author_profile_photo}" alt="" class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-13"><a href="pages-profile.html" class="CommenterName">${it.main_comment_author_name}</a> <small class="text-muted">${GetTimeNow(it.main_comment_datetime)}</small></h5>
                                                        <p class="text-muted">${it.main_comment_text}</p>
                                                        <div class="attachedWithComment">`;

                            if (it.FilePath != null && it.FilePath != '') {
                                var pathArr = it.FilePath.split('--');
                                commentHtml += `<div class="row g-2 mb-3">`;
                                pathArr.forEach(function(filePath) {
                                    if (filePath.split('.').pop().toLowerCase() == 'jpg' || filePath.split('.').pop().toLowerCase() == 'jpeg') {
                                        commentHtml += `<div class="col-lg-1 col-sm-2 col-6">
                                                        <a href="${filePath}" target="_blank">
                                                            <img src="${filePath}" alt="" class="img-fluid rounded" style="cursor: pointer;">
                                                        </a>
                                                    </div>
                                                    `;
                                    } else {
                                        var pathParts = filePath.split('/');
                                        var fileName = pathParts.pop();
                                        if (fileName != '') {

                                            commentHtml += `<div class="col-lg-2 col-sm-2 col-12 text-center">
                                                            <div class="container bg-light d-flex flex-row justify-content-between align-items-center rounded">
                                                                <span class="fs-14"><a href="${filePath}" target="blank" class="text-body">${fileName}</a></span>
                                                                <i class="ri-download-2-line fs-14" style="cursor:pointer;" onclick="window.location.href ='assets/php/download.php?=FPath=${filePath}&FName=${fileName}'"></i>
                                                            </div>
                                                        </div>`;
                                        }

                                    }
                                });
                                commentHtml += ` </div>`;
                            }
                            commentHtml += `
                                                </div>
                                                <a href="javascript: void(0);" class="badge text-muted bg-light" onclick="ReplyToComment('${it.main_comment_author_name}', '${it.main_comment_id}')"><i class="mdi mdi-reply"></i> Reply</a>
                                                <div class=" mt-4" id="RepliedCommentMsg${it.main_comment_id}">`;

                            $.ajax({
                                url: './php/GetAllReplyCommentsData.php',
                                type: 'POST',
                                dataType: 'json',
                                async: false,
                                data: {
                                    commentID: it.main_comment_id,
                                },
                                success: function(dataResult) {
                                    if (dataResult.length != 0) {
                                        $.each(dataResult, function(ind, itm) {
                                            commentHtml += `<div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="${itm.reply_comment_author_profile_photo == null ? 'assets/images/users/avatar-blank.jpg' : itm.reply_comment_author_profile_photo}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13"><a href="pages-profile.html">${itm.reply_comment_author_name}</a> <small class="text-muted">${GetTimeNow(itm.reply_comment_datetime)}</small></h5>
                                                    <p class="text-muted">${itm.reply_comment_text}</p>
                                                </div>
                                            </div>`;
                                        })
                                    }

                                    commentHtml += `</div>
                                                </div>
                                            </div>`;
                                    $('#CommentMsgBox').append(commentHtml);

                                }
                            })
                        }
                    })
                }
            })
        }

        function SendMailOnComment() {
            $.get("./Email/email_comment_added.html", function(htmlCode) {
                htmlCode = htmlCode.replace("[Admin Name]", $('#CreatedByName').html())
                    .replace("[SubTask Name]", $('#SubtaskTitle').html())
                    .replace("[Name of commenter]", '<?php echo $Uname; ?>')
                    .replace("[Date]", moment().format('D MMM, YYYY hh:mm A'))
                    .replace("[Redirect_Link]", "http://localhost/07%20March/Task-Manager/pages-login.html");

                var EmailBody = htmlCode;
                $.ajax({
                    url: "./Email/SendMail.php",
                    method: 'POST',
                    data: {
                        email: 'abc@gmail.com',
                        subject: 'Someone has commented',
                        body: EmailBody,
                        SelectedEmps: JSON.stringify([$('#created_By_ID').html()])
                    },
                    success: function(result) {
                        console.log("mail sent");
                    }
                });
            });
        }

        // function SendMailOnReplyComment() {
        //     $.get("assets/Email/email_comment_added.html", function(htmlCode) {
        //         htmlCode = htmlCode.replace("[Admin Name]", $('#CreatedByName').html())
        //             .replace("[SubTask Name]", $('#SubtaskTitle').html())
        //             .replace("[Name of commenter]", '<?php //echo $Uname; 
                                                        ?>')
        //             .replace("[Date]", moment().format('D MMM, YYYY hh:mm A'))
        //             .replace("[Redirect_Link]", "http://localhost/07%20March/Task-Manager/pages-login.html");

        //         var EmailBody = htmlCode;
        //         $.ajax({
        //             url: "assets/Email/SendMail.php",
        //             method: 'POST',
        //             data: {
        //                 email: 'abc@gmail.com',
        //                 subject: 'Someone has commented',
        //                 body: EmailBody,
        //                 SelectedEmps: JSON.stringify([$('#created_By_ID').html()])
        //             },
        //             success: function(result) {
        //                 console.log("mail sent");
        //             }
        //         });
        //     });
        // }
        var fileJsonData = [];

        $('#CommentPostBtn').on('click', function() {
            var formData = new FormData();

            // Append the files to the FormData
            for (var i = 0; i < fileJsonData.length; i++) {
                formData.append('files[]', fileJsonData[i]);
            }

            // Append other form data
            formData.append('subid', '<?php echo $_GET['subid']; ?>');
            formData.append('comment_msg', $('#CommentTextarea').val());
            formData.append('commenter_id', '<?php echo $Admin_id; ?>');

            event.preventDefault();
            if ($('#CommentTextarea').val() == '') {
                return false
            } else {
                //save comment to db
                if ($('#ReplingCommenter').hasClass('d-none')) {
                    $.ajax({
                        url: './php/comment.php',
                        type: 'POST',
                        processData: false, // Prevent jQuery from processing the data
                        contentType: false, // Prevent jQuery from setting content type
                        data: formData,
                        dataType: 'json',
                        success: function(LastComment) {
                            if (LastComment.success) {
                                SendMailOnComment()
                            }
                            ShowAllComments()
                            var commentsContainer = $('.ScrollBarCss');
                            var scrollHeight = commentsContainer.prop('scrollHeight');
                            commentsContainer.animate({
                                scrollTop: scrollHeight
                            }, 'slow');
                            fileJsonData.splice(0, fileJsonData.length);
                            $('#attachedFiles').empty();

                        }
                    })
                    $('#CommentTextarea').val('')
                }
            }
        })

        function ReplyToComment(replingTo, MainCommentID) {
            localStorage.setItem('MainCommentID', MainCommentID)
            // find('.CommenterName').html();
            $('#ReplingCommenter').html('Replying To: @' + replingTo);
            $('#ReplingCommenter').removeClass('d-none');
            $('#CommentTextarea').focus();

            $('#CommentPostBtn').removeAttr('id').attr('id', 'ReplyCommentTextarea')

            $('#ReplyCommentTextarea').on('click', function() {

                event.preventDefault();
                if ($('#CommentTextarea').val() == '') {
                    return false;
                } else {
                    if (!$('#ReplingCommenter').hasClass('d-none')) {
                        $.ajax({
                            url: './php/RepliedComment.php',
                            type: 'POST',
                            dataType: 'json',
                            async: false,
                            data: {
                                comments_id: localStorage.getItem('MainCommentID'),
                                subid: '<?php echo $_GET['subid']; ?>',
                                reply_comment_msg: $('#CommentTextarea').val(),
                                reply_commenter_id: '<?php echo $Admin_id; ?>',
                            },
                            success: function(replyCmtSaved) {
                                // if (replyCmtSaved.success) {
                                //     SendMailOnReplyComment()
                                // }
                                ShowAllComments()
                                var commentsContainer = $('.ScrollBarCss');
                                var scrollHeight = commentsContainer.prop('scrollHeight');
                                commentsContainer.animate({
                                    scrollTop: scrollHeight
                                }, 'slow');
                                $('#CommentTextarea').val('')
                                $('#ReplingCommenter').html('');
                                $('#ReplingCommenter').addClass('d-none');
                                $('#ReplyCommentTextarea').removeAttr('id').attr('id', 'CommentPostBtn')
                            }
                        })

                    }
                }
            })
        }

        // function OpenAttachment() {
        //     $('#commentFileInput').click();
        // }
        var FileTypeArray = {
            'zip': '<i class="ri-folder-zip-line"></i>',
            'pdf': '<i class="ri-file-pdf-fill"></i>',
            'mp4': ' <i class="ri-video-line"></i>',
            'xlsx': ' <i class="ri-file-excel-fill"></i>',
            'docx': ' <i class="ri-folder-fill"></i>',
            'jpg': ' <i class="ri-image-2-fill"></i>',
        }

        function OpenAttachment() {
            $('#commentFileInput').change(function() {
                // Get the selected file information
                const fileInput = document.getElementById('commentFileInput');
                const file = fileInput.files[0];
                const fileName = file.name;
                const fileExtension = fileName.split('.').pop().toLowerCase();
                fileJsonData.push(file);
                var index = fileJsonData.length;
                if (fileExtension in FileTypeArray) {
                    var fileTypeIcon = FileTypeArray[fileExtension];
                } else {
                    var fileTypeIcon = '<i class="ri-file-line"></i>';
                }

                var fileAttachedString = `<div class="border rounded border-dashed p-2 mt-2 mb-2 thisAttachedFile">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                                ${fileTypeIcon}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">${fileName}</a></h5>
                                                        <!-- <div>2.2MB</div> -->
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="d-flex gap-1">
                                                            <button type="button" class="btn btn-icon text-muted btn-sm fs-18 removeFileBtn" id="${index}"><i class="ri-delete-bin-2-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`;

                // Append the modified file template to the specified div
                $('#attachedFiles').append(fileAttachedString);

                fileInput.value = '';
            });

            // Trigger the file input
            $('#commentFileInput').click();
        }
        $(document).on('click', '.removeFileBtn', function() {
            // Find the parent div with class 'thisAttachedFile' and remove it
            var index = $(this).attr('id');
            fileJsonData.splice(index)
            $(this).closest('.thisAttachedFile').remove();
        });
    </script>
    <script>
        $('#stageDropdown').on('change', function() {

            var CurrStageID = localStorage.getItem('CurrentStageID');
            var CurrStageTitle = localStorage.getItem('CurrentStageName');

            var SelectedStageID = $(this).val();
            var selectedStageTitle = $(this).text();

            if (CurrStageID == $(this).val()) {
                return;
            }

            Swal.fire({
                icon: "question",
                title: "Are you sure?",
                html: `Change stage <b>${CurrStageTitle}</b> to <b>${selectedStageTitle}</b> ?`,
                confirmButtonText: 'Yes',
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                showDenyButton: true,
                denyButtonText: `No`,
                denyButtonClass: "btn btn-danger w-xs mt-2",
                buttonsStyling: !1,
                focusConfirm: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: './php/markasSpecified.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            subtask_ID: '<?php echo $_GET['subid']; ?>',
                            NextStageID: SelectedStageID,
                            NextStageNM: selectedStageTitle,
                            currentStageNM: CurrStageTitle
                        },
                        success: function(response) {
                            // console.log(response);
                            if (response.success) {

                                $.get("./Email/email_stage_changed.html", function(htmlCode) {
                                    htmlCode = htmlCode.replace("[Last Stage]", CurrStageTitle)
                                        .replace("[Next-Stage]", selectedStageTitle)
                                        .replace("[Admin Name]", $("#CreatedByName").html())
                                        .replace("[Task Name]", $('#SubtaskTitle').html())
                                        .replace("[Last Stage]", CurrStageTitle)
                                        .replace("[Next Stage]", selectedStageTitle)
                                        .replace("[User-Name]", '<?php echo $Uname; ?>')
                                        .replace("[Date]", moment().format('D MMM, YYYY hh:mm A'))
                                        .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/pages-login.html");

                                    var EmailBody = htmlCode;
                                    $.ajax({
                                        url: "./Email/SendMail.php",
                                        method: 'POST',
                                        data: {
                                            email: 'abc@gmail.com',
                                            subject: 'Stage changed !',
                                            body: EmailBody,
                                            SelectedEmps: JSON.stringify([$('#created_By_ID').html()])

                                        },
                                        success: function(results) {
                                            //mail sent
                                        }
                                    })
                                })
                                Swal.fire(
                                    'Changed !',
                                    'Stage Changed Successfully !.',
                                    'success'
                                );
                                GetSubTaskData()

                            } else {
                                console.log('There was a problem updating the stage.');
                                Swal.fire(
                                    'Error!',
                                    'There was a problem updating the stage.',
                                    'error'
                                );
                            }
                        }
                    });

                } else if (result.isDenied) {
                    event.preventDefault();
                }
            });
        })
    </script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>