<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    'htmlOptions' => array(
        'class' => 'table table-striped',
    ),
    'itemTemplate' => "<tr class=\"{class}\"><th style=\"width: 20%; text-align: right;\">{label}</th><td>{value}</td></tr>\n",
	'attributes'=>array(
		'id',
        'first_name',
		'last_name',
        array(
			'label' => Yii::t('app', 'Fullname'),
			'value' => $model->fullname,
			'type' => 'raw',
		),
		'phone',
		'email',
		'address',
        'date_birth',
        array(
			'label' => Yii::t('app', 'Role'),
			'value' => Helper::getRole($model->role_id),
			'type' => 'raw',
		),
        array(
			'label' => Yii::t('app', 'User Type'),
			'value' => AdminHelper::userType($model->user_type),
			'type' => 'raw',
		),
		'status',
        'last_login',
		'created_at',
		'updated_at',
	),
)); ?>
