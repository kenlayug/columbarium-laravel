<div id="downpayment" class="modal modal-fixed" style="width: 75% !important ; max-height: 100% !important;">
    <div id="admin" class="col s12">
        <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
            <div class="table-header" style="background-color: #00897b;">
                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont">Transactions: @{{ customer.strFullName }}</h4>
                <div class="actions">
                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                </div>
            </div>
            <table id="datatable1" datatable="ng">
                <thead>
                <tr>
                    <th>Transaction Code</th>
                    <th>Unit Code</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="downpayment in downpaymentList">
                    <td>Downpayment No. @{{ downpayment.intDownpaymentId }}</td>
                    <td>Unit No. @{{ downpayment.intUnitIdFK }}</td>
                    <td>@{{ downpayment.deciBalance | currency: "₱" }}</td>
                    <td><button ng-click="openCollect(downpayment.intDownpaymentId, downpayment, $index)"
                                data-target="downPaymentForm" class="waves-light btn light-green modal-trigger" href="#downPaymentForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>