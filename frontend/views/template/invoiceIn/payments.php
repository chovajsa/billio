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
                  <th>
                    KS
                  </th>
                  <th>
                    SS
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
                  <td>
                   <!-- {{invoice.ks}} -->

                    <select style="width:160px" name="Invoice[{{invoice.id}}][ks]" ng-model="invoice.ks">
                        <option value=""></option>
                        <option value="0008"> 0008 - Platby za tovar (okrem platieb pod symbolmi 010x)</option>
                        <option value="0028"> 0028 - Platby za dodávky investičnej povahy</option>
                        <option value="0038"> 0038 - Prostriedky na mzdy</option>
                        <option value="0058"> 0058 - Penále, poplatky z omeškania, iné majetkové sankcie, náhrady škôd</option>
                        <option value="0068"> 0068 - Prevody prostriedkov na mzdy a ostatné osobné náklady</option>
                        <option value="0078"> 0078 - Tržby za predaný tovar a poskytnuté stravovanie</option>
                        <option value="0108"> 0108 - Platby za poľnohospodárske výrobky</option>
                        <option value="0138"> 0138 - Zrážky z miezd</option>
                        <option value="0158"> 0158 - Hospodársko operatívne výdavky</option>
                        <option value="0168"> 0168 - Splátky úverov a pôžičiek</option>
                        <option value="0178"> 0178 - Tržby za poskytnuté služby</option>
                        <option value="0308"> 0308 - Platby za služby</option>
                        <option value="0358"> 0358 - Platby určené na výplaty v hotovosti prostredníctvom pôšt</option>
                        <option value="0558"> 0558 - Finančné platby ostatné</option>
                        <option value="0858"> 0858 - Prechodne poskytnuté pôžičky</option>
                        <option value="0938"> 0938 - Dávky sociálneho zabezpečenia</option>
                        <option value="0968"> 0968 - Ostatné prevody medzi účtami toho istého klienta</option>
                        <option value="1018"> 1018 - Príjmy z podnikania a vlastníctva majetku - vo vzťahu k ŠR</option>
                        <option value="1118"> 1118 - Administratívne a iné poplatky a platby - vo vzťahu k ŠR</option>
                        <option value="1144"> 1144 - Bežná záloha dane</option>
                        <option value="1144"> 1144 - Platba bežná, preddavok na daň</option>
                        <option value="1148"> 1148 - Bežná záloha dane</option>
                        <option value="1318"> 1318 - Príjmy zo splác. pôžič. poskytnutých zo ŠR a z predaja účas. majetku štátu</option>
                        <option value="1344"> 1344 - Doúčtovanie daní za predchádzajúce zdaňovacie obdobie</option>
                        <option value="1348"> 1348 - Doúčtovanie daní za predchádzajúce zdaňovacie obdobie</option>
                        <option value="1548"> 1548 - Dodatočné daňové priznanie</option>
                        <option value="1744"> 1744 - Vyúčtovanie dane za posledné zdaňovacie obdobie DPFO a DPPO</option>
                        <option value="1748"> 1748 - Vyúčtovanie dane za posledné zdaňovacie obdobie (DPFO, DPPO)</option>
                        <option value="1944"> 1944 - Zúčtovanie rozdielov preddavkov dane z príjmu zo závislej činnosti, dane vyberanej zrážkou a zabezpečení dane</option>
                        <option value="1948"> 1948 - Zúčt. rozdielov predd. na daň z príjmov zo záv. činnosti, zrážky daní</option>
                        <option value="2018"> 2018 - Ostatné príjmy vo vzťahu k ŠR</option>
                        <option value="2058"> 2058 - Nákup cenných papierov (akcie, dlhopisy, zmenky)</option>
                        <option value="2144"> 2144 - Dodatočne vyrubená daň</option>
                        <option value="2148"> 2148 - Dodatočne vyrubená daň</option>
                        <option value="2558"> 2558 - Úhrady poistných plnení poisťovňami</option>
                        <option value="2848"> 2848 - Pauš. daň podľa §15Z.č. 366/1999 Z.z. o dan. z príjmov</option>
                        <option value="3058"> 3058 - Predaj cenných papierov</option>
                        <option value="3118"> 3118 - Poistné a príspevok zamestnávateľa do poisťovní a NÚP</option>
                        <option value="3148"> 3148 - Penále z kontroly</option>
                        <option value="3344"> 3344 - Sankčný úrok, penále</option>
                        <option value="3348"> 3348 - Penále zo správy</option>
                        <option value="3548"> 3548 - Penále vyrubené daňovými organmi z kontroly</option>
                        <option value="3558"> 3558 - Platby poistného poisťovniam</option>
                        <option value="3718"> 3718 - Nájomné za prenájom - vo vzťahu k ŠR</option>
                        <option value="3748"> 3748 - Penále vyrubené daňovými orgánmi zo správy</option>
                        <option value="4058"> 4058 - Vyplácanie výnosov z cen. papierov, splatnosť menovitej hodnoty</option>
                        <option value="4948"> 4948 - Vrátenie dane - nepriame dane</option>
                        <option value="5058"> 5058 - Ostatné obchody s cennými papiermi</option>
                        <option value="5118"> 5118 - Splácanie úrokov a ostatné platby súvisiace s úvermi - vo vzťahu k ŠR</option>
                        <option value="5144"> 5144 - Zvýšenie dane</option>
                        <option value="5148"> 5148 - Zvýšenie dane</option>
                        <option value="5344"> 5344 - Nadmerný odpočet</option>
                        <option value="5348"> 5348 - Nárok na odpočet dane</option>
                        <option value="5748"> 5748 - Dodatočné daňové priznanie</option>
                        <option value="5918"> 5918 - Splácanie dom. istiny, splác. výnosy z cenných papierov - vo vzťahu k ŠR</option>
                        <option value="5944"> 5944 - Zvýšenie dane - daňová inšpekcia</option>
                        <option value="5948"> 5948 - Zvýšenie dane - daňová inšpekcia</option>
                        <option value="6144"> 6144 - Dodatočná platba z daňovej inšpekcie</option>
                        <option value="6148"> 6148 - Dodatočná platba z daňovej inšpekcie</option>
                        <option value="6344"> 6344 - Pokuta z kontroly</option>
                        <option value="6348"> 6348 - Pokukta z kontroly</option>
                        <option value="6544"> 6544 - Pokuta zo správy</option>
                        <option value="6548"> 6548 - Pokuta zo správy</option>
                        <option value="6744"> 6744 - Pokuty vyrubené daňovou inšpekciou</option>
                        <option value="6748"> 6748 - Pokuty vyrubené daňovou inšpekciou</option>
                        <option value="6948"> 6948 - Pokuty vyrubené daňovým orgánom, kt. nie sú príjmom osob. účtu ŠR</option>
                        <option value="7144"> 7144 - Sankčný úrok z daňovej inšpekcie</option>
                        <option value="7148"> 7148 - Penále z daňovej inšpekcie</option>
                        <option value="7344"> 7344 - Úrok pri odklade platenia</option>
                        <option value="7348"> 7348 - Úrok pri odklade platenia</option>
                        <option value="7544"> 7544 - Exekučné náklady</option>
                        <option value="7548"> 7548 - Exekučné náklady</option>
                        <option value="7748"> 7748 - Úrok platený daňovému subjektu za oneskorenie vrátenia preplatku</option>
                        <option value="7944"> 7944 - Blokové pokuty vyrubené daňovým úradom</option>
                        <option value="7948"> 7948 - Blokové pokuty vyrubené daňovým úradom</option>
                        <option value="8144"> 8144 - Platba (účtovaná súčasne s predpisom)</option>
                        <option value="8148"> 8148 - Platba (účtovaná súčasne s predpisom)</option>
                        <option value="8748"> 8748 - Platba na vyrovnanie preplatku</option>
                    </select> 


                  </td>
                  <td>
                    <input type="hidden" name="Invoice[{{invoice.id}}][ss]" value="{{invoice.ss}}"/>
                    {{invoice.ss}}
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

