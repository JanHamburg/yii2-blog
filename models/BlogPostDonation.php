<?php

namespace funson86\blog\models;


use common\models\User;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog_post_donation".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $anonymous
 * @property string $username
 * @property integer $amount
 * @property string $transaction_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BlogPost $post
 * @property User $user
 */
class BlogPostDonation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_post_donation}}';
    }

    /**
     * created_at, updated_at to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'username', 'amount'], 'required'],
            [['post_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(BlogPost::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    /**
     * Before save.
     * created_at updated_at
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->amount = (int)(\Yii::$app->request->post('amount') * 100);
            return true;
        } else
            return false;
    }

}