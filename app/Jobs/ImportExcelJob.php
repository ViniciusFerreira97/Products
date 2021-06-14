<?php

namespace App\Jobs;

use App\Imports\ProductImport;
use App\Models\Product;
use App\Repository\ProductRepository;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        $repositoryProduct = new ProductRepository(new Product());
        $import = new ProductImport($repositoryProduct);

        Excel::import($import, $this->filePath);
    }
}