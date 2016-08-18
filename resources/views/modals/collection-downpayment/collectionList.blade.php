<div id="collection" class="modal modal-fixed" style="width: 95%; max-height: 120%;">
    

    <div class="modal-header" style="background-color: #00897b;">
        <h5 style = "color: white; text-align: center; font-family: myFirstFont2; font-size: 20px;">Collection: @{{ customer.strFullName }}</h5>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>
    <div class="modal-content" style="overflow-y: auto;">
        <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
            <table id="datatable4" datatable="ng">
                <thead>
                <tr>
                    <th>Transaction Code</th>
                    <th>Unit Code</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="collection in collectionList">
                    <td>Collection No. @{{ collection.intCollectionId }}</td>
                    <td>Unit No. @{{ collection.intUnitIdFK }}</td>
                    <td><button ng-click="getPayments(collection, $index)"
                                data-target="collectionForm" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>