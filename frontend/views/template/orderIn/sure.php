<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ng-click="$hide()">&times;</button>
        <h4 class="modal-title"> Delete Order </h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning fade in m-b-15">
            <h4>
              <i class="fa fa-info-circle"></i> 
              Are you sure you want to delete Order ? 
              </h4>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="deleteReal(toDelete)">Delete</button>
        <button type="button" class="btn btn-default" ng-click="$hide()"> Cancel </button>
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