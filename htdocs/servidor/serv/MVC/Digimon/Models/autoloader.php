<?php
spl_autoload_register(function ($clase) {
    include_once 'Models/Class/' . $clase . '.php';
});