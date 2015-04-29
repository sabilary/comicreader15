<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Create Users</h1>
<h3><?php echo date("D M j G:i:s T Y"); ?></h3>

<?php //echo CHttpRequest::getUserHostAddress();?><br/>
<?php //echo ip2long(CHttpRequest::getUserHostAddress()); ?><br/>
<?php echo Yii::app()->request->getUserHostAddress(); ?><br/>
<?php echo rand(9999,999999); ?><br/>
<?php echo md5(rand(9999,999999)); ?><br/>
<?php
$ip = gethostbyname('www.example.com');
$out = "The following URLs are equivalent:<br />\n";
$out .= 'http://www.example.com/, http://' . $ip . '/, and http://' . sprintf("%u", ip2long($ip)) . "/<br />\n";
echo $out;
?><br/>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>