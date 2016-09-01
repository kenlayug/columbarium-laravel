<html>
<head>
@if ($collection != null)
    <title>Collection Receipt</title>
@elseif ($downpayment)
    <title>Downpayment Receipt</title>
@endif
</head>
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
        margin: 10px;
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
        margin-left: 10px;
        margin-right: 10px;
        margin-bottom: 10px;
        width: 100%;
        border:  2px solid black;
        border-collapse: collapse;
    }

    .table1 td {
        padding-left:  30px;
    }

</style>


<body>

<div class = "container" style = "border: 3px solid black;">
<img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
<h3 align = "center" style = "font-family: roboto3">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

@if ($downpayment)
    <h2 align = "center">Downpayment Receipt</h2>
    <h5 class = "date" align = "center">{!! $downpaymentDetails['dateTransaction'] !!}</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:192pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $downpaymentDetails['strCustomerName'] !!}</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $downpaymentDetails['intTransactionId'] !!}</span></h4>
        </div>
        <div style="position:absolute; left:0pt; width:192pt; padding-top: -22px;">
            <h4 class = "col-6">Unit Id:&nbsp;<span>{!! $downpaymentDetails['intUnitId'] !!}</span></h4>
        </div>
    </div>

    <br>

    <table class = "table1">
        <tr>
            <td>Downpayment Balance
            @if ($downpaymentDetails['boolDiscounted'])
                (with Spotdown Discount)
            @endif
            :
            </td>
            <td>P {!! number_format($downpaymentDetails['deciDownpaymentBalance'], 2) !!}</td>
        </tr>
        <tr>
            <td>Amount Paid:</td>
            <td>P {!! number_format($downpaymentDetails['deciAmountPaid'], 2) !!}</td>
        </tr>
        @if ($downpaymentDetails['deciDownpaymentBalance'] > $downpaymentDetails['deciAmountPaid'])
        <tr>
            <td style = "border-top: 3px solid black;">Balance:</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($downpaymentDetails['deciDownpaymentBalance'] - $downpaymentDetails['deciAmountPaid'], 2) !!}</td>
        </tr>
        @else
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($downpaymentDetails['deciAmountPaid'] - $downpaymentDetails['deciDownpaymentBalance'], 2)  !!}</td>
        </tr>
        @endif
    </table>

    <br><br>

@elseif ($collection)

    <h2 align = "center">Collection Receipt</h2>
    <h5 class = "date" align = "center">{!! $transaction['dateTransaction'] !!}</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:192pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $transaction['strCustomerName'] !!}</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $transaction['intTransactionId'] !!}</span></h4>
        </div>
        <div style="position:absolute; left:0pt; width:192pt; padding-top: -22px;">
            <h4 class = "col-6">Unit Code:&nbsp;<span>Unit Id: {!! $transaction['intUnitId'] !!}</span></h4>
        </div>
        <div style="position:absolute; left:0pt; width:192pt; padding-top: -5px;">
            <h4 class = "col-6">Unit Price:&nbsp;<span>P {!! number_format($transaction['deciPrice'], 2) !!}</span></h4>
        </div>
    </div>

    <br><br>
    <table class = "table2">
        <tr>
            <th>Due Date</th>
            <th>Monthly Amortization</th>
            <th>Penalty</th>
        </tr>
        @foreach($collectionDetailList as $collectionDetail)
            <tr>
                <td>{!! $collectionDetail['dateDue'] !!}</td>
                <td>P {!! number_format($collectionDetail['deciMonthlyAmortization'], 2) !!}</td>
                <td>P {!! number_format($collectionDetail['deciPenalty'], 2) !!}</td>
            </tr>
        @endforeach
    </table>

    <br><br>

    <table class = "table1">
        <tr>
            <td>Total Amount to Pay:</td>
            <td>P {!! number_format($transaction['deciAmountToPay'], 2) !!}</td>
        </tr>
        <tr>
            <td>Amount Paid:</td>
            <td>P {!! number_format($transaction['deciAmountPaid'], 2) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($transaction['deciAmountPaid'] - $transaction['deciAmountToPay'], 2) !!}</td>
        </tr>
    </table>
@endif

</body>
</html>