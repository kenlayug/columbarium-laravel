<!-- Modal Archive Discount-->
<div id="modalArchiveBlock" class="modal" style = "height: 400px; width: 600px;">
    <div class="modal-content">
        <!-- Data Grid Deactivated Discount/s-->
        <div id="admin1" class="col s12" style="margin-top: 0px">
            <div class="z-depth-2 card material-table" style="margin-top: 0px">
                <div class="table-header" style="height: 45px; background-color: #00897b;">
                    <h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 1.8vw; color: white; padding-left: 0px;">Archive Discount/s</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 150px; color: #ffffff;">search</i></a>
                </div>
                <table id="datatable2" datatable="ng">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="discount in archiveDiscountList">
                        <td ng-bind="discount.strDiscountName"></td>
                        <td>
                            <button ng-click="reactivateDiscount(discount, $index)" name = "action" class="btn light-green" style = "color: black;">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button name = "action" class="btn light-green modal-close right" style = "color: black; margin-bottom: 10px; margin-right: 30px;">DONE</button>
</div>