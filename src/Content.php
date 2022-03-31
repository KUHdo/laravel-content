<?php

namespace KUHdo\Content;

use KUHdo\Content\Actions\CreateContentAction;
use KUHdo\Content\Contracts\Contentable;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\DataTransferObjects\TranslationData;
use Throwable;

class Content
{
    /**
     * @var Contentable
     */
    private Contentable $contentable;
    /**
     * @var TranslationData
     */
    private TranslationData $translation;

    /**
     *
     */
    public function __construct()
    {
        $this->translation = new TranslationData();
    }

    /**
     * @return TranslationData
     */
    public function getTranslation(): TranslationData
    {
        return $this->translation;
    }

    /**
     * @param Contentable $contentable
     * @return $this
     */
    public function for(Contentable $contentable): self
    {
        $this->contentable = $contentable;

        return $this;
    }

    /**
     * @param string $lang
     * @param string $value
     * @return $this
     */
    public function text(string $lang, string $value): self
    {
        $this->translation->texts[] = new TextData($lang, $value);

        return $this;
    }

    /**
     * @param TextData[] $texts
     * @return $this
     */
    public function texts(array $texts): self
    {
        $this->translation->texts = $texts;

        return $this;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function key(string $key): self
    {
        $this->translation->key = $key;

        return $this;
    }

    /**
     * @return Models\Content
     * @throws Throwable
     */
    public function save(): Models\Content
    {
        return (new CreateContentAction)($this->contentable, $this->translation);
    }

    /**
     * @param Contentable $contentable
     * @param TextData[]  $texts
     * @param string|null $key
     * @return Models\Content
     * @throws Throwable
     */
    public function create(Contentable $contentable, array $texts, ?string $key = null): Models\Content
    {
        return $this->for($contentable)->texts($texts)->key($key)->save();
    }
}
