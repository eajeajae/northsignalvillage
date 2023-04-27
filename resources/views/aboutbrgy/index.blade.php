@extends('layouts.master')

@section('title')
	About E-public service
@endsection 
@include('layouts.sidebar')
@section('content')
<div class="container">
	<div class="main-panel" id="main-panel">
		<div class="panel-header panel-header-sm">
			<div class="container-fluid">
				<div class="container">
					<div class="row">
						<div class="col-md-6" style="float: right" >
            <img src="../assets/img/map(1).png" class="d-block w-100" alt="..." style="margin:auto;">
						</div>
						<div class="col-sm-6 d-flex align-items-end flex-column mb-3" style="padding-top:70px;">
							<div class="p-2">
								<h2 style="color: #234880; font-weight: bolder;">Population</h2>
							</div>
							<div class="p-2" style="text-align:right;">
								North Signal Village is one of the 28 barangays in Taguig City. According to the 2020 Census, its population was 34,634. This accounted for 3.91 percent of Taguig's total population
							</div>
							<br><br>
							<table class="table table-success table-striped text-center">
								<thead>
									<tr>
										<th scope="col">Households</th>
										<th scope="col">Population Composition</th>
									</tr>
									<tr>
										<td colspan="4">
											<table class="table mb-0">
												<thead>
													<tr style="font-size:12px;">
														<th scope="col"></th>
														<th scope="col">No. of Women 40.11%</th>
														<th scope="col">No. of Men 50.18%</th>
														<th scope="col">No. of Children 5.62%</th>
														<th scope="col">No. of Elderly 4.08%</th>
													</tr>
												</thead>
												<tbody>
													<tr style="font-size:12px;">
														<th scope="row">3,983</th>
														<td>15,160</td>
														<td>18,966</td>
														<td>2,124</td>
														<td>1,545</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<br>
					<br>
					<br><br>
					<div class="text-center " style="background-color: rgba(101,180,89,0.7); padding:50px 20px 50px 20px; border-radius: 10px;">
						<h7>
							The Sangguniang Barangay of North Signal Village was motivated by its vision as a verdant community that is business friendly, peaceful, healthy and livable and guided by its mission to enable its citizenry gain access to education, skills and livelihood training, sports and other programs that can equip and make them capable of earning an income to help raise their standard of living to live productive and decent lives and to be able to actively carryout the mandate and ensure transparency, honesty and efficiency in the delivery of services on the barangay. 
						</h7>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<div class="container">
				<div class="col-md-12">
					<h2 style="color: #234880; font-weight: bolder;">Barangay Officials</h2>
					<p>These are the appointed barangay officials of North Signal Village. </p>
				</div>
				<div class="text-center " style="background-color: rgba(238,0,0,0.8); padding:50px 20px 50px 20px; border-radius: 10px;">
					<h7>
					Republic Act No. 11462 Approved: 03 December 2019: That the barangay and sangguniang kabataan elections on the second Monday of May 2020 shall be postponed to December 5, 2022. The elected barangay officials as of May 14, 2018 will serve until December of 2022 
					</h7>
				</div>
			</div>
			<br>
			<br>
			<br>
			
			<div class="container">
				<div class="">
					<h2 style="color: #234880; font-weight: bolder;">Events</h2>
				</div>
				<p>
					Barangay North Signal Village gives a lot of program and activity for the LGU’s, barangay staff and as well to the residents of the barangay.
				</p>
				<br>
				
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img class="d-block w-100" src="../assets/img/brgyassembly.jpg" alt="..." >
							<div class=" carousel-caption d-none d-md-block">
								<p style="text-shadow: 2px 2px #000000;">This project’s main purpose is to create a forum for regular individuals to communicate with their barangay authorities and debate problems and concerns that affect the government while also encouraging accountability, responsibilities, and transparency.</p>
						  	</div>
						</div>	
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/pageant.jpg" alt="...">
							<div class=" carousel-caption d-none d-md-block">
								<p>North Signal Village also conducted a beauty Pagent last 2019 with cash Prizes. 
									The goal of this beauty pageant is to discover one's own 
									personality, strengths and weaknesses as a person, build confidence and self-esteem, 
									and show others that beauty and intelligence are not mutually exclusive.
								</p>
							</div>	
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/event1.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/event6.jpg" alt="Second slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/event9.jpg" alt="Third slide" style="width: 400px">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/eventt.jpg" alt="Fourth slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/event7.jpg" alt="Fifth slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/bball1.jpg" alt="Sixth slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/bball2.jpg" alt="Seventh slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/bball3.jpg" alt="Eigth slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/bball4.jpg" alt="Ninth slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/foryouth.jpg" alt="Tenth slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/vaccine.jpg" alt="Eleventh slide">
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" src="../assets/img/vaccine1.jpg" alt="Twelfth slide">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    const myLatLng = { lat: 14.516122, lng: 121.057159 };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: myLatLng,
          });
  
          new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello Rajkot!",
          });
  })
  
        window.initMap = initMap;
    </script>
@endsection