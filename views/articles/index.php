<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($articles as $article) : ?>
        <h4><?= $article; ?></h4>
    <?php endforeach; ?>
</body>

</html>