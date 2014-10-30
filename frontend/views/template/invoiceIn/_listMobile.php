<div class="panel-body visible-sm visible-xs">
	<div class="panel-body" style="margin:5px 0 0 0; padding-top:5px" ng-repeat="invoice in invoiceList">
		<div class="row">
			<div class="col-xs-7">
			<h4 class="title"><a href="javascript:;">{{invoice.number}} {{invoice.getFullSupplierName()}}</a></h4>

			<table>
				<tr>
					<th width="70%">
						Invoice Number
					</th>
					<td>
						{{invoice.number}} 
					</td>
				</tr>

				<tr>
					<th>
						Reference Number
					</th>
					<td>
						{{invoice.referenceNumber}}
					</td>
				</tr>

				<tr>
					<th>
						Date
					</th>
					<td>
						{{invoice.date | dateFromDb}}
					</td>
				</tr>

				<tr>
					<th>
						Due Date
					</th>
					<td>
						{{invoice.dueDate | dateFromDb}}
					</td>
				</tr>

				<tr>
					<th>
						Approved
					</th>
					<td>
						{{invoice.approvedBy ? '' : 'pending'}}
						<span ng-repeat="ab in invoice.approvedBy">
							<span class="label label-success">{{ab.userName}}</span>&nbsp;
						</span>
					</td>
				</tr>

			</table>
		</div>

		<div style="text-align:center" class="col-xs-5">
			<h4>&euro; {{invoice.amountVat | preciseRound}} </h4>

			<?php if (Yii::$app->user->identity->canDo('pay')|| Yii::$app->user->identity->canDo('admin')) { ?>
				<input style="width:100%; margin:0 0 5px 0;" ng-show="canPay(invoiceList[$index])" type="checkbox" ng-model="invoiceList[$index].toPay">
				<?php } ?>
				<?php if (Yii::$app->user->identity->canDo('strongApprove') || Yii::$app->user->identity->canDo('lightApprove') || Yii::$app->user->identity->canDo('admin')) { ?>
				<button style="width:100%; margin:0 0 5px 0;" ng-show="!invoiceApprovedByUser(invoice,'<?=Yii::$app->user->identity->username;?>')" ng-click="approve(invoice.id)" class="btn btn-sm btn-success">approve</button>
				<button style="width:100%; margin:0 0 5px 0;" ng-show="invoiceApprovedByUser(invoice,'<?=Yii::$app->user->identity->username;?>')" ng-click="unapprove(invoice.id)" class="btn btn-sm btn-warning">unapprove</button>
				<?php } ?>

				<?php if (Yii::$app->user->identity->canDo('admin')) { ?>
				<button style="width:100%; margin:0 0 5px 0;" ng-click="delete(invoice.id)" class="btn btn-sm btn-danger">delete</button>
				<?php } ?>

			</div>
		</div>
		<hr style="margin:15px 0 0 0"/>
	</div>

	<ul class="pagination m-t-0 m-b-10">
		<li>
			<a href="javascript:;" ng-click="updateIncoiceList(1)">«</a>
		</li>
		<li 
			ng-repeat="a in numberOfRepeats(invoiceListPaging.pageCount) track by $index"
			class="{{(invoiceListPaging.currentPage == $index) ? 'active' : ''}}"
		>
			<a href="javascript:;"  ng-click="updateIncoiceList($index+1)">{{$index+1}}</a>
		</li>
		<li>
			<a ng-click="updateIncoiceList(invoiceListPaging.pageCount)" href="javascript:;">»</a>
		</li>
	</ul>
</div>