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

?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Śledzenie przekierowań</title>
    <script src="https://kit.fontawesome.com/5d2cac9ab1.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Śledzenie przekierowań</h1>
<div class="formArea">
    <h2>Adres URL</h2>
    <form action="/" method="post">
        <p><input type="text" name="url" required></p>
        <p><input type="submit" value="Sprawdź przekierowania"></p>
    </form>
</div>
<div class="flexContainer">
    <?php if ($_POST['url']): ?>
        <div>
            <h2>https://</h2>
            <?php echo checkRedirect('https://' . $_POST['url']); ?>
        </div>
        <div>
            <h2>https://www.</h2>
            <?php echo checkRedirect('https://www.' . $_POST['url']); ?>
        </div>
        <div>
            <h2>http://</h2>
            <?php echo checkRedirect('http://' . $_POST['url']); ?>
        </div>
        <div>
            <h2>http://www.</h2>
            <?php echo checkRedirect('http://www.' . $_POST['url']); ?>
        </div>
    <?php endif; ?>
</div>
<script src="script.js"></script>
</body>
</html>