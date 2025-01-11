<?php

Use Kirby\Toolkit\A;

// For composer
@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('bvdputte/htmx', [
	'hooks' => [
		'page.render:before' => function($contentType, $data, $page) {
			if (
				(kirby()->request->header('Hx-Request')) &&
				($snippet = kirby()->request->header('Hx-Kirby-Snippet'))
			) {
				echo snippet($snippet, $data);
				die;
			}
		}
	]
]);

if (!function_exists('hxHeaders')) {
	function hxHeaders(Array $additional=[]) {
		$snippetFile = str_replace(kirby()->roots()->snippets() . '/', '', debug_backtrace()[0]['file']);
		$snippet = substr($snippetFile, 0, strrpos($snippetFile, '.'));

		$headers = A::merge(
			$additional,
			[
				'Hx-Kirby-Snippet' => $snippet
			]
		);

		return "hx-headers='" . json_encode($headers) . "'";
	}
}
