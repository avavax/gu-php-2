<h1>Изменить данные о товаре</h1>

<form action="" method="post">
    <input type="text" name="name" placeholder="название" value="<?=$good->name; ?>"><br><br>
    <input type="text" name="info" placeholder="инфо" value="<?=$good->info; ?>"><br><br>
    <input type="text" name="price" placeholder="цена" value="<?=$good->price; ?>"><br><br>
    <input type="hidden" value="changeGood" name="action">
    <input type="hidden" value="<?=$good->id; ?>" name="id">
    <input type="submit" ><br><br>
</form>

