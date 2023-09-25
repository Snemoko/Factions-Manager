<?php

namespace Models;

class Form {

    public static function getForm ($faction, $formID) {
        $query = \Core\Database::getFactory()->getConnection(DB_NAME)->prepare("SELECT * FROM forms WHERE id = :id AND (faction = :faction or faction = '') LIMIT 1");
        $query->execute(array(":id" => $formID, ":faction" => $faction));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetch();
    }

    public static function getFields ($formID) {
        $query = \Core\Database::getFactory()->getConnection(DB_NAME)->prepare("SELECT * FROM fields WHERE form = :id");
        $query->execute(array(":id" => $formID));
        
        if ($query->rowCount() == 0) { return false; } 
        return $query->fetchAll();
    }

    public static function canSubmitForm($formID) {
        if (!\Core\Account::isLoggedIn()) { return false; } // Must be logged in...

        $member = Faction::$officer;
        if ($member == null) { return false; } // Wtf??
        
        $rank = Application::getRanks(Faction::$var)[$member->mainlevel];

        $value = "form_submit_" . $formID;
        if (!property_exists($rank, $value)) { return false; }
        if ((Application::getRanks(Faction::$var)[$member->mainlevel]->$value) == 0) { return false; }

        return true;
    }

    public static function getLowestRankWithAccess($formID) {
        $var = Faction::$var;
        if ($var == null) { return false; }
        
        $ranks = Application::getRanks($var);
        
        usort($ranks, function ($rank1, $rank2) {
            return Factions::orderRanks($rank1, $rank2);
        });

        foreach ($ranks as $rank) {
            $value = "form_submit_" . $formID;
            
            if (property_exists($rank, $value)) {
                if (($rank->$value) == 1) { return $rank; }
            }
        }

        return false;
    }
}