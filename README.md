[![Integration](https://github.com/KUHdo/laravel-content/actions/workflows/integration.yml/badge.svg)](https://github.com/KUHdo/laravel-content/actions/workflows/integration.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=KUHdo_laravel-content&metric=alert_status&token=3fed28ae0d420bde655febfac38f1fe139f53c66)](https://sonarcloud.io/summary/new_code?id=KUHdo_laravel-content)

# Laravel-Content

This package provides a text management system. 
The content can be stored with multiple translations and its texts.

## Basic structure

The access of texts is always through the content model. It can be combined with a contentable model.
But if no model exists or is required it can be saved without the contentable, as plain content.

Second, the translation and therefore also the content can be accessed with the translation key.

## How to use it with a model:

The trait hasContents should be implements in the model like this:

`class Product extends Model implements Contentable`

`use HasContents;`

**Create content** <br>
Now content can be created. Like this or through an action.

         $contentable = Contentable::for(Product)->key($translationKey)->texts($texts)->save();

## How to use it without a model:

---> under construction <----

## How to access the content:
E.g. product model (The product model has a description text stored.)

    $product->getContent('description'); // Will return only the content 
    stored by translation key description.
**Or** 

    $product->contents  // Will return a collection of all contents stored for this model.

## Update the content:

A translation can be updated by posting the new text. The old records in remain in the database for version control if wanted.

## Interpolate the Text:

If necessary the texts can be stored with {placeholders}. 
Then the required text will be injected in the placeholders by using the $vars in the getContent($slug, $vars) method.

`$product->getContent('description', ['product' => 'Towel']);`

## Actions

There are several actions that can be used. For further information check /src/Actions folder.
 
## Routes

These routes are available for the usage of the package.

`Route::apiResource('contents', ContentController::class);`<br>
`Route::get('contents/{content}/texts', [TextController::class, 'index'])->name('contents.texts.index');`<br>
`Route::post('contents/{content}/texts', [TextController::class, 'store'])->name('contents.texts.store');`<br>
`Route::delete('contents/{content}/texts/{text}', [TextController::class, 'destroy'])->name('contents.texts.destroy');`<br>
`Route::get('texts/{text}', [TextController::class, 'show'])->name('texts.show');`<br>
