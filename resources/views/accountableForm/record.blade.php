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
  <label for="form_date">Date (Editable)</label>
  <input type="form_date" name="form_date" value="{{ $date_today }}" class="form-control" id="form_date" placeholder="Date">
  @error('form_date')
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

 @if(isset($is_rpt_receipt))
 
 <div class="form-group">
   <label for="receipt_no_pf_no_25">Receipt No. P.F. No. 25</label>
   <input type="number" name="receipt_no_pf_no_25" value="{{ old('receipt_no_pf_no_25') }}" id="receipt_no_pf_no_25" class="form-control" autofocus>
   @error('receipt_no_pf_no_25')
   <div class="text-danger mt-2 text-sm">
    {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="period_covered">Period Covered</label>
   <input type="text" name="period_covered" value="{{ old('period_covered')  }}" id="period_covered" class="form-control" autofocus>
   @error('period_covered')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="classification">Classification</label>
   <input type="text" name="classification" value="{{ old('classification')  }}" id="classification" class="form-control" autofocus>
   @error('classification')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="tax_declaration_no">Tax Declaration Number</label>
   <input type="text" name="tax_declaration_no" value="{{ old('tax_declaration_no')  }}"  class="form-control" autofocus> 
   @error('tax_declaration_no')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="formCheck">
    <label class="form-check-label" for="exampleCheck1">I checked that the values are correct.</label>
</div> -->

<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_reviewed" value="1">
        <label class="custom-control-label text-danger" for="customSwitch1">I checked that the values are correct.</label>
    </div>
</div>

 @elseif (isset($is_ctc))

 <div class="form-group">
   <label for="A">Basic Charge</label>
   <input type="number" name="{{ $ctc_a }}" value="{{ old($ctc_a) }}" id="A" class="form-control" autofocus>
   @error($ctc_a)
   <div class="text-danger mt-2 text-sm">
    {{ $message }}
   </div>
   @enderror
  </div>
  <div class="form-group">
   <label for="B">Charge B</label>
   <input type="number" name="{{ $ctc_b }}" value="{{ old($ctc_b)  }}" id="A" class="form-control" autofocus>
   @error($ctc_b)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>
  <div class="form-group">
   <label for="C">Charge C</label>
   <input type="number" name=" {{ $ctc_c }}" value="{{ old($ctc_c)  }}" id="A" class="form-control" autofocus>
   @error($ctc_c)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>
  <div class="form-group">
   <label for="C1">Charge C1</label>
   <input type="number" name="{{ $ctc_c1 }}" value="{{ old($ctc_c1)  }}"  class="form-control" autofocus> 
   @error($ctc_c1)
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

 @endif





 <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Record</button>
</form>
</div>

@endsection