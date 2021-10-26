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

                    <button type="button" class="btn btn-primary btn-sm" id="addBtn">
                        Time in
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
                                            <th>Date</th>
                                            <th>Time</th>
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
   

</div>
<script>
    $(document).ready(function() {
        // GET ALL PATIENTS
        refreshTable();
        
        function refreshTable() {
            $("tbody").load("<?= base_url() ?>/Query_doctorTimeIn/getAllFortable?id=<?= $id ?>");
        }

        // CREATE
        $(document).on("click", "#addBtn", () => $('form').attr("id", "createForm"));

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
                    $.post("<?= base_url() ?>/Command_doctorTimeIn/delete", {
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
        $(document).on("click", "#addBtn", function() {
            
            $('#modal').modal("hide");

            // create command post ajax 
            $.post("<?= base_url() ?>Command_doctorTimeIn/create", {
                doctor_id: "<?= $id ?>",
            }, function(resp) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Time in successfully',
                    showConfirmButton: false,
                    timer: 1500
                });

                refreshTable();
            });
        });

        
    });
</script>