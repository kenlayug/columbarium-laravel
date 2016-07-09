@extends('maintenanceLayout')
@section('body')

<link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults-trans.css') !!}">
<script type="text/javascript" src="{!! asset('/js/manageUnit.js') !!}"></script>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection