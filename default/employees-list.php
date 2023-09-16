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
    <title>Employees | Task Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                <h4 class="mb-sm-0">Employees</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Employees</a></li>
                                        <li class="breadcrumb-item active">List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="">
                                <div class="card-header border-0">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-sm-3">
                                            <div class="search-box">
                                                <input type="text" class="form-control search" id="search-input" placeholder="Search for...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto ms-auto">
                                            <div class="hstack gap-2">
                                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add New</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-card">
                                            <table class="table align-middle" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="srno" style="width: 5%;">Sr No</th>
                                                        <th class="sort" data-sort="name">Name</th>
                                                        <th class="sort" data-sort="email">Email</th>
                                                        <th class="sort" data-sort="statusAssignedUnassigned">Status</th>
                                                        <th class="sort" data-sort="TasksCount" style="width: 15%;">Total Tasks Assigned</th>
                                                        <th class="sort" data-sort="designation">Designation</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">

                                                </tbody>
                                            </table>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted mb-0">We've searched more than 150+ leads We did not find any leads for you search.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
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

                                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                </div>
                                                <form class="tablelist-form needs-validation" autocomplete="off" id="EmployeeAddForm" novalidate>
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id-field" />
                                                        <div class="row g-3">
                                                            <div class="col-lg-12 position-relative">
                                                                <div>
                                                                    <label for="Empname-field" class="form-label">Name</label>
                                                                    <input type="text" id="Empname-field" class="form-control" placeholder="Enter Name" required />
                                                                    <div class="invalid-tooltip">Please enter Name!</div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-12 position-relative">
                                                                <div>
                                                                    <label for="email-field" class="form-label">Email</label>
                                                                    <input type="email" id="email-field" oninput="checkEmailExists()" class="form-control" placeholder="Enter company name" required />
                                                                    <div class="invalid-tooltip" id="invalidEmailtooltip">Please enter email address!</div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-12 position-relative">
                                                                <div>
                                                                    <label for="phone-field" class="form-label">Phone</label>
                                                                    <input type="text" id="phone-field" class="form-control" oninput="checkMobileExists()" maxlength="10" placeholder="Enter phone no" required />
                                                                    <div class="invalid-tooltip" id="invalidPhonetooltip">Please enter Phone/mobile number!</div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-12 position-relative">
                                                                <div>
                                                                    <label for="designation-field" class="form-label">Designation</label>
                                                                    <input type="text" id="designation-field" class="form-control" placeholder="Enter designation" required />
                                                                    <div class="invalid-tooltip">Please enter designation!</div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-12 position-relative">
                                                                <div>
                                                                    <label for="location-field" class="form-label">Address</label>
                                                                    <input type="text" id="location-field" class="form-control" placeholder="Enter location" required />
                                                                    <div class="invalid-tooltip">Please enter address!</div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success" id="add-btn">Add</button>
                                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end modal-->

                                    <!-- Modal -->
                                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                </div>
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="fs-semibold">You are about to delete a lead ?</h4>
                                                        <p class="text-muted fs-14 mb-4 pt-1">Deleting your lead will remove all of your information from our database.</p>
                                                        <div class="hstack gap-2 justify-content-center remove">

                                                            <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                            <button class="btn btn-danger" id="delete-record">Yes, Delete It!!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end modal -->




                                </div>
                            </div>

                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

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

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
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
    <!-- Sweet Alerts js -->
    <!-- <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script> -->
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
        ShowAllEmployees();

        function ShowAllEmployees() {
            $.ajax({
                url: './php/GetAllEmployees.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    adminID: <?php echo $Admin_id; ?>,
                },
                success: function(data) {
                    $('#customerTable tbody').empty();
                    var srno = 1;
                    $.each(data, function(ind, item) {

                        var tableString = `<tr>
                                                <td class="srno" style="text-align: right;"><a href="javascript:void(0);" class="fw-medium link-primary">${srno++}</a></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="${item.ProfilePhoto==null ? 'assets/images/users/avatar-blank.jpg' : item.ProfilePhoto}" alt="" class="avatar-xxs rounded-circle image_src object-cover">
                                                        </div>
                                                        <div class="flex-grow-1 ms-2 name">${item.EmpName}</div>
                                                    </div>
                                                </td>
                                                <td class="email">${item.Email}</td>
                                                <td class="statusAssignedUnassigned">
                                                    <span class="badge badge-soft-${item.totalTasks == 0? 'danger':'success'}">${item.totalTasks == 0? 'Unassigned':'Assigned'}</span>
                                                </td>
                                                <td class="TasksCount" style="text-align: right;">${item.totalTasks}</td>
                                                <td class="designation">
                                                    <span class="badge badge-soft-primary">${item.Position}</span>
                                                </td>
                                                <td>
                                                    <ul class=" hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                           <a href="pages-profile.php?id=${btoa(item.ID)}"><i class="ri-eye-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>`;
                        $('#customerTable').append(tableString);

                    })

                }
            })
        }
        $(document).ready(function() {
            // Search functionality
            $("#search-input").on("keyup", function() {
                var searchText = $(this).val().toLowerCase();
                $("#customerTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            // Pagination initialization
            var itemsPerPage = 10;
            var currentPage = 1;
            var totalItems = $("#customerTable tbody tr").length;
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
                $("#customerTable tbody tr").hide().slice(startIndex, endIndex).show();
            }

            // Initial setup
            updatePagination();
            updateTableRows();
        });

        function checkEmailExists() {
            $.ajax({
                url: './php/CheckEmailExist.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    EmailID: $('#email-field').val()
                },
                success: function(result) {
                    if (result.success) {

                        $('#email-field').addClass('is-invalid');
                        $('#invalidEmailtooltip').html("E-mail address already exists !");

                        $('#EmployeeAddForm').addClass('was-validated');
                        $('#Emailfeedbacksentence').html('Please enter another e-mail !');

                    } else {
                        $('#email-field').removeClass('is-invalid');
                        $('#EmployeeAddForm').removeClass('was-validated');
                        $('#invalidEmailtooltip').html('Please enter employee e-mail !');

                    }
                }
            });
        }

        function checkMobileExists() {

            if ($('#phone-field').val().length == 10) {
                $.ajax({
                    url: './php/CheckMobileExists.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        MobileNum: $('#phone-field').val()
                    },
                    success: function(result) {

                        if (result.success) {
                            $('#invalidPhonetooltip').html("Mobile number already exists!");
                            $('#phone-field').addClass('is-invalid');
                            $('#EmployeeAddForm').addClass('was-validated');
                        } else {
                            $('#invalidPhonetooltip').html('Please enter mobile number !');
                            $('#phone-field').removeClass('is-invalid');
                            $('#EmployeeAddForm').removeClass('was-validated');
                        }
                    }
                });
            }
        }


        function generateRandomPassword() {
            const uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const lowercaseLetters = "abcdefghijklmnopqrstuvwxyz";
            const numbers = "0123456789";
            const symbols = "!@#$%^&*_+?~";

            const getRandomCharacter = (characters) => {
                const randomIndex = Math.floor(Math.random() * characters.length);
                return characters.charAt(randomIndex);
            };

            let password = "";
            password += getRandomCharacter(uppercaseLetters); // Add one uppercase letter
            password += getRandomCharacter(lowercaseLetters); // Add one lowercase letter
            password += getRandomCharacter(numbers); // Add one number
            password += getRandomCharacter(symbols); // Add one symbol

            const remainingLength = 8 - password.length;
            const allCharacters = uppercaseLetters + lowercaseLetters + numbers + symbols;

            for (let i = 0; i < remainingLength; i++) {
                password += getRandomCharacter(allCharacters); // Add random characters for remaining length
            }

            return password;
        }

        // submit button js

        const form = document.querySelector('#EmployeeAddForm');
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                form.classList.add('was-validated')
            } else {
                event.preventDefault();
                SaveEmployeeDetails();
                form.classList.remove('was-validated')
            }
        });

        function SaveEmployeeDetails() {
            //body
            Swal.fire({
                title: 'Add?',
                text: 'Do you want to add this employee?',
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
                    // var formData = {};
                    // $('input.leaveCount').each(function() {
                    //     var inputName = $(this).attr('name');
                    //     var inputValue = $(this).val();
                    //     formData[inputName] = inputValue;
                    // });

                    // // console.log(JSON.stringify(formData, null, 2));
                    // for (let i in formData) {
                    //     console.log(formData[i]);

                    // }
                    let generatedPass = generateRandomPassword();

                    var postData = {
                        inputEmpName: $('#Empname-field').val(),
                        inputEmpEmail: $('#email-field').val(),
                        inputEmpMobile: $('#phone-field').val(),
                        inputEmpPosition: $('#designation-field').val(),
                        inputEmpAddress: $('#location-field').val(),
                        PasswordForEmp: generatedPass,
                        // formData: formData
                    };

                    $.ajax({
                        url: './php/empAdd.php',
                        type: 'POST',
                        dataType: 'json',
                        data: postData,
                        beforeSend: function() {
                            Swal.fire({
                                title: "Please wait ...",
                                text: "Employee is being added to database !",
                                timer: 5000,
                                width: '400px',
                                showConfirmButton: false,
                                onBeforeOpen: function() {
                                    Swal.showLoading();
                                }
                            }).then(function(result) {
                                if (result.dismiss === "timer") {
                                    console.log("I was closed by the timer");
                                }
                            });
                        },
                        success: function(resultData) {

                            if (resultData.success) {
                                // email sending to employee
                                $.get("./Email/email_emp_credentials.php", function(htmlCode) {
                                    htmlCode = htmlCode.replace("[Employee_Name]", $("#Empname-field").val())
                                        .replace("[Your Username]", $("#phone-field").val())
                                        .replace("[Your Temporary Password]", generatedPass)
                                        .replace("[Redirect_Link]", "http://134.209.156.101/Task-Manager/users-profile.php");
                                    var EmailBody = htmlCode;
                                    $.ajax({
                                        url: "./Email/SendMail.php",
                                        method: 'POST',
                                        data: {
                                            email: $("#email-field").val(),
                                            subject: 'You are added to system',
                                            body: EmailBody
                                        },
                                        success: function(result) {
                                            console.log('mail sent');
                                            ShowAllEmployees()
                                            $('#showModal').modal('hide')
                                            $('#EmployeeAddForm')[0].reset();
                                            $('#EmployeeAddForm').removeClass('was-validated');
                                        }
                                    })
                                })

                            } else {
                                toastr.options = {
                                    "toastClass": "sentMailToaster",
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "timeOut": "3000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                                toastr.options.toastClass = "sentMailToaster";
                                toastr.success("failed to send e-mail !");
                            }
                        }
                    })



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

    <!-- list.js min js -->
    <!-- <script src="assets/libs/list.js/list.min.js"></script> -->
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>


    <!-- crm leads init -->
    <script src="assets/js/pages/crm-leads.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>