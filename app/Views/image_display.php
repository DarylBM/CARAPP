<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Image</title>
</head>
<body>
    <h1>Uploaded Image</h1>
    <?php if (isset($image)): ?>
        <img src="<?= base_url('uploads/' . $image) ?>" alt="Uploaded Image" style="max-width: 100%; height: auto;">
    <?php else: ?>
        <p>No image uploaded.</p>
    <?php endif; ?>
    <br>
    <a href="<?= site_url('image-upload') ?>">Upload Another Image</a>
</body>
</html>
