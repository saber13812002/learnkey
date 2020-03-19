<?php
	$output = ''; $bookmarks = get_bookmarks();
	foreach ($bookmarks as $bookmark) { $output .= '<option value="'.$bookmark->link_url.'">'.$bookmark->link_name.'</option>'; }
?>

<select id="link-dropdown-widget" onchange="document.location.href=this.options[this.selectedIndex].value;" name="link-dropdown">
	<option value=""><?php echo $default_option ?></option>
	<?php echo $output ?>
</select>