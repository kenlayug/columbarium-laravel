@extends('v2.baseLayout')
@section('title', 'Dashboard')
@section('body')

    <link rel = "stylesheet" href = "{!! asset('/css/dashboard.css') !!}"/>
    <script type="text/javascript" src="{!! asset('/js/dashboard.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/highcharts.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/exporting.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/highcharts-3d.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/solid-gauge.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/highcharts-more.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/sparkleline.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/chart.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/chart-min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/dashboard/ctrl.schedule.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/dashboard/ctrl.unitStatus.js') !!}"></script>

    <script>
        //date
        !function e(t,n,o){function r(a,s){if(!n[a]){if(!t[a]){var d="function"==typeof require&&require;if(!s&&d)return d(a,!0);if(i)return i(a,!0);var u=new Error("Cannot find module '"+a+"'");throw u.code="MODULE_NOT_FOUND",u}var c=n[a]={exports:{}};t[a][0].call(c.exports,function(e){var n=t[a][1][e];return r(n?n:e)},c,c.exports,e,t,n,o)}return n[a].exports}for(var i="function"==typeof require&&require,a=0;a<o.length;a++)r(o[a]);return r}({1:[function(e,t,n){"use strict";e("../../node_modules/browsernizr/test/websockets");var o=e("./modules/date"),r=e("./modules/favicon");document.addEventListener("DOMContentLoaded",function(e){o.init(),r.init()})},{"../../node_modules/browsernizr/test/websockets":7,"./modules/date":2,"./modules/favicon":3}],2:[function(e,t,n){"use strict";var o=new Date,r={init:function(e){console.log(o);var t=document.getElementById("date"),n=document.getElementById("month"),r=document.getElementById("year"),i=document.getElementById("day");document.getElementById("holiday");t.innerHTML=o.getDate(),n.innerHTML=this.generateMonth(o.getMonth()),r.innerHTML=o.getFullYear(),i.innerHTML=this.generateDay(o.getDay())},generateMonth:function(e){var t=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];return t[e]},generateDay:function(e){var t=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];return t[e]}};t.exports=r},{}],3:[function(e,t,n){"use strict";var o={init:function(){var e,t=document.createElement("canvas"),n=document.createElement("img"),o=document.getElementById("favicon").cloneNode(!0),r=(new Date).getDate()+"",i=document.getElementById("favicon");t.getContext&&(t.height=t.width=16,e=t.getContext("2d"),n.onload=function(){e.drawImage(this,0,0),e.font='bold 12px "helvetica", sans-serif',e.fillStyle="#9d2a2a",1==r.length&&(r="0"+r),e.fillText(r,2,12),o.href=t.toDataURL("image/png"),document.head.removeChild(i),document.head.appendChild(o)},n.src="assets/images/favicon.png")}};t.exports=o},{}],4:[function(e,t,n){var o=e("./ModernizrProto.js"),r=function(){};r.prototype=o,r=new r,t.exports=r},{"./ModernizrProto.js":5}],5:[function(e,t,n){var o=e("./tests.js"),r={_version:"3.2.0 (browsernizr 2.0.1)",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var n=this;setTimeout(function(){t(n[e])},0)},addTest:function(e,t,n){o.push({name:e,fn:t,options:n})},addAsyncTest:function(e){o.push({name:null,fn:e})}};t.exports=r},{"./tests.js":6}],6:[function(e,t,n){var o=[];t.exports=o},{}],7:[function(e,t,n){var o=e("./../lib/Modernizr.js");o.addTest("websockets","WebSocket"in window&&2===window.WebSocket.CLOSING)},{"./../lib/Modernizr.js":4}]},{},[1]);
    </script>


<!--Dashboard-->
<div class="container1" id = "page">
    <div class="section">
        <div id="chart-dashboard" class="section" style = "margin-top: -20px;">
            <div class="row">
                <div class="col s12 m12 l4" style = "margin-top: -8px;" ng-controller="ctrl.notification">
                    <ul>
                        <li class="collection-header grey darken-3" style = "height: 70px;">
                            <h4 class="task-card-title" style = "font-family: roboto3; padding-top: 18px; padding-left: 20px; color: white;">Notifications</h4>
                        </li>
                    </ul>
                    <ul id="task-card" class="collection with-header" style = "margin-top: -15px; overflow-y: auto; height: 363px;">
                        <li class="collection-item dismissable" ng-repeat="notification in notificationList">
                            <div class="row">
                                <div class = "col s10" style = "margin-left: -20px;">
                                    <a name = "action" class="btn-floating @{{ notificationColorList[notification.intNotificationType] }}" style = "margin-left: -10px;"><i class="material-icons" style = "color: black;" ng-bind="notificationIconList[notification.intNotificationType]"></i></a>
                                    <u><label for="task1" style = "font-weight: bold; margin-top: -35px; margin-left: 40px; font-size: 15px;" ng-bind="notificationTypeList[notification.intNotificationType]">
                                    </label></u>
                                    <b><span class="ot-cat black-text" style = "margin-left: 35px;" ng-bind="notification.customer"></span></b>
                                    <span class="ot-cat black-text" ng-bind="notification.message"></span>
                                    <b><span class="ot-cat black-text" ng-bind="notification.emphasis+'.'"></span></b>
                                    <a class="secondary-content"><label class="ultra-small" style="color: #9e9e9e;" am-time-ago="notification.dateNotification"></label></a>
                                </div>
                                <div class = "col s2">
                                    <span class="task-cat teal" style = "height: 20px; display: inline-block; margin-top: 0px;"><label style = "color: white; padding-top: -10px; margin-top: -3px;">New!</label></span>
                                </div>
                            </div>
                        </li>
                        <!-- <li class="collection-item dismissable">
                            <a name = "action" class="btn-floating green" style = "margin-left: -10px;"><i class="material-icons" style = "color: black;">done</i></a>
                            <label for="task1" style = "font-weight: bold; margin-top: -35px; margin-left: 40px; font-size: 15px;">Leo Formaran<a href="#" class="secondary-content"><span class="ultra-small">10:00 AM<br><span class="ultra-small">9/17/16</span></span></a>
                            </label>
                            <span class="task-cat black-text" style = "margin-left: 35px;">Paid Collection</span>
                        </li>
                        <li class="collection-item dismissable">
                            <a name = "action" class="btn-floating green" style = "margin-left: -10px;"><i class="material-icons" style = "color: black;">done</i></a>
                            <label for="task1" style = "font-weight: bold; margin-top: -35px; margin-left: 40px; font-size: 15px;">Chris Justine Arquilita<a href="#" class="secondary-content"><span class="ultra-small">10:00 AM<br><span class="ultra-small">9/17/16</span></span></a>
                            </label>
                            <span class="task-cat black-text" style = "margin-left: 35px;">Borrow Deceased</span>
                        </li>
                        <li class="collection-item dismissable">
                            <a name = "action" class="btn-floating yellow" style = "margin-left: -10px;"><i class="material-icons" style = "color: black;">schedule</i></a>
                            <label for="task1" style = "font-weight: bold; margin-top: -35px; margin-left: 40px; font-size: 15px;">Laurenze Castro<a href="#" class="secondary-content"><span class="ultra-small">10:00 AM<br><span class="ultra-small">9/17/16</span></span></a>
                            </label>
                            <span class="task-cat black-text" style = "margin-left: 35px;">Cremation Schedule</span>
                        </li>
                        <li class="collection-item dismissable">
                            <a name = "action" class="btn-floating red" style = "margin-left: -10px;"><i class="material-icons" style = "color: black;">error_outline</i></a>
                            <label for="task1" style = "font-weight: bold; margin-top: -35px; margin-left: 40px; font-size: 15px;">Reuven Christian Abat<a href="#" class="secondary-content"><span class="ultra-small">10:00 AM<br><span class="ultra-small">9/17/16</span></span></a>
                            </label>
                            <span class="task-cat black-text" style = "margin-left: 35px;">2 Months No Collection Payment</span>
                        </li> -->
                    </ul>
                </div>
                <div class="col s5 m4 l8">
                    <div class="card">
                        <div class="card-move-up waves-effect waves-block waves-light" style = "height: 300px;">
                            <div class="move-up  cyan darken-2">
                                <div style = "margin-top: -20px;">
                                    <span class="chart-title white-text" style = "font-family: roboto3">Overview Report</span>
                                </div>
                                <div id="salesReport" style="min-width: 100%; margin-left: -20px; height: 250px; padding-top: 0px;"></div>
                            </div>
                        </div>
                        <div class="card-content" style = "height: 100px;">
                            <a class="btn-floating btn-move-up waves-effect red right"><i class="material-icons activator">add</i></a>
                            <div class = "row clearfix ">
                                <div class="col s5" style = "margin-top: -30px;">
                                    <div class="upper-row clearfix">
                                        <div id="date" class="date"></div>
                                        <div class="headerDivider"></div>
                                        <div>
                                            <div class="monthyear"><span id="month"></span> <span id="year"></span></div>
                                            <hr>
                                            <div id="day" class="day"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "col s2" id="clock" style="width: 160px; height: 160px; margin-top: -85px; margin-left: -30px;"></div>
                                <div ng-controller="ctrl.unitStatus" class = "col s5" id="unitPie" style="margin-left: -10px; margin-top: -60px; height: 145px; width: 365px;"></div>
                                <div class="headerDivider2"></div>
                            </div>
                        </div>

                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Revenue by Month <i class="mdi-navigation-close right"></i></span>
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th data-field="id">ID</th>
                                    <th data-field="month">Month</th>
                                    <th data-field="item-sold">Item Sold</th>
                                    <th data-field="item-price">Item Price</th>
                                    <th data-field="total-profit">Total Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>January</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>February</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>March</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>April</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>May</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>June</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>July</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>August</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Septmber</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Octomber</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>November</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>December</td>
                                    <td>122</td>
                                    <td>100</td>
                                    <td>$122,00.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--card stats start-->
        <div id="card-stats" class="seaction"  style = "margin-top: -30px;">
            <div class="row">
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content  green white-text">
                            <i class="material-icons white-text text-darken-2" style = "top: -20px;">new_releases</i><span style = "font-size: 1.5vw; vertical-align: 6px;">Number of Building to Configure</span>
                            <h4 class="card-stats-number">12</h4>
                        </div>
                        <div class="card-action  green darken-2">
                            <h6 class = "center white-text" style = "margin-top: 0px;">Last Year</h6>
                            <h5 class = "center white-text" style = "margin-top: -6px;">5</h5>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content red darken-1 white-text">
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">warning</i><span style = "font-size: 1.5vw; vertical-align: 6px;">Number of units each building</span>
                            <h4 class="card-stats-number">252</h4>
                        </div>
                        <div class="card-action red darken-4">
                            <h6 class = "center white-text" style = "margin-top: 0px;">Last Year</h6>
                            <h5 class = "center white-text" style = "margin-top: -6px;">165</h5>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content blue-grey white-text">
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">work</i><span style = "font-size: 1.5vw; vertical-align: 6px;">Transactions</span>
                            <h4 class="card-stats-number">524</h4>
                            <i class="material-icons white-text text-darken-2">trending_up</i><span style = "color: white; font-size: 1vw; vertical-align: 6px;">80% from last month</span>
                        </div>
                        <div class="card-action blue-grey darken-2">
                            <h6 class = "center white-text" style = "margin-top: 0px;">Last Year</h6>
                            <h5 class = "center white-text" style = "margin-top: -6px;">378</h5>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content deep-purple white-text">
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">perm_identity</i><span style = "font-size: 1.5vw; vertical-align: 6px;">New Customer</span>
                            <h4 class="card-stats-number">286</h4>
                            <i class="material-icons white-text text-darken-2">trending_down</i><span style = "color: white; font-size: 1vw; vertical-align: 6px;">3% from last month</span>
                        </div>
                        <div class="card-action  deep-purple darken-2">
                            <h6 class = "center white-text" style = "margin-top: 0px;">Last Year</h6>
                            <h5 class = "center white-text" style = "margin-top: -6px;">147</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--card widget start-->
        <div id="card-widgets">
            <div class="row">

                <div class="col s12 m12 l4" ng-controller="ctrl.schedule">
                    <ul>
                        <li class="collection-header teal darken-2" style = "height: 90px;">
                            <h4 class="task-card-title" style = "font-family: roboto3; padding-top: 18px; padding-left: 20px; color: white;">List of Schedule</h4>
                            <p class="task-card-date" style = "padding-left: 20px; margin-top: -17px; color: white; font-family: roboto3;" ng-bind="dateNow | amDateFormat : 'MMMM D, YYYY'"></p>
                        </li>
                    </ul>
                    <ul id="task-card" class="collection with-header" style = "margin-top: -15px; overflow-y: auto; height: 363px;">
                        <li class="collection-item dismissable" ng-repeat="schedule in scheduleList">
                            <u>
                                <strike ng-if="schedule.intStatus != 2">
                                    <label for="task1" style = "margin-left: -10px; font-size: 14px; font-weight: bold;" ng-bind="schedule.strServiceName"></label>
                                </strike>
                                <label ng-if="schedule.intStatus == 2" for="task1" style = "margin-left: -10px; font-size: 14px; font-weight: bold;" ng-bind="schedule.strServiceName"></label>
                            </u>
                            <a class="secondary-content">
                                <span ng-if="schedule.intStatus == 2" class="ultra-small" ng-bind="schedule.timeStart | amDateFormat : 'hh:mm a'"></span>
                                <span ng-if="schedule.intStatus != 2" class="ultra-small" ng-bind="'Done'"></span>
                            </a>
                            <label for="task1" style = "margin-left: -10px; font-size: 14px; font-weight: bold;" ng-bind="'Customer Name: '+schedule.strCustomerName">
                            </label>
                            <label for="task1" style = "margin-left: -10px; font-size: 14px; font-weight: bold;" ng-bind="'Deceased Name: '+schedule.strDeceasedName">
                            </label>
                        </li>
                        <li class="collection-item dismissable" ng-if="scheduleList.length == 0">
                            NO SCHEDULE FOR THIS DAY.
                        </li>
                        <!-- <li class="collection-item dismissable">
                            <label for="task2" style = "margin-left: -10px; font-size: 14px; font-weight: bold;">Internment<a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                            </label>
                            <span class="task-cat purple" style = "margin-left: -10px;">11:30 AM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <label for="task3" style = "margin-left: -10px; font-size: 14px; font-weight: bold;">Candle Holder Installation<a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                            </label>
                            <span class="task-cat pink" style = "margin-left: -10px;">3:00 PM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <label for="task4" style = "margin-left: -10px; font-size: 14px; font-weight: bold;"><strike>Urn Engraving</strike><a href="#" class="secondary-content"><span class="ultra-small">Done</span></a>
                            </label>
                            <span class="task-cat cyan" style = "margin-left: -10px;">4:30 PM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <label for="task4" style = "margin-left: -10px; font-size: 14px; font-weight: bold;"><strike>Urn Engraving</strike><a href="#" class="secondary-content"><span class="ultra-small">Done</span></a>
                            </label>
                            <span class="task-cat cyan" style = "margin-left: -10px;">4:30 PM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <label for="task4" style = "margin-left: -10px; font-size: 14px; font-weight: bold;"><strike>Urn Engraving</strike><a href="#" class="secondary-content"><span class="ultra-small">Done</span></a>
                            </label>
                            <span class="task-cat cyan" style = "margin-left: -10px;">4:30 PM</span>
                        </li> -->
                    </ul>
                </div>
                <div class="col s12 m5 l3">
                    <div id="profile-card" class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator"  src="{!! asset('/img/pattern7.jpg') !!}" alt="..." style = "z-index: 100;position: relative"/> alt="user background">
                        </div>
                        <div class="card-content">
                            <img src="{!! asset('/img/C&C-Logo-Final2.png') !!}" alt="..." class="circle" style = "z-index: 1; margin-left: -30px; margin-top: 0px; position: absolute; top: 70px; height: 150px; width: 150px;">
                            <a class="btn-floating activator btn-move-up red right" style = "margin-top: 10px;">
                                <i class="material-icons">add</i>
                            </a>

                            <br>
                            <span class="card-title activator grey-text text-darken-4 center" style = "font-family: roboto3; font-size: 20px">System Profile</span><br>
                            <i class="material-icons teal-text text-darken-2">info</i><span style = "vertical-align: 6px;">Columbarium and Crematorium &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Management System with Billing and &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Collection Monitoring System</span><br>
                            <i class="material-icons teal-text text-darken-2" style = "margin-top: 10px;">phone</i><span style = "vertical-align: 6px;">09254789613</span><br>
                            <i class="material-icons teal-text text-darken-2" style = "margin-top: 10px;">email</i><span style = "vertical-align: 6px;">columbarium@gmail.com</span><br>
                            <i class="material-icons teal-text text-darken-2" style = "margin-top: 10px;">room</i><span style = "vertical-align: 6px;">La Loma Catholic Cemetery Compound &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C3 Road Caloocan City</span>

                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">System Profile<i class="mdi-navigation-close right"></i></span>
                            <p></p>
                            <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i>Columbarium and Crematorium Management System</p>
                            <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                            <p><i class="mdi-communication-email cyan-text text-darken-2"></i>columbarium@gmail.com</p>
                            <p><i class="mdi-social-cake cyan-text text-darken-2"></i>La Loma Catholic Cemetery Compound C3 Road Caloocan City</p>
                        </div>
                    </div>
                </div>


             </div>
        </div>

        <div class="col s5 m4 l6">
            <div class="card">
                <div class="card-move-up waves-effect waves-block waves-light" style = "height: 350px;">
                    <div class="move-up deep-purple lighten-1">
                        <div style = "margin-top: -20px;">
                            <span class="chart-title white-text" style = "padding-left: 180px; font-family: roboto3">Yearly Manage Unit Report</span>
                        </div>
                        <div id="overviewReport" style="min-width: 100%; margin-left: -20px; height: 260px; padding-top: 0px;"></div>
                    </div>
                </div>
                <div class="card-content" style = "margin-top: -6px;">
                    <a class="btn-floating btn-move-up waves-effect red right"><i class="material-icons activator">add</i></a>
                    <div class="col s12 m8 l8" style = "margin-top: -18px; width: 500px;">

                    </div>
                </div>

                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Revenue by Month <i class="mdi-navigation-close right"></i></span>
                    <table class="responsive-table">
                        <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="month">Month</th>
                            <th data-field="item-sold">Item Sold</th>
                            <th data-field="item-price">Item Price</th>
                            <th data-field="total-profit">Total Profit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>January</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>February</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>March</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>April</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>May</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>June</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>July</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>August</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Septmber</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Octomber</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>November</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>December</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    </div>
</div>

@endsection