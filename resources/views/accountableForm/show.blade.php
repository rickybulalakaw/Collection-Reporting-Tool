@extends('layouts.admin')

@section('content')
<div class="container">
 <h1 class="text-center">Accountable Form</h1>

 @if($method == 'review-accountable-form')
  <div>
    <p class="alert alert-info">
      Recommended process for reviewers: Count the money first and check that the total in the individual RCD is the same as the total in the RCD. If the money is correct, then proceed with reviewing individual accountable forms.

    </p>
  </div>
  @endif

  <table class="table table-light table-hover table-striped">
    <tr>
      <td class="text-bold">Payor</td>
      <td>{{ $accountableForm->payor }}</td>
    </tr>
    <tr>
      <td class="text-bold">Form Serial No.</td>
      <td>{{ $accountableForm->accountable_form_number }}</td>
    </tr>
    <tr>
      <td class="text-bold">Date Used</td>
      <td>{{ $accountableForm->form_date }}</td>
    </tr>
    <tr>
      <td class="text-bold">Form Type</td>
      <td>{{ $accountable_form_type->name }}</td>
    </tr>
    
  </table>


 @if( $method)
  @if($method == 'add-accountable-form-item')
  <div class="inline">
   <form action="{{ route('add-accountable-form-item', $accountableForm->id) }}" method="post"> 
    @csrf

    <div class="row">
     <div class="col-lg">
      <div class="form-group ">
       <select name="revenue_type_id" id="revenue_type_id" class="form-control" autofocus>
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
    <th class="text-center"  style="width:60%">Revenue Type</th>
    <th class="text-center"  style="width:30%">Amount</th>
    <th class="text-center" style="width:10%">Actions</th>
   </tr>
  </thead>
  <tbody>
   @foreach($accountableFormItemsOfForm as $afi) 
   <tr>
    <!-- <td></td> -->
    
    <td>{{ $afi->revenue_type->single_display }}</td>
    <td class="text-right">{{ number_format($afi->amount, 2) }}</td>
    <td class="text-center form-inline">
      
      
      <a href=""  class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> </a> &nbsp;
      
      <form action="{{ route('delete-accountable-form-item', $afi->id) }} " method="post" class="form-inline">
        @csrf
        @method('DELETE')
        <input type="hidden" name="accountable_form_id" value="{{ $afi->accountable_form_id }} ">
        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> </button>
      </form>
    </td>
   </tr>
   @endforeach
   <tr class="bg-secondary">
    <td class="text-bold">Total</td>
    <td class="text-bold text-right">{{ number_format($afi->sum('amount'),2) }} </td>
    <td > </td>
   </tr>


  </tbody>

 </table>
 @else 
 <p class="text-bold">There is no accountable form item for this number.</p>

 @endif

 @if($method == 'review-accountable-form')
 <div class="bg-light bordered rounded">
  <form action="{{ route('submit-comment', $accountableForm->id) }}" method="post">
    @csrf
    <textarea name="comment" id="summernote" cols="30" rows="10"></textarea>
    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-comments" aria-hidden="true"></i> Submit comment</button>
  </form>
 </div>

 


 <!-- Summernote -->
<script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>


 <script>
    $(document).ready(function() {
      // Summernote
      $('#summernote').summernote({
          height: 100,
          focus: true,
          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear', ]],
              ['fontname', ['fontname']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph', 'height']],
              ['table', ['table']],
              ['insert',
                  [
                      // 'picture', 
                      // 'video'
                      'link'
                  ]
              ],
              ['view',
                  [
                      'fullscreen',
                      // 'codeview',
                      'help'
                  ]
              ],
          ],
          lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
          codeviewIframeFilter: true
      });
    });
</script>

 @endif

 @if (isset($comments) && $comments->count() > 0)
   @foreach ($comments as $comment)
   <div class="bg-dark mt-3 p-2 rounded">
    {!! $comment->body !!}
    <small>Comment by {{ $comment->user->name . " " . $comment->user->last_name }} {{ $comment->created_at->diffForHumans() }}. </small>
   </div>
   @endforeach
 
 @endif


</div>

@endsection