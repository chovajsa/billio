<div  class="modal" tabindex="-1" role="dialog">
  <div style="width:1000px" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ng-click="$hide()">&times;</button>
        <h4 class="modal-title"> Create payment file </h4>
      </div>
      <div class="modal-body">
          
          <!-- name  surname street  city  zip otherStreet otherCity otherZip -->

          <form id="paymentForm" class="form-horizontal" method="POST" action="<?=\Yii::$app->getUrlManager()->createUrl('invoice-in/generate-payment-file');?>">
            
            <table class="table">
              <thead>
                <tr>
                  <th>
                    Invoice #    
                  </th>
                  <th>
                    Supplier name
                  </th>
                  <th>
                    Amount
                  </th>
                  <th>
                    Bank Account
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="invoice in getPaymentList()">
                  <td>
                    {{invoice.number}}
                    <input type="hidden" name="Invoice[{{invoice.id}}][id]" value="{{invoice.id}}"/>
                  </td>
                  <td>
                    {{invoice.supplier.companyName}}
                  </td>
                  <td>
                    <input type="hidden" name="Invoice[{{invoice.id}}][amount]" value="{{invoice.amountVat}}"/>
                    {{invoice.amountVat | preciseRound}}
                  </td>
                  <td>
                    <select name="Invoice[{{invoice.id}}][account]">
                      <option value="{{ba.bankAccount}}/{{ba.bankAccountCode}}" ng-repeat="ba in invoice.supplier.bankAccounts">
                        {{ba.bankAccount}}/{{ba.bankAccountCode}}
                      </option>
                    </select>
                    <!-- {{invoice.supplier.bankAccounts[0].bankAccount}}/{{invoice.supplier.bankAccounts[0].bankAccountCode}} -->
                  </td>
                </tr>
              </tbody>
            </table>

          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="paymentBtn">Download</button>
        <button type="button" class="btn btn-warning" ng-click="markAsPaid()">Mark as paid</button>
        <button type="button" class="btn btn-default" ng-click="$hide()">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
  $('#paymentBtn').click(function () {
    $('#paymentForm').submit();
  })
})
</script>

