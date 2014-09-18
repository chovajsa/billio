<?php 
use vendor\angular;

$depends = [
        'yii\bootstrap\BootstrapAsset',
        '\frontend\assets\admintemplate\AdminAsset',
        '\frontend\assets\angular\AngularAsset',
        '\frontend\assets\angularstrap\AngularstrapAsset',
    ];

?>

<?php $this->registerJsFile('@web/js/supplier/app.js', $depends);?>

<?php $this->registerJsFile('@web/js/supplier/supplierFactory.js', $depends);?>
<?php $this->registerJsFile('@web/js/supplier/listController.js', $depends);?>
<?php $this->registerJsFile('@web/js/supplier/routes.js', $depends);?>

<?php $this->registerJsFile('@web/js/filters.js', $depends);?>


<div ng-app="supplierapp">
	<div>
		<?php 
			echo frontend\widgets\SideBar::widget([]);
		?>

			<div id="content" class="content">

			<h1 class="page-header"> Suppliers <!-- <small>header small text goes here...</small> --></h1>

			<div class="alert alert-success fade in m-b-15" id="notify-success" style="display:none">
				<span class="msg"></span>
				<span data-dismiss="alert" class="close">×</span>
			</div>

			<div class="row">
				<div class="col-md-4 ui-sortable">
					<form>
			            <div class="input-group m-b-15">
			                <input type="text" class="form-control input-sm input-white" placeholder="Search suppliers">
			                <span class="input-group-btn">
			                    <button class="btn btn-sm btn-inverse" type="button"><i class="fa fa-search"></i></button>
			                </span>
			            </div>
			        </form>
				</div>

				<div class="col-md-8 ui-sortable">
					<div class="email-btn-row hidden-xs">

			    	    <a href="#/new" class="btn btn-sm btn-primary"><i class="fa fa-plus m-r-5"></i> New</a>

			    	</div>
				</div>
			</div>

		  
		  	<div class="alert alert-success fade in m-b-15" id="notify-success" style="display:none">
				<span class="msg"></span>
				<span data-dismiss="alert" class="close">×</span>
			</div>

			<div class="row">
			<div ng-view>
			
			</div>
				

			</div>
			</div>


	
	</div>
</div>