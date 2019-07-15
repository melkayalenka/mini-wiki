<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Wiki Application';
?>
<div class="site-index">

    <div">
        <h2>Список страниц сайта</h2>
    </div>
    <div class="body-content">
        <div class="row">
            <?php
            foreach ($pages as $page) {?>
            <div class="col-lg-12">
                <ul class = "list">
                    <li><a href="<?php echo $page['name'];?>"</a><?php echo $page['name'];?></li>
                    <li><a href="<?php echo $page['name'];?>/edit?">Редактировать</a></li>
                    <li><a href="delete/<?php echo $page['id'];?>">Удалить</a></li>
                </ul>
            </div>
            <?php } ?>
            <div class="col-lg-12">
                <div ><?= Html::a("<p>Создать новую страницу</p>", Url::to('add')) ?></div>
            </div>
        </div>
    </div>
</div>

