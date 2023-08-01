<?php

$title = 'User list';
ob_start();
/* ob_start() - это функция PHP, которая запускает буферизацию вывода. Она используется для перехвата вывода скрипта и сохранения его во временном буфере, вместо непосредственной отправки вывода на клиентскую сторону.

Когда функция ob_start() вызывается, все последующие выводы, которые должны быть отправлены на клиентскую сторону, не будут отправлены непосредственно, а будут сохранены во временном буфере. Вы можете использовать этот буфер, чтобы модифицировать, обработать или сохранить вывод до момента, когда вы захотите его отправить на клиентскую сторону.*/
?>

<h1>User list</h1>
<a href="index.php?page=users&action=create" class="btn btn-success">Create user</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Email verification</th>
            <th scope="col">Is admin</th>
            <th scope="col">Role</th>
            <th scope="col">Is active</th>
            <th scope="col">Last login</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td scope="row"><?php echo $user['id']; ?></td>
                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['create_at']; ?></td>
                <td><?php echo $user['is_admin'] ? 'Yes' : 'No'; ?></td>

                <td>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>