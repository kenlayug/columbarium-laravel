@extends('v2.baseLayout')
@section('title', 'Queries')
@section('body')

<script type="text/javascript" src="{!! asset('/js/queries.js') !!}"></script>
	<script type="text/javascript">
    	$(document).ready(function() {
    	$('select').material_select();
  		});
	</script>
	<style type="text/css">
		hr{
			border-top: 1px solid #8c8b8b;
			text-align: center;
		}
		hr:after {
			content: ':)';
			display: inline-block;
			position: relative;
			top: -14px;
			padding: 0 10px;
			background: #f0f0f0;
			color: #8c8b8b;
			font-size: 18px;
			-webkit-transform: rotate(60deg);
			-moz-transform: rotate(60deg);
			transform: rotate(60deg);
		}
	</style>


	<center><h4 style="font-family: myFirstFont; color: #000000; padding-top: 20px;">QUERIES</h4></center><br>
	
	<hr>
<!-- Package-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
		    	<option value="" disabled selected>Choose your filter</option>
		    	<option value="1">Installment</option>
		    	<option value="2">Exhumation</option>
	      	<option value="3">Cremation</option>
    	  </select>	    	
        <label>Service Name</label>
	  	</div>
    
      <div class="col s9">
    	  <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Package</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatablePackage">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Service/s</th>
                <th>Additionals</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Bone Cremation</td>
                <td></td>
                <td>Cremation</td>
                <td>Pouch</td>
                <td>P 19,000.00</td>
              </tr>
              <tr>
                <td>Bone Cremation</td>
                <td></td>
                <td>Cremation</td>
                <td>Pouch</td>
                <td>P 19,000.00</td>
              </tr>
              <tr>
                <td>Bone Cremation</td>
                <td></td>
                <td>Cremation</td>
                <td>Pouch</td>
                <td>P 19,000.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Package -->
<hr>
<!-- Service -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Unit Servicing</option>
            <option value="2">Scheduled Service</option>
            <option value="3">For Return</option>
        </select>
        <label>Service Category</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Service</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableService">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Cremation</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>Cremation</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>Cremation</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Service -->
<hr>
<!-- Additionals -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Urn</option>
            <option value="2">Holder</option>
            <option value="3">Epitaph</option>
        </select>
        <label>Additionals Category</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Additionals</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableAdditionals">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Candle Holder</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>Candle Holder</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>Candle Holder</td>
                <td></td>
                <td>P 1,500.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Additionals -->
<hr>
<!-- Unit Price -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <label>Block Name</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Unit Price</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableUnitPrice">
            <thead>
              <tr>
                <th>Column</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>2</td>
                <td>P 1,500.00</td>
              </tr>
              <tr>
                <td>3</td>
                <td>P 1,500.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Unit Price -->
<hr>
<!-- Block-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Armin</option>
            <option value="2">Erwim</option>
            <option value="3">Levi</option>
            <option value="4">Mikasa</option>
          </select>
          <label>Building Name</label>
        </div>
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <label style="margin-top: 100px;">Building Floor</label>
        </div>
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Armin</option>
            <option value="2">Erwim</option>
        </select>
        <label style="margin-top: 200px;">Building Room</label>
        </div>
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Fullbody Crypts</option>
            <option value="2">Columbary Vaults</option>
        </select>
        <label style="margin-top: 300px;">Type of Block</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Block</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableBlock">
            <thead>
              <tr>
                <th>Name</th>
                <th>No. of Columns</th>
                <th>No. of Rows</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>4</td>
                <td>5</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>


<!-- Block -->
<hr>
<!-- Room-->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select>
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
<!-- Building-->
    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
          <label>Building Floor</label>
        </div>
        <div class="row">
          <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">North</option>
            <option value="2">East</option>
            <option value="3">West</option>
            <option value="4">South</option>
          </select>
          <label style="margin-top: 100px;">Building Location</label>
        </div>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Building</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableBuilding">
            <thead>
              <tr>
                <th>Name</th>
                <th>Location</th>
                <th>No. of Floors</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Armin</td>
                <td>North</td>
                <td>2</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>North</td>
                <td>2</td>
              </tr>
              <tr>
                <td>Armin</td>
                <td>North</td>
                <td>2</td>
              </tr>
            </tbody>
            </table>
        </div>
      </div>
    </div>

<!-- Building -->
<hr>

<!-- Interest -->

    <div class="row" style="margin: 30px;">
      <div class="input-field col s3">
        <select>
            <option value="" disabled selected>Choose your filter</option>
            <option value="1">Pre-Need</option>
            <option value="2">At-Need</option>
        </select>
        <label>Interest Status</label>
      </div>
    
      <div class="col s9">
        <div class="z-depth-2 card material-table">
          <div class="table-header" style="background-color: #00897b;">
            <a class="btn-floating waves-effect waves-light light-blue tooltipped" data-position="bottom" data-delay="30" data-tooltip="Print"><i class="material-icons" style="color: #ffffff;">print</i></a>
            <h5 style="color: #ffffff; font-family: myFirstFont; padding-left: 40%;">Interest</h5>
            <div class="actions">
              <a href="#" class="search-toggle btn-flat nopadding"><i class="material-icons" style="color: #ffffff;">search</i></a>
            </div>
          </div>
          <table id="datatableInterest">
            <thead>
              <tr>
                <th>No. of Years</th>
                <th>Interest Rate</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>4</td>
                <td>4.00%</td>         
              </tr>
              <tr>
                <td>4</td>
                <td>4.00%</td>         
              </tr>
              <tr>
                <td>4</td>
                <td>4.00%</td>         
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Interest -->

@endsection