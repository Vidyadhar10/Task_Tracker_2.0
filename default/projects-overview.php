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
    <title>Project Overview | Task Tracker</title>
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mt-n4 mx-n4">
                                <div class="bg-soft-warning">
                                    <div class="card-body pb-0 px-4">
                                        <div class="row mb-3">
                                            <div class="col-md">
                                                <div class="row align-items-center g-3">
                                                    <div class="col-md-auto">
                                                        <div class="avatar-md">
                                                            <div class="avatar-title bg-white rounded-circle">
                                                                <img src="assets/images/brands/slack.png" id="projectLogoImage" alt="" class="avatar-xs">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div>
                                                            <h4 class="fw-bold" id="project-title"></h4>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <!-- <div><i class="ri-building-line align-bottom me-1"></i> Themesbrand</div>
                                                                <div class="vr"></div> -->
                                                                <div>Create Date : <span class="fw-medium" id="project-createddate">15 Sep, 2021</span></div>
                                                                <div class="vr"></div>
                                                                <div>Start Date : <span class="fw-medium project-startdate">15 Sep, 2021</span></div>
                                                                <div class="vr"></div>
                                                                <div>End Date : <span class="fw-medium project-enddate">29 Dec, 2021</span></div>
                                                                <div class="vr"></div>
                                                                <!-- <div class="badge rounded-pill bg-info fs-12">New</div> -->
                                                                <div class="badge rounded-pill bg-danger fs-12 project-priority">High</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview" role="tab">
                                                    Overview
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-documents" role="tab">
                                                    Documents
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-tasks" role="tab">
                                                    Tasks
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-employee-performance" id="performance-tab-link" role="tab">
                                                    Performance
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-roadmap" role="tab">
                                                    Roadmap
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content text-muted">
                                <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-9 col-lg-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-muted">
                                                        <h6 class="mb-3 fw-semibold text-uppercase">Description</h6>
                                                        <div id="descriptionDetails">

                                                        </div>


                                                        <!-- <div>
                                                            <button type="button" class="btn btn-link link-success p-0">Read more</button>
                                                        </div> -->
                                                        <div class="pt-3 border-top border-top-dashed mt-4">
                                                            <h6 class="mb-3 fw-semibold text-uppercase">Mission</h6>
                                                            <div id="missionDetails">

                                                            </div>
                                                        </div>

                                                        <div class="pt-3 border-top border-top-dashed mt-4">
                                                            <div class="row">

                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div>
                                                                        <p class="mb-2 text-uppercase fw-medium">Start Date :</p>
                                                                        <h5 class="fs-15 mb-0 project-startdate"></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div>
                                                                        <p class="mb-2 text-uppercase fw-medium">End Date :</p>
                                                                        <h5 class="fs-15 mb-0 project-enddate"></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div>
                                                                        <p class="mb-2 text-uppercase fw-medium">Priority :</p>
                                                                        <div class="badge bg-danger fs-12 project-priority"></div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>

                                        </div>
                                        <!-- ene col -->
                                        <div class="col-xl-3 col-lg-4">
                                            <!-- <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-4">Skills</h5>
                                                    <div class="d-flex flex-wrap gap-2 fs-16">
                                                        <div class="badge fw-medium badge-soft-secondary">UI/UX</div>
                                                        <div class="badge fw-medium badge-soft-secondary">Figma</div>
                                                        <div class="badge fw-medium badge-soft-secondary">HTML</div>
                                                        <div class="badge fw-medium badge-soft-secondary">CSS</div>
                                                        <div class="badge fw-medium badge-soft-secondary">Javascript</div>
                                                        <div class="badge fw-medium badge-soft-secondary">C#</div>
                                                        <div class="badge fw-medium badge-soft-secondary">Nodejs</div>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="card">
                                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                                    <h4 class="card-title mb-0 flex-grow-1">Members</h4>
                                                    <div class="flex-shrink-0">
                                                        <button type="button" class="btn btn-soft-danger btn-sm" data-bs-toggle="modal" data-bs-target="#inviteMembersModal"><i class="ri-share-line me-1 align-bottom"></i> Add Employee</button>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div data-simplebar style="min-height: 50px;" class="mx-n3 px-3">
                                                        <div class="vstack gap-3" id="membersDiv">


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- end card -->

                                            <div class="card">
                                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                                    <h4 class="card-title mb-0 flex-grow-1">Attachments</h4>
                                                    <!-- <div class="flex-shrink-0">
                                                        <button type="button" class="btn btn-soft-info btn-sm"><i class="ri-upload-2-fill me-1 align-bottom"></i> Upload</button>
                                                    </div> -->
                                                </div>

                                                <div class="card-body">
                                                    <div class="vstack gap-2" id="attachedFilesShown">




                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end tab pane -->
                                <div class="tab-pane fade" id="project-documents" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-4">
                                                <h5 class="card-title flex-grow-1">Documents</h5>
                                            </div>



                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive table-card">
                                                        <table class="table table-borderless align-middle mb-0">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col">File Name</th>
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Upload Date</th>
                                                                    <th scope="col" style="width: 120px;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="AllFileTableBody">


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- <div class="text-center mt-3">
                                                        <a href="javascript:void(0);" class="text-success "><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load more </a>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end tab pane -->
                                <div class="tab-pane fade" id="project-tasks" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-4">
                                                <h5 class="card-title flex-grow-1">Tasks</h5>
                                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive table-card">
                                                        <table class="table table-borderless align-middle mb-0">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col">Task Name</th>
                                                                    <th scope="col">Priority</th>
                                                                    <th scope="col">Due Date</th>
                                                                    <th scope="col">Created By</th>
                                                                    <th scope="col" style="width: 120px;">Created Date</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="AllTasksTableBody">


                                                            </tbody>
                                                        </table>
                                                        <div class="noresult" style="display: none">
                                                            <div class="text-center">
                                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                                <h5 class="mt-2">Sorry! No Records Found</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="text-center mt-3">
                                                        <a href="javascript:void(0);" class="text-success "><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load more </a>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end tab pane -->
                                <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0">
                                            <div class="modal-header p-3 bg-soft-info">
                                                <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                            </div>
                                            <form class="tablelist-form needs-validation" id="TaskAddForm" autocomplete="off" novalidate>
                                                <div class="modal-body">
                                                    <input type="hidden" id="tasksId" />
                                                    <div class="row g-3">
                                                        <div class="col-lg-12">
                                                            <label for="projectName-field" class="form-label">Project Name</label>
                                                            <input type="text" id="projectName-field" class="form-control" placeholder="Project name" disabled />
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-lg-12 position-relative">
                                                            <div>
                                                                <label for="tasksTitle-field" class="form-label requiredField">Title</label>
                                                                <input type="text" id="tasksTitle-field" class="form-control" placeholder="Title" required />
                                                                <div class="invalid-tooltip" id="tasktitleInvField">Task title should not be empty!</div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="position-relative">
                                                                <label for="duedate-field" class="form-label requiredField">Due Date</label>
                                                                <input type="text" id="duedate-field" class="form-control" data-provider="flatpickr" placeholder="Due date" required />
                                                                <div class="invalid-tooltip" id="dueDateInvalidField">Task due date should not be empty!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="position-relative">
                                                                <label for="priority-field" class="form-label requiredField">Priority</label>
                                                                <select class="form-control" data-choices data-choices-search-false id="priority-field">
                                                                    <option value="" selected>select</option>
                                                                    <?php
                                                                    include 'assets/php/connection.php';
                                                                    $query = "SELECT * FROM `tasks_priority`";
                                                                    $result = $con->query($query);
                                                                    if ($result->num_rows > 0) {
                                                                        while ($optionData = $result->fetch_assoc()) {
                                                                            $options = $optionData['Tasks_Priority'];
                                                                            $task_priorityID = $optionData['ID'];
                                                                    ?>
                                                                            <option value="<?php echo $task_priorityID; ?>"><?php echo $options; ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                    <?php mysqli_close($con); ?>
                                                                </select>
                                                                <div class="invalid-tooltip" id="priorityInvField">Please select task priority!</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-12">
                                                            <div class="position-relative">

                                                                <label class="form-label requiredField">Task Description</label>
                                                                <div id="ckeditor-classic-taskDescription">

                                                                </div>
                                                                <div class="invalid-tooltip Project-description-tooltip" id="TaskDescriptionInvDiv">Task description should not be empty!</div>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                    <!--end row-->
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="add-btn">Add Task</button>
                                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update Task</button> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--end modal-->
                                <div class="tab-pane fade" id="project-activities" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Activities</h5>
                                            <div class="acitivity-timeline py-3">
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
                                                        <h6 class="mb-1">Natasha Carey <span class="badge bg-soft-success text-success align-middle">Completed</span></h6>
                                                        <p class="text-muted mb-2">Adding a new event with attachments</p>
                                                        <div class="row">
                                                            <div class="col-xxl-4">
                                                                <div class="row border border-dashed gx-2 p-2 mb-2">
                                                                    <div class="col-4">
                                                                        <img src="assets/images/small/img-2.jpg" alt="" class="img-fluid rounded" />
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-4">
                                                                        <img src="assets/images/small/img-3.jpg" alt="" class="img-fluid rounded" />
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-4">
                                                                        <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded" />
                                                                    </div>
                                                                    <!--end col-->
                                                                </div>
                                                                <!--end row-->
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
                                                        <p class="text-muted mb-2">They all have something to say beyond the words on the page. They can come across as casual or neutral, exotic or graphic. </p>
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
                                                        <p class="text-muted mb-2"><span class="text-danger">2 days left</span> notification to submit the monthly sales report. <a href="javascript:void(0);" class="link-warning text-decoration-underline">Reports Builder</a></p>
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
                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>
                                <!-- end tab pane -->
                                <div class="tab-pane fade" id="project-team" role="tabpanel">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm">
                                            <div class="d-flex">
                                                <div class="search-box me-2">
                                                    <input type="text" class="form-control" placeholder="Search member...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#inviteMembersModal"><i class="ri-share-line me-1 align-bottom"></i> Invite Member</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="team-list list-view-filter">
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid d-block rounded-circle" />
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Nancy Martino</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Team Leader & HR</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">225</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">197</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn active">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <div class="avatar-title bg-soft-danger text-danger rounded-circle">
                                                                    HB
                                                                </div>
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Henry Baird</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Full Stack Developer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">352</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">376</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn active">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <img src="assets/images/users/avatar-3.jpg" alt="" class="img-fluid d-block rounded-circle" />
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Frank Hook</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Project Manager</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">164</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">182</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <img src="assets/images/users/avatar-8.jpg" alt="" class="img-fluid d-block rounded-circle" />
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Jennifer Carter</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">UI/UX Designer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">225</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">197</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <div class="avatar-title bg-soft-success text-success rounded-circle">
                                                                    ME
                                                                </div>
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Megan Elmore</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Team Leader & Web Developer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">201</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">263</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <img src="assets/images/users/avatar-4.jpg" alt="" class="img-fluid d-block rounded-circle" />
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Alexis Clarke</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Backend Developer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">132</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">147</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <div class="avatar-title bg-soft-info text-info rounded-circle">
                                                                    NC
                                                                </div>
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Nathan Cole</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Front-End Developer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">352</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">376</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <img src="assets/images/users/avatar-7.jpg" alt="" class="img-fluid d-block rounded-circle" />
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Joseph Parker</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Team Leader & HR</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">64</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">93</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="img-fluid d-block rounded-circle" />
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Erica Kernan</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Web Designer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">345</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">298</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                        <div class="card team-box">
                                            <div class="card-body px-4">
                                                <div class="row align-items-center team-row">
                                                    <div class="col team-settings">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                        <i class="ri-star-fill"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col text-end dropdown">
                                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail rounded-circle">
                                                                <div class="avatar-title border bg-light text-primary rounded-circle">
                                                                    DP
                                                                </div>
                                                            </div>
                                                            <div class="team-content">
                                                                <a href="#" class="d-block">
                                                                    <h5 class="fs-16 mb-1">Donald Palmer</h5>
                                                                </a>
                                                                <p class="text-muted mb-0">Wed Developer</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col">
                                                        <div class="row text-muted text-center">
                                                            <div class="col-6 border-end border-end-dashed">
                                                                <h5 class="mb-1">97</h5>
                                                                <p class="text-muted mb-0">Projects</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h5 class="mb-1">135</h5>
                                                                <p class="text-muted mb-0">Tasks</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col">
                                                        <div class="text-end">
                                                            <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                    </div>
                                    <!-- end team list -->

                                    <div class="row g-0 text-center text-sm-start align-items-center mb-3">
                                        <div class="col-sm-6">
                                            <div>
                                                <p class="mb-sm-0">Showing 1 to 10 of 12 entries</p>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-sm-6">
                                            <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                                                <li class="page-item disabled"> <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a> </li>
                                                <li class="page-item"> <a href="#" class="page-link">1</a> </li>
                                                <li class="page-item active"> <a href="#" class="page-link">2</a> </li>
                                                <li class="page-item"> <a href="#" class="page-link">3</a> </li>
                                                <li class="page-item"> <a href="#" class="page-link">4</a> </li>
                                                <li class="page-item"> <a href="#" class="page-link">5</a> </li>
                                                <li class="page-item"> <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a> </li>
                                            </ul>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                                <!-- end tab pane -->
                                <div class=" fade" id="project-employee-performance" role="tabpanel">

                                    <div class="card" id="performance_page">
                                        <div class="card-body">

                                            <div class="row col-md-12 g-3" id="PieChartDropdowns">
                                                <div class="employeeDropDown col-md-4">
                                                    <select name="performanceEmpDD" class="form-select" id="PerformanceEmpDD" aria-label="Default select example" required>
                                                        <option selected value="">Select Employee</option>

                                                    </select>
                                                    <div class="invalid-feedback" id="PerformanceDDInvDiv">Please select employee !</div>
                                                </div>

                                                <div class="TimeDropdown">
                                                    <div class="row g-3">

                                                        <div class="dropdown col-md-4">
                                                            <button class="btn btn-primary w-100 dropdown-toggle" type="button" id="timePeriodDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Select Time
                                                            </button>
                                                            <ul class="dropdown-menu DaysDropdwonMenuItems" aria-labelledby="timePeriodDropdown">
                                                                <li>
                                                                    <h6 class="dropdown-header">Days</h6>
                                                                    <a class="dropdown-item" href="#" data-value="1">Last 1 day</a>
                                                                    <a class="dropdown-item" href="#" data-value="2">Last 2 days</a>
                                                                    <a class="dropdown-item" href="#" data-value="3">Last 3 days</a>
                                                                    <a class="dropdown-item" href="#" data-value="4">Last 4 days</a>
                                                                    <a class="dropdown-item" href="#" data-value="5">Last 5 days</a>
                                                                    <a class="dropdown-item" href="#" data-value="6">Last 6 days</a>
                                                                    <a class="dropdown-item" href="#" data-value="7">Last 1 week</a>
                                                                </li>
                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>
                                                                <li>
                                                                    <h6 class="dropdown-header">Weeks</h6>
                                                                    <a class="dropdown-item" href="#" data-value="7">Last 1 week</a>
                                                                    <a class="dropdown-item" href="#" data-value="14">Last 2 weeks</a>
                                                                    <a class="dropdown-item" href="#" data-value="21">Last 3 weeks</a>
                                                                    <a class="dropdown-item" href="#" data-value="28">Last 4 weeks</a>
                                                                </li>
                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>
                                                                <li>
                                                                    <h6 class="dropdown-header">Months</h6>
                                                                    <a class="dropdown-item" href="#" data-value="30">Last 1 month</a>
                                                                    <a class="dropdown-item" href="#" data-value="60">Last 2 months</a>
                                                                    <a class="dropdown-item" href="#" data-value="90">Last 3 months</a>
                                                                    <a class="dropdown-item" href="#" data-value="120">Last 4 months</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-4">
                                                            To
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" id="todays-date-field" class="form-control" data-provider="flatpickr" data-date-format="D-m-Y" disabled required />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="card-header">
                                                <h5 class="card-title">Performance Pie Chart</h5>
                                            </div>

                                            <!-- Pie Chart -->
                                            <div class="card-body">
                                                <div id="chart-pie" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="e-charts" style="visibility: hidden;"></div>
                                            </div>
                                            <!-- End Pie Chart -->

                                        </div>
                                    </div>


                                </div>
                                <!-- end tab pane -->
                                <div class="tab-pane fade" id="project-roadmap" role="tabpanel">
                                    <div class="d-flex align-items-center mb-4">
                                        <h5 class="card-title flex-grow-1">Goals</h5>
                                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#GoalCreateModal" onclick="showModalAddBtn()"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div>
                                                <!-- <h5>Timeline</h5> -->
                                                <div class="timeline" id="RoadMapAllCardsDiv">

                                                    <div class="timeline-item left">
                                                        <i class="icon ri-stack-line"></i>
                                                        <div class="date">15 Dec 2021</div>
                                                        <div class="content">
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-sm rounded">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h5 class="fs-15">@Erica245 <small class="text-muted fs-13 fw-normal">- 10 min Ago</small></h5>
                                                                    <p class="text-muted mb-2">Wish someone a sincere ‘good luck in your new job’ with these sweet messages. Make sure you pick out a good luck new job card to go with the words, and pop a beautiful bunch of flowers from our gift range in your basket, to make them feel super special.</p>
                                                                    <div class="hstack gap-2">
                                                                        <a class="btn btn-sm btn-light"><span class="me-1">&#128293;</span> 19</a>
                                                                        <a class="btn btn-sm btn-light"><span class="me-1">&#129321;</span> 22</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item right">
                                                        <i class="icon ri-vip-diamond-line"></i>
                                                        <div class="date">22 Oct 2021</div>
                                                        <div class="content">
                                                            <h5>Adding a new event with attachments</h5>
                                                            <p class="text-muted">Too much or too little spacing, as in the example below, can make things unpleasant for the reader.</p>
                                                            <div class="row g-2">
                                                                <div class="col-sm-6">
                                                                    <div class="d-flex border border-dashed p-2 rounded position-relative">
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-soft-danger text-danger fs-15 rounded">
                                                                                <i class="ri-image-2-line"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-shrink-0">

                                                                        </div>
                                                                        <div class="flex-grow-1 overflow-hidden ms-2">
                                                                            <h6 class="text-truncate mb-0"><a href="javascript:void(0);" class="stretched-link">Business Template - UI/UX design</a></h6>
                                                                            <small>685 KB</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-sm-6">
                                                                    <div class="d-flex border border-dashed p-2 rounded position-relative">
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-soft-info text-info fs-15 rounded">
                                                                                <i class="ri-file-zip-line"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-2 overflow-hidden">
                                                                            <h6 class="mb-0 text-truncate"><a href="javascript:void(0);" class="stretched-link">Bank Management System - PSD</a></h6>
                                                                            <small>8.78 MB</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item left">
                                                        <i class="icon ri-gift-line"></i>
                                                        <div class="date">10 Jul 2021</div>
                                                        <div class="content">
                                                            <h5>Create new project buildng product</h5>
                                                            <p class="text-muted">Every team project can have a velzon. Use the velzon to share information with your team to understand and contribute to your project.</p>
                                                            <div class="avatar-group mb-2">
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="Christi">
                                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="Frank Hook">
                                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xs">
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title=" Ruby">
                                                                    <div class="avatar-xs">
                                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                                            R
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="" data-bs-original-title="more">
                                                                    <div class="avatar-xs">
                                                                        <div class="avatar-title rounded-circle">
                                                                            2+
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item right">
                                                        <i class="icon ri-shield-star-line"></i>
                                                        <div class="date">18 May 2021</div>
                                                        <div class="content">
                                                            <h5>Donald Palmer <small class="text-muted fs-13 fw-normal">- Has changed 2 attributes</small></h5>
                                                            <p class="text-muted fst-italic mb-2">" This is an awesome admin dashboard template. It is extremely well structured and uses state of the art components (e.g. one of the only templates using boostrap 5.1.3 so far). I integrated it into a Rails 6 project. Needs manual integration work of course but the template structure made it easy. "</p>
                                                            <div class="hstack gap-2">
                                                                <a class="btn btn-sm bg-light"><span class="me-1">&#128151;</span> 35</a>
                                                                <a class="btn btn-sm btn-light"><span class="me-1">&#128077;</span> 10</a>
                                                                <a class="btn btn-sm btn-light"><span class="me-1">&#128591;</span> 10</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item left">
                                                        <i class="icon ri-user-smile-line"></i>
                                                        <div class="date">10 Feb 2021</div>
                                                        <div class="content">
                                                            <h5>Velzon admin dashboard templates layout upload</h5>
                                                            <p class="text-muted">Powerful, clean & modern responsive bootstrap 5 admin template. The maximum file size for uploads in this demo :</p>
                                                            <div class="row border border-dashed rounded gx-2 p-2">
                                                                <div class="col-3">
                                                                    <img src="assets/images/small/img-2.jpg" alt="" class="img-fluid rounded">
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-3">
                                                                    <img src="assets/images/small/img-3.jpg" alt="" class="img-fluid rounded">
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-3">
                                                                    <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded">
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-3">
                                                                    <img src="assets/images/small/img-6.jpg" alt="" class="img-fluid rounded">
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div>

                                <!-- goal create modal  -->
                                <div class="modal fade" id="GoalCreateModal" tabindex="-1" aria-labelledby="GoalCreateModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal">
                                        <div class="modal-content border-0">
                                            <div class="modal-header p-3 bg-soft-info">
                                                <h5 class="modal-title" id="GoalCreateModal">Create Goal</h5>
                                                <button type="button" class="btn-close GoalModalCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form class="tablelist-form needs-validation" id="GoalAddForm" autocomplete="off" novalidate>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-lg-12 position-relative">
                                                            <div>
                                                                <label for="Goal-title-field" class="form-label requiredField">Goal Title</label>
                                                                <input type="text" id="Goal-title-field" class="form-control" placeholder="Title" placeholder="Enter Goal Head" required />
                                                                <div class="invalid-tooltip" id="goalTitleInvField">Goal title should not be empty!</div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="position-relative">
                                                                <label for="goal-date-field" class="form-label requiredField">Goal Date</label>
                                                                <input type="text" id="goal-date-field" class="form-control" data-provider="flatpickr" placeholder="Enter Goal Date" required />
                                                                <div class="invalid-tooltip" id="GoalDateInvField">Goal date should not be empty!</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-12">
                                                            <div class="position-relative">
                                                                <label class="form-label requiredField">Goal Description</label>
                                                                <div id="ckeditor-classic-goalDescription">

                                                                </div>
                                                                <div class="invalid-tooltip" id="GoalDescriptionInvField">Goal description should not be empty!</div>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                    <!--end row-->
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light GoalModalCloseBtn" id="close-modal" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="RoadMapAddBtn">Add</button>
                                                        <button type="button" class="btn btn-success d-none" id="RoadMapUpdateBtn">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--end goal create modal-->

                            </div>
                        </div>
                        <!-- end col -->
                    </div>
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

                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="inviteMembersModalLabel">Employees</h5>
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
                    <button type="button" class="btn btn-success w-xs" onclick="showSelectedEmp()">Save</button>
                </div>
            </div>
            <!-- end modal-content -->
        </div>
        <!-- modal-dialog -->
    </div>
    <!-- end modal -->



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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- master js file  -->
    <script src="./assets/js/master.js"></script>
    <!-- moment.js cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- sweet alert aimation cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- ckeditor -->
    <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <!-- form validation setup  -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <script>
        ShowRoadMap();

        function ShowRoadMap() {
            $.ajax({
                url: './php/showroadmap.php',
                dataType: 'json',
                type: 'POST',
                data: {
                    p_id: '<?php echo $_GET['pid']; ?>'
                },
                success: function(data) {
                    $('#RoadMapAllCardsDiv').empty();
                    let toggleState = "left";
                    $.each(data, function(ind, item) {
                        var CardString = `<div class="timeline-item ${toggleState}">
                                                        <i class="icon ri-shield-star-line"></i>
                                                        <div class="date">${moment(item.goalDate).format('D MMM, YYYY hh:mm A')}</div>
                                                        <div class="content">
                                                            <h5>${item.goal_head}<span class="badge bg-soft-${item.achived == 0 ? 'danger':'success'} text-${item.achived == 0 ? 'danger':'success'} fs-10 align-middle ms-1">${item.achived == 0 ? 'Not Achieved':'Achieved'}</span></h5>
                                                            <p class="text-muted mb-2">
                                                                ${item.goal_description}
                                                            </p>
                                                            <!-- <a href="javascript:void(0);" class="link-primary text-decoration-underline">Read More <i class="ri-arrow-right-line"></i></a> -->
                                                            <div class="hstack gap-2">
                                                            ${item.achived == 0 ? `<a class="btn btn-sm btn-light" onclick="MarkGoalAsAchieved(${item.goal_id})"><span class="me-1"><i class="text-success ri-check-line"></i></span> Mark Achieved</a>`:''}
                                                                
                                                                <a href="#" class="btn btn-sm btn-light" onclick="EditGoal(${item.goal_id})" data-bs-toggle="modal" data-bs-target="#GoalCreateModal"> <span class="me-1"><i class="text-info ri-edit-box-line"></i></span> Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>`;
                        $('#RoadMapAllCardsDiv').append(CardString);
                        toggleState = toggleState === "left" ? "right" : "left";
                    })
                }
            })
        }
        $('.GoalModalCloseBtn').on('click', function() {
            $('#GoalAddForm')[0].reset();
            $('#Goal-title-field').val('');
            $('#goal-date-field').val();
            GoalDescriptionEditor.setData('');
            $('#GoalCreateModal').modal('hide');
        })

        function MarkGoalAsAchieved(goalID) {
            Swal.fire({
                title: 'Sure?',
                icon: 'question',
                text: 'Mark this Goal as Achieved?',
                showDenyButton: true,
                width: '400px',
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
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
                        url: './php/markGoalAchived.php',
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            goal_id: goalID
                        },
                        success: function(result) {
                            console.log(result);
                            if (result.success) {
                                ShowRoadMap();
                                Swal.fire(
                                    "Marked!",
                                    "Goal Marked As Achieved successfully!",
                                    "success");
                            }
                        }
                    })
                }

            })
        }

        function showModalAddBtn() {
            $('#RoadMapAddBtn').removeClass('d-none')
            $('#RoadMapUpdateBtn').addClass('d-none')
        }

        function EditGoal(goalID) {
            $('#RoadMapAddBtn').addClass('d-none')
            $('#RoadMapUpdateBtn').removeClass('d-none')
            localStorage.setItem('g_id', goalID);

            $.ajax({
                url: './php/showroadmap.php',
                dataType: 'json',
                type: 'POST',
                data: {
                    GoalID: goalID,
                    p_id: '<?php echo $_GET['pid']; ?>'
                },
                success: function(data) {
                    $.each(data, function(i, item) {
                        $('#Goal-title-field').val(item.goal_head)
                        $('#goal-date-field').val(item.goalDate)
                        GoalDescriptionEditor.setData(item.goal_description)

                    })
                }
            })
        }

        $('#RoadMapUpdateBtn').on('click', function() {
            event.preventDefault();
            var valid = true;
            if ($('#goal-date-field').val() == '') {
                $('#GoalDateInvField').css('display', 'block');
            } else {
                $('#GoalDateInvField').css('display', 'none');
            }
            var GoalDesc = GoalDescriptionEditor.getData();
            if (GoalDesc == '') {
                $('#GoalDescriptionInvField').css('display', 'block');
                valid = false;
            } else {
                $('#GoalDescriptionInvField').css('display', 'none');
            }
            if (valid) {
                // update details
                var GoalDesc = GoalDescriptionEditor.getData();

                $.ajax({
                    url: './php/RoadMapUpdate.php',
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        goalid: localStorage.getItem('g_id'),
                        projectid: <?php echo $_GET['pid']; ?>,
                        goalHead: $('#Goal-title-field').val(),
                        goalDate: $('#goal-date-field').val(),
                        goalDescrip: GoalDesc,
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#GoalCreateModal').modal('hide');
                            localStorage.removeItem('g_id');
                            Swal.fire(
                                "Updated",
                                "Goal updated successfully!",
                                "success");
                            ShowRoadMap();
                            $('#GoalAddForm')[0].reset();
                            $('#Goal-title-field').val('');
                            $('#goal-date-field').val();
                            GoalDescriptionEditor.setData('');

                        }
                    }
                })
            }
        })




        $('#GoalAddForm').on('submit', function(event) {
            event.preventDefault();
            var valid = true;
            if ($('#goal-date-field').val() == '') {
                $('#GoalDateInvField').css('display', 'block');
            } else {
                $('#GoalDateInvField').css('display', 'none');
            }
            var GoalDesc = GoalDescriptionEditor.getData();
            if (GoalDesc == '') {
                $('#GoalDescriptionInvField').css('display', 'block');
                valid = false;
            } else {
                $('#GoalDescriptionInvField').css('display', 'none');
            }
            if (valid) {
                SaveGoalDetails()
            }
        })

        function SaveGoalDetails() {
            Swal.fire({
                title: 'Create?',
                icon: 'question',
                text: 'Would you like to create this Goal?',
                showDenyButton: true,
                width: '400px',
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
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
                    var GoalDesc = GoalDescriptionEditor.getData();
                    $.ajax({
                        url: './php/roadmap.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            projectid: '<?php echo $_GET['pid']; ?>',
                            goalHead: $('#Goal-title-field').val(),
                            goalDate: $('#goal-date-field').val(),
                            goalDescrip: GoalDesc,
                        },
                        success: function(result) {

                            $('#GoalCreateModal').modal('hide');
                            ShowRoadMap();
                            Swal.fire(
                                "Added",
                                "Goal added successfully!",
                                "success");
                        }
                    })
                }
            })
        }
    </script>


    <script>
        var filterData;
        var empIDArray = [];
        var previousEmpIDArray = [];
        var projectID;
        var FileTypeArray = {
            'zip': '<i class="ri-folder-zip-line"></i>',
            'pdf': '<i class="ri-file-pdf-fill"></i>',
            'mp4': ' <i class="ri-video-line"></i>',
            'xlsx': ' <i class="ri-file-excel-fill"></i>',
            'docx': ' <i class="ri-folder-fill"></i>',
            'jpg': ' <i class="ri-image-2-fill"></i>',
        }
        $.ajax({
            url: './php/GetProjectDetails.php',
            type: 'POST',
            dataType: 'json',
            data: {
                pid: '<?php echo $_GET['pid']; ?>',
            },
            success: function(data) {
                // console.log(data);
                $.each(data.projectData, function(ind, item) {
                    projectID = item.ProjectKey;
                    $('#project-title').html(item.ProjectName);
                    $('#projectName-field').val(item.ProjectName);
                    $('#projectLogoImage').attr('src', item.ProjectLogo);

                    $('#project-createddate').html(moment(item.Created_Date).format('D MMM, YYYY hh:mm A'));
                    $('.project-startdate').html(moment(item.Start_Date).format('D MMM, YYYY'));
                    $('.project-enddate').html(moment(item.End_Date).format('D MMM, YYYY'));
                    $('.project-priority').html(item.ProjectPriority);
                    $('#descriptionDetails').html(item.PROJDesc);
                    $('#missionDetails').html(item.PROJMission);
                })

                $.each(data.AttachmentData, function(index, it) {
                    if (it.File_Type in FileTypeArray) {
                        var fileTypeIcon = FileTypeArray[it.File_Type];
                    } else {
                        var fileTypeIcon = '<i class="ri-file-line"></i>';
                    }
                    if (index <= 3) {
                        var attachedfileString = `<div class="border rounded border-dashed p-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                                ${it.File_Type == 'jpg'? '<img src='+it.File_Path+' alt="" height="50" width="50">' :'<i class="ri-folder-zip-line"></i>'}
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="fs-13 mb-1"><a href="#" class="text-body text-truncate d-block">${it.File_Name}</a></h5>
                                                            <div>2.2MB</div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="d-flex gap-1">
                                                                <button type="button" target="blank" onclick="window.location.href ='${it.File_Path}'" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`;
                        $('#attachedFilesShown').append(attachedfileString)
                    }

                    var tableRowString = ` <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                                ${fileTypeIcon}
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h5 class="fs-14 mb-0"><a href="javascript:void(0)" class="text-dark">${it.File_Name}</a></h5>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>${it.File_Type}</td>
                                                    <td>${moment(it.DateTime).format('D MMM, YYYY')}</td>
                                                    <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-soft-secondary btn-sm btn-icon" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="ri-more-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.location.href ='${it.File_Path}'"><i class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.location.href ='assets/php/download.php?=FPath=${it.File_Path}&FName=${it.File_Name}'"><i class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a></li>
                                                        </ul>
                                                        </div>
                                                    </td>
                                                </tr>`;
                    $('#AllFileTableBody').append(tableRowString);


                })
                $.each(data.EmployeeData, function(idn, dataItem) {
                    filterData = $.grep(data.EmployeeData, function(item) {
                        var empNM = item.ID;
                        return empNM;
                    });
                    $('#PerformanceEmpDD').append($('<option>').val(dataItem.ID).text(dataItem.EmpName))

                    empIDArray.push(dataItem.ID);
                    var EmpStr = ` <div class="d-flex align-items-center">
                                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                                    <img src="${dataItem.ProfilePhoto==null ? 'assets/images/users/avatar-blank.jpg' : dataItem.ProfilePhoto}" alt="" class="img-fluid rounded-circle">
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">${dataItem.EmpName}</a></h5>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex align-items-center gap-1">
                                                                        <button type="button" class="btn btn-light btn-sm" onclick="window.location.href='pages-profile.php?id=${btoa(dataItem.ID)}'">View profile</button>
                                                                    </div>
                                                                </div>
                                                            </div>`;
                    $('#membersDiv').append(EmpStr);
                    previousEmpIDArray.push(dataItem.ID);
                })
                // var DefaultString = `<div class="mt-2 text-center">
                //                         <button type="button" class="btn btn-sm btn-success">View All</button>
                //                     </div>`;
                // $('#attachedFilesShown').append(DefaultString)
                // console.log(empIDArray);
            }
        })
        ShowEmployeeList()

        function ShowEmployeeList() {
            $.ajax({
                url: './php/GetAllEmployees.php',
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    $.each(data, function(index, item) {
                        if (empIDArray.includes(item.ID)) {
                            var functionclString = `RemoveFromList('${item.ID}', this.id)`;
                            var showingword = `Remove`;
                        } else {
                            var showingword = `Add`;
                            var functionclString = `SetSelectedEmployeeArray('${item.ID}', this.id)`;
                        }
                        var employeeString = ` <div class="d-flex align-items-center EmpRowDiv">
                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                        <img src="${item.ProfilePhoto==null ? 'assets/images/users/avatar-blank.jpg' : item.ProfilePhoto}" alt="" class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 d-flex"><a href="#" class="text-body d-block fw-bold">${item.EmpName}</a> &nbsp;<span style="font-style:italic;">(${item.Position})</span></h5>
                                                    </div>
                                                                                                       
                                                    <div class="flex-shrink-0">
                                                        <button type="button" onclick="${functionclString}" id="EmpAddBtn${item.ID}" class="btn btn-light btn-sm">${showingword}</button>
                                                    </div>
                                                </div>`;
                        $('#EmployeeListToAdd').append(employeeString);
                    })
                }
            })
        }
        $(document).ready(function() {
            $('#EmployeeSearch').on('input', function() {
                var searchTerm = $(this).val().trim().toLowerCase();
                $('#EmployeeListToAdd .text-body').each(function() {
                    var employeeName = $(this).text().toLowerCase();
                    var listItem = $(this).closest('.EmpRowDiv');
                    // console.log(listItem);

                    if (employeeName.includes(searchTerm)) {
                        listItem.removeClass('d-none');
                    } else {
                        listItem.addClass('d-none');
                    }
                });
            });
        });

        function SetSelectedEmployeeArray(empid, thisvar) {
            var IDrecieved = thisvar;
            $('#' + thisvar).html('Remove').removeAttr('onclick').attr('onclick', `RemoveFromList('${empid}','${IDrecieved}')`);
            empIDArray.push(empid);
        }

        function RemoveFromList(empid, thisvar) {
            for (var i = 0; i < empIDArray.length; i++) {
                if (Number(empIDArray[i]) === Number(empid)) {
                    empIDArray.splice(i, 1);
                    break; // Exit the loop once element is found and removed
                }
            }

            $('#' + String(thisvar)).html('Add').removeAttr('onclick').attr('onclick', `SetSelectedEmployeeArray('${empid}','${thisvar}')`);
        }
        $(document).ready(function() {
            $('#inviteMembersModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#GoalCreateModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        function showSelectedEmp() {

            $.ajax({
                url: './php/updateemponproj.php',
                dataType: 'json',
                type: 'post',
                data: {
                    pid: '<?php echo $_GET['pid']; ?>',
                    employeesSelected: empIDArray,
                },
                success: function(data) {
                    if (data.success) {
                        SendMailToNewlyAssignedAndRemovedEmployees()
                        $('#membersDiv').html('');
                        $('#inviteMembersModal').modal('hide');
                        $.ajax({
                            url: './php/GetProjectDetails.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                pid: '<?php echo $_GET['pid']; ?>',
                            },
                            success: function(data) {
                                $.each(data.EmployeeData, function(idn, dataItem) {
                                    empIDArray.push(dataItem.ID);
                                    var EmpStr = ` <div class="d-flex align-items-center">
                                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                                    <img src="${dataItem.ProfilePhoto==null ? 'assets/images/users/avatar-blank.jpg' : dataItem.ProfilePhoto}" alt="" class="img-fluid rounded-circle">
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">${dataItem.EmpName}</a></h5>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <div class="d-flex align-items-center gap-1">
                                                                        <button type="button" class="btn btn-light btn-sm" onclick="window.location.href='pages-profile.php?id=${dataItem.ID}'">View profile</button>
                                                                    </div>
                                                                </div>
                                                            </div>`;
                                    $('#membersDiv').append(EmpStr);
                                })
                                //
                                Swal.fire(
                                    "Updated",
                                    "Project employees are updated successfully!",
                                    "success");
                                ShowNotifications()
                                $('#noti_count').addClass('flicker-element')
                                setTimeout(() => {
                                    $('#noti_count').removeClass('flicker-element')
                                }, 6000);
                            }
                        })
                    }
                }
            })
        }
        ShowTasks()

        function SendMailToNewlyAssignedAndRemovedEmployees() {
            var resultArray = compareArrays(previousEmpIDArray, empIDArray);

            console.log(resultArray);
            var addedElements = resultArray[0];
            var removedElements = resultArray[1];

            $.get("Email/email_added_to_project.html", function(htmlCode) {
                var inputStartDate = $('.project-startdate').html();
                htmlCode = htmlCode
                    .replace("[Project Name]", $('#projectName-field').val())
                    .replace("[Project Name]", $('#projectName-field').val())
                    .replace("[Start Date]", inputStartDate)
                    .replace("[Admin Name]", '<?php echo $Uname; ?>')
                    .replace("[Your Name]", '<?php echo $Uname; ?>')
                    .replace("[Redirect_Link]", "http://134.209.156.101/Task_Manager/projects-list.php");
                var EmailBody = htmlCode;
                var empsChecked = addedElements;
                $.ajax({
                    url: "Email/SendMail.php",
                    method: 'POST',
                    type: 'JSON',
                    data: {
                        email: 'abc@gmail.com',
                        subject: `You have been added to ${$('#projectName-field').val()} project`,
                        body: EmailBody,
                        SelectedEmps: JSON.stringify(empsChecked)
                    },
                    success: function(result) {
                        //Mail to removed Employees
                        $.get("Email/email_removed_from_project.html",
                            function(htmlCode) {
                                var inputStartDate = $('.project-startdate').html();
                                htmlCode = htmlCode
                                    .replace("[Project Name]", $('#projectName-field').val())
                                    .replace("[Project Name]", $('#projectName-field').val())
                                    .replace("[Start Date]", inputStartDate)
                                    .replace("[Admin Name]", '<?php echo $Uname; ?>')
                                    .replace("[Your Name]", '<?php echo $Uname; ?>')
                                    .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/pages-login.html");
                                var EmailBody = htmlCode;
                                var empsChecked = removedElements;
                                $.ajax({
                                    url: "Email/SendMail.php",
                                    method: 'POST',
                                    type: 'JSON',
                                    data: {
                                        email: 'abc@gmail.com',
                                        subject: `You have been removed from the ${$('#projectName-field').val()} project`,
                                        body: EmailBody,
                                        SelectedEmps: JSON.stringify(empsChecked)
                                    },
                                    success: function(result) {
                                        // document.getElementById("UpdateEmpOnProj").reset();
                                        // location.reload();
                                        empIDArray.length = 0;

                                    }
                                })
                            })
                        //mail to removed emplyees ends here
                    }
                })
            })
        }

        function compareArrays(previousArray, newArray) {
            var addedElements = newArray.filter(function(element) {
                return !previousArray.includes(element);
            });

            var removedElements = previousArray.filter(function(element) {
                return !newArray.includes(element);
            });

            return [addedElements, removedElements];
        }

        function ShowTasks() {
            $.ajax({
                url: './php/taskshow.php',
                type: 'GET',
                data: {
                    PID: <?php echo $_GET['pid']; ?>
                },
                success: function(data) {
                    // console.log(data);
                    $('#AllTasksTableBody').html('');
                    if (data[0] == "No Tasks Yet!") {
                        $('.noresult').css('display', 'block');
                    } else {
                        $('.noresult').css('display', 'none');
                        $.each(data, function(index, itemid) {
                            var tableRowString = ` <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="ms-3 flex-grow-1">
                                                                <h5 class="fs-14 mb-0"><a href="javascript:void(0)" class="text-dark">${itemid.Task_name}</a></h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                      <div class="badge rounded-pill bg-primary fs-12 project-priority">
                                                        ${itemid.Tasks_Priority}
                                                      </div>
                                                    </td>
                                                    <td>${moment(itemid.Task_Due).format('D MMM, YYYY')}</td>
                                                    <td>${itemid.EmpName}</td>
                                                    <td>${moment(itemid.TaskCreatedDate).format('D MMM, YYYY hh:mm A')}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" class="btn btn-soft-secondary btn-sm btn-icon" data-bs-toggle="dropdown" aria-expanded="true">
                                                                <i class="ri-more-fill"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.location.href ='tasks-list-view.php?pid=${<?php echo $_GET['pid']; ?>}&tid=${itemid.id}'"><i class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>`;
                            $('#AllTasksTableBody').append(tableRowString);
                        })
                    }
                }
            });
        }
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize CKEditor 5
            ClassicEditor
                .create(document.querySelector('#ckeditor-classic-taskDescription'))
                .then(newEditor => {
                    DescriptionEditor = newEditor; // Save the editor instance
                })
                .catch(error => {
                    console.error(error);
                });
            ClassicEditor
                .create(document.querySelector('#ckeditor-classic-goalDescription'))
                .then(newEditor => {
                    GoalDescriptionEditor = newEditor; // Save the editor instance
                })
                .catch(error => {
                    console.error(error);
                });
        })

        var valid = true;
        $('#TaskAddForm').on('submit', function(event) {
            event.preventDefault();
            if ($('#duedate-field').val() == '') {
                $('#dueDateInvalidField').css('display', 'block');
                valid = false;
            }
            if ($('#priority-field').val() == '') {
                $('#priorityInvField').css('display', 'block');
                valid = false;
            }
            var DescriptionEditorContent = DescriptionEditor.getData();
            if (DescriptionEditorContent == '') {
                $('#TaskDescriptionInvDiv').css('display', 'block');
                valid = false;
            }
            setTimeout(() => {
                $('#TaskAddForm').removeClass('was-validated')
                $('#tasktitleInvField').css('display', 'none');
                $('#tasktitleInvField').removeClass('is-invalid');
                $('#TaskDescriptionInvDiv').css('display', 'none');
                $('#priorityInvField').css('display', 'none');
                $('#dueDateInvalidField').css('display', 'none');
                valid = true;
            }, "3000");

            if (valid) {
                //submit the form
                SaveTaskDetails();
            }

        })

        function SaveTaskDetails() {
            //body
            Swal.fire({
                title: 'Create?',
                text: 'Would you like to create this Task?',
                showDenyButton: true,
                width: '400px',
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
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
                    var DescriptionEditorContent = DescriptionEditor.getData();

                    $.ajax({
                        url: './php/taskadd.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            ProjIDD: '<?php echo $_GET['pid']; ?>',
                            Proj_NAME: $('#projectName-field').val(),
                            ProjKEY: projectID,
                            taskName: $('#tasksTitle-field').val(),
                            taskpri: $('#priority-field').val(),
                            taskDue: $('#duedate-field').val(),
                            taskDescription: DescriptionEditorContent
                        },
                        success: function(result) {
                            $('#showModal').modal('hide');
                            $('#TaskAddForm')[0].reset();
                            ShowTasks();
                            Swal.fire(
                                "Added",
                                "Task added successfully!",
                                "success");
                            ShowNotifications()
                            $('#noti_count').addClass('flicker-element')
                            setTimeout(() => {
                                $('#noti_count').removeClass('flicker-element')
                            }, 6000);
                        }
                    });
                }
            });
        }
    </script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <script src="assets/js/pages/project-overview.init.js"></script>
    <!-- echarts js -->
    <script src="assets/libs/echarts/echarts.min.js"></script>

    <!-- echarts init -->
    <script src="assets/js/pages/echarts.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            $('#project-employee-performance').addClass('tab-pane');
            if ($('#performance-tab-link').hasClass('active')) {
                $('#project-employee-performance').removeClass('tab-pane')
            } else {
                $('#project-employee-performance').addClass('tab-pane')

            }
        })
        $('#todays-date-field').val(moment().format('DD MMM, YYYY'))
        document.addEventListener("DOMContentLoaded", () => {
            const chart = echarts.init(document.querySelector("#chart-pie"));
            $(document).ready(function() {

                $('.dropdown-item').on('click', function() {
                    const selectedValue = $(this).attr('data-value');
                    const selectedText = $(this).text();

                    if ($('#PerformanceEmpDD').val() == "") {
                        $('#PerformanceDDInvDiv').css('display', 'block')
                    } else {
                        $('#PerformanceDDInvDiv').css('display', 'none')
                        $('#timePeriodDropdown').text(selectedText);
                        $('#chart-pie').css('visibility', 'visible')
                        $.ajax({
                            url: './php/GetEmployeePerformanceData.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                SelectedValue: selectedValue,
                                EmpIDSel: $('#PerformanceEmpDD').val(),
                                ProjectID: <?php echo $_GET['pid']; ?>,
                            },
                            success: function(data) {
                                const jsonData = data;
                                const pieData = Object.entries(jsonData).map((
                                    [name, value]) => ({
                                    value: value,
                                    name: name
                                }));
                                // const colors = ["#5470C6", "#FFCE56", "#FF2465"];
                                const option = {
                                    tooltip: {
                                        trigger: "item",
                                        formatter: "{b}: {d}% ({c})",
                                    },
                                    legend: {
                                        orient: "vertical",
                                        left: "left",
                                    },
                                    series: [{
                                        name: "Access From",
                                        type: "pie",
                                        radius: "50%",
                                        data: pieData,
                                        emphasis: {
                                            itemStyle: {
                                                shadowBlur: 10,
                                                shadowOffsetX: 0,
                                                shadowColor: "rgba(0, 0, 0, 0.5)",
                                            },
                                        },
                                        // itemStyle: {
                                        //     color: function(params) {
                                        //         return colors[params.dataIndex]; // Set color based on index
                                        //     },
                                        // },
                                    }],
                                };

                                chart.setOption(option);
                            }
                        });
                    }
                })
            })
        });
        $('#PerformanceEmpDD').on('change', function() {
            $('#PerformanceDDInvDiv').css('display', 'none')
        })
    </script>

</body>

</html>