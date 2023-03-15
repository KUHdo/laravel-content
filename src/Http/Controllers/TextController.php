<?php

namespace KUHdo\Content\Http\Controllers;

use Illuminate\Http\JsonResponse;
use KUHdo\Content\Actions\DeleteTextAction;
use KUHdo\Content\Actions\UpdateTextAction;
use KUHdo\Content\Http\Requests\TextStoreRequest;
use KUHdo\Content\Http\Requests\TextUpdateRequest;
use KUHdo\Content\Http\Resources\TextCollection;
use KUHdo\Content\Http\Resources\TextResource;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Models\Text;
use Symfony\Component\HttpFoundation\Response;

class TextController
{
    /**
     * Returns a text collection of the requested content.
     */
    public function index(Content $content): TextCollection
    {
        return TextCollection::make($content->translation->texts);
    }

    /**
     * Stores a text for the content via its translation.
     */
    public function store(TextStoreRequest $request, Content $content): JsonResponse
    {
        $text = Text::create($request->validated());
        $content->translation->texts()->save($text);

        return TextResource::make($text)->toResponse($request)->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Returns the text as a resource.
     */
    public function show(Text $text): TextResource
    {
        return TextResource::make($text);
    }

    /**
     * Updates the translation by creating a new text.
     */
    public function update(TextUpdateRequest $request, Content $content, Text $text): TextResource
    {
        $text = (new UpdateTextAction)($content->translation, $text, $request->validated());

        return TextResource::make($text);
    }

    /**
     * Deletes a text if it passes the DeleteTextAction.
     */
    public function destroy(Content $content, Text $text): Response
    {
        (new DeleteTextAction)($content->translation, $text);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
