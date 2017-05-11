<?php namespace IlluminePlugin1\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notify implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function fire($job, $data)
    {
        echo "Sending email to: {$data['email']}" . PHP_EOL;
        $job->delete();
    }
}

