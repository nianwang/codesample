<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<title>Sample Code</title>
        <meta name="description" content="Sample code">
		<link rel="stylesheet" href="css/base.css" type="text/css" />
		<link rel="stylesheet" href="css/sample.css" type="text/css" />
	</head>
	<body>
        <figure alt="The Creative Difference (original)">
            <figcaption>Original PNG image</figcaption>
            <small>(By <a rel="author" href="http://ollymoss.com">Olly Moss</a>)</small>
            <img src="images/thedifference.png" alt="" />
        </figure>

<?php for ($i = 1; $i <= 8; $i++): ?>
        <figure alt="The Creative Difference (Orientation: <?php echo $i; ?>)">
            <figcaption>JPG image (orientation <?php echo $i; ?>)</figcaption>
            <img src="crop/thedifference_<?php echo $i; ?>.jpg/200/200" alt="" />
            <img src="thumb/thedifference_<?php echo $i; ?>.jpg/353/353" alt="" />
        </figure>
<?php endfor; ?>

        <footer><small>&copy; 2013, Nian Wang</small></footer>
	</body>
</html>
