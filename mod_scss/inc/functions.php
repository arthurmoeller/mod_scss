<?php

// variables
$modpath = $phpwcms['modules']['scss']['path'];

// files
$errorLogFile = $modpath.'inc/error.log';

// include scss compiler
include_once($modpath.'inc/scssphp/scss.inc.php');
use Leafo\ScssPhp\Compiler;
$scss = new Compiler();
$scss->setImportPaths(PHPWCMS_TEMPLATE.'inc_scss/');

// compile scss file to css file
function compileFile($inputFile, $outputFile, $formatter) {

    global $scss;
    global $errorLogFile;

    $scss->setFormatter('Leafo\ScssPhp\Formatter\\' . $formatter);

    try {

        // read input file
        $css = file_get_contents($inputFile);
        $compiledCss = $scss->compile($css);

        // write output file
        file_put_contents($outputFile, $compiledCss);
        file_put_contents($errorLogFile, '');

        // log success info
        $fileName = str_replace(PHPWCMS_TEMPLATE.'inc_scss/','', $inputFile);
        $GLOBALS['block']['custom_htmlhead']['mod-scss_log'] .= '<script>console.info("'.$fileName.' compiled");</script>';
    }
    catch (\Exception $e) {

        // write exception to log file
        $inputFileName = trim(substr($inputFile, strrpos($inputFile, '/') + 1)); // trim directory
        $errorMessage = $inputFileName.' '.$e->getMessage();
        $GLOBALS['block']['custom_htmlhead']['mod-scss_log'] .= '<script>console.error("'.$errorMessage.'");</script>';

        file_put_contents($errorLogFile, $errorMessage);
    }
}