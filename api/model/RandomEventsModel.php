<?php
require_once PROJECT_ROOT_PATH . "/model/Database.php";

class RandomEventsModel extends Database
{
    public function getEventByCode(array $data)
    {


        $this->query("SELECT id, text, money_change FROM random_events WHERE kod = :kod");
        $this->bind(":kod", $data['code']);
        $event = $this->single();
        if(!$event){
            return false;
        }
        $this->query("SELECT COUNT(*) AS pocet FROM player_random_event WHERE event = :event && player = :player");
        $this->bind(":event", $event["id"]);
        $this->bind(":player", $data['id']);
        $used = $this->single()["pocet"];
        if($used == 0){

            $this->query("INSERT INTO player_random_event (player, event, money) VALUES (:p, :e, :m) ");
            $this->bind(":p", $data['id']);
            $this->bind(":e", $event["id"]);
            $this->bind(":m", $event["money_change"]);
            $this->execute();

            $this->query("UPDATE player SET money = money + :change WHERE id = :id");
            $this->bind(":change", $event["money_change"]);
            $this->bind(":id", $data['id']);
            $this->execute();
            return $event;
        }else{
            return false;
        }


    }

}
