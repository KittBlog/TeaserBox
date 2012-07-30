<?php
// wcf imports
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * Displays the teaser box
 *
 * @package	com.alexanderzwei.wbb.teaserbox
 * @author	Alexander 'alexanderzwei' Pankow
 * @copyright	2009 Alexander Pankow
 * @license	LGPL <http://www.gnu.org/licenses/lgpl.html>
 * @subpackage	system.event.listener
 * @category	Community Framework
 */
class TeaserBoxIndexPageListener implements EventListener {
	/**
	 * box data
	 *
	 * @var array<mixed>
	 */
	public $teaserBoxData = array();

	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
	
		if (!in_array(PACKAGE_ID, explode(',', TEASERBOX_ACTIVE))) {
			return;
		}

		for ($i = 1; $i <= 20; $i++) {
			if (constant('TEASERBOX_TEASER' . $i . '_ACTIVE') == false)
				continue;

			$this->teaserBoxData[] = array(
			    'link' => constant('TEASERBOX_TEASER' . $i . '_LINK'),
			    'title' => constant('TEASERBOX_TEASER' . $i . '_TITLE'),
			    'image' => constant('TEASERBOX_TEASER' . $i . '_IMAGE'),
			    'align' => constant('TEASERBOX_TEASER' . $i . '_ALIGN'),
			    'bgcolor' => constant('TEASERBOX_TEASER' . $i . '_BGCOLOR')
			);
		}

		if (!count($this->teaserBoxData))
			return;

		WCF::getTPL()->assign(array(
		    'teaserBoxData' => $this->teaserBoxData
		));

		// CSS
		if (!TEASERBOX_NAV_FONTSHADOWCOLOR) {
			$fontShadowColor = "";
		}
		else {
			$fontShadowColor = 'text-shadow: 0 2px 3px ' . TEASERBOX_NAV_FONTSHADOWCOLOR;
		}
		if (!TEASERBOX_ACTIVENAV_FONTSHADOWCOLOR) {
			$activeFontShadowColor = "";
		}
		else {
			$activeFontShadowColor = 'text-shadow: 0 2px 3px ' . TEASERBOX_ACTIVENAV_FONTSHADOWCOLOR;
		}
		if (!TEASERBOX_NAV_BGCOLOR) {
			$bgColor = 'transparent';
		}
		else {
			$bgColor = TEASERBOX_NAV_BGCOLOR;
		}
		if (!TEASERBOX_ACTIVENAV_BGCOLOR) {
			$activeBgColor = 'transparent';
		}
		else {
			$activeBgColor = TEASERBOX_ACTIVENAV_BGCOLOR;
		}

		WCF::getTPL()->append('specialStyles',
			'<link type="text/css" rel="stylesheet" href="' . RELATIVE_WCF_DIR . 'style/teaserBox.css" />' .
			'<style type="text/css">
			<!--
			.teaserBoxContent, ul.teaserBoxTeaser li a {
				height: ' . TEASERBOX_HEIGHT . 'px;
			}
			ul.teaserBoxNavigation li a span {
				color: ' . TEASERBOX_NAV_FONTCOLOR . ';
				' . $fontShadowColor . ';
			}
			ul.teaserBoxNavigation li.activeTeaser a span {
				color: ' . TEASERBOX_ACTIVENAV_FONTCOLOR . ';
				' . $activeFontShadowColor . ';
			}
			ul.teaserBoxNavigation li.teaserNav {
				background-color: ' . $bgColor . ';
			}
			ul.teaserBoxNavigation li.activeTeaser {
				background-color: ' . $activeBgColor . ';
			}
			-->
			</style>'
		);
		WCF::getTPL()->append('additionalTopContents', WCF::getTPL()->fetch('teaserBox'));		
	}

}
?>