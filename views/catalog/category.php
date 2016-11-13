<?php include(ROOT.'/views/layouts/header.php'); ?>

<section class="height-screen">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="panel-group category-products">
                        <?php foreach($categories as $category):?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="/category/<?php echo $category['id']?>" class="<?php if ($category['id']==$categoryId) echo 'active'?>"><?php echo $category['title']?></a></h4>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"><?php echo $categoryName?></h2>

                    <?php foreach ($categoryProducts as $latestProductsItem):?>
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
                                        <a href="#" data-id="<?php echo $latestProductsItem['id']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($latestProductsItem['is_new']):?>
                                        <img src="/template/images/home/new.png" class="new" alt=""/>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>

                </div><!--features_items-->
                
                <!--Постраничная навигация-->
                <!--Если общее количество выводимых товаров больше чем выводится
                 на одну страницу подключаем пагинацию-->
                <?php if ($total > Product::SHOW_BY_DEFAULT):?>
                    <div class="pagination-block">
                        <?php echo $pagination->get();?>
                    </div>
                <?php endif;?>

            </div>
        </div>
    </div>
</section>

<?php include(ROOT.'/views/layouts/footer.php'); ?>
