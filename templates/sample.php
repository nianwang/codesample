<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sample Code</title>
		<link rel="stylesheet" href="css/base.css" type="text/css" />
		<link rel="stylesheet" href="css/sample.css" type="text/css" />
	</head>
	<body>
        <figure alt="The Creative Difference (original)">
            <figcaption>Original PNG image</figcaption>
            <img src="images/thedifference.png" alt="" />
        </figure>

<?php for ($i = 1; $i <= 8; $i++): ?>
        <figure alt="The Creative Difference (Orientation: <?php echo $i; ?>)">
            <figcaption>JPG image (orientation <?php echo $i; ?>)</figcaption>
            <img src="crop/thedifference_<?php echo $i; ?>.jpg" alt="" />
            <img src="thumb/thedifference_<?php echo $i; ?>.jpg" alt="" />
        </figure>
<?php endfor; ?>
	</body>
</html>
