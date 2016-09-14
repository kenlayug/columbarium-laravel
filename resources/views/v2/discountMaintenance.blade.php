@extends('v2.baseLayout')
@section('title', 'Discount Maintenance')
@section('body')
    <!-- Import CSS/JS -->

    <link rel = "stylesheet" href = "{!! asset('/css/additionalsMaintenance.css') !!}"/>
    <link rel = "stylesheet" href = "{!! asset('/css/discountMaintenance.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/additional/js/additionalController.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/discount/controller.js') !!}"></script>

<div ng-controller="ctrl.discount">
    <!-- Section -->
    <div class = "container" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
        <div class = "row">

            <!-- Create Discount -->
            <div class = "col s12 m6 l4">
                <div>
                    <form ng-submit="saveDiscount()" autocomplete="off" class = "formCreate aside aside z-depth-3" id="formCreate" autocomplete="off">
                        <div class = "createHeader">
                            <h4 class = "center flow-text">Discount Maintenance</h4>
                        </div>
                        <div class = "row" style = "padding-left: 10px; padding-right: 10px;">
                            <div class="input-field col s6">
                                <input ng-model="discount.strDiscountName" id="dicountName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Senior's Discount" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                                <label id="createName" for="discountName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                            </div>
                            <div class="input-field col s5 m5 l6">
                                <select id="selectItemCategory" ng-model="discount.intDiscountType" material-select watch>
                                    <option class = "additionalCategory2" value="" disabled selected>Discount Type</option>
                                    <option value="1">Percentage</option>
                                    <option value="2">Amount</option>
                                </select>
                            </div>
                        </div>
                        <div class = "row" style = "padding-left: 10px;">
                            <div class="input-field col s6">
                                <input ng-model="discount.deciDiscountRate"
                                       ng-disabled="discount.intDiscountType != 1"
                                       ng-show="discount.intDiscountType == 1"
                                       ui-percentage-mask
                                       id="interestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" max="100" aria-required = "true">
                                <input ng-model="discount.deciDiscountRate"
                                       ui-number-mask
                                       ng-disabled="discount.intDiscountType != 2"
                                       ng-show="discount.intDiscountType == 2"
                                       id="interestRate" type="text" class="validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts numbers only.<br>*Example: 25" name="item.dblPrice" required = "" max="100" aria-required = "true">
                                <label id="createRate" for="interestRate" data-error = "Invalid Format." data-success = "">Rate<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <i class = "left" style = "color: red; padding-left: 10px;">*Required Fields</i>
                        <br><br>
                        <div class = "row">
                            <button type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-right: 20px; margin-bottom: 10px;">Create</button>
                        </div>
                    </form>
                </div>
            </div>



            <!-- Data Grid -->
            <div class = "dataGrid col s12 m6 l8">
                <div class="row">
                    <div id="admin">
                        <div class="z-depth-2 card material-table">
                            <div class="table-header">
                                <h5 class = "flow-text">Discount Record</h5>
                                <div class="actions">
                                    <div id = "modalCreateBtn" style = "display: none;">
                                        <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Create Discount" style = "margin-right: 10px;" href = "#modalCreateItem"><i class="material-icons" style = "color: black">add</i></button>
                                    </div>
                                    <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Discount" style = "margin-right: 10px;" href = "#modalArchiveBlock"><i class="material-icons" style = "color: black">delete</i></button>
                                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                                </div>
                            </div>
                            <table datatable="ng">
                                <thead >
                                <tr>
                                    <th style = "font-size: .9vw; color: black;">Name</th>
                                    <th style = "font-size: .9vw; color: black;">Rate</th>
                                    <th style = "font-size: .9vw; color: black;">Type</th>
                                    <th style = "font-size: .9vw; color: black;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="discount in discountList">
                                    <td ng-bind="discount.strDiscountName"></td>
                                    <td ng-bind="discountTypeList[discount.intDiscountType]"></td>
                                    <td>
                                        <span ng-if="discount.intDiscountType == 2" ng-bind="discount.deciDiscountRate | currency: '₱'"></span>
                                        <span ng-if="discount.intDiscountType == 1" ng-bind="discount.deciDiscountRate | percentage: 2"></span>
                                    </td>
                                    <td><button tooltipped ng-click="getDiscount(discount, $index)" name = "action" class="btn modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Update Discount"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button tooltipped ng-click="deleteDiscount(discount, $index)" name = "action" class="btn btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivate Discount"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal({dismissible: false});
        });

        $(window).resize(function() {
            if ($(this).width() < 1026) {
                $('#fadeShow').hide();
            } else {
                $('#fadeShow').show();
            }
        });
        $(window).resize(function() {
            if ($(this).width() > 1026) {
                $('#modalCreateBtn').hide();
            } else {
                $('#modalCreateBtn').show();
            }
        });
    </script>

    @include('modals.discount.update')
    @include('modals.discount.archive')
</div>
@endsection