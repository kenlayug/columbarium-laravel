<div id="collection" class="modal modal-fixed" style="width: 95%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <h5 style = "color: white; text-align: center; font-size: 20px; padding: 20px; margin-top: 0px;">Collection: @{{ customer.strFullName }}</h5>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto;">
        <div class="col s12" style="margin-top: -15px;">
            <ul class="tabs">
                <li class="tab col s2"><a class="orange-text" href="#downpayment">Downpayment</a></li>
                <li class="tab col s2"><a class="orange-text" href="#regular-collection">Regular</a></li>
                <li class="tab col s2"><a class="orange-text" href="#preneed-collection">Pre-Need</a></li>
            </ul>
        </div><br>
        <div id="downpayment" class="col s12">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                <table id="datatable-downpayment" datatable="ng">
                    <thead>
                    <tr>
                        <th class="center">Downpayment No</th>
                        <th class="center">Unit</th>
                        <th class="center">Due Date</th>
                        <th class="center">Balance</th>
                        <th class="center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="downpayment in downpaymentList">
                        <td class="center">@{{ downpayment.intDownpaymentId }}</td>
                        <td class="center">
                            <button data-target="unitDetails" class="waves-light btn light-green modal-trigger " data-position="bottom" data-delay="30" data-tooltip="View Collectibles" 
                            style = "color: #000000; padding-left: 10px; padding-right: 10px; margin-left: 5px; margin-right: 10px">Details</button>
                        </td>
                        <td class="center">@{{ downpayment.dateDueDate | amDateFormat : 'MMMM D, YYYY' }}</td>
                        <td class="center">@{{ downpayment.deciBalance | currency: "₱" }}</td>
                        <td class="center"><button ng-click="openCollect(downpayment.intDownpaymentId, downpayment, $index)"
                                    data-target="downPaymentForm" class="waves-light btn light-green modal-trigger" href="#downPaymentForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="regular-collection" class="col s12">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                <table id="datatable-regular" datatable="ng">
                    <thead>
                    <tr>
                        <th class="center">Collection No</th>
                        <th class="center">Unit</th>
                        <th class="center">Collectibles</th>
                        <th class="center">Months Paid</th>
                        <th class="center">Due Date</th>
                        <th class="center">Monthly Amortization</th>
                        <th class="center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="collection in collectionList">
                        <td class="center">@{{ collection.intCollectionId }}</td>
                        <td class="center">
                            <button data-target="unitDetails" class="waves-light btn light-green modal-trigger " data-position="bottom" data-delay="30" data-tooltip="View Collectibles" 
                            style = "color: #000000; padding-left: 10px; padding-right: 10px; margin-left: 5px; margin-right: 10px">Details</button>
                        </td>
                        <td class="center">
                            <span ng-if="collection.deciCollectible != 0">@{{ collection.deciCollectible | currency : 'P' }}</span>
                            <span ng-if="collection.deciCollectible == 0">---</span>
                        </td>
                        <td class="center">@{{ collection.intMonthsPaid }}</td>
                        <td class="center"><span tooltipped data-position="bottom" data-delay="30" data-tooltip="@{{ collection.dateNextDue | amDateFormat : 'MMMM D, YYYY' }}">@{{ collection.dateNextDue | amDateFormat : 'MMMM D, YYYY' }}</span></td>
                        <td class="center">@{{ collection.deciMonthlyAmortization | currency : "P" }}</td>
                        <td class="center"><button ng-click="getPayments(collection, $index)"
                                    data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="preneed-collection" class="col s12">
            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                <table id="datatable-preneed">
                    <thead>
                    <tr>
                        <th>Transaction Code</th>
                        <th>Service Name</th>
                        <th>Months Paid</th>
                        <th>Next Due Date</th>
                        <th>Monthly Amortization</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>T123</td>
                        <td>Cremation</td>
                        <td>4</td>
                        <td>09/12/12</td>
                        <td>P 3,5000.00</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>T123</td>
                        <td>Cremation</td>
                        <td>4</td>
                        <td>09/12/12</td>
                        <td>P 3,5000.00</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>T123</td>
                        <td>Cremation</td>
                        <td>4</td>
                        <td>09/12/12</td>
                        <td>P 3,5000.00</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>T123</td>
                        <td>Cremation</td>
                        <td>4</td>
                        <td>09/12/12</td>
                        <td>P 3,5000.00</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>T123</td>
                        <td>Cremation</td>
                        <td>4</td>
                        <td>09/12/12</td>
                        <td>P 3,5000.00</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>T123</td>
                        <td>Cremation</td>
                        <td>4</td>
                        <td>09/12/12</td>
                        <td>P 3,5000.00</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>T123</td>
                        <td>Cremation</td>
                        <td>4</td>
                        <td>09/12/12</td>
                        <td>P 3,5000.00</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    <tr>
                        <td>T123</td>
                        <td>Cremation</td>
                        <td>4</td>
                        <td>09/12/12</td>
                        <td>P 3,5000.00</td>
                        <td><button data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                    </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>