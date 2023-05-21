@extends('layouts.admin')

@section('content')
<div class="container">
 <h1 class="text-center">Record {{ $name }} </h1>


<form action="{{ route('record-accountable-form', $accountable_form_id) }} " method="post">
 @csrf 
 @method('PUT')

 <input type="text" name="accountable_form_type_id" value="{{ $accountable_form_type_id }}" hidden>
 <input type="text" name="accountable_form_id" value="{{ $accountable_form_id }}" hidden>
 <div class="form-group">
  <label for="accountable_form_number">Accountable Form Number</label>
  <input type="text" class="form-control" name="accountable_form_number" value="{{ $accountable_form_number }}" readonly>
 </div>

 <div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_cancelled" value="1">
        <label class="custom-control-label text-danger" for="customSwitch1">Toggle this switch if this is cancelled</label>
    </div>
</div>

 <div class="form-group">
  <label for="date">Date (Editable)</label>
  <input type="date" name="date" value="{{ $date_today }}" class="form-control" id="date" placeholder="Date">
  @error('date')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
 </div>

 <div class="form-group">
  <label for="payor">Payor</label>
  <input type="text" name="payor" class="form-control" id="date" value=" {{ old('payor') }} " placeholder="payor">
  @error('payor')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
 </div>

 @if($isOfficialReceipt) 
 <div class="form-group">
    <label for="isThisRpt">Is this Payment for RPT?</label>
    <select name="isThisRpt" id="isThisRpt" class="form-control">
        <option value="No">No</option>
        <!-- <option value="">Select One</option> -->
        <option value="Yes">Yes</option>
    </select>
 </div>
 @endif



 <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Record</button>
</form>
</div>

@endsection