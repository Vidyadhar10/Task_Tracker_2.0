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
                                <h4 class="mb-sm-0">Leave Request</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Leave Request</a></li>
                                        <li class="breadcrumb-item active">All</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="orderList">
                                <div class="card-header border-0">
                                    <div class="row align-items-center gy-3">
                                        <div class="col-sm">
                                            <h5 class="card-title mb-0">Request Status</h5>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-flex gap-1 flex-wrap">
                                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#leaveModal"><i class="ri-add-line align-bottom me-1"></i> Request Leave</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div>
                                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active All py-3" data-bs-toggle="tab" onclick="ShowLeaveData('')" id="All" href="#home1" role="tab" aria-selected="true">
                                                    <i class="mdi mdi-timer-sand me-1 align-bottom"></i> Pending
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link py-3 Delivered" data-bs-toggle="tab" onclick="ShowLeaveData(1)" id="Delivered" href="#delivered" role="tab" aria-selected="false">
                                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Approved
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" onclick="ShowLeaveData(0)" id="Cancelled" href="#cancelled" role="tab" aria-selected="false">
                                                    <i class="ri-close-circle-line me-1 align-bottom"></i> Denied
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="table-responsive table-card mb-1">
                                            <table class="table table-nowrap align-middle" id="leave-list-table">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th class="sort" data-sort="id">Sr no</th>
                                                        <th class="sort" data-sort="start_date">Start Date</th>
                                                        <th class="sort" data-sort="end_date">End Date</th>
                                                        <th class="sort" data-sort="reason">Reason</th>
                                                        <th class="sort" data-sort="leave_type">Leave Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">

                                                </tbody>
                                            </table>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                    <h5 class="mt-2">Sorry! No Requests Yet!</h5>
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

                                    <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="LeaveFormReset()" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form" autocomplete="off" id="leave-request-form">
                                                    <div class="modal-body">
                                                        <div class="row gy-4 mb-3">
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <label for="start-date-field" class="form-label requiredField">Start Date</label>
                                                                    <input type="date" id="start-date-field" class="form-control" data-provider="flatpickr" required required placeholder="Select date" />
                                                                    <div class="invalid-feedback" id="start-dt-inv-field">Please enter start date!</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <label for="end-date-field" class="form-label requiredField">End Date</label>
                                                                    <input type="date" id="end-date-field" class="form-control" data-provider="flatpickr" required required placeholder="Select date" />
                                                                    <div class="invalid-feedback" id="end-dt-inv-field">Please enter end date!</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="leave-type-category" class="form-label requiredField">Select leave type</label>
                                                            <select class="form-control" data-trigger name="leave-type-category" id="leave-type-category">
                                                                <option value="">Select</option>
                                                                <?php
                                                                include './php/connection.php';
                                                                $query = "SELECT * FROM `leave_types`";
                                                                $result = $con->query($query);
                                                                if ($result->num_rows > 0) {
                                                                    while ($optionData = $result->fetch_assoc()) {
                                                                        $options = $optionData['leave_category'];
                                                                        $leaveCatID = $optionData['ID'];
                                                                ?>
                                                                        <option value="<?php echo $leaveCatID; ?>"><?php echo $options; ?></option>
                                                                <?php }
                                                                } ?>
                                                                <?php mysqli_close($con); ?>
                                                            </select>
                                                            <div class="invalid-feedback" id="leave-type-inv-field">Please select leave type!</div>
                                                        </div>
                                                        <div class="mb-3 position-relative">
                                                            <label class="form-label requiredField">Reason</label>
                                                            <div id="ckeditor-classic-reason">

                                                            </div>
                                                            <div class="invalid-feedback" id="leave-reason-inv-field">Reason should not be empty!</div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" onclick="LeaveFormReset()" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success" id="add-btn">Send Request</button>
                                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


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

    <?php
    include './php/connection.php';
    $projIDarray = array();
    $querytogetprojectarray = mysqli_query($con, "SELECT `Project_ID` FROM `empwork`
    WHERE `Emp_ID`='$Admin_id'");
    while ($rowdata = $querytogetprojectarray->fetch_assoc()) {
        $projIDarray[] = $rowdata['Project_ID'];
    }
    $projIDarray = array_unique($projIDarray);

    //empty array to store admin ID's
    $AdminIDArray = array();
    // get projectwise employee
    foreach ($projIDarray as $arrayIndex) {
        $querytogetadminID = mysqli_query($con, "SELECT Admin_emp_id FROM projectdata WHERE SrNo=$arrayIndex");
        while ($RowValue = $querytogetadminID->fetch_assoc()) {
            $AdminIDArray[] = $RowValue['Admin_emp_id'];
        }
        $AdminIDArray = array_unique($AdminIDArray);
    }

    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize CKEditor 5
            ClassicEditor
                .create(document.querySelector('#ckeditor-classic-reason'))
                .then(newEditor => {
                    ReasonEditor = newEditor; // Save the editor instance
                })
                .catch(error => {
                    console.error(error);
                });
        })
        // default pending status 
        ShowLeaveData('')

        function ShowLeaveData(statusValue) {
            $.ajax({
                url: './php/employee-leave-table.php', // Replace with the actual path to your PHP file
                type: 'POST',
                dataType: 'JSON',
                data: {
                    empid: '<?php echo $Admin_id; ?>',
                    status: statusValue,
                },
                success: function(data) {
                    $('#leave-list-table tbody').empty()
                    if (data.length <= 0) {
                        $('.noresult').css('display', 'block');
                    } else {
                        $('.noresult').css('display', 'none');
                        var srno = 1;
                        $.each(data, function(index, item) {
                            var RowString = `<tr>
                                                <td class="id text-end" style="width: 6%;"><a href="#" class="fw-medium link-primary">${srno++}</a></td>
                                                <td class="start_date" style="width: 15%;">${moment(item.Startdate).format('DD MMM, YYYY')}</td>
                                                <td class="end_date" style="width: 15%;">${moment(item.EndDate).format('DD MMM, YYYY')}</td>
                                                <td class="reason">${item.reason}</td>
                                                <td class="leave_type"  style="width: 15%;">
                                                    <span class="badge badge-soft-primary text-uppercase">${item.leave_category}</span>
                                                </td>
                                            </tr>`;
                            $('#leave-list-table tbody').append(RowString)

                        });
                    }
                    paginationWorking();

                }
            });
        }


        $('#start-date-field').on('change', function() {
            $('#start-dt-inv-field').css('display', 'none');
        })
        $('#end-date-field').on('change', function() {
            $('#end-dt-inv-field').css('display', 'none');
        })
        $('#leave-type-category').on('change', function() {
            $('#leave-type-inv-field').css('display', 'none');
        })

        $('#leave-request-form').on('submit', function() {
            event.preventDefault();
            var isFormValid = true;
            if ($('#start-date-field').val() == '') {
                isFormValid = false;
                $('#start-dt-inv-field').css('display', 'block');
            }
            if ($('#end-date-field').val() == '') {
                isFormValid = false;
                $('#end-dt-inv-field').css('display', 'block');
            }
            var startDate = new Date($('#start-date-field').val());
            var endDate = new Date($('#end-date-field').val());

            if (startDate >= endDate) {
                isFormValid = false;
                $('#end-dt-inv-field').css('display', 'block');
                $('#end-dt-inv-field').html('End date should be greater than start date');
            } else {
                $('#end-dt-inv-field').css('display', 'none'); // Hide the validation message
            }

            if ($('#leave-type-category').val() == '') {
                isFormValid = false;
                $('#leave-type-inv-field').css('display', 'block');
            }
            if (ReasonEditor.getData() == '') {
                isFormValid = false;
                $('#leave-reason-inv-field').css('display', 'block');
            } else {
                $('#leave-reason-inv-field').css('display', 'none');
            }

            if (isFormValid) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to request for leave!",
                    icon: 'question',
                    confirmButtonText: 'Yes, Sure!',
                    showDenyButton: true,
                    width: '400px',
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

                        // Get form data
                        var formData = {
                            fromdate: $('#start-date-field').val(),
                            toDate: $('#end-date-field').val(),
                            category: $('#leave-type-category').val(),
                            reason: ReasonEditor.getData(),
                            employeeId: '<?php echo $Admin_id; ?>',
                        };
                        // Submit the form data using AJAX
                        $.ajax({
                            url: './php/SaveLeaveRequestData.php',
                            type: 'POST',
                            data: formData,
                            success: function(response) {

                                $('#leaveModal').modal('hide');
                                Swal.fire(
                                    'Submitted!',
                                    'Your request has been submitted.',
                                    'success'
                                )
                                ShowLeaveData('')

                                $.get("Email/email_for_leave_request.html", function(htmlCode) {
                                    htmlCode = htmlCode
                                        .replace("[Employee Name]", '<?php echo $Uname; ?>')
                                        .replace("[Start Date]", moment($('#start-date-field').val()).format('DD-MM-YYYY'))
                                        .replace("[End Date]", moment($('#end-date-field').val()).format('DD-MM-YYYY'))
                                        .replace("[Reason for Leave]", ReasonEditor.getData())
                                        .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/users-profile.php");
                                    var EmailBody = htmlCode;
                                    <?php
                                    foreach ($AdminIDArray as $AID) {
                                    ?>
                                        $.ajax({
                                            url: "Email/SendMail.php", // Separate PHP file to handle sending emails
                                            method: 'POST',
                                            data: {
                                                email: '1910014@ritindia.edu', // Specify the email address here
                                                subject: 'Leave Application',
                                                body: EmailBody,
                                                assigneeID: '<?php echo $AID; ?>' // Pass the admin IDs as an array to PHP
                                            },
                                            success: function(result) {
                                                console.log('Emails sent successfully');
                                                LeaveFormReset()
                                            }
                                        });
                                    <?php
                                    }
                                    ?>
                                });
                            }
                        });


                    }
                })
            }
        })

        function LeaveFormReset() {
            $('#leave-request-form')[0].reset();
            ReasonEditor.setData('')
        }


        function paginationWorking() {

            const tableRows = $("#leave-list-table tbody tr");

            // Pagination initialization
            var itemsPerPage = 10;
            var currentPage = 1;
            var totalItems = $("#leave-list-table tbody tr").length;
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
                $("#leave-list-table tbody tr").hide().slice(startIndex, endIndex).show();
            }

            // Initial setup
            updatePagination();
            updateTableRows();
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