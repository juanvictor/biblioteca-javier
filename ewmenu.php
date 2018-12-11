<?php
namespace PHPMaker2019\BIBLIOTECA;

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(6, "mci_CATALOGO", $Language->MenuPhrase("6", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "fa-university ", "", FALSE);
$sideMenu->addMenuItem(4, "mi_t_libro", $Language->MenuPhrase("4", "MenuText"), "t_librolist.php", 6, "", IsLoggedIn() || AllowListMenu('{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}t_libro'), FALSE, FALSE, "fa-book", "", FALSE);
$sideMenu->addMenuItem(7, "mci_TRANSACCIONES", $Language->MenuPhrase("7", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "fa fa-credit-card", "", FALSE);
$sideMenu->addMenuItem(5, "mi_t_transaccion", $Language->MenuPhrase("5", "MenuText"), "t_transaccionlist.php", 7, "", IsLoggedIn() || AllowListMenu('{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}t_transaccion'), FALSE, FALSE, "fa-vcard", "", FALSE);
$sideMenu->addMenuItem(11, "mci_REPORTES", $Language->MenuPhrase("11", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "fa fa-print", "", FALSE);
$sideMenu->addMenuItem(16, "mi_Catalogo", $Language->MenuPhrase("16", "MenuText"), "Catalogolist.php", 11, "", IsLoggedIn() || AllowListMenu('{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}Catalogo'), FALSE, FALSE, "fa fa-file-pdf-o", "", FALSE);
$sideMenu->addMenuItem(14, "mi_prestado", $Language->MenuPhrase("14", "MenuText"), "prestadolist.php", 11, "", IsLoggedIn() || AllowListMenu('{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}prestado'), FALSE, FALSE, " 	fa fa-male", "", FALSE);
$sideMenu->addMenuItem(12, "mci_ESTADISTICAS", $Language->MenuPhrase("12", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "fa fa-area-chart", "", FALSE);
echo $sideMenu->toScript();
?>
