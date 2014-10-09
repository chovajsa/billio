<?php 
use yii\helpers\Html;

use yii\helpers\VarDumper;
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

$this->title = 'IPT';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>

    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->

    <?php $this->head() ?>
    
    <script type="text/javascript">
        var yiiApp = {
            url : '<?=Url::base();?>',
            userId : <?=Yii::$app->user->isGuest ? 'null' : Yii::$app->user->id;?>,
			      defaultVat: 20,
        }
    </script>

</head>
<body>

<?php $this->beginBody() ?>
    <!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
  <!-- begin container-fluid -->
  <div class="container-fluid">
    <!-- begin mobile sidebar expand / collapse button -->
    <div class="navbar-header" style="width:200px">
      <!-- <a href="javascript:;" class="navbar-brand"><span class="markan-logo-mini"></span>  </a> -->
      
      <div style="padding-top:8px">
        <!-- <div style="height:40px; border-radius:3px; float:left; width:37px; background-color:#348FE2; color:white; font-size:25px"> -->
          <!-- <span style="margin: 0px 0px 0px 7px; line-height: 36px;">M</span> -->
        <!-- </div> -->
        <!-- <div style="float:left; border-radius:3px; box-shadow:inset 2px 2px 3px 3px #DBE2E9; height:40px; width:37px; background-color:#D9E0E7; margin-left:2px; color:white; font-size:25px"> -->
          <!-- <span style="margin: 0px 0px 0px 7px; line-height: 36px;">K</span> -->
        <!-- </div> -->
      </div>

      <!-- <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button> -->
    </div>
    <!-- end mobile sidebar expand / collapse button -->
    
    <!-- begin header navigation right -->
    <?php if (!Yii::$app->user->isGuest) { ?>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <form class="navbar-form full-width hidden-xs">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter keyword" />
            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </li>
<!--       <li class="dropdown">
        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
          <i class="fa fa-bell-o"></i>
          <span class="label">5</span>
        </a>
      </li> -->
      <li class="dropdown navbar-user">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
          <span class="hidden-xs">
            <?=Yii::$app->user->getIdentity()->email;?>
          </span> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu animated fadeInLeft">
          <li class="arrow"></li>
          <!-- <li><a href="javascript:;">Edit Profile</a></li> -->
          <!-- <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li> -->
          <!-- <li><a href="javascript:;">Calendar</a></li> -->
          <!-- <li><a href="javascript:;">Setting</a></li> -->
          <!-- <li class="divider"></li> -->
          <li><a href="<?=Url::to('site/logout');?>">Log Out</a></li>
        </ul>
      </li>
    </ul>
    <?php } ?>
    <!-- end header navigation right -->
  </div>
  <!-- end container-fluid -->
</div>
<!-- end #header -->

<div id="spinner" style="display:none" class="loading">Loading&#8230;</div>
