<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>


    <style>
        * {
            font-family: roboto3;
        }

        #logo{
            margin-top: -20px;
            margin-left: -15px;
            width: 150px;
            height: 150px;
        }

        span {
            font-weight: normal;
        }

        .main td {
            border-right: solid 3px dimgrey;
            border-left: solid 3px dimgrey;
        }

        .main th {
            border-right: solid 3px dimgrey;
            border-left: solid 3px dimgrey;
        }

        .unitTable td {
            border-right: solid 3px dimgrey;
            border-left: solid 3px dimgrey;
        }

        .unitTable th {
            border-right: solid 3px dimgrey;
            border-left: solid 3px dimgrey;
        }


        table {
            border-collapse: collapse;
            border: 3px solid dimgrey;
            width: 90%;
        }
        th {
            height: 40px;
            font-size: 18px;
        }

        hr {
            width: 95%;
        }

        .unitTable {
            margin-top: -30px;
        }

        .label {
            border: none;
            width: 140%;
            margin-left: 67px;
        }

        td {
            font-weight: bold;
        }

        span {
            font-weight: normal;
        }

        h3 {
            margin-top: -80px;
        }

        h4 {
            padding-top: -20px;
        }
    </style>



</head>
<body>
<img id="logo" src="{!! public_path('img/C&C-Logo-Final2.png') !!}">
<h3 style="text-align: center">Columbarium and Crematorium Management System</h3>
<h4 align = "center" style = "margin-top: -30px; padding-top: -20px;">Sta. Mesa, Manila</h4>
<h4 align = "center">Tel No: 02-364 0158</h4>

<h2 align = "center">Add Deceased Receipt</h2>

<table class = "label">
    <tr align = "left">
        <td>Customer Name:&nbsp;<span>Leyooo</span></td>
        <td>Transaction Code:&nbsp;<span>T001</span></td>
    </tr>
    <tr align = "left">
        <td></td>
        <td>Date:&nbsp;<span>July 31, 2016</span></td>
    </tr>
</table>

<br>

<table class = "main" align = "center">
      <tr>
            <th>Added Deceased Details:</th>
            <th>Payment Details:</th>
          </tr>
    <tr align = "left">
        <td>Deceased Name:&nbsp; <span>Juan Dela Cruz</span></td>
        <td>Service Fee:&nbsp; <span>P 1,500.00</span></td>
    </tr>
    <tr align = "left">
        <td>Date of Death:&nbsp; <span>Sunday, July 3, 2016</span></td>
        <td>Amount Paid:&nbsp; <span>P 2,000.00</span><hr></td>
    </tr>
    <tr>
        <td align = "left">Storage Type:&nbsp; <span>Urn</span></td>
        <td align = "center">Change:&nbsp; <span>P 500.00</span></td>
    </tr>
    <tr align = "left">
        <td>Service:&nbsp; <span>Internment</span></td>
        <td></td>
    </tr>
    <tr align = "left">
        <td>Service Fee:&nbsp; <span>P 1,500.00</span></td>
        <td></td>
    </tr>
</table>


</body>
</html>