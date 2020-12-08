
			<style>
				.images input[type=radio]:checked + img,.images input[type=checkbox]:checked + img{
					border:1px solid blue;
				}
			</style>
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Add Dam</h3>
					<div class="row" ng-app='myApp' ng-controller='myCtrl' >
						<div class="col-md-12">
							<!-- feed back -->
										<div class="alert alert-info " ng-show="showFeedback" >
											<button type="button" class="close" ng-click="hideFeedback()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<div ng-bind-html='feedback'>
											</div>
										</div>
							<!-- feed back -->

							<div class="col-md-6" style="margin:0px auto;" >
								<!-- BUTTONS -->
								<div class="panel">
									<div class="panel-body">
										<label>Dam Name</label>
										<input type="text" class="form-control" placeholder="dam name" ng-model="dam.name">
										
										
									</div>
								</div>
								<!-- INPUTS -->
								<div class="panel">
									<h4>Location Details</h4>
									<div class="panel-body">
									<label>Region </label>
										<select name="" id="" ng-model="dam.region" ng-change="setStates()" class="form-control" >
											<option ng-repeat="x in regions" value="{{x.region_id}}">{{x.region_name}}</option>
										</select>
										<br>
										<label>State </label>
										<select name="" id="" ng-model="dam.state" class="form-control"  >
											<option ng-repeat="x in state" value="{{x.state_id}}">{{x.state_name}}</option>
										</select>
										<br>
										<label>LGA</label>
										<input type="text" class="form-control" placeholder="lga" ng-model="dam.location.lga">
										
										<br>
										<label>Longitude</label>
										<input type="text" class="form-control" placeholder="longitude" ng-model="dam.location.longitude">
										<br>
										<label>Latitude</label>
										<input type="text" class="form-control" placeholder="latitude" ng-model="dam.location.latitude">
										<br>
										<label>Altitude</label>
										<input type="text" class="form-control" placeholder="altitude" ng-model="dam.location.altitude">
										<br>
										<label>Name Of River</label>
										<input type="text" class="form-control" placeholder="name of river" ng-model="dam.location.nor">
										<br>
										<label>Name of Basin</label>
										<input type="number" class="form-control" placeholder="name of basin" ng-model="dam.location.nob">
										
									</div>
								</div>

								

								<div class="panel">
									<h4>Ownership and Construction</h4>
									<div class="panel-body">
										<label>Owner</label>
										<input type="text" class="form-control" placeholder="owner" ng-model="dam.ownership.owner">
										<br>
										<label>Completion Year</label>
										<input type="year" class="form-control" placeholder="completion year" ng-model="dam.ownership.year">
										<br>
										<label>Contractor</label>
										<input type="text" class="form-control" placeholder="contractor" ng-model="dam.ownership.contractor">
										<br>
										<label>Consultant</label>
										<input type="text" class="form-control" placeholder="consultant" ng-model="dam.ownership.consultant">
										<br>
									</div>
								</div>
							</div>
							


							<div class="col-md-6" style="margin:0px auto;">
								
								<div class="panel">
									<h4>Physiographic Data</h4>
									<div class="panel-body">
										<label>Category Of Dam</label>
										<input type="text" class="form-control" placeholder="category of dam" ng-model="dam.physio.category">
										
										<br>
										<label>Type of Dam</label>
										<input type="text" class="form-control" placeholder="type of dam" ng-model="dam.physio.tod">
										<br>
										<label>Purpose</label>
										<input type="text" class="form-control" placeholder="purpose" ng-model="dam.physio.purpose">
										<br>
										<label>Height of Dam (M)</label>
										<input type="number" class="form-control" placeholder="height of dam" ng-model="dam.physio.hod">
										<br>
										<label>Crest Length</label>
										<input type="number" class="form-control" placeholder="crest length" ng-model="dam.physio.crest">
										<br>
										<label>Spillway Type</label>
										<input type="text" class="form-control" placeholder="spillway type" ng-model="dam.physio.spillway">
										
									</div>
								</div>

								<div class="panel">
									<h4>Hydrology</h4>
									<div class="panel-body">
										<label>Discharge</label>
										<input type="text" class="form-control" placeholder="discharge" ng-model="dam.hydrology.discharge">
										<br>
										<label>Available Head</label>
										<input type="text" class="form-control" placeholder="available head" ng-model="dam.hydrology.head">
										<br>
										<label>Reservior Area (M<sup>2</sup>)</label>
										<input type="number" class="form-control" placeholder="reservior area" ng-model="dam.hydrology.area">
										<br>
										<label>Reservior Capacity (Million Cubic Metres)</label>
										<input type="number" class="form-control" placeholder="reservior capacity" ng-model="dam.hydrology.capacity">
										<br>
										<label>Dead Storage</label>
										<input type="number" class="form-control" placeholder="dead storage" ng-model="dam.hydrology.storage">
										<br>
										<label>Reservior Surface Area</label>
										<input type="text" class="form-control" placeholder="reservior storage area" ng-model="dam.hydrology.surface">
									</div>
								</div>
								<div class="panel">
									<div class="panel-body">
											<div>
												<img ng-src="{{dam.image}}" alt="" style="max-height:200px;">
											</div>
											<input type="text" name="ft_image" hidden ng-model="dam.image">
										<br>
											<a class="btn btn-sm" data-toggle="modal" data-target="#image-modal" >add featured image</a>
										<br>

										<br>	
										<div class="row">
											<div class="col-md-2 col-xs-6" ng-repeat="x in dam.images" style="position:relative;">
												<button class="btn btn-danger btn-xs" style="position:absolute;border-radius:5px;" ng-click="setImages(x)">X</button>
												<img  ng-src="{{x}}" alt="" class="img-thumbnail" style="height:100px;">
											</div>
										</div>
											
											<input type="text" name="ft_image" hidden ng-model="dam.image">
										<br>
											<a class="btn btn-sm" data-toggle="modal" data-target="#images-modal" >add gallery images</a>
										<br>

										<br>
										<label>dam Description</label>
										<textarea class="form-control" placeholder="dam description" rows="5" ng-model="dam.description" ></textarea>
										
										
										
										<br>
										<button type="button" class="btn btn-primary btn-sm" ng-click="submit($event)"> Create</button>
									</div>
								</div>

								<!--image modal -->
								<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="add_new" aria-selected="true">Add New</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Images</a>
											</li>
											</ul>
											<div class="tab-content" id="myTabContent">
											<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
															<div class="alert alert-info " ng-show="mediashowFeedback" >
																<button type="button" class="close" ng-click="hideFeedback()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<div ng-bind-html='feedback'>
																</div>
															</div>
															<form enctype="multipart/form-data" id="upload">
																<input type="file" class="form-control" placeholder="region name" name="files[]"  multiple>
															</form>
															
															<label>upload files</label>
															<br>
															<button type="button" class="btn btn-primary btn-sm" ng-click="upload()"> Upload</button>
											</div>
											<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
												<div class="row images" >
													<label  class="col-md-4" ng-repeat="x in images" >
														<input type="radio" name="image"  ng-model="dam.image" value='{{x.url}}' hidden >
														<img ng-src='{{x.url}}' alt="" class="img-thumbnail" style="height:200px;object-fit:contain;">
													</label>
												</div>
											</div>
											</div>
										</div>
										</div>
									</div>
								</div>
								<!-- modal -->


								<!--images modal -->
								<div class="modal fade" id="images-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
											
										</div>
										<div class="modal-body">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="home-tab" data-toggle="tab" href="#setimage" role="tab" aria-controls="add_new" aria-selected="true">Add New</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="profile-tab" data-toggle="tab" href="#images" role="tab" aria-controls="profile" aria-selected="false">Images</a>
											</li>
											</ul>
											<div class="tab-content" id="myTabContent">
											<div class="tab-pane active" id="setimage" role="tabpanel" aria-labelledby="home-tab">
															<div class="alert alert-info " ng-show="mediashowFeedback" >
																<button type="button" class="close" ng-click="hideFeedback()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<div ng-bind-html='feedback'>
																</div>
															</div>
															<form enctype="multipart/form-data" id="upload">
																<input type="file" class="form-control" placeholder="region name" name="files[]"  multiple>
															</form>
															
															<label>upload files</label>
															<br>
															<button type="button" class="btn btn-primary btn-sm" ng-click="upload()"> Upload</button>
											</div>
											<div class="tab-pane" id="images" role="tabpanel" aria-labelledby="profile-tab">
												<div class="row images" >
													<label  class="col-md-4" ng-repeat="x in images" >
														<input type="checkbox"  ng-click="setImages(x.url)" name="{{x.url}}"  hidden value='{{x.url}}' >
														<img ng-src='{{x.url}}' alt="" class="img-thumbnail" style="height:200px;object-fit:contain;">
													</label>
												</div>
											</div>
											
											</div>
										</div>
										<div class="modal-header">
											<button type="button btn btn-default"  data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">Done</span>
											</button>
										</div>
										</div>
									</div>
								</div>
								<!-- modal -->
							</div>
						</div>
						</div>
						
					</div>
				</div>
			</div>

			
  