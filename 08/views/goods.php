<?php /**@var array $goods */ ?>
<h1>Пользователи</h1>

<?php foreach ($goods as $good): /**@var  \App\models\entities\Good $good */ ?>
    <h2>
        <a href="/good/good?id=<?=$good->id?>">
            <?= $good->name ?>
        </a>
    </h2>
    <p><?= $good->price ?> р.</p>
    <hr>
<?php endforeach; ?>
