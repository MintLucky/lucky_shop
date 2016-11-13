<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="height-screen-admin">
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/news">Управление товарами</a></li>
                    <li class="active">Редактировать товар</li>
                </ol>
            </div>

            <h4>Редактировать новость #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-9">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название</p>
                        <input type="text" name="title" placeholder="" value="<?php echo $news['title']; ?>">

                        <p>Изображение</p>
                        <img class="margin-bottom-20" src="<?php echo News::getImage($news['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="">

                        <p>Краткая информация</p>
                        <textarea rows="5" name="short_content"><?php echo $news['short_content']; ?></textarea>

                        <br/><br/>

                        <p>Содержание новости</p>
                        <textarea rows="8" name="content"><?php echo $news['content']; ?></textarea>

                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1"<?php if($news['status']==1) echo 'selected="selected"';?>>Опубликована</option>
                            <option value="0"<?php if($news['status']==0) echo 'selected="selected"';?>>Скрыта</option>
                        </select>

                        <br><br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

