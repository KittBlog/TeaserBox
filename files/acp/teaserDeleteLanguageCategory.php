<?php
/**
 * Removes wrong language category
 *
 * @author			Matthias Kittsteiner
 * @copyright		2012 Matthias Kittsteiner
 * @license			LGPL
 * @package			de.kittblog.wcf.teaserbox
 */

// get languageCategoryID
$sql = "SELECT languageCategoryID
	FROM	wcf".WCF_N."_language_category
	WHERE	languageCategory = 'wcf.acp.group.option'";
$row = WCF::getDB()->getFirstRow($sql);

// delete all wrong language items
$sql = "DELETE	FROM wcf".WCF_N."_language_item
	WHERE	languageCategoryID = ".$row['languageCategoryID'];
WCF::getDB()->sendQuery($sql);

// delete wrong language category
$sql = "DELETE	FROM wcf".WCF_N."_language_category
	WHERE	languageCategoryID = ".$row['languageCategoryID'];
WCF::getDB()->sendUnbufferedQuery($sql);

// clear cache
require_once(WCF_DIR.'lib/system/language/Language.class.php');
Language::clearCache();

require_once(WCF_DIR.'lib/system/language/LanguageEditor.class.php');
LanguageEditor::deleteLanguageFiles();
?>