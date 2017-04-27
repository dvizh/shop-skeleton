<?php
use yii\helpers\Url;
use dvizh\shop\models\Product;
use dvizh\shop\models\Category;
use dvizh\shop\widgets\ShowPrice;
use dvizh\filter\widgets\FilterPanel;

/* @var $this yii\web\View */

$this->title = 'Модули Dvizh';

$categories = Category::find()->all();

if($catId = yii::$app->request->get('categoryId')) {
    $category = Category::findOne($catId);
} else {
    $category = current($categories);
}

$query = Product::find()->category($category->id)->orderBy('id DESC');
$queryForFilter = clone $query;

if($filter = yii::$app->request->get('filter')) {
    $query->filtered($filter);
}

$products = $query->limit(12)->all();
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Во дела!</h1>

        <p class="lead">Ниже представлено большинство виджетов. Они работают сообща, хоть и являются частью разных модулей.</p>
    </div>

    <ul class="nav nav-pills">
        <?php foreach($categories as $cat) { ?>
            <li <?php if($cat->id == $category->id) echo 'class="active"';?>><a href="<?=Url::toRoute(['/site/index', 'categoryId' => $cat->id]);?>"><?=$cat->name;?></a></li>
        <?php } ?>
    </ul>

    <div class="body-content">

        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>dvizh\filter\widgets\FilterPanel</legend>
                    <div>
                        <?=FilterPanel::widget(['itemId' => $category->id, 'findModel' => $queryForFilter, 'ajaxLoad' => true, 'resultHtmlSelector' => '#productsList']); ?>
                    </div>
                </fieldset>
            </div>
        </div>

        <h2>Товары</h2>
        <div class="row" id="productsList">
            <?php foreach($products as $product) { ?>
                <div class="col-md-6 product-block">
                    <figure>
                        <img src="<?=$product->getImage()->getUrl('200x200');?>" alt="<?=$product->name;?>" />
                    </figure>
                    <h3><?=$product->name;?></h3>

                    <fieldset>
                        <legend>dvizh\shop\widgets\ShowPrice</legend>
                        <div>
                            <?=ShowPrice::widget(['model' => $product]);?> р.
                        </div>
                    </fieldset>
                </div>
            <?php } ?>
        </div>

    </div>
</div>
