<?php

namespace App\Jobs;

use Mail;
use App\Mail\ClientLoginDetails;
use Illuminate\Mail\Mailable;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendLoginDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 10;
    public $timeout = 120;
    protected $detail;
   
    
    public function __construct($detail)
    {
        //
        $this->detail = $detail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $logindetail = new ClientLoginDetails($this->detail);
        Mail::to($this->detail->email)->send($logindetail);
    }
}
