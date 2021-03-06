<?php

namespace KUHdo\Content;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Content\Actions\CreateContentAction;
use KUHdo\Content\Actions\CreateTranslationAction;
use KUHdo\Content\Contracts\Contentable;
use KUHdo\Content\Models\Text;
use Throwable;

class Content
{
    /**
     * @var Contentable
     */
    private Contentable $contentable;

    /**
     * @var Collection
     */
    private Collection $texts;

    /**
     * @var string|null
     */
    private ?string $key;

    /**
     *
     */
    public function __construct()
    {
        $this->texts = new Collection();
        $this->key = null;
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
        $this->texts->push(new Text(['lang' => $lang, 'value' => $value]));

        return $this;
    }

    /**
     * @param Collection $texts
     * @return $this
     */
    public function texts(Collection $texts): self
    {
        $this->texts = $texts;

        return $this;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function key(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return Models\Content
     * @throws Throwable
     */
    public function save(): Models\Content
    {
        $translation = (new CreateTranslationAction)($this->texts, $this->key);
        return (new CreateContentAction)($this->contentable, $translation);
    }

    /**
     * @param Contentable $contentable
     * @param Collection  $texts
     * @param string|null $key
     * @return Models\Content
     * @throws Throwable
     */
    public function create(Contentable $contentable, Collection $texts, ?string $key = null): Models\Content
    {
        return $this->for($contentable)->texts($texts)->key($key)->save();
    }
}
