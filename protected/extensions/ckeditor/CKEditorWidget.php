<?php
/*
 * Created on 10.10.2010
 *
 * Copyright: Shahram Monshi Pouri
 * Based on Christian Kütbach's FCKEditorWidget
 *
 * GNU LESSER GENERAL PUBLIC LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Requirements:
 * The CK-Editor have to be installed and configured. The Editor itself is
 * not includet to this extension.
 *
 * This extension have to be installed into:
 * <Yii-Application>/proected/extensions/ckeditor
 *
 * Usage:
 * <?php $this->widget('ext.ckeditor.CKEditorWidget',array(
 *   "model"=>$pages,                 # Data-Model
 *   "attribute"=>'content',          # Attribute in the Data-Model
 *   "defaultValue"=>"Test Text",     # Optional
 *
 *   # Additional Parameter (Check http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html)
 *   "config" => array(
 *       "height"=>"400px",
 *       "width"=>"100%",
 *       "toolbar"=>"Basic",
 *       ),
 *
 *   #Optional address settings if you did not copy ckeditor on application root
 *   "ckEditor"=>Yii::app()->basePath."/../ckeditor/ckeditor.php",
 *                                   # Path to ckeditor.php
 *   "ckBasePath"=>Yii::app()->baseUrl."/ckeditor/",
 *                                   # Realtive Path to the Editor (from Web-Root)
 *   ) ); ?>
 */

class CKEditorWidget extends CInputWidget
{

	public $ckEditor;
    public $ckFinder;
    public $ckFinderBasePath;
	public $ckBasePath;
	public $defaultValue;
    public $config;
    public $toolbar = "Full";
    public $width = "100%";
    public $height = '300px';
    

	public function run(){
	   //var_dump($this->toolbar);exit;
		if(!isset($this->model)){
			throw new CHttpException(500,'"model" have to be set!');
		}
		if(!isset($this->attribute)){
			throw new CHttpException(500,'"attribute" have to be set!');
		}
		if(!isset($this->ckEditor)){
			$this->ckEditor = Yii::app()->basePath."/../library/ckeditor/ckeditor.php";
		}
		if(!isset($this->ckBasePath)){
			$this->ckBasePath = Yii::app()->baseUrl."/../library/ckeditor/";
		}
        if(!isset($this->ckFinder)){
			$this->ckFinder = Yii::app()->basePath."/../library/ckfinder/ckfinder.php";
		}
		if(!isset($this->ckFinderBasePath)){
			$this->ckFinderBasePath = Yii::app()->baseUrl."/../library/ckfinder/";
		}
        if(!isset($this->defaultValue)){
			$this->defaultValue = "";
		}
        
        if(isset($this->config) && is_array($this->config)){
        	foreach($this->config as $key=>$value){
        		$oCKeditor->config[$key] = $value;
        	}
            if(!isset($this->config['toolbar'])){
                $this->config['toolbar']= $this->toolbar;
            }
            if(!isset($this->config['width'])){
                $this->config['toolbar']= $this->toolbar;
            }
            if(!isset($this->config['toolbar'])){
                $this->config['toolbar']= $this->toolbar;
            }
            
        }

		$controller=$this->controller;
		$action=$controller->action;
		$this->render('CKEditorView',array(
			"ckBasePath"=>$this->ckBasePath,
			"ckEditor"=>$this->ckEditor,
            "ckFinder"=>$this->ckFinder,
            'ckFinderBasePath'=>$this->ckFinderBasePath,
			"model"=>$this->model,
			"attribute"=>$this->attribute,
			"defaultValue"=>$this->defaultValue,
			"config"=>$this->config,
		));
	}
}
?>