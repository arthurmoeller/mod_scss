<?php
// (c) 2018 Arthur Möller
//
// ----------------------------------------------------------------
// obligate check for phpwcms constants
if (!defined('PHPWCMS_ROOT')) {
    die("You Cannot Access This Script Directly, Have a Nice Day.");
}
// ----------------------------------------------------------------

// variables
$modpath = $phpwcms['modules']['scss']['path'];

// check if compiler is activated
$settings = json_decode(file_get_contents($modpath.'inc/settings.json'), true);
if (isset($settings['activate'])) {

    // include functions
    include_once($modpath.'inc/functions.php');

    // get groups from json file and compile scss files to css
    $groups = json_decode(file_get_contents($modpath.'inc/groups.json'), true);
    if(isset($groups)) {
        foreach ($groups as $group) {
            if (!empty($group['input']) && !empty($group['output'])) {
                $inputFile = PHPWCMS_TEMPLATE.'inc_scss/'.$group['input'].'.scss';

                // minify if set
                if (isset($group['minify'])) {
                    $formatter = 'Crunched';
                    $outputFile = PHPWCMS_TEMPLATE.'inc_css/'.$group['output'].'.min.css';
                }
                else {
                    $formatter = 'Nested';
                    $outputFile = PHPWCMS_TEMPLATE.'inc_css/'.$group['output'].'.css';
                }

                compileFile($inputFile, $outputFile, $formatter);
            }
        }
    }

    // auto disable compiler when current timestamp exceeds timestamp in settings
    if (isset($settings['disable'])) {
        if (isset($settings['timestamp'])) {
            if(time() > $settings['timestamp']) {
                unset($settings['activate']);
                file_put_contents($modpath.'inc/settings.json',json_encode($settings));
                rename ($modpath."frontend.init.php", $modpath."_frontend.init.php_");
            }
        }
    }
}
?>