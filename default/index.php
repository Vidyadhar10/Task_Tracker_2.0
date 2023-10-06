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
    <title>Task Tracker | Admin Dashboard</title>
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
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                                It!</button>
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
                                <h4 class="mb-sm-0">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Home</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <section class="admin-panel-menu">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card crm-widget">
                                    <div class="card-body p-0">
                                        <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-1 g-0">
                                            <div class="col">
                                                <div class="py-4 px-3">
                                                    <h5 class="text-muted text-uppercase fs-13">Projects
                                                    </h5>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class="ri-apps-2-line display-6 text-muted"></i>
                                                            <!-- <i class="ri-apps-2-line"></i> -->
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h2 class="mb-0"><span class="counter-value" id="projectsCountSpan">0</span></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col">
                                                <div class="mt-3 mt-md-0 py-4 px-3">
                                                    <h5 class="text-muted text-uppercase fs-13">
                                                        Employees
                                                    </h5>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class="ri-account-circle-line display-6 text-muted"></i>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h2 class="mb-0"><span class="counter-value" id="EmployeesCountSpan">0</span></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col">
                                                <div class="mt-3 mt-md-0 py-4 px-3">
                                                    <h5 class="text-muted text-uppercase fs-13">
                                                        Tasks
                                                    </h5>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class="ri-list-check display-6 text-muted"></i>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h2 class="mb-0"><span class="counter-value" id="TasksCountSpan">0</span></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col">
                                                <div class="mt-3 mt-lg-0 py-4 px-3">
                                                    <h5 class="text-muted text-uppercase fs-13">
                                                        Issues
                                                    </h5>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class="ri-error-warning-line display-6 text-muted"></i>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h2 class="mb-0"><span class="counter-value" id="IssuesCountSpan">0</span></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                        </div><!-- end row -->
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-9">
                                <div class="card">
                                    <canvas id="myChart"></canvas>


                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3">
                                <div class="card card-height-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Recent Activity</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body p-0">
                                        <div data-simplebar style="max-height: 350px;">
                                            <ul class="list-group list-group-flush border-dashed px-3" id="RecentActivityLI">


                                            </ul><!-- end ul -->
                                        </div>
                                        <!-- <div class="p-3 pt-2">
                                            <a href="javascript:void(0);" class="text-muted text-decoration-underline">
                                                Show more...
                                            </a>
                                        </div> -->
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->
                        <!-- recent activity end  -->
                    </section>

                    <!-- admin panel end  -->

                    <!-- employee panel starts  -->

                    <section class="Employee-panel-menu">
                        <div class="row" id="employee-dash-cards">

                            <!--end col-->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="fw-medium text-muted mb-0">Pending Tickets</p>
                                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="124">0</span>k</h2>
                                                <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"> <i class="ri-arrow-down-line align-middle"></i> 0.96 % </span> vs. previous month</p>
                                            </div>
                                            <div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                                        <i class="mdi mdi-timer-sand"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="fw-medium text-muted mb-0">Closed Tickets</p>
                                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="107">0</span>K</h2>
                                                <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"> <i class="ri-arrow-down-line align-middle"></i> 3.87 % </span> vs. previous month</p>
                                            </div>
                                            <div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                                        <i class="ri-shopping-bag-line"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="fw-medium text-muted mb-0">Deleted Tickets</p>
                                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="15.95">0</span>%</h2>
                                                <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"> <i class="ri-arrow-up-line align-middle"></i> 1.09 % </span> vs. previous month</p>
                                            </div>
                                            <div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" id="Subtask-List">
                                    <div class="card-header border-top-0 border border-end-0 border-start-0">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title mb-0 flex-grow-1" id="CardTitle">Tasks</h5>
                                            <div class="flex-shrink-0 col-xl-4">
                                                <div class="d-flex flex-wrap gap-2">
                                                    <div class="col-sm-12">
                                                        <div class="search-box">
                                                            <input type="text" class="form-control search bg-light border-light" placeholder="Search for subtask details or something..." id="search-input">
                                                            <i class="ri-search-line search-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end card-body-->
                                    <div class="card-body">
                                        <div class="table-responsive table-card mb-4">
                                            <table class="table align-middle table-nowrap mb-0" id="Subtask-Table">
                                                <thead>
                                                    <tr>
                                                        <th class="sort" data-sort="id" style="width: 6%;">Sr No</th>
                                                        <th class="sort" data-sort="tasks_name">Task Title</th>
                                                        <th class="sort" data-sort="project_name">Project Title</th>
                                                        <th class="sort" data-sort="task_priority">Priority</th>
                                                        <th class="sort" data-sort="allocated_by">Allocated By</th>
                                                        <th class="sort" data-sort="due_date">Due Date</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <tr>
                                                        <td class="id" style="text-align: right;"><a href="#" data-id="001" class="fw-medium link-primary">1</a></td>
                                                        <td class="tasks_name">Error message when placing an orders?</td>
                                                        <td class="project_name">Tonya Noble</td>
                                                        <td class="task_priority"><span class="badge bg-danger text-uppercase">High</span></td>
                                                        <td class="allocated_by">James Morris</td>
                                                        <td class="due_date">25 Jan, 2022</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><button class="dropdown-item" onclick="location.href = 'apps-tickets-details.html';"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</button></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="noresult d-none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                    <h5 class="mt-2">Sorry! No Records Yet!</h5>
                                                    <!-- <p class="text-muted mb-0">We've searched more than 150+ Tickets We did not find any Tickets for you search.</p> -->
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

                                        <!-- Modal -->
                                        <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body p-5 text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                                        <div class="mt-4 text-center">
                                                            <h4>You are about to delete a order ?</h4>
                                                            <p class="text-muted fs-14 mb-4">Deleting your order will remove all of your information from our database.</p>
                                                            <div class="hstack gap-2 justify-content-center remove">
                                                                <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                                <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end modal -->
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </section>
                    <!-- employee-panel end  -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <div id="unsetmastermodal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-right">
                    <div class="modal-content">
                        <!-- <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                        </div> -->
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <!-- <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon> -->
                                <i class="ri-settings-4-line fs-48 text-danger custom-icon-rotating"></i>
                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                    <h4>The master is not set yet!</h4>
                                    <p class="text-muted mx-4 mb-0">Please set the master first!</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-danger" onclick="window.location.href='./master-settings.php'">
                                    Go to settings<i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i></button>
                            </div>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Task Tracker.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                <!-- Design & Develop by Themesbrand -->
                            </div>
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

    <script>
        <?php
        if (isset($_SESSION['AdminStatus'])) {
            if ($_SESSION['AdminStatus'] == 1) { ?>
                // document.getElementsByClassName('Employee-panel-menu').style.display = 'none';
                $('.Employee-panel-menu').hide()
            <?php
            } else {
            ?>
                $('.admin-panel-menu').hide()
                // document.getElementsByClassName('admin-panel-menu').style.display = 'none';
        <?php
            }
        }
        ?>
        ShowDashboardCounts();

        function ShowDashboardCounts() {
            $.ajax({
                url: './php/GetDashboardCounts.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    adminID: '<?php echo $Admin_id; ?>',
                },
                success: function(data) {
                    $('#projectsCountSpan').attr('data-target', data.ProjectsCount)
                    $('#EmployeesCountSpan').attr('data-target', data.EmployeesCount)
                    $('#TasksCountSpan').attr('data-target', data.TasksCount)
                    $('#IssuesCountSpan').attr('data-target', data.IssuesCount)

                }
            })
        }
        ShowRecentActivity()

        function ShowRecentActivity() {
            $('#RecentActivityLI').empty();
            $.ajax({
                url: './php/GetRecentActivites.php',
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data.length != 0) {
                        $.each(data, function(index, item) {
                            var recentAString = `<li class="list-group-item ps-0">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <label class=" mb-0 ps-2">${item.Activity}</label>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <p class="text-muted fs-12 mb-0">${moment(item.Date).format('D MMM, YYYY')}</p>
                                                    </div>
                                                </div>
                                            </li>`;
                            $('#RecentActivityLI').append(recentAString);
                        })
                    } else {
                        $('#RecentActivityLI').append("No Recent Activity Yet!");
                    }
                }
            })
        }
    </script>
    <!-- Chart JS -->
    <script src="assets/libs/chart.js/chart.min.js"></script>

    <!-- chartjs init -->
    <script src="assets/js/pages/chartjs.init.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: './php/chart.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    // console.log(data);
                    var projectNames = data.map(obj => obj.ProjectName);
                    var completedTasks = data.map(obj => obj
                        .TotalCompletedSubtasks);
                    var incompleteTasks = data.map(obj => obj
                        .TotalIncompleteSubtasks);

                    var ctx = document.getElementById('myChart').getContext(
                        '2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: projectNames,
                            datasets: [{
                                    label: 'Completed Tasks',
                                    data: completedTasks,
                                    backgroundColor: 'rgba(204, 229, 255)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    stack: 'stacked'
                                },
                                {
                                    label: 'Incomplete Tasks',
                                    data: incompleteTasks,
                                    backgroundColor: 'rgba(255,204,229)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1,
                                    stack: 'stacked'
                                }
                            ]
                        },
                        options: {
                            scales: {
                                x: {
                                    stacked: true,
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                },
                                title: {
                                    display: true,
                                    text: 'Project Status',
                                    font: {
                                        size: 20
                                    }
                                }
                            }
                        }
                    });

                    // Set the width of the container and enable horizontal scrolling
                    // var chartContainer = document.getElementById('chart-container');
                    // chartContainer.style.width = '1000px';
                    // chartContainer.style.overflowX = 'auto';
                    // Create the bar chart

                }
            })
        })
    </script>

    <!-- js for employee panel  -->
    <script>
        ShowEmpDashCards();

        function ShowEmpDashCards() {
            $('#employee-dash-cards').empty();
            $.ajax({
                url: './php/GetEmpStagesCounts.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    employeeID: <?php echo $Admin_id; ?>,
                },
                success: function(data) {
                    // console.log(data);
                    var divColClass;
                    if (Object.keys(data).length == 5) {
                        divColClass = 2;
                    } else {
                        divColClass = 3;
                    }
                    var StageCardNum = 1;
                    $.each(data, function(index, item) {
                        var cardString = `<div class="col-xxl-${divColClass} col-sm-6">
                                            <div class="card card-animate" onclick="ShowRespTableData(${StageCardNum++}, '${item.StageName}')" style="cursor:pointer;">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-muted mb-0">${item.StageName}</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="${item.Count}">0</span></h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                                                    <i class="ri-stack-line"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div> <!-- end card-->
                                        </div>`;
                        $('#employee-dash-cards').append(cardString);
                    })

                }
            })
        }

        function ShowEmpsAllSubtasks(callback) {
            $.ajax({
                url: './php/GetEmpsAllSubtasks.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    employeeID: <?php echo $Admin_id; ?>,
                },
                success: function(data) {
                    const groupedData = {};
                    data.forEach(item => {
                        const status = item.status;
                        if (!groupedData[status]) {
                            groupedData[status] = [];
                        }
                        groupedData[status].push(item);
                    });
                    if (typeof callback === 'function') {
                        callback(groupedData);
                    }
                }
            })
        }
        ShowEmpsAllSubtasks()

        function ShowRespTableData(number, cardTitle) {

            ShowEmpsAllSubtasks(function(GroupedData) {
                $('#CardTitle').html(cardTitle);
                $('#Subtask-Table tbody').empty();
                // console.log(GroupedData[number]);
                if (GroupedData[number] == undefined) {
                    $('.noresult').removeClass('d-none')
                } else {
                    $('.noresult').addClass('d-none')
                }
                var srno = 1;
                $.each(GroupedData[number], function(index, item) {
                    var subtaskTableRow = ` <tr>
                                                        <td class="id" style="text-align: right;"><a href="#" data-id="001" class="fw-medium link-primary">${srno++}</a></td>
                                                        <td class="tasks_name">${item.subtaskname}</td>
                                                        <td class="project_name">${item.ProjectName}</td>
                                                        <td class="task_priority"><span class="badge bg-info text-uppercase">${item.SubTasksPriority}</span></td>
                                                        <td class="allocated_by">${item.CreatedByName}</td>
                                                        <td class="due_date">${moment(item.subtaskDue).format('D MMM, YYYY')}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><button class="dropdown-item" onclick="location.href = 'sub-tasks-details.php?subid=${item.subtask_ID}';"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</button></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>`;
                    $('#Subtask-Table tbody').append(subtaskTableRow);
                })
                PaginationWorking()
            });
        }

        ShowEmpsAllSubtasks(function(GroupedData) {
            // You can access BackLogData here
            // console.log(GroupedData);
            $('#CardTitle').html('Backlog');
            $('#Subtask-Table tbody').empty();
            var srno = 1;
            $.each(GroupedData[1], function(index, item) {
                var subtaskTableRow = ` <tr>
                                                        <td class="id" style="text-align: right;"><a href="#" data-id="001" class="fw-medium link-primary">${srno++}</a></td>
                                                        <td class="tasks_name">${item.subtaskname}</td>
                                                        <td class="project_name">${item.ProjectName}</td>
                                                        <td class="task_priority"><span class="badge bg-info text-uppercase">${item.SubTasksPriority}</span></td>
                                                        <td class="allocated_by">${item.CreatedByName}</td>
                                                        <td class="due_date">${moment(item.subtaskDue).format('D MMM, YYYY')}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><button class="dropdown-item" onclick="location.href = 'sub-tasks-details.php?subid=${item.subtask_ID}';"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</button></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>`;
                $('#Subtask-Table tbody').append(subtaskTableRow);
            })
            PaginationWorking()
        });

        $(document).ready(function() {
            // Search functionality
            $("#search-input").on("keyup", function() {
                var searchText = $(this).val().toLowerCase();
                $("#Subtask-Table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            // Pagination initialization

            PaginationWorking()
        });

        function PaginationWorking() {
            var itemsPerPage = 10;
            var currentPage = 1;
            var totalItems = $("#Subtask-Table tbody tr").length;
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

            // Pagination click event
            $(".pagination-wrap .listjs-pagination").on("click", "a.page-link", function(e) {
                e.preventDefault();
                currentPage = parseInt($(this).text());
                updatePagination();
                updateTableRows();
            });

            function updateTableRows() {
                var startIndex = (currentPage - 1) * itemsPerPage;
                var endIndex = startIndex + itemsPerPage;
                $("#Subtask-Table tbody tr").hide().slice(startIndex, endIndex).show();
            }

            // Initial setup
            updatePagination();
            updateTableRows();
        }
    </script>
    <script>
        $(document).ready(function() {
            // Your AJAX code here

            $.ajax({
                url: './php/checkMasterExist.php',
                dataType: 'json',
                type: 'GET',
                success: function(result) {
                    if (!result.success) {
                        $('#unsetmastermodal').modal('show')
                    }
                }
            })
        });
    </script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-crm.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>