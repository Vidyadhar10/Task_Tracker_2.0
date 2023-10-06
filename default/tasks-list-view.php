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
$_SESSION['Uname'] = $Uname;
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Task Details | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    <style>
        .page-item a {
            cursor: pointer;
        }
    </style>
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
                                <h4 class="mb-sm-0">Task Details</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks</a></li>
                                        <li class="breadcrumb-item active">Task Details</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

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
                                                            <h4 class="fw-bold" id="task-title">hello</h4>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <!-- <div><i class="ri-building-line align-bottom me-1"></i> Themesbrand</div>
                                                                <div class="vr"></div> -->
                                                                <div>Create By : <span class="fw-medium" id="task-createdby"></span></div>
                                                                <div class="vr"></div>
                                                                <div>Create Date : <span class="fw-medium" id="task-createddate"></span></div>
                                                                <div class="vr"></div>
                                                                <!-- <div>Start Date : <span class="fw-medium task-startdate"></span></div>
                                                                <div class="vr"></div> -->
                                                                <div>Due Date : <span class="fw-medium task-duedate" id="task-duedate"></span></div>
                                                                <div class="vr"></div>
                                                                <!-- <div class="badge rounded-pill bg-info fs-12">New</div> -->
                                                                <div class="badge rounded-pill bg-danger fs-12 task-priority" id="task-priority"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card" id="tasksList">
                                <div class="card-header border-0">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1">All Sub Tasks</h5>
                                        <div class="flex-shrink-0">
                                            <div class="d-flex flex-wrap gap-2">
                                                <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal" id="Addnewsubtaskbtn"><i class="ri-add-line align-bottom me-1"></i> Add New</button>
                                                <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border border-dashed border-end-0 border-start-0">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-xxl-4 col-sm-12">
                                                <div class="search-box">
                                                    <input type="text" class="form-control search bg-light border-light" placeholder="Search for tasks or something...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-xxl-3 col-sm-4">
                                                <input type="text" class="form-control bg-light border-light" id="demo-datepicker" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date range">
                                            </div>
                                            <!--end col-->

                                            <div class="col-xxl-3 col-sm-4">
                                                <div class="input-light">
                                                    <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                                        <option value="">Status</option>
                                                        <option value="All" id="AllSubtasksCount">All</option>
                                                        <?php
                                                        include './php/connection.php';
                                                        $query = "SELECT * FROM `subtask_stages`";
                                                        $result = $con->query($query);
                                                        $counter = 0;
                                                        if ($result->num_rows > 0) {
                                                            while ($optionData = $result->fetch_assoc()) {
                                                                $counter++;
                                                                $options = $optionData['stages'];
                                                                $Subtask_priorityID = $optionData['id'];
                                                        ?>
                                                                <option value="<?php echo $options; ?>" id="<?php echo "statusDD" . $counter; ?>"><?php echo $options; ?></option>
                                                        <?php }
                                                        } ?>
                                                        <?php mysqli_close($con); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-2 col-sm-4">
                                                <button type="button" id="FilterBtn" class="btn btn-primary w-100"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                    Filters
                                                </button>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end card-body-->
                                <div class="card-body">
                                    <div class="table-responsive table-card mb-4">
                                        <table class="table align-middle table-nowrap mb-0" id="SubTasksTable">
                                            <thead class="table-light text-muted">
                                                <tr>
                                                    <th class="sort" data-sort="SrNo">Sr No</th>
                                                    <th class="sort" data-sort="sub_tasks_name">Sub Task Name</th>
                                                    <th class="sort" data-sort="Created_by_name">Created By</th>
                                                    <th class="sort" data-sort="assignedto">Assigned To</th>
                                                    <th class="sort" data-sort="Reporter_name">Reporter To</th>
                                                    <th class="sort" data-sort="due_date">Due Date</th>
                                                    <th class="sort" data-sort="Created_date">Created Date</th>
                                                    <th class="sort" data-sort="status">Status</th>
                                                    <th class="sort" data-sort="priority">Priority</th>
                                                    <!-- <th class="sort" data-sort="action">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody class="form-check-all" id="SubTaskTable">

                                            </tbody>
                                        </table>
                                        <!--end table-->
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                <h5 class="mt-2">Sorry! No Records Found</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
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
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <div class="col-xxl-3">

                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted">
                                        <h6 class="mb-3 fw-semibold text-uppercase">Description</h6>
                                        <p id="task-description">
                                            It will be as simple as occidental in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words.
                                        </p>



                                        <!-- <div class="pt-3 border-top border-top-dashed mt-4">
                                            <h6 class="mb-3 fw-semibold text-uppercase">Tasks Tags</h6>
                                            <div class="hstack flex-wrap gap-2 fs-15">
                                                <div class="badge fw-medium badge-soft-info">UI/UX</div>
                                                <div class="badge fw-medium badge-soft-info">Dashboard</div>
                                                <div class="badge fw-medium badge-soft-info">Design</div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end row-->



                    </div>

                    <!--end col-->


                    <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>You are about to delete a sub task ?</h4>
                                        <p class="text-muted fs-14 mb-4">Deleting your task will remove all of
                                            your information from our database.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link btn-ghost-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                            <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end delete modal -->

                    <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0">
                                <div class="modal-header p-3 bg-soft-info">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Sub Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form class="tablelist-form needs-validation" id="subtaskaddform" autocomplete="off" novalidate>
                                    <div class="modal-body">
                                        <input type="hidden" id="tasksId" />
                                        <div class="row g-3">
                                            <div class="col-lg-12 position-relative">
                                                <label for="projectName-field" class="form-label requiredField">Sub Task Title</label>
                                                <input type="text" id="SubtaskName-field" class="form-control " placeholder="Subtask title" required />
                                                <div class="invalid-tooltip" id="subtasktitleInvField">Sub Task title should not be empty!</div>
                                            </div>
                                            <!--end col-->

                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <label for="duedate-field" class="form-label requiredField">Due Date</label>
                                                    <input type="text" id="duedate-field" class="form-control" onchange="removeInvSnack(this)" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time required placeholder="Due date" required />
                                                    <div class="invalid-tooltip" id="subtask-duedate-InvField">Sub task due date should not be empty!</div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <label for="subtask-category" class="form-label requiredField">Category</label>
                                                    <select class="form-control" onchange="removeInvSnack(this)" data-choices data-choices-search-true id="subtask-category" required>
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        include './php/connection.php';
                                                        $query = "SELECT * FROM `subtask_category`";
                                                        $result = $con->query($query);
                                                        if ($result->num_rows > 0) {
                                                            while ($optionData = $result->fetch_assoc()) {
                                                                $options = $optionData['Sub_Category'];
                                                                $Subtask_CatID = $optionData['ID'];
                                                        ?>
                                                                <option value="<?php echo $Subtask_CatID; ?>"><?php echo $options; ?></option>
                                                        <?php }
                                                        } ?>
                                                        <?php mysqli_close($con); ?>
                                                    </select>
                                                    <div class="invalid-tooltip" id="subtask-category-InvField">Sub task category should not be empty!</div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <label for="priority-field" class="form-label requiredField">Category</label>
                                                    <select class="form-control" onchange="removeInvSnack(this)" data-choices data-choices-search-true id="priority-field" required>
                                                        <option value="">Select Priority</option>
                                                        <?php
                                                        include './php/connection.php';
                                                        $query = "SELECT * FROM `subtask_priority`";
                                                        $result = $con->query($query);
                                                        if ($result->num_rows > 0) {
                                                            while ($optionData = $result->fetch_assoc()) {
                                                                $options = $optionData['Sub_Priority'];
                                                                $Subtask_PriID = $optionData['ID'];
                                                        ?>
                                                                <option value="<?php echo $Subtask_PriID; ?>"><?php echo $options; ?></option>
                                                        <?php }
                                                        } ?>
                                                        <?php mysqli_close($con); ?>
                                                    </select>
                                                    <div class="invalid-tooltip" id="subtask-priority-InvField">Sub task category should not be empty!</div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="mb-3 col-lg-12">
                                                <div class="position-relative">
                                                    <label class="form-label requiredField">Sub Task Description</label>
                                                    <div id="ckeditor-classic-SubTaskDescription" class="" oninput="removeInvSnack(this)">

                                                    </div>
                                                    <div class="invalid-tooltip" id="SubTaskDescriptionInvDiv">Sub Task description should not be empty!</div>
                                                </div>
                                            </div>
                                            <!--end col-->


                                            <div class="col-lg-6 assigneeReporterDD">
                                                <div class="position-relative">
                                                    <label for="assignee-field" class="form-label requiredField">Assign To</label>
                                                    <select class="form-control" onchange="removeInvSnack(this)" data-choices data-choices-search-true id="assignee-field" required>
                                                        <option value="">Select</option>
                                                        <?php
                                                        include './php/connection.php';
                                                        $projectID = $_GET['pid'];
                                                        $query = "SELECT ed.EmpName, ed.ID
                                                        FROM employeedata ed
                                                        JOIN projectdata pd ON FIND_IN_SET(ed.ID, REPLACE(pd.assigned_emp, ' ', '')) > 0
                                                        WHERE pd.SrNo = $projectID";
                                                        $result = $con->query($query);
                                                        if ($result->num_rows > 0) {
                                                            while ($optionData = $result->fetch_assoc()) {
                                                                $options = $optionData['EmpName'];
                                                                $EmpID = $optionData['ID'];
                                                        ?>
                                                                <option value="<?php echo $EmpID; ?>"><?php echo $options; ?></option>
                                                        <?php }
                                                        } ?>
                                                        <?php mysqli_close($con); ?>
                                                    </select>
                                                    <div class="invalid-tooltip" id="subtask-assignee-InvField">Please select Assignee!</div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6 assigneeReporterDD">
                                                <div class="position-relative">
                                                    <label for="reporter-field" class="form-label requiredField">Report To</label>
                                                    <select class="form-control" onchange="removeInvSnack(this)" data-choices data-choices-search-true id="reporter-field" onchange="toggleSelectedOption()" required>
                                                        <option value="">Select</option>
                                                        <?php
                                                        include './php/connection.php';
                                                        $projectID = $_GET['pid'];
                                                        $query = "SELECT ed.EmpName, ed.ID
                                                        FROM employeedata ed
                                                        JOIN projectdata pd ON FIND_IN_SET(ed.ID, REPLACE(pd.assigned_emp, ' ', '')) > 0
                                                        WHERE pd.SrNo = '$projectID'";
                                                        $result = $con->query($query);
                                                        if ($result->num_rows > 0) {
                                                            while ($optionData = $result->fetch_assoc()) {
                                                                $options = $optionData['EmpName'];
                                                                $EmpID = $optionData['ID'];
                                                        ?>
                                                                <option value="<?php echo $EmpID; ?>"><?php echo $options; ?></option>
                                                        <?php }
                                                        } ?>
                                                        <?php mysqli_close($con); ?>
                                                    </select>
                                                    <div class="invalid-tooltip" id="subtask-reporter-InvField">Please select reporter!</div>
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
                                            <button type="button" class="btn btn-success d-none" id="subtask-edit-btn">Update Task</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end modal-->

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
        function removeInvSnack(thisParamerter) {
            $(thisParamerter).find('invalid-tooltip').css('diplay', 'none')
        }



        function toggleSelectedOption() {
            var selectedOption = $("#assignee-field").val();

            if ($("#reporter-field").val() == selectedOption || selectedOption == '') {
                if (selectedOption == '') {
                    $('#subtask-reporter-InvField').html('Please select assignee first!')
                } else {
                    $('#subtask-reporter-InvField').html('Please select another employee as a reporter!')
                }
                $('#subtask-reporter-InvField').css('display', 'block')
            } else {
                $('#subtask-reporter-InvField').html('Please select reporter!')
                $('#subtask-reporter-InvField').css('display', 'none')
            }
        }


        $('#subtaskaddform').on('submit', function(event) {
            event.preventDefault();

            var isValid = true; // Initialize a flag to track validation

            if ($('#priority-field').val() == '') {
                $('#subtask-priority-InvField').css('display', 'block');
                isValid = false; // Set the flag to false if validation fails
            } else {
                $('#subtask-priority-InvField').css('display', 'none');
            }
            if ($('#duedate-field').val() == '') {
                $('#subtask-duedate-InvField').css('display', 'block');
                isValid = false;
            } else {
                $('#subtask-duedate-InvField').css('display', 'none');
            }
            if ($('#subtask-category').val() == '') {
                $('#subtask-category-InvField').css('display', 'block');
                isValid = false;
            } else {
                $('#subtask-category-InvField').css('display', 'none');
            }
            var DescriptionEditorContent = DescriptionEditor.getData();
            if (DescriptionEditorContent == '') {
                $('#SubTaskDescriptionInvDiv').css('display', 'block');
                isValid = false;
            } else {
                $('#SubTaskDescriptionInvDiv').css('display', 'none');
            }
            if ($('#assignee-field').val() == '') {
                $('#subtask-assignee-InvField').css('display', 'block');
                isValid = false;
            } else {
                $('#subtask-assignee-InvField').css('display', 'none');
            }
            if ($('#reporter-field').val() == '') {
                $('#subtask-reporter-InvField').css('display', 'block');
                isValid = false;
            } else {
                $('#subtask-reporter-InvField').css('display', 'none');
            }
            if ($('#assignee-field').val() == $('#reporter-field').val()) {
                $('#subtask-reporter-InvField').css('display', 'block');
                $('#subtask-reporter-InvField').html('Please select another employee as a reporter!')
                isValid = false;
            } else {
                $('#subtask-reporter-InvField').css('display', 'none');
            }

            if (isValid) {
                SaveSubTaskData();
            }
        });

        function SaveSubTaskData() {
            //body
            Swal.fire({
                title: 'Create?',
                text: 'Would you like to create this Sub Task?',
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
                        url: './php/AddNewSubtask.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            pid: '<?php echo $_GET['pid']; ?>',
                            tid: '<?php echo $_GET['tid']; ?>',
                            subtasknm: $('#SubtaskName-field').val(),
                            subtaskpri: $('#priority-field').val(),
                            subtaskDue: $('#duedate-field').val(),
                            subtaskcategory: $('#subtask-category').val(),
                            subtaskDescription: DescriptionEditorContent,
                            assignee: $('#assignee-field').val(),
                            reporter: $('#reporter-field').val(),
                        },
                        success: function(result) {
                            if (result.success) {

                                var subtaskName = $("#SubtaskName-field").val();
                                var subtaskduedate = moment($("#duedate-field").val()).format('D MMM, YYYY hh:mm A');
                                var adminName = '<?php echo $Uname; ?>';
                                var assigneeName = $("#assignee-field").text();
                                var assigneeID = $("#assignee-field").val();
                                var reporterName = $('#reporter-field').text();
                                var reporterID = $("#reporter-field").val();

                                $.get("./Email/email_subtaskadd.html", function(htmlCode) {
                                    htmlCode = htmlCode.replace("[Task Name]", subtaskName)
                                        .replace("[Task Due]", subtaskduedate)
                                        .replace("[Employee Name]", assigneeName)
                                        .replace("[Report Person Name]", reporterName)
                                        .replace("[Name of Report Person/Team Leader]", reporterName)
                                        .replace("[Admin Name]", '<?php echo $Uname; ?>')
                                        .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/pages-login.html");
                                    var EmailBody = htmlCode;

                                    $.ajax({
                                        url: "./Email/SendMail.php",
                                        method: 'POST',
                                        type: 'JSON',
                                        data: {
                                            email: 'abc@20gmail.com',
                                            subject: 'A new task has been assigned to you !',
                                            body: EmailBody,
                                            assigneeID: assigneeID
                                        },
                                        success: function(result) {
                                            $.get("./Email/email_reporter_mail.html", function(htmlCode) {
                                                htmlCode = htmlCode.replace("[Task Name]", subtaskName)
                                                    .replace("[Task Due]", subtaskduedate)
                                                    .replace("[Employee Name]", reporterName)
                                                    .replace("[assigned person Name]", assigneeName)
                                                    .replace("[Assigned Person Name]", assigneeName)
                                                    .replace("[Admin Name]", '<?php echo $Uname; ?>')
                                                    .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/pages-login.html");
                                                var EmailBody = htmlCode;
                                                $.ajax({
                                                    url: "./Email/SendMail.php",
                                                    method: 'POST',
                                                    type: 'JSON',
                                                    data: {
                                                        email: 'abc@20gmail.com',
                                                        subject: 'You have been assigned as a reporter !',
                                                        body: EmailBody,
                                                        assigneeID: reporterID
                                                    },
                                                    success: function(result) {
                                                        $.get("./Email/email_admin_subtaskadded.html", function(htmlCode) {
                                                            htmlCode = htmlCode
                                                                .replace("[Admin Name]", '<?php echo $Uname; ?>')
                                                                .replace("[reporter name]", reporterName)
                                                                .replace("[Reporter Person Name]", reporterName)
                                                                .replace("[Task Name]", subtaskName)
                                                                .replace("[Task Due]", subtaskduedate)
                                                                .replace("[assign person name]", assigneeName)
                                                                .replace("[Assigned Person Name]", assigneeName)
                                                                .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/pages-login.html");
                                                            var EmailBody = htmlCode;
                                                            $.ajax({
                                                                url: "./Email/SendMail.php",
                                                                method: 'POST',
                                                                type: 'JSON',
                                                                data: {
                                                                    email: 'abc@20gmail.com',
                                                                    subject: 'New subtask is created !',
                                                                    body: EmailBody,
                                                                    assigneeID: '<?php echo $Admin_id; ?>'
                                                                },
                                                                success: function(result) {
                                                                    // mail sent
                                                                }
                                                            })
                                                        })
                                                    }
                                                })
                                            })
                                        }
                                    })
                                })
                                ShowSubtasks();
                                $('#showModal').modal('hide')
                                Swal.fire(
                                    "Added",
                                    "Sub-Task added successfully!",
                                    "success");
                                ShowNotifications()
                                $('#noti_count').addClass('flicker-element')
                                setTimeout(() => {
                                    $('#noti_count').removeClass('flicker-element')
                                }, 6000);

                            }
                        }
                    })


                }
            });
        }
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize CKEditor 5
            ClassicEditor
                .create(document.querySelector('#ckeditor-classic-SubTaskDescription'))
                .then(newEditor => {
                    DescriptionEditor = newEditor; // Save the editor instance
                })
                .catch(error => {
                    console.error(error);
                });
        })
        GetTaskData()

        function GetTaskData() {
            $.ajax({
                url: './php/GetTaskData.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    tid: '<?php echo $_GET['tid']; ?>',
                },
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(ind, it) {

                        $('#task-title').html(it.Task_name);
                        $('#task-createdby').html(it.EmpName);
                        $('#task-createddate').html(moment(it.TaskCreatedDate).format('D MMM, YYYY hh:mm A'));
                        $('#task-duedate').html(moment(it.Task_Due).format('D MMM, YYYY hh:mm A'));
                        $('#task-priority').html(it.priorityOfTask);
                        $('#task-description').html(it.Task_description);
                    })




                }
            })
        }

        function DeleteSubtask(idOfSubtask) {
            $('#delete-record').on('click', function() {
                $.ajax({
                    url: './php/RemoveSubtask.php',
                    dataType: 'JSON',
                    type: 'POST',
                    data: {
                        rowID: idOfSubtask,
                    },
                    success: function(dataread) {
                        if (dataread.success) {
                            console.log("Deleted successfully !");
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                html: 'Subtask deleted successfully !',
                                confirmButtonText: 'ok',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                ShowSubtasks();
                                $('#deleteOrder').modal('hide')
                            })

                        }
                    }
                })
            })
        }

        ShowSubtasks();
        var currentPage = 1; // Initialize current page as 1
        var rowsPerPage = 10;

        function ShowSubtasks() {
            $('#SubTaskTable').html('');
            $.ajax({
                url: './php/subtaskshow.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    pid: '<?php echo $_GET['pid']; ?>',
                    tid: '<?php echo $_GET['tid']; ?>',
                },
                success: function(data) {
                    // console.log(data);
                    var backlogCount = 0;
                    var InprogressCount = 0;
                    var testingCount = 0;
                    var CompletedCount = 0;
                    updatePagination(data.length);
                    showRowsForPage(currentPage);
                    var tbody = $('#SubTaskTable');
                    // console.log(data.success);
                    if (data.success == "no records found") {
                        $('#AllSubtasksCount').html('ALL (' + 0 + ')')
                        $('.noresult').css('display', 'block');

                    } else {
                        $('.noresult').css('display', 'none');
                        $('#AllSubtasksCount').html('ALL (' + data.length + ')')

                        var srno = 1;
                        $.each(data, function(ind, item) {
                            backlogCount += Number(item.BacklogCount);
                            InprogressCount += Number(item.InProgressCount);
                            testingCount += Number(item.TestingCount);
                            CompletedCount += Number(item.CompletedCount);

                            var row = `<tr>
                                                <td class="SrNo text-end"><a href="#" class="fw-medium link-primary Srnumber">${srno++}</a></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 sub_tasks_name">${item.subtaskname}</div>
                                                        <div class="flex-shrink-0 ms-4">
                                                            <ul class="list-inline tasks-list-menu mb-0">
                                                                <li class="list-inline-item"><a href="sub-tasks-details.php?subid=${item.subtask_ID}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a></li>
                                                                <li class="list-inline-item"><a class="edit-item-btn" href="#showModal" onclick="EditSubtaskData(${item.subtask_ID})" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a></li>
                                                                <li class="list-inline-item">
                                                                    <a class="remove-item-btn" data-bs-toggle="modal" onclick="DeleteSubtask(${item.subtask_ID})" href="#deleteOrder">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="Created_by_name">${item.CreatedByName}</td>

                                                <td class="assignedto">
                                                    <div class="avatar-group">
                                                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="${item.AssigneeName}">
                                                            <img src="${item.ProfileImageOfAssignee == null ? 'assets/images/users/avatar-blank.jpg' : item.ProfileImageOfAssignee}" alt="" class="rounded-circle avatar-xxs" />
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="Reporter_name">
                                                    <div class="avatar-group">
                                                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="${item.ReporterName}">
                                                            <img src="${item.ProfileImageOfReporter == null ? 'assets/images/users/avatar-blank.jpg' : item.ProfileImageOfReporter}" alt="" class="rounded-circle avatar-xxs" />
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="due_date">${moment(item.subtaskDue).format('D MMM, YYYY hh:mm A')}</td>

                                                <td class="Created_date">${moment(item.Created_Date).format('D MMM, YYYY hh:mm A')}</td>
                                                <td class="status"><span class="badge badge-soft-secondary text-uppercase statusBadge">${item.Subtasks_Stage_status}</span></td>
                                                <td class="priority"><span class="badge bg-danger text-uppercase priorityBadge">${item.SubTasksPriority}</span></td>
                                            </tr>`;

                            tbody.append(row);
                        });
                    }

                    $('#statusDD1').html('Backlog (' + backlogCount + ')')
                    $('#statusDD2').html('In Progress (' + InprogressCount + ')')
                    $('#statusDD3').html('Testing (' + testingCount + ')')
                    $('#statusDD4').html('Completed (' + CompletedCount + ')')

                }
            })
        }

        function updatePagination(totalRows) {
            var totalPages = Math.ceil(totalRows / rowsPerPage);

            $('.pagination-prev').toggleClass('disabled', currentPage === 1);
            $('.pagination-next').toggleClass('disabled', currentPage === totalPages);

            $('.listjs-pagination').empty();

            for (var i = 1; i <= totalPages; i++) {
                var pageLink = $('<li class="page-item"><a class="page-link">' + i + '</a></li>');

                if (i === currentPage) {
                    pageLink.addClass('active');
                }

                pageLink.find('a').click(function() {
                    currentPage = parseInt($(this).text());
                    showRowsForPage(currentPage);
                    updatePagination(totalRows);
                });

                $('.listjs-pagination').append(pageLink);
            }

            // Add event listeners for Previous and Next buttons
            $('.pagination-prev').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    showRowsForPage(currentPage);
                    updatePagination(totalRows);
                }
            });

            $('.pagination-next').click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    showRowsForPage(currentPage);
                    updatePagination(totalRows);
                }
            });
        }

        function showRowsForPage(page) {
            var startIndex = (page - 1) * rowsPerPage;
            var endIndex = startIndex + rowsPerPage - 1;

            $('#SubTaskTable tr').hide();
            $('#SubTaskTable tr').slice(startIndex, endIndex + 1).show();
        }
        $('#Addnewsubtaskbtn').on('click', function() {
            $('.assigneeReporterDD').removeClass('d-none')
            $('#SubtaskName-field').val('')
            $('#duedate-field').val('')
            $('#subtask-category').val('')
            DescriptionEditor.setData('');
            $('#assignee-field').val('')
            $('#reporter-field').val('')
            $('#add-btn').removeClass('d-none')
            $('#subtask-edit-btn').addClass('d-none')
            $('#subtaskaddform').removeClass('was-validated')
        })

        function EditSubtaskData(subtasksid) {
            $('.assigneeReporterDD').addClass('d-none')
            $.ajax({
                url: './php/GetRespectiveSubtaskDetails.php',
                dataType: 'JSON',
                type: 'POST',
                data: {
                    rowID: subtasksid,
                },
                success: function(dataRecived) {
                    console.log(dataRecived);
                    $.each(dataRecived, function(index, item) {
                        $('#SubtaskName-field').val(item.subtaskname)
                        $('#duedate-field').val(item.subtaskDue)
                        $('#priority-field').val(2)

                        $('#subtask-category').val(item.Category)
                        DescriptionEditor.setData(item.subtaskDescription);

                        var $option = $('<option selected>');
                        $option.val(item.empid).text('abcd')
                        $('#assignee-field').append($option)

                        $('#reporter-field').val(item.empid)

                        $('#add-btn').addClass('d-none')
                        $('#subtask-edit-btn').removeClass('d-none')
                    })
                }
            })
        }

        function applyFilters() {
            var selectedStatus = $('#idStatus').val();
            var startDate = $('#demo-datepicker').val();
            var endDate = $('#demo-datepicker').data('date-range-date');

            $('#SubTaskTable tr').each(function() {
                var row = $(this);
                var status = row.find('.status').text().toLowerCase();
                var dueDate = row.find('.due_date').text();

                var matchStatus = selectedStatus === '' || selectedStatus === 'All' || status === selectedStatus.toLowerCase();
                var matchDate = (!startDate || !endDate) || (startDate <= dueDate && dueDate <= endDate);

                row.toggle(matchStatus && matchDate);
            });
        }

        // Attach the applyFilters function to the "Filter" button click event
        $('#FilterBtn').click(function() {
            applyFilters();
        });

        // Attach keyup event to search input
        $('.search').keyup(function() {
            var searchInput = $(this).val().toLowerCase();

            $('#SubTaskTable tr').each(function() {
                var row = $(this);
                var columns = row.find('td'); // Select all columns in the row

                var matchSearch = false;
                columns.each(function() {
                    var columnText = $(this).text().toLowerCase();
                    if (columnText.indexOf(searchInput) !== -1) {
                        matchSearch = true;
                        return false; // Exit loop early if a match is found
                    }
                });

                row.toggle(matchSearch);
            });
        });
    </script>
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

    <!-- titcket init js -->
    <script src="assets/js/pages/tasks-list.init.js"></script>



    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <!-- ckeditor -->
    <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <!-- form validation setup  -->
    <script src="assets/js/pages/form-validation.init.js"></script>

</body>

</html>