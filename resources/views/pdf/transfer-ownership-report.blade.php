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
    td {
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
    .margin {
        padding-top: -20px;
    }
    .date {
        padding-top: -20px;
    }
    .table1 {
        width: 60%;
        margin-left: 320px;
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
    <title>Transfer Ownership</title>
</head>
<body>
<img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
<h3 align = "center" style = "font-family: roboto3">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

<h2 align = "center">Transfer Ownership Report</h2>
<h5 class = "date" align = "center">{!! $dateFrom.' - '.$dateTo !!}</h5>
<table class = "table2">
    <tr>
        <th>Date</th>
        <th>Prev Owner Name</th>
        <th>Unit Code</th>
        <th>New Customer Name</th>
        <th>Amount</th>
    </tr>
    @foreach($transferOwnershipReportList as $transferOwnershipReport)
    <tr>
        <td>{!! \Carbon\Carbon::parse($transferOwnershipReport->created_at)->toDateString() !!}</td>
        <td>{!! $transferOwnershipReport->prev_owner !!}</td>
        <td>{!! $transferOwnershipReport->intUnitIdFK !!}</td>
        <td>{!! $transferOwnershipReport->new_owner !!}</td>
        <td>P {!! number_format($transferOwnershipReport->amount, 2) !!}</td>
    </tr>
    @endforeach
</table>

<br>

<table class = "table1">
    <tr>
        <td><label style = "font-size: 17px; padding-left: -10px;">Total Number of Transactions:&nbsp;</label></td>
        <td><span>{!! number_format($intTransactionNo) !!}</span></td>
    </tr>
    <tr>
        <td style = "border-top: 2px solid black;"><label class = "margin" style = "font-size: 17px; padding-left: -10px;">Total Amount:&nbsp;</label></td>
        <td style = "border-top: 2px solid black;"><span>P {!! number_format($deciTotalAmountPaid, 2) !!}</span></td>
    </tr>
</table>



<div style = "position: fixed; top: 700px;">Printed at {!! \Carbon\Carbon::now()->toDayDateTimeString() !!}</div>
</body>
