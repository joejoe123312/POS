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

                    <script>
                        $(document).ready(function() {
                            function removeAllActiveTabPane() {
                                $('.tab-pane').removeClass("active");
                            }

                            $('#symptomsChiefLi').click(function() {
                                removeAllActiveTabPane();
                                $('#symptomsChief').addClass("active");
                            })

                            $('#vitalMeasureLi').click(function() {
                                removeAllActiveTabPane();
                                $('#vitalMeasure').addClass("active");
                            });

                            $('#diagnoseToSeekLi').click(function() {
                                removeAllActiveTabPane();
                                $('#diagnoseToSeek').addClass("active");
                            });

                            $('#prescriptionManagementLi').click(function() {
                                removeAllActiveTabPane();
                                $('#prescriptionManagement').addClass("active");
                            });

                        });
                    </script>

                    <!-- BEGIN TAB RESULTS -->
                    <ul class="card-head nav nav-tabs tabs-accent searchResult" data-toggle="tabs" style="display:none;">
                        <li id="symptomsChiefLi" class="active"><a href="#symptomsChief">Symptoms chief complains of patient</a></li>
                        <li id="vitalMeasureLi" class=""><a href="#vitalMeasure">Vital Signs Measure </a></li>
                        <li id="diagnoseToSeekLi" class=""><a href="#diagnoseToSeek">Diagnose to seek</a></li>
                    </ul>
                    <!-- END TAB RESULTS -->

                    <!-- BEGIN TAB CONTENT -->
                    <div class="card-body tab-content style-default-bright searchResult" style="display:none;">

                        <!-- symptoms chief -->
                        <div class="tab-pane active" id="symptomsChief">
                            <?php $this->load->view("components/dashboard/symptomsChief"); ?>
                        </div>

                        <!-- Vital signs -->
                        <div class="tab-pane" id="vitalMeasure">
                            <?php $this->load->view("components/dashboard/vitalMeasure"); ?>
                        </div>
                        <!-- Vital signs -->

                        <!-- Diagnose -->
                        <div class="tab-pane" id="diagnoseToSeek">
                            <?php $this->load->view("components/dashboard/diagnoseToSeek"); ?>
                        </div>
                        <!-- Diagnose -->

                    </div> <!-- END TAB CONTENT-->
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
    let patientId = 0;
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
                resp = JSON.parse(resp)[0];
                let medicineUrl = "<?= base_url() ?>Medicine?id=" + resp.id;

                // change the value of the search button to the resp.id 
                $('#patientSearchBtn').val(resp.id);

                // change the global variable
                patientId = resp.id;

                // change patient name 
                $('.patientName').text(resp.fullname);

                $("#medicineButton").attr('href', medicineUrl);

                // refreshes
                refreshManageSymp(resp.id);
                refreshDiagnosis(patientId);
                // refreshes
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

<script>
    // REFRESH TABLES START
    function refreshManageSymp(patientId) {
        $.post("<?= base_url() ?>Query_symptomsComplains/getForTable", {
            patient_id: patientId
        }, function(resp) {
            $("#tbdSymp").html(resp);
        });
    }

    function refreshManageVital(patientId) {
        $.post("<?= base_url() ?>Query_vitalMeasure/getForTable", {
            patient_id: patientId
        }, function(resp) {
            $("#tbdVitalMeasure").html(resp);
        });
    }

    function refreshDiagnosis(patientId) {
        $.post("<?= base_url() ?>Query_diagnoseToSeek/getForTable", {
            patient_id: patientId
        }, function(resp) {
            $("#tbdDiagnoseToSeek").html(resp);
        });
    }
    // REFRESH TABLES END
</script>

<!-- SYMP COMPLAIN START -->
<script>
    $(document).ready(function() {

        // MANAGE SYMPTOMS
        $(document).on("submit", "#sympForm", function(e) {
            e.preventDefault();
            let inpComplain = $("#inpComplain").val();

            // send post request 
            $.post("<?= base_url() ?>Command_symptomsComplains/create", {
                patient_id: patientId,
                complain: inpComplain
            }, function(resp) {
                $("#sympModal").modal("hide");

                refreshManageSymp(patientId)

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Complain recorded',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        $(document).on("click", '.sympEdit', function() {
            let sympId = $(this).val();

            // get details of the complain
            $.post("<?= base_url() ?>Query_symptomsComplains/getById", {
                id: sympId
            }, function(resp){
                resp = JSON.parse(resp)[0];
                $("#inpComplainUpt").val(resp.complain);

                $("#submitUpdateSymp").val(sympId);

                $('#sympModalUpdate').modal("show");
            });
        });

        $(document).on("submit", "#sympFormUpdate", function(e) {
            e.preventDefault();
            let inpComplain = $("#inpComplainUpt").val();
            let Id = $("#submitUpdateSymp").val();


            // send post request 
            $.post("<?= base_url() ?>Command_symptomsComplains/update", {
                id: Id,
                patient_id: patientId,
                complain: inpComplain
            }, function(resp) {
                $("#sympModal").modal("hide");

                refreshManageSymp(patientId)

                $('#sympModalUpdate').modal("hide");

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Complain recorded',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        $(document).on("click", '.sympDelete', function() {
            let sympId = $(this).val();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post("<?= base_url() ?>Command_symptomsComplains/delete", {
                        id: sympId
                    }, function() {
                        Swal.fire(
                            'Deleted!',
                            'Your complain has been deleted.',
                            'success'
                        );

                        refreshManageSymp(patientId);
                    });
                }
            });
        });
    });
</script>
<!-- SYMP COMPLAIN END -->


<!-- VITAL START -->
<script>
    $(document).ready(function() {
        refreshManageVital(patientId);

        // MANAGE SYMPTOMS
        $(document).on("submit", "#vitalForm", function(e) {
            e.preventDefault();
            let inpVital = $("#inpVital").val();

            // send post request 
            $.post("<?= base_url() ?>Command_vital/create", {
                patient_id: patientId,
                vital_measure: inpVital
            }, function(resp) {
                $("#vitalModal").modal("hide");

                refreshManageVital(patientId)

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Vital measurement recorded',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        $(document).on("click", '.vitalEdit', function() {
            let vitalId = $(this).val();

            // get details of the complain
            $.post("<?= base_url() ?>Query_vitalMeasure/getById", {
                id: vitalId
            }, function(resp){
                resp = JSON.parse(resp)[0];
                $("#inpVitalUpdate").val(resp.vital_measure);

                $("#submitUpdateVital").val(vitalId);

                $('#vitalModalUpdate').modal("show");
            });
        });

        $(document).on("submit", "#vitalFormUpdate", function(e) {
            e.preventDefault();
            let inpUpdateVital = $("#inpVitalUpdate").val();
            let Id = $("#submitUpdateVital").val();


            // send post request 
            $.post("<?= base_url() ?>Command_vital/update", {
                id: Id,
                patient_id: patientId,
                vital_measure: inpUpdateVital
            }, function(resp) {
                $("#vitalModalUpdate").modal("hide");

                refreshManageVital(patientId)

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Vital measurement recorded',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        $(document).on("click", '.vitalDelete', function() {
            let sympId = $(this).val();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post("<?= base_url() ?>Command_vital/delete", {
                        id: sympId
                    }, function() {
                        Swal.fire(
                            'Deleted!',
                            'Your vital measurement has been deleted.',
                            'success'
                        );

                        refreshManageVital(patientId);
                    });
                }
            });
        });
    });
</script>
<!-- VITAL END -->


<!-- DIAGNOSIS START -->
<script>
    $(document).ready(function() {

        // MANAGE SYMPTOMS
        $(document).on("submit", "#diagnosisForm", function(e) {
            e.preventDefault();
            let inpDiagnosis = $("#inpDiagnosis").val();

            // send post request 
            $.post("<?= base_url() ?>Command_diagnoseToSeek/create", {
                patient_id: patientId,
                diagnosis: inpDiagnosis
            }, function(resp) {
                $("#diagnosisModal").modal("hide");

                refreshDiagnosis(patientId)

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Diagnosis recorded',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        $(document).on("click", '.diagEdit', function() {
            let diagId = $(this).val();

            // get details of the complain
            $.post("<?= base_url() ?>Query_diagnoseToSeek/getById", {
                id: diagId
            }, function(resp){
                resp = JSON.parse(resp)[0];
                $("#inpDiagnosisUpdate").val(resp.diagnosis);

                $("#submitUpdateDiag").val(diagId);

                $('#diagnosisModalUpdate').modal("show");
            });
        });

        $(document).on("submit", "#diagnosisFormUpdate", function(e) {
            e.preventDefault();
            let inpUpdateDiagnosis = $("#inpDiagnosisUpdate").val();
            let Id = $("#submitUpdateDiag").val();


            // send post request 
            $.post("<?= base_url() ?>Command_diagnoseToSeek/update", {
                id: Id,
                patient_id: patientId,
                diagnosis: inpUpdateDiagnosis
            }, function(resp) {
                $("#diagnosisModalUpdate").modal("hide");

                refreshDiagnosis(patientId)

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Diagnosis Updated successfully',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });

        $(document).on("click", '.diagDelete', function() {
            let diagnoseId = $(this).val();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post("<?= base_url() ?>Command_diagnoseToSeek/delete", {
                        id: diagnoseId
                    }, function() {
                        Swal.fire(
                            'Deleted!',
                            'Your diagnosis has been deleted.',
                            'success'
                        );

                        refreshDiagnosis(patientId);
                    });
                }
            });
        });
    });
</script>
<!-- DIAGNOSIS END -->