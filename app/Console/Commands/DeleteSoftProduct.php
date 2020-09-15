<?php
namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;

class DeleteSoftProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all soft deleted products which are older than 7 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = date("Y-m-d", strtotime('-7 day'));

      $products = Product::withTrashed()->where([
           ['deleted_at', '<', $date],
            ])->get()->each->forceDelete();

        foreach ($products as $product) {
            $image = $product->image;
            $ImagePath = (public_path('storage/images/').$image);

            if(file_exists($ImagePath))
            {
                @unlink($ImagePath);

            }
        }

    }
}
