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
                <h1>Manage Patients</h1>
                
                <button class="btn btn-success btn-sm" id="addBtn"  data-toggle="modal" data-target="#modal">Add</button>

                <table class=table table-striped no-margin">
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
                      <!-- Ajax -->
                    </tbody>
                </table>
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
                        <label>Age</label>
                        <input type="number" placeholder="Enter age here" id="age" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <select name="" id="gender" class="form-control" required>
                            <option value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Height</label>
                            <input type="text" placeholder="Enter height here" id="height" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Weight</label>
                            <input type="text" placeholder="Enter weight here" id="weight" class="form-control" required>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <select name="" id="civil_status" class="form-control" required>
                            <option value="">Select civil status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                        </select>
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
    $(document).ready(function(){
        // GET ALL PATIENTS
        refreshTable();
        function refreshTable()
        {
            $("tbody").load("<?= base_url() ?>/Query_patientRecord/getAllPatientsForTable");
        }

        // CREATE
        $(document).on("click", "#addBtn", () => $('form').attr("id", "createForm"));
        
        // EDIT
        $(document).on("click",".edit", function(){
            let Id = $(this).val();
            
            $.post("<?= base_url() ?>/Query_patientRecord/getById", {
                id: Id
            }, function(resp){
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
        $(document).on("click", ".delete", function(){
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
                        id:Id
                    }, function(){
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
        $(document).on("submit", "#createForm",function(event){
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
            }, function(resp){
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
        $(document).on("submit", "#updateForm",function(event){
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
            }, function(resp){
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
    