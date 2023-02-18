<?php

namespace App\Http\Livewire;

use App\Models\Snack;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ListSnack extends Component
{

  protected $listeners = [
    '$refresh'
  ];

  public function purchase($snackId)
  {
    
    $snack = Snack::find($snackId);

    if (!$snack) {
      abort(404, "Snack not found");
    }
    
    if (Gate::denies('purchase', $snack)) {
      abort(400, 'Not enough balance');
    }

    /** @var User $user */
    $user = auth()->user();
    $user->balance = $user->balance - $snack->price;
    $user->save();

    $this->emitTo('coin-slot', '$refresh');
  }

  public function render() {
    $snacks = Snack::all();

    return view('livewire.list-snack', [
      'user' => auth()->user(),
      'snacks' => $snacks
    ]);
  }
}
