<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>
    <div class="container">
        <div class="admin-product-form-container centered">
            <form action="<?= base_url('admins/edit/' . $product['id']); ?>" method="post" enctype="multipart/form-data">
                <h3>Update Product</h3>
                <input type="text" name="product_name" value="<?= esc($product['model']); ?>" class="box" required>
                <input type="number" name="product_price" value="<?= esc($product['price']); ?>" class="box" required>
                <input type="number" name="mileage" value="<?= esc($product['mileage']); ?>" class="box" required>
                <input type="text" name="fueltype" value="<?= esc($product['fueltype']); ?>" class="box" required>
                <input type="text" name="transmission" value="<?= esc($product['transmission']); ?>" class="box" required>
                <input type="file" name="product_image" class="box" accept="image/png, image/jpeg, image/jpg">
                <input type="submit" value="Update Product" name="update_product" class="btn">
                <a href="<?= base_url('admins'); ?>" class="btn">Go Back!</a>
            </form>
        </div>
    </div>
</body>
</html>
