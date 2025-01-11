# Kirby HTMX plugin

Little helper utility to keep your code DRY when uring HTMX in Kirby.

## Installation

- unzip [master.zip](https://github.com/bvdputte/kirby-htmx/archive/master.zip) as folder `site/plugins/kirby-htmx` or
- `git submodule add https://github.com/bvdputte/kirby-htmx.git site/plugins/kirby-htmx` or
- `composer require bvdputte/kirby-htmx`

## Usage

1. Make a snippet for each HTMX "_interactive island_".
2. Embed the snippet in your template via Kirby's `snippet()` helper.
3. Use the plugin's `hxHeader()` helper to generate the required hx-data attribute

[HTMX](https://htmx.org) expects the server to reply with hypermedia for HTMX requests.<br>
Inside the snippet, use the `hxHeaders()` helper to add it together with the Hx data attributes on the wrapper element.

On first page load, Kirby will add the snippet as always. For HTMX interaction with the page, Kirby will now respond with only the hypermedia generated from within the snippet.

## Example

```
// snippets/test.php
<section hx-trigger="click" hx-target="this" <?= hxHeaders() ?> hx-swap="outerHTML" id="test">
	<button hx-get="<?= $page->url() . '/time:update' ?>" hx-trigger="click">Test</button> <?= microtime() ?>
</section>
```

```
// in templates/default.php
<?php snippet('test'); ?>
```

## Gotcha's

1. Pages cache: this works with pages cache enabled, but you'll need do send params to a the controller otherwise the entire page will be returned from cache. This will render the plugin defunct.

## Hx-headers

This plugin requires a custom `Hx-Kirby-Snippet` header added to `Hx-header` for this plugin to work.
You cannot use this header key.

Add your other custom headers like this: `hxHeaders(['my-header'=>'My header value"])`.

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/bvdputte/kirby-htmx/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
