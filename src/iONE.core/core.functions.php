<?php
/*
// iON.Engine Functions
// V1.1
//
*/

// Constants
define('CORE_EXTENTIONS', 'extentions/');
define('WEBSITE_CORE', $_SERVER['DOCUMENT_ROOT'].WEBSITE.'app.core/');

/*
// Extentions
*/

require_once CORE_EXTENTIONS.'file_output.php'; // File output
require_once CORE_EXTENTIONS.'extras.php'; // Extra/uncategorized

// Website specific Extentions
require_once WEBSITE_CORE.'functions.php';