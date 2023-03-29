<?php

namespace App\Console\Commands;

use App\Models\Cards;
use App\Models\Emailcodes;
use App\Models\Visitor;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class VerifyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete not activated registration after 30 min';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $visitors = Visitor::query()->where('email_verified_at', null)->get();

        foreach ($visitors as $visitor) {
            if (Carbon::parse($visitor->created_at)->addMinutes(30) < Carbon::now()) {
                print 'Account '.$visitor->email.' --- removed after 30 min.';
                $card = Cards::where('visitor_id',$visitor->id)->first();
                $card->delete();
                $emailcode = Emailcodes::where('visitor_id',$visitor->id)->first();
                $emailcode->delete();
                $visitor->delete();
            }
        }
    }
}
