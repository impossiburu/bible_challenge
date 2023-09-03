<?php

namespace App\Console\Commands;

use App\Entities\Bible;
use App\Models\Quest;
use App\Models\User;
use App\Services\BibleService;
use Illuminate\Console\Command;

class QuestUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quest:update';

    public $users = [];
    private BibleService $bibleService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that update quest of user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = User::where('start_challenge', 1)->get();
        $this->bibleService = new BibleService(new Bible());
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            $newUserQuest = [];
            $lastUserQuest = $user->quests->last();

            $newUserQuest['user_id'] = $lastUserQuest->user_id;
            $newUserQuest['book_id'] = $lastUserQuest->book_id;
            $newUserQuest['chapter_id'] = $lastUserQuest->chapter_id;
            $newUserQuest['complete'] = false;

            if ($lastUserQuest->book_id == Bible::COUNT_OF_BOOKS && $lastUserQuest->chapter_id == ($this->bibleService->getBibleChaptersCount($lastUserQuest->book_id) - 1)) {
                continue;
            }

            if (empty($this->bibleService->bible->getCurrentDayBibleChapters($lastUserQuest->book_id, $lastUserQuest->chapter_id + 3)['chapters'])) {
                $newUserQuest['book_id'] = $lastUserQuest->book_id + 1;
                $newUserQuest['chapter_id'] = 0;
                $user->level += 1;
                $user->save();
            } else {
                $newUserQuest['chapter_id'] = $lastUserQuest->chapter_id + Bible::COUNT_OF_CHAPTER;
            }

            $newUserQuest['book_name'] = $this->bibleService->bible->getBibleNameBookById($newUserQuest['book_id']);

            Quest::create($newUserQuest);
        }

        return 0;
    }
}
