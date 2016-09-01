<html>

<style>
    * {
        box-sizing: border-box;
    }

    #logo{
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
        font-size: 13px;
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

    .date {
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
<h3 align = "center" style = "font-family: roboto3">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

@if($transactionUnit['intTransactionType'] == 3)
    <h2 align = "center">Buy Unit Receipt</h2>
    <h5 class = "date" align = "center">{!! $transactionUnit['dateTransactionUnit'] !!}</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:192pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $transactionUnit['strCustomerName'] !!}</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $transactionUnit['intTransactionUnitId'] !!}</span></h4>
        </div>
    </div>

    <table class = "table2">
        <tr>
            <th>Unit Id</th>
            <th>Unit Price</th>
            <th>Discounted Price</th>
            <th>Perpetual Care Fund</th>
        </tr>
        @foreach($transactionUnitList as $transactionUnitDetail)
        <tr>
            <td>Unit Id {!! $transactionUnitDetail['intUnitId'] !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciPrice'], 2) !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciDiscountedPrice'], 2) !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciPcf'], 2) !!}</td>
        </tr>
        @endforeach
    </table>
    <br><br>

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
            <td style = "border-top: 3px solid black;">Total Amount to pay</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($transactionUnit['deciTotalPcf'] + $transactionUnit['deciTotalUnitPrice'], 2) !!}</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>P {!! number_format($transactionUnit['deciAmountPaid'], 2) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($transactionUnit['deciAmountPaid'] - ($transactionUnit['deciTotalUnitPrice'] + $transactionUnit['deciTotalPcf']), 2) !!}</td>
        </tr>
    </table>

@elseif ($transactionUnit['intTransactionType'] == 2)

    <h2 align = "center">Reserve Unit Receipt</h2>
    <h5 class = "date" align = "center">{!! $transactionUnit['dateTransactionUnit'] !!}</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:192pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $transactionUnit['strCustomerName'] !!}</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $transactionUnit['intTransactionUnitId'] !!}</span></h4>
        </div>
    </div>

    <table class = "table2">
        <tr>
            <th>Unit Code</th>
            <th>Unit Price</th>
            <th>Years to Pay</th>
            <th>Downpayment</th>
            <th>Monthly</th>
        </tr>
        @foreach ($transactionUnitList as $transactionUnitDetail)
        <tr>
            <td>Unit Id {!! $transactionUnitDetail['intUnitId'] !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciPrice'], 2) !!}</td>
            <td>{!! $transactionUnitDetail['intNoOfYear'] !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciDownpayment'], 2) !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciMonthlyAmortization'], 2) !!}</td>
        </tr>
        @endforeach
    </table>
    <br><br>

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
            <td style = "border-top: 3px solid black;">P {!! number_format($transactionUnit['deciAmountPaid'] - (sizeof($transactionUnitList) * $transactionUnit['deciReservationFee']), 2) !!}</td>
        </tr>
    </table>

@elseif ($transactionUnit['intTransactionType'] == 4)

    <h2 align = "center">At Need Receipt</h2>
    <h5 class = "date" align = "center">{!! $transactionUnit['dateTransactionUnit'] !!}</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:192pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $transactionUnit['strCustomerName'] !!}</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $transactionUnit['intTransactionUnitId'] !!}</span></h4>
        </div>
    </div>

    <table class = "table2">
        <tr>
            <th>Unit Code</th>
            <th>Unit Price</th>
            <th>Years to Pay</th>
            <th>Downpayment</th>
            <th>Monthly</th>
            <th>Perpetual Care Fund</th>
        </tr>
        @foreach($transactionUnitList as $transactionUnitDetail)
        <tr>
            <td>Unit Id {!! $transactionUnitDetail['intUnitId'] !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciPrice'], 2) !!}</td>
            <td>{!! number_format($transactionUnitDetail['intNoOfYear']) !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciDownpayment'], 2) !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciMonthlyAmortization'], 2) !!}</td>
            <td>P {!! number_format($transactionUnitDetail['deciPcf'], 2) !!}</td>
        </tr>
        @endforeach
    </table>
    <br><br>

    <table class = "table1">
        <tr>
            <td>Total Perpetual Care Fund(10.00%):</td>
            <td>P {!! number_format($transactionUnit['deciTotalPcf'], 2) !!}</td>
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
            <td style = "border-top: 3px solid black;">P {!! number_format($transactionUnit['deciAmountPaid'] - $transactionUnit['deciTotalPcf'], 2) !!}</td>
        </tr>
    </table>

    </body>
@endif
</html>