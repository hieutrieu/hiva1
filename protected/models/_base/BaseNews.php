<?php

/**
 * This is the model base class for the table "news".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "News".
 *
 * Columns in table "news" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $type
 * @property integer $author_id
 * @property string $title
 * @property string $thumbnail
 * @property string $image
 * @property string $description
 * @property string $content
 * @property integer $is_hot
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $viewer
 * @property string $language
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 */
abstract class BaseNews extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'news';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'News|News', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title', 'required'),
			array('category_id, type, author_id, is_hot, viewer, status', 'numerical', 'integerOnly'=>true),
			array('title, thumbnail, image, meta_title, meta_keywords', 'length', 'max'=>255),
			array('language', 'length', 'max'=>10),
			array('description, content, meta_description, created_at, updated_at', 'safe'),
			array('category_id, type, author_id, thumbnail, image, description, content, is_hot, meta_title, meta_description, meta_keywords, viewer, language, status, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, category_id, type, author_id, title, thumbnail, image, description, content, is_hot, meta_title, meta_description, meta_keywords, viewer, language, status, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'category_id' => Yii::t('app', 'Category'),
			'type' => Yii::t('app', 'Type'),
			'author_id' => Yii::t('app', 'Author'),
			'title' => Yii::t('app', 'Title'),
			'thumbnail' => Yii::t('app', 'Thumbnail'),
			'image' => Yii::t('app', 'Image'),
			'description' => Yii::t('app', 'Description'),
			'content' => Yii::t('app', 'Content'),
			'is_hot' => Yii::t('app', 'Is Hot'),
			'meta_title' => Yii::t('app', 'Meta Title'),
			'meta_description' => Yii::t('app', 'Meta Description'),
			'meta_keywords' => Yii::t('app', 'Meta Keywords'),
			'viewer' => Yii::t('app', 'Viewer'),
			'language' => Yii::t('app', 'Language'),
			'status' => Yii::t('app', 'Status'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;
		$criteria->order = 'id DESC, updated_at DESC';

		$criteria->compare('id', $this->id);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('type', $this->type);
		$criteria->compare('author_id', $this->author_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('thumbnail', $this->thumbnail, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('is_hot', $this->is_hot);
		$criteria->compare('meta_title', $this->meta_title, true);
		$criteria->compare('meta_description', $this->meta_description, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('viewer', $this->viewer);
		$criteria->compare('language', $this->language, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}