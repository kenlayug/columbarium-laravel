<div id="downpayment" class="modal modal-fixed" style="width: 95%; max-height: 120%;">

    <div class="modal-header" style="background-color: #00897b;">
        <h5 style = "color: white; text-align: center; font-family: myFirstFont2; font-size: 20px;">Downpayment: @{{ customer.strFullName }}</h5>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div id="admin" class="modal-content" style="overflow-y: auto;">
        <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
            <table id="datatable1" datatable="ng">
                <thead>
                <tr>
                    <th>Transaction Code</th>
                    <th>Unit Code</th>
                    <th>Balance</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="downpayment in downpaymentList">
                    <td>Downpayment No. @{{ downpayment.intDownpaymentId }}</td>
                    <td>Unit No. @{{ downpayment.intUnitIdFK }}</td>
                    <td>@{{ downpayment.deciBalance | currency: "₱" }}</td>
                    <td>@{{ downpayment.dateDueDate | amDateFormat : 'MMMM D, YYYY' }}</td>
                    <td><button ng-click="openCollect(downpayment.intDownpaymentId, downpayment, $index)"
                                data-target="downPaymentForm" class="waves-light btn light-green modal-trigger" href="#downPaymentForm" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>