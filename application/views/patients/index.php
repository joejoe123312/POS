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
            <div class="row">
                <div class="col-lg-12">
                    <h4>Manage Patient</h4>
                </div>
                <!--end .col -->

                <!--end .col -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First name</th>
                                            <th>Middle name</th>
                                            <th>Last name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>Civil status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!--end .table-responsive -->
                        </div>
                        <!--end .card-body -->
                    </div>
                    <!--end .card -->
                </div>
                <!--end .col -->
            </div>
        </section>
    </div>



    <!--end #content-->
    <!-- END CONTENT -->




    <script>
        $(document).ready(function() {
            // GET ALL PATIENTS
            refreshTable();

            function refreshTable() {
                $("tbody").load("<?= base_url() ?>/Query_patientRecord/getAllPatientsForTable");
            }

            // CREATE
            $(document).on("click", "#addBtn", () => $('form').attr("id", "createForm"));

            // EDIT
            $(document).on("click", ".edit", function() {
                let Id = $(this).val();

                $.post("<?= base_url() ?>/Query_patientRecord/getById", {
                    id: Id
                }, function(resp) {
                    resp = JSON.parse(resp)[0];

                    // change the modal title 
                    $('#modalTitle').text("UPDATE");

                    $("#firstname").val(resp.firstname);
                    $("#middlename").val(resp.middlename);
                    $("#lastname").val(resp.lastname);
                    $("#age").val(resp.age);
                    $("#gender").val(resp.gender);
                    $("#height").val(resp.height);
                    $("#weight").val(resp.weight);
                    $("#civil_status").val(resp.civil_status);

                    // change id of createForm -> updateForm
                    $("form").attr("id", "updateForm");

                    // change value of submit button to be used in post request 
                    $("#submitBtn").val(resp.id);

                    $('#modal').modal("show");
                });
            });

            //DELETE BUTTON
            $(document).on("click", ".delete", function() {
                let Id = $(this).val();

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

                        // SEND DELETION POST REQUEST
                        $.post("<?= base_url() ?>/Command_patient/delete", {
                            id: Id
                        }, function() {
                            refreshTable();

                            Swal.fire(
                                'Deleted!',
                                'Record has been deleted',
                                'success'
                            );
                        });
                    }
                });

            });

            // CREATE POST REQUEST FORM SUBMISITION
            $(document).on("submit", "#createForm", function(event) {
                event.preventDefault();
                $('#modal').modal("hide");

                // create command post ajax 
                $.post("<?= base_url() ?>/Command_patient/create", {
                    firstname: $("#firstname").val(),
                    middlename: $("#middlename").val(),
                    lastname: $("#lastname").val(),
                    age: $("#age").val(),
                    gender: $("#gender").val(),
                    height: $("#height").val(),
                    weight: $("#weight").val(),
                    civil_status: $("#civil_status").val()
                }, function(resp) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Created successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    refreshTable();
                });
            });

            // UPDATE POST REQUEST FORM SUBMISITION
            $(document).on("submit", "#updateForm", function(event) {
                event.preventDefault();

                $.post("<?= base_url() ?>/Command_patient/update", {
                    id: $("#submitBtn").val(),
                    firstname: $("#firstname").val(),
                    middlename: $("#middlename").val(),
                    lastname: $("#lastname").val(),
                    age: $("#age").val(),
                    gender: $("#gender").val(),
                    height: $("#height").val(),
                    weight: $("#weight").val(),
                    civil_status: $("#civil_status").val()
                }, function(resp) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Updated successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    refreshTable();

                    $('#modal').modal("hide");
                });

            });
        });
    </script>