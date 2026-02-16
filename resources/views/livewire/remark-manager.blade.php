<div>

    {{-- Remark Button --}}
    <button wire:click="openModal"
        style="padding:10px 20px;background:#4f46e5;color:white;border:none;border-radius:6px;">
        Add Remark
    </button>

    {{-- Modal --}}
    @if($showModal)
        <div style="
            position:fixed;
            top:0;left:0;
            width:100%;height:100%;
            background:rgba(0,0,0,0.5);
            display:flex;
            align-items:center;
            justify-content:center;
        ">
            <div style="background:white;padding:20px;width:400px;border-radius:8px;">

                <h3>Add Remark</h3>

                <textarea
                    wire:model="remarkText"
                    style="width:100%;height:100px;border:1px solid #ccc;padding:8px;"></textarea>

                @error('remarkText')
                    <div style="color:red">{{ $message }}</div>
                @enderror

                <div style="margin-top:10px;">
                    <button wire:click="saveRemark"
                        style="background:green;color:white;padding:8px 15px;border:none;border-radius:5px;">
                        Submit
                    </button>

                    <button wire:click="$set('showModal', false)"
                        style="background:gray;color:white;padding:8px 15px;border:none;border-radius:5px;">
                        Cancel
                    </button>
                </div>

            </div>
        </div>
    @endif

    {{-- Remarks List --}}
    <div style="margin-top:30px;">
        <h3>Remarks</h3>

        @forelse($remarks as $remark)
            <div style="padding:10px;border-bottom:1px solid #ddd;">
                <strong>{{ $remark['user']['name'] }}</strong><br>
                {{ $remark['remark'] }}<br>
                <small>{{ \Carbon\Carbon::parse($remark['created_at'])->format('d M Y H:i') }}</small>
            </div>
        @empty
            <p>No remarks yet.</p>
        @endforelse
    </div>

</div>
