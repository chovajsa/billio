<?php 

$this->title .=' - Invoices';

use vendor\angular;

$depends = ['depends'=>[
        'yii\bootstrap\BootstrapAsset',
        '\frontend\assets\admintemplate\AdminAsset',
        '\frontend\assets\angular\AngularAsset',
        '\frontend\assets\angularstrap\AngularstrapAsset',
    ]];
?>

<?php $this->registerJsFile('@web/js/invoiceIn/app.js', $depends);?>
<?php $this->registerJsFile('@web/js/invoiceIn/invoiceFactory.js', $depends);?>
<?php $this->registerJsFile('@web/js/supplier/supplierFactory.js', $depends);?>
<?php $this->registerJsFile('@web/js/costCentre/costCentreFactory.js', $depends);?>
<?php $this->registerJsFile('@web/js/invoiceIn/listController.js', $depends);?>
<?php $this->registerJsFile('@web/js/invoiceIn/createController.js', $depends);?>
<?php $this->registerJsFile('@web/js/invoiceIn/updateController.js', $depends);?>
<?php $this->registerJsFile('@web/js/invoiceIn/routes.js', $depends);?>

<?php $this->registerJsFile('@web/js/filters.js', $depends);?>



<div ng-app="invoiceIn">

	<div>

		<?php 
			echo frontend\widgets\SideBar::widget([]);
		?>

		<!-- begin #content -->
		<div id="content" class="content">

			<h1 class="page-header"> Incoming Invoices <!-- <small>header small text goes here...</small> --></h1>
		  
		  	<div class="alert alert-success fade in m-b-15" id="notify-success" style="display:none">
				<span class="msg"></span>
				<span data-dismiss="alert" class="close">×</span>
			</div>

			<div class="row">
				<div class="col-md-4 ui-sortable">
					<form>
						<div class="input-group m-b-15">
			                <input type="text" class="form-control input-sm input-white" ng-model="searchText" placeholder="Search Invoices" value="{{routeParams.fulltext}}">
			                <a class="input-group-btn" href="#/search/{{searchText}}">
								<span>
									<button class="btn btn-sm btn-inverse" type="submit"><i class="fa fa-search"></i></button>
								</span>
							</a>
			            </div>
			        </form>
				</div>

				<div class="col-md-8 ui-sortable">
					<div class="email-btn-row hidden-xs">

			    	    <a href="#/new" class="btn btn-sm btn-primary"><i class="fa fa-plus m-r-5"></i> New</a>

			    	    <a href="#/" class="btn btn-sm btn-inverse"> All </a>
			    	    <a href="#/mine" class="btn btn-sm btn-inverse"> Mine </a>
			    	    <a href="#/paid" class="btn btn-sm btn-inverse"> Paid </a>
			    	    <a href="#/paidNot" class="btn btn-sm btn-inverse"> Paid not </a>
						
						<a href="#/filter/" class="btn btn-sm btn-success" ng-click="$rootScope.showAdvanceSearch=!$rootScope.showAdvanceSearch"><i class="fa fa-search"></i> Advance Search </a>

			    	</div>
				</div>
			</div>

			<div class="row">
				<div ng-view>
				
				</div>
			</div>

		</div>

	</div>
	
</div>
