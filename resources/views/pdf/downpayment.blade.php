<head><title>Downpayment Receipt</title></head>
<style>
    .content {
        height: 55%;
        border: 1px solid black;
    }

    .headerH4 {
        font-size: 23px;;
    }

    .receiptHeaderH4{
        font-size: 18px;
        margin-top: 0px;
        padding-top: 0px;
    }

    .tableBorder {
        width: 70%;
        border-collapse: collapse;

    }


    .bold {
        font-weight: bold;
    }

    label {
        padding-left: 20px;
        font-weight: bold;
    }

    span {
        font-weight: normal;
    }

    .dateLabel {
        padding-left: 350px;
    }

    .modeOfPayment {
        padding-left: 365px;
    }

    .result {
        padding-left: 150px;
    }

    .initial {
        padding-left: 150px;
    }

    hr {
        width: 302px;
        border: 1px dashed;


    }

    .hr2 {
        width: 80px;
        border: 1px dashed black;

    }

    .addressH4 {
        font-size: 17px;
        padding-top: 0px;
        margin-top: 0px;
    }

</style>

<body>
    <div class = "content">
        {{--<img class = "responsive-img" id="image2" style="margin-top: -60px; margin-left: 35px; width: 290px; height: 290px;" src="{!! asset('/img/C&C-Logo-Final.png') !!}" alt="..." />--}}
        <center><h4 class = "headerH4">Columbarium and Crematorium Management System</h4></center>
        <center><h4 class = "addressH4">Sta. Mesa, Manila</h4></center>
        <center><h4 class = "receiptHeaderH4">Downpayment Receipt</h4></center>


        <label>Receipt Number:<span>&nbsp; {!! $downPayment->intDownpaymentId !!} </span></label>
        <label class = "dateLabel">Date:<span>&nbsp; {!! $downPayment->created_at !!}</span></label>

        <label>Received from:<span>&nbsp; {!! $downPayment->strLastName.', '.$downPayment->strFirstName.' '.$downPayment->strMiddleName !!}</span></label>
        <label class = "modeOfPayment">Mode of Payment:<span>&nbsp; {!! $downPayment->payment_type !!}</span></label>
        <label>Received by:<span>&nbsp; </span></label>

        <br><br>

        <table align = "left">
            <tr>
                <td class = "initial">Unit Number</td>
                <td class = "result">Unit No. {!! $downPayment->intUnitId !!}</td>
            </tr>
            <tr>
                <td class = "initial">Unit Type</td>
                <td class = "result">{!! $downPayment->unit_type !!}</td>
            </tr>
            <tr>
                <td class = "initial">Downpayment Amount</td>
                <td class = "result">P {!! number_format($downPayment->deciPrice*.3, 2) !!}</td>
            </tr>
            <tr>
                <td class = "initial">Amount Paid</td>
                <td class = "result">P {!! number_format($downPayment->deciAmount, 2) !!}</td>
            </tr>
            <tr>
                <td class = "initial">Balance<hr></td>
                <td class = "result">P {!! number_format($balance, 2) !!}<hr class = "hr2"></td>
            </tr>
            <tr>
                <td class = "initial">Change</td>
                <td class = "result">P {!! number_format($change, 2) !!}</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br><br>
        <center><label>BANGKAY MO, LIBING KO</label></center>
        <center><label>NO REFUND WITHOUT RECEIPT</label></center>
        <center><label>THANK YOU!</label></center>
    </div>
</body>