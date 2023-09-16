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
    <title>Profile Settings | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                    <div class="position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg profile-setting-img">
                            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
                            <div class="overlay-content">
                                <div class="text-end p-3">
                                    <!-- <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                        <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                            <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                        </label>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card mt-n5">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="assets/images/users/avatar-1.jpg" id="EmployeeProfilePhoto" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <h5 class="fs-16 mb-1 EmployeeName">Anna Adame</h5>
                                        <p class="text-muted mb-0 EmployeeDesignation">Lead Designer / Developer</p>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-0">Portfolio</h5>
                                        </div>
                                        <!-- <div class="flex-shrink-0">
                                            <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i class="ri-add-fill align-bottom me-1"></i> Add</a>
                                        </div> -->
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-dark text-light">
                                                <i class="ri-twitter-fill"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" id="TwitterUsername" placeholder="Username">
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                <i class="ri-facebook-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="facebookUsername" placeholder="daveadame">
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                <i class="ri-instagram-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="instagramUsername" placeholder="Username">
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                <i class="ri-linkedin-box-fill"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="LinkedinUsername" placeholder="Username">
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i> Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="far fa-user"></i> Change Password
                                            </a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#experience" role="tab">
                                                <i class="far fa-envelope"></i> Experience
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                                <i class="far fa-envelope"></i> Privacy Policy
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form action="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" required>
                                                            <div class="invalid-feedback">First name should not be empty!</div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="lastnameInput" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="lastnameInput" placeholder="Enter your lastname" required>
                                                            <div class="invalid-feedback">Last name should not be empty!</div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number" disabled>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" disabled>
                                                        </div>
                                                    </div>
                                                    <!--end col-->

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="designationInput" class="form-label">Designation</label>
                                                            <input type="text" class="form-control" id="designationInput" placeholder="Designation" disabled>
                                                        </div>
                                                    </div>
                                                    <!--end col-->

                                                    <div class="col-lg-12">
                                                        <div class="mb-3 pb-2">
                                                            <label for="EmployeeAddress" class="form-label">Address</label>
                                                            <textarea class="form-control" id="EmployeeAddress" placeholder="Enter your Address" rows="3" required>
                                                            </textarea>
                                                            <div class="invalid-feedback">Address should not be empty!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3 pb-2">
                                                            <label for="EmployeeAbout" class="form-label">About</label>
                                                            <textarea class="form-control" id="EmployeeAbout" placeholder="Enter your profile description" rows="3">
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>
                                                            <!-- <button type="button" class="btn btn-soft-success">Cancel</button> -->
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="changePassword" role="tabpanel">
                                            <form action="javascript:void(0);">
                                                <div class="row g-2">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                            <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                                            <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                            <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>

                                        </div>
                                        <!--end tab-pane-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div><!-- End Page-content -->

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
        var empid = atob('<?php echo $_GET['eid']; ?>');

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

                        $('#TwitterUsername').val(item.Twitter)
                        $('#facebookUsername').val(item.Facebook)
                        $('#instagramUsername').val(item.Instagram)
                        $('#LinkedinUsername').val(item.Linkedin)



                        var fullname = item.EmpName.split(' ')
                        $('#firstnameInput').val(fullname[0]);
                        $('#lastnameInput').val(fullname[1]);

                        $('.EmployeeDesignation').html(item.Position)

                        $('#designationInput').val(item.Position)
                        $('#EmployeeAddress').val(item.Address)
                        $('#phonenumberInput').val(item.MobileNo)
                        $('#emailInput').val(item.Email)
                        $('#EmployeeAbout').val(item.About)
                    })
                }
            })
        }
        $('#firstnameInput').on('keyup', function() {
            $('#firstnameInput').removeClass('is-invalid')
        })
        $('#lastnameInput').on('keyup', function() {
            $('#lastnameInput').removeClass('is-invalid')
        })
        $('#EmployeeAddress').on('keyup', function() {
            $('#EmployeeAddress').removeClass('is-invalid')
        })
        $('#updateBtn').on('click', function() {
            event.preventDefault();
            var AllValid = true;
            if ($('#firstnameInput').val() == '') {
                AllValid = false;
                $('#firstnameInput').addClass('is-invalid')
            }
            if ($('#lastnameInput').val() == '') {
                AllValid = false;
                $('#lastnameInput').addClass('is-invalid')
            }
            if ($('#EmployeeAddress').val() == '') {
                AllValid = false;
                $('#EmployeeAddress').addClass('is-invalid')
            }


            if (AllValid) {
                var formData = new FormData();

                // Append the fields to the FormData object
                formData.append('empid', empid);
                formData.append('empName', $('#firstnameInput').val() + ' ' + $('#lastnameInput').val());
                formData.append('empAddress', $('#EmployeeAddress').val());
                formData.append('empAbout', $('#EmployeeAbout').val());
                formData.append('empProfilePhoto', $('#profile-img-file-input')[0].files[0]); // Assuming this is a file input field

                formData.append('TwitterUnm', $('#TwitterUsername').val());
                formData.append('FacebookUnm', $('#facebookUsername').val());
                formData.append('InstaUnm', $('#instagramUsername').val());
                formData.append('LinkedUnm', $('#LinkedinUsername').val());

                $.ajax({
                    url: './php/editProfile.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            Swal.fire(
                                'Updated!',
                                'Your profile has been updated.',
                                'success'
                            )
                            ShowEmployeeData();

                        }
                    }
                })
            }
        })
    </script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- profile-setting init js -->
    <script src="assets/js/pages/profile-setting.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>