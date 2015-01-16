<?php

class NewsController extends Controller {
	public function actionList($id = 0) {
        $this->pageTitle = Yii::t('app', 'News');
        $categoryModel = new Category;
        $newsModel = new News;
        $categories = $categoryModel->getCategories();
        if($id == 0) {
            $category = current((array)$categories);
            $id = $category->id;
        } else {
            $category = $categoryModel->getById($id);
        }
        $this->breadcrumbs = $categoryModel->renderBreakcrumbs($id);
        $this->pageTitle = Yii::t('app', 'News') .' - '. $category->title;
        $newsList = $newsModel->getNews($id);
		$this->render('list', array('categories' => $categories, 'newsList' => $newsList, 'category' => $category, 'id' => $id));
	}
    
    public function actionDetail($id) {
        $categoryModel = new Category;
        $newsModel = new News;
        $news = $newsModel->getNewDetail($id);
        $this->pageTitle = $news->title;
        $categories = $categoryModel->getCategories();
        $this->breadcrumbs = $categoryModel->renderBreakcrumbs($news->category_id);
		$this->render('detail', array('categories' => $categories, 'news' => $news));
	}
    
    public function actionVoucher() {
        $categoryModel = new Category;
        $newsModel = new News;
        $news = $newsModel->getNewsVoucher();
        $this->pageTitle = $news->title;
        $categories = $categoryModel->getCategories();
        $this->breadcrumbs = $categoryModel->renderBreakcrumbs($news->category_id);
		$this->render('detail', array('categories' => $categories, 'news' => $news));
	}
    
}