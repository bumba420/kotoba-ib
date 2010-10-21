<?php
/* ***********************************
 * Этот файл является частью Kotoba. *
 * Файл license.txt содержит условия *
 * распространения Kotoba.           *
 *************************************/
/* *******************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************/

/*
 * Скрипт удаления сообщения. Скрипт принимает два параметра, которые передаются
 * с помощью POST или GET запроса:
 * post - Идентификатор удаляемого сообщения.
 * password (необязательно) - Пароль на удаление сообщения.
 */

require_once 'config.php';
require_once Config::ABS_PATH . '/lib/errors.php';
require Config::ABS_PATH . '/locale/' . Config::LANGUAGE . '/errors.php';
require_once Config::ABS_PATH . '/lib/db.php';
require_once Config::ABS_PATH . '/lib/misc.php';
require_once Config::ABS_PATH . '/lib/popdown_handlers.php';
require_once Config::ABS_PATH . '/lib/upload_handlers.php';
require_once Config::ABS_PATH . '/lib/mark.php';

try {
    // Инициализация.
    kotoba_session_start();
    locale_setup();
    $smarty = new SmartyKotobaSetup($_SESSION['language'], $_SESSION['stylesheet']);

    // Проверка, не заблокирован ли клиент.
    if (($ip = ip2long($_SERVER['REMOTE_ADDR'])) === false) {
        throw new CommonException(CommonException::$messages['REMOTE_ADDR']);
    }
    if (($ban = bans_check($ip)) !== false) {
        $smarty->assign('ip', $_SERVER['REMOTE_ADDR']);
        $smarty->assign('reason', $ban['reason']);
        session_destroy();
        DataExchange::releaseResources();
        die($smarty->fetch('banned.tpl'));
    }

    $REQUEST = "_{$_SERVER['REQUEST_METHOD']}";
    $REQUEST = $$REQUEST;

    if (isset($REQUEST['post'])) {
        if (isset($REQUEST['password'])) {
            $password = $REQUEST['password'];
        }
    } else {
        header('Location: http://z0r.de/?id=114');
        DataExchange::releaseResources();
        exit(1);
    }

    $post = posts_get_visible_by_id(posts_check_id($REQUEST['post']), $_SESSION['user']);
    $password = isset($password) ? posts_check_password($password) : $_SESSION['password'];

    if (is_admin()) {
        posts_delete($post['id']);
        header('Location: ' . Config::DIR_PATH . "/{$post['board_name']}/");
    } elseif(($post['password'] !== null && $post['password'] === $password)) {
        $securimage = new Securimage();
        if ($securimage->check($_POST['captcha_code']) == false) {
            throw new CommonException(CommonException::$messages['CAPTCHA']);
        }
        posts_delete($post['id']);
        header('Location: ' . Config::DIR_PATH . "/{$post['board_name']}/");
    } else {

        // Вывод формы ввода пароля.
        $smarty->assign('id', $post['id']);
        $smarty->assign('is_admin', is_admin());
        $smarty->assign('password', $password);
        $smarty->display('remove_post.tpl');
    }

    // Освобождение ресурсов и очистка.
    DataExchange::releaseResources();

    exit(0);
} catch(Exception $e) {
    $smarty->assign('msg', $e->__toString());
    DataExchange::releaseResources();
    die($smarty->fetch('error.tpl'));
}
?>