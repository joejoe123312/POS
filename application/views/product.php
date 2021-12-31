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
					<h1>Manage Products</h1>

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
											<th>Product name</th>
											<th>SRP</th>
											<th>Mark up</th>
											<th>Total</th>
											<th>Quantity</th>
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
				<form id="createForm">
					<div class="modal-header">
						<h3 align="center" class="modal-title" id="modalTitle">New product</h3 align="center">
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Product name</label>
							<input type="text" placeholder="Enter product name" id="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Srp</label>
							<input type="number" placeholder="Enter srp" id="srp" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Mark up</label>
							<input type="number" placeholder="Enter mark up" id="markup" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Quantity</label>
							<input type="number" placeholder="Enter quantity" id="quantity" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Total</label>
							<input type="number" placeholder="Total will be displayed automatically" disabled id="total" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="submitBtn">CREATE</button>
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
			$("tbody").load("<?= base_url() ?>/Products/refresh");
		}

		// CREATE
		$(document).on("click", "#addBtn", () => $('form').attr("id", "createForm"));

		// EDIT
		$(document).on("click", ".edit", function() {
			let Id = $(this).val();

			$.post("<?= base_url() ?>/Products/getProdById", {
				id: Id
			}, function(resp) {
				resp = JSON.parse(resp)[0];
				console.log(resp);
				// change the modal title 
				$('#modalTitle').text("UPDATE");

				$("#name").val(resp.name);
				$("#srp").val(resp.srp);
				$("#markup").val(resp.markup);
				$("#quantity").val(resp.quantity);


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
					$.post("<?= base_url() ?>/Products/delete", {
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
			$.post("<?= base_url() ?>Products/add", {
				name: $("#name").val(),
				srp: $("#srp").val(),
				markup: $("#markup").val(),
				quantity: $("#quantity").val()
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

			$.post("<?= base_url() ?>/Products/edit", {
				id: $("#submitBtn").val(),
				name: $("#name").val(),
				srp: $("#srp").val(),
				markup: $("#markup").val(),
				quantity: $("#quantity").val()
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

		$(document).on("click", ".visit", function() {
			let id = $(this).val();

			window.location.replace("<?= base_url() ?>Doctors/visitations?id=" + id);
		});
	});
</script>
