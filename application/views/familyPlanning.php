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

                <!-- Search Patient Record Box -->
                <div class="card tabs-left style-default-light" style="margin-top: 30px;" id="recordsTable">

                    <div class="card-body" style="background-color: whitesmoke; width: 100%;" align="center">
                        <h1><?= $title ?></h1>
                        <hr style="width: 15%; border: none; height: 5px; background: #0AA89E;">
                        <h3><?= date("Y-m-d") ?></h3>
                    </div>

                    <!-- BEGIN SEARCH BAR -->
                    <div class="card-body style-primary no-y-padding">
                        <form class="form form-inverse">
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-content">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Enter patient's name here" autocomplete="off">
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

                    <div class="card-body" style="background-color: #EFEFEF;display:none;" id="recordTable">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Contraceptives</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>


                        <div class="row" align="center" style="margin-top: 20px">
                            <button class="btn btn-primary" id="recordBtn" data-toggle="modal" data-target="#modal">Add today's record</button>
                        </div>
                    </div>


                    <!--end .card-body -->
                    <!-- END TAB CONTENT -->
                </div>
                <!-- End Search Patient Record Box -->


            </div>
            <!--end .section-body -->
        </section>
    </div>
    <!-- CREATE MODAL -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 align="center" class="modal-title" id="exampleModalLabel">Create record</h2>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        <div class="form-group">
                            <label for="">Enter contraceptives given</label>
                            <textarea id="contraceptives" class="form-control" placeholder="Enter given contraceptives" cols="30" rows="10"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CREATE MODAL -->

    <!-- UPDATE MODAL -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 align="center" class="modal-title" id="exampleModalLabel">Update record</h2>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <div class="form-group">
                            <label for="">Enter contraceptives given</label>
                            <textarea id="contraceptivesUpdate" class="form-control" placeholder="Enter given contraceptives" cols="30" rows="10"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="updateBtn" class="btn btn-primary">UPDATE</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- UPDATE MODAL -->

    <script>
        let patientId = 0;
        let patientName = "";

        $(document).ready(function() {
            // SEARCH SUBMIT AJAX
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
                    patientName = resp.fullname;

                    $("#recordBtn").val(resp.id);

                    $("#recordTable").slideDown();

                    // refreshes
                    refresh();
                    // refreshes
                });
            });

            $(document).on("click", ".update", function() {
                let id = $(this).val();

                $.post("<?= base_url() . $controllerName ?>/getById", {
                    id: id
                }, function(resp) {
                    resp = JSON.parse(resp)[0];

                    $("#contraceptivesUpdate").val(resp.contraceptive);

                    $('#updateBtn').val(resp.id);
                    $("#updateModal").modal("show");
                });
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();

                $.post("<?= base_url() . $controllerName ?>/update", {
                    contraceptives: $("#contraceptivesUpdate").val(),
                    patientId: patientId,

                    id: $('#updateBtn').val()
                }, function() {
                    refresh();

                    $('#updateModal').modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Given contraceptive updated successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            });

            // SUBMIT AJAX
            $("#createForm").submit(function(e) {
                e.preventDefault();

                let contraceptives = $("#contraceptives").val();
                $.post("<?= base_url() . $controllerName ?>/create", {
                    contraceptives: contraceptives,
                    id: patientId
                }, function() {
                    refresh();

                    $('#modal').modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Given contraceptive recorded successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            });

            // DELETE BTN 
            $(document).on("click", ".delete", function() {
                let id = $(this).val();

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
                        $.post("<?= base_url() . $controllerName ?>/delete", {
                            id: id
                        }, function() {
                            refresh();

                            Swal.fire(
                                'Deleted!',
                                'Record has been deleted.',
                                'success'
                            );
                        });
                    }
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
        function refresh() {
            $.post("<?= base_url() . $controllerName ?>/getByFullName", {
                fullname: patientName
            }, function(resp) {
                $("tbody").html(resp);
            });
        }
        // REFRESH TABLES END
    </script>