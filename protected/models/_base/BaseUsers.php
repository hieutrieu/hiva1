<?php

/**
 * This is the model base class for the table "users".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Users".
 *
 * Columns in table "users" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $date_birth
 * @property string $phone
 * @property string $address
 * @property string $fullname
 * @property integer $role_id
 * @property integer $user_type
 * @property integer $status
 * @property string $last_login
 * @property string $customer_code
 * @property string $token
 * @property string $created_at
 * @property string $updated_at
 *
 */
abstract class BaseUsers extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'users';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Users|Users', $n);
	}

	public static function representingColumn() {
		return 'created_at';
	}

	public function rules() {
		return array(
			array('role_id, user_type, status', 'numerical', 'integerOnly'=>true),
			array('username, password, email, first_name, last_name, address, fullname, token', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			array('customer_code', 'length', 'max'=>25),
			array('date_birth, last_login, created_at, updated_at', 'safe'),
			array('username, password, email, first_name, last_name, date_birth, phone, address, fullname, role_id, user_type, status, last_login, customer_code, token, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, username, password, email, first_name, last_name, date_birth, phone, address, fullname, role_id, user_type, status, last_login, customer_code, token, created_at, updated_at', 'safe', 'on'=>'search'),
            array('email', 'unique'),
            array('email', 'email'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'username' => Yii::t('app', 'Username'),
			'password' => Yii::t('app', 'Password'),
			'email' => Yii::t('app', 'Email'),
			'first_name' => Yii::t('app', 'First Name'),
			'last_name' => Yii::t('app', 'Last Name'),
			'date_birth' => Yii::t('app', 'Date Birth'),
			'phone' => Yii::t('app', 'Phone'),
			'address' => Yii::t('app', 'Address'),
			'fullname' => Yii::t('app', 'Fullname'),
			'role_id' => Yii::t('app', 'Role'),
			'user_type' => Yii::t('app', 'User Type'),
			'status' => Yii::t('app', 'Status'),
			'last_login' => Yii::t('app', 'Last Login'),
			'customer_code' => Yii::t('app', 'Customer Code'),
			'token' => Yii::t('app', 'Token'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('date_birth', $this->date_birth, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('fullname', $this->fullname, true);
		$criteria->compare('role_id', $this->role_id);
		$criteria->compare('user_type', $this->user_type);
		$criteria->compare('status', $this->status);
		$criteria->compare('last_login', $this->last_login, true);
		$criteria->compare('customer_code', $this->customer_code, true);
		$criteria->compare('token', $this->token, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}