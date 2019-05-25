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
										<li class="breadcrumb-item active" aria-current="page"><?= $info->plant_name ?></li>
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
						<div class="col-12">
							<div class="section-heading text-center pb-5">
								<h4 class="text-uppercase ff-bold"><?= $info->plant_name ?></h4>
								<div class="section-heading-after">
									<img src="<?= base_url(); ?>assets/img/icons/heading-icon-black.png" class="img-fluid" alt="heading-icon" />
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="plant-intro">
								<h4><?= $info->plant_name ?></h4>
								<p><em>Leguminosae or Fabaceae or Pea family</em></p>
								<table class="table table-borderless">
									<tbody>
										<tr>
											<th scope="row">Botanical Name: </th>
											<td>Cassia fistula, Senna fistula</td>
										</tr>
										<tr>
											<th scope="row">English Name: </th>
											<td>Indian Laburnum, Shower Of Gold, Pvdding Pipe</td>
										</tr>
										<tr>
											<th scope="row">Local Name: </th>
											<td>Amaltas, Bandarlauri, Girmalah, Punjabi - Amaltas, Bengali - Amaltas,Shondal, Sonali, Bandarlati, Marathi - Bahava, Tamil - Konnei, Sarakkonne, Telugu - Rela</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="col-lg-6">
							<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img src="<?= base_url(); ?>assets/img/inner-pages/plant-details-page/amaltas/amaltas1.jpeg" class="d-block w-100" alt="amaltas">
									</div>
									<div class="carousel-item">
										<img src="<?= base_url(); ?>assets/img/inner-pages/plant-details-page/amaltas/amaltas2.jpeg" class="d-block w-100" alt="amaltas">
									</div>
									<div class="carousel-item">
										<img src="<?= base_url(); ?>assets/img/inner-pages/plant-details-page/amaltas/amaltas3.jpeg" class="d-block w-100" alt="amaltas">
									</div>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="section-heading text-center py-5">
								<h4 class="text-uppercase ff-bold">More Information</h4>
								<div class="section-heading-after">
									<img src="<?= base_url(); ?>assets/img/icons/heading-icon-black.png" class="img-fluid" alt="heading-icon" />
								</div>
							</div>
							<div class="about-plant">
								<div class="identification">
									<h5>Unique identification feature</h5>
									<ul class="list-unstyled">
										<li>evergreen, semi-evergreen and deciduous types with brilliant pink, orange, red, white or yellow flowers </li>
										<li>Tree become leafless in winter especially if irrigation is not present</li>
										<li>It blooms in late spring. Flowering is profuse, with trees being covered with yellow</li>
										<li>It grows well in dry climates. Growth for this tree is best in full sun on well-drained.</li>
										<li>Recommended for planting in parks and gardens.</li>
										<li>Soil- fertile well drained,Drought tolerent</li>
									</ul>
								</div>

								<div class="significance">
									<h5>Significance</h5>
									<ul class="list-unstyled">
										<li><strong>Medicinal use:-</strong> In Ayurvedic medicine its  fruit pulp used as  purgative.</li>
										<li><strong>Cultural:-</strong> it  is the state flower of Kerala( used in  Vishu festival of Kerala).</li>
									</ul>
								</div>

								<div class="planting-process">
									<h5>Planting and Care</h5>
									<ul class="list-unstyled">
										<li>Need full sunlight to flower and produce the most colorful blossoms.</li>
										<li>They are tolerant of most soil types with a neutral pH, and while they like water, well drained soils. </li>
										<li>They rarely survive temperatures below 30 F. (-1 C.) and since they reach heights of 20 to 30 feet.</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>