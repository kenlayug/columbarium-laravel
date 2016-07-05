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
                                                    {{--<button ng-show="floor.columbary"--}}
                                                            {{--ng-click="openPrice(floor.intFloorId, floor.intFloorNo, 1)"--}}
                                                            {{--data-tooltip="Columbary Vaults"--}}
                                                            {{--data-delay="50"--}}
                                                            {{--data-position="bottom"--}}
                                                            {{--name = "action" class="modal-trigger btn-floating red right tooltipped" style = "margin-top: -5px; margin-right: -20px;"><i class="material-icons" style = "color: black;">view_quilt</i></button>--}}
                                                    {{--<button ng-show="floor.fullBody"--}}
                                                            {{--ng-click="openPrice(floor.intFloorId, floor.intFloorNo, 2)"--}}
                                                            {{--data-tooltip="Full Body Crypts"--}}
                                                            {{--data-delay="50"--}}
                                                            {{--data-position="bottom"--}}
                                                            {{--name = "action" class="modal-trigger btn-floating light-green right tooltipped" style = "margin-top: -5px; margin-right: 5px;"><i class="material-icons" style = "color: black;">dashboard</i></button>--}}
                                                    <button ng-repeat="unitType in floor.unitType"
                                                            ng-click="openPrice(floor.intFloorId, floor.intFloorNo, unitType.intRoomTypeId, unitType)"
                                                            data-tooltip="@{{ unitType.strRoomTypeName }}"
                                                            data-delay="50"
                                                            data-position="bottom"
                                                            name = "action" class="modal-trigger btn-floating light-green right tooltipped" style = "margin-top: -5px; margin-right: 5px;">@{{ unitType.strRoomTypeName.charAt(0) }}</button>

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

                <div class = "col s7" >
                    <div class = "col s4" style = "margin-top: -30px; width: 775px;">
                        <div class="responsive">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "margin-top: -50px; height: 470px; background-color: #e0f2f1;">
                                    <div class="center vaults-content" style = "overflow: auto; height: 470px;">
                                        <div style = "margin-left: 0px; width: 730px; height: 50px; background-color: #4db6ac;">
                                            <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; padding-left: 40px; font-size: 2vw; margin-top: 30px;">Price Configuration</h2>
                                        </div>
                                        <h5 ng-show="floorNo != null">Floor No. @{{ floorNo }} (@{{ unitType.strRoomTypeName }})</h5>

                                        <div ng-repeat="unitCategory in unitCategoryList"
                                             class = "row" style = " margin-bottom: -30px;">
                                            <table class = "col s6" id="tableUnits" style="font-size: small;">
                                                <tbody>
                                                <tr style = "height: 0px;">
                                                    <td style="height: 55px; background-color: #00695c; border: 2px solid white;">
                                                        <label style = "padding-left: 150px; color: white; font-size: 16px; font-family: Arial;">Level No. @{{ unitCategory.intLevelNo }}</label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="input-field col s4">
                                                <input  ng-model="unitCategory.price.deciPrice"
                                                        id="levelPrice" type="text" class="number validate tooltipped" placeholder="P 0.00" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places. <br>*Example: P 0.00" required = "" min="1" max="999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                                <label id="levelPrice" for="levelPrice" data-error = "Invalid Format." data-success = "">Level Price<span style = "color: red;">*</span></label>
                                            </div>
                                            <div class="input-field col s2">
                                                <button ng-disable="saveButton"
                                                        ng-click="savePrice(unitCategory.intUnitCategoryId, unitCategory.intLevelNo, unitCategory.price.deciPrice, $index)"
                                                        class="btn">Save</button>
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