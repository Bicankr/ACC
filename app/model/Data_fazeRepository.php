<?php
namespace Todo;

use Nette;

class Data_fazeRepository extends Repository
{
    /** @var string */
    protected $tableName = 'data_faze';


    public function fazeAktualni($faze)
    { 
	return $this->getTable()->where('faze', $faze)->order('datum DESC')->limit(1);
    }

}
