<?php namespace IlluminePlugin1\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illumine\Framework\Support\ExceptionHandler;

class Notify implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $notification;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {

        echo $this->notification['email'];
        // Process uploaded podcast...
    }

    /**
     * The job failed to process.
     * @param  ExceptionHandler  $exception
     * @return void
     */
    public function failed(ExceptionHandler $exception)
    {
        // Send user notification of failure, etc...
    }
}

