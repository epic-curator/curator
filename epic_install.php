<?php
require_once("php/auto_compose_file_list.php");
require_once("php/generate_all_checksums.php");
require_once("php/script_to_script_comparison.php");
require_once("php/hash_equals.php");
require_once("php/echo_array.php");
require_once("data/epic_info.php");
$PARENT_DIRECTORY = ".";
$BASE = new RecursiveDirectoryIterator($PARENT_DIRECTORY);
$BASEFIL = return_only_files(directory_listing_strings($BASE));
$BASEDIR = return_only_directories(directory_listing_strings($BASE));
generate_all_checksums($BASEFIL, $BASEDIR);
self_consistency_test($BASEFIL, $BASEDIR);
?>
