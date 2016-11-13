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

                <div class="top-slider">
                    <div id="owl-carousel-top" class="margin-bottom-30 text-center">
                        <div class="owl-carousel-top__item">
                            <a href="/catalog/">
                                <img class="img-responsive owl-carousel-top__img" src="/upload/Clothing.svg" alt="picture">
                            </a>
                        </div>
                        <div class="owl-carousel-top__item">
                            <a href="/news/2/">
                                <img class="img-responsive owl-carousel-top__img" src="/upload/images/news/2.jpg" alt="picture">
                            </a>
                        </div>
                        <div class="owl-carousel-top__item">
                            <a href="/news/4/">
                                <img class="img-responsive owl-carousel-top__img" src="/upload/images/news/4.jpg" alt="picture">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>

                    <?php foreach ($latestProducts as $latestProductsItem):?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <div class="img-product-wrapper">
                                        <a href="/product/<?php echo $latestProductsItem['id']?>">
                                            <img class="img-responsive" src="<?php echo Product::getImage($latestProductsItem['id']);?>" alt="<?php echo $latestProductsItem['picture']?>" />
                                        </a>
                                    </div>
                                        <h2><?php echo $latestProductsItem['price']?> $</h2>
                                    <a href="/product/<?php echo $latestProductsItem['id']?>">
                                        <p><?php echo $latestProductsItem['title']?></p>
                                    </a>
                                    <a href="#" data-id="<?php echo $latestProductsItem['id']?>" class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>В корзину
                                    </a>
                                </div>
                                <?php if ($latestProductsItem['is_new']):?>
                                    <img src="/template/images/home/new.png" class="new" alt=""/>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>

                </div><!--features_items-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>
                    <div id="owl-carousel-bottom">
                        <?php foreach($recommendedProducts as $recommendedProductsItem):?>
                        
                            <div class="item">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <div class="img-product-wrapper">
                                                <a href="/product/<?php echo $recommendedProductsItem['id']?>">
                                                    <img class="img-responsive" src="<?php echo Product::getImage($recommendedProductsItem['id'])?>" alt="<?php echo $recommendedProductsItem['title']?>" />
                                                </a>
                                            </div>
                                            <h2><?php echo $recommendedProductsItem['price']?></h2>
                                            <a href="/product/<?php echo $recommendedProductsItem['id']?>">
                                                <p><?php echo $recommendedProductsItem['title']?></p>
                                            </a>
                                            <a href="#" data-id="<?php echo $recommendedProductsItem['id']?>" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>В корзину
                                            </a>
                                        </div>
                                        <?php if ($recommendedProductsItem['is_new']): ?>
                                            <img src="/template/images/home/new.png" class="new" alt="is_new" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT.'/views/layouts/footer.php'); ?>
