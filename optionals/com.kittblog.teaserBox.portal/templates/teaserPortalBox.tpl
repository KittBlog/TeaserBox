{if TEASERBOX_PORTAL_ACTIVE}
	{* define *}
	{assign var="teaser" value=teaser}

	<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/TeaserBox.class.js"></script>
	<!--[if lt IE 8]>
	<style type="text/css">
		ul.teaserBoxNavigation {
			display: none;
		}

		ul.teaserBoxNavigation li.activeTeaser {
			padding-right: 0;
			padding-left: 10px;
			margin-left: -10px !important;
		}
	</style>
	<![endif]-->
	<!--[if IE 6]>
	<style type="text/css">
		ul.teaserBoxNavigation li.activeTeaser {
			padding-left: 10px;
		}

		ul.teaserBoxNavigation li {
			margin-right: -20px;
		}
	</style>
	<![endif]-->

	<div class="teaserBox border titleBarPanel" id="box{$box->boxID}">
		{if TEASERBOX_TITLE}
			<div class="teaserTitle">
				<div class="containerHead">
					<div class="containerIcon">
						<a href="javascript: void(0)" onclick="openList('{@$box->getStatusVariable()}', { save:true })"><img src="{icon}minusS.png{/icon}" id="{@$box->getStatusVariable()}Image" alt="" /></a>
					</div>
					<div class="containerContent">
						<h3>{@TEASERBOX_TITLE}</h3>
					</div>
				</div>
			</div>
		{/if}
		<div class="teaserBoxContent" id="{@$box->getStatusVariable()}">
			<ul class="teaserBoxNavigation">
				{foreach from=$box->teaserBoxData item='teaserEntry' key='teaserNr'}
					<li class="teaserNav{if $teaserNr == 0} containerHead activeTeaser{/if}" id="teaserNav_{$teaserNr}"><a href="{$teaserEntry.link}" onmouseover="showTeaser('{$teaserNr}');" onmouseout="startSlideShow(firstFrame,(lastFrame-1),delay);" title="{$teaserEntry.title}"><span>{$teaserEntry.title}</span></a></li>
				{/foreach}
			</ul>

			<ul class="teaserBoxTeaser">
				{foreach from=$box->teaserBoxData item='teaserEntry' key='teaserNr'}
				<li id="teaserBox_{$teaserNr}" style="background: {@$teaserEntry.bgcolor} url('{$teaserEntry.image}') {$teaserEntry.align} top no-repeat; display: {if $teaserNr == 0}block{else}none{/if};"><a href="{$teaserEntry.link}" title="{$teaserEntry.title}">&nbsp;</a></li>
				{/foreach}
			</ul>
		</div>
	</div>
	{if TEASERBOX_AUTOCHANGE && $box->teaserBoxData|count > 1}
		<script type="text/javascript">
		//<![CDATA[
			var randomTeaser = getRandomTeaser(0,{$box->teaserBoxData|count} - 1);

			var firstFrame = 0;
			var lastFrame = {$box->teaserBoxData|count};
			var delay = {TEASERBOX_AUTOCHANGEINTERVAL}000;

			showTeaser(randomTeaser);

			// start slideshow
			startSlideShow(firstFrame,(lastFrame - 1),delay);
		//]]>
		</script>
	{/if}
{/if}