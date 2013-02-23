<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<title>Sample Code</title>
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

<?php for ($i = 1; $i <= 8; $i++): ?>
        <figure alt="The Creative Difference (Orientation: <?php echo $i; ?>)">
            <figcaption>JPG image (orientation <?php echo $i; ?>)</figcaption>
            <img src="thumb/thedifference_<?php echo $i; ?>.jpg/353/353" alt="" />
            <img src="crop/thedifference_<?php echo $i; ?>.jpg" alt="" />
        </figure>
<?php endfor; ?>

        <footer><small>&copy; 2013, Nian Wang</small></footer>
	</body>
</html>
