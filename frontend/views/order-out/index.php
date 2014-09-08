<?php 

use vendor\angular;

$depends = [
        'yii\bootstrap\BootstrapAsset',
        '\frontend\assets\admintemplate\AdminAsset',
        '\frontend\assets\angular\AngularAsset',
        '\frontend\assets\angularstrap\AngularstrapAsset',
    ];

?>

<?php $this->registerJsFile('@web/js/orderOut/app.js', $depends);?>
<?php $this->registerJsFile('@web/js/orderOut/orderFactory.js', $depends);?>
<?php $this->registerJsFile('@web/js/orderOut/supplierFactory.js', $depends);?>
<?php $this->registerJsFile('@web/js/orderOut/listController.js', $depends);?>
<?php $this->registerJsFile('@web/js/orderOut/createController.js', $depends);?>
<?php $this->registerJsFile('@web/js/orderOut/updateController.js', $depends);?>
<?php $this->registerJsFile('@web/js/orderOut/routes.js', $depends);?>



<div ng-app="orderOut">

	<div>

		<?php 
			echo frontend\widgets\SideBar::widget([]);
		?>

		<!-- begin #content -->
		<div id="content" class="content">

			<h1 class="page-header"> Incoming Orders <!-- <small>header small text goes here...</small> --></h1>
		  
		  	<div class="alert alert-success fade in m-b-15" id="notify-success" style="display:none">
				<span class="msg"></span>
				<span data-dismiss="alert" class="close">×</span>
			</div>

			<div class="row">
				<div class="col-md-4 ui-sortable">
					<form>
			            <div class="input-group m-b-15">
			                <input type="text" class="form-control input-sm input-white" placeholder="Search Invoices">
			                <span class="input-group-btn">
			                    <button class="btn btn-sm btn-inverse" type="button"><i class="fa fa-search"></i></button>
			                </span>
			            </div>
			        </form>
				</div>

				<div class="col-md-8 ui-sortable">
					<div class="email-btn-row hidden-xs">

			    	    <a href="#/new" class="btn btn-sm btn-primary"><i class="fa fa-plus m-r-5"></i> New</a>

			    	    <a href="#/" class="btn btn-sm btn-inverse"><i class="fa m-r-5"></i> All </a>
			    	    <a href="#/mine" class="btn btn-sm btn-inverse"><i class="fa m-r-5"></i> Mine </a>
			    	    <a href="#/paid" class="btn btn-sm btn-inverse"><i class="fa m-r-5"></i> Paid </a>
			    	    <a href="#/paidNot" class="btn btn-sm btn-inverse"><i class="fa m-r-5"></i> Paid not </a>

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
