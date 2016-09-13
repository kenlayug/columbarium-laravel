<html>
<head><title>Unit Purchase Receipt</title></head>
<style>
    * {
        font-family: "Helvetica";
        box-sizing: border-box;
    }

    #logo {
        margin-top: -20px;
        margin-left: -25px;
        width: 150px;
        height: 150px;
        position: absolute;
        z-index: 99;
    }
    span {
        font-weight: normal;
    }
    th {
        background-color: teal;
        color: white;
        font-size: 17px;
        font-weight: bold;
    }

    td {
        font-size: 15px;
    }

    .table2 {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }
    .table2 td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    .table2 tr:nth-child(even) {
        background-color: #dddddd;
    }
    .table2 td {
        font-weight: bold;
    }
    span {
        font-weight: normal;
    }
    h3 {
        margin-top: 30px;
    }
    h4 {
        padding-top: -20px;
    }
    body {
        font-family: "Arial Narrow";
    }

    .reservation {
        padding-top: -20px;
    }

    .table1 {
        width: 100%;
        border:  3px solid black;
        border-collapse: collapse;
    }

    .table1 td {
        padding-left:  30px;
    }

</style>


<body>
<img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
<h3 align = "center">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

<h2 align = "center">Purchase Unit Receipt</h2>
@if($transactionUnit['intTransactionType'] == 3)
    <h5 class = "reservation" align = "center">(One Time Payment)</h5>
@elseif($transactionUnit['intTransactionType'] == 2)
    <h5 class = "reservation" align = "center">(Reservation)</h5>
@elseif($transactionUnit['intTransactionType'] == 4)
    <h5 class = "reservation" align = "center">(At Need)</h5>
@endif

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:210pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $transactionUnit['intTransactionUnitId'] !!}</span></h4>
        </div>
        <div style="position:absolute; left:0pt; width:210pt; padding-top: 20px;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $transactionUnit['strCustomerName'] !!}</span></h4>
        </div>
        <div style="margin-left:345pt;">
            <h4 class = "col-6">Date:&nbsp;<span>{!! $transactionUnit['dateTransactionUnit'] !!}</span></h4>
        </div>
    </div>
    <br>
    <table class = "table2">
        <tr>
            <th>Building Name</th>
            <th>Floor No</th>
            <th>Room Name</th>
            <th>Block No</th>
            <th>Unit</th>
            <th>Unit Price</th>
            @if($transactionUnit['intTransactionType'] == 3)
                <th>Discounted Price</th>
                <th>Perpetual Care Fund</th>
            @elseif($transactionUnit['intTransactionType'] == 2)
                <th>Years to Pay</th>
                <th>Downpayment</th>
                <th>Monthly</th>
            @elseif($transactionUnit['intTransactionType'] == 4)
                <th>Perpetual Care Fund</th>
            @endif
        </tr>
        @foreach($transactionUnitList as $transactionUnitDetail)
            <tr>
                <td>{!! $transactionUnitDetail['strBuildingName'] !!}</td>
                <td>{!! $transactionUnitDetail['intFloorNo'] !!}</td>
                <td>{!! $transactionUnitDetail['strRoomName'] !!}</td>
                <td>{!! $transactionUnitDetail['intBlockNo'] !!}</td>
                <td>{!! $transactionUnitDetail['intUnitId'] !!}</td>
                <td>P {!! number_format($transactionUnitDetail['deciPrice'], 2) !!}</td>
                @if($transactionUnit['intTransactionType'] == 3)
                    <td>P {!! number_format($transactionUnitDetail['deciDiscountedPrice'], 2) !!}</td>
                    <td>P {!! number_format($transactionUnitDetail['deciPcf'], 2) !!}</td>
                @elseif($transactionUnit['intTransactionType'] == 2)
                    <td>{!! $transactionUnitDetail['intNoOfYear'] !!}</td>
                    <td>P {!! number_format($transactionUnitDetail['deciDownpayment'], 2) !!}</td>
                    <td>P {!! number_format($transactionUnitDetail['deciMonthlyAmortization'], 2) !!}</td>
                @elseif($transactionUnit['intTransactionType'] == 4)
                    <td>P {!! number_format($transactionUnitDetail['deciPcf'], 2) !!}</td>
                @endif
            </tr>
        @endforeach
    </table>
    <br><br>

@if ($transactionUnit['intTransactionType'] == 3)
    <table class = "table1">
        <tr>
            <td>Total Unit Price(with discount):</td>
            <td>P {!! number_format($transactionUnit['deciTotalUnitPrice'], 2) !!}</td>
        </tr>
        <tr>
            <td>Perpetual Care Fund:</td>
            <td>P {!! number_format($transactionUnit['deciTotalPcf'], 2) !!}</td>
        </tr>
        <tr>
            <td>Number of Units:</td>
            <td>{!! number_format(sizeof($transactionUnitList)) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Total Amount to pay</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($transactionUnit['deciTotalPcf'] + $transactionUnit['deciTotalUnitPrice'], 2) !!}</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>P {!! number_format($transactionUnit['deciAmountPaid'], 2) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;"><span style="color: red;">P {!! number_format($transactionUnit['deciAmountPaid'] - ($transactionUnit['deciTotalUnitPrice'] + $transactionUnit['deciTotalPcf']), 2) !!}</span></td>
        </tr>
    </table>
@elseif($transactionUnit['intTransactionType'] == 2)
    <table class = "table1">
        <tr>
            <td>Due Date for Downpayment:</td>
            <td>{!! $transactionUnit['dateDue'] !!}</td>
        </tr>
        <tr>
            <td>Reservation Fee:</td>
            <td>P {!! number_format($transactionUnit['deciReservationFee'], 2) !!}</td>
        </tr>
        <tr>
            <td>Number of Units:</td>
            <td>{!! sizeof($transactionUnitList) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Total Amount to pay</td>
            <td style = "border-top: 3px solid black;">P {!! number_format(sizeof($transactionUnitList) * $transactionUnit['deciReservationFee'], 2) !!}</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>P {!! number_format($transactionUnit['deciAmountPaid'], 2) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;"><span style="color: red;">P {!! number_format($transactionUnit['deciAmountPaid'] - (sizeof($transactionUnitList) * $transactionUnit['deciReservationFee']), 2) !!}</span></td>
        </tr>
    </table>
@elseif($transactionUnit['intTransactionType'] == 4)
    <table class = "table1">
        <tr>
            <td>Due Date for Downpayment:</td>
            <td>{!! $transactionUnit['dateDue'] !!}</td>
        </tr>
        <tr>
            <td>Total Perpetual Care Fund(10.00%):</td>
            <td>P {!! number_format($transactionUnit['deciTotalPcf'], 2) !!}</td>
        </tr>
        <tr>
            <td>Number of Units:</td>
            <td>{!! number_format(sizeof($transactionUnitList)) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Total Amount to pay</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($transactionUnit['deciTotalPcf'], 2) !!}</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>P {!! number_format($transactionUnit['deciAmountPaid'], 2) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;"><span style="color: red;">P {!! number_format($transactionUnit['deciAmountPaid'] - $transactionUnit['deciTotalPcf'], 2) !!}</span></td>
        </tr>
    </table>
@endif
    <br>
    <div style="position:absolute; left:395pt; padding-top: 20px;">
        <h4 class = "col-6" align = "left">Processed by:</h4>
        <h4 class = "col-6" align = "left" style = "font-weight: normal; padding-top: -7px;">Reuven Christian Abat</h4>
        <h5 class = "reservation" align = "left" style = "font-weight: normal;">(Employee)</h5>
    </div>

</body>
</html>