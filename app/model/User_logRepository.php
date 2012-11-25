<?php
namespace Todo;
use Nette;

class User_logRepository extends Repository
{
    protected $tableName = 'user_log';

    public function findLastLogin($id)
    {
	return date('d.m.Y H:m:s', strtotime($this->getTable()->where('user_id', $id)->max("login_datetime")));
    }

    public function log_user_login($id)
    {
	$this->getTable()->insert(array(
        'user_id' => $id));
    }
}
