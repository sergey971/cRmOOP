<?php

$title = 'Edit user';
ob_start();
/* ob_start() - это функция PHP, которая запускает буферизацию вывода. Она используется для перехвата вывода скрипта и сохранения его во временном буфере, вместо непосредственной отправки вывода на клиентскую сторону.
Когда функция ob_start() вызывается, все последующие выводы, которые должны быть отправлены на клиентскую сторону, не будут отправлены непосредственно, а будут сохранены во временном буфере. Вы можете использовать этот буфер, чтобы модифицировать, обработать или сохранить вывод до момента, когда вы захотите его отправить на клиентскую сторону.*/
var_dump($user);
?>
<h1>Edit user</h1>
<form method="POST" action="index.php?page=users&action=update&id=<?=$user['id'];?>">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="login" name="login" value="<?= $user['login'];?>" required>
  </div>
    <div class="form-group mb-3">
        <label for="admin">Admin</label>
        <select class="form-control" name="admin" id="admin">
          <option value="0" <?php if(!$user['is_admin']){
            echo 'selected';}?>>No</option>

          <option value="1" <?php if($user['is_admin']){
            echo 'selected';}?>>Yes</option>
        </select>
    </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>

