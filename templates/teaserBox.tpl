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

<div class="teaserBox border titleBarPanel">
{if TEASERBOX_TITLE}
	<div class="containerHead teaserTitle">
		<div class="containerIcon">
			<a onclick="return !openList('teaserBoxContent', { save: true, openTitle: '{lang}wcf.teaserBox.open{/lang}', closeTitle: '{lang}wcf.teaserBox.close{/lang}' })"><img src="{icon}minusS.png{/icon}" id="teaserBoxContentImage" alt="" title="{lang}wcf.teaserBox.close{/lang}" /></a>
		</div>
		<div class="containerContent">
			{@TEASERBOX_TITLE}
		</div>
	</div>
{/if}

	<div id="teaserBoxContent" class="teaserBoxContent">
		<ul class="teaserBoxNavigation">
		{foreach from=$teaserBoxData item='teaserEntry' key='teaserNr'}
			<li class="teaserNav{if $teaserNr == 0} containerHead activeTeaser{/if}" id="teaserNav_{$teaserNr}"><a href="{$teaserEntry.link}" onmouseover="showTeaser('{$teaserNr}');" onmouseout="startSlideShow(firstFrame,(lastFrame-1),delay);" title="{$teaserEntry.title}"><span>{$teaserEntry.title}</span></a></li>
		{/foreach}
		</ul>

		<ul class="teaserBoxTeaser">
		{foreach from=$teaserBoxData item='teaserEntry' key='teaserNr'}
			<li id="teaserBox_{$teaserNr}" style="background: {@$teaserEntry.bgcolor} url('{$teaserEntry.image}') {$teaserEntry.align} top no-repeat; display: {if $teaserNr == 0}block{else}none{/if};"><a href="{$teaserEntry.link}" title="{$teaserEntry.title}">&nbsp;</a></li>
		{/foreach}
		</ul>
	</div>
</div>

{if $teaserBoxData|count > 1}
<script type="text/javascript">
	//<![CDATA[
	var randomTeaser = getRandomTeaser(0,{$teaserBoxData|count} - 1);

	var firstFrame = 0;
	var lastFrame = {$teaserBoxData|count};
	var delay = {TEASERBOX_AUTOCHANGEINTERVAL}000;

	showTeaser(randomTeaser);
		{if TEASERBOX_AUTOCHANGE}
		// start slideshow
		startSlideShow(firstFrame,(lastFrame - 1),delay);
		{/if}
	//]]>
</script>
{/if}