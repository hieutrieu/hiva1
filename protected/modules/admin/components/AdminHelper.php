<?php
class AdminHelper {
    public static function genarateCode($user) {
        $customerCode = 'OL';
        $name = UrlTransliterate::cleanString(UrlTransliterate::cleanSeparators($user->first_name), '');
        $customerCode .= $name . $user->id;
        return $customerCode;
    }
    
    public static function userType($userType = '') {
        $tagIcon = '<span class="icon_user_type vip-'. $userType .'"></span>';
        return $tagIcon;
    }
    
    public static function newsType() {
        return array(
            Helper::TYPE_NEWS       => Yii::t('app', 'News'), 
            Helper::TYPE_ABOUT      => Yii::t('app', 'About'), 
            Helper::TYPE_TERM       => Yii::t('app', 'Terms Of Service'),
            Helper::TYPE_SERVICE    => Yii::t('app', 'Service'),
            Helper::TYPE_VOUCHER    => Yii::t('app', 'Gift Voucher')
        );
    } 
    
    public static function languages() {
        return array(
            Helper::LANGUAGE_VI      => Yii::t('app', 'Vietnamese'), 
            Helper::LANGUAGE_EN      => Yii::t('app', 'English'), 
        );
    } 
    
    public static function currencies() {
        return array(
            Helper::CURRENCY_VND    => Yii::t('app', 'VND'), 
            Helper::CURRENCY_DOLLAR => Yii::t('app', '$'), 
        );
    }
    
    public static function shopCategories() {
        $showCategory = new ShopCategory;
        $categories = $showCategory->getChildsById(0);
        $options = array();
        foreach($categories as $category) {
            $options[$category['id']] = $category['title'];
        }
        return $options;
    } 
}