<div id="packageList" class="modal modal-fixed-footer" style="width:75% !important; overflow-y: hidden;">
    <div class="modal-header" style="padding: 0px">
        <center><h4 style = "font-size: 20px;font-family: myFirstFont; color: white; padding: 20px;">Package List</h4></center>
    </div>
    <div class="modal-content" style="overflow-y: auto; clear: top;">
        <div class="row" style="margin-top: -20px;">
            <div class="z-depth-2 card material-table">
                <table id="datatable5" style="color: black; background-color: white; border: 2px solid white;" datatable="ng">
                    <thead>
                        <tr>
                            <th class="center">Package</th>
                            <th class="center">Price</th>
                            <th class="center">Quantity<span style="color: red">*</span></th>
                            <th class="center">Total Price</th>
                            <th class="center">Grant Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="packageItem in packageList">
                            <td>
                                <input type="checkbox"
                                       ng-model="packageItem.selected"
                                       id="package@{{ packageItem.intPackageId }}"/>
                                <label for="package@{{ packageItem.intPackageId }}">@{{ packageItem.strPackageName }}</label>
                            </td>
                            <td class="center">@{{ packageItem.price.deciPrice | currency : "P" }}</td>
                            <td>
                                <input id="qty"
                                       ui-number-mask="0"
                                       ng-disabled="!packageItem.selected"
                                       ng-model="packageItem.intQuantity"
                                       ng-change="updatePurchasePackageList(packageItem)"
                                       type="text">
                            </td>
                            <td>
                                <label ng-show="packageItem.selected">@{{ packageItem.price.deciPrice * packageItem.intQuantity | currency: "P" }}</label>
                            </td>
                            <td class="center">
                                <input type="checkbox"
                                       ng-model="packageItem.discount"
                                       id="discountPackage@{{ packageItem.intPackageId  }}"/>
                                <label for="discountPackage@{{ packageItem.intPackageId }}">Yes</label>
                            </td>
                        </tr>
                    </tbody>
               </table>
            </div>
        </div>
        <div class="row" style="margin-top: -15px;">
            <i class = "left" style = "color: red;">*Required Fields</i>
        </div>
        <br><br>
    </div>
    <div class="modal-footer">
        <button name = "action" class="waves-light btn light-green" style = "color: #000000;margin-left: 15px; margin-right: 15px">Submit</button>
        <a name = "action" class="waves-light btn light-green modal-close" style="color: #000000;">Cancel</a>
    </div>
</div>