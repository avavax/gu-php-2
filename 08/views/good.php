<?php /**@var  \App\models\entities\Good $good */ ?>
<h1><?= $good->name ?></h1>
<p>
    Цена: <?= $good->price ?>р.
</p>
<p><a href="/basket/add?id=<?=$good->id?>">Добавить в корзину</a></p>
<a href="/good">Назад</a>

