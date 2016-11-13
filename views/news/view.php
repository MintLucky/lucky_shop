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
                <div class="features_items margin-bottom-20">
                    <h2 class="title text-center">Новости</h2>
                    <div class="post">
                        <h2 class="news-header"><?php echo $newsItem['title'];?></h2>
                        <p class="margin-bottom-20">Добавлено: <?php echo $newsItem['date'];?></p>
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <p><?php echo $newsItem['content'];?></p>
                            </div>
                            <div class="col-md-12 col-xs-12 text-center">
                                <p><img src="<?php echo News::getImage($newsItem['id']);?>" class="img-responsive img-circle" alt="<?php echo News::getImage($newsItem['title']);?>"/></p>
                            </div>
                        </div>
                        <a href="/news/index/" class="news-link"> Ко всем новостям</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include ROOT . '/views/layouts/footer.php'; ?>
