<?php
require_once("php/auto_compose_file_list.php");
require_once("php/generate_all_checksums.php");
require_once("php/script_to_script_comparison.php");
require_once("php/hash_equals.php");
require_once("php/echo_array.php");
require_once("data/buddy_list.php");
require_once("data/epic_info.php");
function check_and_get_content(){
        if(htmlspecialchars($_POST['path'])){
                $CHECKS = check_with_friend($BUDDY_LIST, $_POST['path']);
        }
        if($CHECKS['content']=="true"){
                $ch=curl init();
                curl_setopt($ch, CURLOPT_URL, "https://127.0.0.1/".$_POST['path']);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                return $response;
        }
}
?>
