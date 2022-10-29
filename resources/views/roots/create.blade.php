@extends('layout')
  
@section('content')
<style>
    .weekDays-selector input {
      display: none!important;
    }
    .weekDays-selector input[type=checkbox] + label {
      display: inline-block;
      border-radius: 6px;
      background: #dddddd;
      height: 40px;
      width: 30px;
      margin-right: 3px;
      line-height: 40px;
      text-align: center;
      cursor: pointer;
    }
    
    .weekDays-selector input[type=checkbox]:checked + label {
      background: #2AD705;
      color: #ffffff;
    }
</style>
<div class="row mb-3">
    <div class="col-lg-12 margin-tb">
        <div class="float-none float-md-start">
            <h2>Add New Flight</h2>
        </div>
        <div class="float-none float-md-end">
            <a class="btn btn-primary" href="{{ route('roots.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('roots.store') }}" method="POST" id="frm_flight">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Source:</strong>
                <select class="form-select" id="source" name="source" aria-label="Default select example">
                  <option selected>Select Origin</option>
                  @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                  @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Destination:</strong>
                <select class="form-select" id="destination" name="destination" aria-label="Default select example1">
                  <option selected>Select Destination</option>
                  @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                  @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Select Days:</strong>
                <div class="weekDays-selector">
                  <input type="checkbox" id="weekday-mon" name="operational_days[]" value="1" class="weekday" />
                  <label for="weekday-mon">M</label>
                  <input type="checkbox" id="weekday-tue" name="operational_days[]" value="2" class="weekday" />
                  <label for="weekday-tue">T</label>
                  <input type="checkbox" id="weekday-wed" name="operational_days[]" value="3" class="weekday" />
                  <label for="weekday-wed">W</label>
                  <input type="checkbox" id="weekday-thu" name="operational_days[]" value="4" class="weekday" />
                  <label for="weekday-thu">T</label>
                  <input type="checkbox" id="weekday-fri" name="operational_days[]" value="5" class="weekday" />
                  <label for="weekday-fri">F</label>
                  <input type="checkbox" id="weekday-sat" name="operational_days[]" value="6" class="weekday" />
                  <label for="weekday-sat">S</label>
                  <input type="checkbox" id="weekday-sun" name="operational_days[]" value="7" class="weekday" />
                  <label for="weekday-sun">S</label>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>No. of flights on operating days</strong>
                <input type="number" id="frequency" name="frequency" class="form-control" placeholder="Flight frequency"  step="1" min="3" max="5" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Gap between 2 flights:</strong>
                <input type="number" id="gap" name="gap" class="form-control" placeholder="Gap between 2 flights"  step="1" min="2" max="4" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>No. of seats:</strong>
                <input type="number" name="passenger_capacity" class="form-control" max="180" value="180" placeholder="No of seats available for booking" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Minimum fare</strong>
                <input type="number" name="min_fare" class="form-control" placeholder="Minimum amount for booking" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Booking fare</strong>
                <input type="number" name="booking_fare" class="form-control" placeholder="Amount for booking" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Staus:</strong>
                <select class="form-select" name="status" aria-label="Default select example3">
                  <option selected>Status of flight</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>

<script>
    $("select").change(function(e){
        //$("select option").removeAttr('disabled');
        // $("select").each(function(i,s){
        //   $("select").not(s).find("option[value="+$(s).val()+"]").attr('disabled','disabled');
        // });
        
        var source = $('#source').find(":selected").text();
        var destination = $('#destination').find(":selected").text();
        
        if (source == "Delhi" || destination == "Delhi"){
            $('#frequency').val("4");
            $('#gap').val("3");
        }
        else if (source == "Kolkata" || destination == "Kolkata"){
            $('#frequency').val("5");
            $('#gap').val("2");
        }
        else if (source == "Chennai" || destination == "Chennai"){
            $('#frequency').val("3");
            $('#gap').val("4");
        }

    });

    $('#frm_flight').submit(function (e) {
        //check atleat 1 checkbox is checked
        if (!$('.weekday').is(':checked')) {
            //prevent the default form submit if it is not checked
            e.preventDefault();
        }
    })
</script>
@endsection

