<div id="serviceBillOut" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Bill Out</h4></center>
    </div>
    <div class="modal-content" style="overflow-y: auto;">

        <div class="row" style="margin-top: -10px;">
        	<div class="col s6" style="border: 3px solid #7b7073;"><br>

                <center><h6>Avail Details:</h6></center>
                
        		<div class="row" style="margin-top: -15px; margin-left: -10px;">
                    <div class="input-field col s8">
                        <input name="cname" ng-model="newServicePurchase.strCustomerName"
                                       id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
			            <label for="cname" data-error="No Existing Customer Found!">Customer Name<span style = "color: red;">*</span></label>
                    </div>
                    <datalist id="nameList">
           	            <option ng-repeat="customer in customerList" value="@{{ customer.strFullName }}">
                    </datalist>

                    <div class="col s4">
                    	<a data-target="newCustomer" ng-show="newServicePurchase.strCustomerName == null" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer" href="#newCustomer" style="color: #000000; margin-top: 15px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>

                    	<a data-target="newCustomer" ng-hide="newServicePurchase.strCustomerName == null" ng-click="updateCustomer(newServicePurchase.strCustomerName)"      class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details" href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
       	            </div>
                </div>

                <div class="input-field row" style="margin-top: -20px;">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Remarks</label>
                </div>

                <div class="row" style="border-top: 2px solid #7b7073;">
                    <center><h6>Payment Details:</h6></center>
                    <div class="input-field col s6">
                    	<select ng-model="newServicePurchase.intPaymentMode" required>
                        	<option value="" disabled selected>Mode of Payment<span>*</span></option>
                            <option value="1">Cash</option>
                       		<option value="2">Cheque</option>
                        </select>
                    </div>

                    <div class="input-field col s6" ng-show="newServicePurchase.boolFuture == 1">
                    	<select ng-model="newServicePurchase.intPaymentType" required>
                        	<option value="" disabled selected>Type of Payment<span>*</span></option>
                            <option value="1">Full Payment</option>
                            <option value="2">Installment</option>
                        </select>
					</div>

					<div class="input-field col s6" ng-show="newServicePurchase.intPaymentMode == 2">
                    	<a data-target="cheque" class="waves-light btn light-green btn modal-trigger" href="#cheque" style="width: 100%; color: #000000">Cheque Details</a>
					</div>
                </div>

                <div class="row"><br>
        			<div class="col s5">
        				<label style="color: #000000; font-size: 15px;">Total Amount to Pay:</label>
        			</div>
        			<div class="col s7">
        				<label style="color: red; font-size: 15px;">P 2,000.00</label>
        			</div>
			    </div>

			    <div class="row"><br>
        			<div class="col s5">
        				<label id=amountPaid style="color: #000000; font-size: 15px;">Amount Paid:<span style="color: red">*</span></label>
        			</div>
        			<div class="col s7">
        				<input id="amountPaid" type="number"/>
        			</div>
			    </div>
                <i class = "left" style = "color: red; margin-bottom: 10px;">*Required Fields</i>
        	</div>


        	<div class="col s6" style="border: 3px solid #7b7073;"><br>

                <div class="row">
                    <center><h6>Requirement/s:</h6></center>
                    <div class="col s6">
                        <p>
                            <input type="checkbox" id="test5"/>
                            <label for="test5">Death Cerification</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test6"/>
                            <label for="test6">Transfer Permit</label>
                        </p>
                    </div>
                    <div class="col s6">
                        <p>
                            <input type="checkbox" id="test7"/>
                            <label for="test7">Marriage Certificate</label>
                        </p>
                        <p>
                            <input type="checkbox" id="test8"/>
                            <label for="test8">Valid ID</label>
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
		                        <tr>
		                            <td>Fetus Cremation</td>
		                            <td>P 1,900.00</td>
		                            <td>2</td>
		                            <td>P 3,800.00</td>
		                        </tr>
		                        <tr>
		                            <td>Fetus Cremation</td>
		                            <td>P 1,900.00</td>
		                            <td>2</td>
		                            <td>P 3,800.00</td>
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
</div>