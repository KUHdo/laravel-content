<?php

namespace KUHdo\Content\Http\Controllers;

use KUHdo\Content\Facades\Content as ContentFacade;
use KUHdo\Content\Http\Requests\ContentStoreRequest;
use KUHdo\Content\Http\Requests\ContentUpdateRequest;
use KUHdo\Content\Http\Resources\ContentCollection;
use KUHdo\Content\Http\Resources\ContentResource;
use KUHdo\Content\Models\Content;
use Symfony\Component\HttpFoundation\Response;

class ContentController
{
    /**
     * Returns a content collection.
     */
    public function index(): ContentCollection
    {
        return ContentCollection::make(Content::all());
    }

    /**
     * Stores a content with required contentable, translation key and texts, with lang and value.
     */
    public function store(ContentStoreRequest $request): ContentResource
    {
        $data = $request->validated();

        $contentable = (new $data['contentable_type'])->find($data['contentable_id']);

        $content = ContentFacade::for($contentable);
        collect($data['texts'])->reduce(fn ($content, $text) => $content->text($text['lang'], $text['value']), $content);
        if (isset($data['key'])) {
            $content->key($data['key']);
        }
        $content = $content->save();

        return ContentResource::make($content);
    }

    /**
     * Returns a requested content as resource.
     */
    public function show(Content $content): ContentResource
    {
        return ContentResource::make($content);
    }

    /**
     * Updates a translation key of the content. Text should be always stored new and never updated.
     */
    public function update(ContentUpdateRequest $request, Content $content): ContentResource
    {
        $data = $request->validated();
        $content->translation->key = $data['key'];
        $content->refresh();

        return ContentResource::make($content);
    }

    /**
     * Deletes the content.
     */
    public function destroy(Content $content): Response
    {
        $content->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
