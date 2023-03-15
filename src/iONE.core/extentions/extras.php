<?php // Extra, uncategorized functions

/**
 * Title/Tab bar text output based on current page
 * 
 * @return String the title of the page
 */
function get_page_title() {
    // Grab current page name based on file name
    $current_page = basename($_SERVER['PHP_SELF'], '.php');

    if ($current_page == 'index') {
        return APP_NAME;
    } else {
        return APP_NAME_SHORT.' - '.ucwords($current_page);
    }
}

// Output something to a webpage for debug purposes
function core_print($args) {
    echo '<pre>'.print_r($args).'</pre>';
}

// Lazy href linking, just need name of page, extentions added automatically
function core_link($args) {
    echo WEBSITE.$args.'.php';
}