<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user">

<div class="mx-auto lg:container flex flex-col space-y-12 lg:w-10/12">
 <h1 class="text-center text-3xl">Accountable Form </h1>

 @if($method == 'review-accountable-form')
  <div>
    <p class="bg-green-300 p-6 text-center ">
      Recommended process for reviewers: Count the money first and check that the total in the individual RCD is the same as the total in the RCD. If the money is correct, then proceed with reviewing individual accountable forms.

    </p>
  </div>
  @endif

  <table class="table-auto w-full">
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
  <x-button class="w-full text-center bg-slate-500 justify-center">
    <x-fas class="fas fa-edit text-white "></x-fas>&nbsp; Edit Form Details
  </x-button>


 @if( $method)
  @if($method == 'add-accountable-form-item')
    
  <form action="{{ route('add-accountable-form-item', $accountableForm->id) }}" method="post"> 
    @csrf

       <select name="revenue_type_id" id="revenue_type_id" class="w-full rounded m-1" autofocus>
        <option value="">Select Revenue Type</option>
        @foreach($revenue_types as $revenuetype) 
        <option value="{{ $revenuetype->id }}">{{ $revenuetype->single_display }}</option>
        @endforeach
       </select>
       @error('revenue_type_id')
       <span class="text-red-600 px-2">{{ $message }}</span>
       @enderror

       <x-input type="number" name="amount" id="amount" class="w-full m-1" placeholder="Amount"></x-input>
       @error('amount')
       <span class="text-red-600 px-2 ">{{ $message }}</span>
       @enderror
      <input type="hidden" name="accountable_form_id" value="{{ $accountableForm->id }}">

      <x-button class="bg-blue-500 text-light m-1 w-full" name="submit" type="submit">Add Item</x-button>



   </form>
   </div>

  
  @endif 
 @endif

 <div class="flex mx-auto mt-5 w-10/12 ">
 @if($accountableFormItemsOfForm->count() > 0)
 <table class="table-auto w-full border-red-300">
  <thead>
   <tr>
    <!-- <th>Counter</th> -->
    <th class="text-center"  style="width:50%">Revenue Type</th>
    <th class="text-center"  style="width:30%">Amount</th>
    <th class="text-center" style="width:20%">Actions</th>
   </tr>
  </thead>
  <tbody class="">
   @foreach($accountableFormItemsOfForm as $afi) 
   <tr class="border-red-400  border-solid border-spacing-5">
    <!-- <td></td> -->
    
    <td class="">{{ $afi->revenue_type->single_display }}</td>
    <td class="text-right">{{ number_format($afi->amount, 2) }}</td>
    <td class="text-center flex justify-center">
      
      <form action="{{ route('delete-accountable-form-item', $afi->id) }} " method="post" class="form-inline">
        @csrf
        @method('DELETE')
        <input type="hidden" name="accountable_form_id" value="{{ $afi->accountable_form_id }} ">

        <!-- <x-button class="bg-red-400  hover:bg-red-700 text-white font-bold p-1 rounded" type="submit">
          <x-fas class="fas fa-trash text-red-400  hover:text-red-700 "></x-fas>
        </x-button> -->
        <button type="submit"><i class="fas fa-trash text-xl text-slate-400    hover:text-red-700 " ></i> </button>
      </form>
    </td>
   </tr>
   @endforeach
   <tr class="border-x-3 border-b-neutral-500 ">
    <td class="font-bold ">Total</td>
    <td class="font-bold text-right">{{ number_format($accountableFormItemsOfForm->sum('amount'),2) }} </td>
    <td > </td>
   </tr>
  </tbody>

 </table>
 @else 
 <p class="text-bold">There is no accountable form item for this number.</p>
 @endif
</div>

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

</x-app-layout>