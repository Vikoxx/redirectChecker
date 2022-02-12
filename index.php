<?php

declare(strict_types=1);

function checkRedirect(string $site) {

    $headers = get_headers($site, 1);

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

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Śledzenie przekierowań</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Śledzenie przekierowań</h1>
<form action="/" method="post">
    <p>Adres URL</p>
    <input type="text" name="url" required>
    <input type="submit" value="Sprawdź przekierowania">
</form>
<div class="flexContainer">
    <?php if ($_POST['url']): ?>
        <div>
            <h2>https://</h2>
            <?php checkRedirect('https://' . $_POST['url']); ?>
        </div>
        <div>
            <h2>https://www.</h2>
            <?php checkRedirect('https://www.' . $_POST['url']); ?>
        </div>
        <div>
            <h2>http://</h2>
            <?php checkRedirect('http://' . $_POST['url']); ?>
        </div>
        <div>
            <h2>http://www.</h2>
            <?php checkRedirect('http://www.' . $_POST['url']); ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
