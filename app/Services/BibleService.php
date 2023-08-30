<?php

namespace App\Services;

use App\Entities\Bible;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class BibleService
{
    public Bible $bible;

    public function __construct(Bible $bible)
    {
        $this->bible = $bible;
    }

    public function getBibleNames(): array
    {
        return array_map(function($bibleBook) {
            return $bibleBook['BookName'];
        }, $this->bible->getBibleBooks());
    }

    public function bibleBookAjax(): array
    {
        return $this->bible->getBibleBooks();
    }

    public function getBibleChaptersCount(int $bookId): int
    {
        return count($this->bible->getBibleBookChapters($bookId));
    }
}