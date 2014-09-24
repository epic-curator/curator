<?php
require_once("php/auto_compose_file_list.php");
require_once("php/generate_all_checksums.php");
require_once("php/script_to_script_comparison.php");
require_once("php/hash_equals.php");
require_once("php/echo_array.php");
require_once("data/buddy_list.php");
require_once("data/epic_info.php");
if(htmlspecialchars($_POST["update"])=="true"){
        if(peer_consistency_test($BUDDY_LIST)){
                $fp = fopen(htmlspecialchars($_POST["path"], ''w);
                fwrite($fp, htmlspecialchars("data/".$_POST['peer']."/".$_POST['hash']));
                fclose($fp);
        }
}else{
        if(peer_consistency_test($BUDDY_LIST)){
                return compare_checksum_peer($_POST['path'], $_POST['hash']);
        }
}
?>
