<?php
    session_start();
    /// SETUP - NEED TO BE CHANGED
    $token =  $_SESSION['token'];
    $domainname = $_SESSION['domainname'];
    $functionname = 'enrol_manual_enrol_users';

    // REST RETURNED VALUES FORMAT
    $restformat = 'json';

    /// PARAMETERS - NEED TO BE CHANGED IF YOU CALL A DIFFERENT FUNCTION
    $user1 = new stdClass();
    $user1->roleid = $_GET['roleid'];
    $user1->userid = $_GET['userid'];
    $user1->courseid = $_GET['courseid'];

    $users = array($user1);
    $params = array('enrolments' => $users);

    /// REST CALL
    header('Content-Type: text/plain');
    $serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
    require_once('./curl.php');

    $curl = new curl;
    //if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
    $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
    $resp = $curl->post($serverurl . $restformat, $params);
    header("location:menu.php");
?>