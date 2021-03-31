/**
 * All of the code for public-facing JavaScript source
 * should reside in this file.
 *
 * @package           woo-gift-cards-lite
 */

(function( $ ) {

	'use strict';
	jQuery( document ).ready(
		function($){
			var check_elementor = $(document).find('.mwb_wgm_added_wrapper').parents('.elementor-product-wgm_gift_card').length;
			if (check_elementor != 0) {
				if ($(document).find('.mwb_wgm_added_wrapper').length) {
					$(document).find('.mwb_wgm_added_wrapper').siblings().wrapAll('<div class="mwb_wgm_elementor"></div>');
					var modified_div = $(document).find('.mwb_wgm_elementor');
					$(document).find('.mwb_wgm_added_wrapper').append(modified_div);
				}
			}

			$( "#mwb_wgm_message" ).keyup(
				function(){
					var msg_length = $( document ).find( '#mwb_wgm_message' ).val().length;
					if (msg_length == 0) {

						$( '.mwb_box_char' ).text( 0 );
					} else {
						$( '.mwb_box_char' ).text( msg_length );
					}

				}
			);

			/*Js for select template on single product page*/
			$( '.mwb_wgm_featured_img' ).click(
				function(){
					$( '.mwb_wgm_selected_template' ).find( '.mwb_wgm_featured_img' ).removeClass( 'mwb_wgm_pre_selected_temp' );
					var img_id = $( this ).attr( 'id' );
					$( '#' + img_id ).addClass( 'mwb_wgm_pre_selected_temp' );
					$( '#mwb_wgm_selected_temp' ).val( img_id );
				}
			);

			/*
			Adds the Validation for some required fields for Single Product Page.
			*/
			jQuery( ".single_add_to_cart_button" ).click(
				function(e){
					if (typeof mwb_wgm.pricing_type.type != 'undefined') {
						e.preventDefault();
						$( "#mwb_wgm_error_notice" ).hide();
						var from_mail = $( "#mwb_wgm_from_name" ).val();
						var message = $( "#mwb_wgm_message" ).val();
						message = message.trim();
						var price = $( "#mwb_wgm_price" ).val();
						var error = false;
						var product_type = mwb_wgm.pricing_type.type;
						var html = "";
						var to_mail = '';
						var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/;
						html = "<ul>";

						var delivery_method = jQuery( document ).find( 'input[name="mwb_wgm_send_giftcard"]:checked' ).val();
						// remove validation from to fields.
						if (mwb_wgm.is_pro_active != null && mwb_wgm.is_pro_active != '' && mwb_wgm_remove_validation_to() == 'on') {
							if (delivery_method == 'Mail to recipient') {
								to_mail = $( "#mwb_wgm_to_email" ).val();
								error = false;
							}
							if (delivery_method == 'Downloadable') {
								to_mail = $( "#mwb_wgm_to_download" ).val();
								error = false;
							}
						} else {
							if (delivery_method == 'Mail to recipient') {
								to_mail = $( "#mwb_wgm_to_email" ).val();
								if (to_mail == null || to_mail == "") {
									error = true;
									$( "#mwb_wgm_to_email" ).addClass( "mwb_wgm_error" );
									html += "<li><b>";
									html += mwb_wgm.to_empty;
									html += "</li>";
								} else if ( ! to_mail.match( mailformat )) {
									error = true;
									$( "#mwb_wgm_to_email" ).addClass( "mwb_wgm_error" );
									html += "<li><b>";
									html += mwb_wgm.to_invalid;
									html += "</li>";
								}
							}
							if (delivery_method == 'Downloadable') {
								to_mail = $( "#mwb_wgm_to_download" ).val();
								if (to_mail == null || to_mail == "") {
									error = true;
									$( "#mwb_wgm_to_download" ).addClass( "mwb_wgm_error" );
									html += "<li><b>";
									html += mwb_wgm.to_empty_name;
									html += "</li>";
								}
							}
						}

						if (price == null || price == "") {
							error = true;
							$( "#mwb_wgm_price" ).addClass( "mwb_wgm_error" );
							html += "<li><b>";
							html += mwb_wgm.price_field;
							html += "</li>";
						}
						// Remove validation from field.
						if (mwb_wgm.is_pro_active != null && mwb_wgm.is_pro_active != '' && mwb_wgm_remove_validation_from() == 'on') {
							error = false;
						} else {
							if (from_mail == null || from_mail == "") {
								error = true;
								$( "#mwb_wgm_from_name" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.from_empty;
								html += "</li>";
							}
						}
						// for validation from message field.
						if (mwb_wgm.is_pro_active != null && mwb_wgm.is_pro_active != '' && mwb_wgm_remove_validation_msg() == 'on') {
							error = false;
						} else {
							if (message == null || message == "") {
								error = true;
								$( "#mwb_wgm_message" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.msg_empty;
								html += "</li>";
							} else if ( message.length > mwb_wgm.msg_length ) {
								error = true;
								$( "#mwb_wgm_message" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.msg_length_err;
								html += "</li>";
							}
						}

						if (product_type == "mwb_wgm_range_price") {
							var from = parseInt( mwb_wgm.pricing_type.from );
							var to = parseInt( mwb_wgm.pricing_type.to );

							to = parseFloat( to );
							from = parseFloat( from );
							price = parseFloat( price );

							if (price > to || price < from) {
								error = true;
								$( "#mwb_wgm_price" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.price_range;
								html += "</li>";
							}
						}
						// if pro is active.
						if (mwb_wgm.is_pro_active != null && mwb_wgm.is_pro_active != '') {
							var response = mwb_wgm_add_to_card_validation( html,error );
							error = response.error;
							html += response.html;
							to_mail = response.to_mail;
						}
						html += "</ul>";
						if (error) {
							$( "#mwb_wgm_error_notice" ).html( html );
							$( "#mwb_wgm_error_notice" ).show();
							jQuery( 'html, body' ).animate(
								{
									scrollTop: jQuery( ".woocommerce-page" ).offset().top
								},
								800
							);
							$( ".single_add_to_cart_button" ).removeClass( "loading" );
						} else {
							$( "#mwb_wgm_error_notice" ).html( "" );
							$( "#mwb_wgm_error_notice" ).hide();
							$( this ).closest( "form.cart" ).submit();
							return true;
						}
					}
				}
			);

			/* Adds the Preview Validtion Here*/

			$( '#mwg_wgm_preview_email' ).click(
				function() {

					var form_Data = new FormData();
					$( "#mwb_wgm_error_notice" ).hide();
					var from_mail = $( "#mwb_wgm_from_name" ).val();
					var message = $( "#mwb_wgm_message" ).val();
					message = message.trim();
					var regex = /(<([^>]+)>)/ig;
					var message = message.replace( regex,'' );
					var price = $( "#mwb_wgm_price" ).val();
					var error = false;
					var product_type = mwb_wgm.pricing_type.type;
					var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/;
					var to_mail = '';
					var html = "<ul>";
					var delivery_method = jQuery( document ).find( 'input[name="mwb_wgm_send_giftcard"]:checked' ).val();
					// remove validation from to fields.
					if (mwb_wgm.is_pro_active != null && mwb_wgm.is_pro_active != '' && mwb_wgm_remove_validation_to() == 'on') {
						if (delivery_method == 'Mail to recipient') {
							to_mail = $( "#mwb_wgm_to_email" ).val();
							error = false;
						}
						if (delivery_method == 'Downloadable') {
							to_mail = $( "#mwb_wgm_to_download" ).val();
							error = false;
						}
					} else {
						if (delivery_method == 'Mail to recipient') {
								to_mail = $( "#mwb_wgm_to_email" ).val();
							if (to_mail == null || to_mail == "") {
								error = true;
								$( "#mwb_wgm_to_email" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.to_empty;
								html += "</li>";
							} else if ( ! to_mail.match( mailformat )) {
								error = true;
								$( "#mwb_wgm_to_email" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.to_invalid;
								html += "</li>";
							}
						}
						if (delivery_method == 'Downloadable') {
							to_mail = $( "#mwb_wgm_to_download" ).val();
							if (to_mail == null || to_mail == "") {
								error = true;
								$( "#mwb_wgm_to_download" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.to_empty_name;
								html += "</li>";
							}
						}
					}
					if (price == null || price == "") {
						error = true;
						$( "#mwb_wgm_price" ).addClass( "mwb_wgm_error" );
						html += "<li><b>";
						html += mwb_wgm.price_field;
						html += "</li>";
					}
					// remove validation from field.
					if (mwb_wgm.is_pro_active != null && mwb_wgm.is_pro_active != '' && mwb_wgm_remove_validation_from() == 'on') {
						error = false;
					} else {
						if (from_mail == null || from_mail == "") {
								error = true;
								$( "#mwb_wgm_from_name" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.from_empty;
								html += "</li>";
						}
					}
					// for validation from message.
					if (mwb_wgm.is_pro_active != null && mwb_wgm.is_pro_active != '' && mwb_wgm_remove_validation_msg() == 'on') {
						error = false;
					} else {
						if (message == null || message == "") {
								error = true;
								$( "#mwb_wgm_message" ).addClass( "mwb_wgm_error" );
								html += "<li><b>";
								html += mwb_wgm.msg_empty;
								html += "</li>";
						} else if ( message.length > mwb_wgm.msg_length ) {
							error = true;
							$( "#mwb_wgm_message" ).addClass( "mwb_wgm_error" );
							html += "<li><b>";
							html += mwb_wgm.msg_length_err;
							html += "</li>";
						}
					}

					if (product_type == "mwb_wgm_range_price") {
						var from = mwb_wgm.pricing_type.from;
						var to = mwb_wgm.pricing_type.to;
						to = parseFloat( to );
						from = parseFloat( from );
						price = parseFloat( price );

						if (price > to || price < from) {
							error = true;
							$( "#mwb_wgm_price" ).addClass( "mwb_wgm_error" );
							html += "<li><b>";
							html += mwb_wgm.price_range;
							html += "</li>";
						}
					}
					// if pro is active.
					if (mwb_wgm.is_pro_active != null && mwb_wgm.is_pro_active != '') {
						var response = mwb_wgm_preview_validation( html,error,form_Data );
						error = response.error;
						html += response.html;
						to_mail = response.to_mail;
						form_Data = response.form_Data;
					}
					html += "</ul>";
					if (error) {
						$( "#mwb_wgm_error_notice" ).html( html );
						$( "#mwb_wgm_error_notice" ).show();
						// MWB code for woodmart theme.
						$( "#mwb_wgm_error_notice" ).removeClass( 'hidden-notice' );
						// MWB code for woodmart theme.
						jQuery( 'html, body' ).animate(
							{
								scrollTop: jQuery( ".woocommerce-page" ).offset().top
							   },
							800
						);
					} else {

						var product_id = mwb_wgm.product_id;
						var tempId = $( document ).find( '#mwb_wgm_selected_temp' ).val();
						form_Data.append( 'action', 'mwb_wgc_preview_thickbox_rqst' );
						form_Data.append( 'mwb_nonce', mwb_wgm.mwb_wgm_nonce );
						form_Data.append( 'price', price );
						form_Data.append( 'from', from_mail );
						form_Data.append( 'to', to_mail );
						form_Data.append( 'message', message );
						form_Data.append( 'product_id', product_id );
						form_Data.append( 'tempId', tempId );

						$.ajax(
							{
								url: mwb_wgm.ajaxurl,
								type: "POST",
								data: form_Data,
								processData: false,
								contentType: false,
								success: function(response)
								{
									$( "#mwg_wgm_preview_email" ).show();
									tb_show( "", response );
								}
							}
						);
					}
				}
			);
		}
	);

})( jQuery );
