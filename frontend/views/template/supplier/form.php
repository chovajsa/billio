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
                      Prefix
                    </th>
                    <th>
                      Number
                    </th>
                    <th>
                      Code
                    </th>
                    <th>
                      Iban
                    </th>
                    <th>
                      &nbsp;
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="bankAccont in supplier.bankAccounts">
                    <td>
                      <input ng-blur="ibanize($index)" id="bp{{$index}}" ng-model-onblur style="width:100px" type="text" class="ibanize" maxlength="6" ng-model="supplier.bankAccounts[$index].bankAccountPrefix"/>
                    </td>
                    <td>
                      <input type="hidden" ng-model="supplier.bankAccounts[$index].id">
                      <input ng-blur="ibanize($index)" id="ba{{$index}}" type="text" class="ibanize" maxlength="10" ng-model="supplier.bankAccounts[$index].bankAccount"/>
                    </td>
                    <td>
                      <select ng-change="ibanize($index)" style="width:65px" class="ibanize" ng-model="supplier.bankAccounts[$index].bankAccountCode">
                        <option value="8400"> 8400 - Banco Mais, S.A., pobočka zahr. banky</option>
                        <option value="8420"> 8420 - BKS BANK AG, pobočka zahr. banky</option>
                        <option value="7500"> 7500 - Československá obchodná banka, a.s.</option>
                        <option value="8130"> 8130 - Citibank Europe plc, pobočka zahr. banky</option>
                        <option value="8050"> 8050 - COMMERZBANK Aktiengesellschaft, pobočka zahr. banky</option>
                        <option value="8170"> 8170 - ČSOB stavebná sporiteľňa, a.s.</option>
                        <option value="8160"> 8160 - EXIMBANKA SR</option>
                        <option value="8330"> 8330 - Fio banka, a.s., pobočka zahr. banky</option>
                        <option value="7300"> 7300 - ING Bank N.V., pobočka zahr. banky</option>
                        <option value="8320"> 8320 - J&T BANKA, a.s., pobočka zahr. banky</option>
                        <option value="8430"> 8430 - KDB Bank Europe Ltd, pobočka zahran. banky</option>
                        <option value="8100"> 8100 - Komerční banka, a.s., pobočka zahr. banky</option>
                        <option value="8360"> 8360 - mBank S.A., pobočka zahr. banky</option>
                        <option value="0720"> 0720 - Národná banka Slovenska</option>
                        <option value="8370"> 8370 - Oberbank AG, pobočka zahr. banky v SR</option>
                        <option value="5200"> 5200 - OTP banka Slovensko, a.s.</option>
                        <option value="6500"> 6500 - Poštová banka, a.s.</option>
                        <option value="5600"> 5600 - Prima banka Slovensko, a.s. (DEXIA)</option>
                        <option value="8120"> 8120 - Privatbanka, a.s.</option>
                        <option value="5900"> 5900 - Prvá stavebná sporiteľňa, a.s.</option>
                        <option value="1100"> 1100 - Raiffeisen BANK (Tatra banka a.s., odštepný závod)</option>
                        <option value="3100"> 3100 - SBERBANK Slovensko, a.s.</option>
                        <option value="0900"> 0900 - Slovenská sporiteľňa, a.s.</option>
                        <option value="3000"> 3000 - Slovenská záručná a rozvojová banka, a.s.</option>
                        <option value="8180"> 8180 - Štátna pokladnica</option>
                        <option value="1100"> 1100 - Tatra banka, a.s.</option>
                        <option value="8350"> 8350 - The Royal Bank of Scotland, pobočka zahr. banky</option>
                        <option value="1111"> 1111 - UniCredit Bank Slovakia, a.s.</option>
                        <option value="0200"> 0200 - VÚB banka, a.s.</option>
                        <option value="7930"> 7930 - Wűstenrot stavebná sporiteľňa, a.s.</option>
                        <option value="8410"> 8410 - ZUNO BANK AG, pobočka zahr. banky</option>
                      </select>
                    </td>
                    <td>
                      <input id="biban{{$index}}" style="width:200px" type="text" maxlength="4" ng-model="supplier.bankAccounts[$index].iban"/>
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