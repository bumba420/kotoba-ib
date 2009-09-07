<?php
/*************************************
 * Этот файл является частью Kotoba. *
 * Файл license.txt содержит условия *
 * распространения Kotoba.           *
 *************************************/
/*********************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************/

/* admin/boards.php: manage boards */

require_once("../database_connect.php");
require_once("../database_common.php");
require_once("../common.php");

function get_boards($link) {
	$boards = array();
	$st = mysqli_prepare($link, "call sp_get_boards_ex()");
	if(! $st) {
		kotoba_error(mysqli_error($link));
	}
	if(! mysqli_stmt_execute($st)) {
		kotoba_error(mysqli_stmt_error($st));
	}
	mysqli_stmt_bind_result($st, $cid, $cname, 
		$id, $board_name, $board_description, $board_title, $threads, 
		$bump_limit, $rubber_board, $visible_threads, $same_upload, $orderby);

	while(mysqli_stmt_fetch($st)) {
		array_push($boards, array('cid' => $cid, 'cname' => $cname,
			'id' => $id,
			'board_name' => $board_name, 'board_description' => $board_description,
			'board_title' => $board_title, 'threads' => $threads, 
			'bump_limit' => $bump_limit, 'rubber_board' => $rubber_board,
			'visible_threads' => $visible_threads, 'same_upload' => $same_upload,
			'order' => $orderby
			));
	}
	mysqli_stmt_close($st);
	cleanup_link($link);
	return $boards;
}
function get_categories($link) {
	$categories = array();
	$st = mysqli_prepare($link, "call sp_get_categories()");
	if(! $st) {
		kotoba_error(mysqli_error($link));
	}
	if(! mysqli_stmt_execute($st)) {
		kotoba_error(mysqli_stmt_error($st));
	}
	mysqli_stmt_bind_result($st, $cid, $cname);

	while(mysqli_stmt_fetch($st)) {
		array_push($categories, array('cid' => $cid, 'cname' => $cname));
	}
	mysqli_stmt_close($st);
	cleanup_link($link);
	return $categories;
}
function create_directories($board_name) {
	$base = sprintf("%s%s/%s", $_SERVER['DOCUMENT_ROOT'], KOTOBA_DIR_PATH, $board_name);
	if(mkdir ($base)) { 
		chmod ($base, 0777); 
		$subdirs = array("arch", "img", "thumb"); 
		foreach($subdirs as $dir) { 
			$subdir = sprintf("$base/%s", $dir); 
			if(mkdir($subdir)) { 
				chmod($subdir, 0777); 
			} 
			else { 
				return false;
            }
        }
	}
	else {
		return false;
	}
	return true;

}
function add_new_board($link, &$params_array) {
	if(!isset($params_array['board_name']) || strlen($params_array['board_name']) == 0) {
		kotoba_error("empty data set");
	}
	if(isset($params_array['rubberboard'])) {
		$rubber = strval($params_array['rubberboard']) == 'on' ? 1 : 0;
	}
	else {
		$rubber = 0;
	}
	list($cid, $board_name, $board_description, $board_title,
		$bump_limit, $visible_threads, $same_upload, $orderby) = 
	array(intval($params_array['cid']), strval($params_array['board_name']), 
		strval($params_array['board_description']),
		strval($params_array['board_title']), intval($params_array['bump_limit']),
		intval($params_array['visible_threads']), strval($params_array['same_upload']),
		intval($params_array['order'])
	);
//	echo "$board_name, $board_description, $board_title, $bump_limit,
	//		$rubber, $visible_threads, $same_upload";
	$st = mysqli_prepare($link, "call sp_create_board(?, ?, ?, ?, ?, ?, ?, ?, ?)");
	if(! $st) {
		kotoba_error(mysqli_error($link));
	}
	mysqli_stmt_bind_param($st, "iisssiiii", $orderby, $cid, $board_name, $board_description,
		$board_title, $bump_limit, $rubber, $visible_threads, $same_upload);
	if(! mysqli_stmt_execute($st)) {
		kotoba_error(mysqli_stmt_error($st));
	}
	if(!create_directories($board_name)) {
		kotoba_error("create directories");
	}
	cleanup_link($link);
}
function save_board($link, &$params_array) {
	if(isset($params_array['rubberboard'])) {
		$rubber = strval($params_array['rubberboard']) == 'on' ? 1 : 0;
	}
	else {
		$rubber = 0;
	}
	list($id, $board_name, $board_description, $board_title, $bump_limit,
		$visible_threads, $same_upload, $cid, $order) = 
		array(strval($params_array['id']), strval($params_array['board_name']),
			strval($params_array['board_description']),
			strval($params_array['board_title']), intval($params_array['bump_limit']),
			intval($params_array['visible_threads']), strval($params_array['same_upload']),
			intval($params_array['cid']), intval($params_array['order'])
		);
	$st = mysqli_prepare($link, "call sp_save_board(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	if(! $st) {
		kotoba_error(mysqli_error($link));
	}
	mysqli_stmt_bind_param($st, "iiisssiiii", $id, $order, $cid, $board_name,
		$board_description, $board_title,
		$bump_limit, $rubber, $visible_threads, $same_upload);
	if(! mysqli_stmt_execute($st)) {
		kotoba_error(mysqli_stmt_error($st));
	}
	cleanup_link($link);
}
function gather_supported_filetypes($link, &$boards) {
	$board_types = array();
	foreach($boards as $board) {
		$types = db_get_board_types($link, $board['id']);
		$board_types[$board['id']] = array_keys($types);
		cleanup_link($link);
	}
	return $board_types;
}
$link = dbconn();

if(isset($_GET['action'])) {
	$action = strval($_GET['action']);
}

if(isset($action) && $action == 'new') {
	add_new_board($link, $_GET);
	header("Location: boards.php");
}
elseif(isset($action) && $action == 'save') {
	save_board($link, $_GET);
	header("Location: boards.php");
}
else {
	$boards = get_boards($link);
	$board_types = gather_supported_filetypes($link, $boards);
	$board_categories = get_categories($link);

	$smarty = new SmartyKotobaSetup();
	$smarty->assign('boards', $boards);
	$smarty->assign('categories', $board_categories);
	$smarty->assign('board_types', $board_types);
	$smarty->display('adm_boardsview.tpl');
}
mysqli_close($link);

?>
<pre>
</pre>
