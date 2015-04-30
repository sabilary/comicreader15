<?php echo CHtml::link('Add Page',array('pages/create', 'cid'=>$model->id, 'chapter'=>$model->slug)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-grid',
	'dataProvider'=>$pages->search(),
	'columns'=>array(
		'id',
		'chapter_id',
		'sort',
		'filename',
		'mime',
		'size',
		/*
		'height',
		'width',
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