<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Jobs\ProcessExcelImport;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class ImportExcel extends Component
{
    use WithFileUploads;

    public $file;
    public $fileName = null;
    public $importing = false;
    public $filePath; // Store the path to the temporary file

    public function render()
    {
        return view('livewire.import-excel');
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls', // Adjust validation rules as needed
        ]);

        $this->importing = true;

        $this->filePath = Storage::putFile('uploads', $this->file); // Store file temporarily

        //save upload record
        $upload_id = $this->saveUpload();

        ProcessExcelImport::dispatch($this->filePath,$upload_id);

        $this->file = null;
        $this->fileName = null;
    }

    public function updated($value)
    {
        $this->fileName = $this->file->getClientOriginalName();
    }

    public function updatedFilePath()
    {
        $this->resetValidation(); // Reset validation when file changes
    }

    public function saveUpload()
    {
        $upload              = new Upload();
        $upload->file_name   = $this->file->getClientOriginalName();
        $upload->uploaded_at = date("Y-m-d H:i:s");
        $upload->file_size   = $this->file->getSize();
        $upload->file_ext    = $this->file->getClientOriginalExtension();
        $upload->file_type   = $this->file->getClientMimeType();
        $upload->created_at  = date("Y-m-d H:i:s");
        $upload->status      = "uploaded";
        $upload->save();

        return $upload->id;
    }
}

