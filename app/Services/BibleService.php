<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BibleService
{
    private const FIRST_BIBLE_BOOK = 0;
    private const FIRST_BIBLE_BOOK_CHAPTER = 0;

    private $bookId;
    private $chapterId;

    protected $bibleResource;

    public function __construct(int $bookId = self::FIRST_BIBLE_BOOK, int $chapterId = self::FIRST_BIBLE_BOOK_CHAPTER)
    {
        $this->setBookId($bookId);
        $this->setChapterId($chapterId);

        $this->bibleResource = json_decode(Storage::disk('public')->get('bible-json.json'), true);
    }

    public function getBookId(): int
    {
        return $this->bookId ?? null;
    }

    public function setBookId(int $bookId)
    {
        $this->bookId = $bookId;
    }

    public function getChapterId(): int
    {
        return $this->chapterId ?? null;
    }

    public function setChapterId(int $chapterId)
    {
        $this->chapterId = $chapterId;
    }

    public function getCurrentDayBibleChapters(): array
    {
        return [
            'bookName' => $this->bibleResource['Books'][$this->getBookId()]['BookName'],
            'chapters' => array_slice($this->bibleResource['Books'][$this->getBookId()]['Chapters'], $this->getChapterId(), 3)
        ];
    }

    public function getBibleNames(BibleService $bible): array
    {
        return array_map(function($bibleBook) {
            return $bibleBook['BookName'];
        }, $bible->bibleResource['Books']);
    }

    public function bible() {
        return Response::json($this->bibleResource['Books']);
    }
}