<?php 
namespace Taka;
/**
  * ToDo - Useful ToDo Management Tool using PDO dabase connection
  *
  * @class    ToDo
  * @author   takawiramundure (@takamuinc) <takawiramundure@gmail.com>
  * @web      <http://takamauinc.com>
  * @url      <https://github.com/takawiramundure>
  * @license  The MIT License (MIT) - <http://opensource.org/licenses/MIT>
  */
class ToDo
{

  protected $pdo;
  protected $dbtable;
  protected $id;
  protected $title;
  protected $text;
  protected $timestamp;
  protected $status;
  protected $timezone;
  
  
  function __construct(Array $config,$timezone="Africa/Harare")
  {
      $this->pdo  =  new \Buki\Pdox($config);
      $this->timezone  =  $timezone;
  }
  /*
  ****Create ToDo Item
  *Requires title,text,deadline,status
  */
  public function table($table){
    $this->dbtable    = (isset($$table) ? $table : "list");
    return $this;
  }
  
  /*
  ****Create ToDo Item
  *Requires title,text,deadline,status,timestamp
  */
  public function create(Array $items){
    $title   = (isset($items["title"]) ? $items["title"] : "New ToDo Item");
    $text = (isset($items["text"]) ? $items["text"] : "");
    $timestamp = (isset($items["timestamp"]) ? $items["timestamp"] : time() + (7 * 24 * 60 * 60));
    if ($this->pdo->table($this->dbtable)->insert([
      'title'=>$title,
      'text'=>$text,
      'deadline'=>$timestamp,
      'status'=>0
    ])) {
      return $this->pdo->insertId();
    }else{
      return 0;
    }
  }

  /*
  ****Edit ToDo Item
  *Requires title,text,deadline,status,timestamp,id
  */
  public function edit(Array $items,$id){
    $title   = (isset($items["title"]) ? $items["title"] : "New ToDo Item");
    $text = (isset($items["text"]) ? $items["text"] : "");
    $timestamp = (isset($items["timestamp"]) ? $items["timestamp"] : time() + (7 * 24 * 60 * 60));
    $status = (isset($items["status"]) ? $items["status"] : 0);
    if ($this->pdo->table($this->dbtable)->where('id',$id)->update([
      'title'=>$title,
      'text'=>$text,
      'deadline'=>$timestamp,
      'status'=>$status
    ])) {
      return 1;
    }else{
      return 0;
    }
  }
  
  /*
  ****Edit ToDo Item
  *Requires id
  */
  public function delete($id){
    if ($this->pdo->table($this->dbtable)->where('id',$id)->delete()) {
      return 1
    }else {
      return 0;
    }
  }
  
  
  
}



 ?>