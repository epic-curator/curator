<?php
function compare_checksum_local($path){
        if(!strpos($path,".sha")){
                if(is_file($path)){
                        $hash_result=array();
                        $fp = fopen("$path.sha",'r');
                        if(hash_equals(hash_file('sha256', $path),fread($fp,filesize("$path.sha")))){
                                $hash_result[$path]="$path is real\n";
                        }else{$hash_result[$path]="$path is fake\n";}
                        fclose($fp);
                        $fp = fopen("$path.dc.sha",'r');
                        $ch=curl init();
                        curl_setopt($ch, CURLOPT_URL, "https://127.0.0.1/$path");curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        if(hash_equals(hash('sha256',$response,FALSE),fread($fp,filesize("$path.dc.sha"))){
                                $hash_result[$dc]="dynamic content is real";
                        }else{
                                $hash_result[$dc]="dynamic content is fake";
                        };
                        fclose($fp);
                        return $hash_result;
                }else{
                        return "Uh-oh, looks like the file $path wasn't found. Clearly that indicates decreased integrity.\n";
                }
        }
}
function compare_checksum_peer($path, $hash){
        if(!strpos($path,".sha")){
                if(is_file($path)){
                        $hash_result=array();
                        $fp = fopen("$path.sha",'r');
                        if(hash_equals($hash, fread($fp,filesize("$path.sha")))){
                                $hash_result[$path]="$path is real\n";
                        }else{$hash_result[$path]="$path is fake\n";}
                        fclose($fp);
                        $fp = fopen("$path.dc.sha",'r');
                        if(is_array($buddylist)){
                                foreach($buddylist as $url){
                                        $ch=curl init();
                                        curl_setopt($ch, CURLOPT_URL, "https://127.0.0.1/$path");curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                        $response = curl_exec($ch);
                                        curl_close($ch);
                                        if(hash_equals(hash($response),fread($fp,filesize("$path.dc.sha"))){
                                                $hash_result["dc"]="dynamic content is real\n";
                                        }else{
                                                $hash_result["dc"]="dynamic content is fake\n";
                                        }
                                }
                        }
                        if($hash_result[$path]=="$path is real\n"){if($hash_result["dc"]=="dynamic content is real\n"){
                                $hash_result['content']="true";
                        }}
                        fclose($fp);
                        return $hash_result;
                }else{
                        return "Uh-oh, looks like the file $path wasn't found. Clearly that indicates decreased integrity.\n";
                }
        }
}
function compare_over_folder($listing){
        if(is_array($listing)){
                foreach($listing as $name){
                        echo compare_checksum_local($name);
                }
        }else{
                echo compare_checksum($listing);
        }
}
function self_consistency_test($files, $folders){
        echo "This is the result of a self-consistency check.\n";
        if(is_array($files)){
                compare_over_folder($files);
        }else{
                echo compare_checksum($files);
        }
        if(is_array($folders)){
                foreach($folders as $name){
                        $temp = new RecursiveDirectoryIterator($name);
                        compare_over_folder(return_only_files(directory_listing_strings($temp)));
                }
        }
        echo "End self consistency check\n";
}
function peer_consistency_test($buddylist){
        $SELF=array(
                "epic_curate"=>"epic_curate.md",
                "epic_install"=>"epic_install.md",
                "epic_update"=>"epic_update.md",
                "README"=>"README.md",
                "index"=>"index.php",
                "auto_compose_file_list"=>"php/auto_compose_file_list.php",
                "echo_array"=>"php/echo_array.php",
                "generate_all_checksums"=>"php/generate_all_checksums.php",
                "hash_equals"=>"php/hash_equals.php",
                "script_to_script_comparison"=>"php/script_to_script_comparison.php",
                "strip_executable_javascript"=>"php/strip_executable_javascript.php",
                "monitor"=>"js/monitor.js",);
        if(isarray($buddylist)){
                foreach($buddylist as $url){
                        foreach($SELF as $path){
                                $ch=curl init();
                                $fp = fopen($path, 'r');
                                $post_options = array("path"=>"$path", "peer"=>"$MY_NAME", "update" => "false", "hash"=>hash_file('sha256',$path,FALSE);
                                curl_setopt($ch, CURLOPT_POST, $post_options);
                                curl_setopt($ch, CURLOPT_URL, "$url/epic_curate.php");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($ch);
                                curl_close($ch);
                        }
                }
        }else{
                foreach($SELF as $path){
                        $ch=curl init();
                        $fp = fopen($path, 'r');
                        $post_options = array("path"=>"$path", "peer"=>"$MY_NAME" "update" => "false", "hash"=>hash_file('sha256',$path,FALSE);
                        curl_setopt($ch, CURLOPT_POST, $post_options);
                        curl_setopt($ch, CURLOPT_URL, "$url/epic_curate.php");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                }
        }
}
function send_to_friend($buddylist, $path){
        if(is_array($buddylist)){
                foreach($buddylist as $url){
                        $ch=curl init();
                        $fp = fopen($path, 'r');
                        $post_options = array("path"=>"$path", "peer"=>"$MY_NAME","update" => "true", "hash"=>hash_file('sha256',$path,FALSE));
                        curl_setopt($ch, CURLOPT_POST, $post_options);
                        curl_setopt($ch, CURLOPT_URL, "$url/epic_curate.php");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                }
        }else{
                $ch=curl init();
                $fp = fopen($path, 'r');
                $post_options = array("path"=>"$path", "peer"=>"$MY_NAME", "update" => "true", "hash"=>hash_file('sha256',$path,FALSE));
                curl_setopt($ch, CURLOPT_POST, $post_options);
                curl_setopt($ch, CURLOPT_URL, "$buddylist/epic_curate.php");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
        }
}
function send_all_checksums($buddylist, $basehashes, $basedirs){
        send_to_friend($buddylist,".");
        foreach($basedirs as $name){
                $temp = new RecursiveDirectoryIterator($name);
                $temp2 = return_only_hashes(directory_listing_strings($temp));
                foreach($temp2 as $name2){
                        send_to_friend($buddylist, $name2);
                }
        }
}
function check_with_friend($buddylist, $path){
        if(is_array($buddylist)){
                $response=array();
                foreach($buddylist as $url){
                        $ch=curl init();
                        $post_options = array("path"=>"$path", "peer"=>"$MY_NAME", "update"=>"false", "hash"=>hash_file('sha256',$path,FALSE));
                        curl_setopt($ch, CURLOPT_URL, $url."epic_curate.php");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response[$path] = curl_exec($ch);
                        curl_close($ch);
                }
        }else{
                $ch=curl init();
                $post_options = array("path"=>"$path", "peer"=>"$MY_NAME", "update"=>"false", "hash"=>hash_file('sha256',$path,FALSE));
                curl_setopt($ch, CURLOPT_URL, $url."epic_curate.php");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
        }
        return response;
}
?>
