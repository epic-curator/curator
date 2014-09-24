<?php
function generate_single_checksum($path){
        if(!strpos($path,".sha")){
                if(is_file($path)){
                        $fp = fopen("$path.sha", 'w');
                        fwrite($fp, hash_file('sha256',$path,FALSE));
                        fclose($fp);
                        chmod("$path.sha", 0644);
/*                        $ch=curl init();
                        curl_setopt($ch, CURLOPT_URL, "https://127.0.0.1/$path");curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        $fpp = fopen("$path.dc.sha", 'w');
                        fwrite($fpp, hash('sha256',$response,FALSE));
                        fclose($fpp);
                        chmod("$path.dc.sha", 0644);*/
                }else{
                        return "Empty file passed to hash generator";
                }
        }
}
function checksum_for_folder($folder){
        if(is_array($folder)){
                foreach($folder as $filename){
                        generate_single_checksum($filename);
                }
        }else{
                generate_single_checksum($folder);
        }
}
function generate_all_checksums($basefiles, $basedirs){
        checksum_for_folder(return_only_files(directory_listing_strings($basefiles)));
        foreach($basedirs as $name){
                $temp = new RecursiveDirectoryIterator($name);
                checksum_for_folder(return_only_files(directory_listing_strings($temp)));
        }
}
?>
