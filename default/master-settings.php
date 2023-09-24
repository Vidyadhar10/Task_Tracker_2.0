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
    <title>Master Settings | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">

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
    <!-- custom css  -->
    <link rel="stylesheet" href="./assets/css/style.css">
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
                                <h4 class="mb-sm-0">Reports</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                        <li class="breadcrumb-item active">Project Reports</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">


                        <div class="col-xl-3 col-lg-4">
                            <div class="card">
                                <div class="mb-3">
                                    <h5 class="card-header">
                                        <div class="card-title">Settings</div>
                                    </h5>
                                </div>
                                <div class="px-4 mx-n4" data-simplebar>
                                    <ul class="to-do-menu list-unstyled nav-link" id="projectlist-data" role="tablist">
                                        <li>
                                            <a data-bs-toggle="collapse" href="#Projects" class="nav-link fs-13">Projects</a>
                                            <div class="collapse show" id="Projects">
                                                <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                                    <li class="nav-item" role="presentation">
                                                        <a href="#Project-tab" class="text-primary active" data-bs-toggle="pill" data-bs-target="#Project-tab" role="tab" aria-controls="Project-tab" aria-selected="true">
                                                            <i class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                            Priority
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="collapse" href="#tasks-settings" id="task-tab-anchor" class="nav-link fs-13">Tasks</a>
                                            <div class="collapse" id="tasks-settings">
                                                <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                                    <li class="nav-item" role="presentation">
                                                        <a href="#task-tab" class="text-primary" data-bs-toggle="pill" data-bs-target="#task-tab" role="tab" aria-controls="task-tab" aria-selected="false">
                                                            <i class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                            Priority
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="collapse" href="#subtask-settings" class="nav-link fs-13">Sub-Tasks</a>
                                            <div class="collapse" id="subtask-settings">
                                                <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                                    <li class="nav-item" role="presentation">
                                                        <a href="#subtask-priority-tab" id="subtask-priority-tab-anchor" class="text-primary" data-bs-toggle="pill" data-bs-target="#subtask-priority-tab" role="tab" aria-controls="subtask-priority-tab" aria-selected="false">
                                                            <i class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                            Priority
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#subtask-category-tab" class="text-primary" id="subtask-category-tab-anchor" data-bs-toggle="pill" data-bs-target="#subtask-category-tab" role="tab" aria-controls="subtask-category-tab" aria-selected="false">
                                                            <i class="ri-stop-mini-fill align-middle fs-15 text-info"></i>
                                                            Category
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#subtask-stage-tab" class="text-primary" id="subtask-stage-tab-anchor" data-bs-toggle="pill" data-bs-target="#subtask-stage-tab" role="tab" aria-controls="subtask-stage-tab" aria-selected="false">
                                                            <i class="ri-stop-mini-fill align-middle fs-15 text-success"></i>
                                                            Stages
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="collapse" href="#leave-settings" class="nav-link fs-13">Leave</a>
                                            <div class="collapse" id="leave-settings">
                                                <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                                    <li>
                                                        <a href="#leave-category-tab" id="leave-category-tab-anchor" class="text-primary" data-bs-toggle="pill" data-bs-target="#leave-category-tab" role="tab" aria-controls="leave-category-pill" aria-selected="false">
                                                            <i class="ri-stop-mini-fill align-middle fs-15 text-info"></i>
                                                            Category
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-xl-9 col-lg-8">
                            <div class="card">
                                <div class="tab-content m-2">
                                    <div class="tab-pane fade show active" id="Project-tab" role="tabpanel" aria-labelledby="Project-tab-pill">
                                        <!-- Your content for the Project tab goes here -->
                                        <div>
                                            <h5 class="mb-4">Add Project Priority</h5>
                                            <!-- <p class="text-muted mb-4">Please fill all information below</p> -->
                                        </div>

                                        <div>
                                            <div class="row border-bottom">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Priority Title</label>
                                                        <input class="form-control" placeholder="Enter tags" type="text" value="" id="proj-pri-input" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-sm btn-primary align-middle" onclick="AddBadge('proj-pri-input')">
                                                            <i class="ri-add-line align-middle fs-16"></i>
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="mb-3" id="show-project-priorities">

                                                </div>
                                            </div>

                                            <!-- <div class="d-flex align-items-start gap-3 mt-3">
                                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="task-tab-pill">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go To Task Master
                                                </button>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane fade" id="task-tab" role="tabpanel" aria-labelledby="task-tab-pill">
                                        <div>
                                            <h5 class="mb-4">Add Task Priority</h5>
                                            <!-- <p class="text-muted mb-4">Please fill all information below</p> -->
                                        </div>

                                        <div>
                                            <div class="row border-bottom">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Priority Title</label>
                                                        <input class="form-control" placeholder="Enter priorities" type="text" value="" id="task-pri-input" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-sm btn-primary align-middle" onclick="AddBadge('task-pri-input')">
                                                            <i class="ri-add-line align-middle fs-16"></i>
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="mb-3" id="show-tasks-priorities">

                                                </div>
                                            </div>

                                            <!-- <div class="d-flex align-items-start gap-3 mt-3">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="Project-tab-pill"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                                    to Project Master</button>
                                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="subtask-priority-pill">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go To SubTask Master
                                                </button>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <!-- subtask tab panels -->
                                    <!-- 1. priority -->
                                    <div class="tab-pane fade" id="subtask-priority-tab" role="tabpanel" aria-labelledby="subtask-priority-pill">
                                        <div>
                                            <h5 class="mb-4">Add Subtask Priority</h5>
                                            <!-- <p class="text-muted mb-4">Please fill all information below</p> -->
                                        </div>

                                        <div>
                                            <div class="row border-bottom">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Priority Title</label>

                                                        <input class="form-control" placeholder="Enter Priority" type="text" id="subtask-pri-input" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-sm btn-primary align-middle" onclick="AddBadge('subtask-pri-input')">
                                                            <i class="ri-add-line align-middle fs-16"></i>
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="mb-3" id="show-sub-tasks-priorities">

                                                </div>
                                            </div>
                                            <!-- <div class="d-flex align-items-start gap-3 mt-3">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="task-tab-pill"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                                    to Task Priority</button>
                                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="subtask-category-pill">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go To SubTask Category
                                                </button>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- 2. subtask category -->
                                    <div class="tab-pane fade" id="subtask-category-tab" role="tabpanel" aria-labelledby="subtask-category-pill">
                                        <div>
                                            <h5 class="mb-4">Add Subtask Category</h5>
                                            <!-- <p class="text-muted mb-4">Please fill all information below</p> -->
                                        </div>

                                        <div>
                                            <div class="row border-bottom">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Category Title</label>
                                                        <input class="form-control" placeholder="Enter categories" type="text" id="subtask-cat-input" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-sm btn-primary align-middle" onclick="AddBadge('subtask-cat-input')">
                                                            <i class="ri-add-line align-middle fs-16"></i>
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="mb-3" id="show-sub-tasks-categories">

                                                </div>
                                            </div>
                                            <!-- <div class="d-flex align-items-start gap-3 mt-3">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="subtask-priority-pill"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                                    to Subtask Priority</button>
                                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="subtask-stage-pill">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go To SubTask Stage
                                                </button>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- 3. subtsk Stages -->
                                    <div class="tab-pane fade" id="subtask-stage-tab" role="tabpanel" aria-labelledby="subtask-stage-pill">
                                        <div>
                                            <h5 class="mb-4">Add Subtask Stage</h5>
                                            <!-- <p class="text-muted mb-4">Please fill all information below</p> -->
                                        </div>

                                        <div>
                                            <div class="row border-bottom">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Stage Title</label>
                                                        <input class="form-control" placeholder="Enter tags" type="text" id="subtask-stage-input" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-sm btn-primary align-middle" onclick="AddBadge('subtask-stage-input')">
                                                            <i class="ri-add-line align-middle fs-16"></i>
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="mb-3" id="show-sub-tasks-stages">

                                                </div>
                                            </div>
                                            <!-- <div class="d-flex align-items-start gap-3 mt-3">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="subtask-category-pill"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                                    to SubTask Category</button>
                                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="leave-category-pill">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go To Leaves Master
                                                </button>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- Leave master tab  -->
                                    <div class="tab-pane fade" id="leave-category-tab" role="tabpanel" aria-labelledby="leave-category-pill">
                                        <div>
                                            <h5 class="mb-4">Add Leave Category</h5>
                                            <!-- <p class="text-muted mb-4">Please fill all information below</p> -->
                                        </div>

                                        <div>
                                            <div class="row border-bottom">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Category Title</label>
                                                        <input class="form-control" placeholder="Enter tags" type="text" id="leave-cat-input" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-sm btn-primary align-middle" onclick="AddBadge('leave-cat-input')">
                                                            <i class="ri-add-line align-middle fs-16"></i>
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="mb-3" id="show-leaves-categories">

                                                </div>
                                            </div>
                                            <!-- <div class="d-flex align-items-start gap-3 mt-3 d-none">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="subtask-stage-pill">
                                                    <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                                    to SubTask Stage</button>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                            </div>
                        </div>

                    </div>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ajax xlxs downloading cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <script>
        // $(document).ready(function() {
        //     // Click event handler for "Back" buttons
        //     $(".previestab").click(function() {
        //         const previousTabId = $(this).attr("data-previous");
        //         if (previousTabId) {
        //             $(`[aria-labelledby="${previousTabId}"]`).tab("show");
        //         }
        //     });

        //     // Click event handler for "Next" buttons
        //     $(".nexttab").click(function() {
        //         const nextTabId = $(this).attr("data-nexttab");
        //         if (nextTabId) {
        //             $(`[aria-labelledby="${nextTabId}"]`).tab("show");
        //         }
        //     });
        // });
        ShowProjectPriority('./Master/ShowProjPriority.php', 'show-project-priorities');

        function ShowProjectPriority(apiLink, badgeDivID) {
            $(`#${badgeDivID}`).empty();
            $.ajax({
                url: `./php/${apiLink}`,
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(index, item) {
                        if (item.ProjectPriority) {
                            var badgeString = `<div class="badge bg-primary fs-14 mt-2" style="margin-right: 5px;">
                                                    ${item.ProjectPriority} <i class="ri-close-fill fs-16 align-middle" onclick="RemoveBadge('${item.ID}','proj_pri')" style="cursor: pointer;"></i>
                                                </div>`;
                        }
                        if (item.Tasks_Priority) {
                            var badgeString = `<div class="badge bg-primary fs-14 mt-2" style="margin-right: 5px;">
                                                    ${item.Tasks_Priority} <i class="ri-close-fill fs-16 align-middle" onclick="RemoveBadge('${item.ID}','task_pri')" style="cursor: pointer;"></i>
                                                </div>`;
                        }
                        if (item.Sub_Priority) {
                            var badgeString = `<div class="badge bg-primary fs-14 mt-2" style="margin-right: 5px;">
                                                    ${item.Sub_Priority} <i class="ri-close-fill fs-16 align-middle" onclick="RemoveBadge('${item.ID}','subtask_pri')" style="cursor: pointer;"></i>
                                                </div>`;
                        }
                        if (item.Sub_Category) {
                            var badgeString = `<div class="badge bg-primary fs-14 mt-2" style="margin-right: 5px;">
                                                    ${item.Sub_Category} <i class="ri-close-fill fs-16 align-middle" onclick="RemoveBadge('${item.ID}','subtask_cat')" style="cursor: pointer;"></i>
                                                </div>`;
                        }
                        if (item.stages) {
                            var badgeString = `<div class="badge bg-primary fs-14 mt-2" style="margin-right: 5px;">
                                                    ${item.stages} <i class="ri-close-fill fs-16 align-middle" onclick="RemoveBadge('${item.id}','subtask_stage')" style="cursor: pointer;"></i>
                                                </div>`;
                        }
                        if (item.leave_category) {
                            var badgeString = `<div class="badge bg-primary fs-14 mt-2" style="margin-right: 5px;">
                                                    ${item.leave_category} <i class="ri-close-fill fs-16 align-middle" onclick="RemoveBadge('${item.ID}','leave_cat')" style="cursor: pointer;"></i>
                                                </div>`;
                        }
                        $(`#${badgeDivID}`).append(badgeString);

                    })
                }
            })

        }
        $('#task-tab-anchor').on('click', function() {
            ShowProjectPriority('./Master/ShowTaskPriority.php', 'show-tasks-priorities');

        })

        $('#subtask-priority-tab-anchor').on('click', function() {
            ShowProjectPriority('./Master/ShowSubTaskPriority.php', 'show-sub-tasks-priorities');

        })

        $('#subtask-category-tab-anchor').on('click', function() {
            ShowProjectPriority('./Master/ShowSubTaskCategories.php', 'show-sub-tasks-categories');

        })

        $('#subtask-stage-tab-anchor').on('click', function() {
            ShowProjectPriority('./Master/ShowSubTaskStage.php', 'show-sub-tasks-stages');

        })

        $('#leave-category-tab-anchor').on('click', function() {
            ShowProjectPriority('./Master/Showleave.php', 'show-leaves-categories');
        })

        function RemoveBadge(id, type) {
            if (type == 'task_pri') {
                var ajData = {
                    TaskPriInputID: id,
                    taskPriority: true
                }
            } else if (type == 'subtask_pri') {
                var ajData = {
                    SubTaskPriInputID: id,
                    SubtaskPriority: true
                }
            } else if (type == 'subtask_cat') {
                var ajData = {
                    SubTaskCategoryInputID: id,
                    SubtaskCategory: true
                }

            } else if (type == 'subtask_stage') {
                var ajData = {
                    SubTaskStageInputID: id,
                    SubtaskStage: true
                }
            }

            if (ajData) {
                $.ajax({
                    url: './php/Master/CheckAlreadyIsUsedOrNot.php',
                    type: 'POST',
                    dataType: 'json',
                    data: ajData,
                    success: function(result) {
                        if (result.success) {
                            Swal.fire({
                                title: 'Alert ?',
                                html: 'Selected badge is used before !<br>This badge can\'t deleted.',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                                buttonsStyling: !1,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            ajData = undefined;
                        } else {
                            RemoveBadgeSwalnAjax(id, type)
                        }
                    }
                })
            } else {
                RemoveBadgeSwalnAjax(id, type)
            }


        }

        function RemoveBadgeSwalnAjax(id, type) {
            Swal.fire({
                title: 'Are you sure, remove this?',
                icon: 'question',
                showDenyButton: true,
                denyButtonText: `No`,
                denyButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: 'Yes',
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                buttonsStyling: !1,
                focusConfirm: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                focusConfirm: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: './php/Master/RemoveBadge.php',
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            badgeID: id,
                            badgeType: type,
                        },
                        success: function(result) {
                            if (result.success) {
                                Swal.fire('Removed', '', 'success');
                                ShowProjectPriority('./Master/ShowProjPriority.php', 'show-project-priorities');
                                ShowProjectPriority('./Master/ShowTaskPriority.php', 'show-tasks-priorities');
                                ShowProjectPriority('./Master/ShowSubTaskPriority.php', 'show-sub-tasks-priorities');
                                ShowProjectPriority('./Master/ShowSubTaskCategories.php', 'show-sub-tasks-categories');
                                ShowProjectPriority('./Master/ShowSubTaskStage.php', 'show-sub-tasks-stages');
                                ShowProjectPriority('./Master/Showleave.php', 'show-leaves-categories');

                            }
                        }
                    });
                }
            })
        }

        function AddBadge(inputBoxID) {
            var inputValue = $(`#${inputBoxID}`).val();
            if (inputValue == '') {
                return false;
            } else {
                if (inputBoxID.includes('proj')) {
                    var inputData = {
                        PriorityEntered: inputValue,
                        PriorityColor: 'bg-info',
                    }
                } else if (inputBoxID.includes('subtask')) {
                    if (inputBoxID.includes('pri')) {
                        var inputData = {
                            SubTaskPriEntered: inputValue,
                            SubtaskPriorityColor: 'bg-primary',
                        }
                    } else if (inputBoxID.includes('cat')) {
                        var inputData = {
                            SubTaskCategoryEntered: inputValue,
                            SubtaskCategoryColor: 'bg-warning',
                        }
                    } else if (inputBoxID.includes('stage')) {
                        var inputData = {
                            SubTaskStageEntered: inputValue,
                            SubtaskStageColor: 'bg-dark',
                        }
                    }
                } else if (inputBoxID.includes('task')) {
                    var inputData = {
                        TaskPriEntered: inputValue,
                        TaskPriorityColor: bg - danger
                    }
                } else if (inputBoxID.includes('leaves')) {
                    var inputData = {
                        leavecateinput: inputValue
                    }
                }

                if (inputData) {
                    Swal.fire({
                        title: 'Would you like to add this badge ?',
                        icon: 'question',
                        showDenyButton: true,
                        denyButtonText: `No`,
                        denyButtonClass: "btn btn-danger w-xs mt-2",
                        confirmButtonText: 'Yes',
                        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                        buttonsStyling: !1,
                        focusConfirm: true,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {


                            $.ajax({
                                url: './php/Master/AddBadge.php',
                                type: 'POST',
                                data: inputData,
                                success: function(result) {
                                    Swal.fire('Added', '', 'success');
                                    ShowProjectPriority('./Master/ShowProjPriority.php', 'show-project-priorities');
                                    ShowProjectPriority('./Master/ShowTaskPriority.php', 'show-tasks-priorities');
                                    ShowProjectPriority('./Master/ShowSubTaskPriority.php', 'show-sub-tasks-priorities');
                                    ShowProjectPriority('./Master/ShowSubTaskCategories.php', 'show-sub-tasks-categories');
                                    ShowProjectPriority('./Master/ShowSubTaskStage.php', 'show-sub-tasks-stages');
                                    ShowProjectPriority('./Master/Showleave.php', 'show-leaves-categories');
                                    $(`#${inputBoxID}`).val('')
                                }
                            });
                        }
                    })
                }

            }

        }
    </script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- nouisliderribute js -->
    <script src="assets/libs/nouislider/nouislider.min.js"></script>
    <script src="assets/libs/wnumb/wNumb.min.js"></script>

    <script src="assets/js/pages/apps-nft-explore.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>