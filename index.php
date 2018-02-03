<?php

require_once("vendor/autoload.php");
require_once("Parser.php");

// Получаем список категорий
$html = Parser::getPage([
	"url" => "https://www.svyaznoy.ru/catalog"
]);

if(!empty($html["data"])){

	$content = $html["data"]["content"];

	phpQuery::newDocument($content);

	$categories = pq(".b-category-menu")->find(".b-category-menu__link");

	$tmp = [];

	foreach($categories as $key => $category){

		$category = pq($category);

		$tmp[$key] = [
			"text" => trim($category->text()),
			"url"  => trim($category->attr("href"))
		];

		$submenu = $category->next(".b-category-submenu")->find(".b-category-submenu__link");

		foreach($submenu as $submen){

			$submen = pq($submen);

			$tmp[$key]["submenu"][] = [
				"text" => trim($submen->text()),
				"url"  => trim($submen->attr("href"))
			];
		}
	}

	phpQuery::unloadDocuments();
}
?>

<ul>
	<?php foreach($tmp as $value): ?>
	<li>
		<a href="https://www.svyaznoy.ru<?php echo($value["url"]); ?>" target="_blank">
			<?php echo($value["text"]); ?>
		</a>
		<ul>
			<? if(!empty($value["submenu"])): ?>
			<?php foreach($value["submenu"] as $val): ?>
			<li>
				<a href="https://www.svyaznoy.ru<?php echo($val["url"]); ?>" target="_blank">
					<?php echo($val["text"]); ?>
				</a>
			</li>
			<?php endforeach; ?>
			<? endif; ?>
		</ul>
	</li>
	<?php endforeach; ?>
</ul>

<?php
// Получаем список товаров
$html = Parser::getPage([
	"url" 	  => "https://www.svyaznoy.ru/catalog/phone/224",
	"timeout" => 10
]);

if(!empty($html["data"])){

	$content = $html["data"]["content"];

	phpQuery::newDocument($content);

	$products = pq(".b-listing__generated-container")->find(".b-product-block .b-product-block__content");

	$tmp = [];

	foreach($products as $key => $product){

		$product = pq($product);

		$tmp[] = [
			"name"  => trim($product->find(".b-product-block__name")->text()),
			"image" => trim($product->find(".b-product-block__image img")->attr("data-original")),
			"price" => trim($product->find(".b-product-block__misc .b-product-block__visible-price")->text()),
			"url" 	=> trim($product->find(".b-product-block__info .b-product-block__main-link")->attr("href"))
		];

		$chars = $product->find(".b-product-block__info .b-product-block__tech-chars li");

		foreach($chars as $char){

			$tmp[$key]["chars"][] = pq($char)->text();
		}
	}

	phpQuery::unloadDocuments();
}
?>

<div class="tovars">
	<?php foreach($tmp as $value): ?>
	<a href="https://www.svyaznoy.ru<?php echo($value["url"]); ?>" target="_blank" class="tovar">
		<img src="<?php echo($value["image"]); ?>" alt="<?php echo($value["name"]); ?>" />
		<span class="name">
			<?php echo($value["name"]); ?>
		</span>
		<span class="price">
			<?php echo($value["price"]); ?>
		</span>
		<ul class="chars">
			<? if(!empty($value["chars"])): ?>
			<?php foreach($value["chars"] as $val): ?>
			<li>
				<?php echo($val); ?>
			</li>
			<?php endforeach; ?>
			<? endif; ?>
		</ul>
	</a>
	<?php endforeach; ?>
</div>

<style>
	.tovars{
		padding: 15px;
	}
		.tovars .tovar{
			display: block;
			padding: 15px;
			color: #000;
			text-decoration: none;
			border-bottom: 1px solid;
			margin-bottom: 20px;
		}
		.tovars .tovar:hover{
			opacity: 0.7;
		}
		.tovars .tovar:last-child{
			border-bottom: none;
			margin-bottom: 0;
		}
			.tovars .tovar img{
				margin-bottom: 5px;
			}
			.tovars .tovar .name{
				display: block;
			}
			.tovars .tovar .price{
				display: block;
			}
			.tovars .tovar .chars{
				padding-left: 15px;
				margin-bottom: 0;
			}
				.tovars .tovar .chars li{
					margin-bottom: 3px;
				}
</style>