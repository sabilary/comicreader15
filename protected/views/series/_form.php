<?php
/* @var $this SeriesController */
/* @var $model Series */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'series-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alt_titles'); ?>
		<?php echo $form->textField($model,'alt_titles',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alt_titles'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'authors'); ?>
		<?php echo $form->textField($model,'authors',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'authors'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'artists'); ?>
		<?php echo $form->textField($model,'artists',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'artists'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',$model->seriesTypes); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'tags',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('size'=>50),
		)); ?>
		<p class="hint">Please separate different tags with commas.</p>
		<?php echo $form->error($model,'tags'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cover'); ?>
        <?php echo CHtml::image((isset($model->cover))?(Yii::app()->request->baseUrl . '/img_series/'. $model->cover):Yii::app()->request->baseUrl .'/images/empty.jpeg', 'cover', array('align'=>'left','style'=>'margin:0 10px 10px 0;')); ?>			
        <?php if(!$model->isNewRecord) {
            echo $form->labelEx($model,'remove_img'); 
            echo $form->checkBox($model, 'remove_img');
        } ?>
		<?php echo $form->labelEx($model,'cover_img'); ?>
        <?php echo $form->fileField($model,'cover_img',array()); ?>
		<?php echo $form->error($model,'cover_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thread_url'); ?>
		<?php echo $form->textField($model,'thread_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'thread_url'); ?>
	</div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'rated'); ?>
        <?php echo $form->checkBox($model,'rated',array()); ?>
        <?php echo $form->error($model,'rated'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'completed'); ?>
        <?php echo $form->checkBox($model,'completed',array()); ?>
        <?php echo $form->error($model,'completed'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'hidden'); ?>
        <?php echo $form->checkBox($model,'hidden',array()); ?>
        <?php echo $form->error($model,'hidden'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->