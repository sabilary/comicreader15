<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php
    /**
     * The position of the JavaScript code. Valid values include the following:
     * 1. CClientScript::POS_HEAD  : the script is inserted in the head section right before the title element.
     * 2. CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.
     * 3. CClientScript::POS_END   : the script is inserted at the end of the body section.
     * 4. CClientScript::POS_LOAD  : the script is inserted in the window.onload() function.
     * 5. CClientScript::POS_READY : the script is inserted in the jQuery's ready function.
     **/
	 
    // Variabel
    $baseUrl = Yii::app()->request->baseUrl.'/';
    $cs      = Yii::app()->getClientScript();
    $js      = $baseUrl.'js/';
    $css     = $baseUrl.'css/';
    
    Yii::app()->clientScript->registerCoreScript('jquery');
    
    // Plugins
    $plugins = $baseUrl.'assets/plugins/';
    
    // Bootstrap
    $bootstrap = $plugins.'bootstrap/';
    Yii::app()->clientScript->registerCssFile($bootstrap.'css/bootstrap.css');
    Yii::app()->clientScript->registerScriptFile($bootstrap.'js/bootstrap.js');
    
    // Fontawesome
    $fontawesome = $plugins.'fontawesome/';
    Yii::app()->clientScript->registerCssFile($fontawesome.'css/font-awesome.css');
    
    // Blueprint CSS framework
    Yii::app()->clientScript->registerCssFile($css.'screen.css', 'screen, projection');
    //Yii::app()->clientScript->registerCssFile($css.'print.css', 'print');
    Yii::app()->clientScript->registerCssFile($css.'main.css');
    Yii::app()->clientScript->registerCssFile($css.'form.css');
    ?>

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
