@extends('maintenanceLayout')
@section('body')

<link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults-trans.css') !!}">
<div class = "col s12" >
    <div class = "row">
        <div class = "responsive">

            <div class = "col s4">
                <h2 style = "font-size: 30px; margin-top: 20px; margin-left: 20px; font-family: myFirstFont2">Manage Service</h2>

                <div style = "overflow: auto;height: 370px;">
                    <div class = "col s12">
                        <div class = "aside aside ">

                            <ul class="collapsible" data-collapsible="collapsible">
                                <li>
                                    <div class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                        <label style = "font-family: myFirstFont2; font-size: 20px; color: white;">Building One</label>
                                        <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">35</button>
                                        <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">103</button>
                                        <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
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
                                                            <i class="material-icons">view_module</i>1st Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">8</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block One
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">5</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">3</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="collapsible-header" style = "background-color: #ffa726">
                                                            <i class="material-icons">view_module</i>2nd Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">4</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">4</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
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
                                        <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">34</button>
                                        <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                        <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">64</button>
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
                                                            <i class="material-icons">view_module</i>1st Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block One
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="collapsible-header" style = "background-color: #ffa726">
                                                            <i class="material-icons">view_module</i>2nd Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
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
                                        <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                        <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">29</button>
                                        <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">43</button>
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
                                                            <i class="material-icons">view_module</i>1st Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block One
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="collapsible-header" style = "background-color: #ffa726">
                                                            <i class="material-icons">view_module</i>2nd Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
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
                                        <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                        <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                        <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
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
                                                            <i class="material-icons">view_module</i>1st Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block One
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="collapsible-header" style = "background-color: #ffa726">
                                                            <i class="material-icons">view_module</i>2nd Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
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
                                        <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">34</button>
                                        <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                        <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">64</button>
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
                                                            <i class="material-icons">view_module</i>1st Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block One
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="collapsible-header" style = "background-color: #ffa726">
                                                            <i class="material-icons">view_module</i>2nd Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
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
                                        <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">54</button>
                                        <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                        <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">24</button>
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
                                                            <i class="material-icons">view_module</i>1st Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block One
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="collapsible-header" style = "background-color: #ffa726">
                                                            <i class="material-icons">view_module</i>2nd Floor
                                                            <button id = "configuredFloorPrice" name = "action" class="right small btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">24</button>
                                                            <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">42</button>
                                                            <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">12</button>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <p>Block Two
                                                                <button id = "configuredFloorPrice" name = "action" class="right btn tooltipped btn-floating blue" data-position = "bottom" data-delay = "25" data-tooltip = "Reserved Units" style = "margin-left: 15px; margin-top: 5px;">32</button>
                                                                <button id = "notConfigure" name = "action" class="right btn tooltipped btn-floating red" data-position = "bottom" data-delay = "25" data-tooltip = "Owned Units" style = "margin-left: 15px; margin-top: 5px;">12</button>
                                                                <button id = "configure" name = "action" class="right btn tooltipped small btn-floating green" data-position = "bottom" data-delay = "25" data-tooltip = "Available Unit" style = "margin-left: 15px;margin-top: 5px;">54</button>
                                                                <button id = "Button1" name = "action" class="right btn tooltipped btn-floating light-green" data-position = "bottom" data-delay = "25" data-tooltip = "View" style = "margin-left: 15px; margin-top: 5px;" onclick="javascript:switchVisible();"><i class="material-icons" style="color: #000000">visibility</i></button>
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
                <br>
                <div class = "row">
                    <div class = "col s12">
                        <div class = "aside aside z-depth-3" style = "height: 120px;">
                            <div class = "header" style = "height: 35px; background-color: #00897b">
                                <label style = "padding-left: 10px;font-size: 23px; color: white; font-family: myFirstFont2;">Legend:</label>
                            </div>

                            <div class = "row" style = "margin-top: 10px;">
                                <div class = "col s4">
                                    <button id = "configure" name = "action" class="btn-floating green" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000;">Available Units</label>
                                </div>
                                <div class = "col s4">
                                    <button id = "notConfigure" name = "action" class="btn-floating red" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000;">Owned Units</label>
                                </div>
                                <div class = "col s4">
                                    <button id = "configuredFloorPrice" name = "action" class="btn-floating blue" style = "margin-left: 30px;"></button>
                                    <label style="font-size: 15px; color: #000000;">Reserved Units</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "col s8">
                <div class = "col s4 z-depth-2 " style = "margin-top: 5px; width: 100%;">
                    <div id="tableStart">
                        <div class = "col s12">
                            <div class = "aside aside z-depth-3">
                                <div class="center vaults-content">
                                    <table style="font-size: small; margin-bottom: 25px;margin-top: 25px">
                                        <tbody>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1"></a></td>
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
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">J15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">I15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">H15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">G15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">F15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">E15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">D15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">C15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">B15</a></td>
                                        </tr>
                                        <tr>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A1</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A2</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A3</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A4</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A5</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A6</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A7</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A8</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A9</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A10</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A11</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A12</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A13</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A14</a></td>
                                            <td><a data-target="modal1" class="waves-effect waves-light modal-trigger" href="#modal1">A15</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Form for Manage Service -->
                    <div id="modal1" class="modal modal-fixed" style="">
                        <center>
                            <div class="modal-header">
                                <label style="font-size: large">MANAGE SERVICE</label>
                            </div>
                            <form id='form-id'>
                                <br>
                                <input id="1" name='test' type='radio' value="view" checked="checked"/>
                                <label for="1">View</label>

                                <input id="2" name='test' type='radio' value="buy" />
                                <label for="2">Avail Unit</label>
                            </form>

                            <div id='viewDetails' style="background-color: #f3f3f3;">
                                <div style="margin-top: 20px;">
                                    <br>
                                    <label style="font-size: large; text-align: center; color: #000000;">Unit Details</label>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">
                                        <label><b>Status:</b></label>
                                    </div>
                                    <div class="input-field col s6">
                                        <label><u>Reserved</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">
                                        <label><b>Owner Name:</b></label>
                                    </div>
                                    <div class="input-field col s6">
                                        <label><u>LastName, FirstName Middle Name</u></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">
                                        <label><b>Details:</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s2">

                                    </div>
                                    <div class="input-field col s5">
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Price:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>P55,000</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Years:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>6 Years</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Term:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Semi Annual</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Payment:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>P5,000</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Balance:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>P29,000</u></label>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="input-field col s5">
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Building:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Building B</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Floor:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Floor 3</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Block:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Block C</u></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <label>Unit:</label>
                                            </div>
                                            <div class="input-field col s5">
                                                <label><u>Unit B3C5</u></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right row" style="margin-top: 50px;">
                                        <div class="input-field col s12">
                                            <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 10px">Cancel Transaction</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Buy, Reserve, At Need Form -->
                            <div id='buyUnit' style="background-color: #f3f3f3; display:none">
                                <div style="margin-top: 20px;">
                                    <br>
                                    <label style="font-size: large; text-align: center; color: #000000;">Purchase  Form</label>
                                </div>
                                <form class="modal-transfer"method="get" autocomplete="off">
                                    <div class="row">

                                        <div id="Customer">
                                            <div class="row">
                                                <div class="input-field      col s7">
                                                    <input name="cname" id="cname" type="text" required="" aria-required="true" class="validate" list="nameList">
                                                    <label for="cname">Customer Name<span style = "color: red;">*</span></label>
                                                </div>
                                                <div class="input-field col s4">
                                                    <select required = "required">
                                                        <option value="" disabled selected>Select Avail Type<span style = "color: red;">*</span></option>
                                                        <option value="buyU">Buy Unit</option>
                                                        <option value="reserveU">Reserve Unit</option>
                                                        <option value="atNeedU">At Need</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <left>
                                                    <div class="input-field col s2">
                                                        <label><b>Details:</b></label>
                                                    </div>
                                                </left>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s2">

                                                </div>
                                                <div class="input-field col s5">
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Price:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>P55,000</u></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Years:</label>
                                                        </div>
                                                        <div class="input-field col s4">
                                                            <input id="quantity" type="number" required="" aria-required="true" class="validate" min="1" max="30">
                                                            <label for="quantity" data-error="From 1-30 Years Only">To Pay<span style = "color: red;">*</span></label>
                                                        </div>
                                                    </div><br>
                                                    <div class="row" style="margin-top: -70px; margin-bottom: 0;">
                                                        <div class="input-field col s3">
                                                            <label>Payment:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>P5,000</u></label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Balance:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>P29,000</u></label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="input-field col s5">
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Building:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>Building B</u></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Floor:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>Floor 3</u></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Block:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>Block C</u></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s3">
                                                            <label>Unit:</label>
                                                        </div>
                                                        <div class="input-field col s5">
                                                            <label><u>Unit B3C5</u></label>
                                                        </div>
                                                    </div><br><br>
                                                </div>
                                            </div>
                                            <div class="right row">
                                                <div class="input-field col s12">
                                                    <button name = "action" class="waves-light btn light-green" style = "color: #000000; margin-left: 10px; margin-right: 210px; margin-top: -5px;">Confirm</button>
                                                </div>
                                            </div>
                                            <datalist id="nameList">
                                                <option value="Monkey D. Luffy">
                                                <option value="Roronoa Zoro">
                                                <option value="Vinsmoke Sanji">
                                                <option value="Tony Tony Chopper">
                                                <option value="Nico Robin">
                                            </datalist>
                                        </div>
                                    </div>
                                </form>
                                <button name = "action" class="waves-light btn light-green modal-close" style="color: #000000; margin-left: 450px; margin-top: -145px">Cancel</button>
                            </div>

                            <!-- Buy, Reserve, At Need Radio Buttons -->
                            <script>
                                $("input[name='test']").click(function () {
                                    $('#viewDetails').css('display', ($(this).val() === 'view') ? 'block':'none');
                                    $('#buyUnit').css('display', ($(this).val() === 'buy') ? 'block':'none');
                                    $('#reserveUnit').css('display', ($(this).val() === 'reserve') ? 'block':'none');
                                    $('#atNeedUnit').css('display', ($(this).val() === 'atNeed') ? 'block':'none');
                                });
                            </script>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Show Hide Unit -->x
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
    <script>
        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal();
        });


        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
</div>
@endsection