<style>
	.images input[type=radio]:checked+img {
		border: 1px solid blue;
	}
</style>
<div class="main-content">
	<div class="container-fluid">
		<h3 class="page-title">Add Slider</h3>
		<div class="row">
			<div class="col-md-6" style="margin:0px auto;float:none;" ng-app='myApp' ng-controller='myCtrl'>
				<!-- BUTTONS -->
				<div class="alert alert-info " id="feedback" ng-show="showFeedback">
					<button type="button" class="close" ng-click="hideFeedback()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div ng-bind-html='feedback'>
					</div>
				</div>
				<!-- INPUTS -->
				<div class="panel">
					<div class="panel-body">

						<div>
							<img ng-src="{{image.image}}" alt="" style="width:300px;">
						</div>
						<input type="text" name="ft_image" hidden ng-model="image.image">
						<br>
						<a class="btn btn-sm" data-toggle="modal" data-target="#image-modal">add image</a>
						<br>

						<label>Slider Text</label>
						<textarea class="form-control" placeholder="slider text" rows="4" ng-model="text"></textarea>
						<br>

						<label class="fancy-checkbox">
							<input type="checkbox" ng-model='stay'>
							<span>Stay on page</span>
						</label>
						<button type="button" class="btn btn-primary btn-sm" ng-click="submit($event)"> Create</button>
					</div>
				</div>

				<!-- modal -->
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
										<div class="alert alert-info " ng-show="mediashowFeedback">
											<button type="button" class="close" ng-click="hideFeedback()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<div ng-bind-html='feedback'>
											</div>
										</div>
										<form enctype="multipart/form-data" id="upload">
											<input type="file" class="form-control" placeholder="region name" name="files[]" multiple>
										</form>

										<label>upload files</label>
										<br>
										<button type="button" class="btn btn-primary btn-sm" ng-click="upload()"> Upload</button>
									</div>
									<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
										<div class="row images">
											<label class="col-md-4" ng-repeat="x in images">
												<input type="radio" name="image" ng-model="image.image" value='{{x.url}}' hidden>
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
			</div>
		</div>
	</div>
</div>
