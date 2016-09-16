<div id="serviceBillOut" class="modal modal-fixed-footer" style="width: 95%; max-height: 120%; overflow-y: hidden;">
    <div class="modal-header" style="background-color: #00897b;">
        <center><h4 style = "font-size: 20px; color: white; padding: 20px;">Bill Out</h4></center>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <form autocomplete="off" ng-submit='processTransaction()' novalidate>
        <div class="modal-content" style="overflow-y: auto;">

            <div class="row" style="margin-top: -10px;">
            	<div class="col s6" style="border: 3px solid #7b7073;"><br>

                    <center><h6>Avail Details:</h6></center>
                    
            		<div class="row" style="margin-top: -15px; margin-left: -10px;">
                        <div class="input-field col s8">
                            <input name="cname" ng-model="transactionPurchase.strCustomerName"
                                           id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
    			            <label for="cname" data-error="No Existing Customer Found!">Customer Name<span style = "color: red;">*</span></label>
                        </div>
                        <datalist id="nameList">
               	            <option ng-repeat="customer in customerList" value="@{{ customer.strFullName }}"/>
                        </datalist>

                        <div class="col s4">
                        	<a data-target="newCustomer" ng-show="transactionPurchase.strCustomerName == null" tooltipped class="waves-light btn light-green modal-trigger" data-delay="50" data-tooltip="Add New Customer" href="#newCustomer" style="color: #000000; margin-top: 15px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>

                        	<a data-target="newCustomer" ng-hide="transactionPurchase.strCustomerName == null" ng-click="updateCustomer(transactionPurchase.strCustomerName)" tooltipped class="waves-light btn light-green modal-trigger" data-delay="50" data-tooltip="Update Customer Details" href="#newCustomer" style="color: #000000;width: 100px; margin-top: 15px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
           	            </div>
                    </div>

                    <div class="input-field row" style="margin-top: -20px;">
                        <textarea ng-model='transactionPurchase.txtRemarks' id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Remarks</label>
                    </div>

                    <div class="row" style="border-top: 2px solid #7b7073;">
                        <center><h6>Payment Details:</h6></center>
                        <div class="input-field col s6">
                        	<select material-select watch ng-model="transactionPurchase.intPaymentMode" required>
                            	<option value="" disabled selected>Mode of Payment<span>*</span></option>
                                <option value="1">Cash</option>
                           		<option value="2">Cheque</option>
                            </select>
                        </div>

                        <div class="input-field col s6" ng-show="newServicePurchase.boolFuture == 1">
                        	<select material-select watch ng-model="transactionPurchase.intPaymentType" required>
                            	<option value="" disabled selected>Type of Payment<span>*</span></option>
                                <option value="1">Full Payment</option>
                                <option value="2">Installment</option>
                            </select>
    					</div>

    					<div class="input-field col s6" ng-show="transactionPurchase.intPaymentMode == 2">
                        	<a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
    					</div>
                    </div>

                    <div class="row"><br>
            			<div class="col s5">
            				<label style="color: #000000; font-size: 15px;">Total Amount to Pay:</label>
            			</div>
            			<div class="col s7">
            				<label style="color: red; font-size: 15px;">@{{ transactionPurchase.deciTotalAmountToPay | currency : 'P' }}</label>
            			</div>
    			    </div>

    			    <div class="row"><br>
            			<div class="col s5">
            				<label id=amountPaid style="color: #000000; font-size: 15px;">Amount Paid:<span style="color: red">*</span></label>
            			</div>
            			<div class="col s7">
            				<input ng-model='transactionPurchase.deciAmountPaid' ui-number-mask='2' id="amountPaid" type="text"/>
            			</div>
    			    </div>
                    <i class = "left" style = "color: red; margin-bottom: 10px;">*Required Fields</i>
            	</div>


            	<div class="col s6" style="border: 3px solid #7b7073;"><br>

                    <div class="row" ng-hide='requirementList.length == 0'>
                        <center><h6>Requirement/s:</h6></center>
                        <div class="col s6">
                            <p ng-repeat='requirement in requirementList' ng-if='$index%2 == 1'>
                                <input type="checkbox" id="@{{ requirement.intRequirementId }}"/>
                                <label for="@{{ requirement.intRequirementId }}">@{{ requirement.strRequirementName }}</label>
                            </p>
                        </div>
                        <div class="col s6">
                            <p ng-repeat='requirement in requirementList' ng-if='$index%2 == 0'>
                                <input type="checkbox" id="@{{ requirement.intRequirementId }}"/>
                                <label for="@{{ requirement.intRequirementId }}">@{{ requirement.strRequirementName }}</label>
                            </p>
                        </div>
                    </div>

            		<div class="row">
            			<center><h6>My Cart:</h6></center><br>
            			<div class="z-depth-2 card material-table">
    		                <table style="table-layout: fixed;">
    		                    <thead>
    		                        <tr>
    		                            <th>Name</th>
    		                            <th>Price</th>
    		                            <th>Quantity</th>
    		                            <th>Total Price</th>
    		                        </tr>
    		                    </thead>
    		                    <tbody>
    		                        <tr ng-repeat='objectCart in cartList'>
    		                            <td>
                                            <label ng-if='objectCart.intAdditionalId != null'>@{{ objectCart.strAdditionalName }}</label>
                                            <label ng-if='objectCart.intServiceId != null'>@{{ objectCart.strServiceName }}</label>
                                            <label ng-if='objectCart.intPackageId != null'>@{{ objectCart.strPackageName }}</label>
                                        </td>
    		                            <td>@{{ objectCart.deciPrice | currency : 'P'}}</td>
    		                            <td>@{{ objectCart.intQuantity }}</td>
    		                            <td>@{{ objectCart.deciPrice * objectCart.intQuantity | currency : 'P' }}</td>
    		                        </tr>
    		                    </tbody>
    		                </table>
    		            </div>
            		</div>

                    <div class="row" ng-show="scheduleDeceasedList.length > 0">
                        <center><h6>Deceased List:</h6></center><br>
                        <div class="z-depth-2 card material-table">
                            <table style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date of Death</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat='deceased in scheduleDeceasedList'>
                                        <td ng-bind="deceased.strLastName + ', ' + deceased.strFirstName + ' ' + deceased.strMiddleName"></td>
                                        <td ng-bind="deceased.dateDeath | amDateFormat : 'M/D/YYYY'"></td>
                                        <td>
                                            <a ng-click="openUnits(deceased)" data-target="unitForm" tooltipped class="btn-floating waves-light btn light-green modal-trigger" href="#unitForm" data-position="bottom" data-delay="50" data-tooltip="Add Deceased to Unit" style="clear:bottom;"><i class="material-icons" style = "color: #000000;">dashboard</i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

            	</div>
            </div>
            <br><br><br>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>

    </form>
</div>