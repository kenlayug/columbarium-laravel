@extends('v2.baseLayout')
@section('title', 'Price Maintenance')
@section('body')
    <!-- Section -->
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <link rel = "stylesheet" href = "{!! asset('/css/Blocks_Record_Form.css') !!}"/>
{{--    <link rel="stylesheet" type="text/css" href="{!! asset('/css/vaults.css') !!}">--}}
    <script src="{!! asset('/price/controller.js') !!}"></script>

    <div ng-controller="ctrl.price">

        <div style = "margin-left: 55px; width: 372px; height: 50px; background-color: #4db6ac;">
            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; padding-left: 40px; font-size: 2vw; margin-top: 30px;">Price Maintenance</h2>
        </div>
        <div class = "col s12" >
            <div class = "row">
                <div class = "responsive">

                    <div class = "col s4" style = "width: 420px; margin-left: 30px;">

                        <div style = "overflow: auto;height: 370px;">
                            <div class = "col s12">
                                <div class = "aside aside ">

                                    <ul class="collapsible" data-collapsible="accordion" watch>
                                        <li ng-repeat="building in buildingList">
                                            <div ng-click="getFloors(building.intBuildingId, $index)" class="collapsible-header" style = "background-color: #00897b"><i class="medium material-icons">business</i>
                                                <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">@{{ building.strBuildingName }}</label>
                                            </div>
                                            <div ng-repeat="floor in building.floorList" class="collapsible-body" style = "max-height: 50px; background-color: #fb8c00;">
                                                <p style = "padding-top: 10px;">Floor No. @{{ floor.intFloorNo }}
                                                    <button ng-show="floor.columbary"
                                                            ng-click="openPrice(floor.intFloorId, floor.intFloorNo, 1)"
                                                            data-tooltip="Columbary Vaults"
                                                            data-delay="50"
                                                            data-position="bottom"
                                                            name = "action" class="modal-trigger btn-floating red right tooltipped" style = "margin-top: -5px; margin-right: -20px;"><i class="material-icons" style = "color: black;">view_quilt</i></button>
                                                    <button ng-show="floor.fullBody"
                                                            ng-click="openPrice(floor.intFloorId, floor.intFloorNo, 2)"
                                                            data-tooltip="Full Body Crypts"
                                                            data-delay="50"
                                                            data-position="bottom"
                                                            name = "action" class="modal-trigger btn-floating light-green right tooltipped" style = "margin-top: -5px; margin-right: 5px;"><i class="material-icons" style = "color: black;">dashboard</i></button>
                                                </p>
                                            </div>
                                            <div ng-show="building.floorList.length == 0" class="collapsible-body" style = "background-color: #fb8c00;">
                                                <p>No floor configured to create a block.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Grid -->
                <div class = "col s7" style = "margin-top: 0px; margin-left: 30px;" ng-show="false">
                    <div class="row">
                        <div id="admin">
                            <div class="z-depth-2 card material-table">
                                <div class="table-header" style="background-color: #00897b;">
                                    <h4 style = "font-family: fontSketch; font-size: 1.9vw; color: white; padding-left: 0px;">Block Record</h4>
                                    <div class="actions">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Block/s" style = "margin-right: 10px;" href = "#modalArchiveBlock"><i class="material-icons" style = "color: black">delete</i></button>
                                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Floor Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="block in blocks">
                                        <td>@{{ block.strBlockName }}</td>
                                        <td>@{{ block.strUnitType }}</td>
                                        <td>@{{ block.strBuildingName }}</td>
                                        <td>@{{ block.strBuildingCode + "-" + block.intFloorNo }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "col s7" >
                    <div class = "col s4" style = "margin-top: -30px; width: 775px;">
                        <div class="responsive">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "margin-top: -50px; height: 470px; background-color: #e0f2f1;">
                                    <div class="center vaults-content" style = "overflow: auto; height: 470px;">
                                        <div style = "margin-left: 0px; width: 730px; height: 50px; background-color: #4db6ac;">
                                            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; padding-left: 40px; font-size: 2vw; margin-top: 30px;">Price Configuration</h2>
                                        </div>
                                        <h5>Floor One</h5>

                                        <div class = "row" style = " margin-bottom: -30px;">
                                            <table class = "col s6" id="tableUnits" style="font-size: small;">
                                                <tbody>
                                                <tr style = "height: 0px;">
                                                    <td style="height: 55px; background-color: #00695c; border: 2px solid white;">
                                                        <label style = "padding-left: 150px; color: white; font-size: 16px; font-family: Arial;">Level No. 1</label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="input-field col s6">
                                                <input id="levelPrice" type="text" class="number validate tooltipped" placeholder="P 0.00" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places. <br>*Example: P 0.00" required = "" min="1" max="999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                                <label id="levelPrice" for="levelPrice" data-error = "Invalid Format." data-success = "">Level Price<span style = "color: red;">*</span></label>
                                            </div>
                                        </div>
                                        <div class = "row" style = " margin-bottom: -30px;">
                                            <table class = "col s6" id="tableUnits" style="font-size: small;">
                                                <tbody>
                                                <tr style = "height: 0px;">
                                                    <td style="height: 55px; background-color: #00695c; border: 2px solid white;">
                                                        <label style = "padding-left: 150px; color: white; font-size: 16px; font-family: Arial;">Level No. 2</label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="input-field col s6" style = "padding-top: 0px;">
                                                <input placeholder="P 0.00" id="itemName" type="text" class="number tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places. <br>*Example: P 0.00" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                                <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Level Price<span style = "color: red;">*</span></label>
                                            </div>
                                        </div>
                                        <div class = "row" style = " margin-bottom: -30px;">
                                            <table class = "col s6" id="tableUnits" style="font-size: small;">
                                                <tbody>
                                                <tr style = "height: 0px;">
                                                    <td style="height: 55px; background-color: #00695c; border: 2px solid white;">
                                                        <label style = "padding-left: 150px; color: white; font-size: 16px; font-family: Arial;">Level No. 3</label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="input-field col s6" style = "padding-top: 0px;">
                                                <input placeholder="P 0.00" id="itemName" type="text" class="number tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places. <br>*Example: P 0.00" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                                <label id="createName" for="itemName" data-error = "Invalid format." data-success = "">Level Price<span style = "color: red;">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <script>
        $('input.number').keyup(function(event) {

            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
            }

            $(this).val(function(index, value) {
                value = value.replace(/,/g,''); // remove commas from existing input
                return numberWithCommas(value); // add commas back in
            });
        });

        function numberWithCommas(x) {

            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        $(document).ready(function(){
            $('.tooltipped').tooltip({delay: 50});
        });


        $(document).ready(function() {
            $('input#input_text, textarea#textarea1').characterCounter();
        });
        $('.modal-trigger').leanModal({
            dismissible: false
        });

    </script>
    @include('modals.price.archive')
</div>
@endsection