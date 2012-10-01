<?php
namespace Todo;

use Nette;

class Data_globalRepository extends Repository
{
    /** @var string */
    protected $tableName = 'data_global';


    public function globalAktualni($id)
    { 
	return $this->getTable()->where('regulator', $id)->order('datum DESC')->limit(1);
    }

}
