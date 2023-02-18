<ul>
@forelse ($snacks as $snack)
  @php
    $purchasable = $user->balance >= $snack->price;
  @endphp
  <li class="py-2 border-b">
    <p class="flex flex-row items-center">
      <span class="flex-auto">{{ $snack->name }}</span>
      <span class="flex-initial">@money($snack->price)</span>
      <button
        type="button"
        class="bg-blue-500 text-white font-bold py-2 px-4 rounded ml-4 @if(!$purchasable) bg-red-400 cursor-not-allowed @else hover:bg-blue-700 @endif"
        wire:click="purchase({{ $snack->id }})"
        @if(!$purchasable)
          disabled="disabled"
        @endif
      >
        Purchase
      </button>
    </p>
  </li>
@empty
  <li>No snacks available. Check again in a few moments!</li>
@endforelse
</ul>
