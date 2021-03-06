<style>

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
    }
    td {
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
        font-family: "Helvetica";
    }
    .margin {
        padding-top: -20px;
    }
    .date {
        padding-top: -20px;
    }

    .table1 {
        width: 65%;
        margin-left: 225px;
        margin-right: 10px;
        margin-bottom: 10px;
        border:  2px solid black;
        border-collapse: collapse;
    }

    .table1 td {
        padding-left:  30px;
    }
</style>

<head>
    <title>Unit Purchase Report</title>
</head>
<body>
<img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
<h3 align = "center" style = "font-fam;">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

<h2 align = "center">Unit Purchase Report</h2>
<h5 class = "date" align = "center">{!! $dateFrom.' - '.$dateTo !!}</h5>
<table class = "table2">
    <tr>
        <th>Date</th>
        <th>Customer Name</th>
        <th>Transaction ID</th>
        <th>Purchase Type</th>
        <th>Unit Type</th>
        <th>Unit ID</th>
        <th>Unit Price</th>
        <th>Amount Received</th>
    </tr>
    @foreach($transactionReportList as $transactionReport)
        <tr>
            <td>{!! \Carbon\Carbon::parse($transactionReport->created_at)->toDateString() !!}</td>
            <td>{!! $transactionReport->strLastName.", ".$transactionReport->strFirstName." ".$transactionReport->strMiddleName !!}</td>
            <td>{!! $transactionReport->intTransactionUnitId !!}</td>
            <td>{!! $transactionTypeList[$transactionReport->intTransactionType] !!}</td>
            <td>{!! $transactionReport->strUnitTypeName !!}</td>
            <td>{!! $transactionReport->intUnitId !!}</td>
            <td>P {!! number_format($transactionReport->deciPrice, 2) !!}</td>
            <td>P {!! number_format($transactionReport->deciAmount, 2) !!}</td>
        </tr>
    @endforeach
</table>

<br>


<table class = "table1">
    <tr>
        <td><label style = "font-size: 17px; padding-left: -10px;">Total Number of Transactions:&nbsp;</label></td>
        <td><span>{!! number_format($intNoOfTransaction) !!}</span></td>
    </tr>
    <tr>
        <td style = "border-top: 2px solid black;"><label class = "margin" style = "font-size: 17px; padding-left: -10px;">Total Amount Received:&nbsp;</label></td>
        <td style = "border-top: 2px solid black;"><span>P {!! number_format($deciTotalAmountReceived, 2) !!}</span></td>
    </tr>
</table>



<div style = "position: fixed; top: 700px;">Printed at {!! \Carbon\Carbon::now()->toDayDateTimeString() !!}</div>
</body>
