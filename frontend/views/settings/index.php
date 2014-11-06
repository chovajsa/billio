<?php 

use yii\helpers\Url;

?>


<?php 

$this->title .=' - Settings';

?>

<div>

	<div>

		<?php 
			echo frontend\widgets\SideBar::widget([]);
		?>

		<div id="content" class="content">

			<h1 class="page-header"> Settings <!-- <small>header small text goes here...</small> --></h1>
			

			<?php foreach (\Yii::$app->session->getAllFlashes() as $key=>$value) { ?>
				<div class="alert alert-<?=$key;?> fade in m-b-15">
					<span class="msg"><?=$value;?></span>
					<span data-dismiss="alert" class="close">×</span>
				</div>
			<?php } ?>

			<div class="row">
				<!-- <div class="col-md-6">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Notification settings</h4>
						</div>

						<div class="panel-body">
							<form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Emails</label>
                                    <div class="col-md-9 ui-sortable">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                                Receive email when Invoice is created
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                                Receive email when Invoice is updated
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
      											Receive email when Invoice is approved
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
      											Receive email when Invoice is paid
                                            </label>
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">&nbsp;</label>
                                    <div class="col-md-9 ui-sortable">
                                        <button class="btn btn-sm btn-success" type="submit">Submit Button</button>
                                    </div>
                                </div>
                            </form>
						</div>

					</div>
				</div> -->

				<div class="col-md-6">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Change password</h4>
						</div>

						<div class="panel-body">
							<form class="form-horizontal" method="post" action="<?=Url::base();?>/settings/change-password">
								<div class="form-group">
                                    <label class="col-md-3 control-label ui-sortable">Password</label>
                                    <div class="col-md-9 ui-sortable">
                                        <input type="password" name="User[oldPassword]" placeholder="Default input" class="form-control">
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label class="col-md-3 control-label ui-sortable">New password</label>
                                    <div class="col-md-9 ui-sortable">
                                        <input id="password-indicator-default" name="User[newPassword]" type="password" placeholder="Default input" class="form-control">
                                        <div class="is0 m-t-5" id="passwordStrengthDiv"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label ui-sortable">Password check</label>
                                    <div class="col-md-9 ui-sortable">
                                        <input type="password" name="User[newPasswordCheck]" placeholder="Default input" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">&nbsp;</label>
                                    <div class="col-md-9 ui-sortable">
                                        <button class="btn btn-sm btn-success" type="submit">Submit Button</button>
                                    </div>
                                </div>
							</form>
						</div>

					</div>
				</div>
			</div>

		</div>

	</div>
</div>
