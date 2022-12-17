<?php

namespace App\Domains;

use App\Enums\ContentKind;
use App\Models\Content;
use Illuminate\Database\Eloquent\Collection;

class ContentDomain extends BaseDomain
{
    private $content;
    public function __construct(
        Content $content
    ) {
        $this->content = $content;
    }

    public function createContent(
        string $kind,
        string $contentText
    ): Content {
        $content = new Content();
        $content->kind = $kind;
        $content->content = $contentText;
        $content->saveOrFail();
        return $content;
    }

    public function updateContent(int $id, string $contentText): Content
    {
        $content = $this->content->find($id);
        $content->content = $contentText;
        $content->saveOrFail();
        return $content;
    }

    public function getFirstContent(string $kind): ?Content
    {
        return $this
            ->content
            ->where('kind', $kind)
            ->orderBy('id')
            ->first();
    }

    public function getAbout(): Collection
    {
        return $this->content
            ->whereIn('kind', [
                ContentKind::ABOUT1_TITLE,
                ContentKind::ABOUT1_BODY,
                ContentKind::ABOUT1_FILE_PATH,
                ContentKind::ABOUT2_TITLE,
                ContentKind::ABOUT2_BODY,
                ContentKind::ABOUT2_FILE_PATH,
                ContentKind::ABOUT3_TITLE,
                ContentKind::ABOUT3_BODY,
                ContentKind::ABOUT3_FILE_PATH,
                ContentKind::ABOUT4_TITLE,
                ContentKind::ABOUT4_BODY,
                ContentKind::ABOUT4_FILE_PATH,
                ContentKind::ABOUT5_TITLE,
                ContentKind::ABOUT5_BODY,
                ContentKind::ABOUT5_FILE_PATH,
            ])
            ->get()
            ->keyBy('kind');
    }
}
