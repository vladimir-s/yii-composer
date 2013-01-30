<?php

//use Imagine\Gd;

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property integer $id
 * @property string $title
 * @property string $url
 */
class Images extends CActiveRecord
{
	public $image;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'length', 'max'=>255),
			array('title, image', 'required'),
			array('image', 'file', 'types'=>'jpg, jpeg, gif, png'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, image', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'url' => 'Url',
			'image' => 'Image',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Images the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave() {
		$this->url = $this->image->getName();

		return parent::beforeSave();
	}

	public function createThumbs() {
		$imagine = new Imagine\Gd\Imagine();

		$size = new Imagine\Image\Box(40, 40);
		$mode = Imagine\Image\ImageInterface::THUMBNAIL_INSET;

		$imagine->open(Yii::app()->params['uploadsDir'].$this->image->getName())
		    ->thumbnail($size, $mode)
		    ->save(Yii::app()->params['uploadsDir'].$this->getThumbnailName());
	}

	public function getThumbnailName() {
		$parts = explode('.', $this->url);
		$parts[count($parts) - 2] .= '_40x40';
		return implode('.', $parts);
	}
}
