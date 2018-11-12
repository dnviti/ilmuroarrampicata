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
            //. $_components->hGridRow(logo('logo.jpg')
            . $_components->htmlFromFile('login')
            . $_components->javaScriptFromFile('login')
            . $_templates->footer();

        return $page;
    }

    public function register($pnum)
    {
        $_components = new Component();
        $_templates = new Template();

        $gridForm_btn = [
            $_components->button('Crea Utente', 'primary', '', '', 'btn-register')
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
                    $_components->itemFromColumn('users', 'password', 'password'),
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('users', 'email', 'email'),
                    $_components->selectFromQuery('lov_ruoli', 'id_role'),
                ]),
                $_components->hGridRow([
                    $_components->itemFromColumn('users', 'note', 'textarea')
                ]),
            ], 'f_register_items'),
            $_components->hGridRow($gridForm_btn)
        ];

        $page = ''
            . $_templates->header()
            . $_templates->slideMenu()
            . $_templates->body()
            . $_components->form($form_items, 'f-register')
            . $_components->javaScriptFromFile('register')
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
            . $_components->tableFromQuery('query_report_homepage_where', 'table_ing_oggi', 'tbContainer', 'Ingressi Autorizzati Oggi')
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
            . $_components->tableFromQuery('query_anagrafica_utenti', 'table_utenti', 'tbContainer', 'Lista Utenti')
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
            . $_components->tableFromQuery('query_report_completo', 'table_incassi', 'tbContainer', 'Lista Incassi')
            . $_components->javaScriptFromFile('slidemenu')
            . $_components->javaScript('$(document).ready(function() {$("#table_incassi").DataTable()})')
            . $_templates->footer($footer_objs);

        return $page;
    }
}
