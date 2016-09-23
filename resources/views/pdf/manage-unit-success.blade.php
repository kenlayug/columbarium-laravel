<html>
<head>
    <title>Manage Unit Receipt</title>
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
            margin: 10px;
            width: 100%;
            border:  2px solid black;
            border-collapse: collapse;
        }

        .table1 td {
            padding-left:  30px;
        }

    </style>
</head>

<body>
    <div style = "border: 3px solid black;">
        <img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
        <h3 align = "center">Columbarium and Crematorium Management System</h3>
        <h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
        <h4 align = "center">Tel No: 02-364 0158</h4>

        <h2 align = "center">Manage Unit Receipt</h2>
        @if($transactionDetail['intTransactionType'] == 1)
            <h5 class = "date" align = "center">(Add Deceased)</h5>
        @elseif($transactionDetail['intTransactionType'] == 2)
            <h5 class = "date" align = "center">(Transfer Deceased)</h5>
        @elseif($transactionDetail['intTransactionType'] == 3)
            <h5 class = "date" align = "center">(Pull/Borrow Deceased)</h5>
        @endif

        <div style="clear:both; position:relative;">
            <div style="position:absolute; left: 10pt; width:210pt;">
                <h4 class = "col-6">Transaction Code:&nbsp;<span>{!! $transactionDetail['intTransactionId'] !!}</span></h4>
            </div>
            <div style="position:absolute; left: 10pt; width:210pt; padding-top: 20px;">
                <h4 class = "col-6">Customer Name:&nbsp;<span>{!! $transactionDetail['strCustomerName'] !!}</span></h4>
            </div>
            <div style="margin-left:345pt;">
                <h4 class = "col-6">Date:&nbsp;<span>{!! $transactionDetail['dateTransaction'] !!}</span></h4>
            </div>
        </div>

        <table class = "table2">
            <tr>
                <th>Deceased Name</th>
                <th>Unit</th>
                <th>Date of Death</th>
                @if($transactionDetail['intTransactionType'] == 3 && $transactionDetail['strServiceName'] == null)
                    <th>Return Date</th>
                @endif
            </tr>
            @foreach($deceasedList as $deceased)
                <tr>
                    <td>{!! $deceased['strDeceasedName'] !!}</td>
                    <td>{!! $deceased['intUnitId'] !!}</td>
                    <td>{!! $deceased['dateDeath'] !!}</td>
                    @if($transactionDetail['intTransactionType'] == 3 && $transactionDetail['strServiceName'] == null)
                        <td>{!! $deceased['dateReturn'] !!}</td>
                    @endif
                </tr>
            @endforeach
        </table>
        <br>

        <table class = "table1">
            @if($transactionDetail['strServiceName'])
                <tr>
                    <td>Service:</td>
                    <td>{!! $transactionDetail['strServiceName'] !!}</td>
                </tr>
                <tr>
                    <td>Service Fee:</td>
                    <td>P {!! number_format($transactionDetail['deciServicePrice'], 2) !!}</td>
                </tr>
            @endif
            <tr>
                <td>Quantity:</td>
                <td>{!! number_format(sizeof($deceasedList)) !!}</td>
            </tr>
            @if($transactionDetail['strServiceName'])
                <tr>
                    <td style = "border-top: 2px solid black;">Total Amount to Pay:</td>
                    <td style = "border-top: 2px solid black;">P {!! number_format($transactionDetail['deciServicePrice'] * sizeof($deceasedList), 2) !!}</td>
                </tr>
                <tr>
                    <td>Amount Paid:</td>
                    <td>P {!! number_format($transactionDetail['deciAmountPaid'], 2) !!}</td>
                </tr>
                <tr>
                    <td style = "border-top: 2px solid black;">Change:</td>
                    <td style = "border-top: 2px solid black;">P {!! number_format($transactionDetail['deciAmountPaid'] - ($transactionDetail['deciServicePrice'] * sizeof($deceasedList)), 2) !!}</td>
                </tr>
            @endif
        </table>

        <br><br>
        <div style="float: right; padding-right: 10px; padding-top: 20px;">
            <h4 class = "col-6" align = "right" style = "padding-bottom: 7px;">Processed by:</h4>
            <hr style = "margin-right: 0px; color: black; width: 170px; height: .5px; background-color: black;">
            <h4 class = "col-6" align = "right" style = "font-weight: normal; padding-top: -13px;">Reuven Christian Abat</h4>
            <h5 class = "reservation" align = "right" style = "padding-top: -20px; font-weight: normal;">(Employee)</h5>
        </div>
    </div>
</body>
</html>