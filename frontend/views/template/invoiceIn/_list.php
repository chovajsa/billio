<div class="panel-body hidden-sm hidden-xs">
	<table class="table table-condensed table-hover table-row-active">
		<thead>
			<tr>
				<th>
					<a href="javascript:;" ng-click="setSort('number')">Invoice Number</a>
				</th>
				<th>
					<a href="javascript:;" ng-click="setSort('referenceNumber')">Reference Number</a>
				</th>
				<!-- <th>
					IBAN
				</th> -->
				<th>
					Supplier
				</th>
				<th>
					<a href="javascript:;" ng-click="setSort('date')">Date</a>
				</th>
				<th>
					<a href="javascript:;" ng-click="setSort('dueDate')">Due Date</a>
				</th>

				<th>
					Amount
				</th>
				<th>
					Approved
				</th>
				<th width="10%">
					Paid
				</th>
				<th width="5%">
					Pay
				</th>
				<th>
					&nbsp;
				</th>
			</tr>
		</thead>
		<tbody>
            <tr class="{{invoice.overdue ? 'text-danger' : ''}} {{invoice.paid ? 'text-success' : ''}}" ng-repeat="invoice in invoiceList">
                <td ng-click="showInvoice(invoice.id)">
					<a href="#update/{{invoice.id}}">{{invoice.number}}</a>
                </td>

                <td ng-click="showInvoice(invoice.id)">
                	{{invoice.referenceNumber}}
                </td>

               <!--  <td ng-click="showInvoice(invoice.id)">
                	{{invoice.supplier.bankAccounts[0].iban}}
                </td> -->
                <td ng-click="showInvoice(invoice.id)">
					{{invoice.getFullSupplierName()}}
				</td>
		        <td ng-click="showInvoice(invoice.id)">
                    {{invoice.date | dateFromDb}}
				</td ng-click="showInvoice(invoice.id)">
				<td ng-click="showInvoice(invoice.id)"> 
					{{invoice.dueDate | dateFromDb}}
					<i ng-show="invoice.overdue" class="fa fa-warning text-danger"></i>
				</td>
				<td ng-click="showInvoice(invoice.id)">
                    {{invoice.amountVat | preciseRound}}
				</td>
				
				<td ng-click="showInvoice(invoice.id)">
					{{invoice.approvedBy ? '' : 'pending'}}
					<span ng-repeat="ab in invoice.approvedBy">
						<span class="label label-success">{{ab.userName}}</span>&nbsp;
					</span>
				</td>
				
				<td ng-click="showInvoice(invoice.id)">
					<span ng-show="invoice.paid"> {{invoice.paidDate | dateFromDb}} </span>
					<span ng-show="invoice.paid && invoice.paymentType=='B'"> <i class="fa fa-bank"></i> </span>
					<span ng-show="invoice.paid && invoice.paymentType=='C'"> <i class="fa fa-money"></i> </span>
					<span ng-show="!invoice.paid"> no </span>
				</td>
				
				<td>
					<?php if (Yii::$app->user->identity->canDo('pay')|| Yii::$app->user->identity->canDo('admin')) { ?>
						<input ng-show="canPay(invoiceList[$index])" type="checkbox" ng-model="invoiceList[$index].toPay">
					<?php } ?>
				</td>
				
				<td>
					<?php if (Yii::$app->user->identity->canDo('strongApprove') || Yii::$app->user->identity->canDo('lightApprove') || Yii::$app->user->identity->canDo('admin')) { ?>
						<button ng-show="!invoiceApprovedByUser(invoice,'<?=Yii::$app->user->identity->username;?>')" ng-click="approve(invoice.id)" class="btn btn-sm btn-success">approve</button>
						<button ng-show="(!invoiceDeclinedByUser(invoice,'<?=Yii::$app->user->identity->username;?>') || invoiceApprovedByUser(invoice,'<?=Yii::$app->user->identity->username;?>')) && !invoice.paid" ng-click="decline(invoice.id)" class="btn btn-sm btn-danger">decline</button>
					<?php } ?>
					
					<?php if (Yii::$app->user->identity->canDo('admin')) { ?>
						<button ng-click="delete(invoice.id)" class="btn btn-sm btn-danger">delete</button>
					<?php } ?>
				</td>
			
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td style="border-top:0" colspan="10">&nbsp;</td>
			</tr>
			<tr>
				<th colspan="4">
				</th>
				<th colspan="3" style="padding-top:15px">
					Payments total amount:		
				</th>
				<th style="padding-top:15px">
					{{toPayAmount | preciseRound}} 
				</th>
				<th colspan="3">
					<button ng-disabled="!toPayAmount" ng-click="showPaymentsModal()" class="btn btn-sm btn-info">Generate payment file</button> 
					<button ng-disabled="!toPayAmount" ng-click="doCashPayment()" class="btn btn-sm btn-info">Pay with cash</button> 
				</th>
			</tr>
		</tfoot>
	</table>
	
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