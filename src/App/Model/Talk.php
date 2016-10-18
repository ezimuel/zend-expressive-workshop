<?php
namespace App\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;

class Talk
{
    protected $table;

    public function __construct(AdapterInterface $adapter)
    {
        $resultSet = new HydratingResultSet();
        $resultSet->setObjectPrototype(new TalkEntity());
        $this->table = new TableGateway('talks', $adapter, null, $resultSet);
    }

    public function getAll()
    {
        return $this->table->select();
    }

    public function getTalk($id)
    {
        $talk = $this->table->select([ 'id' => $id ])->current();

        // get the speakers of the talk
        $sql    = new Sql($this->table->adapter);
        $select = $sql->select();
        $select->from('speakers')
               ->join('talks_speakers', 'talks_speakers.speaker_id = speakers.id')
               ->where(array('talks_speakers.talk_id' => $id));
        $stm    = $sql->prepareStatementForSqlObject($select);
        $result = $stm->execute();

        $resultSet = new HydratingResultSet();
        $resultSet->setObjectPrototype(new SpeakerEntity());
        $resultSet->initialize($result);
        $talk->speakers = $resultSet;

        return $talk;
    }

    public function getTalkByDate($day)
    {
        // get the speakers of the talk
        $sql    = new Sql($this->table->adapter);
        $select = $sql->select();
        $select->from('talks')
               ->where(array('talks.day' => $day))
               ->order('talks.start_time');
        $stm    = $sql->prepareStatementForSqlObject($select);
        $result = $stm->execute();

        $resultSet = new HydratingResultSet();
        $resultSet->setObjectPrototype(new TalkEntity());
        $resultSet->initialize($result);

        return $resultSet;
    }
}
