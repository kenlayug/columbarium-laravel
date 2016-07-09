<div id="modal1" class="modal modal-fixed-footer" style="width: 75% !important ; overflow-y: hidden;">
    <div id="deceasedForm">

        <div class="modal-header">
            <center>
                <label style="font-size: large; font-family: myFirstFont2">MANAGE UNIT: EI</label>
            </center>
        </div>

        <div class="modal-content" style="overflow: auto;">
            <div class="row" style="margin-top: -20px;">
                <div class="input-field col s2">
                    <label style="font-size: large"><b>Owner Name:</b></label>
                </div>
                <div class="input-field col s8">
                    <label style="font-size: large">  <u>Alba, Andrei Pascual</u></label>
                </div>
            </div>
            <div class="col s12" style="margin-top: 50px;">
                <ul class="tabs">
                    <li class="tab col s3"><a href="#addDeceased">| Add Deceased</a></li>
                    <li class="tab col s3"><a href="#transferDeceased">| Transfer Deceased</a></li>
                    <li class="tab col s3"><a href="#pullOutDeceased">| Pull Out Deceased</a></li>
                    <li class="tab col s3"><a href="#transferOwnership">| Transfer Ownership</a></li>
                    <li class="tab col s3"><a href="#pullOutOwnership">| Pull Out Ownership |</a></li>
                </ul>
            </div>
            <div style="background: #fafafa">
                <!-- Add Deceased Form -->
                <div id="addDeceased" class="col s12">
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

                <!-- Transfer Deceased Form -->
                <div id="transferDeceased" class="col s12">
                    <!-- Deceased List -->
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
                        <!-- Collapsible -->
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

                        <!-- Block -->
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

                            <!-- Selected Block -->
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
                </div>

                <!-- Pull Out Deceased -->
                <div id="pullOutDeceased" class="col s12">
                    <center>
                        <div style="width: 750px; margin-top: 30px;">
                            <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
                                <table id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Deceased Name</th>
                                            <th>Date of Death</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="safeBoxs" name="sf"/>
                                                <label for="safeBoxs">Protacio Sangkatakutan</label>
                                            </td>
                                            <td>12/02/09</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="safeBoxq" name="sfq"/>
                                                <label for="safeBoxq">Protacio Sangkatakutan</label>
                                            </td>
                                            <td>12/02/09</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="safeBoxw" name="sfw"/>
                                                <label for="safeBoxw">Protacio Sangkatakutan</label>
                                            </td>
                                            <td>12/02/09</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </center>
                </div>

                <!-- Transfer Ownership Form -->
                <div id="transferOwnership" class="col s12">
                    <div class="row" style="margin-top: 50px;">
                        <div class="input-field col s8">
                            <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                            <label for="cname">New Owner Name<span style = "color: red;">*</span></label>
                        </div>
                        <div class="input-field col s4">
                            <a data-target="newCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Add New Customer"
                               href="#newCustomer" style="color: #000000;width: 100px;"><i class="material-icons">add</i><i class="material-icons">perm_identity</i></a>

                            <a data-target="updateCustomer" class="waves-light btn light-green modal-trigger btn tooltipped" data-delay="50" data-tooltip="Update Customer Details"
                               href="#updateCustomer" style="color: #000000;width: 100px;"><i class="material-icons">mode_edit</i><i class="material-icons">perm_identity</i></a>
                        </div>
                    </div>
                </div>

                <!-- Pull Out Ownership Form -->
                <div id="pullOutOwnership" class="col s12">
                    <center>
                        <div class="row" style="margin-top: 50px;">
                            <label style="font-size: 20px;">Are You Sure You Want to Pull Out Ownership?</label>
                        </div>
                    </center>
                </div><br><br>
            </div>
        </div>

        <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Confirm</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>