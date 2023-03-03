<?php

namespace app\controllers;

use app\models\Group;
use app\models\GroupSearch;
use app\services\GroupService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class GroupController extends Controller
{

	protected GroupService $groupService;
	/**
	 * @param $id
	 * @param $module
	 * @param GroupService $groupService
	 * @param array $config
	 */
	public function __construct($id, $module, GroupService $groupService, array $config = [])
	{
		$this->groupService = $groupService;
		parent::__construct($id, $module, $config);
	}

	/**
	 * @return string
	 */
	public function actionIndex(): string
	{
		$searchModel = new GroupSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * @return void
	 */
	public function actionSubmit()
	{
		if (Yii::$app->request->isPost) {
			$mhtmlFile = UploadedFile::getInstanceByName('file');
			$this->groupService->parseMhtmlFile($mhtmlFile);
		}

	}
}
