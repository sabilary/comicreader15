<?php
class ChaptersController extends Controller
{
    public $coverFolder='/img_chapter/'; // $this->coverFolder
    //
    // CHAPTERS
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
                    $model->save();
                    break;
            }
        }
    }
    
	public function actionCreate()
	{
		$model=new Chapters;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Chapters']))
		{
			$model->attributes=$_POST['Chapters'];
            $model->series_id = $_GET['sid'];
            $model->slug = $this->convert->slug($model->title);
            $model->uniqueid = uniqid();
			$model->created_at = new CDbExpression("NOW()");
            $model->created_by = Yii::app()->user->id;
            
			if(empty($model->description)) {$model->description = null;}
            
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
    
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $oldcover = $model->cover;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Chapters']))
		{
			$model->attributes=$_POST['Chapters'];
            $model->slug = $this->convert->slug($model->title);
			$model->updated_at = new CDbExpression("NOW()");
            $model->updated_by = Yii::app()->user->id;
            
			if(empty($model->description)) {$model->description = null;}
            
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
}

//  SERIES
class SeriesController extends Controller
{
    public $coverFolder='/img_series/'; // $this->coverFolder
    
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
                    $model->save();
                    break;
            }
        }
    }
    
	public function actionCreate()
	{
		$model=new Series;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Series']))
		{
			$model->attributes=$_POST['Series'];
            $model->slug = $this->convert->slug($model->title);
            $model->uniqueid = uniqid();
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
}