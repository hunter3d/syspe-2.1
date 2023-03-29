<?php

namespace App\Console\Commands;

#use App\Models\PasswordResets;
use App\Models\VisitorsReset;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class RecoveryCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recovery:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete recovery request after 15 min';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $rs = PasswordResets::query()->get();
//        foreach ($rs as $r) {
//            if (Carbon::parse($r->created_at)->addMinutes(15) < Carbon::now()) {
//                $r->delete();
//            }
//        }

        $vs = VisitorsReset::query()->get();
        foreach ($vs as $v) {
            if (Carbon::parse($v->created_at)->addMinutes(15) < Carbon::now()) {
                $v->delete();
            }
        }

//        $visitors = Visitor::query()->where('email_verified_at', null)->get();
//
//        foreach ($visitors as $visitor) {
//            if (Carbon::parse($visitor->created_at)->addMinutes(30) < Carbon::now()) {
//                print 'Account '.$visitor->email.' --- removed after 15 min.';
//                $card = Card::where('visitor_id',$visitor->id)->first();
//                $card->delete();
//                $visitor->delete();
//            }
//        }
    }
}
