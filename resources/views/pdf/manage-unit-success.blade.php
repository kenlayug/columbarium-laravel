<html>
<head>
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
        <h5 class = "date" align = "center">(Add Deceased)</h5>

        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:10pt; width:210pt;">
                <h4 class = "col-6">Transaction Code:&nbsp;<span>T001</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 20px;">
                <h4 class = "col-6">Customer Name:&nbsp;<span>Leo Formaran</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:192pt; padding-top: 40px;">
                <h4 class = "col-6">Unit Code:&nbsp;<span>Unit Number 66</span></h4>
            </div>
            <div style="margin-left:345pt;">
                <h4 class = "col-6">Date:&nbsp;<span>Tuesday, September 2, 2016</span></h4>
            </div>
        </div>

        <table class = "table1">
            <tr>
                <td>Deceased Name:</td>
                <td>Walang, Pangalan</td>
            </tr>
            <tr>
                <td>Storage Type:</td>
                <td>Urn</td>
            </tr>
            <tr>
                <td>Service:</td>
                <td>Internment</td>
            </tr>
            <tr>
                <td>Service Fee:</td>
                <td>P 3,000.00</td>
            </tr>
            <tr>
                <td>Amount Paid:</td>
                <td>P 3,000.00</td>
            </tr>
            <tr>
                <td style = "border-top: 2px solid black;">Change:</td>
                <td style = "border-top: 2px solid black;">P 0.00</td>
            </tr>
        </table>

        <br>
        <div style="position:absolute; left:395pt; padding-top: 20px;">
            <h4 class = "col-6" align = "left">Processed by:</h4>
            <h4 class = "col-6" align = "left" style = "font-weight: normal; padding-top: -7px;">Reuven Christian Abat</h4>
            <h5 class = "reservation" align = "left" style = "font-weight: normal;">(Employee)</h5>
        </div>
    </div>

    <br>

    <div style = "border: 3px solid black;">
        <img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
        <h3 align = "center">Columbarium and Crematorium Management System</h3>
        <h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
        <h4 align = "center">Tel No: 02-364 0158</h4>

        <h2 align = "center">Manage Unit Receipt</h2>
        <h5 class = "date" align = "center">(Transfer Deceased)</h5>

        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:10pt; width:210pt;">
                <h4 class = "col-6">Transaction Code:&nbsp;<span>T001</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 20px;">
                <h4 class = "col-6">Customer Name:&nbsp;<span>Leo Formaran</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:192pt; padding-top: 40px;">
                <h4 class = "col-6">Unit Code:&nbsp;<span>Unit Number 66</span></h4>
            </div>
            <div style="margin-left:345pt;">
                <h4 class = "col-6">Date:&nbsp;<span>Tuesday, September 2, 2016</span></h4>
            </div>
        </div>

        <table class = "table2">
            <tr>
                <th>Deceased Name</th>
                <th>From Unit</th>
                <th>To Unit</th>
                <th>Date of Death</th>
            </tr>
            <tr>
                <td>Walang, Pangalan</td>
                <td>1</td>
                <td>2</td>
                <td>September 1, 2016</td>
            </tr>
        </table>
        <br>

        <table class = "table1">
            <tr>
                <td>Service:</td>
                <td>Internment</td>
            </tr>
            <tr>
                <td>Service Fee:</td>
                <td>P 1,000.00</td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td>1</td>
            </tr>
            <tr>
                <td style = "border-top: 2px solid black;">Total Amount to Pay:</td>
                <td style = "border-top: 2px solid black;">P 3,000.00</td>
            </tr>
            <tr>
                <td>Amount Paid:</td>
                <td>P 3,000.00</td>
            </tr>
            <tr>
                <td style = "border-top: 2px solid black;">Change:</td>
                <td style = "border-top: 2px solid black;">P 0.00</td>
            </tr>
        </table>

        <br>
        <div style="position:absolute; left:395pt; padding-top: 20px;">
            <h4 class = "col-6" align = "left">Processed by:</h4>
            <h4 class = "col-6" align = "left" style = "font-weight: normal; padding-top: -7px;">Reuven Christian Abat</h4>
            <h5 class = "reservation" align = "left" style = "font-weight: normal;">(Employee)</h5>
        </div>
    </div>

    <br>

    <div style = "border: 3px solid black;">
        <img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
        <h3 align = "center">Columbarium and Crematorium Management System</h3>
        <h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
        <h4 align = "center">Tel No: 02-364 0158</h4>

        <h2 align = "center">Manage Unit Receipt</h2>
        <h5 class = "date" align = "center">(Pull Out Deceased)</h5>

        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:10pt; width:210pt;">
                <h4 class = "col-6">Transaction Code:&nbsp;<span>T001</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 20px;">
                <h4 class = "col-6">Customer Name:&nbsp;<span>Leo Formaran</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 40px;">
                <h4 class = "col-6">Unit Code:&nbsp;<span>Unit Number 66</span></h4>
            </div>
            <div style="margin-left:345pt;">
                <h4 class = "col-6">Date:&nbsp;<span>Tuesday, September 2, 2016</span></h4>
            </div>
        </div>

        <table class = "table2">
            <tr>
                <th>Deceased Name</th>
                <th>Date of Death</th>
                <th>Date to Return Deceased</th>
            </tr>
            <tr>
                <td>Walang, Pangalan</td>
                <td>September 1, 2016</td>
                <td>September 14, 2016</td>
            </tr>
        </table>
        <br>

        <table class = "table1">
            <tr>
                <td>Service:</td>
                <td>Internment</td>
            </tr>
            <tr>
                <td>Service Fee:</td>
                <td>P 1,000.00</td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td>1</td>
            </tr>
            <tr>
                <td style = "border-top: 2px solid black;">Total Amount to Pay:</td>
                <td style = "border-top: 2px solid black;">P 3,000.00</td>
            </tr>
            <tr>
                <td>Amount Paid:</td>
                <td>P 3,000.00</td>
            </tr>
            <tr>
                <td style = "border-top: 2px solid black;">Change:</td>
                <td style = "border-top: 2px solid black;">P 0.00</td>
            </tr>
        </table>

        <br>
        <div style="position:absolute; left:395pt; padding-top: 20px;">
            <h4 class = "col-6" align = "left">Processed by:</h4>
            <h4 class = "col-6" align = "left" style = "font-weight: normal; padding-top: -7px;">Reuven Christian Abat</h4>
            <h5 class = "reservation" align = "left" style = "font-weight: normal;">(Employee)</h5>
        </div>
    </div>

    <br>

    <div style = "border: 3px solid black;">
        <img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
        <h3 align = "center">Columbarium and Crematorium Management System</h3>
        <h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
        <h4 align = "center">Tel No: 02-364 0158</h4>

        <h2 align = "center">Manage Unit Receipt</h2>
        <h5 class = "date" align = "center">(Return Deceased Receipt)</h5>

        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:10pt; width:210pt;">
                <h4 class = "col-6">Transaction Code:&nbsp;<span>T001</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 20px;">
                <h4 class = "col-6">Customer Name:&nbsp;<span>Leo Formaran</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 40px;">
                <h4 class = "col-6">Unit Code:&nbsp;<span>Unit Number 66</span></h4>
            </div>
            <div style="margin-left:345pt;">
                <h4 class = "col-6">Date:&nbsp;<span>Tuesday, September 2, 2016</span></h4>
            </div>
        </div>

        <table class = "table1">
            <tr>
                <td>Date of Return:</td>
                <td>September 2, 2016</td>
            </tr>
            <tr>
                <td>Deceased Name:</td>
                <td>Walang, Pangalan</td>
            </tr>
            <tr>
                <td>Penalty Fee:</td>
                <td>P 0.00</td>
            </tr>
            <tr>
                <td>Total Amount to Pay:</td>
                <td>P 3,000.00</td>
            </tr>
            <tr>
                <td>Amount Paid:</td>
                <td>P 3,000.00</td>
            </tr>
            <tr>
                <td style = "border-top: 2px solid black;">Change:</td>
                <td style = "border-top: 2px solid black;">P 0.00</td>
            </tr>
        </table>

        <br>
        <div style="position:absolute; left:395pt; padding-top: 20px;">
            <h4 class = "col-6" align = "left">Processed by:</h4>
            <h4 class = "col-6" align = "left" style = "font-weight: normal; padding-top: -7px;">Reuven Christian Abat</h4>
            <h5 class = "reservation" align = "left" style = "font-weight: normal;">(Employee)</h5>
        </div>
    </div>

    <br>

    <div style = "border: 3px solid black;">
        <img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
        <h3 align = "center">Columbarium and Crematorium Management System</h3>
        <h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
        <h4 align = "center">Tel No: 02-364 0158</h4>

        <h2 align = "center">Manage Unit Receipt</h2>
        <h5 class = "date" align = "center">(Transfer Ownership)</h5>

        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:10pt; width:210pt;">
                <h4 class = "col-6">Transaction Code:&nbsp;<span>T001</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 20px;">
                <h4 class = "col-6">Owner Name:&nbsp;<span>Leo Formaran</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 40px;">
                <h4 class = "col-6">New Owner Name:&nbsp;<span>Leyooo</span></h4>
            </div>
            <div style="position:absolute; left:10pt; width:210pt; padding-top: 60px;">
                <h4 class = "col-6">Unit Code:&nbsp;<span>Unit Number 66</span></h4>
            </div>
            <div style="margin-left:345pt;">
                <h4 class = "col-6">Date:&nbsp;<span>Tuesday, September 2, 2016</span></h4>
            </div>
        </div>

        <br><br>
        <table class = "table2">
            <tr>
                <th>Deceased Name</th>
                <th>Date of Death</th>
            </tr>
            <tr>
                <td>Walang, Pangalan</td>
                <td>September 1, 2016</td>
            </tr>
        </table>
        <br>

        <table class = "table1">
            <tr>
                <td>Service:</td>
                <td>Transfer Deceased Service</td>
            </tr>
            <tr>
                <td>Service Fee:</td>
                <td>P 1,000.00</td>
            </tr>
            <tr>
                <td>Amount Paid:</td>
                <td>P 1,000.00</td>
            </tr>
            <tr>
                <td style = "border-top: 2px solid black;">Change:</td>
                <td style = "border-top: 2px solid black;">P 0.00</td>
            </tr>
        </table>

        <br>
        <div style="position:absolute; left:395pt; padding-top: 20px;">
            <h4 class = "col-6" align = "left">Processed by:</h4>
            <h4 class = "col-6" align = "left" style = "font-weight: normal; padding-top: -7px;">Reuven Christian Abat</h4>
            <h5 class = "reservation" align = "left" style = "font-weight: normal;">(Employee)</h5>
        </div>
    </div>
</body>
</html>