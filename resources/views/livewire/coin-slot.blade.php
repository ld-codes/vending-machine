@if($user->balance > 0)
  <div class="flex flex-row py-2 justify-end items-center">
    <p>Balance: @money($user->balance)</p>
    <button
      type="button"
      class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4"
      wire:click="withdraw()"
    >
      Withdraw
    </button>
  </div>
@else
  <form class="flex flex-row py-2 justify-end items-center" wire:submit.prevent="deposit">
    <div class="flex flex-col">
      <input wire:change="$set('amount', $event.target.value * 100)" class="p-2" type="number" min="0" step="0.25">
      @error('amount')<span class="text-red-400 text-sm my-1">{{ $message }}</span>@enderror
    </div>
    <button
      type="submit"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4"
    >
      Deposit
    </button>
  </form>
@endif

