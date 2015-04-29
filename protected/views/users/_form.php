<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */

/* Register javascript */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/showHide.js');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>20,'placeholder'=>'username')); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>20,'placeholder'=>'email@example.com')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'passwordSave'); ?>
		<?php echo $form->passwordField($model,'passwordSave',array('value'=>'','size'=>60,'maxlength'=>50,'placeholder'=>'password')); ?>
		<?php echo $form->error($model,'passwordSave'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'repeatPassword'); ?>
		<?php echo $form->passwordField($model,'repeatPassword',array('value'=>'','size'=>60,'maxlength'=>128,'placeholder'=>'repeat password')); ?>
		<?php echo $form->error($model,'repeatPassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role_id'); ?>
		<?php echo $form->dropDownList($model,'role_id',
            CHtml::listData(UsersRoles::model()->findAll(),'id','name'),
            array(
                'empty'=>'-- choose role --',
            )
        ); ?>
		<?php echo $form->error($model,'role_id'); ?>
	</div>
    
    <?php if(!$model->isNewRecord): ?>
        <div class="row">
            <?php echo $form->labelEx($model,'activated'); ?>
            <?php echo $form->checkBox($model,'activated',array()); ?>
            <?php echo $form->error($model,'activated'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'banned'); ?>
            <?php echo $form->checkBox($model,'banned',array()); ?>
            <?php echo $form->error($model,'banned'); ?>
        </div>

        <div class="row" id="hiddenDiv" style="display: none">
            <?php echo $form->labelEx($model,'ban_reason'); ?>
            <?php echo $form->textArea($model,'ban_reason',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>

    <?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->