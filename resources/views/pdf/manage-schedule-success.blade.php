<head><title>Manage Schedule Receipt</title></head>
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

    <h2 align = "center">Schedule Purchase Details Receipt</h2>
    <h5 class = "date" align = "center">Dec 5, 1996</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>Kimberly Mirasol Bacarisas</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>T123</span></h4>
        </div>
        <div >
            <h4 class = "col-6">Service Name:&nbsp;<span>Cremation</span></h4>
        </div>
    </div>
    <h4 class = "col-6">Schedule Details:</h4>
    <table class = "table1">
        <tr>
            <td>Date</td>
            <td>09/12/12</td>
        </tr>
        <tr>
            <td>Start Time</td>
            <td>9:00 PM</td>
        </tr>
        <tr>
            <td>End Time</td>
            <td>11:00 PM</td>
        </tr>
    </table>
    <br><br>

    <h2 align = "center">Reschedule Purchase Details Receipt</h2>
    <h5 class = "date" align = "center">Dec 5, 1996</h5>

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt;">
            <h4 class = "col-6">Customer Name:&nbsp;<span>Kimberly Mirasol Bacarisas</span></h4>
        </div>
        <div style="margin-left:400pt;">
            <h4 class = "col-6">Transaction Id:&nbsp;<span>T123</span></h4>
        </div>
        <div >
            <h4 class = "col-6">Service Name:&nbsp;<span>Cremation</span></h4>
        </div>
    </div>
    <h4 class = "col-6">Old Schedule:</h4>
    <table class = "table1">
        <tr>
            <td>Date</td>
            <td>09/12/12</td>
        </tr>
        <tr>
            <td>Start Time</td>
            <td>9:00 PM</td>
        </tr>
        <tr>
            <td>End Time</td>
            <td>11:00 PM</td>
        </tr>
    </table>
    <br><br>
    <h4 class = "col-6">New Schedule:</h4>
    <table class = "table1">
        <tr>
            <td>Date</td>
            <td>09/12/12</td>
        </tr>
        <tr>
            <td>Start Time</td>
            <td>9:00 PM</td>
        </tr>
        <tr>
            <td>End Time</td>
            <td>11:00 PM</td>
        </tr>
    </table>
    <br><br>

    </body>