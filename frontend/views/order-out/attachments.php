<?php 
	use yii\helpers\Url;
?>
<ul>
	<?php foreach ($attachments as $attachment) { ?>
		<li>
			<a href=""> <?=$attachment;?> </a> <a href=""><i></i></a>
		</li>
	<?php } ?>
</ul>

<form enctype="multipart/form-data" method="post" class="form-inline">
	<div class="form-group m-r-10">
		<input name="attachment" type="file">
	</div>
	<div class="form-group m-r-10">
		<input type="submit" class="btn btn-sm btn-primary" value="Attach">
	</div>
</form>

<script type="text/javascript">
  function iframeLoaded() {
      var iFrameID = document.getElementById('attachmentsFrame');
      if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
      }   
  }
  $(document).ready(function () {
  	iframeLoaded();
  });
</script> 