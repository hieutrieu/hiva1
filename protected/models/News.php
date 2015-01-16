<?php

Yii::import('application.models._base.BaseNews');

class News extends BaseNews {
    const LIMIT = 10;
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function getNews($categoryId) {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $queryCount = Yii::app()->db->createCommand()
	        ->select('count(*)')
	        ->from(array('news'))
	        ->where('category_id=:categoryId', array(':categoryId' => $categoryId))
	        ->order('updated_at');
        $total = $queryCount->queryScalar();
        
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('news'))
	        ->where('category_id=:categoryId', array(':categoryId' => $categoryId))
	        ->order('id DESC')
            ->limit(self::LIMIT, ($page-1)*self::LIMIT);
        $news = $query->queryAll();
        
        // Paging
        $pages = new CPagination($total);
        $pages->pageSize = self::LIMIT;
        
        $result = array(
            'pages' => $pages,
            'news' => $this->formatListNews($news),
        );
        return $result;
    }
    
    public function formatListNews($news = array()) {
        $listNews = array();
        foreach($news as $n) {
            $listNews[] = $this->formatNews($n);
        }
        return $listNews;
    }
    
    public function formatNews($news) {
        $news = (object) $news;
        $fields = array_keys($this->attributeLabels());
        foreach($news as $key => $value) {
            if(!in_array($key, $fields)) {
                $news->$key = '';
            }
        }
        return $news;
    }
    
    public function getNewDetail($id) {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('news'))
	        ->where('id=:id', array(':id' => $id));
        $news = $query->queryRow();
        $news = $this->formatNews($news);
        return $news;
    }
    
    public function getNewsAbout() {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('news'))
	        ->where('type=:type', array(':type' => Helper::TYPE_ABOUT));
        $news = $query->queryRow();
        $news = $this->formatNews($news);
        return $news;
    }
    
    public function getNewsService() {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('news'))
	        ->where('type=:type', array(':type' => Helper::TYPE_SERVICE));
        $news = $query->queryRow();
        $news = $this->formatNews($news);
        return $news;
    }
    
    public function getNewsTerm() {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('news'))
	        ->where('type=:type', array(':type' => Helper::TYPE_TERM));
        $news = $query->queryRow();
        $news = $this->formatNews($news);
        return $news;
    }
	
    public function getNewsVoucher() {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('news'))
	        ->where('type=:type AND language=:language', array(':type' => Helper::TYPE_VOUCHER, ':language' => Yii::app()->language));
        $news = $query->queryRow();
        $news = $this->formatNews($news);
        return $news;
    }
	public function beforeSave() {
        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
        }
        $this->updated_at = new CDbExpression('NOW()');
     
        return parent::beforeSave();
    }
}