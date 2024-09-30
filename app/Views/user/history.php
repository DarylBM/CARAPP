<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User History</title>
</head>
<body>
    <h1>Your Submission History</h1>

    <h2>Renting History</h2>
    <?php if (!empty($rentals)): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>First Location</th>
                    <th>Second Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Price</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rentals as $rental): ?>
                    <tr>
                        <td><?= esc($rental['Name']) ?></td>
                        <td><?= esc($rental['Phone']) ?></td>
                        <td><?= esc($rental['FirstLocation']) ?></td>
                        <td><?= esc($rental['SecondLocation']) ?></td>
                        <td><?= esc($rental['StartDate']) ?></td>
                        <td><?= esc($rental['EndDate']) ?></td>
                        <td><?= esc($rental['price']) ?></td>
                        <td><?= esc($rental['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No rental history found.</p>
    <?php endif; ?>
</body>
</html>
