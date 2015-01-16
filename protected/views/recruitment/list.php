<div class="container">
    <div class="news_left">
        <ul class="news_category_list">
            <?php foreach($categories as $cat):?>
                <li><a class="<?php echo $cat->id == $id ? 'active' : '' ?>" href="<?php echo Link::recruitmentList(array('id' => $cat->id)) ?>"><?php echo $cat->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="news_right">
        <div class="news_category_title"><?php echo $category->title ?></div>
        <table class="news_table">
            <?php foreach($newsList['news'] as $news):?>
                <tr>
                    <td style="vertical-align: middle;" class="news_thumb">
                        <a href="<?php echo Link::newsDetail(array('id' => $news->id)); ?>"><img src="<?php echo $news->thumbnail ?>"/></a>
                    </td>
                    <td style="vertical-align: top;">
                        <div class="news_list">
                            <a class="news_title" href="<?php echo Link::newsDetail(array('id' => $news->id)); ?>"><?php echo $news->title ?></a>
                            <div class="news_date"><?php echo Helper::dateFormat($news->created_at) ?></div>
                            <?php echo $news->description ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
            $this->widget('CLinkPager', array(
                        'pages' => $newsList['pages'],
                        'nextPageLabel' => '&gt;',
                        'prevPageLabel' => '&lt;',
                        'firstPageLabel' => '',
                        'lastPageLabel' => '',
                        'header' => '<div class="pager-right clr">',
                        'footer' => '</div>',
                        'htmlOptions' => array (
							'id' => 'pagination',
							'class' => 'pagination'
                        ),
                )); 
        ?>
    </div>
</div>