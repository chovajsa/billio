<?php 
	use yii\helpers\Url;
?>

<script src="<?=Url::base();?>/js/masked-input.min.js"></script>

<!-- small list -->
<div ng-cloak class="col-md-4 ui-sortable smallList">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Invoice List</h4>
		</div>
		  
	    <div class="panel-body">
	    	<table class="table table-condensed table-hover table-row-active">
				<thead>
					<tr>
						<th>
							Invoice Number
						</th>
						<th>
							Date
						</th>
						<th>
							Supplier
						</th>
						<th>
							Amount
						</th>
					</tr>
				</thead>
				<tbody>
		            <tr class="{{invoice.id == currentInvoice.id ? 'info' : ''}}" ng-click="showInvoice(invoice.id)" ng-repeat="invoice in invoiceList | filter:filterText">
		                <td>
							<a href="#update/{{invoice.id}}">{{invoice.number}}</a>
		                </td>
		                <td>
							{{invoice.date | dateFromDb}}
						</td>
		                <td>
		                    {{invoice.getFullSupplierName()}}
						</td>
						<td>
		                    {{invoice.amountVat}} &euro;
						</td>
					</tr>
				</tbody>
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
	</div>
</div> 
<!-- /small list -->
<div ng-cloak class="col-md-8 ui-sortable updateInvoice">
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title" ng-show="mode == 'create'"> 
				New Invocie
			</h4>
			<h4 class="panel-title" ng-show="mode == 'update'"> 
				Update Invocie {{currentInvoice.id}}
			</h4>
		</div>
		  
	    <div class="panel-body">
			<form class="form-horizontal" role="form" name="form" ng-submit="update(form.$valid)" novalidate>

				<div class="row">
				<div class="col-sm-6">
				<ul class="media-list media-list-with-divider">
					<li class="media">
						<div class="media-body">
							<h4 class="media-heading">Created by : {{currentInvoice.createdByUserName}} </h4>
							<p>
								<dl>
									<dt>Created on : 
									{{currentInvoice.createdDate | euroDateFilter}} </dt>
								</dl>
							</p>
						</div>
					</li>
				</ul>
				</div>
					<div class="col-sm-6 text-right" style="padding-right:5px">
						<p>
							<a target="_blank" href="<?=Url::base();?>/invoice-in/print/?invoiceInId={{currentInvoice.id}}" class="btn btn-sm btn-inverse"><i class="fa fa-print"></i> Print </a>
							<a target="_blank" href="<?=Url::base();?>/invoice-in/get-attachment/?id={{currentInvoice.id}}&fileName={{currentInvoice.id}}-invoiceIn.pdf" ng-click="" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> PDF </a>
							
							<?php if (Yii::$app->user->identity->canDo('admin')) { ?>
							<a href="javascript:;" ng-click="delete(currentInvoice.id)" class="btn btn-sm btn-danger"><i class="fa fa-minus-circle"></i> Delete </a>
					  		<?php } ?>
					        <!-- <a href="javascript:;" clas	s="btn btn-sm btn-primary m-r-5">Approve</a> -->
					        <!-- <a href="javascript:;" class="btn btn-sm btn-danger">Reject</a> -->
					    </p>
					</div>
				</div>
				
				<div class="form-group">
					<label for="supplierId" class="col-sm-2 control-label">Supplier</label>
					<div class="col-sm-10">
						<p class="input-group">
							<!-- <select id="supplierId" required class="form-control selectpicker nyaSelectpicker" data-style="btn-white" data-ajax-url="<?=Url::base();?>/api/supplier" data-live-search="true" data-ajax-search="true" data-size="10" ng-options="supplier.id as supplier.address.name for supplier in suppliers" ng-model="currentInvoice.supplierId">
								
								<option value=""> Please select </option>
							</select> -->

							<input ng-disabled="currentInvoice.approvedBy.length > 0" ui-select2="select2Options" ng-model="currentInvoice.supplier" required class="form-control selectpicker bigdrop" data-style="btn-white" type="hidden" id="supplierId"/>

							<span class="input-group-btn add-on">
				  	  			<button type="button" class="btn btn-primary" ng-click="showModal()"><i class="fa fa-plus"></i></button>
						  	</span>
						</p>
					</div>
				</div>
	
				<div class="form-group">
					<label for="number" class="col-sm-2 control-label">Number</label>
					<div class="col-sm-10">
					  	<input ng-disabled="currentInvoice.approvedBy.length > 0" id="number" name="number" required ng-model="currentInvoice.number" class="form-control" type="number">
					  	
					  	<ul class="error-list" ng-show="(form.submitted || form.number.$dirty) && form.number.$invalid" style="display: block;">
					  		
				  			<li ng-show="form.number.$error.required" class="required"  style="display: list-item;">
					  			Please enter a valid number.
				  			</li>
			  			</ul>
				
					</div>
				</div>

				<div class="form-group">
					<label for="referenceNumber" class="col-sm-2 control-label">Reference Number</label>
					<div class="col-sm-10">

					  <input ng-disabled="currentInvoice.approvedBy.length > 0" id="referenceNumber" name="referenceNumber" ng-model="currentInvoice.referenceNumber" required class="form-control" type="number">

					  	<ul class="error-list" ng-show="(form.submitted || form.referenceNumber.$dirty) && form.referenceNumber.$invalid" style="display: block;">
				  			<li ng-show="form.referenceNumber.$error.required" class="required"  style="display: list-item;">
					  			Please enter a valid number.
				  			</li>
			  			</ul>

					</div>
				</div>

				<div class="form-group">
					<label for="ss" class="col-sm-2 control-label">SS</label>
					<div class="col-sm-10">

					  <input ng-disabled="currentInvoice.approvedBy.length > 0" ng-model="currentInvoice.ss" name="ss" class="form-control">

					</div>
				</div>

				<div class="form-group">
					<label for="ks" class="col-sm-2 control-label">KS</label>
					<div class="col-sm-10">

					  <select ng-disabled="currentInvoice.approvedBy.length > 0" ui-select2="select2Option" class="form-control selectpicker" ng-model="currentInvoice.ks">
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

					</div>
				</div>
				
				<div class="form-group">
					<label for="date" class="col-sm-2 control-label">Cost Centre</label>
					
					<div class="col-sm-10">
						
						<select ng-disabled="currentInvoice.approvedBy.length > 0" class="form-control" ng-model="currentInvoice.costCentreId">
							<?php 

							$query = new \yii\db\Query();
						   	$parents = $query->select('parent')->distinct()->from('costCentre')->all();

							?>
							<?php foreach ($parents as $parent) { ?>
								<optgroup label="<?=$parent['parent'];?>"?>
									<?php 
										$children = (new \yii\db\Query())->select('id, name')->from(' costCentre')->where("parent = '{$parent['parent']}'")->all();
									?>
									<?php foreach ($children as $child) { ?>
									<option value="<?=$child['id'];?>"><?=$child['name'];?></option>
									<?php } ?>
								</optgroup>
							<?php } ?>
						</select>
						
					</div>
				</div>

				<div class="form-group">
					<label for="date" class="col-sm-2 control-label">Issue Date</label>
					
					<div class="col-sm-10">
						<input ng-disabled="currentInvoice.approvedBy.length > 0" class="form-control datepicker" required  ng-model="currentInvoice.date" type="text" id="date" name="date"/>

						<ul class="error-list" ng-show="(form.submitted || form.date.$dirty) && form.date.$invalid" style="display: block;">
					  		
				  			<li ng-show="form.date.$error.required" class="required"  style="display: list-item;">
					  			Please enter a valid date.
				  			</li>
			  			</ul>
					</div>
				</div>
				  
				<div class="form-group">
					<label for="dueDate" class="col-sm-2 control-label">Due Date</label>
					<div class="col-sm-10 input-append">
					  <!-- <p class="input-group"> -->
					  	<input ng-disabled="currentInvoice.approvedBy.length > 0" class="form-control datepicker" required ng-model="currentInvoice.dueDate" type="text" id="dueDate" name="dueDate">
					  	<!-- <span class="input-group-btn add-on"> -->
					  	  <!-- <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button> -->
					  	<!-- </span> -->
					  <!-- </p> -->
					</div>
				</div>

			</form>
		</div>
	</div>

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title"> Invoice Contents </h4>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="5%">
							#
						</th> 
						<th width="40%">
							Text
						</th>
						<th width="10%">
							Amount (Pcs)
						</th>
						<th width="10%">
							Amount (EUR)
						</th>
						<th width="10%">
							Amount Total
						</th>
						
						<th ng-show="currentInvoice.supplier.vat" width="10%">
							VAT (%)
						</th>
						<th ng-show="currentInvoice.supplier.vat" width="15%">
							Amount Total + VAT
						</th>
						
						<th width="5%">
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="row in currentInvoice.rows">
						<td>
							{{$index + 1}}
							<input type="hidden" ng-model="currentInvoice.rows[$index].id">
						</td> 
						<td>
							<input ng-disabled="currentInvoice.approvedBy.length > 0" style="width:100%" ng-model="currentInvoice.rows[$index].description" type="text">
						</td>
						<td>
							<input ng-disabled="currentInvoice.approvedBy.length > 0" style="width:100%" ng-model="currentInvoice.rows[$index].pcs" type="text">
						</td>
						<td>
							<input ng-disabled="currentInvoice.approvedBy.length > 0" style="width:100%" ng-model="currentInvoice.rows[$index].amount" type="text">
						</td>
						<td>
							{{(row.amount*row.pcs) | preciseRound}}
						</td>
						<td ng-show="currentInvoice.supplier.vat">
							<input ng-disabled="currentInvoice.approvedBy.length > 0" style="width:100%" ng-model="currentInvoice.rows[$index].vat" type="text">
						</td>
						<td ng-show="currentInvoice.supplier.vat">
							{{(((row.amount*row.pcs)*(row.vat/100))+(row.amount*row.pcs)) | preciseRound}}
						</td>
						<td width="5%">
							<a ng-show="currentInvoice.approvedBy.length == 0" href="javascript:void(0)" ng-click="unsetRow($index)">
							<span class="fa-stack fa-sm text-danger">
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-minus fa-stack-1x fa-inverse"></i>
							</span>
							</a>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="{{currentInvoice.supplier.vat ? '8' : '6'}}">
							&nbsp;
						</th>
					</tr>
					<tr>
						<th colspan="{{currentInvoice.supplier.vat ? '4' : '2'}}">
							&nbsp;
						</th>
						<th colspan="{{currentInvoice.supplier.vat ? '2' : '2'}}">
							Total amount
						</th>
						<th>
							{{getTotalAmountForInvoice() | preciseRound}}
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
					<tr ng-show="currentInvoice.supplier.vat">
						<th colspan="{{currentInvoice.supplier.vat ? '4' : '2'}}">
							&nbsp;
						</th>
						<th colspan="2">
							Total VAT
						</th>
						<th>
							{{getTotalVatForInvoice() | preciseRound}}
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
					<tr ng-show="currentInvoice.supplier.vat">
						<th colspan="{{currentInvoice.supplier.vat ? '4' : '2'}}">
							&nbsp;
						</th>
						<th colspan="2">
							Total amount + VAT
						</th>
						<th>
							{{getTotalAmountVatForInvoice() | preciseRound}}
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
				</tfoot>
			</table>

			<p>
		        <a ng-show="currentInvoice.approvedBy.length == 0" href="javascript:;" ng-click="addRow()" class="btn btn-sm btn-primary m-r-5"> <i class="fa fa-plus-circle"></i> Add row </a>
		    </p>
		</div>
	</div>

	<div ng-show="currentInvoice.id" class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title"> Attachments </h4>
		</div>

		<div class="panel-body">
			<iframe style="border:0; width:100%" id="attachmentsFrame" src=""></iframe>
		</div>
	</div>

	<div class="panel">
		<div class="panel-body">
			<input type="submit" ng-click="update()" class="btn btn-primary" value="Save">	
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function () {
	$('.datepicker').datepicker({
		format:"dd.mm.yyyy"
	});

	// $('#supplierId').select2();

	$("#masked-input-month").mask("9999-99");

})
</script>
