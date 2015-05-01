<?php
/* @var $this ChaptersController */
/* @var $model Chapters */

$this->breadcrumbs=array(
	'Chapters'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Chapters', 'url'=>array('index')),
	array('label'=>'Create Chapters', 'url'=>array('create')),
	array('label'=>'View Chapters', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Chapters', 'url'=>array('admin')),
);
?>

<h1>Update Chapters <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>