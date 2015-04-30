<?php

class SeriesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    public $coverFolder='/img_series/'; // $this->coverFolder

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','suggestTags'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tags::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model=$this->loadModel($id);
        $model->saveCounters(array('views'=>1));
        
		$chapters=new Chapters('search');
		$chapters->unsetAttributes();  // clear any default values
		if(isset($_GET['Chapters']))
			$chapters->attributes=$_GET['Chapters'];
        
		$this->render('view',array(
			'model'=>$model,
			'chapters'=>$chapters,
		));
	}
    
    /*=============================================================*/
    // $this->saveSeriesCover($model, $valid, $oldcover=null);
    /*=============================================================*/
    private function saveSeriesCover($model, $valid, $oldcover=null)
    {
        if($model->cover_img !== null) {
            $location = Yii::getPathOfAlias('webroot') . $this->coverFolder;
            $location = str_replace('/', DIRECTORY_SEPARATOR, $location);
            $filename = uniqid('cover_') . $model->id;
            $model->cover = uniqid('cover_') . $model->id . '.jpg';
            switch(exif_imagetype($model->cover_img->tempName)) {
                case IMAGETYPE_GIF:
                    $filename .= '.gif';
                    $model->cover_img->saveAs($location . $filename);
                    $model->save();
                    $this->convert->resizeImage($filename, $model->cover, $location);
                    if($oldcover) { unlink(getcwd() . $this->coverFolder . $oldcover); }    
                    break;
                case IMAGETYPE_JPEG:
                    $filename .= '.jpg';
                    $model->cover_img->saveAs($location . $filename);
                    $model->save();
                    $this->convert->resizeImage($filename, $model->cover, $location);
                    if($oldcover) { unlink(getcwd() . $this->coverFolder . $oldcover); }   
                    break;
                case IMAGETYPE_PNG:
                    $filename .= '.png';
                    $model->cover_img->saveAs($location . $filename);
                    $model->save();
                    $this->convert->resizeImage($filename, $model->cover, $location);
                    if($oldcover) { unlink(getcwd() . $this->coverFolder . $oldcover); }
                    break;
                default:
                    $model->addError('cover_img', Yii::t('app', 'The file {filename} cannot be uploaded. Only files with the image formats gif, jpg or png can be uploaded.', array('{filename}' => $model->cover_img->name)));
                    $valid = false;
                    $model->cover=$oldcover;
                    $mode->save();
                    break;
            }
        }
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Series;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Series']))
		{
			$model->attributes=$_POST['Series'];
            $model->slug = $this->convert->slug($model->title);
			$model->created_at = new CDbExpression("NOW()");
            $model->created_by = Yii::app()->user->id;
            
			if(empty($model->alt_titles)) {$model->alt_titles = null;}
			if(empty($model->authors)) {$model->authors = null;}
			if(empty($model->artists)) {$model->artists = null;}
			if(empty($model->description)) {$model->description = null;}
			if(empty($model->thread_url)) {$model->thread_url = null;}
            
			$model->cover_img = CUploadedFile::getInstance($model, 'cover_img');
            
			if($model->save()) {
				$valid = true;
                $this->saveSeriesCover($model, $valid);
                
				if($valid)
					$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $oldcover = $model->cover;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Series']))
		{
			$model->attributes=$_POST['Series'];
            $model->slug = $this->convert->slug($model->title);
			$model->updated_at = new CDbExpression("NOW()");
            $model->updated_by = Yii::app()->user->id;
            
			if(empty($model->alt_titles)) {$model->alt_titles = null;}
			if(empty($model->authors)) {$model->authors = null;}
			if(empty($model->artists)) {$model->artists = null;}
			if(empty($model->description)) {$model->description = null;}
			if(empty($model->thread_url)) {$model->thread_url = null;}
            
			$model->cover_img = CUploadedFile::getInstance($model, 'cover_img');
            
			if($model->save()) {
				$valid = true;
				if($model->remove_img) {
                    unlink(getcwd() . $this->coverFolder . $model->cover);
					$model->cover = null;
					$model->save();
				} else {
                    $this->saveSeriesCover($model, $valid, $oldcover);
                }
                if($valid)
                    $this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model=$this->loadModel($id);
        if($model->cover) { unlink(getcwd() . $this->coverFolder . $model->cover); }        
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Series');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Series('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Series']))
			$model->attributes=$_GET['Series'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Series the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Series::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Series $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='series-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
