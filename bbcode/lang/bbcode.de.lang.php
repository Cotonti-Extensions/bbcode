<?php
/**
 * German Language File for BBcode management
 *
 * @package bbcode
 * @version 0.7.0
 * @author Cotonti Translators Team
 * @copyright Copyright (c) Cotonti Team 2008-2011
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

$L['adm_bbcode'] = 'BB-Code';
$L['adm_bbcodes'] = 'BB-Codes';
$L['adm_bbcodes_added'] = 'Neuer BB-Code erfolgreich hinzugefügt.';
$L['adm_bbcodes_clearcache'] = 'HTML-Cache leeren';
$L['adm_bbcodes_clearcache_confirm'] = 'Dies wird den Cache für alle Seiten und Beiträge leeren, fortfahren?';
$L['adm_bbcodes_clearcache_done'] = 'HTML-Cache wurde geleert.';
$L['adm_bbcodes_confirm'] = 'Soll dieser BB-Code wirklich gelöscht werden?';
$L['adm_bbcodes_container'] = 'Container';
$L['adm_bbcodes_convert_comments'] = 'Kommentare in HTML umwandeln';
$L['adm_bbcodes_convert_complete'] = 'Umwandlung komplett';
$L['adm_bbcodes_convert_confirm'] = 'Bist du sicher? Dies kann nicht rückgängig gemacht werden! Wenn du dir nicht sicher bist, erstelle zuerst ein Datenbankbackup.';
$L['adm_bbcodes_convert_forums'] = 'Foren in HTML umwandeln';
$L['adm_bbcodes_convert_page'] = 'Seiten in HTML umwandeln';
$L['adm_bbcodes_convert_pm'] = 'Privatnachrichten in HTML umwandeln';
$L['adm_bbcodes_convert_users'] = 'Benutzersignaturen in HTML umwandeln';
$L['adm_bbcodes_mode'] = 'Modus';
$L['adm_bbcodes_new'] = 'Neuer BB-Code';
$L['adm_bbcodes_other'] = 'Andere Aktionen';
$L['adm_bbcodes_pattern'] = 'Muster';
$L['adm_bbcodes_postrender'] = 'Post-render';
$L['adm_bbcodes_priority'] = 'Priorität';
$L['adm_bbcodes_removed'] = 'BB-Code erfolgreich entfernt.';
$L['adm_bbcodes_replacement'] = 'Ersetzung';
$L['adm_bbcodes_updated'] = 'BB-Code erfolgreich aktualisiert.';
$L['adm_help_bbcodes'] = <<<HTM
<ul>
<li><strong>Name</strong> - BBcode-Name (nur alphanumerische Zeichen und Unterstriche benutzen)</li>
<li><strong>Modus</strong> - einer der folgenden Parsing-Modi: 'str' (str_replace), 'pcre' (preg_replace) und 'callback' (preg_replace_callback)</li>
<li><strong>Muster</strong> - BBcode-Zeichenkette oder vollständiger regulärer Ausdruck</li>
<li><strong>Ersetzung</strong> - Ersetzungs-Zeichenkette, reguläre Ersetzung oder Callback-Body</li>
<li><strong>Container</strong> - Ist der Bbcode ein Container (z. B. [bbcode]irgendwas[/bbcode])</li>
<li><strong>Priorität</strong> - BBcode-Priorität von 0 bis 25. Niedrigere Prioritäten werden zuerst geparst, 128 ist Standard für mittlere Priorität.</li>
<li><strong>Plugin</strong> - Plugin/Komponentenname, zu welchem der BBCode gehört. Leer lassen, dies ist nur für Plugins notwendig.</li>
<li><strong>Post-render</strong> - Gibt an, ob dieser BBCode auf einen zuvor erstellten HTML-Cache angewandt werden muss. Benutze dies nur, falls dein Callback per-Request-Berechnungen benötigt.</li>
</ul>
HTM;

$L['cfg_smilies'] = array('Smilys einschalten', '');

$L['info_desc'] = 'Ermöglicht Parsen von BB-Codes. Administratoren können BB-Codes mit einem Adminwerkzeug anpassen. Smilies werden ebenso unterstützt.';

?>
