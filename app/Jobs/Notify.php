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

        //wp_mail($this->notification['email'], 'queue test', $this->notification['email'].' notified.', null);
        echo '<p>Processing: <span>'.$this->notification['email'].'</span></p>';

        usleep(200000); //20 Milliseconds

    }

    /**
     * The job failed to process.
     * @param  ExceptionHandler  $exception
     * @return void
     */
    public function failed(ExceptionHandler $exception)
    {
        wp_mail($this->notification['email'], $exception->getMessage(), null);
        // Send user notification of failure, etc...
    }
}

