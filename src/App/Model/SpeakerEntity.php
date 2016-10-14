<?php
namespace App\Model;

class SpeakerEntity
{
    public $id;
    public $name;
    public $bio;
    public $talks;

    public function getArrayCopy()
    {
      return [
        'id'    => $this->id,
        'name'  => $this->name,
        'bio'   => $this->bio,
        'talks' => $this->talks
      ];
    }

    public function exchangeArray(array $array)
    {
      $this->id    = $array['id'];
      $this->name  = $array['name'];
      $this->bio   = $array['bio'];
      $this->talks = $array['talks'];
    }
}
