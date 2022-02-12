<?php

declare(strict_types=1);

if ($_POST['url']) {
    $site = $_POST['url'];

    $headers = get_headers($site, 1);
//    print_r($headers);

    $codeArray = array_filter($headers, function ($k) {
        if (is_numeric($k)) {
            return $k;
        }
    }, ARRAY_FILTER_USE_KEY);

    $locationArray = is_array($headers['Location']) ? $headers['Location'] : [$headers['Location']];


    echo '<p>' . $site . ' - ' . $headers[0] . '</p>';
    foreach ($locationArray as $key => $el) {
        echo '<p>' . $el . ' - ' . $codeArray[$key + 1] . '</p>';
    }
}

?>

