<?php
/* @var $this ChaptersController */
/* @var $model Chapters */

$this->breadcrumbs=array(
	$model->series->title=>array('series/view', 'id'=>$model->series_id),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Chapters', 'url'=>array('index')),
	array('label'=>'Create Chapters', 'url'=>array('create')),
	array('label'=>'Update Chapters', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Chapters', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Chapters', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        'series_id',
		'sort',
		'title',
		'description',
		'cover',
		'hidden',
		'slug',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
		'views',
	),
)); ?>

<?php $this->renderPartial('viewpages', array('model'=>$model, 'pages'=>$pages)); ?>
