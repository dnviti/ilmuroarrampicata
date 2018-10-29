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

    function getPage($pnum)
    {
        switch ($pnum) {
            case 7:
                echo $this->register($pnum);
                break;
            case 1:
                echo $this->home($pnum);
                break;
        }
    }

    function login()
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
            . $_components->logo('logo.jpg')
            . $_components->htmlFromFile('login')
            . $_components->javaScriptFromFile('login')
            . $_templates->footer();

        return $page;
    }

    function register($pnum)
    {
        $_components = new Component();
        $_templates = new Template();

        $gridRow_items = [
            $_components->itemFromColumn('users', 'username', 'text', 'Nome Utente'),
            $_components->itemFromColumn('users', 'password', 'password', 'Password'),
            $_components->itemFromColumn('users', 'email', 'email', 'E-Mail')
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
            . $_components->vGridRow($gridRow_items, 'itemsForm')
            . $_components->javaScriptFromFile('slidemenu')
            . $_templates->footer($footer_objs);

        return $page;
    }

    function home($pnum)
    {
        $_components = new Component();
        $_templates = new Template();

        $gridRow_btn = [
            $_components->buttonPrimary("Nuovo Incasso"),
            $_components->buttonSecondary("Lista Abbonati")
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
            . $_components->tableFromQuery('query_report_homepage', 'tbAbbon', 'Ultimi Incassi')
            . $_components->javaScriptFromFile('slidemenu')
            . $_templates->footer($footer_objs);

        return $page;
    }
}

?>