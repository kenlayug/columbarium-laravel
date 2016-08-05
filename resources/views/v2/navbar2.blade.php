<link rel = "stylesheet" href = "{!! asset('/css/sidenav-hamburger.css') !!}"/>


<div class="navbar-fixed nav-leo">
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center" style = "font-size: 2vw; font-family: myFirstFont;">Columbarium and Crematorium Management System</a>

            <nav id="slide-out-l" class="side-nav left" style = "background-color: #212121;">

                <!-- Account Information -->
                <div style="width: 200px; height: 120px; position: relative;">
                    <img id="image1" style="height: 120px; width: 240px; position: relative;" src="{!! asset('/img/pattern8.jpg') !!}" alt="..." />
                    <div class = "row">
                        <div class = "col s6">
                            <img class = "responsive-img circle" id="image2" style="position: absolute; top: 23px; left: 15px; width: 70px; height: 70px;" src="{!! asset('/img/Ken Layug.jpg') !!}" alt="..." />
                        </div>
                        <div class = "col s6">
                            <p style="position: absolute; top: 0px; font-size: 18px; padding-left: 100px; width: 220px; font-weight: bold;">Ken Layug</p>
                            <p style="position: absolute; top: 0px; font-size: 18px; padding-top: 25px; padding-left: 90px; width: 220px; font-weight: bold;">Administrator</p>
                        </div>
                    </div>
                </div>

                <ul class="collapsible collapsible-accordion">
                    <li>
                        <div class="collapsible-header @{{ maintenanceActive }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">settings</i>MAINTENANCE</div>
                        <div class="collapsible-body">
                            <ul>
                                <li class="@{{ interestActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/interest-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">INTEREST</h6></a></li>
                                <li class="@{{ buildingActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/building-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">BUILDING</h6></a></li>
                                <li class="@{{ roomActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/room-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ROOM</h6></a></li>
                                <li class="@{{ blockActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/block-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">BLOCK</h6></a></li>
                                <li class="@{{ priceActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/price-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT PRICE</h6></a></li>
                                <li class="@{{ additionalActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/additional-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ADDITIONALS</h6></a></li>
                                <li class="@{{ requirementActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/requirement-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">REQUIREMENT</h6></a></li>
                                <li class="@{{ serviceActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/service-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SERVICES</h6></a></li>
                                <li class="@{{ packageActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/package-maintenance') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">PACKAGE</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header @{{ transactionActive }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px;font-family: roboto2;"><i class="material-icons">work</i>TRANSACTION</div>
                        <div class="collapsible-body">
                            <ul>
                                <li class="@{{ unitPurchaseActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT PURCHASES</h6></a></li>
                                <li class="@{{ collectionActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/collection-downpayment-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">COLLECTION AND DOWNPAYMENT</h6></a></li>
                                <li class="@{{ manageUnitActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/manage-unit-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">MANAGE UNIT</h6></a></li>
                                <li class="@{{ servicePurchaseActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/service-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SERVICE PURCHASES</h6></a></li>
                                <li class="@{{ assignSchedActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/assign-schedule-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ASSIGN SCHEDULE</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">description</i>QUERIES</div>
                        <div class="collapsible-body">
                            <ul>
                                <li class="@{{ unitPurchaseActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT PURCHASES</h6></a></li>
                                <li class="@{{ collectionActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/collection-downpayment-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">COLLECTION AND DOWNPAYMENT</h6></a></li>
                                <li class="@{{ manageUnitActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/manage-unit-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">MANAGE UNIT</h6></a></li>
                                <li class="@{{ servicePurchaseActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/service-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SERVICE PURCHASES</h6></a></li>
                                <li class="@{{ assignSchedActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/assign-schedule-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ASSIGN SCHEDULE</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">web</i>REPORTS</div>
                        <div class="collapsible-body">
                            <ul>
                                <li class="@{{ unitPurchaseActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT PURCHASES</h6></a></li>
                                <li class="@{{ collectionActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/collection-downpayment-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">COLLECTION AND DOWNPAYMENT</h6></a></li>
                                <li class="@{{ manageUnitActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/manage-unit-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">MANAGE UNIT</h6></a></li>
                                <li class="@{{ servicePurchaseActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/service-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">SERVICE PURCHASES</h6></a></li>
                                <li class="@{{ assignSchedActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/assign-schedule-transaction') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">ASSIGN SCHEDULE</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header @{{ utilityActive }}" style = "margin-left: 0px; width: 100%; font-size: 16px; padding-left: 20px; font-family: roboto2;"><i class="material-icons">phonelink_setup</i>UTILITIES</div>
                        <div class="collapsible-body">
                            <ul>
                                <li class="@{{ businessDependencyActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/business-dependency-utility') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">BUSINESS DEPENDENCIES</h6></a></li>
                                <li class="@{{ collectionActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/employee-utility') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">EMPLOYEE</h6></a></li>
                                <li class="@{{ manageUnitActive }}" style = "margin-top: -8px; max-height: 40px;"><a style = "padding-left: 60px; margin-left: 0px; width: 100%;" href="{!! url('/unit-servicing-utility') !!}"><h6 style = "font-size: 15px; font-family: roboto2; padding-top: 10px;">UNIT SERVICING</h6></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </nav>
            <a href="#" data-activates="slide-out-l" class="button-collapse show-on-large"><i class="material-icons">reorder</i></a>

            <ul class="right" id="nav" style="">
                <li id="notification_li" style="margin-right: 30px;">
                    <span id="notification_count">3</span>
                    <a href="#" id="notificationLink"><i class="material-icons show-on-large" style="color: white;">add_alert</i></a>
                    <div id="notificationContainer">
                        <div id="notificationTitle"style="color: black;">Notifications</div>
                        <div id="notificationsBody" class="notifications" style="color: black; overflow: auto"></div>
                        <div id="notificationFooter">

                            <a href="#" class="seeAll" style="color: rgba(180, 102, 0, 0.99);">See All</a>
                        </div>
                    </div>
                </li>
            </ul>

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