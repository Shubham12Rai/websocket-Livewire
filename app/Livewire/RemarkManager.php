<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Remark;
use Illuminate\Support\Facades\Auth;

class RemarkManager extends Component
{
    public $showModal = false;
    public $remarkText = '';
    public $remarks = [];

    protected $rules = [
        'remarkText' => 'required|min:2'
    ];

    public function mount()
    {
        $this->loadRemarks();
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->remarkText = '';
        $this->showModal = true;
    }

    public function saveRemark()
    {
        $this->validate();

        Remark::create([
            'user_id' => Auth::id(),
            'remark' => $this->remarkText,
        ]);

        $this->showModal = false;
        $this->remarkText = '';

        $this->loadRemarks();
    }

    public function loadRemarks()
    {
        $this->remarks = Remark::with('user')
            ->latest()
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.remark-manager');
    }
}
