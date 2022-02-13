<?php

declare(strict_types=1);

class CheckRedirect {
    public function run(string $site = 'wp.pl') {
        $headers = get_headers($site, 1);

        $codeArray = array_filter($headers, function ($k) {
            if (is_numeric($k)) {
                return $k;
            }
        }, ARRAY_FILTER_USE_KEY);

        $locationArray = is_array($headers['Location']) ? $headers['Location'] : [$headers['Location']];

        $content = '';

        $content = '<p>' . $site . ' <br> ' . $headers[0] . '</p>';
        foreach ($locationArray as $key => $el) {
            if ($el) {
                $content .= '<p><i class="fa-solid fa-arrow-down"></i></p>';
                $content .= '<p>' . $el . ' <br> ' . $codeArray[$key + 1] . '</p>';
            }
        }
        return $content;
    }
}