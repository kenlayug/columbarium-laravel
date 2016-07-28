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
                                            <div ng-show="building.floorList.length == 0" class="collapsible-body" style = "background-color: #fb8c00;">
                                                <p>No floor configured to create a block.</p>
                                            </div>
                                            <div class="collapsible-body" ng-hide="building.floorList.length == 0">
                                                <div class="row">
                                                    <div class="col s12 m12">
                                                        <ul class="collapsible" data-collapsible="accordion">
                                                            <li ng-repeat="floor in building.floorList">
                                                                <div class="collapsible-header orange"><i class="medium material-icons">business</i>
                                                                    <label style = "font-family: myFirstFont; font-size: 1.5vw; color: white;">Floor No @{{ floor.intFloorNo }}</label>
                                                                </div>
                                                                <div class="collapsible-body orange">
                                                                    <p ng-repeat="unitType in floor.unitType">@{{ unitType.strRoomTypeName }}
                                                                        <button ng-click="openPrice(floor.intFloorId, floor.intFloorNo, unitType.intRoomTypeId, unitType)" name = "action" class="btn tooltipped right teal darken-1" data-position = "bottom" data-delay = "30" data-tooltip = "View Block" style = "margin-top: -5px; margin-right: 0px; font-family: arial; color: black;" >SET</button>
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
                </div>


                <div class = "col s7" >
                    <div class = "col s4">
                        <div class="responsive">
                            <div class = "col s12">
                                <div class = "aside aside z-depth-3" style = "overflow: auto;width: 750px; margin-top: -50px; height: 470px; background-color: #e0f2f1;">
                                    <button ng-click="closePrice()"
                                            ng-show="unitCategoryList != null"
                                            class = "btn-floating btn red right" style = "margin-top: 10px; margin-right: 10px;">&#10006;</button>
                                    <div style = "margin-top: 50px; width: 750px; height: 50px; background-color: #4db6ac;">
                                        <h2 style = "padding-top: 10px; color: white; font-family: fontSketch; padding-left: 240px; font-size: 2vw; margin-top: 30px;">Price Configuration</h2>
                                    </div>
                                    <h5 ng-show="floorNo != null" class="center">Floor No. @{{ floorNo }} (@{{ unitType.strRoomTypeName }})</h5>

                                        <div ng-repeat="unitCategory in unitCategoryList"
                                             class = "row" style = " margin-bottom: -30px;">
                                            <table class = "col s6" id="tableUnits" style="font-size: small;">
                                                <tbody>
                                                <tr style = "height: 0px;">
                                                    <td style="height: 55px; background-color: #00695c; border: 2px solid white;">
                                                        <label style = "padding-left: 150px; color: white; font-size: 16px; font-family: Arial;">Level @{{ unitCategory.display }}</label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="input-field col s4">
                                                <form ng-submit="savePrice(unitCategory.intUnitCategoryId, unitCategory.intLevelNo, unitCategory.price.deciPrice, $index)">
                                                    <input  ng-model="unitCategory.price.deciPrice"
                                                            ui-number-mask="2"
                                                            id="@{{ unitCategory.intUnitCategoryId }}" type="text" class="number validate tooltipped" placeholder="P 0.00" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places. <br>*Example: P 0.00" required = "" min="1" max="999999" step="1" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                                    <label for="@{{ unitCategory.intUnitCategoryId }}" for="levelPrice" data-error = "Invalid Format." data-success = "">Level Price<span style = "color: red;">*</span></label>
                                                    <div class="input-field col s2">
                                                        <button name = "action" class="btn light-green">Submit</button>
                                                    </div>
                                                </form>
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