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
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
   <script src="<?=Url::base();?>/js/main.js" type="text/javascript"></script>
</body>
</html>
<?php $this->endPage() ?>
