<h1>Корзина</h1>

<?php foreach($basketGoods as $good) :?>
	<p><strong>наименование: </strong><?=$good['name']; ?></p>
	<p><strong>Цена: </strong><?=$good['price']; ?></p>
	<p><strong>Кол-во: </strong><?=$good['count']; ?></p>
	<br>
<?php endforeach; ?>

<p><strong>Всего товаров на сумму: </strong><?=$sum; ?></p>

<form action="/basket/checkout" method="post">
	<label>Имя</label>	
	<input name="name" type="text"><br><br>
	<label>Адрес</label>	
	<input name="address" type="text"><br><br>
	<label>Сообщение</label>	
	<input name="msg" type="text"><br><br>
	<input name="action" type="hidden" value="checkout">
	<input type="submit" value="Оформить заказ">
</form>



