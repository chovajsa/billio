<?php 

  use yii\helpers\Url;

?>

<?php 
  

?>

<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
  <!-- begin sidebar scrollbar -->
  <div data-scrollbar="true" data-height="100%">
    
    <!-- begin sidebar nav -->
    <ul class="nav">
      <li class="nav-header">Navigation</li>

      <li class="has-sub<?=$route == 'invoice-in/index' ? ' active' : '';?>">
        <a href="<?=$route == 'invoice-in/index' ? 'javascript:;' : Url::base()."/invoice-in/index";?>">
          <i class="fa fa-file-o"></i>
          <span>Invoices</span>
          <b class="caret pull-right"></b>
        </a>

          <ul class="sub-menu">

            <li><a href="#/"> All </a></li>
            <li><a href="#/mine"> Mine </a></li>
            <li><a href="#/paid"> Paid </a></li>
            <li><a href="#/paid-not"> Paid not </a></li>

          </ul>
      </li>
      

      <li <?=$route == 'supplier/index' ? 'class="active"' : '';?>>
          <a href="<?=Url::base();?>/supplier/index">
            <i class="fa fa-file-o"></i>
            <span>Suppliers</span>
          </a>
      </li>

      <?php if (false && Yii::$app->user->identity->canDo('admin')) { ?>
       <li class="has-sub">
        <a href="javascript:;">
          <i class="fa fa-cogs"></i>
          <b class="caret pull-right"></b>
          <span>Administration</span>
        </a>

        <ul class="sub-menu">
          <li class="">
            <a href="javascript:void(0)">
              Create
            </a>
          </li> 

          <li><a href="page_with_footer.html">All</a></li>
          <li><a href="page_without_sidebar.html">Pending</a></li>
          <li><a href="page_with_right_sidebar.html">Approved</a></li>
          <li><a href="page_with_minified_sidebar.html">Disapproved</a></li>
        </ul>
      </li>
      <?php } ?>

      <!-- begin sidebar minify button -->
      <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
      <!-- end sidebar minify button -->
    </ul>
    <!-- end sidebar nav -->
  </div>
  <!-- end sidebar scrollbar -->
</div>
<!-- end #sidebar -->
