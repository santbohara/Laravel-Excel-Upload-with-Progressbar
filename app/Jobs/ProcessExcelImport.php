<?php

namespace App\Jobs;

use App\Imports\PersonImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ProcessExcelImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $upload_id;

    public function __construct($file, $upload_id)
    {
        $this->file      = $file;
        $this->upload_id = $upload_id;
    }

    public function handle()
    {
        Excel::import(new PersonImport($this->upload_id), $this->file);

        Storage::delete($this->file);
    }
}
