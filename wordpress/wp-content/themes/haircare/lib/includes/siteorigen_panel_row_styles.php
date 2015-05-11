<?php
 // Pannel Settings
function kaya_row_container1($styles) {
	$styles['container1'] = __('Conatiner row Style-1', 'haircare');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container1');

function kaya_row_container2($styles) {
	$styles['container2'] = __('Conatiner row Style-2', 'haircare');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container2');