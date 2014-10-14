<?php 
use vendor\angular;

$depends = ['depends' => [
        'yii\bootstrap\BootstrapAsset',
        '\frontend\assets\admintemplate\AdminAsset',
        '\frontend\assets\angular\AngularAsset',
        '\frontend\assets\angularstrap\AngularstrapAsset',
    ]];

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

			<div id="content" class="content" ng-view>

			
			</div>


	
	</div>
</div>