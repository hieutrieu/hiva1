<?php
/**
* Custom rules manager class
*
* Override to load the routes from the DB rather then a file
*
*/
class RewriteUrlManager extends CUrlManager {
    /**
    * Build the rules from the DB
    */
    protected function processRules() {
        $this->rules = array(
            'dang-ky' => 'auth/register',
            'lay-lai-mat-khau' => 'auth/forgotpassword',
            'tim-kiem-san-pham' => 'product/search',
            'tin-tuc/gioi-thieu' => 'site/about',
            'doi-tac' => 'partner/index',
            'tuyen-dung' => 'recruitment/list',
            'dai-ly' => 'agency/list',
            'tin-tuc/<title>-<id:\d+>' => 'news/list',
            'tin-tuc' => 'news/list',
            'tin-tuc/chi-tiet/<title>-<id:\d+>' => 'news/detail',
            'lien-he' => 'site/contact',
            'danh-muc-san-pham/<title>-<id:\d+>-<sort>' => 'product/catalog',
            'danh-muc-san-pham/<title>-<id:\d+>' => 'product/catalog',
            'nhan-hang/<name>-<id:\d+>-<mid:\d+>-<sort>' => 'product/manufacture',
            'nhan-hang/<name>-<id:\d+>-<mid:\d+>' => 'product/manufacture',
            'san-pham/<title>-<id:\d+>' => 'product/detail',
            'gio-hang' => 'shoppingcart/order',
            'gio-hang/them-<id:\d+>' => 'shoppingcart/add',
            
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        );
        // Run parent
        parent::processRules();
    }
}
