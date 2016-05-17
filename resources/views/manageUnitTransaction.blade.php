@extends('maintenanceLayout')
@section('body')

<link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults-trans.css') !!}">
<div class = col s12 >
    <div class = "row">
        <div class = "col s4">
            <h2 style = "padding-left: 40px; font-size: 30px; margin-top: 20px; font-family:  myFirstFont2">Manage Unit</h2>

            <div style = "overflow: auto;height: 370px;">
                <div class = "col s12">
                    <div class = "aside aside ">

                        <ul class="collapsible" data-collapsible="collapsible">
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                    <label style = "font-family: myFirstFont2; font-size: 20px; color: white;">Building One</label>
                                </div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible popout" data-collapsible="expandable">
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">work</i>Ground Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Administrator Office</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>First Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block One
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>Second Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                    <label style = "font-family: myFirstFont2; font-size: 20px; color: white;">Building Two</label>
                                </div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible popout" data-collapsible="expandable">
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">work</i>Ground Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Administrator Office</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>First Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block One
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>Second Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                    <label style = "font-family: myFirstFont2; font-size: 20px; color: white;">Building Three</label>
                                </div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible popout" data-collapsible="expandable">
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">work</i>Ground Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Administrator Office</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>First Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block One
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>Second Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                    <label style = "font-family: myFirstFont2; font-size: 20px; color: white;">Building Four</label>
                                </div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible popout" data-collapsible="expandable">
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">work</i>Ground Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Administrator Office</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>First Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block One
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>Second Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                    <label style = "font-family: myFirstFont2; font-size: 20px; color: white;">Building Five</label>
                                </div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible popout" data-collapsible="expandable">
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">work</i>Ground Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Administrator Office</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>First Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block One
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>Second Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                    <label style = "font-family: myFirstFont2; font-size: 20px; color: white;">Building Six</label>
                                </div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s12 m12">
                                            <ul class="collapsible popout" data-collapsible="expandable">
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">work</i>Ground Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Administrator Office</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>First Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block One
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header" style = "background-color: #ffa726">
                                                        <i class="material-icons">view_module</i>Second Floor</div>
                                                    <div class="collapsible-body">
                                                        <p>Block Two
                                                            <button id = "Button1" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" type="button" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
                                <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                    <tbody>
                                    <tr>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J1</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J2</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J3</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J4</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J5</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J6</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J7</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J8</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J9</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J10</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J11</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J12</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J13</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J14</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">J15</a></td>
                                    </tr>
                                    <tr>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I1</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I2</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I3</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I4</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I5</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I6</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I7</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I8</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I9</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I10</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I11</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I12</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I13</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I14</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">I15</a></td>
                                    </tr>
                                    <tr>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H1</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H2</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H3</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H4</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H5</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H6</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H7</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H8</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H9</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H10</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H11</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H12</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H13</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H14</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">H15</a></td>
                                    </tr>
                                    <tr>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G1</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G2</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G3</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G4</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G5</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G6</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G7</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G8</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G9</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G10</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G11</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G12</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G13</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G14</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">G15</a></td>
                                    </tr>
                                    <tr>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F1</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F2</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F3</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F4</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F5</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F6</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F7</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F8</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F9</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F10</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F11</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F12</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F13</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F14</a></td>
                                        <td><a data-target="modal1" class="waves-effect waves-light modal-trigger">F15</a></td>
                                    </tr>
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
                                <!-- Modal Structure -->
                                <div id="modal1" class="modal modal-fixed">
                                    <!-- Main Form for Manage Unit-->
                                    <div id="deceasedForm">
                                        <div class="modal-header">
                                            <label style="font-size: large">MANAGE UNIT</label>
                                        </div>
                                        <div class="cmxform" id="ownershipForm" action="Manage-Unit.html" method="get" autocomplete="off">
                                            <div class="row">
                                                <div class="input-field col s2">
                                                    <label style="font-size: large"><b>Owner Name:</b></label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <label style="font-size: large">  <u>LastName, FirstName Middle Name</u></label>
                                                </div>
                                                <div class="input-field col s4">
                                                    <button id = "change" class="waves-light btn light-green" onclick="javascript:switchDiv();" style="color: #000000"><i class="material-icons" style="color: #000000">mode_edit</i></button>
                                                    <button id = "change" class="waves-light btn light-green" onclick="javascript:switchDiv1();" style="color: #000000"><i class="material-icons" style="color: #000000">not_interested</i></button>

                                                </div>
                                            </div>

                                            <div class = "aside aside z-depth-3 col s12">
                                                <form id='form-id'>
                                                    <input id="1" name='test' type='radio' value="add" />
                                                    <label for="1">Add Deceased</label>

                                                    <input id="2" name='test' type='radio' value="transfer" />
                                                    <label for="2">Transfer Deceased</label>

                                                    <input id="3" name='test' type='radio' value="pullOut" />
                                                    <label for="3">Pull Out Deceased</label>
                                                </form>

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
                                                                    <input id="dateOfDeath" type="date" required="" aria-required="true" class="datepicker">
                                                                    <label for="dateOfDeath">Date of Death:<span style="color: red">*</span></label>
                                                                </div>

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

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s6" style="visibility: hidden; margin-bottom: 0;">

                                                        </div>
                                                        <div class="input-field col s6" style="margin-bottom: 0;">
                                                            <button name = "action" class="waves-light btn light-green" style = "margin-left: 10px; margin-right: 10px; color: #000000;">Confirm</button>
                                                            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
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
                                                        <div class="input-field col s3">
                                                            <label>Building No:</label>
                                                        </div>
                                                        <div class = "col s9" style = "padding-left: 20px;">
                                                            <select required>
                                                                <option value="" disabled selected> Select Building Name:<span style = "color: red;">*</span></option>
                                                                <option value="1">Building A</option>
                                                                <option value="2">Building B</option>
                                                                <option value="3">Building C</option>
                                                            </select>

                                                        </div>
                                                        <div class="input-field col s3">
                                                            <label>Floor No:</label>
                                                        </div>
                                                        <div class = "col s9" style = "padding-left: 20px;">
                                                            <select required>
                                                                <option value="" disabled selected> Select Floor No:<span style = "color: red;">*</span></option>
                                                                <option value="1">Floor 1</option>
                                                                <option value="2">Floor 2</option>
                                                                <option value="3">Floor 3</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col s3">
                                                            <label>Block Name:</label>
                                                        </div>
                                                        <div class = "col s9" style = "padding-left: 20px;">
                                                            <select required>
                                                                <option value="" disabled selected> Select Block Name:<span style = "color: red;">*</span></option>
                                                                <option value="1">Block A</option>
                                                                <option value="2">Block B</option>
                                                                <option value="3">Block C</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col s3">
                                                            <label>Unit Code:</label>
                                                        </div>
                                                        <div class="input-field col s3">
                                                            <input id="ucode" type="text" required="" aria-required="true" class="validate" list="unitCode">
                                                            <label for="ucode">Unit Code<span style = "color: red;">*</span></label>
                                                        </div>
                                                        <datalist id="unitCode">
                                                            <option value="E401">
                                                            <option value="A512">
                                                            <option value="A101">
                                                            <option value="H304">
                                                            <option value="C212">
                                                        </datalist>
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

                                                    <div class="row">
                                                        <div class="input-field col s6" style="margin-bottom: 20px; visibility: hidden">

                                                        </div>
                                                        <div class="right input-field col s6" style="margin-bottom: 20px;">
                                                            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px">Confirm</button>
                                                            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
                                                        </div>
                                                    </div>
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
                                                    <div class="row">
                                                        <div class="input-field col s6" style="visibility: hidden; margin-bottom: 0;">

                                                        </div>
                                                        <div class="input-field col s6" style="margin-bottom: 0;">
                                                            <button name = "action" class="waves-light btn light-green" style = "margin-left: 10px; margin-right: 10px; color: #000000;">Confirm</button>
                                                            <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</button>
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
                                    </div>

                                    <!-- Transfer Ownership Form -->
                                    <div id="transferOwnership" style="display: none;">
                                        <div class="modal-header">
                                            <label style="font-size: large">Transfer Ownership</label>
                                        </div>
                                        <form class="modal-transfer"method="get" autocomplete="off">
                                            <div class="row">
                                                <div class="input-field      col s7">
                                                    <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                                                    <label for="cname">New Owner Name<span style = "color: red;">*</span></label>
                                                </div>
                                                <div class="right row">
                                                    <div class="input-field col s12">
                                                        <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: -480px;">Confirm</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <i class = "left" style = "margin-top: 0px; margin-bottom: 50px; padding-left: 15px; color: red;">*Required Field</i>

                                            <!-- Autocomplete -->
                                            <datalist id="nameList">
                                                <option value="Monkey D. Luffy">
                                                <option value="Roronoa Zoro">
                                                <option value="Vinsmoke Sanji">
                                                <option value="Tony Tony Chopper">
                                                <option value="Nico Robin">
                                            </datalist>
                                        </form>
                                        <button id = "change" class="waves-light btn light-green" onclick="javascript:switchDiv();" style="color: #000000; margin-right: -400px; margin-top: -150px">Cancel</button>
                                    </div>

                                    <!-- Pull Out Ownership Form -->
                                    <div id="pullOutOwnership" style="display: none;">
                                        <div class="modal-header">
                                            <label style="font-size: large">Pull Out Ownership</label>
                                        </div>
                                        <form class="modal-transfer"method="get" autocomplete="off">
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <label>Are You Sure You Want to Pull Out Ownership?</label>
                                                </div>
                                                <div class="input-field col s5">
                                                    <button name = "action" class="waves-light btn light-green" style = "margin-left: 10px; margin-right: 10px; color: #000000;">Confirm</button>
                                                </div>
                                            </div>
                                        </form>
                                        <button id = "change" class="waves-light btn light-green" onclick="javascript:switchDiv1();" style="color: #000000; margin-right: -600px; margin-top: -100px">Cancel</button>
                                    </div>

                                </div>
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