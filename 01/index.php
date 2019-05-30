<?php

// 1 -3  Придумать класс, который описывает продукт. Описать свойства, методы

class Product {

	protected $object_type = 'product';

	public $name;
	public $description;
	public $short_description;
	public $sku;
	public $price;
	public $quantity;

    public function __construct ( 
    	$name = '',
		$description ='',
		$short_description = '',
		$sku = '',
		$price = '', 
		$image_id = '', 
		$quantity = 0
     ) {
		$this->name = $name;
		$this->description = $description;
		$this->short_description = $short_description;
		$this->sku = $sku;
		$this->price = $price;
		$this->image_id = $image_id;
		$this->quantity = $quantity;									
    }	

    public function buy ( int $buy_quantity ) {
    	if ($this->quantity > $buy_quantity) {
    		return 'Not enought';
    	} else {
    		$this->quantity -= $buy_quantity;
    		return 'Done';
    	}
    }

    public function show() {
    	$result = $this->open_tag('product');
    	$result .= "Наименование товара - {$this->name} <br>";
    	$result .= "Описание - {$this->description} <br>";
    	$result .= "Цена - {$this->price} <br>";
    	$result .= $this->quantity > 0 ? "На складе - {$this->quantity} шт <br>" : 'Нет в наличии<br>';
    	$result .= $this->close_tag();
    	return $result;
    }

    protected function open_tag( $tag_class ) {
    	return "<div class='{$tag_class}'>";
    } 

    protected function close_tag() {
    	return '</div>';
    } 
}

$product1 = new Product(
	'Утюг' , 
	'хороший железный утюг',
	'хороший утюг',
	'123987',
	'2000',
	'267353',
	12 );

echo( $product1->show() );

// 4. Придумать наследников - вариативный товар

class Variation_Product extends Product {

	public $variations;

    public function __construct ( 
    	$name = '',
		$description ='',
		$short_description = '',
		$sku = '',
		$price = '', 
		$image_id = '', 
		$quantity = 0,
		$variations = []
     ) {
        parent::__construct($name, $description, $short_description, $sku, $price, $image_id, $quantity);
        $this->variations = $variations;
								
    }

    public function show() {
    	$result = $this->open_tag('product');
    	$result .= "Наименование товара - {$this->name} <br>";
    	$result .= "Описание - {$this->description} <br>";
    	$result .= "Цена - {$this->price} <br>";
    	$result .= "Варианты - {$this->variations_show()} <br>";
    	$result .= $this->quantity > 0 ? "На складе - {$this->quantity} шт <br>" : 'Нет в наличии<br>';
    	$result .= $this->close_tag();
    	return $result;

    }

    private function variations_show() {
    	$result = '<br>';
    	foreach ($this->variations as $value) {
    		$result .= $value . ', ';
    	}
    	return $result;
    }    

}

$product2 = new Variation_Product (
	'Рубашка' , 
	'хорошая хлопковая рубашка',
	'хорошая рубашка',
	'123987',
	'1200',
	'267354',
	10,
	['красная', 'чёрная', 'розовая', 'синяя'] );

echo( $product2->show() );

// 5. Прокомментировать код

class A {
	public function foo() {
		static $x = 0;
		//echo ++$x;
	}
}

$a1 = new A();
$a2 = new A();
$a1->foo(); // создаётся статическая переменная $x приравнивается нулю, увеличивается на 1 и показывается $x = 1
$a2->foo(); // статическая пременная увеличивает ещё на 1 и показывается $x = 2
$a1->foo(); // статическая пременная увеличивает ещё на 1 и показывается $x = 3
$a2->foo(); // статическая пременная увеличивает ещё на 1 и показывается $x = 4

// 6. Прокомментировать код

class A2 {
	public function foo() {
		static $x = 0;
		echo ++$x;
	}
}
class B extends A2 {

}

$a1 = new A2();
$b1 = new B();
$a1->foo(); // создаётся статическая переменная $x в классе АА приравнивается нулю, увеличивается на 1 и показывается $x = 1
$b1->foo(); // создаётся статическая переменная $x в классе В приравнивается нулю, увеличивается на 1 и показывается $x = 1
$a1->foo(); // статическая пременная в классе АА увеличивается ещё на 1 и показывается $x = 2
$b1->foo(); // статическая пременная в классе B увеличивается ещё на 1 и показывается $x = 2

/* Вывод дочерний класс работает со статической переменной незаивисимо от родительского.
Создаётся две статических переменных, каждая для своего класса */

