<?php

class Asset
{
    function getCss($paths)
    {
        foreach ($paths as &$value) {
            echo '<link rel="stylesheet" href="' . $value . '">';
        }
    }
    function getJs($paths)
    {
        foreach ($paths as &$value) {
            echo '<script type="text/javascript" src="' . $value . '"></script>';
        }
    }
}
?>