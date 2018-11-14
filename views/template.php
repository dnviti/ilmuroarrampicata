<?php

class Template
{
    public function header()
    {
        $_paths = $GLOBALS["paths"];
        $_assets = new Asset();
        $header = '<!DOCTYPE html>
        <html lang="en">
            
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <!-- CSS -->

                    ' . $_assets->getCss([
            $_paths["third-part"] . "bootstrap/bootstrap.min.css",
            $_paths["third-part"] . "bootstrap-select/bootstrap-select.min.css",
            $_paths["third-part"] . "slideout/slideout.css",
            $_paths["third-part"] . "hamburgers/hamburgers.min.css",
            $_paths["third-part"] . "holdon/HoldOn.min.css",
            $_paths["third-part"] . "DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css",
            $_paths["css"] . "style.css"
        ]) . '

                <!-- JS -->
                ' . $_assets->getJs([
            $_paths["third-part"] . "jquery/jquery-3.3.1.min.js",
            $_paths["third-part"] . "popper/popper.min.js",
            $_paths["third-part"] . "bootstrap/bootstrap.min.js",
            $_paths["third-part"] . "bootstrap-select/bootstrap-select.min.js",
            $_paths["third-part"] . "slideout/slideout.min.js",
            $_paths["third-part"] . "holdon/HoldOn.min.js",
            $_paths["third-part"] . "DataTables/datatables.min.js",
            $_paths["third-part"] . "DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js",
            $_paths["js"] . "main.js"
        ]) . '
            </head>
            <title>Il MicaMicro Gestionale</title>
        <body>';

        // Main Page items
        // Current User ID
        if (isset($_SESSION["USER_ID"])) {
            $header = $header . '<input type="hidden" id="p_user_id" value="'. $_SESSION["USER_ID"] .'" />';
        }
        // Current User Name
        if (isset($_SESSION["USERNAME"])) {
            $header = $header . '<input type="hidden" id="p_user_name" value="'.$_SESSION["USERNAME"].'" />';
        }
        // Current User Is Admin
        if (isset($_SESSION["IS_ADMIN"])) {
            $header = $header . '<input type="hidden" id="p_is_admin" value="'.$_SESSION["IS_ADMIN"].'" />';
        }



        return $header;
    }

    public function slideMenu()
    {
        $_components = new Component();
        $slidenav = '        <nav id="menu">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 style="margin-top: 10px;">Menù</h4>
                </div>
            </div>
            <div class="list-group">
                <div class="row">
                    <a href="?p=1" id="m-p1" class="list-group-item list-group-item-action">Home</a>
                </div>
                    <h6>Gestione Ingressi</h6>
                    <div class="row">
                        <a href="?p=2" id="m-p2" class="list-group-item list-group-item-action">Nuovo Incasso</a>
                        <a href="?p=3" id="m-p3" class="list-group-item list-group-item-action">Lista Ingressi</a>
                        <!--
                        <a href="?p=4" id="m-p4" class="list-group-item list-group-item-action">Lista Abbonamenti</a>
                        <a href="?p=5" id="m-p5" class="list-group-item list-group-item-action">Lista Abbonati</a>
                        -->
                    </div>
                
                <h6>Gestione Utenti</h6>
                <div class="row">
                    <a href="?p=6" id="m-p6" class="list-group-item list-group-item-action">Lista Utenti</a>
                    <a href="?p=7" id="m-p7" class="list-group-item list-group-item-action">Registrazione Utente</a>
                </div>';

        // if ($_SESSION["IS_ADMIN"] == true) {
        //     $slidenav = $slidenav . '<h6>Amministrazione</h6>
        //         <div class="row">
        //             <a href="?p=6" id="m-p6" class="list-group-item list-group-item-action">Lista Utenti</a>
        //             <a href="?p=7" id="m-p7" class="list-group-item list-group-item-action">Registrazione Utente</a>
        //         </div>';
        // }
        if ($_SESSION["USERNAME"] != '') {
            $slidenav = $slidenav . ' <span class="slideout-spacer"></span>
                    <div class="row">
                        <a href="#" id="slnav-logout" class="list-group-item list-group-item-action">Logout</a>
                    </div>';
        }
        $slidenav = $slidenav.
             $_components->hGridRow([
              $_components->logo('logo_muro_no_sfondo.png'),
              $_components->logo('logo_solo_cai.png'),
              $_components->logo('solo_scritta_cai.png')
            ])
            ;
        $slidenav = $slidenav . '
              </div>
        </div>
    </nav>';
        return $slidenav;
    }

    public function body()
    {
        $body = '<main id="panel">';
        if (isset($_SESSION["USERNAME"])) {
            $body = $body . '<button class="toggle-menu hamburger hamburger--slider" type="button"  tabindex="0" aria-label="Menu" role="button" aria-controls="navigation">
                    <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                    </span>
                </button>';
        }
        $body = $body . '<div class="container">
        <div class="row">
            <div class="col">';/*
        if (isset($_SESSION["USERNAME"])) {
            $body = $body . '<button class="toggle-menu hamburger hamburger--slider" type="button"  tabindex="0" aria-label="Menu" role="button" aria-controls="navigation">
                    <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                    </span>
                </button>';
        } else {
            $body = $body . '<br>';
        }*/
        $body = $body . '</div>
        </div>
        ';

        return $body;
    }

    public function footer($objs = [])
    {
        //$_assets = new Asset();
        $footer = '
            </div>
            </main>
            <div class="overlay"></div>
            ';

        foreach ($objs as &$value) {
            $footer = $footer . $value;
        }

        $footer = $footer . '
            </body>
            </html>
        ';
        return $footer;
    }
}
