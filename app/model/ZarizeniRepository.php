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
    
    public function findById($id)
    {
	return $this->findAll()->where('id', $id)->fetch();
    }
    
    public function updateZarizeni($zarizeni_id, $nazev, $telefon, $ip)
    {
	$a = $this->find($zarizeni_id);
	
	$a->update(array('nazev' => $nazev, 'telefon'=> $telefon, 'ip' => $ip));
	
	return null;
    }

}
