<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="height-screen-admin">
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/news">Управление новостями</a></li>
                    <li class="active">Добавить новость</li>
                </ol>
            </div>


            <h4>Добавить новость</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li class="red"> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-9">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название</p>
                        <input type="text" name="title" placeholder="" value="<?php echo $options['title']; ?>">

                        <p>Изображение</p>
                        <input type="file" name="image" placeholder="" value="">

                        <p>Краткая информация</p>
                        <textarea name="short_content"><?php echo $options['short_content']; ?></textarea>

                        <br/><br/>

                        <p>Содержание новости</p>
                        <textarea rows="7" name="content"><?php echo $options['content']; ?></textarea>

                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Опубликована</option>
                            <option value="0">Скрыта</option>
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

