<?php
/* @var $this SeriesController */
/* @var $model Series */

$this->breadcrumbs=array(
	$model->title,
);

$this->menu=array(
	array('label'=>'List Series', 'url'=>array('index')),
	array('label'=>'Create Series', 'url'=>array('create')),
	array('label'=>'Update Series', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Series', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Series', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<?php echo CHtml::image((isset($model->cover))?(Yii::app()->request->baseUrl . '/img_series/'. $model->cover):Yii::app()->request->baseUrl .'/images/empty.jpeg', 'cover', array('align'=>'left','style'=>'margin:0 10px 10px 0;')); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'alt_titles',
		'authors',
		'artists',
		'description',
		'cover',
		'tags',
		'type',
		'rated',
		'completed',
		'hidden',
		'slug',
		'thread_url',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
		'views',
	),
)); ?>

<?php $this->renderPartial('viewchapters', array('model'=>$model, 'chapters'=>$chapters)); ?>
