<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> Create Supplier </h4>
        <button type="button" class="close" ng-click="$hide()">&times;</button>
      </div>
      <div class="modal-body">
          
          <!-- name  surname street  city  zip otherStreet otherCity otherZip -->

          <form class="form-horizontal">
            
            <fieldset>
              <legend style="font-size:13px"> Basic Info </legend>
            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">Name</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="newSupplier.name" class="form-control" placeholder="Name">
                </div>
            </div>          
            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">Surname</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="newSupplier.surname" class="form-control" placeholder="Surname">
                </div>
            </div>          
            </fieldset>
  
            
            <fieldset>
              <legend style="font-size:13px"> Address </legend>
            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">Street</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="newSupplier.street" class="form-control" placeholder="Street">
                </div>
            </div>          
            
            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">City</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="newSupplier.city" class="form-control" placeholder="City">
                </div>
            </div>          

            <div class="form-group">
                <label class="col-md-3 control-label ui-sortable">Zip</label>
                <div class="col-md-9 ui-sortable">
                    <input type="text" ng-model="newSupplier.zip" class="form-control" placeholder="Zip">
                </div>
            </div>     
            </fieldset>     

          </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="createSupplier()">Save</button>
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