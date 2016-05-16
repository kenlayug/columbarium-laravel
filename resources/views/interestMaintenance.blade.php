@extends('maintenanceLayout')
@section('body')

<!-- Import CSS/JS -->

<link rel = "stylesheet" href = "{!! asset('/css/Inventory_Form.css') !!}"/>

<!-- Section -->
<div class = "parent" style = "display: flex; flex-wrap: wrap; flex-direction: column;">
    <div class = "row">
        <div class = "col s4">
            <div id="alertDiv">

            </div>
            <!-- Create Items -->
            <div class = "col s12">
                <form class = "aside aside z-depth-3" style = "margin-top: 20px; height: 430px; margin-left: 30px;" id="formCreate">
                    <div class = "header">
                        <h4 style = "font-family: myFirstFont2; font-size: 30px;padding-top: 10px; margin-top: 10px;">Additionals Maintenance</h4>
                    </div>
                    <div class = "row">
                        <div style = "padding-left: 10px;">
                            <div class="input-field col s6">
                                <input id="itemName" type="text" class="validate" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                                <label for="itemName" data-error = "Invalid format." data-success = "">Item Name<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div style = "padding-left: 10px;">
                            <div class="input-field col s6">
                                <input id="itemPrice" type="text" class="validate" name="item.dblPrice" required = "" min="1" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                                <label for="itemPrice" data-error = "Invalid Format." data-success = "">Item Price<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class="input-field col s6">
                            <select id="selectItemCategory">
                                <option value="" disabled selected>Item Category</option>
                                <c:if test="${itemCategoryList != null}">
                                    <c:forEach items="${itemCategoryList }" var="itemCategory">
                                        <option value="${itemCategory.strItemCategoryDesc }">${itemCategory.strItemCategoryDesc }</option>
                                    </c:forEach>
                                </c:if>
                            </select>
                            <label>Select Item Category</label>
                        </div>
                        <button type = "submit" name = "action" class="modal-trigger btn green right" style = "margin-top: 10px; margin-right: 10px;" href = "#modalItemCategory">Item Category</button>
                    </div>


                    <div class="row" style = "padding-left: 10px;">
                        <div class="input-field col s12">
                            <input id="itemDesc" type="text" class="validate" name="item.strItemDesc">
                            <label for="itemDesc" data-error = "Invalid Format" data-success = "">Item Description</label>
                        </div>
                    </div>
                    <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>
                    <br>
                    <button onClick = "createItem()" type = "submit" name = "action" class="btn green right" style = "margin-right: 10px;">Create</button>

                </form>

            </div>
        </div>


        <!-- Data Grid -->
        <div class = "col s7" style = "height: 500px; margin-top: 20px; margin-left: 40px;">
            <div class="row">
                <div id="admin">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header" style="background-color: #00897b;">
                            <h4 style = "font-family: myFirstFont2; font-size: 30px; color: white; padding-left: 0px;">Additionals Record</h4>
                            <div class="actions">
                                <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Item/s" style = "margin-right: 10px;" href = "#modalArchiveItem"><i class="material-icons" style = "color: black">delete</i></button>
                                <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                            </div>
                        </div>
                        <table id="datatable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <c:if test="${itemList == null }">
                                <tr>
                                    <td>Item One</td>
                                    <td>P 200</td>
                                    <td>Item One</td>
                                    <td><button name = "action" class="modal-trigger btn-floating light-green" onclick="openUpdate('${item.strItemName}')"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                        <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateItem"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                </tr>
                            </c:if>

                            <c:if test="${itemList != null }">
                                <c:forEach items="${itemList }" var="item">
                                    <tr>
                                        <td>${item.strItemName }</td>
                                        <td>P ${item.dblPrice }</td>
                                        <td>${item.strItemDesc }</td>
                                        <td><button name = "action" class="modal-trigger btn-floating light-green" onclick="openUpdate('${item.strItemName}')"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                            <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateItem"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                                    </tr>
                                </c:forEach>
                            </c:if>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script type="text/javascript" src = "<%=request.getContextPath()%>/js/index.js"></script>
        </div>
    </div>
</div>




<!-- Modal Update -->
<div id="modalUpdateItem" class="modal" style = "width: 500px;">
    <div class = "modal-header" style = "height: 55px;">
        <h4 style = "padding-left: 20px; font-size: 30px;">Update Item</h4>
    </div>
    <form id="formUpdate">
        <br>
        <div class = "col s12">
            <div class = "row">
                <div style = "padding-left: 10px;">
                    <div class="input-field col s6">
                        <input id="itemNameToBeUpdated" type="hidden"/>
                        <input value=" " id="itemNameUpdate" type="text" class="validate" name="item.strItemName" required = ""  minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                        <label class="active" for="itemNameUpdate" data-error = "Invalid format." data-success = "">New Item Name<span style = "color: red;">*</span></label>
                    </div>
                </div>
                <div style = "padding-left: 10px;">
                    <div class="input-field col s6">
                        <input value="0" id="itemPriceUpdate" type="text" class="validate" name="item.dblPrice" required = "" min="1" step="1" aria-required = "true" pattern = "(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)">
                        <label class="active" for="itemPriceUpdate" data-error = "Invalid format." data-success = "">New Item Price<span style = "color: red;">*</span></label>
                    </div>
                </div>
            </div>
        </div>

        <div style = "padding-left: 20px;">
            <div class="input-field col s12">
                <input value=" " id="itemDescUpdate" type="text" class="validate" name="item.strItemDesc">
                <label class="active" for="itemDescUpdate" data-error = "Invalid format." data-success = "">New Item Description</label>
            </div>
        </div>

        <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>
        <br>

        <div class="modal-footer">
            <button onclick="updateItem()" type="submit" name="action" class="btn green" style = "margin-top: 30px; margin-left: 10px; ">Confirm</button>
            <button class="btn green modal-close" style = "margin-top: 30px" onclick="$('modalUpdateItem').closeModal()">Cancel</button>
        </div>
    </form>


</div>


<!-- Modal Deactivate -->
<div id="modalDeactivateItem" class="modal" style = "width: 400px;">
    <div class = "modal-header" style = "height: 55px;">
        <h4 style = "padding-left: 20px; font-size: 30px;">Deactivate Item</h4>
    </div>
    <div class="modal-content">
        <p style = "padding-left: 30px; font-size: 15px;">Are you sure you want to deactivate this item?</p>
    </div>
    <input id="itemToBeDeactivated" type="hidden"/>
    <div class="modal-footer">
        <button onclick = "deactivateItem()" name = "action" class="btn light-green" style = "margin-left: 10px; ">Confirm</button>
        <button name = "action" class="btn green modal-close">Cancel</button>
    </div>
</div>

<!-- Modal Item Category -->
<div id="modalItemCategory" class="modal" style = "width: 400px;">
    <div class = "modal-header" style = "height: 55px;">
        <h4 style = "padding-left: 20px; font-size: 30px;">Item Category</h4>
    </div>
    <form class="modal-content" id="formCreateItemCategory">
        <div style = "padding-left: 10px;">
            <div class="input-field col s12">
                <input id="itemCategoryDesc" type="text" class="validate" name="item.strItemCategory" required = "" aria-required="true" minlength = "1" maxlength="20" pattern= "^[a-zA-Z'-\s]+|[0-9a-zA-Z'-\s]+|[a-zA-Z0-9'-]{1,20}">
                <label for="itemCategoryDesc" data-error = "Invalid format." data-success = "">Item Category<span style = "color: red;">*</span></label>
                <i class = "left" style = "padding-bottom: 20px; margin-top: 20px; padding-left: 0px; color: red;">*Required Fields</i>
            </div>
            <br>
        </div>
        <div class="modal-footer">
            <button onclick="createItemCategory()" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; margin-top: 42px;">Confirm</button>
            <button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
        </div>
    </form>

</div>

<!-- Modal Archive Item-->
<div id="modalArchiveItem" class="modal" style = "height: 1300px; width: 740px;">
    <div class="modal-content">
        <!-- Data Grid Deactivated Item/s-->
        <div id="admin1" class="col s12" style="margin-top: 0px">
            <div class="z-depth-2 card material-table" style="margin-top: 0px">
                <div class="table-header" style="height: 45px; background-color: #00897b;">
                    <h4 style = "padding-top: 10px; font-size: 30px; color: white; padding-left: 0px;">Archive Item/s</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 270px; color: #ffffff;">search</i></a>
                </div>
                <table id="datatable2">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Item One</td>
                        <td>
                            <button name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Item Two</td>
                        <td>
                            <button name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Item Three</td>
                        <td>
                            <button name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Item Three</td>
                        <td>
                            <button name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Item Four</td>
                        <td>
                            <button name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Item Five</td>
                        <td>
                            <button name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Item Six</td>
                        <td>
                            <button name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Item Seven</td>
                        <td>
                            <button name = "action" class="btn green modal-close">Activate</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button name = "action" class="btn green modal-close right" style = "margin-bottom: 10px; margin-right: 30px;">DONE</button>
</div>

<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal({dismissible: false});
    });

</script>

@endsection