<link rel = "stylesheet" href = "{!! asset('/css/sidenav-hamburger.css') !!}"/>


<div class="navbar-fixed nav-leo">
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center"><span class = "flow-text" style = "font-family: roboto3;">Columbarium and Crematorium Management System</span></a>

            <nav id="slide-out-l" class="side-nav left" style = "background-color: #212121;">

                <div class="user-details">
                    <img id="image1" style="height: 120px; width: 240px; position: relative;" src="{!! asset('/img/pattern8.jpg') !!}" alt="..." />
                    <div class="row">
                        <div class="col s4 m4 l4">
                            <img id="image2" src="{!! asset('/img/Ken Layug.jpg') !!}" alt="..." class="circle responsive-img valign profile-image" style="position: absolute; top: 23px; left: 15px; width: 70px; height: 70px;">
                        </div>
                        <div class="col s8 m8 l8" ng-controller="ctrl.user">
                            <ul id='profile-dropdown' class='dropdown-content' style = "margin-top: 35px;">
                                <li style = "min-height: 25px;"><a href="#!" style = "width: 100%; margin: 0px;"><i class="material-icons left" style = "margin-top: -5px; margin-left: -20px; color: black;">face</i><span style = "font-size: 15px; display: block; vertical-align: center; color: black; margin-top: -4px;">Profile</span></a></li>
                                <li style = "min-height: 25px;"><a href="#!" style = "width: 100%; margin: 0px;"><i class="material-icons left" style = "margin-top: -5px; margin-left: -20px; color: black;">settings</i><span style = "font-size: 15px; display: block; vertical-align: center; color: black; margin-top: -4px;">Settings</span></a></li>
                                <li class="divider"></li>
                                <li style = "min-height: 25px;"><a ng-click="logout()" href="#!" style = "width: 100%; margin: 0px;"><i class="material-icons left" style = "margin-top: -5px; margin-left: -20px; color: black;">power_settings_new</i><span style = "font-size: 15px; display: block; vertical-align: center; color: black; margin-top: -4px;">Logout</span></a></li>
                            </ul>
                            <a ng-bind="user.strFirstName+' '+user.strLastName" class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown" style = "position: absolute; left: 85px; top: 25px;"><span style = "font-size: 16px; font-family: roboto3; text-transform: capitalize;">Ken Layug</span><i class="material-icons right" style = "font-size: 25px; margin-left: 15px; margin-top: -10px;">keyboard_arrow_down</i></a>
                            <p ng-bind="user.position.strPositionName" style = "font-size: 16px; font-family: roboto3; position: absolute; left: 100px; top: 20px;">Administrator</p>
                        </div>
                    </div>
                </div>

                <ul class="collapsible collapsible-accordion">
                    <li>
                        <div href="{!! url('/') !!}" class="collapsible-header @{{ dashboard }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">dashboard</i>DASHBOARD</div>
                    </li>
                    <li>
                        <div class="collapsible-header @{{ maintenanceActive }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">settings</i>MAINTENANCE</div>
                        <div class="collapsible-body">
                            <ul>
                                <li class="@{{ buildingActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/building-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">BUILDING</h6></a></li>
                                <li class="@{{ roomActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/room-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ROOM</h6></a></li>
                                <li class="@{{ blockActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/block-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">BLOCK</h6></a></li>
                                <li class="@{{ priceActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/price-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT PRICE</h6></a></li>
                                <li class="@{{ interestActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/interest-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">INTEREST</h6></a></li>
                                <li class="@{{ additionalActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/additional-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ADDITIONALS</h6></a></li>
                                <li class="@{{ requirementActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/requirement-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">REQUIREMENT</h6></a></li>
                                <li class="@{{ serviceActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/service-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SERVICES</h6></a></li>
                                <li class="@{{ packageActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/package-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">PACKAGE</h6></a></li>
                                <li class="@{{ discountActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/discount-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">DISCOUNT</h6></a></li>
                                <li class="@{{ assignDiscountActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/assign-discount-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ASSIGN DISCOUNT</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header @{{ transactionActive }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px;font-family: roboto2;"><i class="material-icons">work</i>TRANSACTION</div>
                        <div class="collapsible-body">
                            <ul>
                                <li class="@{{ unitPurchaseActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">PURCHASE UNIT</h6></a></li>
                                <li class="@{{ collectionActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/collection-downpayment-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">COLLECTIONS</h6></a></li>
                                <li class="@{{ manageUnitActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/manage-unit-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">MANAGE UNIT</h6></a></li>
                                <li class="@{{ servicePurchaseActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/service-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">PURCHASE SERVICE</h6></a></li>
                                <li class="@{{ assignScheduleActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/assign-schedule-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">MANAGE SCHEDULE</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header @{{ queriesActive }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">description</i>QUERIES</div>
                        <div class="collapsible-body">
                            <ul>   
                                <li class="@{{ roomQueryActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/room-query') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ROOM</h6></a></li>
                                <li class="@{{ blockQueryActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/block-query') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">BLOCK</h6></a></li>
                                <li class="@{{ priceQueryActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-price-query') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT PRICE</h6></a></li>
                                <li class="@{{ additionalQueryActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/additional-query') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ADDITIONALS</h6></a></li>
                                <li class="@{{ serviceQueryActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/service-query') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SERVICE</h6></a></li>
                                <li class="@{{ packageQueryActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/package-query') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">PACKAGE</h6></a></li>
                                <li class="@{{ unitQueryActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-query') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT</h6></a></li>
                                <li class="@{{ scheduleQueryActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/schedule-query') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SCHEDULES</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header @{{ reportActive }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">web</i>REPORTS</div>
                        <div class="collapsible-body">
                            <ul>
                                <!-- <li class="@{{ overViewReportActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/overview-report') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">OVERVIEW REPORT</h6></a></li> -->
                                <li class="@{{ salesReportActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/sales-report') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SALES REPORT</h6></a></li>
                                <li class="@{{ unitPurchaseReportActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-purchases-report') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT PURCHASES</h6></a></li>
                                <li class="@{{ collectionReportActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/collection-downpayment-report') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">COLLECTION REPORT</h6></a></li>
                                <li class="@{{ manageUnitReportActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/manage-unit-report') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">MANAGE UNIT</h6></a></li>
                                <li class="@{{ transferOwnerReportActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/transfer-ownership-report') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">TRANSFER OWNERSHIP</h6></a></li>
                                <!-- <li class="@{{ receivableReportActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/receivables-report') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">RECEIVABLES REPORT</h6></a></li> -->
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header @{{ utilityActive }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">build</i>UTILITIES</div>
                        <div class="collapsible-body">
                            <ul>
                                <li class="@{{ businessDependencyActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/business-dependency-utility') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">BUSINESS DEPENDENCIES</h6></a></li>
                                <li class="@{{ collectionActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/employee-utility') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">EMPLOYEE</h6></a></li>
                                <li class="@{{ unitServicingActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-servicing-utility') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT SERVICING</h6></a></li>
                                <li class="@{{ unitServicingActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/system-dependency-utility') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SYSTEM DEPENDENCY</h6></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </nav>
            <a href="#" data-activates="slide-out-l" class="button-collapse show-on-large"><i class="material-icons">reorder</i></a>
        </div>
    </nav>
</div>

<script type="text/javascript" >



    $(document).ready(function()
    {
        $("#notificationLink").click(function()
        {
            $("#notificationContainer").fadeToggle(300);
            $("#notification_count").fadeOut("slow");
            return false;
        });

//Document Click hiding the popup
        $(document).click(function()
        {
            $("#notificationContainer").hide();
        });

//Popup on click
        $("#notificationContainer").click(function()
        {
            return false;
        });

    });
</script>
<style>
    #notification_li
    {
        position:relative
    }
    #notificationContainer
    {
        background-color: #fff;
        -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
        overflow: visible;
        position: absolute;
        top: 65px;
        margin-left: -320px;
        width: 380px;
        z-index: -1;
        display: none; // Enable this after jquery implementation
    }
    #notificationTitle
    {

        font-weight: bold;
        font-family: myFirstFont2;
        font-size: large;
        padding-left: 10px;
        padding-bottom: 15px;
        background-color: #ffffff;
        position: fixed;
        z-index: 1000;
        width: 380px;
        height: 50px;
        border-bottom: 1px solid #dddddd;
    }
    #notificationsBody
    {
        padding: 33px 0px 0px 0px !important;
        min-height:400px;
    }
    #notificationFooter
    {
        background-color: #f8f9fc;
        text-align: center;
        font-weight: bold;
        font-size: 10px;
        border-top: 1px solid #dddddd;
        height: 50px;
    }
    #notification_count
    {
        padding: 0px 5px 0px 5px;
        background: #cc0000;
        color: #ffffff;
        font-weight: bold;
        margin-left: 50px;
        border-radius: 50px;
        -moz-border-radius: 50px;
        -webkit-border-radius: 50px;
        position: absolute;
        margin-top: -11px;
        font-size: 11px;
    }
</style>

<script>
    $(function() {

        $("[data-activates=slide-out-l]").sideNav();
        $("[data-activates=slide-out-r]").sideNav({
            edge: 'right'
        });
    })


    $(document).ready(function(){
        $('.collapsible').collapsible({
            accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
        });
    });
</script>