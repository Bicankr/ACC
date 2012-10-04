<?php
namespace Todo;

use Nette;

class ZarizeniRepository extends Repository
{
    /** @var string */
    protected $tableName = 'zarizeni';

    public function getZarizeni()
    { 
	return $this->getTable();
    }

}
