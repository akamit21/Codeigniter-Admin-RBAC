<!-- inner-page -->
		<section>
			<div class="plants-details-bg py-5">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="main-heading text-center my-5">
								<h5 class="pt-5">Plant Details</h5>
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="#">Home</a></li>
										<li class="breadcrumb-item"><a href="#">Plant List</a></li>
										<li class="breadcrumb-item active" aria-current="page">Plant Name</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="inner-main-area py-5">
				<div class="container">
					<div class="row">
						<div class="col-12" >
							<ul>
								<?php foreach ($lists as $list): ?>
									<li>
									<a href="<?= site_url('website/plants/details/' . $list->botanical_name) ?>"><?= $list->plant_name ?></a></li>.
								<?php endforeach; ?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>