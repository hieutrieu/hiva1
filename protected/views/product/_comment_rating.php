<?php 
    $model = new CommentForm;
    
    $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'register-form',
    	'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'htmlOptions' => array('class' => 'form-horizontal',
            'role' => 'form',
            'id' => 'register-form',
            'validateOnSubmit'=>true,
        )
    )); 
?>
<div class="">
    <?php echo $form->label($model, 'title', array('class' => 'contact_input')); ?>
    <?php echo $form->textField($model, 'title', array('class' => 'contact_input')); ?>
    <?php echo $form->error($model, 'title'); ?>
    <?php echo $form->label($model, 'content'); ?>
    <?php echo $form->textArea($model, 'content', array('class' => 'contact_input')); ?>
    <?php echo $form->error($model, 'content'); ?>
    
    <?php echo CHtml::submitButton(Yii::t('app', 'Comment')); ?>
</div>
<?php $this->endWidget(); ?>

<?php 
    $commentRateModel = new CommentRating;
    $comments = $commentRateModel->getComments($productId);
    foreach($comments['products'] as $comment):
?>
    <div class="col-lg-12 comment_container">
        <div class="col-lg-3">
            <div class="comment_rate icon-<?php echo $comment['rate_value'] ?>">&nbsp;</div>
            <div class="user_title"><?php echo $comment['fullname'] ?></div>
            <div class="user_age"><?php echo Yii::t('app', 'Age') ?>: <?php echo Helper::getAge($comment['date_birth']) ?></div>
            <div class="user_address"><?php echo Yii::t('app', 'Address') ?>: <?php echo $comment['address'] ?></div>
        </div>
        <div class="col-lg-9">
            <div class="comment_title"><?php echo $comment['title'] ?></div>
            <div class="comment_content"><?php echo $comment['content'] ?></div>
            <div class="like_number"><?php echo $comment['like_number'] ?></div>
            <div class="answer_number"><?php echo $comment['answer_number'] ?></div>
        </div>
    </div>      
<?php endforeach;?>

