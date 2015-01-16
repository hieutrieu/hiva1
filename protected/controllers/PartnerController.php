<?php

class PartnerController extends Controller {
	public function actionIndex() {
        $this->pageTitle = Yii::t('app', 'Partner');
        $partners = new Partners();
		$this->render('index', array('partners' => $partners->getPartners()));
	}
    
    public function actionDetail($id) {
        $categoryModel = new Category;
        $newsModel = new News;
        $news = $newsModel->getNewDetail($id);
        $this->pageTitle = $news->title;
        $categories = $categoryModel->getCategories();
        $this->breadcrumbs = $categoryModel->renderBreakcrumbs($news->category_id);
		$this->render('../news/detail', array('categories' => $categories, 'news' => $news));
	}
}