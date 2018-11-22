<?php

class Page
{
    public $menuJs = 'var slideout = new Slideout({
        "panel": document.getElementById("panel"),
        "menu": document.getElementById("menu"),
        "padding": 256,
        "tolerance": 70
      });

      slideout.on("translatestart", function() {
        $(".toggle-menu").addClass("is-active");
      });

      slideout.on("beforeclose", function() {
        $(".toggle-menu").removeClass("is-active");
      });

      document.querySelector(".toggle-menu").addEventListener("click", function() {
        slideout.toggle();
        if(slideout.isOpen()){
            $(".toggle-menu").addClass("is-active");
        }else{
            $(".toggle-menu").removeClass("is-active");
        }
      });

      /*slideout.open();*/';

    public function getPage($pnum)
    {
        switch ($pnum) {
            case 7:
                echo $this->register($pnum);
                break;
            case 1:
                echo $this->home($pnum);
                break;
            case 6:
                echo $this->lista_utenti($pnum);
                break;
            case 3:
                echo $this->lista_incassi($pnum);
                break;
            case 2:
                echo $this->nuovo_ingresso($pnum);
                break;
        }
    }

    public function login()
    {
        $_components = new Component();
        $_templates = new Template();

        $footer_objs = [
            // generazione Menu (codice in variabile pubblica di classe)
            $_components->javaScript($this->menuJs),
            // colorazione menu attivo
            //$_components->javaScript('$("#m-p'.$pnum.'").addClass("active")')
        ];

        $page = ''
            . $_templates->header()
            . $_templates->body()
            . '<br>'
            . $_components->hGridRow([
              $_components->logo('logo_muro_no_sfondo.png'),
              $_components->logo('logo_solo_cai.png'),
              $_components->logo('solo_scritta_cai.png')
            ])
            . $_components->htmlFromFile('login')
            . $_components->javaScriptFromFile('login')
            . $_templates->footer();

        return $page;
    }

    public function register($pnum)
    {
        $_components = new Component();
        $_templates = new Template();

        isset($_GET["ID"]) ? $rowId = $_GET["ID"] : $rowId = null;

        $isObsoleto = json_decode($_components->valueFromQuery("SELECT obsoleto FROM users WHERE id = " . $rowId), true)[0]["obsoleto"];

        if (!isset($_GET['ID']) || $_GET['ID'] == '') {
            $gridForm_btn = [
                $_components->button('Crea Utente', 'primary', '', '', 'btn-register')
            ];
        } else {
            $gridForm_btn = [
                $_components->button('Salva', 'success', '', '', 'btn-save'),
                // Visualizzo il bottone elimina solo se admin
                ($_SESSION["IS_ADMIN"] == 1 ? $_components->button('Elimina', 'danger', '', '', 'btn-delete') : null)
            ];
        }

        $footer_objs = [
            // generazione Menu (codice in variabile pubblica di classe)
            $_components->javaScript($this->menuJs),
            // colorazione menu attivo
            $_components->javaScript('$("#m-p' . $pnum . '").addClass("active")')
        ];

        $form_items = [
            $_components->vGridRow([
                $_components->hGridRow([
                    $_components->itemFromColumn('users', 'nome', 'text'),
                    $_components->itemFromColumn('users', 'cognome', 'text'),
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('users', 'data_nascita', 'date'),
                    $_components->itemFromColumn('users', 'anno_tessera', 'text')
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('users', 'tessera_CAI', 'text'),
                    $_components->itemFromColumn('users', 'sez_tessera', 'text')
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('users', 'username', 'text'),
                    $_components->itemFromColumn('users', 'password', 'password', null, null, (isset($rowId) ? 'disabled' : null)),
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('users', 'email', 'email'),
                    $_components->selectFromQuery('lov/lov_ruoli', 'users', 'id_role', 'classic', 'Ruolo'),
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('users', 'note', 'textarea')
                ]),
                ($isObsoleto == 1 ? 'Utente Obsoleto<br><br>' : '')
            ], 'f_register_items'),
            ($isObsoleto == 0 ? $_components->hGridRow($gridForm_btn) : ''),
            //Hidden Elements
            $_components->itemFromColumn('users', 'id', 'hidden', $rowId),
            $_components->itemFromColumn('users', 'id_userre', 'hidden', $_SESSION["USER_ID"])
        ];

        $jsObsoleto = "
            $(document).ready(function(){
                $isObsoleto == 1 ? alert('Attenzione! Utente Obsoleto attivo solo in consultazione') : null;
            });
        ";

        $page = ''
            . $_templates->header()
            . $_templates->slideMenu()
            . $_templates->body()
            . $_components->form($form_items, 'f-register')
            . $_components->javaScript($jsObsoleto)
            . $_components->javaScriptFromFile('register')
            . $_components->javaScriptFromFile('slidemenu')
            . $_templates->footer($footer_objs);

        return $page;
    }

    public function nuovo_ingresso($pnum)
    {
        $_components = new Component();
        $_templates = new Template();

        $gridForm_btn = [
            $_components->button('Registra Ingresso', 'primary', '', '', 'btn-save-ingresso')
        ];

        $footer_objs = [
            // generazione Menu (codice in variabile pubblica di classe)
            $_components->javaScript($this->menuJs),
            // colorazione menu attivo
            $_components->javaScript('$("#m-p' . $pnum . '").addClass("active")')
        ];

        $form_items = [
            $_components->vGridRow([
                $_components->hGridRow([
                    $_components->selectFromQuery('lov/lov_users', 'registro_incassi', 'id_user', 'search', 'Utente'),
                    $_components->selectFromQuery('lov/lov_tipo_incasso', 'registro_incassi', 'id_tipo', 'classic', 'Tipo Ingresso', '', null, null, false, 'disabled'),
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('registro_incassi', 'valore', 'number'),
                    $_components->itemFromColumn('registro_incassi', 'data', 'date')
                    //$_components->selectFromQuery('lov_ruoli', 'id_role'),
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('registro_incassi', 'note', 'textarea')
                ]),
            ], 'f_register_items'),
            $_components->hGridRow($gridForm_btn),
            //Hidden Elements
            $_components->itemFromColumn('registro_incassi', 'id_userre', 'hidden', $_SESSION["USER_ID"])
        ];

        $page = ''
            . $_templates->header()
            . $_templates->slideMenu()
            . $_templates->body()
            . $_components->form($form_items, 'f-ingresso')
            . $_components->hGridRow(['<span id="dettTesseraCai"></span>'])
            . $_components->javaScriptFromFile('save_ingresso')
            . $_components->javaScriptFromFile('slidemenu')
            . $_templates->footer($footer_objs);

        return $page;
    }

    public function home($pnum)
    {
        $_components = new Component();
        $_templates = new Template();

        $gridRow_btn = [
            $_components->button("Nuovo Ingresso", "primary", "2"),
            $_components->button("Lista Utenti", "secondary", "6")
        ];

        $footer_objs = [
            // generazione Menu (codice in variabile pubblica di classe)
            $_components->javaScript($this->menuJs),
            // colorazione menu attivo
            $_components->javaScript('$("#m-p' . $pnum . '").addClass("active")')
        ];

        $page = ''
            . $_templates->header()
            . $_templates->slideMenu()
            . $_templates->body()
            . $_components->hGridRow($gridRow_btn, 'btnNav')
            . $_components->tableFromQuery('report/report_homepage', 'table_ing_oggi', 'tbContainer', 'Ingressi Autorizzati Oggi')
            . $_components->javaScriptFromFile('slidemenu')
            . $_components->javaScript('$(document).ready(function() {$("#table_ing_oggi").DataTable()})')
            . $_templates->footer($footer_objs);

        return $page;
    }


    public function lista_utenti($pnum)
    {
        $_components = new Component();
        $_templates = new Template();

        $gridRow_btn = [
            $_components->button("Nuovo Utente", "Primary", "7")
        ];

        $footer_objs = [
            // generazione Menu (codice in variabile pubblica di classe)
            $_components->javaScript($this->menuJs),
            // colorazione menu attivo
            $_components->javaScript('$("#m-p' . $pnum . '").addClass("active")')
        ];

        $page = ''
            . $_templates->header()
            . $_templates->slideMenu()
            . $_templates->body()
            . $_components->hGridRow($gridRow_btn, 'btnNav')
            . $_components->tableFromQuery('report/report_utenti', 'table_utenti', 'tbContainer', 'Lista Utenti')
            . $_components->javaScriptFromFile('slidemenu')
            . $_components->javaScript('$(document).ready(function() {$("#table_utenti").DataTable()})')
            . $_templates->footer($footer_objs);

        return $page;
    }


    public function lista_incassi($pnum)
    {
        $_components = new Component();
        $_templates = new Template();

        $gridRow_btn = [
            $_components->button("Nuovo Incasso", "Primary", "2")
        ];

        $footer_objs = [
            // generazione Menu (codice in variabile pubblica di classe)
            $_components->javaScript($this->menuJs),
            // colorazione menu attivo
            $_components->javaScript('$("#m-p' . $pnum . '").addClass("active")')
        ];

        $page = ''
            . $_templates->header()
            . $_templates->slideMenu()
            . $_templates->body()
            . $_components->hGridRow($gridRow_btn, 'btnNav')
            . $_components->tableFromQuery('report/report_completo', 'table_incassi', 'tbContainer', 'Lista Ingressi')
            . $_components->javaScriptFromFile('slidemenu')
            . $_components->javaScript('$(document).ready(function() {$("#table_incassi").DataTable()})')
            . $_templates->footer($footer_objs);

        return $page;
    }
}
