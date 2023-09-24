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
    <title>Leave details | Task Tracker</title>
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
                                <h4 class="mb-sm-0">Leave Details</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Leaves</a></li>
                                        <li class="breadcrumb-item active">Leave Details</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row ">
                        <div class="col-xxl-9">
                            <div class="card">
                                <!-- <div class="card-header  border-0">
                                    <div class="d-md-flex align-items-center">
                                        <h5 class="card-title mb-3 mb-md-0 flex-grow-1">Leave Applications</h5>
                                    </div>
                                </div> -->
                                <div class="card-body">
                                    <h5 class="mb-3">Reason</h5>

                                    <p class="text-muted mb-2" id="leave-reason">

                                    </p>


                                    <div class="card-body border border-dashed border-end-0 border-start-0">
                                        <form>
                                            <div class="row g-3 d-md-flex align-items-center">
                                                <div class="col-xxl-8 col-sm-6">
                                                    <div class="d-md-flex align-items-center">
                                                        <h5 class="card-title mb-md-0 flex-grow-1">Tasks during leave period</h5>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-sm-6">
                                                    <div class="search-box">
                                                        <input type="text" class="form-control" id="search-input" placeholder="Search for subtask name, status, start date, end date or something...">
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
                                                <table class="table table-nowrap align-middle border-bottom" id="tb-subtask-on-leave">
                                                    <thead class="text-muted table-light">
                                                        <tr class="text-uppercase">
                                                            <th class="sort" data-sort="id" style="width: 6.5%;">Sr No</th>
                                                            <th class="sort" data-sort="subtask-name">Title</th>
                                                            <th class="sort" data-sort="subtsk-type">priority</th>
                                                            <th class="sort" data-sort="subtsk-assigned-date">Assigned Date</th>
                                                            <th class="sort" data-sort="subtsk-due-date">due Date</th>
                                                            <th class="sort" data-sort="subtsk-status">Status</th>
                                                            <th class="sort" data-sort="action">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="form-check-all">

                                                    </tbody>
                                                </table>
                                                <div class="noresult" style="display: none">
                                                    <div class="text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                        <h5 class="mt-2">Sorry! No any subtasks between this period!</h5>
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
                        <div class="col-xxl-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table mb-0">
                                            <tbody id="leave-emp-details">

                                            </tbody>
                                        </table>
                                        <!--end table-->
                                    </div>
                                    <div class="mt-4 pt-2 hstack gap-2" id="approveDenyBtns">
                                        <a href="#!" class="btn btn-primary w-50" id="approve-leave-btn">Approve</a>
                                        <a href="#!" class="btn btn-danger w-50" id="deny-leave-btn">Deny</a>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->

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
                        \
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
        GetEmployeesSubtaskOnLeave()

        function GetEmployeesSubtaskOnLeave() {
            $.ajax({
                url: './php/GetEmployeeSubtasksOnLeave.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    leaveID: atob('<?php echo $_GET['leaveID']; ?>'),
                },
                success: function(result) {
                    var srno = 1;
                    if (result.SubtaskData.length <= 0) {
                        $('.noresult').css('display', 'block');
                    }
                    $('#tb-subtask-on-leave tbody').empty();

                    $.each(result.SubtaskData, function(ind, it) {
                        var tableRowString = `<tr>
                                                  <td class="text-right"><a href="#" class="fw-semibold">${srno++}</a></td>
                                                  <td>${it.subtaskname}</td>
                                                  <td><span class="badge bg-success">${it.Sub_Priority}</span></td>
                                                  <td>${moment(it.Created_Date).format('D MMM, YYYY hh:mm A')}</td>
                                                  <td>${moment(it.subtaskDue).format('D MMM, YYYY hh:mm A')}</td>
                                                  <td><span class="badge bg-primary">${it.stages}</span></td>
                                                  <td>
                                                      <button type="button" class="btn btn-sm btn-light" onclick="SubtaskDetailsNavigation(${it.subtask_ID})">Details</button>
                                                  </td>
                                              </tr>`;
                        $('#tb-subtask-on-leave tbody').append(tableRowString);

                    })
                    $.each(result.LeavesData, function(index, item) {
                        $('#leave-reason').html(item.reason)
                        $('#leave-emp-details').empty();
                        var leaveDetailsString = `<tr>
                                                    <td class="fw-medium">Employee Name</td>
                                                    <td>${item.EmpName}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">Designation</td>
                                                    <td>${item.Position}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">Email</td>
                                                    <td><span class="badge badge-soft-success">${item.Email}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">Mobile</td>
                                                    <td>${item.MobileNo}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">Leave Start Date</td>
                                                    <td>${moment(item.Startdate).format('D MMM, YYYY')}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">Leave End Date</td>
                                                    <td>${moment(item.EndDate).format('D MMM, YYYY')}</td>
                                                </tr>`;
                        $('#leave-emp-details').append(leaveDetailsString)
                        if (item.ApproveStatus == null || item.ApproveStatus == '') {
                            $('#approveDenyBtns').removeClass('d-none')
                        } else {
                            $('#approveDenyBtns').addClass('d-none')

                        }
                    })
                }
            })
        }

        $(document).ready(function() {
            // Search functionality
            $("#search-input").on("keyup", function() {
                var searchText = $(this).val().toLowerCase();
                $("#tb-subtask-on-leave tbody tr").filter(function() {
                    // console.log(searchText);
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            const tableRows = $("#tb-subtask-on-leave tbody tr");

            // Pagination initialization
            var itemsPerPage = 10;
            var currentPage = 1;
            var totalItems = $("#tb-subtask-on-leave tbody tr").length;
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
                $("#tb-subtask-on-leave tbody tr").hide().slice(startIndex, endIndex).show();
            }

            // Initial setup
            updatePagination();
            updateTableRows();
        });

        $('#approve-leave-btn').on('click', function() {
            Swal.fire({
                title: 'Are you Sure?',
                icon: 'question',
                text: 'Would you like to approve this leave?',
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
                        url: './php/updateleavestatus.php',
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            leaveID: atob('<?php echo $_GET['leaveID']; ?>'),
                            status: 1,
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire(
                                    'Approved !',
                                    'Leave Approved Successfully !.',
                                    'success'
                                );
                                GetEmployeesSubtaskOnLeave()
                            }

                        }
                    });
                }
            })
        })
        $('#deny-leave-btn').on('click', function() {
            Swal.fire({
                title: 'Are you Sure?',
                icon: 'question',
                text: 'Would you like to deny this leave?',
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
                    Swal.fire({
                        title: 'Reason',
                        text: 'Add reason for deniel',
                        html: `<div class="mb-3">
                                    <label class="form-label requiredField" for="leave-reason-input">Enter leave reason</label>
                                    <textarea rowspan="3" class="form-control" id="leave-reason-input" placeholder="Enter reason" required></textarea>
                                    <div class="invalid-feedback" id="reason-invalid-field">Reason should not be empty!</div>
                                </div>`,
                        confirmButtonText: 'Deny',
                        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                        buttonsStyling: !1,
                        focusConfirm: true,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showLoaderOnConfirm: true, // Show loader while processing
                        preConfirm: () => {
                            const entered_reason = $('#leave-reason-input').val();
                            if (entered_reason == '') {
                                $('#reason-invalid-field').css('display', 'block');
                                return false;
                            } else {
                                $('#reason-invalid-field').css('display', 'none');
                            }
                            return entered_reason;
                        },
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: './php/updateleavestatus.php',
                                dataType: 'json',
                                type: 'POST',
                                data: {
                                    leaveID: atob('<?php echo $_GET['leaveID']; ?>'),
                                    status: 0,
                                    reason: $('#leave-reason-input').val()
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire(
                                            'denied !',
                                            'Leave denied successfully !.',
                                            'success'
                                        );
                                        GetEmployeesSubtaskOnLeave()
                                    }

                                }
                            });
                        }
                    })

                }
            })
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