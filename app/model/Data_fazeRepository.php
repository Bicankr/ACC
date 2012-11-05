<?php
namespace Todo;

use Nette;

class Data_fazeRepository extends Repository
{
    /** @var string */
    protected $tableName = 'data_faze';

    /*
     * faze
     * */
    
    public function fazeAktualni($zarizeni, $faze, $id_old = 0)
    { 
    	if ($id_old == '0') 
	    return $this->findby(array('faze' => $faze, 'regulator' => $zarizeni))->order('datum DESC')->limit(1);
	else
	    return $this->findby(array('faze' => $faze, 'regulator' => $zarizeni, 'id < ?' => $id_old))->order('datum DESC')->limit(1);
	    
	
    }
    public function fazeHodina($zarizeni, $faze)
    { 
	$s = '';
	foreach ($this->findby(array('faze' => $faze, 'regulator' => $zarizeni))->order('datum DESC')->limit(60) as $v) $s = sprintf ('%s,%s', $s, $v->v);
	$s = substr($s, 1, strlen($s) - 1);
	return $s;
    }

}
