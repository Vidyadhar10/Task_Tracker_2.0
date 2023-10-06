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
    <title>Create Project | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css" />

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
                                <h4 class="mb-sm-0">Create Project</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                        <li class="breadcrumb-item active">Create Project</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <form class="g-3 needs-validation" id="ProjAddForm" novalidate>
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="mb-3 position-relative col-lg-8">
                                                <label class="form-label requiredField" for="project-title-input">Project Title</label>
                                                <input type="text" class="form-control" id="project-title-input" oninput="GenerateKey(),isContainQuote()" placeholder="Enter project title" required>
                                                <div class="invalid-tooltip" id="project-title-invalid-tooltip">Project title should not be empty!</div>
                                            </div>
                                            <div class="mb-3 col-lg-4 position relative">
                                                <div>
                                                    <label for="Project-key" class="form-label requiredField">Project Key</label>
                                                    <input type="text" class="form-control" id="Project-key" placeholder="Auto Generated project key" disabled required>
                                                    <div class="invalid-tooltip" id="PKinvalidTt">Project key should not be empty!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label requiredField" for="project-logo-img">Project Logo/Image</label>
                                            <input class="form-control" id="project-logo-img" type="file" accept="image/png, image/gif, image/jpeg" required>
                                            <div class="invalid-tooltip">Project logo should not be empty!</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 ">
                                                <div class="mb-3 mb-lg-0 position-relative">
                                                    <label for="choices-priority-input" class="form-label requiredField">Priority</label>
                                                    <select class="form-select" data-choices data-choices-search-true onchange="makeValid()" id="choices-priority-input" required>
                                                        <option value="" selected>select</option>
                                                        <?php
                                                        include './php/connection.php';
                                                        $query = "SELECT * FROM `project_priority`";
                                                        $result = $con->query($query);
                                                        if ($result->num_rows > 0) {
                                                            while ($optionData = $result->fetch_assoc()) {
                                                                $options = $optionData['ProjectPriority'];
                                                                $proj_priorityID = $optionData['ID'];
                                                        ?>
                                                                <option value="<?php echo $proj_priorityID; ?>"><?php echo $options; ?></option>
                                                        <?php }
                                                        } ?>
                                                        <?php mysqli_close($con); ?>
                                                    </select>
                                                    <div class="invalid-tooltip" id="PriorityInvalidDiv">Project priority should not be empty!</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="position-relative">
                                                    <label for="datepicker-startDate-input" class="form-label requiredField">Start Date</label>
                                                    <input type="text" class="form-control" id="datepicker-startDate-input" onchange="makeValid()" placeholder="Enter project start date" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time required>
                                                    <div class="invalid-tooltip" id="StartDateInvalidDiv">Project start date should not be empty!</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="position-relative">
                                                    <label for="datepicker-enddate-input" class="form-label requiredField">End Date</label>
                                                    <input type="text" class="form-control" id="datepicker-enddate-input" onchange="makeValid()" placeholder="Enter project end date" required data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time>
                                                    <div class="invalid-tooltip" id="EndDateInvalidDiv">Project end date should not be empty!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label requiredField">Project Description</label>
                                            <div id="ckeditor-classic-description">

                                            </div>
                                            <div class="invalid-tooltip Project-description-tooltip" id="ProjDescriptionInvDiv">Project description should not be empty!</div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label requiredField">Project Mission</label>
                                            <div id="ckeditor-classic-mission">

                                            </div>
                                            <div class="invalid-tooltip Project-description-tooltip" id="ProjectMissionInvDiv">Project description should not be empty!</div>
                                        </div>


                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->


                                <!-- end card -->
                                <div class="text-end mb-4">
                                    <!-- <button type="button" class="btn btn-danger w-sm">Cancel</button> -->
                                    <button type="button" class="btn btn-secondary w-sm" onclick="resetProjectForm()">Reset</button>
                                    <button type="submit" class="btn btn-success w-sm">
                                        Create
                                    </button>
                                </div>
                            </div>

                            <!-- end col -->
                            <div class="col-lg-4">

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Attached files</h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <p class="text-muted">Add Attached files here.</p>

                                            <div class="dropzone">
                                                <div class="fallbac" style="visibility: hidden;">
                                                    <input name="file" type="file" name="Attachments[]" id="AttachmentsFileInput" multiple>
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                    </div>

                                                    <h5>Drop files here or click to upload.</h5>
                                                </div>
                                            </div>

                                            <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                <li class="mt-2" id="dropzone-preview-list">
                                                    <!-- This is used as the file preview template -->
                                                    <div class="border rounded">
                                                        <div class="d-flex p-2">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm bg-light rounded">
                                                                    <img src="#" alt="Project-Image" data-dz-thumbnail class="img-fluid rounded d-block" />
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="pt-1">
                                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-3">
                                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <!-- end dropzon-preview -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Employees</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="mb-3">
                                            <label for="choices-lead-input" class="form-label">Team Lead</label>
                                            <select class="form-select" data-choices data-choices-search-false id="choices-lead-input">
                                                <option value="Brent Gonzalez" selected>Brent Gonzalez</option>
                                                <option value="Darline Williams">Darline Williams</option>
                                                <option value="Sylvia Wright">Sylvia Wright</option>
                                                <option value="Ellen Smith">Ellen Smith</option>
                                                <option value="Jeffrey Salazar">Jeffrey Salazar</option>
                                                <option value="Mark Williams">Mark Williams</option>
                                            </select>
                                        </div> -->

                                        <div>
                                            <label class="form-label requiredField">Add Employees</label>
                                            <div class="avatar-group" id="selectedEmployees">
                                                <!-- <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">
                                                    <div class="avatar-xs">
                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </a> -->
                                                <!--  <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Sylvia Wright">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle bg-secondary">
                                                            S
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">
                                                    <div class="avatar-xs">
                                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </a>
                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Add Members">
                                                    <div class="avatar-xs" data-bs-toggle="modal" data-bs-target="#inviteMembersModal">
                                                        <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                            +
                                                        </div>
                                                    </div>
                                                </a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </form>
                    <!--  -->
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
                    <button type="button" class="btn btn-success w-xs" onclick="showSelectedEmp()">Done</button>
                </div>
            </div>
            <!-- end modal-content -->
        </div>
        <!-- modal-dialog -->
    </div>
    <!-- end modal -->


    <!-- project successfully added Modal -->
    <div class="modal fade" id="ProjectAddedSuccessfullyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                    </lord-icon>

                    <div class="mt-4">
                        <h4 class="mb-3">Project added auccessfully!</h4>
                        <!-- <p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p> -->
                        <div class="hstack gap-2 justify-content-center">
                            <a href="javascript:void(0);" class="btn btn-primary fw-medium" onclick="resetProjectForm(),topFunction()" data-bs-dismiss="modal"><i class="ri-add-line me-1 align-middle"></i> Add New</a>
                            <a href="#" class="btn btn-success" onclick="window.location.href=`projects-list.php`">Go to the project list <i class="ri-arrow-right-line me-1 align-end"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->
    <!-- screen loader  -->
    <div class="loader-container d-none" id="loader-on-proj-add">
        <span class="loader"></span>
    </div>
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

    <!-- ckeditor -->
    <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

    <!-- dropzone js -->
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <!-- project-create init -->
    <script src="assets/js/pages/project-create.init.js"></script>
    <!-- form validation setup  -->
    <script src="assets/js/pages/form-validation.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <!-- jquery cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- master js file  -->
    <script src="./assets/js/master.js"></script>
    <!-- moment.js cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- sweet alert aimation cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <script>
        function resetProjectForm() {
            location.reload()
        }

        var filterData;
        ShowEmployeeList();
        var defaultString = `<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Add Members">
                                                    <div class="avatar-xs" data-bs-toggle="modal" data-bs-target="#inviteMembersModal">
                                                        <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                            +
                                                        </div>
                                                    </div>
                                                </a>`;
        $('#selectedEmployees').append(defaultString);

        function showSelectedEmp() {
            $('#inviteMembersModal').modal('hide');
            $('#selectedEmployees').html('');
            $.each(filterData, function(index, item) {
                if (empIDArray.includes(item.ID)) {
                    // console.log(item.ID);
                    var employeeStringSelected = `<a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="${String(item.EmpName)}">
                                                                <div class="avatar-xs">
                                                                    <img src="${item.ProfilePhoto == null ? 'assets/images/users/avatar-blank.jpg' : item.ProfilePhoto}" alt="" class="rounded-circle img-fluid">
                                                                </div>
                                                            </a>`;
                    $('#selectedEmployees').append(employeeStringSelected);
                }
            })

            $('#selectedEmployees').append(defaultString);

        }
        $(document).ready(function() {
            $('#inviteMembersModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        function ShowEmployeeList() {
            $.ajax({
                url: './php/GetAllEmployees.php',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    filterData = $.grep(data, function(item) {
                        var empnm = item.EmpName;
                        return empnm;
                    });
                    $.each(data, function(index, item) {
                        var employeeString = ` <div class="d-flex align-items-center EmpRowDiv">
                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                        <img src="${item.ProfilePhoto==null ? 'assets/images/users/avatar-blank.jpg' : item.ProfilePhoto}" alt="" class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 d-flex"><a href="#" class="text-body d-block fw-bold">${item.EmpName}</a> &nbsp;<span style="font-style:italic;">(${item.Position})</span></h5>
                                                    </div>
                                                                                                       
                                                    <div class="flex-shrink-0">
                                                        <button type="button" onclick="SetSelectedEmployeeArray('${item.ID}', this.id)" id="EmpAddBtn${item.ID}" class="btn btn-light btn-sm">Add</button>
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
        var empIDArray = [];

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

        function isContainQuote(params) {
            var nameofProj = $('#project-title-input').val();
            var specialchar = /[^\w\s]/g;

            if (specialchar.test(nameofProj)) {
                $('#project-title-invalid-tooltip').html("Project name should not contain special characters!");
                $('#project-title-input').addClass('is-invalid');
                $('#createBtn').prop('disabled', true);
                // $('#projectDetails').addClass('was-validated');
            } else {
                $('#project-title-input').removeClass('is-invalid');
                $('#createBtn').prop('disabled', false);
                // $('#projectDetails').removeClass('was-validated');
                $('#project-title-invalid-tooltip').html("Please, enter your project name!");
            }
        }

        function GenerateKey() {
            var inputValue = document.getElementById("project-title-input").value;
            var text = "";
            var wordArray = inputValue.split(' ');
            for (i = 0; i < wordArray.length; i++) {
                text += wordArray[i].substr(0, 1).toUpperCase()
            }
            if (text.length == 1) {
                text += wordArray[0].substr(1, 1)
            }
            // AJAX Jquery to get Unique ID
            $.ajax({
                url: './php/GenerateUniqueID.php',
                dataType: 'json',
                success: function(data) {
                    data = data + 1;
                    text += '-' + data;
                }
            });
            // text=text.toUpperCase();
            document.getElementById("Project-key").value = text;
            checkProjectKeyExists(text);
        }

        function checkProjectKeyExists(ProjKey) {
            $.ajax({
                url: './php/CheckprojectkeyExists.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    ProjKey: ProjKey
                },
                success: function(result) {
                    if (result.success) {
                        $('#Project-key').prop('disabled', false);
                        $('#Project-key').addClass('is-invalid');
                        $('#PKinvalidTt').text('Please enter another project key!');
                        // $('#PKinvalidTt').css('display', 'block');

                    } else {
                        $('#Project-key').prop('disabled', true);
                        $('#Project-key').removeClass('is-invalid');
                        // $('#PKinvalidTt').css('display', 'none');
                    }
                }
            });

        }

        function CheckValidityFun() {
            if ($('#choices-priority-input').val() == '' ? ($('#PriorityInvalidDiv').css('display', 'block'), false) : true) {
                if ($('#datepicker-startDate-input').val() == '' ? ($('#StartDateInvalidDiv').css('display', 'block'), false) : true) {
                    if ($('#datepicker-enddate-input').val() == '' ? ($('#EndDateInvalidDiv').css('display', 'block'), false) : true) {
                        if (MissionEditor.getData() == '' ? ($('#ProjectMissionInvDiv').css('display', 'block'), false) : true) {
                            if (DescriptionEditor.getData() == '' ? ($('#ProjDescriptionInvDiv').css('display', 'block'), false) : true) {
                                if (empIDArray.length <= 0 ? NoEmpSelected() : true) {
                                    return true;
                                }
                            }

                        }
                    }

                }
            }
        }

        function NoEmpSelected() {
            Swal.fire({
                title: 'No employee selected!',
                text: 'Employee not selected yet!',
                icon: 'error',
                width: '400px',
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                buttonsStyling: !1,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        }
        $('#ProjAddForm').on("submit", function(event) {
            event.preventDefault();
            $('#datepicker-enddate-input').val() == '' ? $('#EndDateInvalidDiv').css('display', 'block') : '';
            $('#datepicker-startDate-input').val() == '' ? $('#StartDateInvalidDiv').css('display', 'block') : '';

            if (!CheckValidityFun()) {
                event.preventDefault()
                topFunction()
                return false;
            }

            var DescriptionEditorContent = DescriptionEditor.getData();
            var MissionEditorContent = MissionEditor.getData();
            Swalcall();

        });

        function Swalcall() {
            //body
            Swal.fire({
                title: 'Create?',
                text: 'Would you like to create this Project?',
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
                    var formData = new FormData();
                    var DescriptionEditorContent = DescriptionEditor.getData();
                    var MissionEditorContent = MissionEditor.getData();
                    var logoImageInput = $('#project-logo-img')[0]; // Get the actual DOM element
                    formData.append('InputLogoImage', logoImageInput.files[0]);
                    // formData.append('InputLogoImage', $('#project-logo-img').files[0]);
                    formData.append('inputProjName', $('#project-title-input').val());
                    formData.append('inputProjKey', $('#Project-key').val());
                    formData.append('inputProjStart', $('#datepicker-startDate-input').val());
                    formData.append('inputProjEnd', $('#datepicker-enddate-input').val());
                    formData.append('projectPriority', $('#choices-priority-input').val());
                    formData.append('inputProjDescription', DescriptionEditorContent);
                    formData.append('mission', MissionEditorContent);
                    formData.append('SelectedEmps', empIDArray);
                    var attachmentsInput = $('#AttachmentsFileInput')[0];
                    // console.log(attachmentsInput);
                    if (attachmentsInput) {

                        var files = $('#AttachmentsFileInput')[0].files;
                        for (var i = 0; i < files.length; i++) {
                            formData.append('Attachments[]', files[i]);
                        }
                    } else {
                        console.log('not found!');
                    }

                    $.ajax({
                        url: "./php/projectAdd.php",
                        type: "POST",
                        dataType: 'JSON',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.success) {
                                $('#ProjectAddedSuccessfullyModal').modal('show')
                                ShowNotifications()
                                $('#noti_count').addClass('flicker-element')
                                setTimeout(() => {
                                    $('#noti_count').removeClass('flicker-element')
                                }, 6000);
                                sendEmailinBG()
                            }
                        }
                    })


                }
            });
        }

        function sendEmailinBG() {
            $.get("./Email/email_assigned_project.php", function(htmlCode) {
                var inputStartDate = moment($("#datepicker-startDate-input").val()).format('D MMM, YYYY hh:mm A');

                htmlCode = htmlCode.replace("[Project Name]", $("#project-title-input").val())
                    .replace("[Project Name]", $("#project-title-input").val())
                    .replace("[Start Date]", inputStartDate)
                    .replace("[Admin Name]", '<?php echo $Uname; ?>')
                    .replace("[Admin Name]", '<?php echo $Uname; ?>')
                    .replace("[Admin Name]", '<?php echo $Uname; ?>')
                    .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/pages-login.html");
                var EmailBody = htmlCode;
                var empsChecked = empIDArray;
                $.ajax({
                    url: "./Email/SendMail.php",
                    method: 'POST',
                    type: 'JSON',
                    async: false,
                    data: {
                        email: 'abc@gmail.com',
                        subject: 'You are assigned to a Project',
                        body: EmailBody,
                        SelectedEmps: JSON.stringify(empsChecked)
                    },
                    success: function(result) {
                        // console.log(result);
                    }
                })
            })
        }

        function makeValid() {
            $('#PriorityInvalidDiv').css('display', 'none');
            $('#StartDateInvalidDiv').css('display', 'none');
            $('#EndDateInvalidDiv').css('display', 'none');
        }
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize CKEditor 5
            ClassicEditor
                .create(document.querySelector('#ckeditor-classic-mission'))
                .then(newEditor => {
                    MissionEditor = newEditor; // Save the editor instance
                })
                .catch(error => {
                    console.error(error);
                });
            ClassicEditor
                .create(document.querySelector('#ckeditor-classic-description'))
                .then(newEditor => {
                    DescriptionEditor = newEditor; // Save the editor instance
                })
                .catch(error => {
                    console.error(error);
                });
        })
    </script>
</body>

</html>