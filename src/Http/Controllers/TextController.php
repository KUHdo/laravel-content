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
use Throwable;

class TextController
{
    /**
     * @param Content $content
     * @return TextCollection
     */
    public function index(Content $content): TextCollection
    {
        return TextCollection::make($content->translation->texts);
    }

    /**
     * @param TextStoreRequest $request
     * @param Content          $content
     * @return JsonResponse
     */
    public function store(TextStoreRequest $request, Content $content): JsonResponse
    {
        $text = Text::create($request->validated());
        $content->translation->texts()->save($text);

        return TextResource::make($text)->toResponse($request)->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param Text $text
     * @return TextResource
     */
    public function show(Text $text): TextResource
    {
        return TextResource::make($text);
    }

    /**
     * @param TextUpdateRequest $request
     * @param Content           $content
     * @param Text              $text
     * @return TextResource
     */
    public function update(TextUpdateRequest $request, Content $content, Text $text): TextResource
    {
        $text = (new UpdateTextAction)($content->translation, $text, $request->validated());

        return TextResource::make($text);
    }

    /**
     * @param Content $content
     * @param Text    $text
     * @return \Illuminate\Http\Response
     * @throws Throwable
     */
    public function destroy(Content $content, Text $text): \Illuminate\Http\Response
    {
        (new DeleteTextAction)($content->translation, $text);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
