<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */

/**
 * BBcode management interface
 *
 * @package bbcode
 * @version 0.7.0
 * @author Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2011
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('bbcode', 'plug');

$bb_t = new XTemplate(cot_tplfile('bbcode.admin', 'plug'));

$plugin_title = $L['adm_bbcodes'];
$adminhelp = $L['adm_help_bbcodes'];

$a = cot_import('a', 'G', 'ALP');
$id = (int) cot_import('id', 'G', 'INT');
list($pg, $d) = cot_import_pagenav('d', $cfg['maxrowsperpage']);

/* === Hook === */
foreach (cot_getextplugins('bbcode.admin.first') as $pl)
{
	include $pl;
}
/* ===== */

if ($a == 'add')
{
	$bbc['name'] = cot_import('bbc_name', 'P', 'ALP');
	$bbc['mode'] = cot_import('bbc_mode', 'P', 'ALP');
	$bbc['pattern'] = cot_import('bbc_pattern', 'P', 'HTM');
	$bbc['priority'] = cot_import('bbc_priority', 'P', 'INT');
	$bbc['container'] = cot_import('bbc_container', 'P', 'BOL');
	$bbc['replacement'] = cot_import('bbc_replacement', 'P', 'HTM');
	$bbc['postrender'] = cot_import('bbc_postrender', 'P', 'BOL');
	if (!empty($bbc['name']) && !empty($bbc['pattern']) && !empty($bbc['replacement']))
	{
		cot_bbcode_clearcache();
		cot_bbcode_add($bbc['name'], $bbc['mode'], $bbc['pattern'], $bbc['replacement'], $bbc['container'], $bbc['priority'], '', $bbc['postrender'])
				? cot_message('adm_bbcodes_added') : cot_message('Error');
	}
	else
	{
		cot_message('Error');
	}
}
elseif ($a == 'upd' && $id > 0)
{
	$bbc['name'] = cot_import('bbc_name', 'P', 'ALP');
	$bbc['mode'] = cot_import('bbc_mode', 'P', 'ALP');
	$bbc['pattern'] = cot_import('bbc_pattern', 'P', 'HTM');
	$bbc['priority'] = cot_import('bbc_priority', 'P', 'INT');
	$bbc['container'] = cot_import('bbc_container', 'P', 'BOL');
	$bbc['replacement'] = cot_import('bbc_replacement', 'P', 'HTM');
	$bbc['postrender'] = cot_import('bbc_postrender', 'P', 'BOL');
	$bbc['enabled'] = cot_import('bbc_enabled', 'P', 'BOL');
	if(!empty($bbc['name']) && !empty($bbc['pattern']) && !empty($bbc['replacement']))
	{
		cot_bbcode_clearcache();
		cot_bbcode_update($id, $bbc['enabled'], $bbc['name'], $bbc['mode'], $bbc['pattern'], $bbc['replacement'], $bbc['container'], $bbc['priority'], $bbc['postrender'])
			? cot_message('adm_bbcodes_updated') : cot_message('Error');
	}
	else
	{
		cot_message('Error');
	}
}
elseif ($a == 'del' && $id > 0)
{
	cot_bbcode_clearcache();
	cot_bbcode_remove($id) ? cot_message('adm_bbcodes_removed') : cot_message('Error');
}
elseif ($a == 'clearcache')
{
	cot_bbcode_clearcache();
	cot_message('adm_bbcodes_clearcache_done');
}

$totalitems = $db->countRows($db_bbcode);

// FIXME AJAX-based pagination doesn't work because of some strange PHP bug
// Xtpl_block->text() returns 'str' instead of a long string which it has in $text
//$pagenav = cot_pagenav('admin', 'm=bbcode', $d, $totalitems, $cfg['maxrowsperpage'], 'd', '', $cfg['jquery'] && $cfg['turnajax']);
$pagenav = cot_pagenav('admin', 'm=bbcode', $d, $totalitems, $cfg['maxrowsperpage'], 'd');

$bbc_modes = array('str', 'pcre', 'callback');
$res = $db->query("SELECT * FROM $db_bbcode ORDER BY bbc_priority LIMIT $d, ".$cfg['maxrowsperpage']);



$ii = 0;
/* === Hook - Part1 : Set === */
$extp = cot_getextplugins('bbcode.admin.loop');
/* ===== */
foreach ($res->fetchAll() as $row)
{

	$bb_t->assign(array(
		'ADMIN_BBCODE_ROW_NAME' => cot_inputbox('text', 'bbc_name', $row['bbc_name']),
		'ADMIN_BBCODE_ROW_ENABLED' => cot_checkbox($row['bbc_enabled'], 'bbc_enabled'),
		'ADMIN_BBCODE_ROW_CONTAINER' => cot_checkbox($row['bbc_container'], 'bbc_container'),
		'ADMIN_BBCODE_ROW_PATTERN' => cot_textarea('bbc_pattern', $row['bbc_pattern'], 2, 20),
		'ADMIN_BBCODE_ROW_REPLACEMENT' => cot_textarea('bbc_replacement', $row['bbc_replacement'], 2, 20),
		'ADMIN_BBCODE_ROW_PLUG' => $row['bbc_plug'],
		'ADMIN_BBCODE_ROW_MODE' => cot_selectbox($row['bbc_mode'], 'bbc_mode', $bbc_modes, $bbc_modes, false),
		'ADMIN_BBCODE_ROW_PRIO' => cot_selectbox($row['bbc_priority'], 'bbc_priority', range(1, 256), range(1, 256), false),
		'ADMIN_BBCODE_ROW_POSTRENDER' => cot_checkbox($row['bbc_postrender'], 'bbc_postrender'),
		'ADMIN_BBCODE_ROW_UPDATE_URL' => cot_url('admin', 'm=bbcode&a=upd&id='.$row['bbc_id'].'&d='.$d),
		'ADMIN_BBCODE_ROW_DELETE_URL' => cot_url('admin', 'm=bbcode&a=del&id='.$row['bbc_id']),
		'ADMIN_BBCODE_ROW_ODDEVEN' => cot_build_oddeven($ii)
	));

	/* === Hook - Part2 : Include === */
	foreach ($extp as $pl)
	{
		include $pl;
	}
	/* ===== */

	$bb_t->parse('MAIN.ADMIN_BBCODE_ROW');
	$ii++;
}
$res->closeCursor();

$bb_t->assign(array(
	'ADMIN_BBCODE_PAGINATION_PREV' => $pagenav['prev'],
	'ADMIN_BBCODE_PAGNAV' => $pagenav['main'],
	'ADMIN_BBCODE_PAGINATION_NEXT' => $pagenav['next'],
	'ADMIN_BBCODE_TOTALITEMS' => $totalitems,
	'ADMIN_BBCODE_COUNTER_ROW' => $ii,
	'ADMIN_BBCODE_FORM_ACTION' => cot_url('admin', 'm=bbcode&a=add'),
	'ADMIN_BBCODE_NAME' => cot_inputbox('text', 'bbc_name', ''),
	'ADMIN_BBCODE_ENABLED' => cot_checkbox('', 'bbc_enabled'),
	'ADMIN_BBCODE_CONTAINER' => cot_checkbox(1, 'bbc_container'),
	'ADMIN_BBCODE_PATTERN' => cot_textarea('bbc_pattern', '', 2, 20),
	'ADMIN_BBCODE_REPLACEMENT' => cot_textarea('bbc_replacement', '', 2, 20),
	'ADMIN_BBCODE_MODE' => cot_selectbox('pcre', 'bbc_mode', $bbc_modes, $bbc_modes, false),
	'ADMIN_BBCODE_PRIO' => cot_selectbox('128', 'bbc_priority', range(1, 256), range(1, 256), false),
	'ADMIN_BBCODE_POSTRENDER' => cot_checkbox('0', 'bbc_postrender'),
	'ADMIN_BBCODE_URL_CLEAR_CACHE' => cot_url('admin', 'm=bbcode&a=clearcache&d='.$d)
));

cot_display_messages($bb_t);

/* === Hook  === */
foreach (cot_getextplugins('bbcode.admin.tags') as $pl)
{
	include $pl;
}
/* ===== */
$bb_t->parse('MAIN');
$plugin_body = $bb_t->text('MAIN');

?>
