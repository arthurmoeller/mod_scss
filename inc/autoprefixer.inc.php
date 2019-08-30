<?php

// Common
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Renderable.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Settings.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/OutputFormat.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Parser.php';

// Value
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/Value.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/ValueList.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/CSSFunction.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/CalcFunction.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/RuleValueList.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/CalcRuleValueList.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/PrimitiveValue.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/CSSString.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/LineName.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/Color.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/Size.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Value/URL.php';

// Comment
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Comment/Commentable.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Comment/Comment.php';

// Rule
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Rule/Rule.php';

// Property
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Property/Selector.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Property/AtRule.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Property/Charset.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Property/CSSNamespace.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Property/Import.php';

// RuleSet
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/RuleSet/RuleSet.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/RuleSet/AtRuleSet.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/RuleSet/DeclarationBlock.php';

// CSSList
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/CSSList/CSSList.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/CSSList/KeyFrame.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/CSSList/CSSBlockList.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/CSSList/AtRuleBlockList.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/CSSList/Document.php';

// Parsing
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Parsing/SourceException.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Parsing/OutputException.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Parsing/UnexpectedTokenException.php';
require_once $modpath.'inc/PHP-CSS-Parser/lib/Sabberworm/CSS/Parsing/ParserState.php';

// Files of PHP autoprefixer
require_once $modpath.'inc/php-autoprefixer/src/Autoprefixer.php';

require_once $modpath.'inc/php-autoprefixer/src/Vendor.php';
require_once $modpath.'inc/php-autoprefixer/src/Vendor/Vendor.php';
require_once $modpath.'inc/php-autoprefixer/src/Vendor/IE.php';
require_once $modpath.'inc/php-autoprefixer/src/Vendor/Mozilla.php';
require_once $modpath.'inc/php-autoprefixer/src/Vendor/Webkit.php';

require_once $modpath.'inc/php-autoprefixer/src/Parse/Property.php';
require_once $modpath.'inc/php-autoprefixer/src/Parse/Rule.php';
require_once $modpath.'inc/php-autoprefixer/src/Parse/Selector.php';
require_once $modpath.'inc/php-autoprefixer/src/Compile/AtRule.php';
require_once $modpath.'inc/php-autoprefixer/src/Compile/RuleSet.php';
require_once $modpath.'inc/php-autoprefixer/src/Compile/DeclarationBlock.php';