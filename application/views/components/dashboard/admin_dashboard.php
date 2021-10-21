<!-- BEGIN BASE-->
<div id="base">

    <!-- BEGIN OFFCANVAS LEFT -->
    <div class="offcanvas">
    </div>
    <!--end .offcanvas-->
    <!-- END OFFCANVAS LEFT -->

    <!-- BEGIN CONTENT-->

    <div id="content">
        <section>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="alert alert-callout alert-success no-margin">
                                    <h1 class="pull-right text-success"><i class="fa fa-users"></i></h1>
                                    <strong class="text-xl" id="numberOfPatients">0</strong><br>
                                    <span class="opacity-50">Number of patients</span>
                                </div>
                            </div>
                            <!--end .card-body -->
                        </div>
                        <!--end .card -->
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="alert alert-callout alert-success no-margin">
                                    <h1 class="pull-right text-success"><i class="fa fa-users"></i></h1>
                                    <strong class="text-xl" id="numberOfDoctors">0</strong><br>
                                    <span class="opacity-50">Number of doctors</span>
                                </div>
                            </div>
                            <!--end .card-body -->
                        </div>
                        <!--end .card -->
                    </div>
                </div>

                <!-- Search Patient Record Box -->
                <div class="card tabs-left style-default-light" id="recordsTable">

                    <!-- BEGIN SEARCH BAR -->
                    <div class="card-body style-primary no-y-padding">
                        <form class="form form-inverse">
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-content">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Enter your search here" autocomplete="off">
                                        <div class="form-control-line"></div>
                                    </div>
                                    <div class="input-group-btn">
                                        <button class="btn btn-floating-action btn-default-bright" type="button" id="patientSearchBtn">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--end .form-group -->
                        </form>
                    </div>
                    <!--end .card-body -->
                    <!-- END SEARCH BAR -->

                    <!-- BEGIN TAB RESULTS -->
                    <ul class="card-head nav nav-tabs tabs-accent searchResult" data-toggle="tabs" style="display:none;">
                        <li class="active"><a href="#symptomsChief">Symptoms chief complains of patient</a></li>
                        <li class=""><a href="#vitalMeasure">Vital Signs Measure </a></li>
                        <li class=""><a href="#diagnoseToSeek">Diagnose to seek</a></li>
                        <li class=""><a href="#prescriptionManagement">Prescription management</a></li>
                    </ul>
                    <!-- END TAB RESULTS -->

                    <!-- BEGIN TAB CONTENT -->
                    <div class="card-body tab-content style-default-bright searchResult" style="display:none;">

                        <div class="tab-pane active" id="vitalMeasure">
                            <div class="row">
                                <div class="col-lg-12">

                                    <!-- BEGIN PAGE HEADER -->
                                    <div class="margin-bottom-xxl">
                                        <span class="text-light text-lg"><strong>John Joel Centeno</strong></span>
                                        <div class="btn-group btn-group-sm pull-right">
                                            <button type="button" class="btn btn-primary-light dropdown-toggle" aria-expanded="false">
                                                <span class="fa fa-plus"></span> Add record
                                            </button>

                                        </div>
                                    </div>
                                    <!--end .margin-bottom-xxl -->
                                    <!-- END PAGE HEADER -->

                                    <!-- Begin Content Result-->
                                    <div class=" col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class=table table-striped no-margin">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Username</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Jacob</td>
                                                            <td>Thornton</td>
                                                            <td>@fat</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Larry</td>
                                                            <td>the Bird</td>
                                                            <td>@twitter</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end .card-body -->
                                        </div>
                                        <!--end .card -->
                                        <em class="text-caption">Please check the records above.</em>
                                    </div>
                                    <!-- End Content Result -->
                                </div>
                                <!--end .col -->
                            </div>
                            <!--end .row -->
                        </div>
                        <!--end .tab-pane -->
                    </div>
                    <!--end .card-body -->
                    <!-- END TAB CONTENT -->
                </div>
                <!-- End Search Patient Record Box -->


            </div>
            <!--end .section-body -->
        </section>
    </div>
    <!--end #content-->
    <!-- END CONTENT -->
    <script>
        $(document).ready(function() {
            // GET HOW MANY DOCTORS
            $.post("<?= base_url() ?>/Query_doctorRecord/getAll", function(resp) {
                resp = JSON.parse(resp);
                count = resp.length;
                $("#numberOfDoctors").text(count);
            });

            // GET HOW MANY PATIENTS
            $.post("<?= base_url() ?>/Query_patientRecord/getAll", function(resp) {
                resp = JSON.parse(resp);
                count = resp.length;
                $("#numberOfPatients").text(count);
            });

            $('#patientSearchBtn').on("click", function() {
                $(".searchResult").slideDown();

                let searchInput = $("#searchInput").val();

                $.post("<?= base_url() ?>/Query_patientRecord/multipleWhere", {
                    whereString: JSON.stringify([{
                        "fullname": searchInput
                    }])
                }, function(resp) {
                    console.log(resp);
                });
            });
        });
    </script>
    <script src="<?= base_url() ?>assets/js/Autocomplete.js"></script>
    <script>
        // AUTOCOMPLETE SCRIPT 
        $(document).ready(function() {
            $.post("<?= base_url() ?>/Query_patientRecord/getPatientFullNames", function(resp) {
                autocomplete(document.getElementById("searchInput"), JSON.parse(resp));
            });
        });
    </script>