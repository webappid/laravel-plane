<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 16:37
 */

namespace WebAppId\Plane\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webappid:plane:seed';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed database';
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('db:seed', ['--class' => 'WebAppId\Plane\Seeds\DatabaseSeeder']);
        $this->info('Seeded: Seeder Plane');
    }
}