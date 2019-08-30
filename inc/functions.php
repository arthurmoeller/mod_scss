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

// include css autoprefixer
require_once($modpath.'inc/autoprefixer.inc.php');
use Padaliyajay\PHPAutoprefixer\Autoprefixer;

// compile scss file to css file
function compileFile($inputFile, $outputFile, $formatter) {

    global $scss;
    global $errorLogFile;
    global $prefixed_css;
    global $autoprefixer;

    $scss->setFormatter('Leafo\ScssPhp\Formatter\\' . $formatter);

    try {

        // read input file
        $css = file_get_contents($inputFile);
        $compiledCss = $scss->compile($css);

        // autoprefix css
        // $compiledCss = prefixCSS($compiledCss, $formatter);

        // write output file
        file_put_contents($outputFile, $compiledCss);
        file_put_contents($errorLogFile, '');

        // log success info
        $fileName = str_replace(PHPWCMS_TEMPLATE.'inc_scss/','', $inputFile);
        $GLOBALS['block']['custom_htmlhead']['mod-scss_log'] = '<script>console.info("'.$fileName.' compiled");</script>';
    }
    catch (\Exception $e) {

        // write exception to log file
        $inputFileName = trim(substr($inputFile, strrpos($inputFile, '/') + 1)); // trim directory
        $errorMessage = $inputFileName.' '.$e->getMessage();
        $GLOBALS['block']['custom_htmlhead']['mod-scss_log'] = '<script>console.error("'.$errorMessage.'");</script>';

        file_put_contents($errorLogFile, $errorMessage);
    }
}

class Autoprefixer2 extends Autoprefixer 
{
    private $css_parser;

    public function __construct($css_code){
        $this->css_parser = new \Sabberworm\CSS\Parser($css_code);
    }

    public function compile($css_format){

        if($this->css_parser){
            $css_document = $this->css_parser->parse();

            $this->compileCSSList($css_document);

            if($css_format == 'Crunched') {
                return $css_document->render(\Sabberworm\CSS\OutputFormat::createCompact());
            }
            else {
                return $css_document->render(\Sabberworm\CSS\OutputFormat::createPretty());
            }
        } else {
            return false;
        }
    }
}

function prefixCSS($css, $css_format) {
    $prefixer = new Autoprefixer2($css);
    $prefixed_css = $prefixer->compile($css_format);
    return $prefixed_css;
}