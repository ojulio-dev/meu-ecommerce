<?php
require_once(BASE_PATH . '/config/environment.php');

if (ENVIRONMENT === 'development') {
  define('DB_HOST', 'localhost');
  define('DB_PORT', '3306');
  define('DB_NAME', 'db_ecommerce');
  define('DB_USER', 'root');
  define('DB_PASS', '');
} else {
  define('DB_HOST', 'localhost');
  define('DB_PORT', '3306');
  define('DB_NAME', '');
  define('DB_USER', '');
  define('DB_PASS', '>BB[');
}
