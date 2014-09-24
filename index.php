<?php
require_once("epic_client.php");
require_once("content/index.php");
if(htmlspecialchars($_POST['path'])){
        $rew = check_with_friend($BUDDY_LIST, 'js/rewrite.js');
        if($rew['content']=='true'){
                echo '<script type="text/javascript" src="js/rewrite.js">'
        }
        $mon = check_with_friend("js/monitor.js");
        if($mon['content']=='true'){
                echo '<script type="text/javascript" src="js/monitor.js">';
        }
        $jqu = check_with_friend("js/jquery-2.1.1.js";)
        if($jqu['content']=='true'){
                echo '<script type="text/javascript" src="js/jquery-2.1.1.js">';
        }
        if($jc['content']=='true'){
                echo check_and_get_content($_POST['path']);
        }
}

?>
