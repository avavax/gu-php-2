<?php /**@var array $users */ ?>
<h1>Товары</h1>

<?php foreach ($products as $product): /**@var  App\models\User $user */ ?>
    <h2><a href="/?c=product&a=product&id=<?=$product->id; ?>"><?= $product->name ?></a></h2>
    <p><?=$product->info ?></p>
    <hr>
<?php endforeach; ?>
