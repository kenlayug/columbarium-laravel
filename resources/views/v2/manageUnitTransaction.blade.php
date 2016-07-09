@extends('v2.baseLayout')
@section('title', 'Manage Unit')
@section('body')

    <link rel="stylesheet" href="{!! asset('/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/vaults.css') !!}">
    <script type="text/javascript" src="{!! asset('/js/manageUnit.js') !!}"></script>

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
        @include('modals.manage-unit.addTransferPullOutForm')
        @include('modals.manage-unit.newCustomer')
    </div>

@endsection