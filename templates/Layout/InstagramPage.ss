
<div class="row instagram-photos-title">
	<div class="col-sm-12">
		<h3><% _t('INSTAGRAMCTA','Instagram photos') %> <em>#{$InstagramSearchTerm}</em></h3>
		<p><% _t('INSTAGRAMDESC','Your Instagram photos also can be on our web, just tag your photos with our hashtag!') %></p>
	</div>
</div>
<div class="row instagram-photos">
	<% if InstaTagMedia %>
		<% loop InstaTagMedia %>
		<div class="col-xs-12 col-md-2">
			<a href="{$image}" title="{$caption} - photo by @{$username}" class="thumbnail" rel="insta1">
				<img title="{$caption} - photo by @{$username}" data-src=="{$thumb}" src="{$thumb}" />
			</a>
		</div>
		<% end_loop %>
	<% end_if %>
</div>