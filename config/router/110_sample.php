<?php

/**
 * Routes to ease development and debugging.
 */
return [
    // "mount" => "sample",
    "routes" => [
        [
            "info" => "Sample controller",
            "mount" => "app",
            "handler" => "\Anax\Controller\SampleAppController",
        ],
    ]
];
