<div class="main-content">
	<div class="container-fluid">
		<h3 class="page-title">Dams</h3>
		<div class="row">
			<div class="col-md-12">
				<!-- BASIC TABLE -->
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">All Dams</h3>
						<a class="btn btn-default btn-sm" href="<?= base_url() ?>admin/slider/add" style="float:right;">Add New</a>
					</div>
					<div class="panel-body" ng-app="myApp" ng-controller='myCtrl' ng-init="setPaginations()">
						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>region</th>
									<th>state</th>
									<th>image</th>
									<th>Created</th>
									<th>Updated</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="x in dams | limitTo : limit : begin">
									<td>{{$index + 1}}</td>
									<td>{{x.dam_name}}</td>
									<td>{{x.region_name}}</td>
									<td> <img ng-src="{{x.feature_img}}" alt="" height="70px"></td>
									<td>{{x.state_name}}</td>
									<td>{{x.created_at}}</td>
									<td>{{x.updated_at}}</td>
									<td>
										<a class="btn btn-default btn-sm" ng-href="{{baseUrl}}admin/dam/edit/{{x.dam_id}}">Edit</a>
										<a class="btn btn-danger btn-sm" ng-click="delete(x.dam_id)">Delete</a>
									</td>
								</tr>
							</tbody>
						</table>
						<div compile="paginations">
						</div>
					</div>
				</div>
				<!-- END BASIC TABLE -->
			</div>
		</div>
	</div>
</div>
