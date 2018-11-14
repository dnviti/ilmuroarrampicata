<?php


    // Requires
require_once("php/config/config.php");

$GLOBALS["paths"] = $_config["paths"];

$_paths = $GLOBALS["paths"];

require_once($_paths["configs"] . "connection.php");

// Require classes
require_once($_paths["classes"] . "query.php");
require_once($_paths["classes"] . "user.php");
require_once($_paths["classes"] . "ingresso.php");
require_once($_paths["classes"] . "asset.php");
require_once($_paths["classes"] . "components.php");


// require views
require_once($_paths["views"] . "template.php");
require_once($_paths["views"] . "page.php");
