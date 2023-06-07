<x-app-layout>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
@if (Session::has('error') )
 <p class="alert alert-danger">
  {{ $error }} 
 </p> 
 @endif
 <h1 class="text-center">Register Accountable Forms</h1>
 <form action="{{ route('create-accountable-form') }}" method="post">
  @csrf

  <div class="form-group">
   <!-- <label for="accountable_form_type_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Accountable Form Type</label> -->
   
   <x-label for="accountable_form_type_id" :value="__('Accountable Form Type')">Accountable Form Type </x-label>
  



   <select name="accountable_form_type_id" id="accountable_form_type_id" class="form-control" value="{{ old('accountable_form_type_id') }}">
    <option value="">Select Accountable Form Type</option>
    @foreach($accountableFormTypes as $aft) 
    <option value="{{ $aft->id }}">{{ $aft->name }}</option>
    @endforeach
   </select>
   @error('accountable_form_type_id')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="user_id">Collector</label>
   <select name="user_id" id="user_id" class="form-control" id="" value="{{ old('user_id') }}">
    <option value="">Select Collector</option>
    @foreach($users as $user)
    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }} </option> 
    @endforeach
   </select>
   @error('user_id')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

    <div class="col-span-6 sm:col-span-4">
        <x-label for="start_number" value="{{ __('Start Number') }}" />
        <x-input id="start_number" type="number" class="mt-1 block w-full" wire:model.defer="state.start_number" autocomplete="start_number" />
        <x-input-error for="start_number" class="mt-2" />
    </div>
    <div class="col-span-6 sm:col-span-4">
        <x-label for="end_number" value="{{ __('End Number') }}" />
        <x-input id="end_number" type="number" class="mt-1 block w-full" wire:model.defer="state.end_number" autocomplete="end_number" />
        <x-input-error for="end_number" class="mt-2" />
    </div>

    <x-button>
        {{ __('Assign to Collector') }}
    </x-button>
  
 </form>
</div>
</x-app-layout>