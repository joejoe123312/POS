<div class="row" class="receiver">
    <div class="col-lg-12">

        <!-- BEGIN PAGE HEADER -->
        <div class="margin-bottom-xxl">
            <span class="text-light text-lg"><strong class="patientName"></strong></span><br>
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-primary-light dropdown-toggle" aria-expanded="false" data-toggle="modal" data-target="#vitalModal">
                    <span class="fa fa-plus"></span> Add record
                </button>

            </div>
        </div>


        <!-- Begin Content Result-->
        <div class=" col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class=table table-striped no-margin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Vital measure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbdVitalMeasure">
                        </tbody>
                    </table>
                </div>
                <!--end .card-body -->
            </div>
            <!--end .card -->
            <em class="text-caption">Please check the records above.</em>

            <a id="medicineButton"><button class="btn btn-primary btn-sm">Prescribed Medicine</button></a>
        </div>
        <!-- End Content Result -->
    </div>
    <!--end .col -->
</div>

<!-- Modal create -->
<div class="modal fade" id="vitalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" align="center" id="exampleModalLongTitle">Record vital signs</h2>
            </div>
            <div class="modal-body">
                <form id="vitalForm">
                    <div class="form-group">
                        <label>Enter complain here</label>
                        <textarea name="" id="inpVital" class="form-control" cols="30" rows="10" placeholder="Enter vital signs here. " required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal create -->


<!-- Modal update -->
<div class="modal fade" id="vitalModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" align="center" id="exampleModalLongTitle">Update vital signs</h2>
            </div>
            <div class="modal-body">
                <form id="vitalFormUpdate">
                    <div class="form-group">
                        <label>Enter complain here</label>
                        <textarea name="" id="inpVitalUpdate" class="form-control" cols="30" rows="10" placeholder="Enter vital signs here. " required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitUpdateVital">update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal update -->