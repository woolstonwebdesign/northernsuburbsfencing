<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    woo-gift-cards-lite
 * @subpackage woo-gift-cards-lite/includes/extra-templates
 */

global $pagenow;
if ( empty( $pagenow ) || 'plugins.php' != $pagenow ) {
	return false;
}

$form_fields = apply_filters( 'mwb_deactivation_form_fields', array() );
if ( ! empty( $form_fields ) ) : ?>
	<div style="display: none;" class="loading-style-bg" id="mwb_wgm_loader">
		<img src="<?php echo esc_url( MWB_WGC_URL . 'assets/images/loading.gif' ); ?>">
	</div>
	<div class="mwb-onboarding-section">
		<div class="mwb-on-boarding-wrapper-background">
		<div class="mwb-on-boarding-wrapper">
			<div class="mwb-on-boarding-close-btn">
				<a href="javascript:void(0);">
					<span class="close-form">x</span>
				</a>
			</div>
			<h3 class="mwb-on-boarding-heading"></h3>
			<p class="mwb-on-boarding-desc"><?php esc_html_e( 'May we have a little info about why you are deactivating?', 'woo-gift-cards-lite' ); ?></p>
			<form action="#" method="post" class="mwb-on-boarding-form">
				<?php foreach ( $form_fields as $key => $field_attr ) : ?>
					<?php $this->render_field_html( $field_attr, 'deactivating' ); ?>
				<?php endforeach; ?>
				<div class="mwb-on-boarding-form-btn__wrapper">
					<div class="mwb-on-boarding-form-submit mwb-on-boarding-form-verify ">
					<input type="submit" class="mwb-on-boarding-submit mwb-on-boarding-verify " value="SUBMIT AND DEACTIVATE">
				</div>
				<div class="mwb-on-boarding-form-no_thanks">
					<a href="javascript:void(0);" class="mwb-deactivation-no_thanks"><?php esc_html_e( 'Skip and Deactivate Now', 'woo-gift-cards-lite' ); ?></a>
				</div>
				</div>
			</form>
		</div>
	</div>
	</div>
<?php endif; ?>
