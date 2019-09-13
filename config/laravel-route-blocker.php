<?php
    return [

        // WHITELIST EXAMPLE
        'whitelist' => [

            'group1' => [
                env('IP1'),
                env('IP2'),
            ],

            'group2' => [
            ],

        ],

        // RESPONSE SETTINGS
        'redirect_to'      => 'https://app.hotelapp.cloud/deny',   // URL TO REDIRECT IF BLOCKED (LEAVE BLANK TO THROW STATUS)
        'response_status'  => 403,  // STATUS CODE (403, 404 ...)
        'response_message' => ''    // MESSAGE (COMBINED WITH STATUS CODE)

    ];

?>