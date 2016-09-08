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
    <title>Receivable Reports</title>
</head>

<body>
<img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
<h3 align = "center">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

<h2 align = "center">Receivables Report</h2>
<h5 class = "date" align = "center">{!! \Carbon\Carbon::now()->toDayDateTimeString() !!}</h5>
<table>
    <tr>
        <th>Customer Name</th>
        <th>Unit Id</th>
        <th>Unit Price</th>
        <th>Category</th>
        <th>Amount to Receive</th>
    </tr>
    @foreach($receivableList as $receivable)
        <tr>
            <td>{!! $receivable['strCustomerName'] !!}</td>
            <td>{!! $receivable['intUnitId'] !!}</td>
            <td>P {!! number_format($receivable['deciPrice'], 2) !!}</td>
            <td>{!! $categoryList[$receivable['intCategory']] !!}</td>
            <td>P {!! number_format($receivable['deciAmountToReceive'], 2) !!}</td>
        </tr>
    @endforeach
</table>

<br>
<h5 align = "right">Total Number of Receivable/s:&nbsp;<span>{!! number_format($intTransactionNo) !!}</span></h5>
<h5 class = "margin" align = "right">Total Balance Amount:&nbsp;<span>P {!! number_format($deciTotalReceivables, 2) !!}</span></h5>
<div style = "position: fixed; top: 700px;">Printed at {!! \Carbon\Carbon::now()->toDayDateTimeString() !!}</div>

</body>
