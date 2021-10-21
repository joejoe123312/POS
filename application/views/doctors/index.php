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
                    <h4>Manage Doctors</h4>

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal" id="addBtn">
                        Add
                    </button>
                </div>

                <div style="margin-bottom:15px"></div>
                &nbsp;
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
                                            <th>Contact number</th>
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
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h3 align="center" class="modal-title" id="modalTitle">CREATE</h3 align="center">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>First name</label>
                                <input type="text" placeholder="Enter first name here" id="firstname" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Middle name</label>
                                <input type="text" placeholder="Enter middle name here" id="middlename" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Last name</label>
                                <input type="text" placeholder="Enter last name here" id="lastname" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Contact number</label>
                            <input type="text" placeholder="Enter contact number here" id="contactNumber" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        // GET ALL PATIENTS
        refreshTable();

        function refreshTable() {
            $("tbody").load("<?= base_url() ?>/Query_doctorRecord/getAllFortable");
        }

        // CREATE
        $(document).on("click", "#addBtn", () => $('form').attr("id", "createForm"));

        // EDIT
        $(document).on("click", ".edit", function() {
            let Id = $(this).val();

            $.post("<?= base_url() ?>/Query_doctorRecord/getById", {
                id: Id
            }, function(resp) {
                resp = JSON.parse(resp)[0];

                // change the modal title 
                $('#modalTitle').text("UPDATE");

                $("#firstname").val(resp.firstname);
                $("#middlename").val(resp.middlename);
                $("#lastname").val(resp.lastname);
                $("#contactNumber").val(resp.contact_number);

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
                    $.post("<?= base_url() ?>/Command_doctorRecord/delete", {
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
            $.post("<?= base_url() ?>/Command_doctorRecord/create", {
                firstname: $("#firstname").val(),
                middlename: $("#middlename").val(),
                lastname: $("#lastname").val(),
                contact_number: $("#contactNumber").val()
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