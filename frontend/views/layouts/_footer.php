<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Url;
/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>

    <?php $this->endBody() ?>

   <script>
		$(document).ready(function() {
			App.init();
		
		});

		

	</script>
	
</body>
</html>
<?php $this->endPage() ?>
