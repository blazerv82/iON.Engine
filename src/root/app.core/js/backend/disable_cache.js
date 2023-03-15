const disableCache = () => {

    // Disable caching of AJAX responses
    // Useful for actually seeing code updates within BricksNBlocks
    $.ajaxSetup ({        
        cache: false
    });

}