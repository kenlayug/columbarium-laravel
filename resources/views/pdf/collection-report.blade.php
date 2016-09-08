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
        font-size: 13px;
        background-color: teal;
        color: white;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
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
        font-family: "Helvetica";
    }
    .margin {
        padding-top: -20px;
    }
    .date {
        padding-top: -20px;
    }
</style>

<head>
    <title>Collection Report</title>
</head>
<body>
<img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
<h3 align = "center">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

<h2 align = "center">Collection Report</h2>
<h5 class = "date" align = "center">{!! $dateFrom.' - '.$dateTo !!}</h5>
<table>
    <tr>
        <th>Date</th>
        <th>Customer Name</th>
        <th>Category</th>
        <th>Unit Type</th>
        <th>Unit Id</th>
        <th>Unit Price</th>
        <th>Amount Paid</th>
    </tr>
    @foreach($reportList as $report)
        <tr>
            <td>{!! \Carbon\Carbon::parse($report['dateTransaction'])->toFormattedDateString() !!}</td>
            <td>{!! $report['strCustomerName'] !!}</td>
            <td>{!! $categoryList[$report['intCategory']] !!}</td>
            <td>{!! $report['strUnitType'] !!}</td>
            <td>{!! $report['intUnitId'] !!}</td>
            <td>P {!! number_format($report['deciPrice'], 2) !!}</td>
            <td>P {!! number_format($report['deciAmountPaid'], 2) !!}</td>
        </tr>
    @endforeach
</table>

<br>
<footer>
<h5 align = "right">Total Number of Transactions:&nbsp;<span>{!! number_format($intNoOfTransaction) !!}</span></h5>
<h5 class = "margin" align = "right">Total Amount Paid:&nbsp;<span>P {!! number_format($deciTotalAmountReceived, 2) !!}</span></h5>
</footer>
<div style = "position: fixed; top: 700px;">Printed at {!! \Carbon\Carbon::now()->toDayDateTimeString() !!}</div>
</body>
