{* define *}
{assign var="teaser" value=teaser}

<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/teaserBox.js"></script>
<!--[if lt IE 8]>
<style type="text/css">
ul.teaserBoxTeaser li {
	
}
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
<div class="teaserBox border">
	{if TEASERBOX_TITLE != ""}
        <div class="teaserTitle">
            <div class="containerHead">
                <div class="containerIcon">
                    <a onclick="openList('{$teaser}', { save: true, openTitle: '{lang}wcf.teaserBox.open{/lang}', closeTitle: '{lang}wcf.teaserBox.close{/lang}' })"><img src="{icon}minusS.png{/icon}" id="{$teaser}Image" alt="" title="{lang}wcf.teaserBox.close{/lang}" /></a>
                </div>
                <div class="containerContent">
                    {@TEASERBOX_TITLE}
                </div>
            </div>
        </div>
    {/if}
	
	<div id="teaser" class="teaserBoxContent">
    	<ul class="teaserBoxNavigation">
			{foreach from=$teaserBoxData item='teaser' key='teaserNr'}
				<li class="teaserNav{if $teaserNr == 0} containerHead activeTeaser{/if}" id="teaserNav_{$teaserNr}"><a href="{$teaser.link}" onmouseover="showTeaser('{$teaserNr}');" onmouseout="startSlideShow(firstFrame,(lastFrame-1),delay);" title="{$teaser.title}"><span>{$teaser.title}</span></a></li>
			{/foreach}
		</ul>
        
		<ul class="teaserBoxTeaser">
			{foreach from=$teaserBoxData item='teaser' key='teaserNr'}
			<li id="teaserBox_{$teaserNr}" style="background: {@$teaser.bgcolor} url('{$teaser.image}') {$teaser.align} top no-repeat; display: {if $teaserNr == 0}block{else}none{/if};"><a href="{$teaser.link}" title="{$teaser.title}">&nbsp;</a></li>
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