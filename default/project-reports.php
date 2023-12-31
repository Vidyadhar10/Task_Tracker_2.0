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
    <title>Project Reports | Task Tracker</title>
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
                                <h4 class="mb-sm-0">Reports</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                        <li class="breadcrumb-item active">Project Reports</li>
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
                                            <h5 class="fs-16">Project Wise Reports</h5>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="project-dropdown-field" class="form-label">Select Project</label>
                                        <select class="form-control" data-trigger data-choices data-choices-search-true name="project-dropdown-field" id="project-dropdown-field" required />
                                        <option value="">Select</option>
                                        <?php
                                        include './php/connection.php';
                                        $query = "SELECT
                                        pd.ProjectName, pd.SrNo
                                        FROM
                                        `projectdata` AS pd
                                        WHERE
                                        pd.`Admin_emp_id` = '$Admin_id';";
                                        $result = $con->query($query);
                                        if ($result->num_rows > 0) {
                                            while ($optionData = $result->fetch_assoc()) {
                                                $options = $optionData['ProjectName'];
                                                $proj_priorityID = $optionData['SrNo'];
                                        ?>
                                                <option value="<?php echo $proj_priorityID; ?>"><?php echo $options; ?></option>
                                        <?php }
                                        } ?>
                                        <?php mysqli_close($con); ?>
                                        </select>
                                        <div class="invalid-feedback" id="proj-dd-inv-field">Please select project!</div>
                                    </div>
                                </div>

                                <div class="accordion accordion-flush filter-accordion">

                                    <div class="card-body border-bottom">
                                        <div>
                                            <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Project Details</p>
                                            <ul class="list-unstyled mb-0 filter-list">
                                                <li>
                                                    <a href="#" class="d-flex py-1 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">Estimated Start Date</h5>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <span class="badge fs-13 bg-light text-primary" id="ProjEstimatedStartDate"></span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="d-flex py-1 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">Estimated End Date</h5>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <span class="badge fs-13 bg-light text-primary" id="ProjEstimatedEndDate"></span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body border-bottom">
                                        <div>
                                            <ul class="list-unstyled mb-0 filter-list">
                                                <li>
                                                    <a href="#" class="d-flex py-1 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">Actual Start Date</h5>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <span class="badge fs-13 bg-light text-primary" id="proj-actual-start-date"></span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="d-flex py-1 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">Actual End Date</h5>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <span class="badge fs-13 bg-light text-primary" id="proj-actual-end-date"></span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-body border-bottom">
                                        <div class="row justify-content-between">
                                            <div class="col align-item-center">
                                                <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Tasks Count</p>
                                                <a href="#" class="d-flex py-1 align-items-center">
                                                    <div class="flex-shrink-0 ms-2">
                                                        <span class="badge fs-24 bg-light text-primary" id="proj-task-count"></span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Sub-Tasks Count</p>
                                                <a href="#" class="d-flex py-1 align-items-center">
                                                    <div class="flex-shrink-0 ms-2">
                                                        <span class="badge fs-24 bg-light text-primary" id="proj-subtask-count"></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body border-bottom">
                                        <div class="row align-item-center">
                                            <div class="col align-item-center">
                                                <button type="button" class="btn btn-danger" id="top-hign-btn"><i class=" ri-arrow-up-circle-line align-bottom me-1"></i> Top High</button>
                                            </div>
                                            <div class="col align-item-center">
                                                <button type="button" class="btn btn-primary" id="top-low-btn"><i class=" ri-arrow-down-circle-line align-bottom me-1"></i> Top Low</button>
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
                                            <h5 class="card-title mb-0">Performance</h5>
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
                                                    <input type="text" class="form-control search" id="search-input" placeholder="Search for employee name...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                            <!--end col-->

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
                                            <table class="table table-nowrap align-middle" id="report-table">
                                                <thead class="text-muted table-light">
                                                    <tr class="text-uppercase">
                                                        <th class="sort" data-sort="id">Sr no</th>
                                                        <th class="sort" data-sort="emp_name">Employee Name</th>
                                                        <th class="sort" data-sort="total_tasks">Total Tasks</th>
                                                        <th class="sort" data-sort="on_time">On time</th>
                                                        <th class="sort" data-sort="before_time">Before time</th>
                                                        <th class="sort" data-sort="after_time">after time</th>
                                                        <th class="sort" data-sort="sum">Sum</th>
                                                        <th class="sort" data-sort="percentage">percentage <i class="ri-percent-line"></i> </th>
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

    <script>
        //our scripts
        var filteredData = [];
        $(document).ready(function() {
            $.ajax({
                url: './php/GetProjectList.php',
                dataType: 'JSON',
                type: 'POST',
                data: {
                    empMobile: <?php echo $Admin_mob; ?>,
                },
                success: function(data) {
                    // console.log(data);
                    filteredData = $.grep(data, function(item) {
                        var pid = item.SrNo;
                        return pid;
                    });

                }
            })
        })
        $('#project-dropdown-field').on('change', function() {
            var projID = $(this).val();
            $.each(filteredData, function(index, item) {
                if (item.SrNo == projID) {
                    $('#ProjEstimatedStartDate').html(moment(item.Start_Date).format('DD MMM, YYYY'));
                    $('#ProjEstimatedEndDate').html(moment(item.End_Date).format('DD MMM, YYYY'));
                    $('#proj-task-count').html(item.totalTaskCount)
                    $('#proj-subtask-count').html(item.subtaskCount)

                    $.ajax({
                        url: './php/getTopHighPerformData.php',
                        dataType: 'JSON',
                        type: 'POST',
                        data: {
                            projID: $('#project-dropdown-field').val(),
                            projStart: item.Start_Date,
                            projEnd: item.End_Date
                        },
                        success: function(data) {
                            console.log(data);
                            $('#top-hign-btn').on('click', function() {
                                if ($('#project-dropdown-field').val() == '') {
                                    $("#proj-dd-inv-field").css('display', 'block');
                                } else {
                                    $("#proj-dd-inv-field").css('display', 'none');
                                    var topHighArray = data.TopHigh;
                                    if (topHighArray.length <= 0) {
                                        $('#report-table tbody').empty();
                                        $('.noresult').css('display', 'block')
                                        paginationWorkingBtns()

                                    } else {
                                        $('.noresult').css('display', 'none')
                                        $('#report-table tbody').empty();
                                        var srno = 1;
                                        $.each(topHighArray, function(index, dataItem) {
                                            var tablerow = `<tr>
                                                                <td class="id text-end"><a href="#" class="fw-medium link-primary">${srno++}</a></td>
                                                                <td class="emp_name">${dataItem.EmpNm}</td>
                                                                <td class="total_tasks text-end">${dataItem.TotalSubtasks}</td>
                                                                <td class="on_time text-end">${dataItem.OnTimeTasks}</td>
                                                                <td class="before_time text-end">${dataItem.BeforeTimeTasks}</td>
                                                                <td class="after_time text-end">${dataItem.AfterTimeTasks}</td>
                                                                <td class="sum text-end">${dataItem.sum}</td>
                                                                <td class="percentage text-end">${dataItem.percentage}</td>
                                                            </tr>`;
                                            $('#report-table tbody').append(tablerow);
                                        })
                                        paginationWorkingBtns()
                                        $('#exportButton').on('click', function() {
                                            // Get table data
                                            const table = $('#report-table');
                                            const ws = XLSX.utils.table_to_sheet(table[0]);

                                            // Create a workbook with the data
                                            const wb = XLSX.utils.book_new();
                                            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                                            // Save the workbook as XLSX file
                                            XLSX.writeFile(wb, 'project_Employees_report.xlsx');
                                        });
                                    }
                                }
                            })
                            $('#top-low-btn').on('click', function() {
                                if ($('#project-dropdown-field').val() == '') {
                                    $("#proj-dd-inv-field").css('display', 'block');
                                } else {
                                    var topLowArray = data.TopLow;
                                    if (topLowArray.length <= 0) {
                                        $('#report-table tbody').empty();
                                        $('.noresult').css('display', 'block')
                                    } else {
                                        $('.noresult').css('display', 'none')
                                        $('#report-table tbody').empty();
                                        paginationWorkingBtns()

                                        var srno = 1;
                                        $.each(topLowArray, function(index, dataItem) {
                                            var tablerow = `<tr>
                                                                <td class="id text-end"><a href="#" class="fw-medium link-primary">${srno++}</a></td>
                                                                <td class="emp_name">${dataItem.EmpNm}</td>
                                                                <td class="total_tasks text-end">${dataItem.TotalSubtasks}</td>
                                                                <td class="on_time text-end">${dataItem.OnTimeTasks}</td>
                                                                <td class="before_time text-end">${dataItem.BeforeTimeTasks}</td>
                                                                <td class="after_time text-end">${dataItem.AfterTimeTasks}</td>
                                                                <td class="sum text-end">${dataItem.sum}</td>
                                                                <td class="percentage text-end">${dataItem.percentage}</td>
                                                            </tr>`;
                                            $('#report-table tbody').append(tablerow);
                                        })
                                        paginationWorkingBtns()
                                        $('#exportButton').on('click', function() {
                                            // Get table data
                                            const table = $('#report-table');
                                            const ws = XLSX.utils.table_to_sheet(table[0]);

                                            // Create a workbook with the data
                                            const wb = XLSX.utils.book_new();
                                            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                                            // Save the workbook as XLSX file
                                            XLSX.writeFile(wb, 'project_Employees_report.xlsx');
                                        });
                                    }
                                }
                            })
                        }
                    })
                }
            })
        })

        function paginationWorkingBtns() {
            $("#search-input").on("keyup", function() {
                var searchText = $(this).val().toLowerCase();
                $("#report-table tbody tr").filter(function() {
                    // console.log(searchText);
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            const tableRows = $("#report-table tbody tr");

            // Pagination initialization
            var itemsPerPage = 10;
            var currentPage = 1;
            var totalItems = $("#report-table tbody tr").length;
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
                $("#report-table tbody tr").hide().slice(startIndex, endIndex).show();
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