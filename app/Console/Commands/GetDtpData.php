<?php

namespace App\Console\Commands;

use App\Jobs\GetDTPAccident;
use App\Service\DTPService;
use Illuminate\Console\Command;

class GetDtpData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:dtp';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $service = new DTPService();
        $accident_count = $service->accident_count();
        $max_page = ceil($accident_count / $service->page_size);
        $page = 0;
        $temp = 0;
        while($page < $max_page)
        {
            $temp += $service->page_size;
            if($temp > $max_page){
                $temp = $max_page;
            }
            dispatch(new GetDTPAccident($page, $temp));
            $page = $temp;
        }
        return Command::SUCCESS;
    }

}
