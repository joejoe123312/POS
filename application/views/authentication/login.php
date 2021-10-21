<!-- BEGIN LOGIN SECTION -->
<section class="section-account">
	<div class="img-backdrop" style="background-image: url('assets/img/img16.jpg')"></div>
	<div class="spacer"></div>
	<div class="card contain-sm style-transparent">
		<div class="card-body">
			<div class="col">
				<div class="col-sm-12">
					<br />
					<span class="text-lg text-bold text-primary">Sign In</span>
					<br /><br />
					<form class="form floating-label" action="" accept-charset="utf-8" method="post">
						<div class="form-group">
							<input type="text" class="form-control" id="username" name="username">
							<label for="username">Username</label>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="password" name="password">
							<label for="password">Password</label>
						</div>
						<br />
						<div class="row">
							<div class="col-xs-6 text-left">
								<div class="checkbox checkbox-inline checkbox-styled">
									<label>
										<input type="checkbox"> <span>Remember me</span>
									</label>
								</div>
							</div>
							<!--end .col -->
							<div class="col-xs-6 text-right">
								<button class="btn btn-primary btn-raised" type="submit">Login</button>
							</div>
							<!--end .col -->
							<div class="col-sm-12  text-center">
								<br><br>
								<?php $contact = base_url() . "Contact_Page" ?>

								<h5 class="text-light" style="color:blue">
									Contact us <a href="<?= $contact ?>">here...</a>
								</h5>

								<br><br>

							</div>
							<!--end .col -->
						</div>
						<!--end .row -->
					</form>
				</div>
				<!--end .col -->

			</div>
			<!--end .row -->
		</div>
		<!--end .card-body -->
	</div>
	<!--end .card -->
</section>
<!-- END LOGIN SECTION -->