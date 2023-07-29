<x-app-layout>

<div class=" mx-auto w-8/12 dark:bg-gray-900">

<h2 class="text-center text-lg text-black font-bold mb-5">Create Revenue Type</h2>

 <form action="{{ route('create-revenue-type')}}" method="post">
 @csrf

 
 <div class="col-span-6 sm:col-span-4 mb-4">
    <x-label for="name" value="{{ __('Revenue Type') }}" />
    <x-input id="name" name="name" type="text" class="mt-1 block w-full " wire:model.defer="state.name" autocomplete="name" />
    <x-input-error for="name" class="mt-2" />
</div>

 

<x-button class="bg-sky-600 hover:bg-sky-700   " type="submit" wire:click="submit">
    {{ __('Create') }}
</x-button>

 </form>
</div>
</x-app-layout>