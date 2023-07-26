<?php

namespace App\Services;

use App\Entities\Bible;

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

    public function bible() {
        return $this->bible->getBibleBooks();
    }
}