<x-app-layout>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

 <h1 class="text-center text-lg text-blue-500 font-bold mb-5 ">Register Accountable Forms</h1>
 <form action="{{ route('create-accountable-form') }}" method="post">
  @csrf

  <div class="form-group mb-4">   
   <x-label for="accountable_form_type_id" :value="__('Accountable Form Type')"/> 
   <select name="accountable_form_type_id" id="accountable_form_type_id" class="form-control rounded-sm min-w-full border-gray-300 dark:border-gray-700" value="{{ old('accountable_form_type_id') }}">
    <option value=""></option>
    @foreach($accountableFormTypes as $aft) 
    <option value="{{ $aft->id }}">{{ $aft->name }}</option>
    @endforeach
   </select>
   <x-input-error for="accountable_form_type_id" class="mt-2" />   
  </div>

  <div class="form-group mb-4">
   <x-label for="user_id" :value="__('Collector')" />
   <select name="user_id" id="user_id" class="form-control rounded-sm min-w-full border-gray-300 dark:border-gray-700  " id="user_id" value="{{ old('user_id') }}">
    <option value=""></option>
    @foreach($collectors as $col)
    <option value="{{ $col->id }}">{{ $col->name ." ". $col->last_name }} </option> 
    @endforeach
   </select>
   <x-input-error for="user_id" class="mt-2" />
  </div>

    <div class="col-span-6 sm:col-span-4 mb-4">
        <x-label for="start_number" value="{{ __('Start Number') }}" />
        <x-input id="start_number" name="start_number" type="number" class="mt-1 block w-full" wire:model.defer="state.start_number" autocomplete="start_number" />
        <x-input-error for="start_number" class="mt-2" />
    </div>

    <div class="col-span-6 sm:col-span-4 mb-4">
        <x-label for="end_number" value="{{ __('End Number') }}" />
        <x-input id="end_number" name="end_number" type="number" class="mt-1 block w-full" wire:model.defer="state.end_number" autocomplete="end_number" />
        <x-input-error for="end_number" class="mt-2" />
    </div>

    <x-button>
        {{ __('Assign to Collector') }}
    </x-button>
  
 </form>
</div>
</x-app-layout>