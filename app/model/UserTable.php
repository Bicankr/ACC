<?php

namespace Todo;

use Nette;



class UserTable extends Table
{

	/** @var string */
	protected $tableName = 'user';



	/**
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findByName($username)
	{
		return $this->findAll()->where('username', $username)->fetch();
	}



	/**
	 * @param  int $id
	 * @param  string $password
	 */
	public function setPassword($id, $password)
	{
		$this->getTable()->where(array('id' => $id))->update(array(
			'password' => Authenticator::calculateHash($password)
		));
	}

}
