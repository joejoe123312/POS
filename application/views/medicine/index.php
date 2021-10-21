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
                <center>

                    <div class="card-head style-primary">
                        <header>
                            <h2>Medicines given to : <?= $fullname ?></h2>
                        </header>
                    </div>
                </center>

                <div class="col-lg-12">
                    <button type="button" class="btn ink-reaction btn-primary" id="addBtn" data-toggle="modal" data-target="#modal" style="margin-top:5px;margin-bottom:5px">Button</button>

                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Given medicine</th>
                                            <th>Date</th>
                                            <th>Time</th>
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
            </div>
            <!--end .section-body -->
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
                        <h3 align="center" class="modal-title" id="modalTitle">ADD</h3 align="center">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Given medicine</label>
                            <textarea id="givenMedicine" placeholder="Ibeuprofen, Paracetamol etc..." class="form-control"></textarea>
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
            $("tbody").load("<?= base_url() ?>/Query_medicine/getAllForTable?id=" + "<?= $patientId ?>");
        }

        let patientId = "<?= $patientId ?>";

        // CREATE
        $(document).on("click", "#addBtn", () => $('form').attr("id", "createForm"));

        // EDIT
        $(document).on("click", ".edit", function() {
            let Id = $(this).val();

            $.post("<?= base_url() ?>/Query_medicine/getById", {
                id: Id
            }, function(resp) {
                resp = JSON.parse(resp)[0];

                // change the modal title 
                $('#modalTitle').text("UPDATE");

                $("#givenMedicine").val(resp.given_medicine);

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
                    $.post("<?= base_url() ?>/Command_medicine/delete", {
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
            $.post("<?= base_url() ?>/Command_medicine/create", {
                patient_id: patientId,
                given_medicine: $("#givenMedicine").val()
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

            $.post("<?= base_url() ?>/Command_medicine/update", {
                id: $("#submitBtn").val(),
                patient_id: patientId,
                given_medicine: $("#givenMedicine").val()
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