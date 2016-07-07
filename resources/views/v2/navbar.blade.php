<link rel = "stylesheet" href = "{!! asset('/css/sidenav-hamburger.css') !!}"/>


<div class="navbar-fixed nav-leo">
    <nav>
        <div class="nav-wrapper">


            <a href="#" class="brand-logo center" style = "font-size: 2.5vw; font-family: myFirstFont1;">Columbarium and Crematorium Management System</a>

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
                        <div class="collapsible-header" style = "padding-left: 0px; font-family: myFirstFont2;"><i class="material-icons">settings</i>Maintenance</div>
                        <div class="collapsible-body">
                            <ul>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/interest-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Interest</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/building-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Building</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/room-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Room</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/block-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Block</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/price-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Unit Price</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/additional-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Additional</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/requirement-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Requirement</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/service-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Services</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/package-maintenance') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Package</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header" style = "padding-left: 0px;font-family: myFirstFont2;"><i class="material-icons">work</i>Transaction</div>
                        <div class="collapsible-body">
                            <ul>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/unit-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Unit Purchases</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/collection-downpayment-transaction') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Collection and Downpayment</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/manage-unit-transaction') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Manage Unit</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/service-purchase-transaction') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Service Purchases</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href="{!! url('/assign-schedule-transaction') !!}"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Assign Schedule</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header" style = "padding-left: 0px; font-family: myFirstFont2;"><i class="material-icons">settings</i>Queries</div>
                        <div class="collapsible-body">
                            <ul>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Additionals</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Services</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Requirements</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Packages</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Buildings</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Floors</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Blocks</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Units</h6></a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header" style = "padding-left: 0px; font-family: myFirstFont2;"><i class="material-icons">web</i>Reports</div>
                        <div class="collapsible-body">
                            <ul>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Service Reports</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Scheduling Reports</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Manage Reports</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Collection Reports</h6></a></li>
                                <li style = "margin-top: -8px; max-height: 40px;"><a href = "#!"><h6 style = "font-size: 15px; font-family: myFirstFont2; padding-top: 10px;">Notification Reports</h6></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </nav>
            <a href="#" data-activates="slide-out-l" class="button-collapse show-on-large"><i class="material-icons">reorder</i></a>

            <ul class="right" id="nav" style="">
                <li id="notification_li" style="margin-right: 30px;">
                    <span id="notification_count">3</span>
                    <a href="#" id="notificationLink"><i class="material-icons show-on-large" style="color: white;">textsms</i></a>
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