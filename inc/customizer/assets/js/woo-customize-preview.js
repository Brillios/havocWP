/**
 * Update Woo Customizer settings live.
 *
 * @version 1.0.0
 * 
 * @since 2.0
 */

( function( $ ) {

    // Declare vars
	var api 			= wp.customize,
    body 				= $( 'body' ),
    siteHeader 			= $( '#site-header' ),
    wooCatStyle 		= [
        'woo-default-cat',
        'woo-dropdown-cat'
    ],
    wooAccountStyle 	= [
        'account-side-style',
        'account-original-style'
    ],
    wooSaleStyle 		= [
        'square-sale',
        'circle-sale'
    ],
    wooCartStyle 		= [
        'compact',
        'spacious'
    ],
    wooProductsCol 		= [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7'
    ],
    wooProductsTabletCol = [
        'tablet-1-col',
        'tablet-2-col',
        'tablet-3-col',
        'tablet-4-col',
        'tablet-5-col',
        'tablet-6-col',
        'tablet-7-col'
    ],
    wooProductsMobileCol = [
        'mobile-1-col',
        'mobile-2-col',
        'mobile-3-col',
        'mobile-4-col',
        'mobile-5-col',
        'mobile-6-col',
        'mobile-7-col'
    ],
    wooContentAlignment = [
        'hvc-content-left',
        'hvc-content-right',
        'hvc-content-center'
    ],
    wooThumbsPosition 	= [
        'hvc-thumbs-layout-horizontal',
        'hvc-thumbs-layout-vertical'
    ],
    wooAddToCartStyle 	= [
        'hvc-btn-normal',
        'hvc-btn-big',
        'hvc-btn-very-big'
    ],
    wooTabsLayout 		= [
        'hvc-tabs-layout-horizontal',
        'hvc-tabs-layout-vertical',
        'hvc-tabs-layout-section'
    ],
    wooTabsPosition 	= [
        'woo-left-tabs',
        'woo-right-tabs',
        'woo-center-tabs'
    ],
    wooCheckoutTimeline = [
        'arrow',
        'square'
    ];

    /******** WooCommerce *********/
    
		// Categories widget style
		api('havoc_woo_cat_widget_style', function( value ) {
			value.bind( function( newval ) {
				if ( body.length ) {
					$.each( wooCatStyle, function( i, v ) {
						body.removeClass( v );
					});
					body.addClass( 'woo-'+ newval +'-cat' );
				}
			});
		});

		// Sale badge style
		api('havoc_woo_sale_badge_style', function( value ) {
			value.bind( function( newval ) {
				var sale_style = $( '.woocommerce div.product' );
				if ( sale_style.length ) {
					$.each( wooSaleStyle, function( i, v ) {
						sale_style.removeClass( v );
					});
					sale_style.addClass( newval + '-sale' );
				}
			});
		});

	    // Off canvas filter text
	    api('havoc_woo_off_canvas_filter_text', function( value ) {
			value.bind( function( newval ) {
				$( '.havocwp-off-canvas-filter .off-canvas-filter-text' ).html( newval );
			});
	    });

		// Cart style
		api('havoc_woo_cart_dropdown_style', function( value ) {
			value.bind( function( newval ) {
				var cart = $( '.woo-menu-icon' );
				if ( cart.length ) {
					$.each( wooCartStyle, function( i, v ) {
						cart.removeClass( v );
					});
					cart.addClass( newval );
				}
			});
		});

		// Custom Cart icon
		api('havoc_woo_menu_custom_icon', function( value ) {
			value.bind( function( newval ) {
				var $cart = $( '#site-navigation-wrap .dropdown-menu > li > a.wcmenucart i' );

				if ( $cart.length ) {
					$cart.removeClass();
					$cart.addClass( newval );
				}
			});
		});

		// Menu cart icon size
		api( 'havoc_woo_menu_icon_size', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_menu_icon_size' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_menu_icon_size">.wcmenucart i { font-size: ' + to + 'px; } .wcmenucart .hvc-icon { width: ' + to + 'px; height: ' + to + 'px; }</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Menu cart icon size tablet
		api( 'havoc_woo_menu_icon_size_tablet', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_menu_icon_size_tablet' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_menu_icon_size_tablet">@media (max-width: 768px){.havocwp-mobile-menu-icon a.wcmenucart { font-size: ' + to + 'px; } .havocwp-mobile-menu-icon a.wcmenucart .hvc-icon { width: ' + to + 'px; height: ' + to + 'px; }}</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Menu cart icon size mobile
		api( 'havoc_woo_menu_icon_size_mobile', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_menu_icon_size_mobile' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_menu_icon_size_mobile">@media (max-width: 480px){.havocwp-mobile-menu-icon a.wcmenucart { font-size: ' + to + 'px; } .havocwp-mobile-menu-icon a.wcmenucart .hvc-icon { width: ' + to + 'px; height: ' + to + 'px; }}</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Menu cart icon center vertically
		api( 'havoc_woo_menu_icon_center_vertically', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_menu_icon_center_vertically' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_menu_icon_center_vertically">.wcmenucart i { top: ' + to + 'px; }</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Menu cart icon center vertically tablet
		api( 'havoc_woo_menu_icon_center_vertically_tablet', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_menu_icon_center_vertically_tablet' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_menu_icon_center_vertically_tablet">@media (max-width: 768px){.havocwp-mobile-menu-icon a.wcmenucart { top: ' + to + 'px; }}</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Menu cart icon center vertically mobile
		api( 'havoc_woo_menu_icon_center_vertically_mobile', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_menu_icon_center_vertically_mobile' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_menu_icon_center_vertically_mobile">@media (max-width: 480px){.havocwp-mobile-menu-icon a.wcmenucart { top: ' + to + 'px; }}</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Archives products columns
		api('havoc_woocommerce_shop_columns', function( value ) {
			value.bind( function( newval ) {
				var archivesCol = $( '.woocommerce .products .product' );
				if ( archivesCol.length ) {
					$.each( wooProductsCol, function( i, v ) {
						archivesCol.parent().removeClass( 'archives-col-'+ v );
						archivesCol.removeClass( 'span_1_of_'+ v );
					});
					archivesCol.parent().addClass( 'custom-col archives-col-'+ newval );
					archivesCol.addClass( 'span_1_of_'+ newval );
				}
			});
		});

		// Archives tablet columns class
		api('havoc_woocommerce_tablet_shop_columns', function( value ) {
			value.bind( function( newval ) {
				var archivesCol = $( '.woocommerce .products' );
				if ( archivesCol.length ) {
					$.each( wooProductsTabletCol, function( i, v ) {
						archivesCol.removeClass( v );
					});
					archivesCol.addClass( 'tablet-col' );
					archivesCol.addClass( 'tablet-'+ newval +'-col' );
				}
			});
		});

		// Archives mobile columns class
		api('havoc_woocommerce_mobile_shop_columns', function( value ) {
			value.bind( function( newval ) {
				var archivesCol = $( '.woocommerce .products' );
				if ( archivesCol.length ) {
					$.each( wooProductsMobileCol, function( i, v ) {
						archivesCol.removeClass( v );
					});
					archivesCol.addClass( 'mobile-col' );
					archivesCol.addClass( 'mobile-'+ newval +'-col' );
				}
			});
		});

		// Content Alignment
		api('havoc_woo_product_entry_content_alignment', function( value ) {
			value.bind( function( newval ) {
				var content_alignment = $( '.woocommerce .products .product' );
				if ( content_alignment.length ) {
					$.each( wooContentAlignment, function( i, v ) {
						content_alignment.removeClass( v );
					});
					content_alignment.addClass( 'hvc-content-'+ newval );
				}
			});
		});

		// Off canvas close button color
		api( 'havoc_woo_off_canvas_close_button_color', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_off_canvas_close_button_color' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_off_canvas_close_button_color">.havocwp-off-canvas-close svg {fill: ' + to + ';}</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Off canvas close button hover color
		api( 'havoc_woo_off_canvas_close_button_hover_color', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_off_canvas_close_button_hover_color' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_off_canvas_close_button_hover_color">.havocwp-off-canvas-close:hover svg {fill: ' + to + ';}</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Infinite scroll spinners color
		api( 'havoc_woo_infinite_scroll_spinners_color', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_infinite_scroll_spinners_color' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_infinite_scroll_spinners_color">.woocommerce .loader-ellips__dot {background-color: ' + to + ';}</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Infinite scroll last text
		api('havoc_woo_infinite_scroll_last_text', function( value ) {
			value.bind( function( newval ) {
				$( '.woocommerce .infinite-scroll-last' ).text( newval );
			});
		});

		// Infinite scroll error text
		api('havoc_woo_infinite_scroll_error_text', function( value ) {
			value.bind( function( newval ) {
				$( '.woocommerce .infinite-scroll-error' ).text( newval );
			});
		});

		// Thumbs Layout
		api('havoc_woo_product_thumbs_layout', function( value ) {
			value.bind( function( newval ) {
				var thumbs_layout = $( '.woocommerce div.product' );
				if ( thumbs_layout.length ) {
					$.each( wooThumbsPosition, function( i, v ) {
						thumbs_layout.removeClass( v );
					});
					thumbs_layout.addClass( 'hvc-thumbs-layout-'+ newval );
				}
			});
		});

		// Add to cart button style
		api('havoc_woo_product_addtocart_style', function( value ) {
			value.bind( function( newval ) {
				var addtocart_style = $( '.woocommerce div.product' );
				if ( addtocart_style.length ) {
					$.each( wooAddToCartStyle, function( i, v ) {
						addtocart_style.removeClass( v );
					});
					addtocart_style.addClass( 'hvc-btn-'+ newval );
				}
			});
		});

		// Tabs Layout
		api('havoc_woo_product_tabs_layout', function( value ) {
			value.bind( function( newval ) {
				var tabs_layout = $( '.woocommerce div.product' );
				if ( tabs_layout.length ) {
					$.each( wooTabsLayout, function( i, v ) {
						tabs_layout.removeClass( v );
					});
					tabs_layout.addClass( 'hvc-tabs-layout-'+ newval );
				}
			});
		});

		// Tabs Position
		api('havoc_woo_product_meta_tabs_position', function( value ) {
			value.bind( function( newval ) {
				if ( body.length ) {
					$.each( wooTabsPosition, function( i, v ) {
						body.removeClass( v );
					});
					body.addClass( 'woo-'+ newval +'-tabs' );
				}
			});
		});

		// Multi-step checkout style
		api('havoc_woo_multi_step_checkout_timeline_style', function( value ) {
			value.bind( function( newval ) {
				var timeline = $( '#hvc-checkout-timeline' );
				if ( timeline.length ) {
					$.each( wooCheckoutTimeline, function( i, v ) {
						timeline.removeClass( v );
					});
					timeline.addClass( newval );
				}
			});
		});

		// Both Sidebars layout shop page content width
		api( 'havoc_woo_shop_both_sidebars_content_width', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_shop_both_sidebars_content_width' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_shop_both_sidebars_content_width">@media only screen and (min-width: 960px){ body.woocommerce.archive.content-both-sidebars .content-area { width: ' + to + '%; } body.woocommerce.archive.content-both-sidebars.scs-style .widget-area.sidebar-secondary, body.woocommerce.archive.content-both-sidebars.ssc-style .widget-area {left: -' + to + '%;} }</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Both Sidebars layout shop page sidebars width
		api( 'havoc_woo_shop_both_sidebars_sidebars_width', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_shop_both_sidebars_sidebars_width' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_shop_both_sidebars_sidebars_width">@media only screen and (min-width: 960px){ body.woocommerce.archive.content-both-sidebars .widget-area{width:' + to + '%;} body.woocommerce.archive.content-both-sidebars.scs-style .content-area{left:' + to + '%;} body.woocommerce.archive.content-both-sidebars.ssc-style .content-area{left:'+ to * 2 +'%;} }</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Both Sidebars layout single product content width
		api( 'havoc_woo_product_both_sidebars_content_width', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_product_both_sidebars_content_width' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_product_both_sidebars_content_width">@media only screen and (min-width: 960px){ body.single-product.content-both-sidebars .content-area { width: ' + to + '%; } body.single-product.content-both-sidebars.scs-style .widget-area.sidebar-secondary, body.single-product.content-both-sidebars.ssc-style .widget-area {left: -' + to + '%;} }</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

		// Both Sidebars layout single product sidebars width
		api( 'havoc_woo_product_both_sidebars_sidebars_width', function( value ) {
			value.bind( function( to ) {
				var $child = $( '.customizer-havoc_woo_product_both_sidebars_sidebars_width' );
				if ( to ) {
					var style = '<style class="customizer-havoc_woo_product_both_sidebars_sidebars_width">@media only screen and (min-width: 960px){ body.single-product.content-both-sidebars .widget-area{width:' + to + '%;} body.single-product.content-both-sidebars.scs-style .content-area{left:' + to + '%;} body.single-product.content-both-sidebars.ssc-style .content-area{left:'+ to * 2 +'%;} }</style>';
					if ( $child.length ) {
						$child.replaceWith( style );
					} else {
						$( 'head' ).append( style );
					}
				} else {
					$child.remove();
				}
			} );
		} );

    // Customizer Live Preview
    api("havoc_woo_product_image_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_product_image_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_product_image_width">.woocommerce div.product div.images, .woocommerce.content-full-width div.product div.images { width: ' + to + "%; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_product_summary_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_product_summary_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_product_summary_width">.woocommerce div.product div.summary, .woocommerce.content-full-width div.product div.summary { width: ' + to + "%; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_store_notice_bg_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-store-notice.demo_store").css("background-color", size);
        });
    }), api("havoc_woo_store_notice_dismiss_bg_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".demo_store .woocommerce-store-notice__dismiss-link").css("background-color", size);
        });
    }), api("havoc_woo_store_notice_dismiss_text_hover_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".demo_store .woocommerce-store-notice__dismiss-link:hover").css("color", size);
        });
    }), api("havoc_woo_floating_bar_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".hvc-floating-bar").css("background-color", size);
        });
    }), api("havoc_woo_floating_bar_title_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".hvc-floating-bar p.selected, .hvc-floating-bar h2.entry-title").css("color", size);
        });
    }), api("havoc_woo_floating_bar_price_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".hvc-floating-bar .product_price del .amount, .hvc-floating-bar .product_price .amount, .hvc-floating-bar .out-of-stock").css("color", size);
        });
    }), api("havoc_woo_floating_bar_quantity_buttons_bg", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_floating_bar_quantity_buttons_bg");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_floating_bar_quantity_buttons_bg">.hvc-floating-bar form.cart .quantity .minus, .hvc-floating-bar form.cart .quantity .plus { background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_floating_bar_quantity_buttons_hover_bg", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_floating_bar_quantity_buttons_hover_bg");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_floating_bar_quantity_buttons_hover_bg">.hvc-floating-bar form.cart .quantity .minus:hover, .hvc-floating-bar form.cart .quantity .plus:hover { background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_floating_bar_quantity_buttons_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_floating_bar_quantity_buttons_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_floating_bar_quantity_buttons_color">.hvc-floating-bar form.cart .quantity .minus, .hvc-floating-bar form.cart .quantity .plus { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_floating_bar_quantity_buttons_hover_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_floating_bar_quantity_buttons_hover_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_floating_bar_quantity_buttons_hover_color">.hvc-floating-bar form.cart .quantity .minus:hover, .hvc-floating-bar form.cart .quantity .plus:hover { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_floating_bar_quantity_input_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".hvc-floating-bar form.cart .quantity .qty").css("background-color", size);
        });
    }), api("havoc_woo_floating_bar_quantity_input_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".hvc-floating-bar form.cart .quantity .qty").css("color", size);
        });
    }), api("havoc_woo_floating_bar_addtocart_bg", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_floating_bar_addtocart_bg");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_floating_bar_addtocart_bg">.hvc-floating-bar button.button { background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_floating_bar_addtocart_hover_bg", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_floating_bar_addtocart_hover_bg");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_floating_bar_addtocart_hover_bg">.hvc-floating-bar button.button:hover, .hvc-floating-bar button.button:focus { background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_floating_bar_addtocart_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_floating_bar_addtocart_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_floating_bar_addtocart_color">.hvc-floating-bar button.button { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_floating_bar_addtocart_hover_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_floating_bar_addtocart_hover_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_floating_bar_addtocart_hover_color">.hvc-floating-bar button.button:hover, .hvc-floating-bar button.button:focus { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_checkout_timeline_bg", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_checkout_timeline_bg");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_checkout_timeline_bg">#hvc-checkout-timeline .timeline-wrapper { background-color: ' + to + '; } #hvc-checkout-timeline.arrow .timeline-wrapper:before{ border-top-color: ' + to + '; border-bottom-color: ' + to + '; } #hvc-checkout-timeline.arrow .timeline-wrapper:after{ border-left-color: ' + to + '; border-right-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_checkout_timeline_color", function($swipe) {
        $swipe.bind(function(size) {
            $("#hvc-checkout-timeline .timeline-wrapper").css("color", size);
        });
    }), api("havoc_woo_checkout_timeline_number_bg", function($swipe) {
        $swipe.bind(function(size) {
            $("#hvc-checkout-timeline .timeline-step").css("background-color", size);
        });
    }), api("havoc_woo_checkout_timeline_number_color", function($swipe) {
        $swipe.bind(function(size) {
            $("#hvc-checkout-timeline .timeline-step").css("color", size);
        });
    }), api("havoc_woo_checkout_timeline_number_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $("#hvc-checkout-timeline .timeline-step").css("border-color", size);
        });
    }), api("havoc_woo_checkout_timeline_active_bg", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_woo_checkout_timeline_active_bg");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_woo_checkout_timeline_active_bg">#hvc-checkout-timeline .active .timeline-wrapper { background-color: ' + to + '; } #hvc-checkout-timeline.arrow .active .timeline-wrapper:before{ border-top-color: ' + to + '; border-bottom-color: ' + to + '; } #hvc-checkout-timeline.arrow .active .timeline-wrapper:after{ border-left-color: ' + to + '; border-right-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_checkout_timeline_active_color", function($swipe) {
        $swipe.bind(function(size) {
            $("#hvc-checkout-timeline .active .timeline-wrapper").css("color", size);
        });
    }), api("havoc_onsale_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce span.onsale").css("background-color", size);
        });
    }), api("havoc_onsale_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce span.onsale").css("color", size);
        });
    }), api("havoc_outofstock_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product.outofstock .outofstock-badge").css("background-color", size);
        });
    }), api("havoc_outofstock_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product.outofstock .outofstock-badge").css("color", size);
        });
    }), api("havoc_stars_color_before", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_stars_color_before");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_stars_color_before">.woocommerce .star-rating:before{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_stars_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_stars_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_stars_color">.woocommerce .star-rating span, .woocommerce .star-rating span:before{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_quantity_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".quantity .qty, .quantity .minus, .quantity .plus").css("border-color", size);
        });
    }), api("havoc_quantity_border_color_focus", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_quantity_border_color_focus");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_quantity_border_color_focus">body .quantity .qty:focus{ border-color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_quantity_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".quantity .qty").css("color", size);
        });
    }), api("havoc_quantity_plus_minus_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".quantity .minus, .quantity .plus").css("color", size);
        });
    }), api("havoc_quantity_plus_minus_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_quantity_plus_minus_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_quantity_plus_minus_color_hover">.quantity .minus:hover, .quantity .plus:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_quantity_plus_minus_border_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_quantity_plus_minus_border_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_quantity_plus_minus_border_color_hover">.quantity .minus:hover, .quantity .plus:hover{ border-color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce .havocwp-toolbar").css("border-color", size);
        });
    }), api("havoc_toolbar_off_canvas_filter_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_off_canvas_filter_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_off_canvas_filter_color">.woocommerce .havocwp-off-canvas-filter { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_off_canvas_filter_border_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_off_canvas_filter_border_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_off_canvas_filter_border_color">.woocommerce .havocwp-off-canvas-filter { border-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_off_canvas_filter_hover_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_off_canvas_filter_hover_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_off_canvas_filter_hover_color">.woocommerce .havocwp-off-canvas-filter:hover { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_off_canvas_filter_hover_border_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_off_canvas_filter_hover_border_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_off_canvas_filter_hover_border_color">.woocommerce .havocwp-off-canvas-filter:hover { border-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_grid_list_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_grid_list_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_grid_list_color">.woocommerce .havocwp-grid-list a { color: ' + to + '; } .woocommerce .havocwp-grid-list a .hvc-icon use{ stroke: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_grid_list_border_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_grid_list_border_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_grid_list_border_color">.woocommerce .havocwp-grid-list a { border-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_grid_list_hover_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_grid_list_hover_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_grid_list_hover_color">.woocommerce .havocwp-grid-list a:hover { color: ' + to + "; border-color: " + to + '; } .woocommerce .havocwp-grid-list a:hover .hvc-icon use{ stroke: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_grid_list_active_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_grid_list_active_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_grid_list_active_color">.woocommerce .havocwp-grid-list a.active { color: ' + to + "; border-color: " + to + '; } .woocommerce .havocwp-grid-list a.active .hvc-icon use{ stroke: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_select_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_select_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_select_color">.woocommerce .woocommerce-ordering .theme-select,.woocommerce .woocommerce-ordering .theme-select:after { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_select_border_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_select_border_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_select_border_color">.woocommerce .woocommerce-ordering .theme-select,.woocommerce .woocommerce-ordering .theme-select:after { border-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_number_of_products_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_number_of_products_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_number_of_products_color">.woocommerce .result-count li.view-title,.woocommerce .result-count li a.active, .woocommerce .result-count li a:hover { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_number_of_products_inactive_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_number_of_products_inactive_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_number_of_products_inactive_color">.woocommerce .result-count li a { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_toolbar_number_of_products_border_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_toolbar_number_of_products_border_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_toolbar_number_of_products_border_color">.woocommerce .result-count li:after { color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_top_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_top_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_top_padding">.woocommerce .products .product-inner { padding-top: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_right_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_right_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_right_padding">.woocommerce .products .product-inner { padding-right: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_bottom_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_bottom_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_bottom_padding">.woocommerce .products .product-inner { padding-bottom: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_left_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_left_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_left_padding">.woocommerce .products .product-inner { padding-left: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_top_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_top_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_top_padding">@media (max-width: 768px){.woocommerce .products .product-inner { padding-top: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_right_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_right_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_right_padding">@media (max-width: 768px){.woocommerce .products .product-inner { padding-right: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_bottom_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_bottom_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_bottom_padding">@media (max-width: 768px){.woocommerce .products .product-inner { padding-bottom: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_left_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_left_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_left_padding">@media (max-width: 768px){.woocommerce .products .product-inner { padding-left: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_top_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_top_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_top_padding">@media (max-width: 480px){.woocommerce .products .product-inner { padding-top: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_right_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_right_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_right_padding">@media (max-width: 480px){.woocommerce .products .product-inner { padding-right: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_bottom_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_bottom_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_bottom_padding">@media (max-width: 480px){.woocommerce .products .product-inner { padding-bottom: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_left_padding", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_left_padding");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_left_padding">@media (max-width: 480px){.woocommerce .products .product-inner { padding-left: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_top_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_top_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_top_margin">.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-top: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_right_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_right_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_right_margin">.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-right: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_bottom_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_bottom_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_bottom_margin">.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-bottom: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_left_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_left_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_left_margin">.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-left: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_tablet_top_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_tablet_top_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_tablet_top_margin">@media (max-width: 768px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-top: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_tablet_right_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_tablet_right_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_tablet_right_margin">@media (max-width: 768px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-right: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_tablet_bottom_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_tablet_bottom_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_tablet_bottom_margin">@media (max-width: 768px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-bottom: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_tablet_left_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_tablet_left_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_tablet_left_margin">@media (max-width: 768px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-left: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_mobile_top_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_mobile_top_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_mobile_top_margin">@media (max-width: 480px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-top: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_mobile_right_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_mobile_right_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_mobile_right_margin">@media (max-width: 480px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-right: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_mobile_bottom_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_mobile_bottom_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_mobile_bottom_margin">@media (max-width: 480px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-bottom: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_image_mobile_left_margin", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_image_mobile_left_margin");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_image_mobile_left_margin">@media (max-width: 480px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap { margin-left: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_top_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_top_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_top_border_width">.woocommerce .products .product-inner { border-top-width: ' + to + "px; border-style: solid; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_right_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_right_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_right_border_width">.woocommerce .products .product-inner { border-right-width: ' + to + "px; border-style: solid; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_bottom_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_bottom_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_bottom_border_width">.woocommerce .products .product-inner { border-bottom-width: ' + to + "px; border-style: solid; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_left_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_left_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_left_border_width">.woocommerce .products .product-inner { border-left-width: ' + to + "px; border-style: solid; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_top_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_top_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_top_border_width">@media (max-width: 768px){.woocommerce .products .product-inner { border-top-width: ' + to + "px; border-style: solid; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_right_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_right_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_right_border_width">@media (max-width: 768px){.woocommerce .products .product-inner { border-right-width: ' + to + "px; border-style: solid; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_bottom_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_bottom_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_bottom_border_width">@media (max-width: 768px){.woocommerce .products .product-inner { border-bottom-width: ' + to + "px; border-style: solid; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_left_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_left_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_left_border_width">@media (max-width: 768px){.woocommerce .products .product-inner { border-left-width: ' + to + "px; border-style: solid; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_top_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_top_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_top_border_width">@media (max-width: 480px){.woocommerce .products .product-inner { border-top-width: ' + to + "px; border-style: solid; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_right_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_right_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_right_border_width">@media (max-width: 480px){.woocommerce .products .product-inner { border-right-width: ' + to + "px; border-style: solid; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_bottom_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_bottom_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_bottom_border_width">@media (max-width: 480px){.woocommerce .products .product-inner { border-bottom-width: ' + to + "px; border-style: solid; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_left_border_width", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_left_border_width");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_left_border_width">@media (max-width: 480px){.woocommerce .products .product-inner { border-left-width: ' + to + "px; border-style: solid; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_top_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_top_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_top_border_radius">.woocommerce .products .product-inner { border-top-left-radius: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_right_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_right_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_right_border_radius">.woocommerce .products .product-inner { border-top-right-radius: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_bottom_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_bottom_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_bottom_border_radius">.woocommerce .products .product-inner { border-bottom-right-radius: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_left_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_left_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_left_border_radius">.woocommerce .products .product-inner { border-bottom-left-radius: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_top_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_top_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_top_border_radius">@media (max-width: 768px){.woocommerce .products .product-inner { border-top-left-radius: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_right_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_right_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_right_border_radius">@media (max-width: 768px){.woocommerce .products .product-inner { border-top-right-radius: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_bottom_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_bottom_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_bottom_border_radius">@media (max-width: 768px){.woocommerce .products .product-inner { border-bottom-right-radius: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_tablet_left_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_tablet_left_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_tablet_left_border_radius">@media (max-width: 768px){.woocommerce .products .product-inner { border-bottom-left-radius: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_top_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_top_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_top_border_radius">@media (max-width: 480px){.woocommerce .products .product-inner { border-top-left-radius: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_right_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_right_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_right_border_radius">@media (max-width: 480px){.woocommerce .products .product-inner { border-top-right-radius: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_bottom_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_bottom_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_bottom_border_radius">@media (max-width: 480px){.woocommerce .products .product-inner { border-bottom-right-radius: ' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_mobile_left_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_mobile_left_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_mobile_left_border_radius">@media (max-width: 480px){.woocommerce .products .product-inner { border-bottom-left-radius:' + to + "px; }}</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_background_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce .products .product-inner, .woocommerce ul.products li.product .woo-product-info, .woocommerce ul.products li.product .woo-product-gallery").css("background-color", size);
        });
    }), api("havoc_product_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce .products .product-inner").css("border-color", size);
        });
    }), api("havoc_category_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product li.category, .woocommerce ul.products li.product li.category a").css("color", size);
        });
    }), api("havoc_category_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_category_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_category_color_hover">.woocommerce ul.products li.product li.category a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_title_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product li.title h2, .woocommerce ul.products li.product li.title a").css("color", size);
        });
    }), api("havoc_product_title_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_title_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_title_color_hover">.woocommerce ul.products li.product li.title a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_price_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product .price, .woocommerce ul.products li.product .price .amount").css("color", size);
        });
    }), api("havoc_product_entry_del_price_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product .price del .amount").css("color", size);
        });
    }), api("havoc_product_entry_cond_note_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product li.hvc-woo-cond-notice span, .woocommerce ul.products li.product li.hvc-woo-cond-notice a").css("color", size);
        });
    }), api("havoc_product_entry_cond_note_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_cond_note_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_cond_note_color_hover">.woocommerce ul.products li.product li.hvc-woo-cond-notice a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_thumbnails_border_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_thumbnails_border_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_thumbnails_border_color">.woocommerce ul.products li.product .woo-product-gallery .active a, .woocommerce ul.products li.product .woo-product-gallery a:hover{ border-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_quickview_background", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_quickview_background");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_quickview_background">.woocommerce ul.products li.product .woo-entry-buttons li a.hvc-quick-view{ background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_quickview_hover_background", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_quickview_hover_background");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_quickview_hover_background">.woocommerce ul.products li.product .woo-entry-buttons li a.hvc-quick-view:hover{ background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_quickview_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_quickview_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_quickview_color">.woocommerce ul.products li.product .woo-entry-buttons li a.hvc-quick-view{ color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_quickview_hover_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_quickview_hover_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_quickview_hover_color">.woocommerce ul.products li.product .woo-entry-buttons li a.hvc-quick-view:hover{ color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_wishlist_background", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_wishlist_background");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_wishlist_background">.woocommerce ul.products li.product .woo-entry-buttons li a.tinvwl_add_to_wishlist_button{ background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_wishlist_hover_background", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_wishlist_hover_background");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_wishlist_hover_background">.woocommerce ul.products li.product .woo-entry-buttons li a.tinvwl_add_to_wishlist_button:hover{ background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_wishlist_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_wishlist_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_wishlist_color">.woocommerce ul.products li.product .woo-entry-buttons li a.tinvwl_add_to_wishlist_button{ color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_hover_wishlist_hover_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_hover_wishlist_hover_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_hover_wishlist_hover_color">.woocommerce ul.products li.product .woo-entry-buttons li a.tinvwl_add_to_wishlist_button:hover{ color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_addtocart_bg_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart").css("background-color", size);
        });
    }), api("havoc_product_entry_addtocart_bg_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_addtocart_bg_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_addtocart_bg_color_hover">.woocommerce ul.products li.product .button:hover,.woocommerce ul.products li.product .product-inner .added_to_cart:hover{ background-color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_addtocart_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart").css("color", size);
        });
    }), api("havoc_product_entry_addtocart_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_addtocart_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_addtocart_color_hover">.woocommerce ul.products li.product .button:hover,.woocommerce ul.products li.product .product-inner .added_to_cart:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_product_entry_addtocart_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart").css("border-color", size);
        });
    }), api("havoc_product_entry_addtocart_border_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_product_entry_addtocart_border_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_product_entry_addtocart_border_color_hover">.woocommerce ul.products li.product .button:hover,.woocommerce ul.products li.product .product-inner .added_to_cart:hover{ border-color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_product_entry_addtocart_border_style', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_product_entry_addtocart_border_style');
            if (to) {
                var style = '<style class="customizer-havoc_product_entry_addtocart_border_style">.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{border-style:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_product_entry_addtocart_border_size', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_product_entry_addtocart_border_size');
            if (to) {
                var style = '<style class="customizer-havoc_product_entry_addtocart_border_size">.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{border-width:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_product_entry_addtocart_border_radius', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_product_entry_addtocart_border_radius');
            if (to) {
                var style = '<style class="customizer-havoc_product_entry_addtocart_border_radius">.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{border-radius:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_woo_quick_view_button_bg', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_woo_quick_view_button_bg');
            if (to) {
                var style = '<style class="customizer-havoc_woo_quick_view_button_bg">.hvc-quick-view{background-color:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_woo_quick_view_button_hover_bg', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_woo_quick_view_button_hover_bg');
            if (to) {
                var style = '<style class="customizer-havoc_woo_quick_view_button_hover_bg">.hvc-quick-view:hover{background-color:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_woo_quick_view_button_color', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_woo_quick_view_button_color');
            if (to) {
                var style = '<style class="customizer-havoc_woo_quick_view_button_color">.hvc-quick-view{color:' + to + ';} .hvc-quick-view .hvc-icon use{stroke:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_woo_quick_view_button_hover_color', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_woo_quick_view_button_hover_color');
            if (to) {
                var style = '<style class="customizer-havoc_woo_quick_view_button_hover_color">.hvc-quick-view:hover{color:' + to + ';} .hvc-quick-view:hover .hvc-icon use{stroke:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_woo_quick_view_overlay_bg', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_woo_quick_view_overlay_bg');
            if (to) {
                var style = '<style class="customizer-havoc_woo_quick_view_overlay_bg">.image-wrap.loading:after{background-color:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_woo_quick_view_overlay_spinner_outside_color', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_woo_quick_view_overlay_spinner_outside_color');
            if (to) {
                var style = '<style class="customizer-havoc_woo_quick_view_overlay_spinner_outside_color">.image-wrap.loading:before{border-color:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_woo_quick_view_overlay_spinner_inner_color', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_woo_quick_view_overlay_spinner_inner_color');
            if (to) {
                var style = '<style class="customizer-havoc_woo_quick_view_overlay_spinner_inner_color">.image-wrap.loading:before{border-left-color:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_woo_quick_view_modal_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".hvc-qv-content-inner").css("background-color", size);
        });
    }), api("havoc_woo_quick_view_modal_close_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".hvc-qv-content-inner .hvc-qv-close").css("color", size);
        });
    }), api("havoc_woo_off_canvas_sidebar_bg", function($swipe) {
        $swipe.bind(function(size) {
            $("#havocwp-off-canvas-sidebar-wrap .havocwp-off-canvas-sidebar").css("background-color", size);
        });
    }), api("havoc_woo_off_canvas_sidebar_widgets_border", function($swipe) {
        $swipe.bind(function(size) {
            $("#havocwp-off-canvas-sidebar-wrap .sidebar-box").css("border-color", size);
        });
    }), api("havoc_single_product_title_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product .product_title").css("color", size);
        });
    }), api("havoc_single_product_price_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".price,.amount").css("color", size);
        });
    }), api("havoc_single_product_del_price_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".price del,del .amount").css("color", size);
        });
    }), api("havoc_single_product_description_color", function($swipe) {
        $swipe.bind(function(size) {
            $('.woocommerce div.product div[itemprop="description"]').css("color", size);
        });
    }), api("havoc_single_product_meta_title_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".product_meta .posted_in,.product_meta .tagged_as").css("color", size);
        });
    }), api("havoc_single_product_meta_link_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".product_meta .posted_in a, .product_meta .tagged_as a").css("color", size);
        });
    }), api("havoc_single_product_meta_link_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_meta_link_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_meta_link_color_hover">.product_meta .posted_in a:hover,.product_meta .tagged_as a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_cond_note_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.hvc-woo-single-cond-notice span, .woocommerce div.hvc-woo-single-cond-notice a").css("color", size);
        });
    }), api("havoc_single_cond_note_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_cond_note_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_cond_note_color_hover">.woocommerce div.hvc-woo-single-cond-notice a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_open_image_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product div.images .open-image").css("color", size);
        });
    }), api("havoc_single_product_open_image_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product div.images .open-image").css("border-color", size);
        });
    }), api("havoc_single_product_navigation_border_radius", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_navigation_border_radius");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_navigation_border_radius">.hvc-product-nav li a.hvc-nav-link{ -webkit-border-radius: ' + to + 'px; -moz-border-radius: ' + to + 'px; -ms-border-radius: ' + to + 'px; border-radius: ' + to + "px; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_navigation_bg", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_navigation_bg");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_navigation_bg">.hvc-product-nav li a.hvc-nav-link{ background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_navigation_hover_bg", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_navigation_hover_bg");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_navigation_hover_bg">.hvc-product-nav li a.hvc-nav-link:hover{ background-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }),api("havoc_single_product_navigation_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_navigation_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_navigation_color">.hvc-product-nav li a.hvc-nav-link{ color: ' + to + '; } .hvc-product-nav li a.hvc-nav-link .hvc-icon use{ stroke: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_navigation_hover_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_navigation_hover_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_navigation_hover_color">.hvc-product-nav li a.hvc-nav-link:hover{ color: ' + to + '; } .hvc-product-nav li a.hvc-nav-link:hover .hvc-icon use{ stroke: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_navigation_border_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_navigation_border_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_navigation_border_color">.hvc-product-nav li a.hvc-nav-link{ border-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_navigation_hover_border_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_navigation_hover_border_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_navigation_hover_border_color">.hvc-product-nav li a.hvc-nav-link:hover{ border-color: ' + to + "; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_addtocart_bg_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product div.summary button.single_add_to_cart_button").css("background-color", size);
        });
    }), api("havoc_single_product_addtocart_bg_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_addtocart_bg_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_addtocart_bg_color_hover">.woocommerce div.product div.summary button.single_add_to_cart_button:hover{ background-color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_addtocart_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product div.summary button.single_add_to_cart_button").css("color", size);
        });
    }), api("havoc_single_product_addtocart_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_addtocart_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_addtocart_color_hover">.woocommerce div.product div.summary button.single_add_to_cart_button:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_addtocart_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product div.summary button.single_add_to_cart_button").css("border-color", size);
        });
    }), api("havoc_single_product_addtocart_border_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_addtocart_border_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_addtocart_border_color_hover">.woocommerce div.product div.summary button.single_add_to_cart_button:hover{ border-color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_single_product_addtocart_border_style', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_single_product_addtocart_border_style');
            if (to) {
                var style = '<style class="customizer-havoc_single_product_addtocart_border_style">.woocommerce div.product div.summary button.single_add_to_cart_button{border-style:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_single_product_addtocart_border_size', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_single_product_addtocart_border_size');
            if (to) {
                var style = '<style class="customizer-havoc_single_product_addtocart_border_size">.woocommerce div.product div.summary button.single_add_to_cart_button{border-width:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api('havoc_single_product_addtocart_border_radius', function(value) {
        value.bind(function(to) {
            var $child = $('.customizer-havoc_single_product_addtocart_border_radius');
            if (to) {
                var style = '<style class="customizer-havoc_single_product_addtocart_border_radius">.woocommerce div.product div.summary button.single_add_to_cart_button{border-radius:' + to + ';}</style>';
                if ($child.length) {
                    $child.replaceWith(style);
                } else {
                    $('head').append(style);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_tabs_borders_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product .woocommerce-tabs ul.tabs").css("border-color", size);
        });
    }), api("havoc_single_product_tabs_text_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product .woocommerce-tabs ul.tabs li a").css("color", size);
        });
    }), api("havoc_single_product_tabs_text_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_single_product_tabs_text_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_single_product_tabs_text_color_hover">.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_single_product_tabs_active_text_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product .woocommerce-tabs ul.tabs li.active a").css("color", size);
        });
    }), api("havoc_single_product_tabs_active_text_borders_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product .woocommerce-tabs ul.tabs li.active a").css("border-color", size);
        });
    }), api("havoc_single_product_tabs_product_description_title_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product .woocommerce-tabs .panel h2").css("color", size);
        });
    }), api("havoc_single_product_tabs_product_description_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce div.product .woocommerce-tabs .panel p").css("color", size);
        });
    }), api("havoc_account_navigation_borders_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-MyAccount-navigation ul,.woocommerce-MyAccount-navigation ul li").css("border-color", size);
        });
    }), api("havoc_account_navigation_icons_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_account_navigation_icons_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_account_navigation_icons_color">.woocommerce-MyAccount-navigation ul li a:before{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_account_navigation_links_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-MyAccount-navigation ul li a").css("color", size);
        });
    }), api("havoc_account_navigation_links_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_account_navigation_links_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_account_navigation_links_color_hover">.woocommerce-MyAccount-navigation ul li a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_account_addresses_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-MyAccount-content .addresses .woocommerce-Address .title, .woocommerce-MyAccount-content .addresses .woocommerce-Address address").css("background-color", size);
        });
    }), api("havoc_account_addresses_title_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-MyAccount-content .addresses .woocommerce-Address .title h3").css("color", size);
        });
    }), api("havoc_account_addresses_title_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-MyAccount-content .addresses .woocommerce-Address .title").css("border-color", size);
        });
    }), api("havoc_account_addresses_button_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-MyAccount-content .addresses .woocommerce-Address .title a").css("background-color", size);
        });
    }), api("havoc_account_addresses_button_bg_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_account_addresses_button_bg_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_account_addresses_button_bg_hover">.woocommerce-MyAccount-content .addresses .woocommerce-Address .title a:hover{ background-color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_account_addresses_button_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-MyAccount-content .addresses .woocommerce-Address .title a").css("color", size);
        });
    }), api("havoc_account_addresses_button_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_account_addresses_button_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_account_addresses_button_color_hover">.woocommerce-MyAccount-content .addresses .woocommerce-Address .title a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_account_addresses_content_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-MyAccount-content .addresses .woocommerce-Address address").css("color", size);
        });
    }), api("havoc_cart_borders_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-cart table.shop_table,.woocommerce-cart table.shop_table th,.woocommerce-cart table.shop_table td,.woocommerce-cart .cart-collaterals .cross-sells,.woocommerce-page .cart-collaterals .cross-sells,.woocommerce-cart .cart-collaterals h2,.woocommerce-cart .cart-collaterals .cart_totals,.woocommerce-page .cart-collaterals .cart_totals,.woocommerce-cart .cart-collaterals .cart_totals table th,.woocommerce-cart .cart-collaterals .cart_totals .order-total th,.woocommerce-cart table.shop_table td,.woocommerce-cart .cart-collaterals .cart_totals tr td,.woocommerce-cart .cart-collaterals .cart_totals .order-total td").css("border-color",
                size);
        });
    }), api("havoc_cart_head_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-cart table.shop_table thead,.woocommerce-cart .cart-collaterals h2").css("background-color", size);
        });
    }), api("havoc_cart_head_titles_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-cart table.shop_table thead th,.woocommerce-cart .cart-collaterals h2").css("color", size);
        });
    }), api("havoc_cart_totals_table_titles_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-cart .cart-collaterals .cart_totals table th").css("color", size);
        });
    }), api("havoc_cart_remove_button_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce table.shop_table a.remove").css("color", size);
        });
    }), api("havoc_cart_remove_button_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_cart_remove_button_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_cart_remove_button_color_hover">.woocommerce table.shop_table a.remove:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_checkout_notices_borders_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout .woocommerce-info").css("border-color", size);
        });
    }), api("havoc_checkout_notices_icon_color", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_checkout_notices_icon_color");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_checkout_notices_icon_color">.woocommerce-checkout .woocommerce-info:before{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_checkout_notices_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout .woocommerce-info").css("color", size);
        });
    }), api("havoc_checkout_notices_link_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout .woocommerce-info a").css("color", size);
        });
    }), api("havoc_checkout_notices_link_color_hover", function($swipe) {
        $swipe.bind(function(to) {
            var $child = $(".customizer-havoc_checkout_notices_link_color_hover");
            if (to) {
                /** @type {string} */
                var img = '<style class="customizer-havoc_checkout_notices_link_color_hover">.woocommerce-checkout .woocommerce-info a:hover{ color: ' + to + "!important; }</style>";
                if ($child.length) {
                    $child.replaceWith(img);
                } else {
                    $("head").append(img);
                }
            } else {
                $child.remove();
            }
        });
    }), api("havoc_checkout_notices_form_border_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout form.login,.woocommerce-checkout form.checkout_coupon").css("border-color", size);
        });
    }), api("havoc_checkout_titles_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce .woocommerce-checkout #customer_details h3,.woocommerce .woocommerce-checkout h3#order_review_heading").css("color", size);
        });
    }), api("havoc_checkout_titles_border_bottom_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce .woocommerce-checkout #customer_details h3,.woocommerce .woocommerce-checkout h3#order_review_heading").css("border-color", size);
        });
    }), api("havoc_checkout_table_main_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce table.shop_table thead,.woocommerce-checkout-review-order-table tfoot th").css("background-color", size);
        });
    }), api("havoc_checkout_table_titles_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout table.shop_table thead th,.woocommerce-checkout table.shop_table tfoot th").css("color", size);
        });
    }), api("havoc_checkout_table_borders_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout table.shop_table,.woocommerce-checkout table.shop_table th,.woocommerce-checkout table.shop_table td,.woocommerce-checkout table.shop_table tfoot th,.woocommerce-checkout table.shop_table tfoot td").css("border-color", size);
        });
    }), api("havoc_checkout_payment_methods_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout #payment").css("background-color", size);
        });
    }), api("havoc_checkout_payment_methods_borders_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout #payment,.woocommerce-checkout #payment ul.payment_methods").css("border-color", size);
        });
    }), api("havoc_checkout_payment_box_bg", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout #payment div.payment_box").css("background-color", size);
        });
    }), api("havoc_checkout_payment_box_color", function($swipe) {
        $swipe.bind(function(size) {
            $(".woocommerce-checkout #payment div.payment_box").css("color", size);
        });
    });

} )( jQuery );