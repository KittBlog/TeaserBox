<?php
// wcf imports
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * Displays the teaser box
 *
 * @package		de.kittblog.wcf.teaserbox
 * @author		Alexander 'alexanderzwei' Pankow; Matthias Kittsteiner
 * @copyright	2009 Alexander Pankow; 2011-2012 Matthias Kittsteiner
 * @license		LGPL <http://www.gnu.org/licenses/lgpl.html>
 * @subpackage	system.event.listener
 * @category	Community Framework
 */
class TeaserBoxShowListener implements EventListener {
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
		if (!WCF::getUser()->getPermission('user.profile.teaserBox.canView') || WCF::getUser()->getPermission('user.profile.teaserBox.canDisable') && WCF::getUser()->getUserOption('disableTeaserBox') || (is_object(WCF::getRequest()) && WCF::getRequest()->page == 'PortalPage')) return;

		if (!in_array(PACKAGE_ID, explode(',', TEASERBOX_ACTIVE))) {
			return;
		}

		// show only on index page
		if (TEASERBOX_GLOBAL == 0) {
			if (WCF::getRequest()->page != 'IndexPage') {
				return;
			}
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

		if (!count($this->teaserBoxData)) return;

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
		if (!TEASERBOX_NAV_BORDERINNER) {
			$borderInner = 'transparent';
		}
		else {
			$borderInner = TEASERBOX_NAV_BORDERINNER;
		}
		if (!TEASERBOX_NAV_BORDEROUTER) {
			$borderOuter = 'transparent';
		}
		else {
			$borderOuter = TEASERBOX_NAV_BORDEROUTER;
		}

		if (TEASERBOX_COMPACT == 1) {
			// calculate navigation height
			$navigationHeight = TEASERBOX_HEIGHT - 30;

			WCF::getTPL()->append('specialStyles',
				'<link type="text/css" rel="stylesheet" href="'.RELATIVE_WCF_DIR.'style/extra/teaserBox-compact.css" />'.
					'<style type="text/css">
				ul.teaserBoxNavigation {
					top: ' . $navigationHeight . 'px;
				}

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
					border: 1px solid ' . $borderOuter . ';
				}

				ul.teaserBoxNavigation li.activeTeaser {
					background-color: ' . $activeBgColor . ';
				}

				ul.teaserBoxNavigation li a {
					border: 1px solid ' . $borderInner . ';
				}
				</style>'
			);
		}
		else {
			WCF::getTPL()->append('specialStyles',
				'<link type="text/css" rel="stylesheet" href="'.RELATIVE_WCF_DIR.'style/extra/teaserBox.css" />'.
					'<style type="text/css">
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
				</style>'
			);
		}
		WCF::getTPL()->append('userMessages', WCF::getTPL()->fetch('teaserBox'));
	}
}
?>