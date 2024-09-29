<?php

use App\Listeners\GenerateSitemap;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\Parsers\JigsawMarkdownParser;
use TightenCo\Jigsaw\Parsers\MarkdownParserContract;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

$events->afterBuild(GenerateSitemap::class);

$container->bind(MarkdownParserContract::class, MyMarkdownParser::class);

class MyMarkdownParser extends JigsawMarkdownParser
{
    public function __construct() {
        parent::__construct();

        $this->url_filter_func = function($url) {
            return url($url);
        };
    }
}
