<html>

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
        font-family: "Arial Narrow";
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
<h3 align = "center" style = "font-family: roboto3">Columbarium and Crematorium Management System</h3>
<h4 align = "center">La Loma Catholic Cemetery Compound C3 Road Caloocan City</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

<h2 align = "center">Buy Unit Receipt</h2>
<h5 class = "date" align = "center">Tuesday, August 26, 2016</h5>

<div style="clear:both; position:relative;">
    <div style="position:absolute; left:0pt; width:192pt;">
        <h4 class = "col-6">Customer Name:&nbsp;<span>Leo Formaran</span></h4>
    </div>
    <div style="margin-left:400pt;">
        <h4 class = "col-6">Transaction Code:&nbsp;<span>T001</span></h4>
    </div>
</div>

<table class = "table2">
    <tr>
        <th>Unit Code</th>
        <th>Unit Price</th>
        <th>Discounted Price</th>
    </tr>
    <tr>
        <td>Unit Number 65</td>
        <td>P 30,000.00</td>
        <td>P 20,000.00</td>
    </tr>
</table>
<br><br>

<table class = "table1">
    <tr>
        <td>Total Unit Price(with discount):</td>
        <td>P 27,000.00</td>
    </tr>
    <tr>
        <td>Perpetual Care Fund:</td>
        <td>P 3,000.00</td>
    </tr>
    <tr>
        <td style = "border-top: 3px solid black;">Total Amount to pay</td>
        <td style = "border-top: 3px solid black;">P 30,000.00</td>
    </tr>
    <tr>
        <td>Amount Paid</td>
        <td>P 40,000.00</td>
    </tr>
    <tr>
        <td style = "border-top: 3px solid black;">Change:</td>
        <td style = "border-top: 3px solid black;">P 10,000.00</td>
    </tr>
</table>


<h2 align = "center">Reserve Unit Receipt</h2>
<h5 class = "date" align = "center">Tuesday, August 26, 2016</h5>

<div style="clear:both; position:relative;">
    <div style="position:absolute; left:0pt; width:192pt;">
        <h4 class = "col-6">Customer Name:&nbsp;<span>Leo Formaran</span></h4>
    </div>
    <div style="margin-left:400pt;">
        <h4 class = "col-6">Transaction Code:&nbsp;<span>T001</span></h4>
    </div>
</div>

<table class = "table2">
    <tr>
        <th>Unit Code</th>
        <th>Unit Price</th>
        <th>Years to Pay</th>
        <th>Downpayment</th>
        <th>Monthly</th>
    </tr>
    <tr>
        <td>Unit Number 66</td>
        <td>P 5,000.00</td>
        <td>1</td>
        <td>P 5,000.00</td>
        <td>P 5,000.00</td>
    </tr>
</table>
<br><br>

<table class = "table1">
    <tr>
        <td>Due Date for Downpayment:</td>
        <td>September 4, 2016</td>
    </tr>
    <tr>
        <td>Reservation Fee:</td>
        <td>P 3,000.00</td>
    </tr>
    <tr>
        <td>Number of Units:</td>
        <td>1</td>
    </tr>
    <tr>
        <td style = "border-top: 3px solid black;">Total Amount to pay</td>
        <td style = "border-top: 3px solid black;">P 3,000.00</td>
    </tr>
    <tr>
        <td>Amount Paid</td>
        <td>P 4,000.00</td>
    </tr>
    <tr>
        <td style = "border-top: 3px solid black;">Change:</td>
        <td style = "border-top: 3px solid black;">P 0.00</td>
    </tr>
</table>

<h2 align = "center">At Need Receipt</h2>
<h5 class = "date" align = "center">Tuesday, August 26, 2016</h5>

<div style="clear:both; position:relative;">
    <div style="position:absolute; left:0pt; width:192pt;">
        <h4 class = "col-6">Customer Name:&nbsp;<span>Leo Formaran</span></h4>
    </div>
    <div style="margin-left:400pt;">
        <h4 class = "col-6">Transaction Code:&nbsp;<span>T001</span></h4>
    </div>
</div>

<table class = "table2">
    <tr>
        <th>Unit Code</th>
        <th>Unit Price</th>
        <th>Years to Pay</th>
        <th>Downpayment</th>
        <th>Monthly</th>
    </tr>
    <tr>
        <td>Unit Number 67</td>
        <td>P 5,000.00</td>
        <td>1</td>
        <td>P 5,000.00</td>
        <td></td>
    </tr>
</table>
<br><br>

<table class = "table1">
    <tr>
        <td>Total Unit Price:</td>
        <td>P 30,000.00</td>
    </tr>
    <tr>
        <td>Total Perpetual Care Fund(10.00%):</td>
        <td>P 3,000.00</td>
    </tr>
    <tr>
        <td style = "border-top: 3px solid black;">Total Amount to pay</td>
        <td style = "border-top: 3px solid black;">P 3,000.00</td>
    </tr>
    <tr>
        <td>Amount Paid</td>
        <td>P 3,000.00</td>
    </tr>
    <tr>
        <td style = "border-top: 3px solid black;">Change:</td>
        <td style = "border-top: 3px solid black;">P 0.00</td>
    </tr>
</table>

</body>
</html>