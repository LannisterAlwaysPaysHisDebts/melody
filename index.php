<?php

require 'melody/App.php';
$config = __DIR__ . '/app/config.php';
(new Melody\App())->run($config);