<head><title>Service Purchase Receipt</title></head>
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
        font-family: "Helvetica";
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
<h3 align = "center">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

    <h2 align = "center">Purchase Service Receipt</h2>
    <h5 class = "date" align = "center">{!! $transactionPurchase['dateTransaction'] !!}</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $transactionPurchase['strCustomerName'] !!}</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>{!! $transactionPurchase['intTransactionId'] !!}</span></h4>
        </div>
    </div>

    <table class = "table2">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        @foreach($transactionPurchaseList as $transactionPurchaseInfo)
            @if($transactionPurchaseInfo->strAdditionalName != null)
                <tr>
                    <td>{!! $transactionPurchaseInfo->strAdditionalName !!}</td>
                    <td>{!! number_format($transactionPurchaseInfo->intQuantity) !!}</td>
                    <td>P {!! number_format($transactionPurchaseInfo->deciAdditionalPrice * $transactionPurchaseInfo->intQuantity, 2) !!}</td>
                </tr>
            @elseif($transactionPurchaseInfo->strServiceName != null)
                <tr>
                    <td>{!! $transactionPurchaseInfo->strServiceName !!}</td>
                    <td>{!! number_format($transactionPurchaseInfo->intQuantity) !!}</td>
                    <td>P {!! number_format($transactionPurchaseInfo->deciServicePrice * $transactionPurchaseInfo->intQuantity, 2) !!}</td>
                </tr>
            @elseif($transactionPurchaseInfo->strPackageName != null)
                <tr>
                    <td>{!! $transactionPurchaseInfo->strPackageName !!}</td>
                    <td>{!! number_format($transactionPurchaseInfo->intQuantity) !!}</td>
                    <td>P {!! number_format($transactionPurchaseInfo->deciPackagePrice * $transactionPurchaseInfo->intQuantity, 2) !!}</td>
                </tr>
            @endif
        @endforeach
    </table>
    <br><br>

    <table class = "table1">
        <tr>
            <td style = "border-top: 3px solid black;">Total Amount to pay</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($transactionPurchase['deciTotalAmountToPay'], 2) !!}</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>P {!! number_format($transactionPurchase['deciAmountPaid'], 2) !!}</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;">P {!! number_format($transactionPurchase['deciAmountPaid'] - $transactionPurchase['deciTotalAmountToPay'], 2) !!}</td>
        </tr>
    </table>

    <!-- <h2 align = "center">Service Purchase Receipt</h2>
    <h5 class = "date" align = "center">Dec 5, 1996</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>Kimberly Mirasol Bacarisas</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>T123</span></h4>
        </div>
    </div>

    <table class = "table2">
        <tr>
            <th>Service</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Price</th>
        </tr>
        <tr>
            <td>Cremation</td>
            <td>09/23/12</td>
            <td>9:00 PM</td>
            <td>11:00 PM</td>
            <td>P 56,000.00</td>
        </tr>
        <tr>
            <td>Transfer Ownership</td>
            <td>02/03/14</td>
            <td>3:00 PM</td>
            <td>5:00 PM</td>
            <td>P 6,000.00</td>
        </tr>
    </table>
    <br><br>

    <table class = "table1">
        <tr>
            <td>Cremation</td>
            <td>P 56,000.00</td>
        </tr>
        <tr>
            <td>Transfer Deceased</td>
            <td>P 6,000.00</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Total Amount to pay</td>
            <td style = "border-top: 3px solid black;">P 62,000.00</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>P 62,000.00</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;">P 0.00</td>
        </tr>
    </table>

    <h2 align = "center">Package Purchase Receipt</h2>
    <h5 class = "date" align = "center">Dec 5, 1996</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>Kimberly Mirasol Bacarisas</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>T123</span></h4>
        </div>
    </div>

    <table class = "table2">
        <tr>
            <th>Additionals</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        <tr>
            <td>Candle holder</td>
            <td>3</td>
            <td>P 1,500.00</td>
        </tr>
    </table>
    <table class = "table2">
        <tr>
            <th>Service</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Price</th>
        </tr>
        <tr>
            <td>Cremation</td>
            <td>09/23/12</td>
            <td>9:00 PM</td>
            <td>11:00 PM</td>
            <td>P 56,000.00</td>
        </tr>
        <tr>
            <td>Transfer Ownership</td>
            <td>02/03/14</td>
            <td>3:00 PM</td>
            <td>5:00 PM</td>
            <td>P 6,000.00</td>
        </tr>
    </table>
    <br><br>

    <table class = "table1">
        <tr>
            <td>Package 3</td>
            <td>P 56,000.00</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Total Amount to pay</td>
            <td style = "border-top: 3px solid black;">P 56,000.00</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>P 56,000.00</td>
        </tr>
        <tr>
            <td style = "border-top: 3px solid black;">Change:</td>
            <td style = "border-top: 3px solid black;">P 0.00</td>
        </tr>
    </table> -->



    </body>