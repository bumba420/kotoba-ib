<?php
/*************************************
 * ��� 䠩� ���� ����� Kotoba. *
 * ���� license.txt ᮤ�ন� �᫮��� *
 * �����࠭���� Kotoba.           *
 *************************************/
/*********************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************/
require_once '../config.php';
$debug = false;

/*
 * ������� ��� � SQL �ਯ⠬ �� ᢮�!
 */
$tables_path = 'c:\Apache\htdocs\kotoba\res\data.sql';
$data_path = 'c:\Apache\htdocs\kotoba\res\tables.sql';

echo '�०�� 祬 ����� ��⠭����, �� ������ ��।���஢��� ���䨣��樮��� 䠩�. ' .
	'������� ����� 䠩�� config.default, ������� ��� config.php � ��।������. ' .
	'�᫨ �� 㦥 ᤥ���� ��, � ��� ��砫� ��⠭���� ������ "�த������" ��� ����祪 ' .
	'��� ��-���� ��㣮�, �⮡� ��� �� ��⠭����: ';
$stdin = fopen('php://stdin', 'r');
$option = fgets($stdin);

if($debug)
	echo $option;

if($option != "�த������\r\n")
	exit;

echo "\n��稭����� ��⠭����.\n\n������ ����� ���� � mysql.exe. ���ਬ�� c:\MySQL5\bin: ";
$mysql_path = fgets($stdin);
$mysql_path = substr($mysql_path, 0, strlen($mysql_path) - strlen("\r\n"));

if($debug)
	echo $mysql_path;

echo "\n�������� ⠡���.\n";
$db_name = ($debug ? 'test' : KOTOBA_DB_BASENAME);
exec("$mysql_path\mysql.exe --database $db_name -u " . KOTOBA_DB_USER . (KOTOBA_DB_PASS == '' ? '' : '-p ' . KOTOBA_DB_PASS) . "< \"$tables_path\"");
echo "���������� ��砫��� ������.\n";
exec("$mysql_path\mysql.exe --database $db_name -u " . KOTOBA_DB_USER . (KOTOBA_DB_PASS == '' ? '' : '-p ' . KOTOBA_DB_PASS) . "< \"$data_path\"");
echo "��⠭���� �����襭�.";
?>