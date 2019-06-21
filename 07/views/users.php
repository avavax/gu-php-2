<?php /**@var array $users */ ?>
<h1>Пользователи</h1>

<?php foreach ($users as $user): /**@var  \App\models\entities\User $user */ ?>
    <h2>
        <a href="/user/user?id=<?=$user->id?>">
            <?= $user->login ?>
        </a>
    </h2>
    <p><?= $user->password ?></p>
    <hr>
<?php endforeach; ?>
