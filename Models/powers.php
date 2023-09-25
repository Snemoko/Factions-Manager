<?php

namespace Models;

class Powers {

    public static function getPowers($faction, $target) {
        $query = \Core\Database::getFactory()->getConnection(DB_NAME)->prepare("SELECT * FROM powers WHERE (faction = :faction OR faction = '') AND active = 1");
        $query->execute(array(":faction" => $faction));

        if ($query->rowCount() == 0) { return false; }

        $return = array();

        foreach($query->fetchAll() as $power) {
            if (
                ($power->suspended == $target->isSuspended || $power->suspended == 2) && 
                ($power->archived == $target->isArchive || $power->archived == 2) &&
                ($power->blacklisted == $target->isBlacklisted || $power->blacklisted == 2) &&
                (Form::canSubmitForm($power->form))
               ) {
                array_push($return, $power);
            }
        }

        return $return;
    }
}