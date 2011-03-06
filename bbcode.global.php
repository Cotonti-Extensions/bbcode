<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=global
[END_COT_EXT]
==================== */

/**
 * Connects BBcode parser, loads data and registers parser function
 *
 * @package bbcode
 * @version 0.7.0
 * @author Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2011
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('bbcode', 'plug');

cot_bbcode_load();
if ($cfg['plugin']['bbcode']['smilies'])
{
	cot_smilies_load();
}

$cot_parsers[] = 'cot_bbcode_parse';

?>