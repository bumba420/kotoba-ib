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
//Скрипт, показывающий id пользователя.

require '../config.php';
require Config::ABS_PATH. '/modules/errors.php';
require Config::ABS_PATH . '/modules/lang/' . Config::LANGUAGE . '/errors.php';
require Config::ABS_PATH . '/modules/db.php';
require Config::ABS_PATH . '/modules/cache.php';
require Config::ABS_PATH . '/modules/common.php';
try
{
	kotoba_session_start();
	locale_setup();
	$smarty = new SmartyKotobaSetup($_SESSION['language'], $_SESSION['stylesheet']);
	bans_check($smarty, ip2long($_SERVER['REMOTE_ADDR']));	// Возможно завершение работы скрипта.
	$smarty->assign('id', $_SESSION['user']);
	$smarty->display('my_id.tpl');
	if(isset($_GET['kuga']) && $_GET['kuga'] === '1')
		echo take_it_easy();
	DataExchange::releaseResources();
	exit;
}
catch(Exception $e)
{
	$smarty->assign('msg', $e->__toString());
	DataExchange::releaseResources();
	die($smarty->fetch('error.tpl'));
}
?>
<?php
function take_it_easy() {
return <<<KUGA
<tt><br>,:7=OOOOO8OOONOOOOOOOOOOOOOOOO,,,,,,,,,,8OOO8OOOOOOOOOOOOOO8OOOOOOOOOOOOOOOODDOO<br>
.:IOOOOODOODD8OOOOOOOOOOOOOO8:,,,,,,,,,,,,,8OOOO8OO8OOOOOOO8OOOOOOOOOOOOOOOODDOO<br>
,,IOOOOODOODDOOOOOOOOOOOOOO8~,,,,,,,,,,,,,,,,,,7D8OON8O88OODOOOOOOOOOOOOOOOONDDO<br>
.,8OOOO8OO8DOOOOOOOOOOOOOO8=,,,,,,,,,,,,,,,,,,,,,,,,,7DDDDNDOOOOOOOOOOOOOOOODDDO<br>
.,OOOOODOODDOOOOOOOOOOOOD8+,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,:DOOOOOOOOOOOOO8OODDD8<br>
.,OOOOODOODOOOOOOOOOOOOD8+,,,,,,,,,,,,,,,,,,,,,D,,,,,,,,,,:8OOOOOOOOOOOOODOODDDD<br>
.,OOOOO8OONOOOOOOOOOOODD+,,,,,,,,,,,,,,,,,,,O,,,,,,,,,,,,,:8OOOOOOOOOOOOOOODD++N<br>
,,OOOOD8ODDOOOOOOOOOODD+:,,,,,,,,,,,,,,,,:O:,,,,,,,,,,,,,,,8OOOOOOOOOOOOOOO8D+$:<br>
.,OOOOD8ODOOOOOOOOOODN=,,,,,,,,,,,,,,,:,O,,,,,,,,,,,,,,,,,:OOOOOOOOOOOOOOOOO8+++<br>
.,OOOOOOODOOOOOOOO8DO~,,,,,,,,,,,,,,,,O7::,,7MNZOM8,,,,,,,7OOOOOOOOOOOOOOOOOO+~,<br>
~=OOOOOOOD8OOOOOODN$~,,,,,,,,,,,,,,,,8:I,7M++DM:..?+M,,,,,8OOOOOOOOOOOOO8OOOO=,,<br>
77OOOOOO8D8O8OOODD+:,,,,,,,,,,,,,,,OI,,,M+:.MDD,..N,$,,,,:OOOOOOOOOOOOOOOOOO8+$:<br>
::ZOOOOODDDODOOD8+,,,,,,,,,,,,,,,,O,,,7D:...DO8MMO8N.,,,,,OOOOOOOOOOOOOOOO8O8$,,<br>
+?OOOOOODDDDO8N+:,,,,,,,,,,,,,,,~8+,,,N.....NO77778=,,:,,:OOOOOOOOOOOOOOOO8OD,,N<br>
IIOOOOOODDD8D=+,,,,,,,,,,,:,,,,8++,,,,,......+OO8N8=:::::,OOOOOOOOOOOOOOOOOOD+8D<br>
??OOOOOODDDD+:,,,,,,,,,:,,,:,?,,+,,,,,,,......~D:=~~~~:::~8OOOOOOOOOOOODOOOO8\$DD<br>
,,ZO8OOODDD+,Z8$$8OOOO$+:,,,,,,,,,,,,,::::::~~~~~~=~=~~::7DOOOOOOOOOOOODOOOODDDD<br>
.,OO8OOODDD,=,,,,:7,:~+=~,,,,,,,,,,,:::::~~~=~~=~~~~~~~::8DOOOOOOOOOOOONOOOO8DDD<br>
.,OOOOOODDDN,,,,,D+ M.M$,,,,,,,,,,,::::~=~=~~~~~~~~~~::::ODOOOOOOOOOOODDOOOODDDD<br>
.,OOOOOO8DDDD,,,M+.DD+D,,,,,,,,,,,,::=~~~~~~~~~::::::::::O8OOOOOOOOOOODDOOOODDDD<br>
.,OOOOOOODDDDD,,D+.D$\$Z$,,,,,,,,,,,,::::::::::::::::::,,:O8OOOOOOOOOO8DDOOOODDDD<br>
.,ODOOOOODDDDDN,,=...8N,,,,,,,,,,,,,:::::::::::::,,,,,,,,OOOOOOOOOOOOODDOOOONDDD<br>
.,ODOOOOODDDDDDN,,,...,:::~::,,,,,,,,,,,,,,,,,,,,,,,,,,,?OOOOOOOOOOOOODDO8OODDDD<br>
.,ODOOOOODDDDDDD$::::~~=~:::,,,,,,,,,,,,,,,,,,,,,,,,,,,,D8OOOOOOOOOOOODDO8OODDDD<br>
.,ODOOOOODDDDDDDN=::=~=~~::+:,,,,,,,,,,,,,,,,,,,,,,,,,,,ODOOOOOOOOO8OODDO8OODDDD<br>
.,ONOOOOOODDDDDDDD:~~~~::::+:,,,,:,,,,,,,,,,,,,,,,,,,,,,ODOOOOOOOOOOODODODOOODDD<br>
.,ODOOOO8ODDDDDDDDN:~::::,++=+:,,,,,,,,,,,,,,,,,,,,,,,=.ONOOOOOOOO8OODODODOOODDD<br>
.,8DOOOO8ODDDDDDDDZ,::::,,,=+++,,,,,,,,,,,,,,,,,,,,,,,,IODOOOOOOOODOODODODOOO8DD<br>
.,DDOOOOOODDDDDDDD,?,,,,,,,,,~,,,,,,,,,,I.+O:,,,,,,,,,,888OOOOOOO8OODOODODOOOODD<br>
.,DDOOOOOODDDDDDDD.,M,,,,,,,,,,,,,,,,=.....~,,,,,,,,,,,ODOOOOOOOODOODOODOD8OOODD<br>
.,DDOOOOOODDDDDDDN,,,M,,,,,,,,,,,,,O~:,,,,,,,,,,,,,,,,:ODOOOOOOOODOOOOO8OD8OOODD<br>
,,NDOOOOOODDDDDDDI::~=D,,,,,,,,,,,,,,,,=++,,,,,,,,,,,,8ODOOOOOOODOODOOOOOD8OOODD<br>
::NDOOODOODDDDDDD??+==~~D::,,,,,,,,,,,,,,,,,,,,,,,,,,,O8DOOOOOO8DOO8OOOOOD8OOO8D<br>
IIDDOOOOOODDDDDD8,:::::~~OD7~,,,,,,,,,,,,,,,,,,,,,,,,~ODDOOOOOONDOOOOOOOODDOOOOD<br>
~~DDOOOOOODDDDDDI777777I?ZODDDN+:,,,,,,,,,,,,,,,,,,,,8OD8OOOOOODDO8OOOOOODDOOOOD<br>
77DDOO8OOODDDDD8~::::,,,,:8DDDDDDDN=:,,,,,,,,,,,,,,,,ODDOOOOOODD8OOOOOOOODDOOOOD<br>
==\$DOODOOODDDDD:~~==+??IIII8DDDDDDDDDDD+,,,,,,,,,,,?+ODDOOOOOODDOOOOOOOO8DDOOOO8</tt>
KUGA;
}
?>