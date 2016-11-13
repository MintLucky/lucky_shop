<?php include(ROOT.'/views/layouts/header.php'); ?>

<section class="height-screen">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">

                        <?php foreach($categories as $category):?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="/category/<?php echo $category['id']?>"><?php echo $category['title']?></a></h4>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img width="100%" src="<?php echo Product::getImage($product['id']);?>" alt="<?php echo $product['picture']?>" />
                                <?php if ($product['is_new']):?>
                                    <img src="/template/images/home/new.png" class="new" alt=""/>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->

                                <h2><?php echo $product['title']?></h2>
                                <p>Код товара: 1089772</p>
                                        <span>
                                            <span>US $<?php echo $product['price']?></span>
                                            <label>Количество:</label>
                                            <input id="count-product-input" type="text" value="1" />
                                            <a data-id="<?php echo $product['id']?>" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                В корзину
                                            </a>
                                        </span>
                                <p>
                                    <b>Наличие:</b>
                                    <?php if ($product['availability'] == 0):?> нет на складе
                                    <?php else:?>в наличии на складе
                                    <?php endif;?>

                                </p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> <?php echo $product['mark']?></p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <p><?php echo $product['description']?></p>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>


<br/>
<br/>

<?php include(ROOT.'/views/layouts/footer.php'); ?>