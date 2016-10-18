<?php
namespace App\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

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
               ->where(['talks_speakers.talk_id' => $id]);
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
        return $this->table->select(function (Select $select) use ($day) {
          $select->where(['day' => $day])->order('start_time');
        });
    }
}
