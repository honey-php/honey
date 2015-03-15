<?php

$aliases = require CONFIG_PATH . '/aliases.php';

foreach ($aliases as $class => $alias) {
    class_alias($class, $alias);
}