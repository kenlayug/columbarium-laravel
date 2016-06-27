<div id="collection" class="modal modal-fixed">
    <div id="admin" class="col s12">
        <div class="z-depth-2 card material-table">
            <div class="table-header" style="background-color: #00897b;">
                <h4 style = "font-size: 20px; color: white; padding-left: 0px; font-family: myFirstFont2">Collection: Aaron Clyde Garil</h4>
                <div class="actions">
                    <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                </div>
            </div>
            <table id="datatable">
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
                    <td><button ng-click="getPayments(collection.intCollectionId)"
                                data-target="modal2" class="waves-light btn light-green modal-trigger" style = "color: #000000; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px">Collect</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>