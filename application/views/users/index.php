<h2><?php echo $title; ?></h2>

<table border='1' cellpadding='4'>
    <tr>
        <td><strong>Email</strong></td>
        <td><strong>First Name</strong></td>
        <td><strong>Last Name</strong></td>
        <td><strong>Action</strong></td>
    </tr>
    <?php foreach ($users as $users_item): ?>
        <tr>
            <td><?php echo $users_item['email']; ?></td>
            <td><?php echo $users_item['first_name']; ?></td>
            <td><?php echo $users_item['last_name']; ?></td>
            <?php /* ?>
            <td><?php echo $users_item['password']; ?></td>
            <?php */ ?>
            <td>
                <a href="<?php echo site_url('users/edit/'.$users_item['id']); ?>">Edit</a> |
                <a href="<?php echo site_url('users/delete/'.$users_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>