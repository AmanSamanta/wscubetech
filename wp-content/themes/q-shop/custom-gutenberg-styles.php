<?php
/*
Overrides Default Styles With Custom Styles From The Customizer
*/

$arikon_accent_color = esc_html( get_theme_mod( 'arikon_accent_color' ) );

if( !empty( $arikon_accent_color ) ) {

	echo '<style type="text/css"> ';

		echo '

			.block-editor-writing-flow a {
				color: '.$arikon_accent_color.';
			}

			.wp-block-search .wp-block-search__button,
			.wp-block-tag-cloud a {
				background-color: '.$arikon_accent_color.';
			}

		';

	echo ' </style> ';

}