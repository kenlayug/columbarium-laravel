@extends('v2.baseLayout')
@section('title', 'Manage Unit')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">

    <div id="newCustomer" class="modal modal-fixed-footer" style="width:75% !important; max-height: 100% !important; overflow-y: hidden">
        <div class="modal-header1" style="background-color: #00897b;">
            <center><h4 style = "font-size: 20px; font-family: myFirstFont2; color: white; padding: 20px;">Add New Customer</h4></center>
        </div>
        <form class="modal-content" style="overflow-y: auto;">
            <div class="row">
                <div class="input-field col s4">
                    <input id="FirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="FirstName">First Name<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input id="MidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="MidName">Middle Name</label>
                </div>
                <div class="input-field col s4">
                    <input id="LastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                    <label for="LastName">Last Name<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8">
                    <input id="address" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="100" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,100}">
                    <label for="address">Address<span style = "color: red;">*</span></label>
                </div>
                <div class="input-field col s4">
                    <input id="cNum" type="text" required="" aria-required="true" class="validate" pattern="\d{4}[\-, ., ]\d{3}[\-, ., ]\d{4}">
                    <label for="cNum" data-error="Format: XXXX-XXX-XXXX">Contact Number<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s2">
                    <label for="dayB">Date of Birth:</label>
                </div>
                <div class="input-field col s4">
                    <input id="dayB" type="date" class="">
                </div>
                <div class="input-field col s2">
                    <label>Gender:</label>
                </div>
                <div class="input-field col s4">
                    <p>
                        <input name="group1" type="radio" id="gender1" checked="checked"/>
                        <label for="gender1">Male</label>
                        <input name="group1" type="radio" id="gender2" />
                        <label for="gender2">Female</label>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <label>Civil Status:</label>
                </div>
                <div class="input-field col s8">
                    <p>
                        <input name="group11" type="radio" id="test1" checked="checked"/>
                        <label for="test1">Single</label>
                        <input name="group11" type="radio" id="test2" />
                        <label for="test2">Married</label>
                        <input name="group11" type="radio" id="test3" />
                        <label for="test3">Widow/Widower</label>
                    </p>
                </div>
                <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
            </div>
            <br><br>
        </form>
        <div class="modal-footer">
            <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal modal-fixed" style="width: 75% !important ; overflow-y: auto;">
        <!-- Main Form for Manage Unit-->
        <div id="deceasedForm">
            <div class="modal-header">
                <center>
                    <label style="font-size: large; font-family: myFirstFont2">MANAGE UNIT: EI</label>
                </center>
            </div>
            <div class="modal-content" id="ownershipForm">
                <div class="row">
                    <div class="input-field col s2">
                        <label style="font-size: large"><b>Owner Name:</b></label>
                    </div>
                    <div class="input-field col s6">
                        <label style="font-size: large">  <u>Alba, Andrei Pascual</u></label>
                    </div>
                    <div class="input-field col s4">
                        <button id = "change" class="waves-light btn light-green btn tooltipped" data-delay="50" data-tooltip="Transfer Ownership"
                                onclick="javascript:switchDiv();" style="color: #000000"><i class="material-icons" style="color: #000000">mode_edit</i></button>
                        <button id = "change" class="waves-light btn light-green btn tooltipped" data-delay="50" data-tooltip="Pull Out Ownership"
                                onclick="javascript:switchDiv1();" style="color: #000000"><i class="material-icons" style="color: #000000">not_interested</i></button>

                    </div>
                </div>

                <div class = "col s12">
                    <center>
                        <div id='form-id'>
                            <input id="1" name='test' type='radio' value="add"/>
                            <label for="1">Add Deceased</label>

                            <input id="2" name='test' type='radio' value="transfer" />
                            <label for="2">Transfer Deceased</label>

                            <input id="3" name='test' type='radio' value="pullOut" />
                            <label for="3">Pull Out Deceased</label>
                        </div>
                    </center>
                    <br><br>
                    <div id='addDeceased' style='display:none'>
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="row">
                                    <div class="input-field col s4">
                                        <input id="dFirstName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                        <label for="dFirstName">Deceased First Name<span style = "color: red;">*</span></label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input id="dMidName" type="text" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                        <label for="dMidName">Deceased Middle Name</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input id="dLastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                        <label for="dLastName">Deceased Last Name<span style = "color: red;">*</span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">
                                        <label for="dateOfDeath">Date of Death:<span style="color: red">*</span></label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input id="dateOfDeath" type="date" required="" aria-required="true">
                                    </div>
                                    <div class="input-field col s3">
                                        <select>
                                            <option value="" disabled selected>Bone Box/Urns</option>
                                            <option value="service">Bone Box</option>
                                            <option value="package">Urn</option>
                                        </select>
                                        <label>Storage Type</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s5">
                                        <input type="checkbox" id="addRelationship" name="colorCheckbox" value="addRel"/>
                                        <label for="addRelationship">Add New Relationship Type</label>
                                    </div>

                                    <div class="addRelationship" style="display:none; background-color: rgba(10, 193, 232, 0.12); margin: 13px;">
                                        <div class="row">
                                            <div class="input-field col s4"></div>
                                            <div class="input-field col s4">
                                                <input id="daLastName" type="text" required="" aria-required="true" class="validate" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                                <label for="daLastName">Add New Relationship Type:<span style = "color: red;">*</span></label>
                                            </div>
                                            <div class="input-field col s4"></div>
                                        </div>
                                    </div>

                                    <div class="input-field col s5 oldRel">
                                        <select required = "required">
                                            <option value="" disabled selected>Relationship to the deceased:<span style = "color: red;">*</span></option>
                                            <option value="buyU">Wife/Husband</option>
                                            <option value="reserveU">Daughter/Son</option>
                                            <option value="atNeedU">Uncle/Auntie</option>
                                            <option value="atNeedU">Niece/Nephew</option>
                                        </select>
                                    </div>
                                </div>
                                <i class = "left" style = "color: red; margin-top: 10px;">*Required Fields</i>
                            </div>
                        </div>
                    </div>
                    <!-- Transfer Deceased Form-->
                    <form id='transferDeceased' style='display:none'>
                        <div class="row">
                            <div class="input-field col s3">
                                <h6 style="color: #000000;">Deceased Name/s:</h6>
                                <p>
                                    <input type="checkbox" id="dn11" checked="checked"/>
                                    <label for="dn11" style="font-family: Arial">Name 1</label>
                                </p>
                                <p>
                                    <input type="checkbox" id="dn21"/>
                                    <label for="dn21" style="font-family: Arial">Name 2</label>
                                </p>
                                <p>
                                    <input type="checkbox" id="dn31"/>
                                    <label for="dn31" style="font-family: Arial">Name 3</label>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s4">
                                <div class="row">
                                    <ul class="collapsible" data-collapsible="accordion" watch>
                                        <li>
                                            <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Columbary</label>
                                            </div>
                                            <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                <p style = "padding-top: 15px;">BA-1-St. Peter-1
                                                    <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible1();" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                </p>
                                            </div>
                                            <div class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                <p style = "padding-top: 15px;">BA-1-St. Joseph-1
                                                    <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible1();" style="margin-top: -10px;"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s8" style="margin-top: -70px;">
                                <div id="transferDeceasedStart">
                                    <div class="center vaults-content">
                                        <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">Select a Block</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                            <tr>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                                <td><a class="waves-light modal-trigger"></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="transferDeceasedShow" style="display: none">
                                    <div class="center vaults-content">
                                        <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">Block One</h2>
                                        <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                            <tbody>
                                            <tr>
                                                <td><a class="waves-effect waves-light">E1</a></td>
                                                <td><a class="waves-effect waves-light">E2</a></td>
                                                <td><a class="waves-effect waves-light">E3</a></td>
                                                <td><a class="waves-effect waves-light">E4</a></td>
                                                <td><a class="waves-effect waves-light">E5</a></td>
                                                <td><a class="waves-effect waves-light">E6</a></td>
                                                <td><a class="waves-effect waves-light">E7</a></td>
                                                <td><a class="waves-effect waves-light">E8</a></td>
                                                <td><a class="waves-effect waves-light">E9</a></td>
                                                <td><a class="waves-effect waves-light">E10</a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-effect waves-light">D1</a></td>
                                                <td><a class="waves-effect waves-light">D2</a></td>
                                                <td><a class="waves-effect waves-light">D3</a></td>
                                                <td><a class="waves-effect waves-light">D4</a></td>
                                                <td><a class="waves-effect waves-light">D5</a></td>
                                                <td><a class="waves-effect waves-light">D6</a></td>
                                                <td><a class="waves-effect waves-light">D7</a></td>
                                                <td><a class="waves-effect waves-light">D8</a></td>
                                                <td><a class="waves-effect waves-light">D9</a></td>
                                                <td><a class="waves-effect waves-light">D10</a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-effect waves-light">C1</a></td>
                                                <td><a class="waves-effect waves-light">C2</a></td>
                                                <td><a class="waves-effect waves-light">C3</a></td>
                                                <td><a class="waves-effect waves-light">C4</a></td>
                                                <td><a class="waves-effect waves-light">C5</a></td>
                                                <td><a class="waves-effect waves-light">C6</a></td>
                                                <td><a class="waves-effect waves-light">C7</a></td>
                                                <td><a class="waves-effect waves-light">C8</a></td>
                                                <td><a class="waves-effect waves-light">C9</a></td>
                                                <td><a class="waves-effect waves-light">C10</a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-effect waves-light">B1</a></td>
                                                <td><a class="waves-effect waves-light">B2</a></td>
                                                <td><a class="waves-effect waves-light">B3</a></td>
                                                <td><a class="waves-effect waves-light">B4</a></td>
                                                <td><a class="waves-effect waves-light">B5</a></td>
                                                <td><a class="waves-effect waves-light">B6</a></td>
                                                <td><a class="waves-effect waves-light">B7</a></td>
                                                <td><a class="waves-effect waves-light">B8</a></td>
                                                <td><a class="waves-effect waves-light">B9</a></td>
                                                <td><a class="waves-effect waves-light">B10</a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="waves-effect waves-light">A1</a></td>
                                                <td><a class="waves-effect waves-light">A2</a></td>
                                                <td><a class="waves-effect waves-light">A3</a></td>
                                                <td><a class="waves-effect waves-light">A4</a></td>
                                                <td><a class="waves-effect waves-light">A5</a></td>
                                                <td><a class="waves-effect waves-light">A6</a></td>
                                                <td><a class="waves-effect waves-light">A7</a></td>
                                                <td><a class="waves-effect waves-light">A8</a></td>
                                                <td><a class="waves-effect waves-light">A9</a></td>
                                                <td><a class="waves-effect waves-light">A10</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="left input-field col s4">
                                <left>
                                    <input type="checkbox" id="safeBox" name="sf"/>
                                    <label for="safeBox">Transfer To Safe Box</label>
                                </left>
                            </div>
                        </div>
                        <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Fields</i>
                    </form>

                    <!-- Pull Out Deceased Form-->
                    <div id='pullOutDeceased' style='display:none'>
                        <div class="row">
                            <div class="input-field col s3">
                                <h6 style="color: #000000;">Deceased Name/s:</h6>
                                <p>
                                    <input type="checkbox" id="dn111" checked="checked"/>
                                    <label for="dn111" style="font-family: Arial">Name 1</label>
                                </p>
                                <p>
                                    <input type="checkbox" id="dn211"/>
                                    <label for="dn211" style="font-family: Arial">Name 2</label>
                                </p>
                                <p>
                                    <input type="checkbox" id="dn311"/>
                                    <label for="dn311" style="font-family: Arial">Name 3</label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Radio Buttons JS-->
                    <script>
                        $("input[name='test']").click(function () {
                            $('#transferDeceased').css('display', ($(this).val() === 'transfer') ? 'block':'none');
                            $('#pullOutDeceased').css('display', ($(this).val() === 'pullOut') ? 'block':'none');
                            $('#addDeceased').css('display', ($(this).val() === 'add') ? 'block':'none');
                        });
                    </script>
                </div>
            </div>
            <div class="modal-footer">
                <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px">Confirm</button>
                <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
            </div>
        </div>

        <!-- Transfer Ownership Form -->
        <div id="transferOwnership" style="display: none;">
            <div class="modal-header">
                <label style="font-size: large">Transfer Ownership</label>
            </div>
            <div class="modal-transfer"method="get" autocomplete="off">
                <div class="modal-content row">
                    <div class="input-field col s8">
                        <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                        <label for="cname">New Owner Name<span style = "color: red;">*</span></label>
                    </div>
                    <div class="input-field col s4">
                        <a data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer"
                           href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>

                    <a data-target="updateCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details"
                       href="#updateCustomer" style="color: #000000;width: 100px;"><i class="material-icons">replay</i><i class="material-icons">perm_identity</i></a>

                    </div>
                </div>
                <i class ="left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Field</i>
                <!-- Autocomplete -->
                <datalist id="nameList">
                    <option value="Monkey D. Luffy">
                    <option value="Roronoa Zoro">
                    <option value="Vinsmoke Sanji">
                    <option value="Tony Tony Chopper">
                    <option value="Nico Robin">
                </datalist>
                <div class="modal-footer">
                    <div class="input-field col s12">
                        <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px;">Confirm</button>
                        <button id = "change" class="waves-light btn light-green" onclick="javascript:switchDiv();" style="color: #000000;">Cancel</button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pull Out Ownership Form -->
        <div id="pullOutOwnership" style="display: none;">
            <div class="modal-header">
                <label style="font-size: large">Pull Out Ownership</label>
            </div>
            <div class="modal-transfer">
                <div class="modal-content">
                    <div class="input-field col s6">
                        <label>Are You Sure You Want to Pull Out Ownership?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name = "action" class="waves-light btn light-green" style = "margin-left: 10px; margin-right: 10px; color: #000000;">Confirm</button>
                    <button id = "change" class="waves-light btn light-green" onclick="javascript:switchDiv1();" style="color: #000000;">Cancel</button>
                </div>
            </div>
        </div>

    </div>


    <div class = col s12 >
        <div class = "row">
            <div class = "col s4">
                <h4 style = "margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">Manage Unit</h4>

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
                        <div class = "aside aside z-depth-3" style = "height: 120px;">
                            <div class = "header" style = "height: 35px; background-color: #00897b">
                                <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                            </div>

                            <div class = "row" style = "margin-top: 10px;">
                                <div class = "col s4">
                                    <button id = "configure" name = "action" class="btn-floating green" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000; padding-left: 20px;">Available</label>
                                </div>
                                <div class = "col s4">
                                    <button id = "notConfigure" name = "action" class="btn-floating red" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000; padding-left: 25px;">Owned</label>
                                </div>
                                <div class = "col s4">
                                    <button id = "configuredFloorPrice" name = "action" class="btn-floating blue" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000; padding-left: 20px;">Reserved</label>
                                </div>
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
                                    <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">Select a Block</h2>
                                    <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                        <tbody>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
                                            <td><a data-target="modal1" class="waves-light modal-trigger"></a></td>
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
                                    <h2 style = "padding-left: 40px; font-size: 30px; margin-top: 20px; font-family:  myFirstFont2">BLOCK ONE</h2>
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
        </form>
        <!-- Pull Out Ownership JS -->
        <script>
            function switchDiv1() {
                if (document.getElementById('pullOutOwnership') !== undefined) {

                    if (document.getElementById('pullOutOwnership').style.display == 'block') {
                        document.getElementById('pullOutOwnership').style.display = 'none';
                        document.getElementById('deceasedForm').style.display = 'block';
                    } else {
                        document.getElementById('pullOutOwnership').style.display = 'block';
                        document.getElementById('deceasedForm').style.display = 'none';
                    }
                }
            }
        </script>
        <!-- Transfer Ownership JS -->
        <script>
            function switchDiv() {
                if (document.getElementById('transferOwnership') !== undefined) {

                    if (document.getElementById('transferOwnership').style.display == 'block') {
                        document.getElementById('transferOwnership').style.display = 'none';
                        document.getElementById('deceasedForm').style.display = 'block';
                    } else {
                        document.getElementById('transferOwnership').style.display = 'block';
                        document.getElementById('deceasedForm').style.display = 'none';
                    }
                }
            }
        </script>
        <!-- Show Hide Unit JS -->
        <script>
            function switchVisible() {
                if (document.getElementById('tableUnit') !== undefined) {

                    if (document.getElementById('tableUnit').style.display == 'block') {
                        document.getElementById('tableUnit').style.display = 'none';
                        document.getElementById('tableStart').style.display = 'block';
                    } else {
                        document.getElementById('tableUnit').style.display = 'block';
                        document.getElementById('tableStart').style.display = 'none';
                    }
                }
            }
            function switchVisible1() {
                if (document.getElementById('transferDeceasedShow') !== undefined) {

                    if (document.getElementById('transferDeceasedShow').style.display == 'block') {
                        document.getElementById('transferDeceasedShow').style.display = 'none';
                        document.getElementById('transferDeceasedStart').style.display = 'block';
                    } else {
                        document.getElementById('transferDeceasedShow').style.display = 'block';
                        document.getElementById('transferDeceasedStart').style.display = 'none';
                    }
                }
            }
        </script>
        <!-- Modal and Select JS -->
        <script>
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
            });


            $(document).ready(function() {
                $('select').material_select();
            });
        </script>
        <script>
            $( document ).ready(function() {
                $('.datepicker').pickadate({
                    format: 'mm/dd/yyyy',
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 15 // Creates a dropdown of 15 years to control year
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('input[type="checkbox"]').click(function(){
                    if($(this).attr("value")=="addRel"){
                        $(".addRelationship").toggle();
                        $(".oldRel").toggle();
                    }
                });
            });
        </script>
    </div>

@endsection