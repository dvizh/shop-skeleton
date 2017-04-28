<?php
use yii\helpers\Url;
use dvizh\shop\models\Category;
use dvizh\shop\widgets\ShowPrice;
use dvizh\filter\widgets\FilterPanel;
use dvizh\field\widgets\Show;
use dvizh\cart\widgets\ElementsList;
use dvizh\cart\widgets\CartInformer;
use dvizh\cart\widgets\BuyButton;
use dvizh\order\widgets\OrderForm;
use dvizh\promocode\widgets\Enter;
use dvizh\certificate\widgets\CertificateWidget;

/* @var $this yii\web\View */

$this->title = 'Модули Dvizh';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Во дела</h1>

        <p class="lead">Ниже представлены некоторые важные виджеты. Они работают сообща, хоть и являются частью разных модулей.</p>
    </div>

    <?php if(!$categories) { ?>
        <p>Заполните категории и товары в <a href="<?=Url::toRoute(['/backend/web/']);?>">админке</a>.</p>
    <?php } else { ?>
        <div class="body-content">

            <h2>1. Выберите категорию</h2>
            <ul class="nav nav-pills">
                <?php foreach($categories as $cat) { ?>
                    <li <?php if($cat->id == $category->id) echo 'class="active"';?>><a href="<?=Url::toRoute(['/site/index', 'categoryId' => $cat->id]);?>"><?=$cat->name;?></a></li>
                <?php } ?>
            </ul>

            <h2>2. Отфильтруйте товар</h2>
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

            <h2>3. Положите в корзину товар</h2>
            <div class="row" id="productsList">
                <?php foreach($products as $product) { ?>
                    <div class="col-md-6 product-block">
                        <figure>
                            <img src="<?=$product->getImage()->getUrl('200x200');?>" alt="<?=$product->name;?>" />
                        </figure>
                        <h3><?=$product->name;?></h3>

                        <fieldset>
                            <legend>dvizh\field\widgets\Show</legend>
                            <div>
                                <?=Show::widget(['model' => $product]);?>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>dvizh\shop\widgets\ShowPrice</legend>
                            <div>
                                <?=ShowPrice::widget(['model' => $product]);?> р.
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>dvizh\cart\widgets\BuyButton</legend>
                            <div>
                                <?=BuyButton::widget(['model' => $product]);?>
                            </div>
                        </fieldset>

                    </div>
                <?php } ?>
            </div>

            <h2>4. Проверьте корзину</h2>
            <fieldset>
                <legend>dvizh\cart\widgets\ElementsList</legend>
                <div>
                    <?=ElementsList::widget();?>
                </div>
            </fieldset>

            <fieldset>
                <legend>dvizh\cart\widgets\CartInformer</legend>
                <div>
                    <?=CartInformer::widget();?>
                </div>
            </fieldset>

            <h2>5. Воспользуйтесь маркетингом</h2>

            <div class="row">
                <div class="col-md-6">
                    <fieldset>
                        <legend>dvizh\promocode\widgets\Enter</legend>
                        <div>
                            <?=Enter::widget();?>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset>
                        <legend>dvizh\certificate\widgets\CertificateWidget</legend>
                        <div>
                            <?=CertificateWidget::widget();?>
                        </div>
                    </fieldset>
                </div>
            </div>

            <h2>6. Совершите заказ</h2>
            <fieldset>
                <legend>dvizh\order\widgets\OrderForm</legend>
                <div>
                    <?=OrderForm::widget();?>
                </div>
            </fieldset>

        </div>
    <?php } ?>
</div>
