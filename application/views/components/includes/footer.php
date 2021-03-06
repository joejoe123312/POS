<!-- BEGIN MENUBAR-->
<div id="menubar" class="menubar-inverse ">
	<div class="menubar-fixed-panel">
		<div>
			<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		<div class="expanded">
			<a href="<?= base_url() ?>html/dashboards/dashboard.html">
				<span class="text-lg text-bold text-primary ">MATERIAL&nbsp;ADMIN</span>
			</a>
		</div>
	</div>
	<div class="menubar-scroll-panel">

		<!-- BEGIN MAIN MENU -->
		<ul id="main-menu" class="gui-controls">

			<!-- BEGIN DASHBOARD -->
			<li>
				<a href="<?= base_url() . "Dashboard" ?>" class="active">
					<div class="gui-icon"><i class="md md-home"></i></div>
					<span class="title">Dashboard</span>
				</a>
			</li>
			<!--end /menu-li -->
			<!-- END DASHBOARD -->
			<!-- Manage Doctors -->
			<li>
				<a href="<?= base_url() . "Products" ?>">
					<div class="gui-icon"><i class="fa fa-plus"></i></div>
					<span class="title">Manage products</span>
				</a>
			</li>
			<!-- End Manage Doctors -->
			<!-- Manage Doctors -->
			<!-- <li class="gui-folder">
				<a>
					<div class="gui-icon"><i class="md md-local-hospital"></i></div>
					<span class="title">Programs</span>
				</a>
				
				<ul style="display: none;">
					<li><a href="<?= base_url() ?>BabiesImmunization"><span class="title">Immunization of babies</span></a></li>
					<li><a href="<?= base_url() ?>PregnantImmunization"><span class="title">Immunization of pregnant</span></a></li>
					<li><a href="<?= base_url() ?>HighbloodMaintenance"><span class="title">Highblood maintenance</span></a></li>
					<li><a href="<?= base_url() ?>TuberculosisMaintenance"><span class="title">Tuberculosis maintenance</span></a></li>
					<li><a href="<?= base_url() ?>FamilyPlanning"><span class="title">Family planning</span></a></li>
					<li><a href="<?= base_url() ?>UnderweightChildren"><span class="title">Monitoring of underweight children</span></a></li>
					<li><a href="<?= base_url() ?>EnvironmentalSanitation"><span class="title">Environmental Sanitation</span></a></li>
				</ul>
				
			</li> -->
			<!-- End Manage Doctors -->



		</ul>
		<!--end .main-menu -->
		<!-- END MAIN MENU -->

		<div class="menubar-foot-panel">
			<small class="no-linebreak hidden-folded">
			</small>
		</div>
	</div>
	<!--end .menubar-scroll-panel-->
</div>
<!--end #menubar-->
<!-- END MENUBAR -->



</div>
<!--end #base-->
<!-- END BASE -->
<!-- BEGIN JAVASCRIPT -->
<script src="<?= base_url() ?>assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="<?= base_url() ?>assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/libs/spin.js/spin.min.js"></script>
<script src="<?= base_url() ?>assets/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="<?= base_url() ?>assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="<?= base_url() ?>assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?= base_url() ?>assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/source/App.js"></script>
<script src="<?= base_url() ?>assets/js/core/source/AppNavigation.js"></script>
<script src="<?= base_url() ?>assets/js/core/source/AppOffcanvas.js"></script>
<script src="<?= base_url() ?>assets/js/core/source/AppCard.js"></script>
<script src="<?= base_url() ?>assets/js/core/source/AppForm.js"></script>
<script src="<?= base_url() ?>assets/js/core/source/AppNavSearch.js"></script>
<script src="<?= base_url() ?>assets/js/core/source/AppVendor.js"></script>
<script src="<?= base_url() ?>assets/js/core/demo/Demo.js"></script>
<script src="<?= base_url() ?>assets/js/core/demo/DemoTableDynamic.js"></script>
<!-- Commented out not working -->
<!-- <script src="<?= base_url() ?>assets/js/core/demo/DemoDashboard.js"></script> -->
<!-- END JAVASCRIPT -->

</body>

</html>
