<section class="section section-4 instagram-photos">
	<h3><% _t('INSTAGRAMCTA','Instagram photos') %> <em>#{$InstagramSearchTerm}</em></h3>
	<p><% _t('INSTAGRAMDESC','Your Instagram photos also can be on our web, just tag your photos with our hashtag!') %></p>
	<!-- <% cached 'InstaTagMedia', CacheTimedReset %> -->
	<% if InstaTagMedia %>
		<% loop InstaTagMedia %>
		<div class="single-image img$Pos">
			<a href="{$image}" title="{$caption} - photo by @{$username}" class="galleryPhoto" rel="insta1">
				<img title="{$caption} - photo by @{$username}" src="{$thumb}" />
				<div class="overlay trans-bgimg"></div>
			</a>
		</div>
		<% end_loop %>
	<% end_if %>
	<!-- <% end_cached %> -->
</section>