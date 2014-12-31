<!doctype html>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<title>Sample Code for Nian</title>
        <meta name="description" content="Code Sample for Nian Wang">
		<link rel="stylesheet" href="css/base.css" type="text/css" />
		<link rel="stylesheet" href="css/sample.css" type="text/css" />
	</head>
	<body>
        <h1>Code Sample for Nian</h1>

        <p>Example of Slim micro-framework/routing, Composer/autoloading/namespaces, image manipulation, error handling,
        and other goodies.</p>

        <figure alt="The Creative Difference (original)">
            <figcaption>Original PNG image</figcaption>
            <figcaption><small>(By <a rel="author" href="http://ollymoss.com">Olly Moss</a>)</small></figcaption>
            <img src="images/thedifference.png" alt="" />
        </figure>

<?php foreach ($images as $image): ?>
        <figure alt="The Creative Difference (Orientation: <?= $image['orientation']; ?>)">
            <figcaption>JPG image (orientation <?= $image['orientation']; ?>)</figcaption>
            <img src="<?= $image['thumb_uri']; ?>" alt="" />
            <img src="<?= $image['crop_uri']; ?>" alt="" />
        </figure>
<?php endforeach; ?>

        <footer><small>&copy; 2013-<?= date('Y'); ?>, Nian Wang</small></footer>
	</body>
</html>
