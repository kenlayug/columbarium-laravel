<div id="modalViewReservations" class="modal modal-fixed">
    <div class="cmxform">
        <div class="row">
            <div id="admin2" class="col s12" style="margin: 0;">
                <div class="card material-table">
                    <div class="table-header" style="background-color: #00897b;">
                        <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Customer Reservation History: <u>@{{ customer.strFullName }}</u></h4>
                        <div class="actions">
                            <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                        </div>
                    </div>
                    <table id="datatable1">
                        <thead>
                        <tr>
                            <th>Reservation Code</th>
                            <th>Unit</th>
                            <th>Unit Price</th>
                            <th>Downpayment</th>
                            <th>Balance</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="reservation in reservationList">
                            <td>Reservation @{{ reservation.intReservationId }}</td>
                            <td>Unit @{{ reservation.intUnitIdFK }}</td>
                            <td>@{{ reservation.deciPrice|currency: "₱" }}</td>
                            <td>@{{ reservation.downpayment|currency: "₱" }}</td>
                            <td>@{{ reservation.balance|currency: "₱" }}</td>
                            <td><button ng-click="openCollect(reservation.intReservationDetailId, $index)"
                                        data-target="modal2" class="waves-light btn light-green modal-trigger" href="#modal2" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>