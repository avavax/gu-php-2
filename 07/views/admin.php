<h1>Админ-панель</h1>

<h2>Товары</h2><br>

<?php foreach ($goods as $good):  ?>
    <h4>
        <a href="/good/good?id=<?=$good->id?>">
            <?= $good->name ?>
        </a>
    </h4>
    <p><?= $good->price ?> р.</p>
    <hr>
<?php endforeach; ?>

<h2>
	<a href="/admin/addGood">Добавить товар</a>
</h2><br>

<h2>Пользователи</h2><br>

<?php foreach ($users as $user): ?>
    <h4>
        <a href="/user/user?id=<?=$user->id?>">
            <?= $user->login ?>
        </a>
    </h4>
    <p><?= $user->password ?></p>
    <hr>
<?php endforeach; ?>

