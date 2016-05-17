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
            <!-- Create Interest -->
            <div class = "col s12">
                <form class = "aside aside z-depth-3" style = "margin-top: 20px; height: 350px; margin-left: 30px;" id="formCreate">
                    <div class = "header">
                        <h4 style = "font-family: myFirstFont2; font-size: 30px;padding-top: 10px; margin-top: 10px;">Interest Maintenance</h4>
                    </div>
                    <div class = "row">
                        <div style = "padding-left: 10px;">
                            <div class="input-field col s6">
                                <input id="numberOfYears" type="number" class="validate" name="item.strNumberOfYears" required = "" aria-required="true" minlength = "1" maxlength="20">
                                <label for="numberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div style = "padding-left: 10px;">
                            <div class="input-field col s6">
                                <input id="interestRate" type="text" class="validate" name="item.dblPrice" required = "" min="1" step="1" aria-required = "true" pattern = "^[0-9]{1,3}(,[0-9]{3})*(([\\.,]{1}[0-9]*)|())$">
                                <label for="interestRate" data-error = "Invalid Format." data-success = "">Interest Rate<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Checkbox if at need -->
                    <div id = "checkbox" action="#">
                        <label for = "checkbox" style = "padding-left: 20px; font-size: 15px;">At Need?</label>
                        <p style = "margin-left: 20px;">
                            <input type="checkbox" id="yes"/>
                            <label for="yes">Yes</label>
                        </p>
                    </div>
                    <br>
                    <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>


                    <br><br>
                    <button onClick = "createInterest()" type = "submit" name = "action" class="btn light-green right" style = "color: black; margin-right: 10px;">Create</button>

                </form>

            </div>
        </div>


        <!-- Data Grid -->
        <div class = "col s7" style = "height: 500px; margin-top: 20px; margin-left: 40px;">
            <div class="row">
                <div id="admin">
                    <div class="z-depth-2 card material-table">
                        <div class="table-header" style="background-color: #00897b;">
                            <h4 style = "font-family: myFirstFont2; font-size: 30px; color: white; padding-left: 0px;">Interest Record</h4>
                            <div class="actions">
                                <button name = "action" class="btn tooltipped modal-trigger btn-floating light-green" data-position = "bottom" data-delay = "30" data-tooltip = "Deactivated Item/s" style = "margin-right: 10px;" href = "#modalArchiveItem"><i class="material-icons" style = "color: black">delete</i></button>
                                <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
                            </div>
                        </div>
                        <table id="datatable">
                            <thead>
                            <tr>
                                <th>Number of Years</th>
                                <th>Interest Rate</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>5</td>
                                <td>10</td>
                                <td><button name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>10</td>
                                <td><button name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>10</td>
                                <td><button name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>10</td>
                                <td><button name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>10</td>
                                <td><button name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>10</td>
                                <td><button name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>10</td>
                                <td><button name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>10</td>
                                <td><button name = "action" class="modal-trigger btn-floating light-green" href = "#modalUpdateInterest"><i class="material-icons" style = "color: black;">mode_edit</i></button>
                                    <button name = "action" class="modal-trigger btn-floating light-green" href = "#modalDeactivateInterest"><i class="material-icons" style = "color: black;">not_interested</i></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script src='http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
            <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
        </div>
    </div>
</div>




<!-- Modal Update -->
<div id="modalUpdateInterest" class="modal" style = "width: 500px;">
    <div class = "modal-header" style = "height: 55px;">
        <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 30px;">Update Interest</h4>
    </div>
    <form id="formUpdate">
        <br>
        <div class = "row">
            <div style = "padding-left: 10px;">
                <div class="input-field col s6">
                    <input id="numberOfYears" type="number" class="validate" name="item.strNumberOfYears" required = "" aria-required="true" minlength = "1" maxlength="20">
                    <label for="numberOfYears" data-error = "Invalid format." data-success = "">Number of Years<span style = "color: red;">*</span></label>
                </div>
            </div>
            <div style = "padding-left: 10px;">
                <div class="input-field col s6">
                    <input id="interestRate" type="text" class="validate" name="item.dblPrice" required = "" min="1" step="1" aria-required = "true" pattern = "^[0-9]{1,3}(,[0-9]{3})*(([\\.,]{1}[0-9]*)|())$">
                    <label for="interestRate" data-error = "Invalid Format." data-success = "">Interest Rate<span style = "color: red;">*</span></label>
                </div>
            </div>
        </div>

        <!-- Checkbox if at need -->
        <div id = "checkbox" action="#">
            <label for = "checkbox" style = "padding-left: 20px; font-size: 15px;">At Need?</label>
            <p style = "margin-left: 20px;">
                <input type="checkbox" id="yes"/>
                <label for="yes">Yes</label>
            </p>
        </div>
        <br>
        <i class = "left" style = "margin-bottom: 0px; padding-left: 20px; color: red;">*Required Fields</i>
        <br>

        <div class="modal-footer">
            <button onclick="updateInterest()" type="submit" name="action" class="btn light-green" style = "color: black; margin-top: 30px; margin-left: 10px; ">Confirm</button>
            <button class="btn light-green modal-close" style = "color: black; margin-top: 30px" onclick="$('modalUpdateItem').closeModal()">Cancel</button>
        </div>
    </form>


</div>


<!-- Modal Deactivate -->
<div id="modalDeactivateInterest" class="modal" style = "width: 400px;">
    <div class = "modal-header" style = "height: 55px;">
        <h4 style = "font-family: myFirstFont2; padding-left: 20px; font-size: 30px;">Deactivate Interest</h4>
    </div>
    <div class="modal-content">
        <p style = "padding-left: 20px; font-size: 15px;">Are you sure you want to deactivate this interest?</p>
    </div>
    <input id="itemToBeDeactivated" type="hidden"/>
    <div class="modal-footer">
        <button onclick = "deactivateInterest()" name = "action" class="btn light-green" style = "color: black; margin-left: 10px; ">Confirm</button>
        <button name = "action" class="btn light-green modal-close" style = "color: black;">Cancel</button>
    </div>
</div>


<!-- Modal Archive Item-->
<div id="modalArchiveItem" class="modal" style = "height: 800px; width: 600px;">
    <div class="modal-content">
        <!-- Data Grid Deactivated Interest/s-->
        <div id="admin1" class="col s12" style="margin-top: 0px">
            <div class="z-depth-2 card material-table" style="margin-top: 0px">
                <div class="table-header" style="height: 45px; background-color: #00897b;">
                    <h4 style = "font-family: myFirstFont2; padding-top: 10px; font-size: 30px; color: white; padding-left: 0px;">Archive Interest/s</h4>
                    <a href="#" class="search-toggle btn-flat right"><i class="material-icons right" style="margin-left: 150px; color: #ffffff;">search</i></a>
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