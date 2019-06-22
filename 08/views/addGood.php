<h1>Добавить товар</h1>

<form action="" method="post">
    <input type="text" name="name" placeholder="название" value="<?=$good['name'] ?>"><br><br>
    <input type="text" name="info" placeholder="инфо" value="<?=$good['info'] ?>"><br><br>
    <input type="text" name="price" placeholder="цена" value="<?=$good['price'] ?>"><br><br>
    <input type="hidden" value="addGood" name="action">
    <input type="submit" ><br><br>
</form>

