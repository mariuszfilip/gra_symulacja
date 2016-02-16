<?php
/**
 * Date: 16.11.15
 * Time: 19:47
 * @author Mariusz Filipkowski
 */

namespace Klub\Service;
use Zend\Db\Adapter\AdapterInterface;

class RodzajeTreningow
{
    public function __construct(AdapterInterface $dbAdapter)
    {
        $this->adapter = $dbAdapter;

    }

    public function pobierzRodzaje(){

        return $this->getRodzaje();
    }

    public function pobierzRodzajeGrupy($idGrupy){
        return $this->getRodzaje($idGrupy);
    }

    private function getRodzaje($idGrupy = 0)
    {
        $sqlWhere = '';
        if($idGrupy > 0){
            $sqlWhere = ' AND id_grupy_treningu = '.$idGrupy;
        }
        $dbAdapter = $this->adapter;
        $sql       = 'SELECT id_grupy_treningu_rodzaje,nazwa  FROM grupy_treningu_rodzaje where status=1 '.$sqlWhere.' ORDER BY kolejnosc desc';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[]= array('id'=>$res['id_grupy_treningu_rodzaje'],'nazwa'=>$res['nazwa']);
        }
        return $selectData;
    }

}

