<?php // File output functions

/**
 * Loads a custom script into webpage, usually JS/CSS
 * Finds file via name of page, or a custom one if provided
 * Args are passed via an array
 * 
 * @param args Any number of params to pass, see below for currently used
 * @param script_type The type of script to load
 * @param file_name The name of the file
 * @param file_location The location/folder of the file
 * 
 * @return String the complete file path to script
 */

function get_script($args) {

    // Grab current page name based on file name
    $page = basename($_SERVER['PHP_SELF'], '.php');

    $type = $args['script_type'] ?? null;
    $name = $args['file_name'] ?: $page;
    $location = $args['file_location'] ?? WEBSITE.'app.core';
    
    try {

        switch ($type) {
            case 'js':
                echo '<script type="text/javascript" src="'
                        .$location
                        .'/'
                        .$type
                        .'/'
                        .$name.
                        '.'
                        .$type
                        .'"></script>';
                break;
            case 'css':
                echo '<link rel="stylesheet" href="'
                        .$location
                        .'/'
                        .$type
                        .'/'
                        .$name
                        .'.'
                        .$type
                        .'">';
                break;
            default:
                throw new Exception('No matching script type found! Check Type, Name, and Location!');
                break;
        }

    } catch (Exception $e) {
        return display_error_message($e, 'Error getting file!');
    }
    
}

 /**
  *  Static file output
  *  Looks for a file with a given name based on current page name 
  *  and then outputs content of file to page
  *  
  *  @param String $tile The name of the file to look for
  *  @param String $file_location Override to look in different location for the file
  *  @param String $filetype Override to use a different file extention (rather than HTML)
  *  
  *  @return File The content of the file
  */
function get_tile($tile, $file_location = null, $file_type = null) {
    
    // Grab current page name based on file name
    $current_page = basename($_SERVER['PHP_SELF'], '.php');

    // If there's no custom path, use the default based on the page name
    if (!$file_location) { $file_location = 'app.tile/'.$current_page; }

    // If no file type is specified, used default
    if (!$file_type) { $file_type = '.html'; }
    
    try {
        
        $file_to_return = require($file_location.'/'.$tile.$file_type);
        return $file_to_return;

    } catch (Exception $e) {
        return display_error_message($e, 'Error getting file!');
    }
}

 /**
  *  File output that fowards custom content
  *  Looks for a file with a given name based on current page name 
  *  and then outputs content of file to page
  *  
  *  @param String $tile The name of the file to look for
  *  @param String $file_location Override to look in different location for the file
  *  @param String $filetype Override to use a different file extention (rather than HTML)
  *  @param Mixed $content The content to send along to the file. Text or otherwise
  *  
  *  @return Array The contents of the file, and the content to pass along
  */
  function get_tile_custom($tile, $file_location = null, $file_type = null, $content = null) {
    
    // Grab current page name based on file name
    $current_page = basename($_SERVER['PHP_SELF'], '.php');

    // If there's no custom path, use the default based on the page name
    if (!$file_location) { $file_location = 'app.tile/'.$current_page; }
    if (!$file_type) { $file_type = '.html'; }

    try {
        $file_to_return = require($file_location.'/'.$tile.$file_type);
        return [$file_to_return, $content];
    } catch (Exception $e) {
        return display_error_message($e, 'Error getting file / passing custom content!');
    }
}



// Allows for custom error messages in try/catch even if something is a warning
set_error_handler('exceptions_error_handler');
function exceptions_error_handler($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

// Outputs custom error message box along with custom message and actual PHP error
function display_error_message($exception, $message) {
    echo '<div class="theme-warning round-medium my-large px-large py-large">';
    echo '<span class="t-upper">'.$message.'</span><br/>'.$exception->getMessage().'</div>';
}