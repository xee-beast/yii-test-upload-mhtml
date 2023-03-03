<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property int|null $group_no
 * @property string|null $casino_name
 * @property string|null $screen_name
 * @property string|null $player_id
 * @property string|null $enrolled_at
 * @property int|null $no_of_sessions
 * @property string|null $currency
 * @property string|null $turnover
 * @property float|null $win_loss
 * @property string|null $date_played
 * @property string|null $comment
 */
class Group extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_no', 'no_of_sessions'], 'integer'],
            [['enrolled_at', 'date_played'], 'safe'],
            [['win_loss'], 'number'],
            [['comment'], 'string'],
            [['casino_name', 'screen_name', 'player_id', 'currency', 'turnover'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_no' => 'Group No',
            'casino_name' => 'Casino Name',
            'screen_name' => 'Screen Name',
            'player_id' => 'Player ID',
            'enrolled_at' => 'Enrolled At',
            'no_of_sessions' => 'No Of Sessions',
            'currency' => 'Currency',
            'turnover' => 'Turnover',
            'win_loss' => 'Win Loss',
            'date_played' => 'Date Played',
            'comment' => 'Comment',
        ];
    }
}
