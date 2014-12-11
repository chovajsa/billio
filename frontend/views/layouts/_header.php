<?php 
use yii\helpers\Html;
<<<<<<< HEAD

=======
>>>>>>> 5214b3a... initial commit with a little structure
use yii\helpers\VarDumper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
<<<<<<< HEAD
use yii\helpers\Url;

=======
>>>>>>> 5214b3a... initial commit with a little structure
/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
<<<<<<< HEAD

$this->title = 'IPT';
=======
>>>>>>> 5214b3a... initial commit with a little structure
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
<<<<<<< HEAD
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= Html::encode($this->title) ?></title>

    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->

    <?php $this->head() ?>
    
    <script type="text/javascript">
        var yiiApp = {
            url : '<?=Url::base();?>',
            userId : <?=Yii::$app->user->isGuest ? 'null' : Yii::$app->user->id;?>,
			      defaultVat: 20.00,
        }
    </script>

<style>
.modal-backdrop.am-fade {
  opacity: .5;
  transition: opacity .15s linear;
  &.ng-enter {
    opacity: 0;
    &.ng-enter-active {
      opacity: .5;
    }
  }
  &.ng-leave {
    opacity: .5;
    &.ng-leave-active {
      opacity: 0;
    }
  }
}
</style>

</head>
<body>

<?php $this->beginBody() ?>

<!-- begin #page-loader -->
<!-- end #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed in">
<div class="header navbar navbar-default navbar-fixed-top" id="header">
      <!-- begin container-fluid -->
      <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
          <a href="<?=Url::base();?>" class="navbar-brand">
            <span class="fa-stack fa-1x text-inverse">
              <i class="fa fa-cloud fa-stack-2x"></i>
              <i class="fa fa-share fa-stack-1x fa-inverse"></i>
            </span>&nbsp;&nbsp;IPT
          </a>

          <button data-click="sidebar-toggled" class="navbar-toggle" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->
        
        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
          
          <li class="dropdown navbar-user">
            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
              <span > <?=Yii::$app->user->getIdentity() ? Yii::$app->user->getIdentity()->email : '';?></span> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInLeft">
              <li class="arrow"></li>
              <li><a href="<?=Url::base();?>/site/logout">Log Out</a></li>
            </ul>
          </li>
        </ul>
        <!-- end header navigation right -->
      </div>
      <!-- end container-fluid -->
    </div>


=======
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Invoice Processing',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Invoices', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
>>>>>>> 5214b3a... initial commit with a little structure
