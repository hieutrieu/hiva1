<style>
    .news_left {
        float: left;
        width: 275px;
    }
    .news_right {
        float: left;
        width: 950px;
    }
</style>
<div class="container">
    <div class="news_left">
        <ul class="news_category_list">
            <?php foreach($categories as $category):?>
                <li><a href="<?php echo Link::newsList(array('id' => $category['id'])) ?>"><?php echo $category['title'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="news_right">
        <ul>
            <?php foreach($news as $new):?>
                <li><a href="<?php echo Link::newsDetail(array('id' => $new['id'])); ?>"><?php echo $new['title'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>