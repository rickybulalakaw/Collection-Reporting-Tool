@extends('layouts.admin')

@section('content')
<div class="container">
 <h1 class="text-center">Accountable Form</h1>

 <p>Payor: {{ $accountableForm->payor }}</p>
 <p>Form Serial No. {{ $accountableForm->accountable_form_number }}</p>
 <p>Date Used: {{ $accountableForm->date }}</p>

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


</div>

@endsection