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
    <title>Attendance | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                <h4 class="mb-sm-0">Attendance</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Attendance</a></li>
                                        <li class="breadcrumb-item active">List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-3 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-16">Sheet Date</h5>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label>Sheet Date</label>
                                        <div class="input-group">
                                            <input type="text" id="sheet-date" class="form-control" data-provider="flatpickr" placeholder="Select date" required>
                                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                            <div class="invalid-feedback" id="sheet-date-inv-field">Please select sheet date!</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion accordion-flush filter-accordion">

                                    <div class="card-body border-bottom">
                                        <div class="row align-item-center">
                                            <div class="col">
                                                <button type="button" class="btn btn-danger w-100" id="show-attendance-btn"><i class="ri-eye-fill align-bottom me-1"></i> Show</button>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#attendance-modal"><i class="ri-add-fill align-bottom me-1"></i> Add new</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-xl-9 col-lg-8">
                            <div class="card" id="orderList">
                                <div class="card-header border-0">
                                    <div class="row align-items-center gy-3">
                                        <div class="col-sm">
                                            <h5 class="card-title mb-0">Attendance Sheet</h5>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-flex gap-1 flex-wrap">
                                                <button type="button" class="btn btn-success" id="exportButton">
                                                    <i class="ri-file-download-line align-bottom me-1"></i>
                                                    Export to XLSX
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border border-dashed border-end-0 border-start-0">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-xxl-5 col-sm-6">
                                                <div class="search-box">
                                                    <input type="text" class="form-control search" id="search-input" placeholder="Search for date">
                                                    <i class="ri-search-line search-icon"></i>
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
                                            <table class="table table-nowrap align-middle ScrollBarCss" id="employee-attendance-table">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th class="sort" data-sort="id">Sr No</th>
                                                        <th class="sort" data-sort="project_name">Project Title</th>
                                                        <th class="sort" data-sort="subtask_name">Subt-Tasks Name</th>
                                                        <th class="sort" data-sort="subtask_start_time">Subtask Start Time</th>
                                                        <th class="sort" data-sort="subtask_end_time">Subtask End Time</th>
                                                        <th class="sort" data-sort="total_hours">Total Hours</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">

                                                </tbody>
                                            </table>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                    <h5 class="mt-2">Sorry! No Record Found</h5>
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

                    </div>



                    <!-- Add New Event MODAL -->
                    <div class="modal fade" id="attendance-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                                <div class="modal-header p-3 bg-soft-info">
                                    <h5 class="modal-title" id="modal-title">Attendance</h5>
                                    <button type="button" class="btn-close" onclick="AttendanceFormReset()" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form class="needs-validation" id="attendance-form" novalidate>

                                        <div class="row event-form">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label>Sheet Date</label>
                                                    <div class="input-group">
                                                        <input type="text" id="form-sheet-date" class="form-control" data-provider="flatpickr" placeholder="Select date" required>
                                                        <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                        <div class="invalid-feedback" id="form-sheet-date-inv-field">Please select sheet date!</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label requiredField">Select Project</label>
                                                    <select class="form-control" name="employees-project" id="employees-project" required>
                                                        <option value="" selected>select</option>

                                                    </select>
                                                    <div class="invalid-feedback">Please select a project</div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label requiredField">Select Subtask</label>
                                                    <select class="form-control" name="employees-subtask" id="employees-subtask" required>
                                                        <option value="" selected>select</option>

                                                    </select>
                                                    <div class="invalid-feedback">Please select a subtask</div>
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label requiredField" for="work-start-time">Start Time</label>
                                                            <div class="input-group">
                                                                <input id="work-start-time" type="text" class="form-control" data-provider="timepickr" data-time-basic="true" placeholder="Select start time" required>
                                                                <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                            </div>
                                                            <div class="invalid-feedback">Please select the start time!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label requiredField" for="work-end-time">End Time</label>
                                                            <div class="input-group">
                                                                <input id="work-end-time" type="text" class="form-control" data-provider="timepickr" data-time-basic="true" placeholder="Select end time" required>
                                                                <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                            </div>
                                                            <div class="invalid-feedback" id="end-time-inv-field">Please select the end time!</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="work-hours">Total work hours</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="work-hours" id="work-hours" placeholder="" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <input type="hidden" id="eventid" name="eventid" value="" />
                                        </div>
                                        <!--end row-->
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-soft-danger" data-bs-dismiss="modal" onclick="AttendanceFormReset()" id="btn-close-attendance"><i class="ri-close-line align-bottom"></i>
                                                Close</button>
                                            <button type="submit" class="btn btn-success" id="btn-save-attendance">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- end modal-content-->
                        </div> <!-- end modal dialog-->
                    </div> <!-- end modal-->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <!-- Modal -->
            <div class="modal fade flip" id="deleteAttendanceRow" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-5 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                            <div class="mt-4 text-center">
                                <h4>You are about to delete a record ?</h4>
                                <p class="text-muted fs-15 mb-4">This action cannot be undone.</p>
                                <div class="hstack gap-2 justify-content-center remove">
                                    <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                        Cancel</button>
                                    <button class="btn btn-danger" id="delete-record">Yes,
                                        Delete It</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal -->

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
        $(document).ready(function() {
            $.ajax({
                url: './php/GetProjectName.php',
                dataType: 'json',
                type: 'POST',
                data: {
                    EmpsID: '<?php echo $Admin_id; ?>',
                },
                success: function(resProj) {
                    $.each(resProj, function(index, item) {
                        $('#employees-project').append($('<option>', {
                            value: item.projid
                        }).text(item.projnm));
                    })
                }
            })
        });

        $('#employees-project').on('change', function() {
            $.ajax({
                url: './php/GetSubtaskForTimesheet.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    selectedProj: $(this).val(),
                    EmpMobile: '<?php echo $Admin_mob; ?>'
                },
                success: function(data) {
                    $('#employees-subtask').empty();
                    $('#employees-subtask').append($('<option>', {
                        value: ''
                    }).text('select'));
                    $.each(data, function(index, item) {
                        $('#employees-subtask').append($('<option>', {
                            value: item.subtask_ID
                        }).text(item.subtaskname));
                    })
                }
            })
        })


        $('#work-end-time').on('change', function() {
            if ($('#work-start-time').val() > $(this).val()) {
                $('#end-time-inv-field').css('display', 'block')
                $('#end-time-inv-field').html('End time must be greater than start time!')
                $(this).val($('#work-start-time').val());


            } else {
                $('#end-time-inv-field').css('display', 'none')
                $('#end-time-inv-field').html('Please select the end time!')

                var format = 'HH:mm';
                var startDateTime = moment($('#work-start-time').val(), format);
                var endDateTime = moment($(this).val(), format);

                // Check if end time is before start time (crossed midnight)
                if (endDateTime.isBefore(startDateTime)) {
                    endDateTime.add(1, 'day');
                }
                var duration = moment.duration(endDateTime.diff(startDateTime));
                var hours = duration.asHours();
                var floatHours = duration.asMinutes() / 60;
                floatHours = floatHours.toFixed(2);

                // console.log(floatHours);
                $('#work-hours').val(floatHours);
            }
        });


        $('#sheet-date').on('change', function() {
            $('#sheet-date-inv-field').css('display', 'none')
        })
        $('#show-attendance-btn').on('click', function() {
            if ($('#sheet-date').val() != '') {
                showRecordsOnAddingNew($('#sheet-date').val())
            } else {
                $('#sheet-date-inv-field').css('display', 'block')
            }
        })

        function DownloadAttendance() {
            $('#exportButton').on('click', function() {
                // Get table data
                const table = $('#employee-attendance-table');
                const ws = XLSX.utils.table_to_sheet(table[0]);

                // Create a workbook with the data
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                // Save the workbook as XLSX file
                var empl_name = '<?php echo $Uname; ?>'
                XLSX.writeFile(wb, 'attendance_sheet_' + empl_name + '.xlsx');
            });
        }
        $('#attendance-form').on('submit', function() {
            event.preventDefault();
            var isFormValid = true;
            if ($('#form-sheet-date').val() == '') {
                isFormValid = false;
            }
            if ($('#employees-project').val() == '') {
                isFormValid = false;
            }
            if ($('#employees-subtask').val() == '') {
                isFormValid = false;
            }
            if ($('#work-start-time').val() == '') {
                isFormValid = false;
            }
            if ($('#work-end-time').val() == '' && $('#work-start-time').val() > $('#work-end-time').val()) {
                isFormValid = false;
            }
            if (isFormValid) {
                $.ajax({
                    url: './php/SaveTimeSheet.php',
                    dataType: 'JSON',
                    type: 'POST',
                    data: {
                        selectedProjectID: $('#employees-project').val(),
                        SubtasksID: $('#employees-subtask').val(),
                        startTime: moment($('#work-start-time').val(), 'HH:mm').format('hh:mm A'),
                        endTime: moment($('#work-end-time').val(), 'HH:mm').format('hh:mm A'),
                        Totalhrs: $('#work-hours').val(),
                        selectedDate: $('#form-sheet-date').val(),
                        uid: <?php echo $Admin_id; ?>
                    },
                    success: function(data) {
                        if (data.success) {
                            // console.log("Data is Saved!");
                            $('#attendance-modal').modal('hide')
                            showRecordsOnAddingNew($('#form-sheet-date').val())
                            localStorage.setItem('Form_Sheet_DT', $('#form-sheet-date').val())
                            AttendanceFormReset()
                        }
                    }

                })
            }
        })

        function AttendanceFormReset() {
            $('#attendance-form')[0].reset();
        }

        function showRecordsOnAddingNew(dateSelectedVal) {
            $.ajax({
                url: './php/GetTimesheetOnDate.php',
                dataType: 'json',
                type: 'POST',
                data: {
                    dateSelected: dateSelectedVal,
                    EmpsID: '<?php echo $Admin_id; ?>',
                },
                success: function(data) {

                    var srno = 1;
                    if (data.length <= 0) {
                        $('#employee-attendance-table tbody').empty();
                        $('.noresult').css('display', 'block');
                    } else {
                        $('#employee-attendance-table tbody').empty();
                        $('.noresult').css('display', 'none');
                        $.each(data, function(i, item) {
                            var trow = `<tr>
                                                <td class="id text-end"><a href="#" class="fw-medium link-primary">${srno++}</a></td>
                                                <td class="project_name">${item.ProjectName}</td>
                                                <td class="subtask_name">${item.subtaskname}</td>
                                                <td class="subtask_start_time">${item.Start_Time}</td>
                                                <td class="subtask_end_time">${item.End_Time}</td>
                                                <td class="total_hours text-end">${item.Total_Hours}</td>
                                                <td class="total_hours text-center">
                                                    <ul class="list-inline hstack gap-2 mb-0 d-flex justify-content-center align-items-center">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="Remove" onclick="RemoveRowIcon(${item.ID})">
                                                            <a class="text-danger d-inline-block remove-item-btn"
                                                                data-bs-toggle="modal" href="#deleteAttendanceRow">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>`;
                            $('#employee-attendance-table tbody').append(trow);

                        });
                        paginationWorking()
                        DownloadAttendance();
                    }
                }
            });
        }

        function paginationWorking() {
            $("#search-input").on("keyup", function() {
                var searchText = $(this).val().toLowerCase();
                $("#employee-attendance-table tbody tr").filter(function() {
                    // console.log(searchText);
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            const tableRows = $("#employee-attendance-table tbody tr");

            // Pagination initialization
            var itemsPerPage = 10;
            var currentPage = 1;
            var totalItems = $("#employee-attendance-table tbody tr").length;
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
                $("#employee-attendance-table tbody tr").hide().slice(startIndex, endIndex).show();
            }

            // Initial setup
            updatePagination();
            updateTableRows();
        }

        function RemoveRowIcon(recordID) {
            $('#delete-record').on('click', function() {
                $.ajax({
                    url: './php/RemoveTimesheetRow.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        rowID: recordID,
                    },
                    success: function(dataread) {
                        if (dataread.success) {
                            $('#deleteAttendanceRow').modal('hide');
                            Swal.fire(
                                'Deleted',
                                'The record has been successfully deleted.',
                                'success'
                            );
                            if ($('#sheet-date').val() != '') {
                                showRecordsOnAddingNew($('#sheet-date').val())
                            } else if (localStorage.getItem('Form_Sheet_DT')) {
                                showRecordsOnAddingNew(localStorage.getItem('Form_Sheet_DT'))
                            }
                        }
                    }
                })
            })

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