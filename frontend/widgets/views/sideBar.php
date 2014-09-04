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

      <li class="has-sub <?=strpos($route, 'invoice') !== false ? 'active' : '';?>">
        <a href="javascript:;">
          <b class="caret pull-right"></b>
          <span>Invoices</span>
        </a>

        <ul class="sub-menu">
          <li <?=$route == 'invoice-in/index' ? 'class="active"' : '';?>><a href="<?=Url::base();?>/invoice-in/index">Incoming</a></li>
        </ul>
      </li>

      <li class="has-sub <?=strpos($route, 'order') !== false ? 'active' : '';?>">
        <a href="javascript:;">
          <b class="caret pull-right"></b>
          <span>Orders</span>
        </a>

        <ul class="sub-menu">
          <li <?=$route == 'order-in/index' ? 'class="active"' : '';?>><a href="<?=Url::base();?>/order-in/index">Incoming</a></li>
          <li <?=$route == 'order-out/index' ? 'class="active"' : '';?>><a href="<?=Url::base();?>/order-out/index">Outgoing</a></li>
        </ul>
      </li>

      <?php if (Yii::$app->user->identity->canDo('admin')) { ?>
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
