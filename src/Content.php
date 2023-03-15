<?php

namespace KUHdo\Content;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Content\Actions\CreateContentAction;
use KUHdo\Content\Actions\CreateTranslationAction;
use KUHdo\Content\Contracts\Contentable;
use KUHdo\Content\Models\Text;

class Content
{
    private Contentable $contentable;

    private Collection $texts;

    private ?string $key;

    /**
     * Constructs texts as Collection and key as null.
     */
    public function __construct()
    {
        $this->texts = new Collection();
        $this->key = null;
    }

    /**
     * This method will create the contentable.
     */
    public function for(Contentable $contentable): self
    {
        $this->contentable = $contentable;

        return $this;
    }

    /**
     * This method will create a new text.
     */
    public function text(string $lang, string $value): self
    {
        $this->texts->push(new Text(['lang' => $lang, 'value' => $value]));

        return $this;
    }

    /**
     * This method will create the texts. This is a collection of all texts from one translation.
     */
    public function texts(Collection $texts): self
    {
        $this->texts = $texts;

        return $this;
    }

    /**
     * This method will create the key of the translation.
     */
    public function key(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * This method will save a new content with translation and it's texts.
     */
    public function save(): Models\Content
    {
        $translation = (new CreateTranslationAction)($this->texts, $this->key);
        return (new CreateContentAction)($this->contentable, $translation);
    }

    /**
     * This method will create a new content from a contentable with translation and it's texts.
     */
    public function create(Contentable $contentable, Collection $texts, ?string $key = null): Models\Content
    {
        return $this->for($contentable)->texts($texts)->key($key)->save();
    }
}
