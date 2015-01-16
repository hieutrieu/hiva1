<?php
/* @var $this NewsController */
/* @var $model News */


$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Update News', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete News', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1>View News #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_id',
		'type',
		'author_id',
		'title',
		'image',
		'description',
		'content',
		'is_hot',
		'meta_title',
		'meta_description',
		'meta_keywords',
		'viewer',
		'status',
		'created_at',
		'updated_at',
	),
)); ?>
