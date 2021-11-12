<?php
namespace PHPMaker2019\unlockBOT;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(21, "mci_Gestione_Utenti", $MenuLanguage->MenuPhrase("21", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_utenti", $MenuLanguage->MenuPhrase("2", "MenuText"), "utentilist.php", 21, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}utenti'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_userlevels", $MenuLanguage->MenuPhrase("4", "MenuText"), "userlevelslist.php", 21, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(34, "mci_Gestione_Comuni", $MenuLanguage->MenuPhrase("34", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_comuni", $MenuLanguage->MenuPhrase("8", "MenuText"), "comunilist.php", 34, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}comuni'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(33, "mci_Gestione_Q&A", $MenuLanguage->MenuPhrase("33", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_domande", $MenuLanguage->MenuPhrase("6", "MenuText"), "domandelist.php", 33, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}domande'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_risposte", $MenuLanguage->MenuPhrase("5", "MenuText"), "rispostelist.php", 33, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}risposte'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mci_Lookup_Tables", $MenuLanguage->MenuPhrase("19", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_categorie", $MenuLanguage->MenuPhrase("10", "MenuText"), "categorielist.php", 19, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}categorie'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_zone", $MenuLanguage->MenuPhrase("9", "MenuText"), "zonelist.php", 19, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}zone'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(35, "mi_risposte_zona", $MenuLanguage->MenuPhrase("35", "MenuText"), "risposte_zonalist.php", 19, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}risposte_zona'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(53, "mci_Conoscenza_BOT", $MenuLanguage->MenuPhrase("53", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(37, "mi_knowledge_base", $MenuLanguage->MenuPhrase("37", "MenuText"), "knowledge_baselist.php", 53, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}knowledge_base'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(39, "mi_answer_log", $MenuLanguage->MenuPhrase("39", "MenuText"), "answer_loglist.php", 53, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}answer_log'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(54, "mi_audittrail", $MenuLanguage->MenuPhrase("54", "MenuText"), "audittraillist.php", 53, "", AllowListMenu('{1B294467-F675-48C8-9632-26D78A5119EB}audittrail'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>