<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Mail;
use App\Mail\ReportDownloadLink;
use Illuminate\Mail\Mailable;

class ReportDonloadLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 2;

    public $detail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail=$detail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $link=new ReportDownloadLink($this->detail);
        Mail::to($this->detail->email)->send($link);
    }
}
