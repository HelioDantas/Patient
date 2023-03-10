<?php

namespace App\Import;

use Illuminate\Http\UploadedFile;

class Import
{
    public function __construct(
        private readonly UploadedFile $file
    ) { }

    public function toArray(bool $withHeader = false)
    {
        $handle = fopen($this->file, "r");

        $header = fgetcsv($handle, 1000, ",");
        $newRow = [];

        while ($row = fgetcsv($handle, 1000, ",")) {
            $newRow[] = $withHeader ? array_combine($header, $row): $row;
        }

        fclose($handle);

        return $newRow;
    }
}
