<?php

namespace App\Console\Commands;
use App\Models\Url;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class DisableShortUrl extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disable_short_url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disables short urls 30 minutes after their creation';

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
     * @return mixed
     */
    public function handle()
    {
        $urls = Url::whereBetween('created_at', [now()->subMinutes(30), now()])->get();

        foreach ($urls as $url ){
            $url->shortened_url = "";
            $url->save();

            \Mail::to('mwauramargaret1@gmail.com')->send(new \App\Mail\ShortUrlDisabled($url));
        }
    }
}
