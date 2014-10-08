<div  class="modal" tabindex="-1" role="dialog">
  <div style="width:1000px" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ng-click="$hide()">&times;</button>
        <h4 class="modal-title"> {{supplier.id ? 'Update' : 'Create'}} Supplier </h4>
      </div>
      <div class="modal-body">
          
          <!-- name  surname street  city  zip otherStreet otherCity otherZip -->

          <form class="form-horizontal">
            
            <fieldset>
              <legend style="font-size:13px"> Basic Info </legend>

              <div class="form-group">
                  <label class="col-md-3 control-label ui-sortable">Company Name</label>
                  <div class="col-md-9 ui-sortable">
                      <input type="text" ng-model="supplier.companyName" class="form-control" placeholder="Name">
                  </div>
              </div>            

              <div class="form-group">
                  <label class="col-md-3 control-label ui-sortable">Name</label>
                  <div class="col-md-9 ui-sortable">
                      <input type="text" ng-model="supplier.name" class="form-control" placeholder="Name">
                  </div>
              </div>          
              <div class="form-group">
                  <label class="col-md-3 control-label ui-sortable">Surname</label>
                  <div class="col-md-9 ui-sortable">
                      <input type="text" ng-model="supplier.surname" class="form-control" placeholder="Surname">
                  </div>
              </div>          

              <div class="form-group">
                  <label class="col-md-3 control-label ui-sortable">Vat</label>
                  <div class="col-md-9 ui-sortable">
                      <input type="checkbox" ng-model="supplier.vat">
                  </div>
              </div>          

            </fieldset>
  
            
            <fieldset>
              <legend style="font-size:13px"> Address </legend>
            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">Street</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="supplier.address.street" class="form-control" placeholder="Street">
                </div>
            </div>          
            
            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">City</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="supplier.address.city" class="form-control" placeholder="City">
                </div>
            </div>          

            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">Zip</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="supplier.address.zip" class="form-control" placeholder="Zip">
                </div>
            </div>     
            </fieldset>  

            <fieldset>
              <legend style="font-size:13px"> Address 2  </legend>
            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">Street</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="supplier.address.street1" class="form-control" placeholder="Street">
                </div>
            </div>          
            
            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">City</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="supplier.address.city1" class="form-control" placeholder="City">
                </div>
            </div>          

            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">Zip</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="supplier.address.zip1" class="form-control" placeholder="Zip">
                </div>
            </div>     
            </fieldset>   
          

            <fieldset>
              <legend style="font-size:13px"> Bank Accounts  </legend>
              
              <label class="col-md-3 control-label ui-sortable">&nbsp;</label>

              <div class="col-sm-3">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      Number
                    </th>
                    <th>
                      Code
                    </th>
                    <th>
                      &nbsp;
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="bankAccont in supplier.bankAccounts">
                    <td>
                      <input type="hidden" ng-model="supplier.bankAccounts[$index].id">
                      <input type="text" ng-model="supplier.bankAccounts[$index].bankAccount"/>
                    </td>
                    <td>
                      <input type="text" ng-model="supplier.bankAccounts[$index].bankAccountCode"/>
                    </td>
                    <td>
                      <a href="javascript:;" ng-click="unsetRow($index)">remove</a>
                    </td>
                  </tr>
                </tbody>
              </table>
              
              <a href="javascript:;" ng-click="addRow()">
                add account
              </a>

              </div>


            </fieldset>   

          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="updateSupplier()">Save</button>
        <button type="button" class="btn btn-default" ng-click="$hide()">Close</button>
      </div>
    </div>
  </div>
</div>

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