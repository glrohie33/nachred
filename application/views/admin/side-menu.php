<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?= base_url() ?>admin/dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li>
					<a href="#region" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Regions</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="region" class="collapse ">
						<ul class="nav">
							<li><a href="<?= base_url() ?>admin/region/" class="">Regions</a></li>
							<li><a href="<?= base_url() ?>admin/region/add" class="">Add New</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#state" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>State</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="state" class="collapse ">
						<ul class="nav">
							<li><a href="<?= base_url() ?>admin/state/" class="">State</a></li>
							<li><a href="<?= base_url() ?>admin/state/add" class="">Add New</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#dam" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Dam</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="dam" class="collapse ">
						<ul class="nav">
							<li><a href="<?= base_url() ?>admin/dam/" class="">Dams</a></li>
							<li><a href="<?= base_url() ?>admin/dam/add" class="">Add New</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#slider" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Slider</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="slider" class="collapse ">
						<ul class="nav">
							<li><a href="<?= base_url() ?>admin/slider/" class="">Slider</a></li>
							<li><a href="<?= base_url() ?>admin/slider/add" class="">Add New</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</nav>
	</div>
</div>
