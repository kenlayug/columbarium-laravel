@extends('v2.baseLayout')
@section('title', 'System Dependency Utility')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/index.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/tooltip.js') !!}"></script>

    <style>

    .headerDivider {
    border-left:1px solid #bdbdbd;
    border-right:1px solid #bdbdbd;
    height:340px;
    position:absolute;
    right:820px;
    top: 179px;
    }

    .box {
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .header {
        height: 55px;
        background-color: #00897b;
    }
    h4 {
        padding-top: 10px;
        font-family: roboto3;
        color: white;
    }
    .aside {
        margin-top: 60px;
        width: 100%;
        margin-left: 235px;
    }
    .requiredField{
        color: red;
        padding-left: 10px;
    }
    </style>
    <div class = "row">
        <div class = "col s8">
            <div class = "aside aside z-depth-1">
                <div class = "header">
                    <h4 class = "center">System Dependency</h4>
                </div>
                <div class = "row">
                    <div class = "col s4">
                        <div class = "view-img">
                            <img style = "margin-top: 20px; margin-left: 20px; width: 90%; height: 35%;" class = "insertEmployeeImage responsive-img" id="image2" src="{!! asset('/img/image.png') !!}" alt="..." />
                        </div>
                        <br>
                        <form action="#" style = "margin-left: 0px; margin-top: 60px;">
                            <div class="file-field input-field" style = "margin-top: -55px;">
                                <div class="btn uploadbtn light-green" style = "color: black;">
                                    <span>logo</span>
                                    <input id = "upload" type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Select Logo">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="headerDivider"></div>
                    <div class = "col s8">
                        <div class = "row" style = "margin-top: 20px;">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="systemName" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                                <label id="systemName" for="systemName" data-error = "Invalid format." data-success = "">Name<span style = "color: red;">*</span></label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix">room</i>
                                <input id="systemAddress" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                <label id="systemAddress" for="systemAddress" data-error = "Invalid Format." data-success = "">Address<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div class = "row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">phone</i>
                                <input id="contactNumber" type="text" class="tooltipped validate" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts alphanumeric only.<br>*Example: Metallic Urn" name="item.strItemName" required = "" aria-required="true" minlength = "1" maxlength="50" length = "50" pattern= "^[-.'a-zA-Z0-9]+(\s+[-.'a-zA-Z0-9]+)*$">
                                <label id="contactNumber" for="contactNumber" data-error = "Invalid format." data-success = "">Contact Number<span style = "color: red;">*</span></label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix">email</i>
                                <input id="e-mail" type="text" class="number validate tooltipped" data-position = "bottom" data-delay = "30" data-tooltip = "Accepts only number/s with 2 decimal places.<br>*Example: P 0.00" name="item.dblPrice" required = "" min="1" max="999999" aria-required = "true" pattern = "^(?!0)(\d+|\d{1,3}(,\d{3})*)(\.\d{1,2})?$">
                                <label id="e-mail" for="e-mail" data-error = "Invalid Format." data-success = "">E-mail<span style = "color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="input-field col s12 m6">
                            <select class="icons">
                                <option value="" disabled selected>Color</option>
                                <option value="" data-icon="images/red.jpg" class="circle">red</option>
                                <option value="" data-icon="images/blue.jpg" class="circle">blue</option>
                                <option value="" data-icon="images/green.png" class="circle">green</option>
                            </select>
                            <label>System Color</label>
                        </div>
                        <br><br><br><br>
                        <i class = "requiredField left">*Required Fields</i>
                    </div>
                    <button type="submit" name="action" class="btn light-green right" style = "color: black; margin-right: 10px; margin-bottom: 10px;">Submit</button>
                </div>
            </div>
        </div>
    </div>
















    <script>
        $(document).ready(function() {

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.view-img img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#upload").change(function() {
                readURL(this);
            });

            $('.uploadbtn').on('click', function() {
                $('#upload').trigger('click');

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>





@endsection