<?php

class AgencyController extends Controller {
	public function actionList($id = 0) {
        $this->pageTitle = Yii::t('app', 'Agency');
        $agencyModel = new Agency;
        //$this->breadcrumbs = $categoryModel->renderBreakcrumbs($id);
        $agencies = $agencyModel->getList();
		$this->render('list', array('agencies' =>$agencies));
	}
}