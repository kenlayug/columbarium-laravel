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
        font-family: Helvetica;
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
<h3 align = "center">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

@if ($downpayment)
    <h2 align = "center">Downpayment Receipt</h2>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:210pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $downpaymentDetails['intTransactionId'] !!}</span></h4>
        </div>
        <div style="position:absolute; left:0pt; width:210pt; padding-top: 20px;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $downpaymentDetails['strCustomerName'] !!}</span></h4>
        </div>
        <div style="margin-left:345pt;">
            <h4 class = "col-6">Date:&nbsp;<span>{!! $downpaymentDetails['dateTransaction'] !!}</span></h4>
        </div>
    </div>

    <br>
    <table class="table1">
        <tr>
            <td>Building Name:</td>
            <td>{!! $downpaymentDetails['strBuildingName'] !!}</td>
        </tr>
        <tr>
            <td>Floor No:</td>
            <td>{!! $downpaymentDetails['intFloorNo'] !!}</td>
        </tr>
        <tr>
            <td>Room Name:</td>
            <td>{!! $downpaymentDetails['strRoomName'] !!}</td>
        </tr>
        <tr>
            <td>Block No:</td>
            <td>{!! $downpaymentDetails['intBlockNo'] !!}</td>
        </tr>
        <tr>
            <td>Unit:</td>
            <td>{!! $downpaymentDetails['intUnitId'] !!}</td>
        </tr>
    </table>

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
            <td style = "border-top: 3px solid black;"><span style="color: red;">P {!! number_format($downpaymentDetails['deciAmountPaid'] - $downpaymentDetails['deciDownpaymentBalance'], 2)  !!}</span></td>
        </tr>
        @endif
    </table>
    <br>
    <div style="position:absolute; left:395pt; padding-top: 20px;">
        <h4 class = "col-6" align = "left">Processed by:</h4>
        <h4 class = "col-6" align = "left" style = "font-weight: normal; padding-top: -7px;">Reuven Christian Abat</h4>
        <h5 class = "reservation" align = "left" style = "font-weight: normal;">(Employee)</h5>
    </div>

@elseif ($collection)

    <h2 align = "center">Collection Receipt</h2>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:210pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $transaction['intTransactionId'] !!}</span></h4>
        </div>
        <div style="position:absolute; left:0pt; width:210pt; padding-top: 20px;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $transaction['strCustomerName'] !!}</span></h4>
        </div>
        <div style="position:absolute; left:0pt; width:210pt; padding-top: 40px;">
            <h4 class = "col-6">Unit Code:&nbsp;<span>Unit Id: {!! $transaction['intUnitId'] !!}</span></h4>
        </div>
        <div style="position:absolute; left:0pt; width:210pt; padding-top: 60px;">
            <h4 class = "col-6">Unit Price:&nbsp;<span>P {!! number_format($transaction['deciPrice'], 2) !!}</span></h4>
        </div>
        <div style="margin-left:345pt;">
            <h4 class = "col-6">Date:&nbsp;<span>{!! $transaction['dateTransaction'] !!}</span></h4>
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
    <br>
    <div style="position:absolute; left:395pt; padding-top: 20px;">
        <h4 class = "col-6" align = "left">Processed by:</h4>
        <h4 class = "col-6" align = "left" style = "font-weight: normal; padding-top: -7px;">Reuven Christian Abat</h4>
        <h5 class = "reservation" align = "left" style = "font-weight: normal;">(Employee)</h5>
    </div>
@endif

</body>
</html>