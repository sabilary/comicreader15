<?php
/* @var $this ChaptersController */
/* @var $model Chapters */

$this->breadcrumbs=array(
	'Chapters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Chapters', 'url'=>array('index')),
	array('label'=>'Manage Chapters', 'url'=>array('admin')),
);
?>

<h1>Create Chapters</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>