<?php
namespace App\Model;

class TalkEntity
{
    public $id;
    public $title;
    public $type;
    public $abstract;
    public $day;
    public $startTime;
    public $endTime;
    public $room;
    public $speakers;

    public function getArrayCopy()
    {
        return array(
          'id'         => $this->id,
          'title'      => $this->title,
          'type'       => $this->type,
          'abstract'   => $this->abstract,
          'day'        => $this->day,
          'start_time' => $this->startTime,
          'end_time'   => $this->endTime,
          'room'       => $this->room,
          'speakers'   => $this->speakers
        );
    }

    public function exchangeArray(array $array)
    {
        $this->id        = $array['id'];
        $this->title     = $array['title'];
        $this->type      = $array['type'];
        $this->abstract  = $array['abstract'];
        $this->day       = $array['day'];
        $this->startTime = $array['start_time'];
        $this->endTime   = $array['end_time'];
        $this->room      = $array['room'];
        $this->speakers  = $array['speakers'];
    }
}
