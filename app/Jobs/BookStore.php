<?php

namespace App\Jobs;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BookStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $title;
    protected $content;
    protected $image;
    /**
     *
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $content, $user_id, $image)
    {
        //
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $book = new Book();
        $book->title = $this->title;
        $book->content = $this->content;
        $book->user_id = $this->user_id;
        $book->image = $this->image;
        $book->save();
    }
}
