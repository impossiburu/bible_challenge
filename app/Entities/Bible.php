<?php

namespace App\Entities;

use Illuminate\Support\Facades\Storage;

class Bible
{
    public const COUNT_OF_CHAPTER = 3;
    public const COUNT_OF_BOOKS = 65;

    protected $bibleResource;

    public function __construct()
    {
        $this->bibleResource = json_decode(Storage::disk('public')->get('bible-json.json'), true);
    }

    public function getBibleNameBookById(int $bookId): string
    {
        return $this->bibleResource['Books'][$bookId]['BookName'] ?? '';
    }

    public function getBibleBookChapterById(int $bookId, int $chapterId): array
    {
        return $this->bibleResource['Books'][$bookId]['Chapters'][$chapterId] ?? [];
    }

    public function getBibleBooks(): ?array
    {
        return $this->bibleResource['Books'];
    }

    public function getCurrentDayBibleChapters(int $bookId, int $chapterId): array
    {
        return [
            'bookName' => $this->getBibleNameBookById($bookId),
            'chapters' => array_slice($this->bibleResource['Books'][$bookId]['Chapters'], $chapterId, self::COUNT_OF_CHAPTER)
        ];
    }

    public function getBibleBookChapters(int $bookId): array
    {
        return $this->bibleResource['Books'][$bookId]['Chapters'] ?? [];
    }
}