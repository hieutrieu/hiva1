<?php 
Yii::import('zii.widgets.CPortlet');
 
class Footer extends CPortlet{
    public function init() {
        parent::init();
    }
 
    protected function renderContent(){
        $this->render('footer');
    }
    
    public function renderPartial($view,$data=null,$return=false,$processOutput=false) {
		if(($viewFile=$this->getViewFile($view))!==false)
		{
			$output=$this->renderFile($viewFile,$data,true);
			if($processOutput)
				$output=$this->processOutput($output);
			if($return)
				return $output;
			else
				echo $output;
		}
		else
			throw new CException(Yii::t('yii','{controller} cannot find the requested view "{view}".',
				array('{controller}'=>get_class($this), '{view}'=>$view)));
	}
}
