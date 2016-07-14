@extends('v2.baseLayout')
@section('title', 'Manage Unit')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">
    <script type="text/javascript" src="{!! asset('/js/manageUnit.js') !!}"></script>

    <button data-target="successAddDeceased" class="right waves-light btn blue modal-trigger" href="#successAddDeceased" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">add deceased</button>
    <button data-target="successTransferDeceased" class="right waves-light btn blue modal-trigger" href="#successTransferDeceased" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Transfer deceased</button>
    <button data-target="successPullOutDeceased" class="right waves-light btn blue modal-trigger" href="#successPullOutDeceased" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Pull Out deceased</button>
    <button data-target="successTransferOwnership" class="right waves-light btn blue modal-trigger" href="#successTransferOwnership" style = "color: black;margin-bottom: 10px; margin-right: 10px; margin-top:10px;">Transfer Ownership</button>

    <!-- Added Deceased -->
    <div id="successAddDeceased" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
        <div class="modal-header" style="padding: 0px">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
        </div>
        <div class="modal-content" style="overflow-y: auto; margin-top: -25px;">
            <div class="row">
                <div class="col s6" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Aaron CLyde Garil</u></label>
                        </div>
                    </div>
                </div>

                <div class="col s6">
                    <div class="row">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>07/09/16</u></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -20px;">
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Added Deceased Details: </h6></center><br>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Deceased Name:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>Protacio Sangkatakutan</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Date of Death:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>03/13/13</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Storage Type:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>Bone Box</u></label>
                            </div>
                        </div>
                       <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Service:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>Interment</u></label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col s4">
                                <label style="color: #000000; font-size: 15px;">Service Fee:</label>
                            </div>
                            <div class="col s8">
                                <label style="color: #000000; font-size: 15px;"><u>P 4,000.00</u></label>
                            </div>
                        </div>
                    </div>
                    <div class="col s6" style="border: 3px solid #7b7073;"><br>
                        <center><h6>Payment Details: </h6></center>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Service Fee:</label>
                            </div>
                            <div class="input-field col s5">
                                <label><u>P 4,000.00</u></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <label>Amount Paid:</label>
                            </div>
                            <div class="input-field col s5">
                               <label>P 4,000.00</label>
                            </div>
                        </div>
                        <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                            <div class="input-field col s7">
                                <label>Change:</label>
                            </div>
                            <div class="input-field col s5">
                                <label style="color: red"><u>P 0.00</u></label>
                            </div><br><br><br>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </div>
    <!-- Added Deceased -->

    <!-- Transfer Deceased -->
    <div id="successTransferDeceased" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
        <div class="modal-header" style="padding: 0px">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
        </div>
        <div class="modal-content" style="overflow: auto; clear: top;">
            <div class="row">
                <div class="col s6" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Aaron CLyde Garil</u></label>
                        </div>
                    </div>
                </div>

                <div class="col s6">
                    <div class="row">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>07/09/16</u></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s4" style="border: 3px solid #7b7073;">
                    <center><h6>Transfer Deceased Details: </h6></center>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Service:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Interment</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Service Fee</label>
                        </div>
                        <div class="input-field col s5">
                            <label>P 4,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 46px;">
                        <div class="input-field col s7">
                            <label>Storage Type:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Bone Box</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                <div class="col s4" style="border: 3px solid #7b7073;">
                    <center><h6>Total Amount To Pay: </h6></center>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Service Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 4,000.00</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Quantity:</label>
                        </div>
                        <div class="input-field col s5">
                            <label>3</label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 12,000.00</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                <div class="col s4" style="border: 3px solid #7b7073;">
                    <center><h6>Payment Details: </h6></center>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 12,000.00</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label>P 12,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label style="color: red"><u>P 0.00</u></label>
                        </div><br><br><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <center><label style="color: #000000; font-size: 15px;">Deceased Details:</label></center>
            </div>
            <div class="row">
                <div class="z-depth-2 card material-table">
                    <table id="datatable">
                        <thead>
                            <tr>
                                <th>Deceased Name</th>
                                <th>Unit Code</th>
                                <th>Date of Death</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>A4</td>
                                <td>03/09/13</td>
                            </tr>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>A4</td>
                                <td>03/09/13</td>
                            </tr>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>A4</td>
                                <td>03/09/13</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </div>
    <!-- Transfer Deceased -->

    <!-- Pull Out Deceased -->
    <div id="successPullOutDeceased" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
        <div class="modal-header" style="padding: 0px">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
        </div>
        <div class="modal-content" style="overflow: auto; clear: top;">
            <div class="row">
                <div class="col s6" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col s3">
                            <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Aaron CLyde Garil</u></label>
                        </div>
                    </div>
                </div>

                <div class="col s6">
                    <div class="row">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>07/09/16</u></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s4" style="border: 3px solid #7b7073;">
                    <center><h6>Pull Out Deceased Details: </h6></center>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Service:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Pull Out</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Service Fee</label>
                        </div>
                        <div class="input-field col s5">
                            <label>P 4,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 46px;">
                        <div class="input-field col s7">
                            <label>Storage Type:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>Bone Box</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                <div class="col s4" style="border: 3px solid #7b7073;">
                    <center><h6>Total Amount To Pay: </h6></center>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Service Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 4,000.00</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Quantity:</label>
                        </div>
                        <div class="input-field col s5">
                            <label>3</label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 12,000.00</u></label>
                        </div><br><br><br>
                    </div>
                </div>
                <div class="col s4" style="border: 3px solid #7b7073;">
                    <center><h6>Payment Details: </h6></center>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Total Amount to Pay:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 12,000.00</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label>P 12,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label style="color: red"><u>P 0.00</u></label>
                        </div><br><br><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <center><label style="color: #000000; font-size: 15px;">Deceased Details:</label></center>
            </div>
            <div class="row">
                <div class="z-depth-2 card material-table">
                    <table id="datatable">
                        <thead>
                            <tr>
                                <th>Deceased Name</th>
                                <th>Date of Death</th>
                                <th>Date to Return Deceased</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>03/09/13</td>
                                <td>09/08/16</td>
                            </tr>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>03/09/13</td>
                                <td>09/08/16</td>
                            </tr>
                            <tr>
                                <td>Protacio Sangkatakutan</td>
                                <td>03/09/13</td>
                                <td>09/08/16</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </div>
    <!-- Pull Out Deceased -->

    <!-- Transfer Ownership-->
    <div id="successTransferOwnership" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
        <div class="modal-header" style="padding: 0px">
            <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Transaction Successfully Made!</h4></center>
        </div>
        <div class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="col s6" style="margin-left: -15px;">
                    <div class="row">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">Unit Code:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>E1</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>Aaron CLyde Garil</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4">
                            <label style="color: #000000; font-size: 15px;">New Owner Name:</label>
                        </div>
                        <div class="col s8">
                            <label style="color: #000000; font-size: 15px;"><u>John Ezekiel Martinez</u></label>
                        </div>
                    </div>
                </div>

                <div class="col s6">
                    <div class="row">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Transaction Code:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>T312</u></label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -25px;">
                        <div class="col s4 offset-s6">
                            <label style="color: #000000; font-size: 15px;">Date:</label>
                        </div>
                        <div class="col s2">
                            <label style="color: #000000; font-size: 15px;"><u>07/09/16</u></label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col s8" style="margin-top: -40px;">
                    <div class="row">
                        <label style="color: #000000; font-size: 15px;">Unit Details:</label>
                    </div>
                    <div class="row">
                        <div class="z-depth-2 card material-table">
                            <table id="datatable1">
                                <thead>
                                    <tr>
                                        <th>Deceased Name</th>
                                        <th>Date of Death</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Protacio Sangkatakutan</td>
                                        <td>03/09/13</td>
                                    </tr>
                                    <tr>
                                        <td>Protacio Sangkatakutan</td>
                                        <td>03/09/13</td>
                                    </tr>
                                    <tr>
                                        <td>Protacio Sangkatakutan</td>
                                        <td>03/09/13</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col s4" style="border: 3px solid #7b7073;">
                    <center><h6>Payment Details: </h6></center>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Service Fee:</label>
                        </div>
                        <div class="input-field col s5">
                            <label><u>P 4,000.00</u></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s7">
                            <label>Amount Paid:</label>
                        </div>
                        <div class="input-field col s5">
                            <label>P 4,000.00</label>
                        </div>
                    </div>
                    <div class="row" style="border-top: 1px solid #7b7073; margin-top: 45px;">
                        <div class="input-field col s7">
                            <label>Change:</label>
                        </div>
                        <div class="input-field col s5">
                            <label style="color: red"><u>P 0.00</u></label>
                        </div><br><br><br>
                    </div>
                </div>
            </div>
            
            <br><br>
        </div>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Generate Receipt</button>
            <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
        </div>
    </div>
    <!-- Transfer Ownership -->



    <div class = col s12 >
        <div class = "row">
            <div class = "col s4">
                <h4 style = "margin-top: 20px; margin-left: 20px; font-family: myFirstFont">Manage Unit</h4>

                <div style = "overflow: auto;height: 370px;">
                    <div class = "col s12">
                        <div class = "aside aside ">
                            <ul class="collapsible" data-collapsible="accordion" watch>
                                <li>
                                    <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                        <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Columbary</label>
                                    </div>
                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                        <p style = "padding-top: 15px;">BA-1-St. Peter-1
                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                        </p>
                                    </div>

                                </li>
                                <li>
                                    <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                        <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Full Body</label>
                                    </div>
                                    <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                        <p style = "padding-top: 15px;">BA-1-St. Peter-2
                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();" style="margin-top: -10px;"><i class="material-icons" style="color: #000000;">visibility</i></button>
                                        </p>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Legends -->
                <div class = "row" style="margin-top: -80px;">
                    <div class = "col s12">
                        <div class = "aside aside z-depth-3" style = "height: 130px;">
                            <div class = "header" style = "height: 35px; background-color: #00897b">
                                <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                            </div>

                            <div class = "row" style = "margin-top: 10px;">
                                <center>
                                    <div class = "col s3">
                                        <button name = "action" class="btn-floating green";"></button>
                                        <label style="font-size: 15px; color: #000000;">Available</label>
                                    </div>
                                    <div class = "col s3">
                                        <button name = "action" class="btn-floating blue"></button>
                                        <label style="font-size: 15px; color: #000000;">Reserved</label>
                                    </div>
                                    <div class = "col s3">
                                        <button name = "action" class="btn-floating yellow""></button>
                                        <label style="font-size: 15px; color: #000000;">Partially Owned</label>
                                    </div>
                                    <div class = "col s3">
                                        <button name = "action" class="btn-floating red"></button>
                                        <label style="font-size: 15px; color: #000000;">Owned</label>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class = "col s8">
                <div class = "col s4 z-depth-2 " style = "margin-top: 20px; width: 100%;">
                    <div id="tableStart">
                        <div class = "col s12">
                            <div class = "aside aside z-depth-3">
                                <div class="center vaults-content">
                                    <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont">Select a Block</h2>
                                    <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                        <tbody>
                                        <tr>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                            <td><a class="waves-light"></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="responsive" id="tableUnit" style="display: none">
                        <div class = "col s12">
                            <div class = "aside aside z-depth-3">
                                <div class="center vaults-content">
                                    <h2 style = "padding-left: 40px; font-size: 30px; margin-top: 20px; font-family:  myFirstFont">BLOCK ONE</h2>
                                    <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                        <tbody>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">E15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">D15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">C15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">B15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">A15</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('modals.collection-downpayment.cheque')
        @include('modals.manage-unit.addTransferPullOutForm')
        @include('modals.manage-unit.newCustomer')
    </div>

@endsection