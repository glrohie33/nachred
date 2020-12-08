<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Files</h3>
					<div class="row" >
						<div class="col-md-10 " style="margin:0px auto;float:none;" ng-app='myApp' ng-controller='myCtrl'>
							<!-- BUTTONS -->
							<!-- INPUTS -->
							<div class="panel">
								<div class="panel-body">
									<div class="alert alert-info " ng-show="showFeedback" >
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
							</div>
							
						</div>
					</div>
				</div>
			</div>