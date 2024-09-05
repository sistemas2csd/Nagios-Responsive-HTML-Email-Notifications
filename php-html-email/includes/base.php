<?php

/**
 * Get configuration from config file.
 *
 * @param String $section The section name to recover configuration property.
 * @return type The configuration property value.
 **/
function getConfig($section, $property) {
    $config_file = __DIR__ . '/../config.cfg';
    if (!$settings = parse_ini_file($config_file, TRUE)) {
        echo "Error: cannot open configuration file.<br>";
        die();
    } else {
        $config = $settings[$section][$property];
    }
    return $config;
}

/* Arguments from Config File config.cfg */
$f_wordwrap = getConfig('mail', 'wordwrap');
$f_language = getConfig('general', 'language');
$f_company_email = getConfig('general', 'company_email');
$f_company_name = getConfig('general', 'company_name');

/* Load translations */
$lang = $f_language ?? 'en';
if (!file_exists(__DIR__ . '/../locale/' . $lang . '.php')) {
    $lang = 'en';
}
$translations = require __DIR__ . '/../locale/' . $lang . '.php';

/* Set locale */
$locale = match ($lang) {
  'en' => 'en_US',
  'es' => 'es_ES',
  default => 'en_US',
};
setlocale(LC_ALL, $locale);

?>