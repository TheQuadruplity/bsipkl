
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AAA</title>

    <!-- Jquery -->
    <script src="<?= esc(base_url())?>/vendor/jquery/jquery.min.js"></script>

</head>

<body>
    <h1>Form Memo Pengantar Persekot</h1>
    <h2><?= esc($reg)?></h2>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim quod reiciendis amet exercitationem dolorem saepe dolores officia et debitis praesentium excepturi qui delectus, repellendus doloribus molestiae. Aliquam voluptates enim illum.</p>

    <?= esc(print_r($data))?>
    

    <script>window.print()</script>
</body>

</html>