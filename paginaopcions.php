<?php

if (isset($_REQUEST["destruirS"])) {
                session_destroy();
                header('Location: login.html');
            }
?>
