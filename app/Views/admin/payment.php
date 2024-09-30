<?= $this->extend('layouts/main') ?>

<body>
<div class="payment-management">
    <h2>Payment Management</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('errors') ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Card Number</th>
                <th>Name</th>
                <th>Address</th>
                <th>Payment Method</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($payments)): ?>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?= esc($payment['id']) ?></td>
                        <td><?= esc($payment['card_number']) ?></td>
                        <td><?= esc($payment['name']) ?></td>
                        <td><?= esc($payment['address']) ?></td>
                        <td><?= esc($payment['payment_method']) ?></td>
                        <td>
                            <a href="<?= base_url('payment/edit/' . esc($payment['id'])) ?>">Edit</a>
                            <a href="<?= base_url('payment/delete/' . esc($payment['id'])) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No payment records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
