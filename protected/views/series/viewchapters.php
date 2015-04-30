<?php echo CHtml::link('Add Chapter',array('chapters/create', 'sid'=>$model->id, 'comic'=>$model->slug)); ?>

<?php 
$grid_id = 'series_chapters-grid';

$crupdate = array(
    'label'     => 'Update',
    'imageUrl'  => Yii::app()->request->baseUrl.'/images/grid/update.png',
    'url'       => 'Yii::app()->createUrl("chapters/update", array("id"=>$data->id))',
    'options'   => array(
        'title'     => 'Update',
    ),
);

$crdelete = array(
    'label'     => 'Delete',
    'imageUrl'  => Yii::app()->request->baseUrl.'/images/grid/delete.png',
    'url'       => 'Yii::app()->createUrl("chapters/delete", array("id"=>$data->id))',
    'options'   => array(
        'title'     => 'Delete',
        'confirm'   => 'Are you sure? It will be deleted permanently.',
    ),
    'click'     => "function(){
        $.fn.yiiGridView.update('".$grid_id."', {
            type    : 'POST',
            url     : $(this).attr('href'),
            success : function(data) {
                  $.fn.yiiGridView.update('".$grid_id."');
            }
        })
        return false;
    }",
);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>$grid_id,
	'dataProvider'=>$chapters->search(),
	'columns'=>array(
        array(
            'header'            => '#',
            'headerHtmlOptions' => array('title'=>'Number', 'style'=>'width: 30px;'),
            'value'             => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
            'htmlOptions'       => array('style'=>'text-align: center;'),
        ),
        array(
            'name'              => 'title',
            'type'              => 'raw',
            'headerHtmlOptions' => array('title'=>'Title'),
            'value'             => 'CHtml::link($data->title, array("chapters/view", "id"=>$data->id))',
        ),
        array(
            'name'              => 'sort',
            'type'              => 'raw',
            'headerHtmlOptions' => array('title'=>'Sort', 'style'=>'width: 30px;'),
            'htmlOptions'       => array('style'=>'text-align: center;'),
        ),
        array(
            'name'              => 'created_at',
            'type'              => 'raw',
            'headerHtmlOptions' => array('title'=>'Posted at', 'style'=>'width: 100px;'),
            'value'             => '($data->created_at != 0) ? date("M d, Y",strtotime($data->created_at)) : "-"',
            'htmlOptions'       => array('style'=>'text-align: center;'),
        ),
		/*
		'description',
		'hidden',
		'slug',
		'lastseen',
		'created_by',
		'updated_at',
		'updated_by',
		'views',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{crupdate}',
            'headerHtmlOptions' => array('style'=>'width: 30px;'),
            'htmlOptions' => array('style'=>'text-align: center;'),
            'buttons' => array(
                'crupdate' => $crupdate,
            ),
		),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{crdelete}',
            'headerHtmlOptions' => array('style'=>'width: 30px;'),
            'htmlOptions' => array('style'=>'text-align: center;'),
            'buttons' => array(
                'crdelete' => $crdelete,
            ),
		),
	),
)); ?>