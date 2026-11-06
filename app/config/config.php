<?php
declare(strict_types=1);

define("BASEURL","http://localhost:3000");

define("DB_HOST", getenv("DB_HOST") ?: "localhost");
define("DB_PORT", getenv("DB_PORT") ?: "5432");
define("DB_USER", getenv("DB_USER") ?: "postgres");
define("DB_PASS", getenv("DB_PASS") ?: "root");
define("DB_NAME", getenv("DB_NAME") ?: "phpmvc");

