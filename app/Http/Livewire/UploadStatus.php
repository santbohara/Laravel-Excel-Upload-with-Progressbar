<?php

namespace App\Http\Livewire;

use App\Models\Upload;
use Livewire\Component;

class UploadStatus extends Component
{

    public $limit = 3;

    public function render()
    {
        return view('livewire.upload-status',[
            'in_progress' => Upload::latest()->take($this->limit)->get()
        ]);
    }
}
