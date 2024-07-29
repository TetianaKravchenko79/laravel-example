<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;

class ClearCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clearCart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clearCart';

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
        Cart::doesntHave('user')->delete();
    }
}
