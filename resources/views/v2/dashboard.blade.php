@extends('v2.baseLayout')
@section('title', 'Dashboard')
@section('body')

    <script type="text/javascript" src="{!! asset('/js/highcharts.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/exporting.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/dashboard.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/highcharts-3d.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/solid-gauge.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/highcharts-more.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/sparkleline.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/chart.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/chart-min.js') !!}"></script>



<!--start container-->
<div class="container">
    <div class="section">

        <!--chart dashboard start-->

        <div id="chart-dashboard" class="seaction" style = "margin-top: -20px;">
            <div class="row">
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
                            <span class="card-title activator grey-text text-darken-4 center" style = "font-family: roboto2; font-size: 1.5vw">System Profile</span><br>
                            <i class="material-icons teal-text text-darken-2">info</i><span style = "vertical-align: 6px;">Columbarium and Crematorium &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Management System</span><br>
                            <i class="material-icons teal-text text-darken-2" style = "margin-top: 10px;">phone</i><span style = "vertical-align: 6px;">09254789613</span><br>
                            <i class="material-icons teal-text text-darken-2" style = "margin-top: 10px;">email</i><span style = "vertical-align: 6px;">columbarium@gmail.com</span><br>
                            <i class="material-icons teal-text text-darken-2" style = "margin-top: 10px;">room</i><span style = "vertical-align: 6px;">Sta. Mesa, Manila</span>

                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Roger Waters <i class="mdi-navigation-close right"></i></span>
                            <p>Here is some more information about this card.</p>
                            <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Project Manager</p>
                            <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                            <p><i class="mdi-communication-email cyan-text text-darken-2"></i> mail@domain.com</p>
                            <p><i class="mdi-social-cake cyan-text text-darken-2"></i> 18th June 1990</p>
                            <p><i class="mdi-device-airplanemode-on cyan-text text-darken-2"></i> BAR - AUS</p>
                        </div>
                    </div>
                </div>

                <div class="col s5 m4 l4">
                    <div class="card">
                        <div class="card-move-up waves-effect waves-block waves-light">
                            <div class="move-up blue-grey darken-1">
                                <div style = "margin-top: -20px;">
                                    <span class="chart-title white-text">Revenue</span>
                                </div>
                                <div id="3dColumn" style="margin-left: -20px; width: 422px; height: 250px"></div>
                            </div>
                        </div>
                        <div class="card-content" style = "margin-top: -6px;">
                            <a class="btn-floating btn-move-up waves-effect red right"><i class="material-icons activator">add</i></a>
                            <div class="col s12 m8 l8" style = "height: 90px;">
                                <span id="pieChart">&nbsp;</span>
                                <span id="pieChart2">&nbsp;</span>
                                <canvas id="canvas"></canvas>
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

                <div class="col s12 m4 l5">
                    <div class="card">
                        <div class="card-move-up teal waves-effect waves-block waves-light">
                            <div class="move-up" style = "margin-top: -10px;">
                                <div id="donut3D" style="width: 530px; height: 315px; margin-left: -20px; margin-bottom: -20px; margin-top: -20px;"></div>
                            </div>
                        </div>
                        <div class="card-content  teal darken-2" style = "margin-top: -60px;">
                            <a class="btn-floating btn-move-up waves-effect red right" style = "margin-top: 50px;"><i class="material-icons activator">add</i></a>
                            <h4 style = "padding-top: 40px; font-family: roboto2; font-size: 1.5vw; color: white;">Daily Sales
                                <span class="inlinebar3" style = "margin-top: -50px;">4,6,8,9,10,9,9,9,9,6,8,8,8,8,10,10,10,9,9,9,9,10,7,5,4,7,7,7,7,8,8,9,10,10,1</span>
                            </h4>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Revenue by country <i class="mdi-navigation-close right"></i></span>
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th data-field="country-name">Country Name</th>
                                    <th data-field="item-sold">Item Sold</th>
                                    <th data-field="total-profit">Total Profit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>USA</td>
                                    <td>65</td>
                                    <td>$452.55</td>
                                </tr>
                                <tr>
                                    <td>UK</td>
                                    <td>76</td>
                                    <td>$452.55</td>
                                </tr>
                                <tr>
                                    <td>Canada</td>
                                    <td>65</td>
                                    <td>$452.55</td>
                                </tr>
                                <tr>
                                    <td>Brazil</td>
                                    <td>76</td>
                                    <td>$452.55</td>
                                </tr>
                                <tr>

                                    <td>India</td>
                                    <td>65</td>
                                    <td>$452.55</td>
                                </tr>
                                <tr>
                                    <td>France</td>
                                    <td>76</td>
                                    <td>$452.55</td>
                                </tr>
                                <tr>
                                    <td>Austrelia</td>
                                    <td>65</td>
                                    <td>$452.55</td>
                                </tr>
                                <tr>
                                    <td>Russia</td>
                                    <td>76</td>
                                    <td>$452.55</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--card stats start-->
        <div id="card-stats" class="seaction"  style = "margin-top: -20px;">
            <div class="row">
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content  green white-text">
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">view_module</i><span style = "font-size: 1.5vw; vertical-align: 6px;">Units</span>
                            <h4 class="card-stats-number">266</h4>
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">trending_up</i><span style = "font-size: 1vw; vertical-align: 6px;">15% from yesterday</span>
                            </p>
                        </div>
                        <div class="card-action  green darken-2">
                            <span class="inlinebar">4,7,5,2,6,3,7,5,4,1,6,3,4,5,7,3,5,2,6,7</span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content purple white-text">
                            <p class="card-stats-title"><i class="mdi-editor-attach-money"></i>Total Sales</p>
                            <h4 class="card-stats-number">P 8990.63</h4>
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">trending_up</i><span style = "font-size: 1vw; vertical-align: 6px;">70% from yesterday</span>
                            </p>
                        </div>
                        <div class="card-action purple darken-2">
                                <span class="inlinesparkline">1,2,4,6,8,9,10,9,9,9,9,6,8,8,8,8,10,10,10,9,9,9,9,10,7,5,4,7,7,7,7,8,8,9,10,10,10,12,12,12,12,12,12,8,7,5,5,5,5,5,5,9,9,9,9,10,10,10,10,8,8,8,8,7,5,5,9,9,9,12,12,12,14,14,14,15,12,13,15,8,8,8,7,7,7,7,5,6,5,4,3,1</span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content blue-grey white-text">
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">work</i><span style = "font-size: 1.5vw; vertical-align: 6px;">Transactions</span>
                            <h4 class="card-stats-number">124</h4>
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">trending_up</i><span style = "font-size: 1vw; vertical-align: 6px;">80% from yesterday</span>
                            </p>
                        </div>
                        <div class="card-action blue-grey darken-2">
                            <span class="inlinebar2">4,6,8,9,10,9,9,9,9,6,8,8,8,8,10,10,10,9,9,9,9,10,7,5,4,7,7,7,7,8,8,9,10,10,1</span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content deep-purple white-text">
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">perm_identity</i><span style = "font-size: 1.5vw; vertical-align: 6px;">New Customer</span>
                            <h4 class="card-stats-number">56</h4>
                            <i class="material-icons white-text text-darken-2" style = "margin-top: 10px;">trending_down</i><span style = "font-size: 1vw; vertical-align: 6px;">3% from last month</span>
                            </p>
                        </div>
                        <div class="card-action  deep-purple darken-2">
                            <span class="inlinesparkline2">1,2,4,6,8,9,10,9,9,9,9,6,8,8,8,8,10,10,10,9,9,9,9,10,7,5,4,7,7,7,7,8,8,9,10,10,10,12,12,12,12,12,12,8,7,5,5,5,5,5,5,9,9,9,9,10,10,10,10,8,8,8,8,7,5,5,9,9,9,12,12,12,14,14,14,15,12,13,15,8,8,8,7,7,7,7,5,6,5,4,3,1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--card widgets start-->
        <div id="card-widgets">
            <div class="row">

                <div class="col s12 m12 l4">
                    <ul id="task-card" class="collection with-header">
                        <li class="collection-header teal">
                            <h4 class="task-card-title">List of Schedule</h4>
                            <p class="task-card-date">July 16, 2015</p>
                        </li>
                        <li class="collection-item dismissable">
                            <input type="checkbox" class = "filled-in" id="task1" />
                            <label for="task1">Cremation<a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                            </label>
                            <span class="task-cat teal">10:00 AM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <input type="checkbox" class = "filled-in" id="task2" />
                            <label for="task2">Internment<a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                            </label>
                            <span class="task-cat purple">11:30 AM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <input type="checkbox" class = "filled-in" id="task3" checked="checked" />
                            <label for="task3">Candle Holder Installation<a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                            </label>
                            <span class="task-cat pink">3:00 PM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <input type="checkbox" class = "filled-in" id="task4" checked="checked" disabled="disabled" />
                            <label for="task4"><strike>Urn Engraving</strike><a href="#" class="secondary-content"><span class="ultra-small">Done</span></a>
                            </label>
                            <span class="task-cat cyan">4:30 PM</span>
                        </li>
                    </ul>
                </div>

                        <div class="col s12 m12 l4">
                            <ul id="projects-collection" class="collection">
                                <li class="collection-item avatar">
                                    <i class="mdi-file-folder circle light-blue darken-2"></i>
                                    <span class="collection-header">Projects</span>
                                    <p>Your Favorites</p>
                                    <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                                </li>
                                <li class="collection-item">
                                    <div class="row">
                                        <div class="col s6">
                                            <p class="collections-title">Web App</p>
                                            <p class="collections-content">AEC Company</p>
                                        </div>
                                        <div class="col s6">
                                            <span class="task-cat cyan">Development</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="collection-item">
                                    <div class="row">
                                        <div class="col s6">
                                            <p class="collections-title">Mobile App for Social</p>
                                            <p class="collections-content">iSocial App</p>
                                        </div>
                                        <div class="col s6">
                                            <span class="task-cat grey darken-3">UI/UX</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="collection-item">
                                    <div class="row">
                                        <div class="col s6">
                                            <p class="collections-title">Website</p>
                                            <p class="collections-content">MediTab</p>
                                        </div>
                                        <div class="col s6">
                                            <span class="task-cat teal">Marketing</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="collection-item">
                                    <div class="row">
                                        <div class="col s6">
                                            <p class="collections-title">AdWord campaign</p>
                                            <p class="collections-content">True Line</p>
                                        </div>
                                        <div class="col s6">
                                            <span class="task-cat green">SEO</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                <div class="col s12 m12 l4">
                    <ul id="task-card" class="collection with-header">
                        <li class="collection-header teal">
                            <h4 class="task-card-title">List of Schedule</h4>
                            <p class="task-card-date">July 16, 2015</p>
                        </li>
                        <li class="collection-item dismissable">
                            <input type="checkbox" class = "filled-in" id="task1" />
                            <label for="task1">Cremation<a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                            </label>
                            <span class="task-cat teal">10:00 AM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <input type="checkbox" class = "filled-in" id="task2" />
                            <label for="task2">Internment<a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                            </label>
                            <span class="task-cat purple">11:30 AM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <input type="checkbox" class = "filled-in" id="task3" checked="checked" />
                            <label for="task3">Candle Holder Installation<a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                            </label>
                            <span class="task-cat pink">3:00 PM</span>
                        </li>
                        <li class="collection-item dismissable">
                            <input type="checkbox" class = "filled-in" id="task4" checked="checked" disabled="disabled" />
                            <label for="task4"><strike>Urn Engraving</strike><a href="#" class="secondary-content"><span class="ultra-small">Done</span></a>
                            </label>
                            <span class="task-cat cyan">4:30 PM</span>
                        </li>
                    </ul>
                </div>
             </div>
        </div>

@endsection