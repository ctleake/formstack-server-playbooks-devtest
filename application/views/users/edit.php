<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('users/edit/'.$users_item['id']); ?>
<table>
    <tr>
        <td><label for="email">Email</label></td>
        <td><input type="input" name="email" size="50" value="<?php echo $users_item['email'] ?>" /></td>
    </tr>
    <tr>
        <td><label for="first_name">First Name</label></td>
        <td><input type="input" name="first_name" size="50" value="<?php echo $users_item['first_name'] ?>" /></td>
    </tr>
    <tr>
        <td><label for="last_name">Last Name</label></td>
        <td><input type="input" name="last_name" size="50" value="<?php echo $users_item['last_name'] ?>" /></td>
    </tr>
    <tr>
        <td><label for="password">Password</label></td>
        <td><input type="password" name="password" size="50" /></td>
    </tr>
    <tr>
        <td><label for="passconf">Password Confirm</label></td>
        <td><input type="password" name="passconf" size="50" /></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Edit user item" /></td>
    </tr>
</table>
</form>