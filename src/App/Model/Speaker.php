<?php
namespace App\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;

class Speaker
{
    protected $table;

    public function __construct(AdapterInterface $adapter)
    {
        $resultSet = new HydratingResultSet();
        $resultSet->setObjectPrototype(new SpeakerEntity());
        $this->table = new TableGateway('speakers', $adapter, null, $resultSet);
    }

    public function getAll()
    {
        return $this->table->select();
    }

    public function getSpeaker($id)
    {
        $speaker = $this->table->select([ 'id' => $id ])->current();

        // get the talks of the speaker
        $sql    = new Sql($this->table->adapter);
        $select = $sql->select();
        $select->from('talks')
               ->join('talks_speakers', 'talks_speakers.talk_id = talks.id')
               ->where(array('talks_speakers.speaker_id' => $id));
        $stm    = $sql->prepareStatementForSqlObject($select);
        $result = $stm->execute();

        $resultSet = new HydratingResultSet();
        $resultSet->setObjectPrototype(new TalkEntity());
        $resultSet->initialize($result);
        $speaker->talks = $resultSet;

        return $speaker;
    }
}
