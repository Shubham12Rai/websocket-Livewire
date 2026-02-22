<?php

namespace App\Livewire;

use App\Models\Remark;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Events\RemarkCreated;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class RemarkManager extends Component
{
    use WithPagination;

    public $showModal = false;
    public $remarkText = '';
    public $successMessage = '';

    protected $rules = [
        'remarkText' => 'required|min:2'
    ];

    /**
     * COMPUTED PROPERTY (Livewire v4 best practice)
     */
    #[Computed]
    public function remarks()
    {
        return Remark::with('user')
            ->latest()
            ->paginate(5);
    }

    /**
     * Open modal
     */
    public function openModal()
    {
        $this->resetValidation();
        $this->remarkText = '';
        $this->showModal = true;
    }

    /**
     * Save remark
     */
    public function saveRemark()
    {
        $this->validate();

        // Remark::create([
        //     'user_id' => Auth::id(),
        //     'remark' => $this->remarkText,
        // ]);

        $remark = Remark::create([
            'user_id' => Auth::id(),
            'remark' => $this->remarkText,
        ]);

        // broadcast to other users
        event(new RemarkCreated($remark));

        // close modal
        $this->showModal = false;
        $this->remarkText = '';

        // success message
        $this->successMessage = 'Remark added successfully.';

        /** Cross-component communication
        * Example:
        * Component A → saves remark
        * Component B → shows total count
        * Component B will NOT auto-refresh.
        */
        $this->dispatch('remark-created');
    }

    #[On('remark-created')]
    public function refreshRemarks()
    {
        $this->resetPage();
    }

    #[On('echo:remarks,.remark.created')]
    public function refreshFromBroadcast()
    {
        logger('Broadcast received in Livewire');

        unset($this->remarks);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.remark-manager');
    }
}