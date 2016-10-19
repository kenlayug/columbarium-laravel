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
    .salesReportTable th {
        background-color: teal;
        color: white;
        font-size: 13px;
    }

    .salesReportTable {
        margin-right: 10px;
        margin-left: 10px;
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }
    .salesReportTable td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    .salesReportTable tr:nth-child(even) {
        background-color: #dddddd;
    }
    .salesReportTable td {
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

    .margin {
        padding-top: -20px;
        padding-right: 10px;
    }

    .margin2 {
        padding-right: 10px;
    }

    .date {
        padding-top: -20px;
    }

    .to {
        padding-left: 10px;
    }

    .from {
        padding-left: 10px;
        padding-top: -20px;
    }


</style>

<head><title>Sales Report</title></head>
<body style = "font-family: Helvetica">

    <img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
    <h3 align = "center">Columbarium and Crematorium Management System</h3>
    <h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
    <h4 align = "center">Tel No: 02-364 0158</h4>

    <h2 align = "center">Sales Report</h2>
    <h5 class = "date" align = "center">{!! $dateFrom.' - '.$dateTo !!}</h5>
    <table class = "salesReportTable">
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        @foreach($transactionPurchaseList as $transactionPurchase)
            <tr>
                <td>{!! \Carbon\Carbon::parse($transactionPurchase->created_at)->toFormattedDateString() !!}</td>
                @if ($transactionPurchase->strAdditionalName != null)
                    <td>Additionals</td>
                    <td>{!! $transactionPurchase->strAdditionalName !!}</td>
                    @if($transactionPurchase->intPaymentType == 0 || $transactionPurchase->intPaymentType == 1)
                        <td>P {!! number_format($transactionPurchase->additionalPrice, 2) !!}</td>
                        <td>{!! number_format($transactionPurchase->intQuantity) !!}</td>
                        <td>P {!! number_format($transactionPurchase->additionalPrice * $transactionPurchase->intQuantity, 2) !!}</td>
                    @elseif($transactionPurchase->intPaymentType == 2)
                        <td>P {!! number_format($transactionPurchase->additionalPrice/12, 2) !!}</td>
                        <td>{!! number_format($transactionPurchase->intQuantity) !!}</td>
                        <td>P {!! number_format(($transactionPurchase->additionalPrice/12) * $transactionPurchase->intQuantity, 2) !!}</td>
                    @endif
                @elseif ($transactionPurchase->strServiceName != null)
                    <td>Services</td>
                    <td>{!! $transactionPurchase->strServiceName !!}</td>
                    @if($transactionPurchase->intPaymentType == 0 || $transactionPurchase->intPaymentType == 1)
                        <td>P {!! number_format($transactionPurchase->servicePrice, 2) !!}</td>
                        <td>{!! number_format($transactionPurchase->intQuantity) !!}</td>
                        <td>P {!! number_format($transactionPurchase->servicePrice * $transactionPurchase->intQuantity, 2) !!}</td>
                    @elseif($transactionPurchase->intPaymentType == 2)
                        <td>P {!! number_format($transactionPurchase->servicePrice/12, 2) !!}</td>
                        <td>{!! number_format($transactionPurchase->intQuantity) !!}</td>
                        <td>P {!! number_format(($transactionPurchase->servicePrice/12) * $transactionPurchase->intQuantity, 2) !!}</td>
                    @endif
                @elseif ($transactionPurchase->strPackageName != null)
                    <td>Packages</td>
                    <td>{!! $transactionPurchase->strPackageName !!}</td>
                    @if($transactionPurchase->intPaymentType == 0 || $transactionPurchase->intPaymentType == 1)
                        <td>P {!! number_format($transactionPurchase->packagePrice, 2) !!}</td>
                        <td>{!! number_format($transactionPurchase->intQuantity) !!}</td>
                        <td>P {!! number_format($transactionPurchase->packagePrice * $transactionPurchase->intQuantity, 2) !!}</td>
                    @elseif($transactionPurchase->intPaymentType == 2)
                        <td>P {!! number_format($transactionPurchase->packagePrice/12, 2) !!}</td>
                        <td>{!! number_format($transactionPurchase->intQuantity) !!}</td>
                        <td>P {!! number_format(($transactionPurchase->packagePrice/12) * $transactionPurchase->intQuantity, 2) !!}</td>
                    @endif
                @endif
            </tr>
        @endforeach
    </table>

    <br>
    <h5 class = "margin2" align = "right">Total Number of Transactions:&nbsp;<span>{!! number_format(sizeof($transactionPurchaseList)) !!}</span></h5>
    <h5 class = "margin" align = "right">Total Sales:&nbsp;<span>P {!! number_format($deciTotalSales, 2) !!}</span></h5>
</body>
