<?php
/*
------------------------------------------------------------
Plugin Name: WP-QRcode EXTENSION
Plugin URI: http://strong-seo.net/
Description: WP-QRcode を拡張するプラグイン。QRコードの表示機能をサイドバーウィジェットとして提供します。前提として <a href="http://hrlk.com/script/wp-qrcode/" target="_blank">WP-QRcode</a> がインストール・有効化されている必要があります。 | <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CZGZ9BZ9SYHKL" target="_blank">開発者に寄付する</a>
Author: パートナーズ株式会社
Version: 1.0.3
Author URI: http://partnersltd.jp/
------------------------------------------------------------
Copyright (C) 2010,2011 - Patners Co.,Ltd. (staff@partnersltd.jp)
------------------------------------------------------------
・2010/07/01 V1.0.0 初版公開
・2010/07/30 V1.0.1 一部内部仕様を変更
・2010/09/10 V1.0.2 Another HTML-lint gateway で減点される問題への対応
・2011/01/14 V1.0.3 内部仕様の一部を変更
------------------------------------------------------------
*/

include_once('wp-qrcode-extension-pr.php');

add_option('wp_qrcode_extension_is_view_title', 'TRUE' , 'WP-QRcode-EXTENSHION - タイトルビューの表示有無', 'YES');
add_option('wp_qrcode_extension_wiget_name', 'QRコード' , 'WP-QRcode-EXTENSHION - ウィジェット名', 'YES');
add_option('wp_qrcode_extension_qrcode_type', 'HOME' , 'WP-QRcode-EXTENSHION - QRコードタイプ', 'YES');
add_option('wp_qrcode_extension_qrcode_donate', 'FALSE' , 'WP-QRcode-EXTENSHION - 寄付の有無', 'YES');

register_widget_control('WP-QRcode EXTENSION', 'wp_qrcode_extension_widget_control');
register_sidebar_widget('WP-QRcode EXTENSION', 'wp_qrcode_extension_widget_viewer');

function wp_qrcode_extension_widget_viewer($args){ extract($args);

	$wp_qrcode_extension_is_view_title = get_option('wp_qrcode_extension_is_view_title');
	$wp_qrcode_extension_wiget_name = get_option('wp_qrcode_extension_wiget_name');
	$wp_qrcode_extension_qrcode_type = get_option('wp_qrcode_extension_qrcode_type');
	$wp_qrcode_extension_qrcode_donate = get_option('wp_qrcode_extension_qrcode_donate');

	if($wp_qrcode_extension_is_view_title == 'TRUE') {echo $before_widget . $before_title . $wp_qrcode_extension_wiget_name . $after_title;}

		echo '<div style="text-align:center;">';

		if ($wp_qrcode_extension_qrcode_type == 'HOME'){
			echo get_home_qrcode();
		} else {
			echo get_page_qrcode();
		}

		if ($wp_qrcode_extension_qrcode_donate == 'FALSE'){ echo get_links_for_wp_qrcode_extension_widget();}

		echo '</div>';

	if($wp_qrcode_extension_is_view_title == 'TRUE') {echo $after_widget;};
}

function wp_qrcode_extension_widget_control(){

	$wp_qrcode_extension_is_view_title = get_option('wp_qrcode_extension_is_view_title');
	$wp_qrcode_extension_wiget_name = get_option('wp_qrcode_extension_wiget_name');
	$wp_qrcode_extension_qrcode_type = get_option('wp_qrcode_extension_qrcode_type');
	$wp_qrcode_extension_qrcode_donate = get_option('wp_qrcode_extension_qrcode_donate');

	if (isset($_POST['wp_qrcode_extension_submit'])) {
		update_option('wp_qrcode_extension_is_view_title', $_POST['wp_qrcode_extension_is_view_title']);
		update_option('wp_qrcode_extension_wiget_name', $_POST['wp_qrcode_extension_wiget_name']);
		update_option('wp_qrcode_extension_qrcode_type', $_POST['wp_qrcode_extension_qrcode_type']);
		update_option('wp_qrcode_extension_qrcode_donate', $_POST['wp_qrcode_extension_qrcode_donate']);
	}

	?>

	<table style="text-valign:top;">
	<tr>
		<td style="text-valign:top;">タイトルの表示:</td>
		<td style="text-valign:bottom;">
		<select name="wp_qrcode_extension_is_view_title">
		<option value="TRUE" <?php if($wp_qrcode_extension_is_view_title=='TRUE'){ echo('selected');} ?>>表示する</option>
		<option value="FALSE" <?php if($wp_qrcode_extension_is_view_title=='FALSE'){ echo('selected');} ?>>表示しない</option>
		</select>
		</td>
	</tr>
	</table>

	<table style="text-valign:top;">
	<tr><td>タイトル:</td></tr>
	<tr>
		<td>
		<input name="wp_qrcode_extension_wiget_name" type="text" value="<?php echo $wp_qrcode_extension_wiget_name; ?>" />
		</td>
	</tr>
	<tr><td>(例) 当サイトのQRコード</td></tr>
	</table>

	&nbsp;<br />

	<table style="text-valign:top;">
	<tr>
		<td style="text-valign:top;">QRコードのURL:</td>
		<td style="text-valign:bottom;">
		<select name="wp_qrcode_extension_qrcode_type">
		<option value="HOME" <?php if($wp_qrcode_extension_qrcode_type=='HOME'){ echo('selected');} ?>>トップURL</option>
		<option value="PAGE" <?php if($wp_qrcode_extension_qrcode_type=='PAGE'){ echo('selected');} ?>>ページURL</option>
		</select>
		</td>
	</tr>
	</table>

	&nbsp;<br />

	<table style="text-valign:top;">
	<tr>
		<td style="text-valign:top;">ステータス:</td>
		<td style="text-valign:bottom;">
		<select name="wp_qrcode_extension_qrcode_donate">
		<option value="FALSE" <?php if($wp_qrcode_extension_qrcode_donate=='FALSE'){ echo('selected');} ?>>寄付していません</option>
		<option value="TRUE" <?php if($wp_qrcode_extension_qrcode_donate=='TRUE'){ echo('selected');} ?>>寄付しました</option>
		</select>
		</td>
	</tr>
	<tr>
		<td style="text-valign:top;"></td>
		<td style="text-valign:top;">
		&nbsp;<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CZGZ9BZ9SYHKL" target="_blank">開発者に寄付する</a>
		</td>
	</tr>
	</table>

	<p><input type="hidden" name="wp_qrcode_extension_submit" value="1" /></p>

	<?php
}











?>