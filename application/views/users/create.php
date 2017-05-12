<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('users/create'); ?>
<table>
    <tr>
        <td><label for="email">Email</label></td>
        <td><input type="input" name="email" size="50" /></td>
    </tr>
    <tr>
        <td><label for="first_name">First Name</label></td>
        <td><input type="input" name="first_name" size="50" /></td>
    </tr>
    <tr>
        <td><label for="last_name">Last Name</label></td>
        <td><input type="input" name="last_name" size="50" /></td>
    </tr>
    <tr>
        <td><label for="password">Password</label></td>
        <td><input type="input" name="password" size="50" /></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Create users item" /></td>
    </tr>
</table>
</form>