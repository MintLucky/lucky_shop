<?php include ROOT . '/views/layouts/header.php'; ?>

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
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Новости</h2>
                    <div id="content">
                        <?php foreach ($newsList as $newsItem):?>
                            <div class="news-item margin-bottom-20">
                                <h3><a class="news-header" href='/news/<?php echo $newsItem['id'];?>'><?php echo $newsItem['title'];?></a></h3>
                                <p class="margin-bottom-20">Добавлено: <?php echo $newsItem['date'];?></p>
                                <div class="row">
                                    <div class="col-md-9 col-xs-12">
                                        <p><?php echo $newsItem['short_content'];?></p>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <a href="/news/<?php echo $newsItem['id'];?>">
                                            <img src="<?php echo News::getImage($newsItem['id']);?>" class="img-responsive" alt="picture"/>
                                        </a>
                                    </div>
                                </div>
                                <a href="/news/<?php echo $newsItem['id'];?>" class="news-link"> Читать полностью</a>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>

                <!--Постраничная навигация-->
                <!--Если общее количество выводимых товаров больше чем выводится
                 на одну страницу подключаем пагинацию-->
                <?php if ($total > News::SHOW_BY_DEFAULT):?>
                    <div class="pagination-block">
                        <?php echo $pagination->get();?>
                    </div>
                <?php endif;?>

            </div>
        </div>
    </div>
</section>


<?php include ROOT . '/views/layouts/footer.php'; ?>


