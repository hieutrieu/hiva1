<div class="container">
    <div class="news_left">
        <ul class="news_category_list">
            <?php foreach($categories as $cat):?>
                <li><a class="<?php echo $cat->id == $news->category_id ? 'active' : '' ?>" href="<?php echo Link::newsList(array('id' => $cat->id, 'title' => $cat->title)) ?>"><?php echo $cat->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="news_right">
        <div class="news_detail_title"><?php echo $news->title ?></div>
        <div class="news_date"><?php echo Helper::dateFormat($news->created_at) ?></div>
        <div class="news_content"><?php echo $news->content ?></div>
    </div>
</div>