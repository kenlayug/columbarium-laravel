<head>
<title>Reservation Receipt</title>
</head>
<div class="main">
<div class="reservation-receipt">
    <h2 style="text-align: center"><img id="logo" src="{!! public_path('img/C&C-Logo-Final.png') !!}">Columbarium and Crematory Management System</h2><br>
    <center><h5 id="place">Sta. Mesa, Manila</h5></center><br>
    <center><h3 id="receipt">Reservation Receipt</h3></center>
    <div class="receipt-content-header">
        <div class="left">
            <label><b>Receipt Number:</b> {!! $reservation->intReservationId !!}</label><br>
            <label class="right"><b>Date:</b> {!! $reservation->created_at !!}</label>
        </div>
        <div class="left">
            <label><b>Received From:</b> {!! $reservation->strLastName.', '.$reservation->strFirstName.' '.$reservation->strMiddleName !!}</label><br>
            <label class="right"><b>Mode of Payment:</b> {!! $reservation->payment_type !!}</label>
        </div>
    </div><br><br>
    <div class="receipt-content" style="margin-top: -30px;">
        <div class="simple-table">
            <table style="width: 100%;">
                <thead>
                <tr>
                    <th>Unit</th>
                    <th>Unit Type</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservationDetailList as $reservationDetail)
                    <tr>
                        <td>Unit No. {!! $reservationDetail->intUnitId !!}</td>
                        <td>{!! $reservationDetail->unit_type !!}</td>
                        <td>P{!! number_format($reservationDetail->deciPrice, 2) !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="receipt-content-reservation" style="margin-left: -55px;">
            <div class="simple-table-v2">
                <table style="width: 50%; border: white">
                    <tr>
                        <th>Reservation Fee: </th>
                        <td style="text-align: right">P 3,000.00</td>
                    </tr>
                    <tr>
                        <th>No. Of Units: </th>
                        <td style="text-align: right">{!! $reservationDetailList->count() !!}</td>
                    </tr>
                    <tr>
                        <th><hr id="total">Total Amount: </th>
                        <td style="text-align: right"><hr id="totalPrice">P{!! number_format($reservationDetailList->count()*3000, 2) !!}</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="receipt-content-reservation-total" style="margin-left: -55px;">
            <div class="simple-table-v3">
                <table style="width: 50%; border: white;">
                    <tr>
                        <th>Amount Received: </th>
                        <td style="text-align: right">P {!! number_format($reservation->deciAmountPaid, 2) !!}</td>
                    </tr>
                    <tr>
                        <th><hr id="change">Change: </th>
                        <td style="text-align: right"><hr id="changePrice">P{!! number_format($reservation->deciAmountPaid-$reservationDetailList->count()*3000, 2) !!}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <label>Unit Details: </label>
    <div class="receipt-content-unitDetails">
        <div class="unitDetails-table">
            <table style="width: 100%;">
                <thead>
                <tr>
                    <th>Unit</th>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>Room</th>
                    <th>Block</th>
                    <th>Column</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservationDetailList as $reservationDetail)
                    <tr>
                        <td>Unit No. {!! $reservationDetail->intUnitId !!}</td>
                        <td>{!! $reservationDetail->strBuildingName !!}</td>
                        <td>Floor No. {!! $reservationDetail->intFloorNo !!}</td>
                        <td>Room No. {!! $reservationDetail->intRoomNo !!}</td>
                        <td>{!! $reservationDetail->strBlockName !!}</td>
                        <td>{!! $reservationDetail->intColumnNo !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<style>
    table{
        border-collapse: collapse;
    }
    label{
        font-size: 13px;
        padding-left: 20px;
    }
    th{
        font-size: 15px;
        border: 1px solid #cbcbcb;
    }
    td{
        font-size: 13px;
        text-align: center;

        border: 1px solid #cbcbcb;
    }
    #place{
        margin-top: -80px;
        font-weight: lighter;
    }
    #logo{
        margin-right: -10px;
        margin-top: 150px;
        width: 150px;
        height: 150px;
    }
    #receipt{
        margin-top: -50px;
    }
    .reservation-receipt{
        margin-top: -200px;

    }
    .right{
        text-align: right;
    }
    .receipt-content-header, .receipt-content, .receipt-content-unitDetails{
        margin: 15px;
    }
    .main{
        border: 1px solid black;
    }
    .simple-table-v2 table, .simple-table-v3 table{
        width: 50%;
    }
    .simple-table-v2 table th, .simple-table-v3 table th{
        font-weight: normal;
        font-size: 14px;
        border: white;
        padding-left: 250px;
        text-align: left;
    }
    .simple-table-v2 table td, .simple-table-v3 table td{
        font-weight: normal;
        padding-right: -150px;
        font-size: 13px;
        border: white;
        text-align: left;
    }
    #total{
        width: 350px;
        border: 1px solid black;
    }
    #change{
        width: 350px;
        border: 1px solid black;
    }
    #changePrice{
        width: 0px;
        border: 1px solid black;
    }
    .receipt-content-reservation{
        margin-left: -200px;
    }
    .receipt-content-reservation-total{
        margin-left: -200px;
    }
</style>