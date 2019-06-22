<h1>Админ-панель</h1>

<h2>Заказы</h2>

<table>
    <tr>
        <th>ID</th><th>Имя</th><th>Адрес</th>
        <th>Сообщение</th><th>Содержание</th><th>Сумма</th><th>Статус</th>
    </tr>
    <?php foreach ($orders as $order):  ?>
    <tr>
        <td><?=$order->id; ?></td>
        <td><?=$order->name; ?></td>
        <td><?=$order->address; ?></td>
        <td><?=$order->msg; ?></td>
        <td>
            <table>
            <?php 
                $orderItems = json_decode($order->items, JSON_UNESCAPED_UNICODE);
                foreach ($orderItems as $value) : ?>
                <tr>
                    <td><?=$value['name'] ?></td>
                    <td><?=$value['price'] ?></td>
                    <td><?=$value['count'] ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        </td>
        <td><?=array_reduce($orderItems, function( $carry, $elem ) {
                $carry += $elem['count'] * $elem['price'];
                return $carry;                
            }); ?>
        </td>
        <td>
            <form action="/admin/changeOrder?id=<?=$order->id; ?>" method="post">
                <select name="status">
                    <option value="0" 
                        <?php if($order->status == 0) echo ' selected '; ?>>
                    Принят</option>
                    <option value="1"
                        <?php if($order->status == 1) echo ' selected '; ?>>
                    Оплачен</option>
                    <option value="2"
                        <?php if($order->status == 2) echo ' selected '; ?>>
                    Доставляется</option>
                    <option value="3"
                        <?php if($order->status == 3) echo ' selected '; ?>>
                    Закрыт</option>
                    <option value="9"
                        <?php if($order->status == 9) echo ' selected '; ?>>
                    Отменён</option>
                </select>
                <input type="hidden" value="changeOrder" name="action">
                <input type="submit" value="Изменить">
            </form>
        </td>
        
    </tr>
    <?php endforeach; ?>
</table>

<h2>Товары</h2>

<?php foreach ($goods as $good):  ?>
    <h4>
        <a href="/good/good?id=<?=$good->id?>">
            <?= $good->name ?>
        </a>
    </h4>
    <p><?= $good->price ?> р.</p>
    <a href="/admin/changeGood?id=<?=$good->id?>">Изменить данные о товаре</a>
    <a href="/admin/remGood?id=<?=$good->id?>">Удалить товар</a>

<?php endforeach; ?>

<h2>
	<a href="/admin/addGood">Добавить товар</a>
</h2><br>

<h2>Пользователи</h2>

<?php foreach ($users as $user): ?>
    <h4>
        <a href="/user/user?id=<?=$user->id?>">
            <?= $user->login ?>
        </a>
    </h4>
    <p><?= $user->password ?></p>
    <hr>
<?php endforeach; ?>

