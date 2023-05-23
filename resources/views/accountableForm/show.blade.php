@extends('layouts.admin')

@section('content')
<div class="container">
 <h1 class="text-center">Accountable Form</h1>

 <p>Payor: {{ $accountableForm->payor }}</p>
 <p>Form Serial No. {{ $accountableForm->accountable_form_number }}</p>
 <p>Date Used: {{ $accountableForm->date }}</p>

 @if( $method)
  @if($method == 'add-accountable-form-item')
  <div class="inline">
   <form action="" method="post">
    @csrf

    <div class="row">
     <div class="col-lg">
      <div class="form-group ">
       <select name="revenue_type_id" id="revenue_type_id" class="form-control">
        <option value="">Select Revenue Type</option>
        @foreach($revenue_types as $revenuetype) 
        <option value="{{ $revenuetype->id }}">{{ $revenuetype->single_display }}</option>
        @endforeach
       </select>
       @error('revenue_type_id')
       <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>

     </div>

     <div class="col-lg">
      <div class="form-group ">
       <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
       @error('amount')
       <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>    
      <input type="hidden" name="accountable_form_id" value="{{ $accountableForm->id }}">

     </div>

     <div class="col-lg">
      <button class="btn btn-primary btn-block" name="submit" type="submit">Add Item</button>

     </div>


    </div>
   </form>

  </div>
  @endif 
 @endif

 @if($accountableFormItemsOfForm->count() > 0)
 <table class="table table-striped">
  <thead>
   <tr>
    <!-- <th>Counter</th> -->
    <th class="text-center">Revenue Type</th>
    <th class="text-center">Amount</th>
   </tr>
  </thead>
  <tbody>
   @foreach($accountableFormItemsOfForm as $afi) 
   <tr>
    <!-- <td></td> -->
    <td>{{ $afi->revenue_type->single_display }}</td>
    <td class="text-right">{{ $afi->amount }}</td>
   </tr>
   @endforeach
   <tr>
    <td class="text-bold">Total</td>
    <td class="text-bold text-right">{{ $afi->sum('amount') }} </td>
   </tr>


  </tbody>

 </table>
 @else 
 <p class="text-bold">There is no accountable form item for this number.</p>

 @endif


</div>

@endsection