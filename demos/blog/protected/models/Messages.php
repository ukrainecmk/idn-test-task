<?php

/**
 * This is the model class for table "{{messages}}".
 *
 * The followings are the available columns in table '{{messages}}':
 * @property integer $id
 * @property string $msg
 * @property integer $author_id
 * @property string $ip
 * @property integer $create_time
 */
class Messages extends CActiveRecord
{
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->create_time = time();
                $this->author_id = Yii::app()->user->id;
                $this->ip = Yii::app()->request->userHostAddress;
            }
            return true;
        }
        else
            return false;
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{messages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('msg', 'required'),
			array('author_id, create_time', 'numerical', 'integerOnly'=>true),
			array('msg', 'length', 'max'=>100),
			array('ip', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, msg, author_id, ip, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),
		);
	}
    protected function afterFind()
	{
		parent::afterFind();
        //For guests
        if(empty($this->author)) {
            $this->author = new stdClass();
            $this->author->username = 'Guest';
        }
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'msg' => 'Message',
			'author_id' => 'Author',
			'ip' => 'Ip',
			'create_time' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('msg',$this->msg,true);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('create_time',$this->create_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}