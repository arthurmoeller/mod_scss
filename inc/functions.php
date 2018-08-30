<?php

// variables
$modpath = $phpwcms['modules']['scss']['path'];

// files
$errorLogFile = $modpath.'inc/error.log';

// include scss compiler
include_once($modpath.'inc/scssphp/scss.inc.php');	
use Leafo\ScssPhp\Compiler;
$scss = new Compiler();

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
    } catch (\Exception $e) {

        // write exception to log file
        $inputFileName = trim(substr($inputFile, strrpos($inputFile, '/') + 1)); // trim directory
        $errorMessage = 'SCSS error in file: '.$inputFileName;
        echo '<script>console.error("'.$errorMessage.'");</script>';
        file_put_contents($errorLogFile, $errorMessage);
    }
}