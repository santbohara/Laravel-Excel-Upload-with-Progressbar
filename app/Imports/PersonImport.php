<?php

namespace App\Imports;

use App\Models\Person;
use App\Models\Upload;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class PersonImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithEvents, WithChunkReading, ShouldQueue
{
    private $upload_id;
    private $uploadRecord;

    public function __construct(int $upload_id)
    {
        $this->upload_id = $upload_id;
        $this->uploadRecord = Upload::find($upload_id);
    }

    public function registerEvents(): array
    {
        return [

            // Handle by a closure.
            BeforeImport::class => function (BeforeImport $event) {
                $total_rows = collect($event->reader->getTotalRows())->flatten()->values();
                $tmp_total_rows = isset($total_rows[0]) ? $total_rows[0] - 1 : 0;

                $this->uploadRecord->status = "processing";
                $this->uploadRecord->total = $tmp_total_rows;
                $this->uploadRecord->save();
            },

            // Handle by a closure.
            AfterImport::class => function (AfterImport $event) {

                $this->uploadRecord->status = "finished";
                $this->uploadRecord->save();
            },

            ImportFailed::class => function(ImportFailed $event) {

                $this->uploadRecord->status = "failed";
                $this->uploadRecord->save();
            },
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            //Do your magic here
            Person::create([
                'name'  => $row['name'],
                'email' => $row['email'],
                'city'  => $row['city'],
            ]);

            //get processed from current
            $upload = Upload::find($this->upload_id);
            $upload->current = $upload->current > 0 ? $upload->current + 1 : 1;
            $upload->save();
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
