<div id="pastDueSMS" class="modal modal-fixed">

    <div class="modal-header" style="background-color: #00897b;">
        <h5 style = "color: white; text-align: center; font-family: myFirstFont2; font-size: 20px; padding: 20px; margin-top: 0px;">Past Due Account: @{{ customer.strFullName }}</h5>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div id="admin" class="modal-content" style="overflow-y: auto;">
        <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
            <table id="datatable-pastDue">
                <thead>
                <tr>
                    <th>Collection Type</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Downpayment</td>
                    <td>September 3, 2016</td>
                    <td>P 12,000.00</td>
                    <td>
                        <button class="waves-light btn light-green" style = "color: #000000; padding-left: 5px; padding-right: 10px; margin-left: 5px; margin-right: 10px;">Resend SMS</button>
                    </td>
                </tr>
                <tr>
                    <td>Regular Collections</td>
                    <td>September 3, 2016</td>
                    <td>P 12,000.00</td>
                    <td>
                        <button class="waves-light btn light-green" style = "color: #000000; padding-left: 5px; padding-right: 10px; margin-left: 5px; margin-right: 10px;">Resend SMS</button>
                    </td>
                </tr>
                <tr>
                    <td>Pre-Need</td>
                    <td>September 3, 2016</td>
                    <td>P 12,000.00</td>
                    <td>
                        <button class="waves-light btn light-green" style = "color: #000000; padding-left: 5px; padding-right: 10px; margin-left: 5px; margin-right: 10px;">Resend SMS</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>