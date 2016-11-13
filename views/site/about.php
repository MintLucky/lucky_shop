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

            <div class="col-sm-9">
                <div class="features_items margin-bottom-20"><!--features_items-->
                    <h2 class="title text-center">О нашем магазине</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius voluptas, itaque eos eligendi. Deserunt numquam dolore maxime explicabo tempore amet expedita aut mollitia, fugit natus. Harum illo libero quae ab beatae fugiat asperiores quidem consequatur magni provident soluta ea voluptates nisi quisquam veritatis excepturi impedit quo porro qui vel earum, ipsam omnis tempora. Nihil ratione nisi fugiat natus. Reprehenderit dolorem eius provident obcaecati, ullam explicabo itaque, nemo rem aliquam est dicta maxime, numquam fuga aperiam maiores labore tenetur pariatur minima vitae vero facilis mollitia. Dolore inventore consequuntur consectetur earum, eos hic cum, quibusdam adipisci. Odio facilis, libero optio animi odit nobis iusto excepturi autem asperiores, consectetur nostrum laborum ipsum eos magnam ea nesciunt aliquam maxime corporis labore deserunt non ipsam. Temporibus quod, aliquam reiciendis ad natus ratione corporis nisi provident itaque quos magni deleniti quidem qui eum laudantium totam, nemo cupiditate, et ducimus ipsum libero!
                    </p>
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <p>Asperiores voluptatum voluptatem et dicta eum laboriosam repellendus unde corporis vel ipsa, illo facere velit aliquam iure tempora! Consectetur excepturi iure fuga dicta alias. Reiciendis aliquid cum neque repellat? Sed deleniti ad consequatur, eum similique ipsa cupiditate, provident molestiae perferendis et asperiores vel inventore? Debitis itaque, beatae quis vero explicabo facere, laudantium rerum, quod alias laborum asperiores, ipsum a aperiam. Quisquam neque fugit, voluptatibus quidem, qui possimus eius officia nulla necessitatibus unde officiis reiciendis est assumenda. Dignissimos iste debitis sunt eos sed reiciendis illum mollitia enim aperiam quisquam nisi ratione numquam in, dolores temporibus vitae voluptates consectetur labore sequi omnis fuga et obcaecati nam. 
                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <img class="img-responsive margin-bottom-20" src="/upload/images/about/shopfoto.jpg" alt="shopfoto">
                        </div>
                    </div>
                    <p>Architecto fugit, porro! A, nihil, maiores eum perspiciatis, delectus suscipit neque eos, quod voluptates illum quas dignissimos explicabo voluptate quaerat porro optio consectetur aliquam consequatur exercitationem architecto maxime iusto. Earum ratione explicabo aut repellat sit sint animi laboriosam aperiam dolorem nostrum impedit, molestiae incidunt autem consectetur reiciendis quos, suscipit nisi sequi quo dicta asperiores, culpa voluptate rerum. Similique cumque blanditiis consequatur, amet optio et, pariatur soluta ex commodi hic voluptate labore cum quidem omnis tempora quibusdam quam veniam incidunt reprehenderit, corporis quas eius ullam. Provident non atque illo labore voluptatem ut quod esse, rem cumque alias dolor reprehenderit soluta voluptate sint. Repudiandae ex eveniet recusandae eaque ipsa at dicta unde, maxime impedit, officia, optio ullam quaerat, repellendus rem tempore. Voluptate, blanditiis.
                    </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius voluptas, itaque eos eligendi. Deserunt numquam dolore maxime explicabo tempore amet expedita aut mollitia, fugit natus. Harum illo libero quae ab beatae fugiat asperiores quidem consequatur magni provident soluta ea voluptates nisi quisquam veritatis excepturi impedit quo porro qui vel earum, ipsam omnis tempora. Nihil ratione nisi fugiat natus. Reprehenderit dolorem eius provident obcaecati, ullam explicabo itaque, nemo rem aliquam est dicta maxime, numquam fuga aperiam maiores labore tenetur pariatur minima vitae vero facilis mollitia. Dolore inventore consequuntur consectetur earum, eos hic cum, quibusdam adipisci. Odio facilis, libero optio animi odit nobis iusto excepturi autem asperiores, consectetur nostrum laborum ipsum eos magnam ea nesciunt aliquam maxime corporis labore deserunt non ipsam. Temporibus quod, aliquam reiciendis ad natus ratione corporis nisi provident itaque quos magni deleniti quidem qui eum laudantium totam, nemo cupiditate, et ducimus ipsum libero!
                    </p>
                    
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
