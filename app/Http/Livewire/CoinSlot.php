<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class CoinSlot extends Component
{
  use AuthorizesRequests;

  public $amount;

  protected $rules = [
    'amount' => 'integer|gt:0|multiple_of:25'
  ];

  protected $listeners = [
    '$refresh'
  ];

  public function deposit()
  {
    if (Gate::denies('deposit')) {
      abort(400, "Please withdraw before deposit");
    }

    $validatedData = $this->validate();
    
    /** @var User */
    $user = auth()->user();
    $user->balance = $validatedData['amount'];
    $user->save();

    $this->emitTo('list-snack', '$refresh');
  }

  public function withdraw()
  {
    if (Gate::denies('withdraw')) {
      abort(400, "Not enough balance to withdraw");
    }

    /** @var User */
    $user = auth()->user();
    $user->balance = 0;
    $user->save();

    $this->emitTo('list-snack', '$refresh');
  }

  public function render()
  {
    return view('livewire.coin-slot', [
      'user' => auth()->user(),
    ]);
  }
}
