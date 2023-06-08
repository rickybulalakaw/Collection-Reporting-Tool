<x-app-layout>

<div class=" mx-auto w-8/12 dark:bg-gray-900">

<h2 class="text-center text-lg text-blue-500 font-bold mb-5">Create Accountable Form Type</h2>

 <form action="{{ route('create-accountable-form-type')}}" method="post">
 @csrf

 
 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-label for="name" value="{{ __('Form Name') }}" />
    <x-input id="name" name="name" type="number" class="mt-1 block w-full " wire:model.defer="state.name" autocomplete="name" />
    <x-input-error for="name" class="mt-2" />
</div>

 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-label for="number" value="{{ __('Number (as designated by BIR)') }}" />
    <x-input id="number" name="number" type="text" class="mt-1 block w-full" wire:model.defer="state.number" autocomplete="number" />
    <x-input-error for="number" class="mt-2" />
</div>

 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-label for="default_amount" value="{{ __('Default Amount') }}" />
    <x-input id="default_amount" name="default_amount" type="number" class="mt-1 block w-full" wire:model.defer="state.default_amount" autocomplete="default_amount" />
    <x-input-error for="default_amount" class="mt-2" />
</div>

<x-button class="bg-sky-600 hover:bg-sky-700   " type="submit" wire:click="submit">
    {{ __('Save') }}
</x-button>

 </form>
</div>
</x-app-layout>