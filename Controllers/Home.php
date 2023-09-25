<?php

Namespace Controllers;
/**
 * Summary of Home
 */
class Home extends \controllers\Controller {

    public function __construct() {
        parent::__construct(false);

        Controller::$currentPage = "Dashboard";
        Controller::addCrumb(array("Dashboard", ""));
    }

    /**
     * Summary of index
     * @return void
     */
    public function index () {
        $params = array ();
        
        Controller::$subPage = "Home";
        Controller::addCrumb(array("Home", ""));
        Controller::buildPage(array(ROOT . 'views/navbar', ROOT . 'views/dash/body'), $params);
    }

    /**
     * Summary of public
     * @param mixed $faction
     * @param mixed $print
     * @return void
     */
    public function public ($faction = null, $print = null) {
        if ($faction == null) {
            new DisplayError("#404");
        } else {
            $members = Factions::getFactionMembers($faction);

            if ($print == null) {
                Controller::$subPage = strtoupper($faction)." Roster";
                Controller::addCrumb(array(strtoupper($faction)." Roster", "home/public/".$faction));

                $params = array (
                    "members" => $members,
                    "faction" => $faction,
                    "public" => true,
                    "archive" => false
                );
                
                Controller::buildPage(array(ROOT . 'views/navbar', ROOT . 'views/faction/roster'), $params);
            } else {
                switch ($print) {
                    case "json":
                        header('Content-Type: application/json');
                        echo json_encode($members, JSON_PRETTY_PRINT);
                        break;
                    default:
                        new DisplayError("#404");
                        exit;
                }
            }
        }
    }
}