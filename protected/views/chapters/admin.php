<?php
/* @var $this ChaptersController */
/* @var $model Chapters */

$this->breadcrumbs=array(
	'Chapters'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Chapters', 'url'=>array('index')),
	array('label'=>'Create Chapters', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#chapters-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Chapters</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'chapters-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'series_id',
		'sort',
		'title',
		'description',
		/*
		'hidden',
		'slug',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
		'views',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
