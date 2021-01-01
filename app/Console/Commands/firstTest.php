<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class firstTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'first:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this will be firstTest';

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
        DB::table('marques')->insert([
            'name'=>'firstTest',
            'etat'=>'true',
            'created_at'=>date('y-m-d'),
        ]);
        return 0;
    }
}
