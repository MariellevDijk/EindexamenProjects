<?php
if (isset($_GET["content"])) {
    include($_GET["content"] . ".php");
    include("head.php");
} else {
    include("algemeneHomepage.php");
}
?>