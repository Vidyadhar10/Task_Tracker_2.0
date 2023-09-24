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
    <title>Project List | Task Tracker</title>
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
                                <h4 class="mb-sm-0">Project List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                        <li class="breadcrumb-item active">Project List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <a href="projects-create-project.php" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end gap-2">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control" placeholder="Search..." id="search-input">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                                <select class="form-control w-md" id="filter-projects-dropdown" data-choices data-choices-search-false>
                                    <option value="All" selected>All</option>
                                    <option value="Today">Today</option>
                                    <option value="Yesterday">Yesterday</option>
                                    <option value="Last7Days">Last 7 Days</option>
                                    <option value="Last30Days">Last 30 Days</option>
                                    <option value="ThisMonth">This Month</option>
                                    <option value="LastYear">Last Year</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row" id="project-list-cards">
                        <!-- project card  -->

                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row g-0 col-xxl-12 text-center text-sm-start align-items-center mb-4">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-end">
                                <div class="pagination-wrap hstack grid-pg-wrap gap-2">
                                    <a class="page-item pagination-prev grid-prev-pg" href="#">
                                        Previous
                                    </a>
                                    <ul class="pagination listjs-pagination grid-listjs-pgn mb-0"></ul>
                                    <a class="page-item pagination-next grid-next-pg" href="#">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
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
                        <!-- <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div> -->
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- removeProjectModal -->
    <div id="removeProjectModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Project ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-project">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



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
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- project list init -->
    <script src="assets/js/pages/project-list.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <!-- jquery cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- master js file  -->
    <script src="./assets/js/master.js"></script>
    <!-- moment.js cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script>
        $(document).ready(function() {
            // Search input event listener
            $('#search-input').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                filterProjects(searchText);
            });

            // Dropdown event listener

            // Initial filtering on page load (optional)
            filterProjects('');

        });

        function filterProjects(searchText) {
            $('#project-list-cards .project-card').each(function() {
                var projectTitle = $(this).find('.project-title').text().toLowerCase();
                if (projectTitle.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
        $(document).ready(function() {
            $('#filter-projects-dropdown').on('change', function() {
                var selectedValue = $(this).val();

                $('#project-list-cards .project-card').each(function() {
                    debugger
                    var createdDate = $(this).find('.CreatedDT').text();
                    var currentDate = new Date(); // Get the current date

                    // Calculate the date difference in milliseconds
                    var dateDifference = Number(currentDate - new Date(createdDate));


                    switch (selectedValue) {
                        case 'All':
                            $(this).show();
                            break;
                        case 'Today':
                            if (dateDifference < 86400000) { // Less than 24 hours
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                            break;
                        case 'Yesterday':
                            if (dateDifference >= 86400000 && dateDifference < 172800000) { // Between 24 and 48 hours
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                            break;
                        case 'Last7Days':
                            if (dateDifference < 604800000) { // Less than 7 days
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                            break;
                        case 'Last30Days':
                            if (dateDifference < 2592000000) { // Less than 30 days
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                            break;
                        case 'ThisMonth':
                            var currentMonth = currentDate.getMonth();
                            var cardMonth = new Date(createdDate).getMonth();

                            if (currentMonth === cardMonth) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                            break;
                        case 'LastYear':
                            var currentYear = currentDate.getFullYear();
                            var cardYear = new Date(createdDate).getFullYear();

                            if (currentYear === cardYear) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                            break;
                        default:
                            $(this).hide();
                            break;
                    }
                });
            });
        });


        function GridPagination() {
            const tableRows = $(".project-card");
            // Pagination initialization
            var itemsPerPage = 4;
            var currentPage = 1;
            var totalItems = $(".project-card").length;
            var totalPages = Math.ceil(totalItems / itemsPerPage);

            function updateGridPagination() {
                $(".grid-pg-wrap .grid-listjs-pgn").empty();
                for (var i = 1; i <= totalPages; i++) {
                    var activeClass = (i === currentPage) ? "active" : "";
                    $(".grid-pg-wrap .grid-listjs-pgn").append(
                        '<li class="page-item ' + activeClass + '"><a class="page-link" href="#">' + i + '</a></li>'
                    );
                }
            }

            // Pagination click event
            $(".grid-pg-wrap .grid-listjs-pgn").on("click", "a.page-link", function(e) {
                e.preventDefault();
                currentPage = parseInt($(this).text());
                updateGridPagination();
                updateGridRows();
            });
            $(".pagination-prev").on("click", function() {
                if (currentPage > 1) {
                    currentPage--;
                    updateGridPagination();
                    updateGridRows();
                }
            });

            $(".pagination-next").on("click", function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateGridPagination();
                    updateGridRows();
                }
            });

            function updateGridRows() {
                var startIndex = (currentPage - 1) * itemsPerPage;
                var endIndex = startIndex + itemsPerPage;
                $(".project-card").hide().slice(startIndex, endIndex).show();
            }

            // Initial setup
            updateGridPagination();
            updateGridRows();
        }
    </script>


    <script>
        $(document).ready(function() {
            $.ajax({
                url: './php/GetProjectList.php',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        // console.log(item);
                        let cardString = `<div class="col-xxl-3 col-sm-6 project-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="p-3 mt-n3 mx-n3 bg-soft-secondary rounded-top">
                                                        <div class="text-center pb-3">
                                                            <img src="${item.ProjectLogo == null ? 'assets/images/brands/slack.png' :item.ProjectLogo}" alt="" height="100">
                                                        </div>
                                                    </div>

                                                    <div class="py-3">
                                                    <div class="d-flex mb-2">
                                                        <h5 class="fs-14 mb-3 flex-grow-1 text-truncate"><a href="projects-overview.php?pid=${item.SrNo}" class="text-dark project-title">${item.ProjectName}</a></h5>
                                                        <div class="dropdown">
                                                                <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                                    <li><a class="dropdown-item" href="projects-overview.php?pid=${item.SrNo}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="row gy-3">
                                                            <div class="col-12">
                                                                <div>
                                                                    <p class="text-muted mb-1">Created By</p>
                                                                    <h5 class="fs-14 mb-1"><a href="pages-profile.php?id=${btoa(item.Admin_emp_id)}" class="text-soft-dark">${item.EmpName}</a></h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div>
                                                                    <p class="text-muted mb-1">Priority</p>
                                                                    <div class="badge badge-soft-${item.Priority_Color} fs-12">${item.ProjectPriority}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div>
                                                                    <p class="text-muted mb-1">Start Date</p>
                                                                    <h5 class="fs-14">${moment(item.Start_Date).format('DD-MM-YYYY')}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row gy-3">
                                                            <div class="col-6">
                                                                <div>
                                                                    <p class="text-muted mb-1">Created Date</p>
                                                                    <h5 class="fs-14 ">${moment(item.Created_Date).format('DD-MM-YYYY hh:mm A')}</h5>
                                                                    <div class="badge badge-soft-warning fs-12 CreatedDT d-none">${item.Created_Date}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div>
                                                                    <p class="text-muted mb-1">End Date</p>
                                                                    <h5 class="fs-14">${moment(item.End_Date).format('DD-MM-YYYY')}</h5>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div>
                                                        <div class="d-flex mb-2">
                                                            <div class="flex-grow-1">
                                                                <div>Sub-Tasks</div>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <div><i class="ri-list-check align-bottom me-1 text-muted"></i> ${item.subtaskCompletedCount}/${item.subtaskCount}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm animated-progress">
                                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="${item.subtaskCompletedCount/item.subtaskCount * 100}" aria-valuemin="0" aria-valuemax="100" style="width: ${item.subtaskCompletedCount/item.subtaskCount * 100}%;"></div>
                                                            <!-- /.progress-bar -->
                                                        </div><!-- /.progress -->
                                                    </div>

                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>`;

                        $('#project-list-cards').append(cardString);
                    })
                    GridPagination()
                }
            })
        })
    </script>

</body>

</html>