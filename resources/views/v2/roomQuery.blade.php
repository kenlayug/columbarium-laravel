@extends('v2.baseLayout')
@section('title', 'Room Query')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/queries/controller.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('/css/queries.css') !!}">

<div ng-controller='ctrl.queries'>


	<center><h4 style="font-family: myFirstFont; color: #000000; padding-top: 20px;">QUERIES</h4></center><br>
	
<hr>
<!-- Room-->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select material-select watch>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Armin</option>
            <option value="2">Erwim</option>
            <option value="3">Levi</option>
            <option value="4">Mikasa</option>
          </select>
          <label>Building Name</label>
        </div>
        <div class="row" style="margin-top: -30px;">
          <label style="margin-top: 80px;">Room Type:</label><br>
          <p>
              <input type="checkbox" id="cv"/>
              <label for="cv" style="padding-right: 10px;">Columbary Vaults</label><br>
              <input type="checkbox" id="fc"/>
              <label for="fc" style="padding-right: 10px;">Fullbody Crypts</label><br>
              <input type="checkbox" id="office"/>
              <label for="office" style="padding-right: 10px;">Office</label><br>
              <input type="checkbox" id="cashier"/>
              <label for="cashier" style="padding-right: 10px;">Cashier</label><br>
          </p>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Room</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableRoom">
            <thead>
              <tr>
                <th>Name</th>
                <th>No. of Blocks</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Armin</td>
                <td>3</td>
                <td>Fullbody, Columbary</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>3</td>
                <td>Fullbody, Columbary</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>3</td>
                <td>Fullbody, Columbary</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
<!-- Room -->
<hr>

</div>
@endsection