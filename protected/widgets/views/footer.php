<div class="footer_bottom">
    <div class="footer_left">
        <ul class="nav_footer">
            <li class="<?php echo Yii::app()->controller->action->id == 'about' ? 'active' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('site/about') ?>"><?php echo Yii::t('app', 'About')?></a>
            </li>
            <!--li class="<?php //echo Yii::app()->controller->id == 'product' ? 'active' : '' ?>">
                <a href="<?php //echo Yii::app()->createUrl('product/index') ?>"><?php echo Yii::t('app', 'Products')?></a>
            </li>
            <li class="<?php //echo Yii::app()->controller->action->id == 'service' ? 'active' : '' ?>">
                <a href="<?php //echo Yii::app()->createUrl('site/service') ?>"><?php echo Yii::t('app', 'Service')?></a>
            </li-->
            <li class="<?php echo Yii::app()->controller->id == 'partner' ? 'active' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('partner/index') ?>"><?php echo Yii::t('app', 'Partners')?></a>
            </li>
            <li class="<?php echo Yii::app()->controller->id == 'news' ? 'active' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('news/list') ?>"><?php echo Yii::t('app', 'News')?></a>
            </li>
            <li class="<?php echo Yii::app()->controller->id == 'recruitment' ? 'active' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('recruitment/list') ?>"><?php echo Yii::t('app', 'Recruitment')?></a>
            </li>
            <li class="<?php echo Yii::app()->controller->action->id == 'contact' ? 'active' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('site/contact') ?>"><?php echo Yii::t('app', 'Contact')?></a>
            </li>
        </ul>
        <div class="footer_block">
            <b><?php echo Yii::t('app', 'Let %s', array('%s' => '<a href="'. Yii::app()->createUrl('auth/register') .'">'. Yii::t('app', 'Register') .'</a>'))?></b>
            <ul class="block_content">
                <li>- Nhận được các ưu đãi từ chương trình khuyến mại</li>
                <li>- Được cập nhật thông tin từ các sản phẩm mới</li>
            </ul>
        </div>
        <div class="footer_block bright">
            <b>Thông tin thêm</b>
            <ul class="block_content">
                <li>Về CTCP &amp; TM Tâm Hiếu</li>
                <li>Câu hỏi thông thường</li>
                <li>Quan hệ đầu tư</li>
                <li>Chính sách bảo mật</li>
            </ul>
        </div>
        <div class="footer_middle">
            <div class="footer_block">
                <?php $this->renderPartial('newsletter');?>
            </div>
            <div class="footer_block bright">
                <div class="socials_icon">
                    <a class="social-icon youtube" href="https://www.youtube.com/" target="_blank"></a>
                    <a class="social-icon twitter" href="https://twitter.com/" target="_blank"></a>
                    <a class="social-icon google" href="https://www.google.com.vn/" target="_blank"></a>
                    <a class="social-icon facebook" href="https://www.facebook.com/" target="_blank"></a>
                </div>
            </div>
        </div>
        <div class="copyright">TAMHIEU &copy; Copyright 2014</div>
    </div>
    <div class="footer_right">
        <div id="logo_footer"></div>
        <div><b>Công ty cổ phần <br/>Thương Mại &amp; Dịch Vụ Tâm Hiếu</b></div>
        <div>Số 89 Thái Hà - Trung Liệt<br />Đống Đa - Hà Nội</div>
        <div class="address_footer">
            Hotline: 043 538 1954<br />
            Tel: 043 624 0012<br />    
        </div>
    </div>
</div>