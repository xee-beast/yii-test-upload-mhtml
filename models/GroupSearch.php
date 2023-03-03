<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Group;
use yii\helpers\VarDumper;

class GroupSearch extends Group
{
	public $search;
	public $date_played_from;
	public $date_played_to;

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[['group_no'], 'integer'],
			[['date_played_from', 'date_played_to'], 'date', 'format' => 'yyyy-MM-dd'],
		];
	}

	/**
	 * @return array|array[]
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * @param $params
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		VarDumper::dump($params);
		$query = Group::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'group_no' => $this->group_no,
		]);

		if ($this->date_played_from && $this->date_played_to) {
			$query->andFilterWhere(['between', 'date_played', $this->date_played_from, $this->date_played_to]);
		}

		return $dataProvider;
	}
}
