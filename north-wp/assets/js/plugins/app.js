(function ($, window,_) {
	'use strict';
    
	var $doc = $(document),
			win = $(window),
			body = $('body'),
			adminbar = $('#wpadminbar'),
			thb_ease = new BezierEasing(0.25,0.46,0.45,0.94),
			thb_md = new MobileDetect(window.navigator.userAgent);

	var SITE = SITE || {};
	
	SITE = {
		init: function() {
			var self = this,
					obj;
			
			win.on('resize', _.debounce(function() {
				$('.page-padding').css({
					'paddingTop': $('header').outerHeight() + $('.thb-global-notification').outerHeight()
				});
			}, 10)).trigger('resize');
			
			for (obj in self) {
				if ( self.hasOwnProperty(obj)) {
					var _method =  self[obj];
					if ( _method.selector !== undefined && _method.init !== undefined ) {
						if ( $(_method.selector).length > 0 ) {
							_method.init();
						}
					}
				}
			}
		},
		headRoom: {
			selector: '.header',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				win.scroll(function(){
					base.scroll(container);
				});
			},
			scroll: function (container) {
				var animationOffset = 0,
						wOffset = win.scrollTop(),
						stick = 'hover',
						unstick = 'unhover';
						
				if (wOffset > animationOffset) {
					container.removeClass(unstick);
					if (!container.hasClass(stick)) {
						setTimeout(function () {
							container.addClass(stick);
						}, 10);
					}
				} else if ((wOffset < animationOffset && (wOffset > 0))) {
					if(container.hasClass(stick)) {
						container.removeClass(stick);
						container.addClass(unstick);
					}
				} else {
					container.removeClass(stick);
					container.removeClass(unstick);
				}
			}
			
		},
		globalNotification: {
			selector: '.thb-global-notification',
			init: function() {
				var base = this,
						container = $(base.selector),
						close = $('.thb-notification-close', container),
						header = $('.header');
				
				function adjustMargin() {
					header.css({
						marginTop: container.outerHeight() + 'px'
					});
				}
				win.on('resize', adjustMargin).trigger('resize');
				
				close.on('click', function() {
					container.slideUp('400', function() {
						container.remove();
						header.css({
							marginTop: 0
						});
						$.cookie('thb-global-notification', '1', { expires: 1, path: '/' });
						win.off('resize', adjustMargin);
						win.trigger('resize');
					});
				});
			}
		},
		responsiveNav: {
			selector: '#wrapper',
			init: function() {
				var base = this,
					container = $(base.selector),
					cc = $('.click-capture'),
					menu = $('#mobile-menu'),
					filters = $('#side-filters'),
					cart = $('#side-cart'),
					quick_shop = $('#quick-shop'),
					cc_close = $('.thb-close'),
					children = menu.find('.mobile-menu>li'),
					menu_items = menu.find('.mobile-menu>li,.mobile-secondary-menu>li, .social-links, .thb-close'),
					span = menu.find('.mobile-menu li:has(".sub-menu")>a span'),
					tlMainNav = new TimelineLite({ paused: true, onStart: function() { container.addClass('open-menu'); }, onReverseComplete: function() {container.removeClass('open-menu'); } }),
					tlCartNav = new TimelineLite({ paused: true, onStart: function() { container.addClass('open-cart'); }, onReverseComplete: function() {container.removeClass('open-cart'); } }),
					tlQuickNav = new TimelineLite({ paused: true, onStart: function() { container.addClass('open-quick'); }, onReverseComplete: function() {container.removeClass('open-quick'); } }),
					tlFilterNav = new TimelineLite({ paused: true, onStart: function() { container.addClass('open-filters'); }, onReverseComplete: function() {container.removeClass('open-filters'); } });
				
				tlMainNav
					.staggerFromTo(menu_items, 0.25, { delay: 0.25, x: "-30", opacity:0, ease: thb_ease}, { delay: 0.25, x: "0", opacity:1}, 0.05);
					
				tlCartNav
					.staggerFrom($('#side-cart').find('.item'), 0.25, { delay: 0.25, x: "30", opacity:0, ease: thb_ease}, 0.05);
					
				tlQuickNav
					.staggerFrom(quick_shop.find('.item'), 0.25, { delay: 0.25, x: "30", opacity:0, ease: thb_ease}, 0.05);
				
				tlFilterNav
					.staggerFrom(filters.find('.widget'), 0.25, { delay: 0.25, x: "30", opacity:0, ease: thb_ease}, 0.05);
				
				$('.header').on('click', '.mobile-toggle', function() {
					tlMainNav.play();
					return false;
				});
				$('#wrapper').on('click', '.quick-shop', function() {
					tlQuickNav.play();
					return false;
				});
				$('.header').on('click', '#quick_cart', function() {
					if (themeajax.settings.is_cart || themeajax.settings.is_checkout) {
						return true
					} else {
						tlCartNav.play();
						SITE.customScroll.init();			
						return false;
					}
				});
				container.on('click', '#thb-shop-filters', function() {
					tlFilterNav.play();
					return false;
				});
				
				cc.add(cc_close).on('click', function() {
					tlMainNav.reverse();
					tlCartNav.reverse();
					tlQuickNav.reverse();
					tlFilterNav.reverse();
					return false;
				});
				body.on('wc_fragments_refreshed added_to_cart', function() {
					$('.thb-close').on('click', function() {
						tlCartNav.reverse();
						tlFilterNav.reverse();
						return false;
					});
				});
				span.on('click', function(e){
					var that = $(this),
							parent = that.parents('a'),
							menu = parent.next('.sub-menu');
					
					if (parent.hasClass('active')) {
						menu.slideUp('200', function() {
							parent.removeClass('active');
						});
					} else {
						menu.slideDown('200', function() {
							parent.addClass('active');
						});
					}
					e.stopPropagation();
					e.preventDefault();
				});
				
			}
		},
		updateCart: {
			selector: '#quick_cart',
			init: function() {
				var base = this,
					container = $(base.selector);
				body.bind('wc_fragments_refreshed added_to_cart', SITE.updateCart.update_cart_dropdown);
			},
			update_cart_dropdown: function(event) {
				if (event.type === 'added_to_cart') {
					$('#quick_cart').trigger('click');
				}
			}
		},
		fullMenu: {
			selector: '.thb-full-menu',
			init: function() {
				var base = this,
					container = $(base.selector),
					li_org = container.find('a'),
					children = container.find('li.menu-item-has-children:not(.menu-item-mega-parent)'),
					mega_menu = container.find('li.menu-item-has-children.menu-item-mega-parent');

				children.each(function() {
					var _this = $(this),
							menu = _this.find('>.sub-menu'),
							li = menu.find('>li>a'),
							tl = new TimelineMax({paused: true});

					tl
						.to(menu, 0.5, {autoAlpha: 1 }, "start")
						.staggerTo(li, 0.1, {opacity: 1, x: 0 }, 0.03, "start");
						
					_this.hoverIntent(
						function() {
							_this.addClass('sfHover');
							tl.timeScale(1).restart();
						},
						function() {
							_this.removeClass('sfHover');
							tl.timeScale(1.5).reverse();
						}
					);
				});
				mega_menu.each(function() {
					var _this = $(this),
							menu = _this.find('>.sub-menu'),
							li = menu.find('>li>a, .menu-item-mega-link>a'),
							tl = new TimelineMax({paused: true});

					tl
						.fromTo(menu, 0.5, {autoAlpha: 0, display: 'none' }, {autoAlpha: 1, display: 'flex' }, "start")
						.staggerTo(li, 0.1, {opacity: 1, x: 0 }, 0.02, "start");
						
					_this.hoverIntent(
						function() {
							_this.addClass('sfHover');
							tl.timeScale(1).restart();
						},
						function() {
							_this.removeClass('sfHover');
							tl.timeScale(1.5).reverse();
						}
					);
				});
				li_org.on('click', function(e){
					var _this = $(this),
						url = _this.attr('href'),
						ah = $('#wpadminbar').outerHeight(),
						fh = $('.header').outerHeight(),
						hash = url.indexOf("#") !== -1 ? url.substring(url.indexOf("#")+1) : '',
						pos = hash ? $('#'+hash).offset().top - ah - fh : 0;
					if (hash) {
						pos = (hash === 'footer') ? "max" : pos;
						TweenMax.to(win, 1, { scrollTo:{y:pos} });
						return false;
					} else {
						return true;	
					}
				});
			}
		},
		carousel: {
			selector: '.slick',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector);
				
				container.each(function() {
					var that = $(this),
						columns = that.data('columns'),
						navigation = (that.data('navigation') === true ? true : false),
						autoplay = (that.data('autoplay') === false ? false : true),
						pagination = (that.data('pagination') === true ? true : false),
						center = (that.data('center') ? that.data('center') : false),
						disablepadding = (that.data('disablepadding') ? that.data('disablepadding') : false),
						vertical = (that.data('vertical') === true ? true : false),
						asNavFor = that.data('asnavfor'),
						rtl = body.hasClass('rtl');
					
					var args = {
						dots: pagination,
						arrows: navigation,
						infinite: false,
						speed: 1000,
						centerMode: false,
						slidesToShow: columns,
						slidesToScroll: 1,
						rtl: rtl,
						autoplay: autoplay,
						centerPadding: (disablepadding ? 0 : '50px'),
						autoplaySpeed: 4000,
						pauseOnHover: true,
						vertical: vertical,
						verticalSwiping: vertical,
						focusOnSelect: true,
						prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="slick-nav thb-prev" x="0" y="0" width="50" height="40" viewBox="0 0 50 40" enable-background="new 0 0 50 40" xml:space="preserve"><path class="border" fill-rule="evenodd" clip-rule="evenodd" d="M0 0v40h50V0H0zM48 38H2V2h46V38z"/><path d="M15.3 19.2c0 0 0 0-0.1 0.1 0 0 0 0 0 0 0 0 0 0 0 0 -0.1 0.2-0.2 0.4-0.2 0.7 0 0.2 0.1 0.5 0.2 0.7 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0.1l3.8 3.9c0.4 0.4 1.1 0.4 1.5 0 0.4-0.4 0.4-1.1 0-1.6l-2-2h15.3c0.6 0 1.1-0.5 1.1-1.1 0-0.6-0.5-1.1-1.1-1.1H18.6l2-2c0.4-0.4 0.4-1.1 0-1.6 -0.4-0.4-1.1-0.4-1.5 0l-3.8 3.9C15.3 19.2 15.3 19.2 15.3 19.2z"/></svg>',
						nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="slick-nav thb-next" x="0" y="0" width="50" height="40" viewBox="0 0 50 40" enable-background="new 0 0 50 40" xml:space="preserve"><path class="border" fill-rule="evenodd" clip-rule="evenodd" d="M0 0v40h50V0H0zM2 2h46v36H2V2z"/><path d="M34.7 19.2L30.9 15.3c-0.4-0.4-1.1-0.4-1.5 0 -0.4 0.4-0.4 1.1 0 1.6l2 2H16.1c-0.6 0-1.1 0.5-1.1 1.1 0 0.6 0.5 1.1 1.1 1.1h15.3l-2 2c-0.4 0.4-0.4 1.1 0 1.6 0.4 0.4 1.1 0.4 1.5 0l3.8-3.9c0 0 0 0 0.1-0.1 0 0 0 0 0 0 0 0 0 0 0 0 0.1-0.2 0.2-0.4 0.2-0.7 0-0.2-0.1-0.5-0.2-0.7 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0-0.1-0.1C34.7 19.2 34.7 19.2 34.7 19.2z"/></svg>',
						responsive: [
							{
								breakpoint: 1441,
								settings: {
									slidesToShow: (columns < 6 ? columns : (vertical ? columns-1 :6)),
									centerPadding: (disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 1201,
								settings: {
									slidesToShow: (columns < 4 ? columns : (vertical ? columns-1 :4)),
									centerPadding: (disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 1025,
								settings: {
									slidesToShow: (columns < 3 ? columns : (vertical ? columns-1 :3)),
									centerPadding: (disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 641,
								settings: {
									slidesToShow: 1,
									centerPadding: (disablepadding ? 0 : '15px')
								}
							}
						]
					};
					if (asNavFor && $(asNavFor).is(':visible')) {
						args.asNavFor = asNavFor;	
					}
					if (that.data('fade')) {
						args.fade = true;
					}
					if (that.hasClass('product-thumbnails')) {
						args.vertical = true;
						args.responsive[2].settings.vertical = false;
						args.responsive[2].settings.slidesToShow = 4;
						args.responsive[3].settings.vertical = false;
						args.responsive[3].settings.slidesToShow = 4;
					}
					
					that.slick(args);
				});
			}
		},
		masonry: {
			selector: '.masonry',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				Outlayer.prototype._setContainerMeasure = function( measure, isWidth ) {
				  if ( measure === undefined ) {
				    return;
				  }
				  var elemSize = this.size;
				  // add padding and border width if border box
				  if ( elemSize.isBorderBox ) {
				    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
				      elemSize.borderLeftWidth + elemSize.borderRightWidth :
				      elemSize.paddingBottom + elemSize.paddingTop +
				      elemSize.borderTopWidth + elemSize.borderBottomWidth;
				  }
				
				  measure = Math.max( measure, 0 );
				  measure = Math.floor( measure );
				  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
				};
				container.each(function() {
					var _this = $(this),
							layoutMode = _this.data('layoutmode') ? _this.data('layoutmode') : 'masonry';
					
					_this.imagesLoaded( function() {
						_this.isotope({
							layoutMode: layoutMode,
							itemSelector : '.item',
							transitionDuration : '0.5s',
							stagger: 150,
							masonry: {
								columnWidth: '.item'
							},
							hiddenStyle: {
						    opacity: 0,
						    transform: 'translateY(30px)'
						  },
						  visibleStyle: {
						    opacity: 1,
						    transform: 'translateY(0px)'
						  }
						});
					});
				});
			}
		},
		customScroll: {
			selector: '.custom_scroll, #side-cart .woocommerce-mini-cart',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.each(function() {
					var that = $(this);
					that.perfectScrollbar({
						wheelPropagation: false,
						suppressScrollX: true
					});
				});
				
				win.resize(function() {
					base.resize(container);
				});
			},
			resize: function(container) {
				container.perfectScrollbar('update');
			}
		},
		videoPlayButton: {
			selector: '.thb_video_play_button_enabled',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.each(function() {
					var _this = $(this),
							button = _this.find('.thb_video_play'),
							icon = $('svg', button),
							instance = _this.data("vide"),
							video = instance.getVideoObject();
					  
					  
				 		button.on('click', function() {
				 			if (video) {
				 				if (video.paused) {
				 					video.play();
				 					icon.addClass('playing');
				 				} else { 
				 				  video.pause();
				 					icon.removeClass('playing');
				 				}
				 			}
				 			return false;
				 		});
				});
			}
		},
		quickShopCategories: {
			selector: '#thb-quick-shop-categories',
			init: function() {
				var base = this,
					container = $(base.selector),
					product_container = $('.product_container', '#quick-shop'),
					ul = product_container.find('.products');
				
				container.on('change', function() {
					var _this = $(this);
					
					$.ajax( themeajax.url, {
						method : 'POST',
						data : {
							action: 'thb_quick_shop_ajax',
							term_slug: _this.val()
						},
						beforeSend: function() {
							product_container.addClass('thb-loading');
						},
						success : function(data) {
							product_container.removeClass('thb-loading');
							var d = $.parseHTML($.trim(data)),
									products = $(d);
							
							TweenMax.set(products, {opacity: 0, y:30});
							ul.html(products);
							
							TweenMax.staggerTo(products, 0.5, { y: 0, opacity:1 }, 0.25);
							product_container.perfectScrollbar('update');
						}
					});
				});
			}
		},
		wpml: {
			selector: '#thb_language_selector, #category-selection',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.on('change', function () {
				var url = $(this).val(); // get selected value
					if (url) { // require a URL
						window.location = url; // redirect
					}
					return false;
				});
			}
		},
		loginForm: {
			selector: '.thb-overflow-container',
			init: function() {
				var base = this,
						container = $(base.selector),
						ul = $('ul', container),
						links = $('a', ul);
				
				links.on('click', function() {
					var _this = $(this);
					if (!_this.hasClass('active')) {
						links.removeClass('active');
						_this.addClass('active');
						
						$('.thb-form-container', container).toggleClass('register-active');
					}
					return false;
				});
			}
		},
		shop: {
			selector: '.products .product',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var that = $(this);
					
					that
					.find('.add_to_cart_button').on('click', function() {
						if ($(this).data('added-text') !== '') {
							$(this).text($(this).data('added-text'));
						}
					});
					
				}); // each
	
			}
		},
		variations: {
			selector: 'form.variations_form',
			init: function() {
				var base = this,
					container = $(base.selector),
					slider = $('#product-images'),
					thumbnails = $('#product-thumbnails'),
					org_image = $('.first img', slider).attr('src'),
					org_thumb = $('.first img', thumbnails).attr('src'),
					price_container = $('p.price', '.product-information').eq(0),
					org_price = price_container.html();
				
				container.on("show_variation", function(e, variation) {
					price_container.html(variation.price_html);
					if (variation.hasOwnProperty("image") && variation.image.src) {
						$('.first img', slider).attr("src", variation.image.src).attr("srcset", "");
						$('.first img', thumbnails).attr("src", variation.image.thumb_src).attr("srcset", "");
						
						if (slider.hasClass('slick-initialized')) {
							slider.slick('slickGoTo', 0);	
						}
					}
				}).on('reset_image', function () {
					price_container.html(org_price);
					$('.first img', slider).attr("src", org_image).attr("srcset", "");
					$('.first img', thumbnails).attr("src", org_thumb).attr("srcset", "");
				});
			}
		},
		quantity: {
			selector: '.quantity',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				// Quantity buttons
				$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<span class="plus">+</span>' ).prepend( '<span class="minus">-</span>' );
				$('.plus, .minus').on('click', function() {
					// Get values
					var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
						currentVal	= parseFloat( $qty.val() ),
						max			= parseFloat( $qty.attr( 'max' ) ),
						min			= parseFloat( $qty.attr( 'min' ) ),
						step		= $qty.attr( 'step' );
			
					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) { currentVal = 0; }
					if ( max === '' || max === 'NaN' ) { max = ''; }
					if ( min === '' || min === 'NaN' ) { min = 0; }
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) { step = 1; }
			
					// Change the value
					if ( $( this ).is( '.plus' ) ) {
			
						if ( max && ( max === currentVal || currentVal > max ) ) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}
			
					} else {
			
						if ( min && ( min === currentVal || currentVal < min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( currentVal - parseFloat( step ) );
						}
			
					}
			
					// Trigger change event
					$qty.trigger( 'change' );
					return false;
				});
			}	
		},
		fixedMe: {
			selector: '.thb-fixed, .thb-product-style2 .summary, .thb-product-style4 .summary, .thb-product-style5 .summary',
			init: function(el) {
				var base = this,
						container = el ? el : $(base.selector),
						ah = adminbar.outerHeight() + $('.header').outerHeight();
				
				if (!thb_md.mobile()) {
					container.each(function() {
						var _this = $(this);
						
						_this.stick_in_parent({
							offset_top: ah,
							spacer: '.sticky-content-spacer',
							recalc_every: 50
						});
					});
					
					$('.product-images').imagesLoaded(function() {
						$(document.body).trigger("sticky_kit:recalc");
					});
					win.on('resize', _.debounce(function(){
						$(document.body).trigger("sticky_kit:recalc");
					}, 30));
				}
			}
		},
		autoComplete: {
			selector: '#searchpopup .woocommerce-product-search',
			init: function() {
				var base = this,
						container = $(base.selector),
						field = $('.search-field', container);
				
				field.autocomplete({
					minChars: 3,
					appendTo: $('.autocomplete-wrapper', container),
					containerClass: 'product_list_widget',
					triggerSelectOnValidInput: false,
					serviceUrl: themeajax.url + '?action=thb_ajax_search_products',
					onSearchStart: function() {
						container.addClass('thb-loading');
					},
					formatResult: function(suggestion, currentValue) {
						return '<a href="'+suggestion.url+'">'+suggestion.thumbnail+'<span class="product-title">'+suggestion.value+'</span></a>'+suggestion.price;
					},
					onSelect: function(suggestion) {
						if (suggestion.id !== -1) {
							window.location.href = suggestion.url;
						}
					},
					onSearchComplete: function (query, suggestions) {
						container.removeClass('thb-loading');
					}
				});
	
			}
		},
		retinaJS: {
			selector: 'img.retina_size',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.attr('width', function() {
					var w = $(this).attr('width') / 2;	
					
					return w;
				});

			}
		},
		magnificImage: {
			selector: '[rel="magnific"]',
			init: function() {
				var base = this,
						container = $(base.selector),
						stype;
				
				container.each(function() {
					if ($(this).hasClass('video')) {
						stype = 'iframe';
					} else {
						stype = 'image';
					}
					$(this).magnificPopup({
						type: stype,
						closeOnContentClick: true,
						fixedContentPos: true,
						closeBtnInside: false,
						closeMarkup: '<button title="%title%" class="mfp-close">'+themeajax.icons.close+'</button>',
						mainClass: 'mfp',
						removalDelay: 250,
						overflowY: 'scroll',
						image: {
							verticalFit: false
						}
					});
				});
	
			}
		},
		magnificInline: {
			selector: '[rel="inline"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var _this = $(this), 
							eclass = (_this.data('class') ? _this.data('class') : '');

					_this.magnificPopup({
						type:'inline',
						midClick: true,
						mainClass: 'mfp ' + eclass,
						removalDelay: 250,
						closeBtnInside: true,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close">'+themeajax.icons.close+'</button>',
						callbacks: {
							open: function() {
								var that = this;
								if (eclass === 'quick-search') {
									setTimeout(function(){ 
										$(that.content[0]).find('.search-field').focus(); 
									}, 0);
								}
							}
						}
					});
				});
	
			}
		},
		magnificGallery: {
			selector: '[rel="gallery"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					$(this).magnificPopup({
						delegate: 'a',
						type: 'image',
						closeOnContentClick: true,
						fixedContentPos: true,
						mainClass: 'mfp',
						removalDelay: 250,
						closeMarkup: '<button title="%title%" class="mfp-close">'+themeajax.icons.close+'</button>',
						closeBtnInside: false,
						overflowY: 'scroll',
						gallery: {
							enabled: true,
							navigateByImgClick: false,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							verticalFit: false,
							titleSrc: function(item) {
								return item.el.attr('title');
							}
						}
					});
				});
			}
		},
		magnificAuto: {
			selector: '[rel="inline-auto"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var _this = $(this),
							eclass = (_this.data('class') ? _this.data('class') : ''),
							target = '#'+ _this.attr('id');
					$.magnificPopup.open({
						type:'inline',
						items: {
							src: target,
							type: 'inline'
						},
						midClick: true,
						mainClass: 'mfp ' + eclass,
						removalDelay: 250,
						closeBtnInside: true,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close">'+themeajax.icons.close+'</button>',
						callbacks: {
							close: function() {
								$.cookie('newsletter_popup', '1', { 
									expires: themeajax.settings.newsletter_length, 
									path: themeajax.settings.cookie_path
								});
							}
						}
					});
				});
			}
		},
		shareArticleDetail: {
			selector: '.share-article',
			init: function() {
				var base = this,
						container = $(base.selector),
						link = container.find('.thb_share'),
						icons = container.find('.icons'),
						social = container.find('.social'),
						tl = new TimelineMax({paused:true, onStart: function() { 
								icons.css('display', 'block'); 
							}, onReverseComplete: function() { 
								icons.css('display', 'none'); 
							} 
						});
						
				link.on('click', function() { return false; } );
				
				social.on('click', function() {
					var left = (screen.width/2)-(640/2),
							top = (screen.height/2)-(440/2)-100;
					window.open($(this).attr('href'), 'mywin', 'left='+left+',top='+top+',width=640,height=440,toolbar=0');
					return false;
				});
				
				tl
					.fromTo(icons, 0.25, {y: '6', x: '-50%', autoAlpha: 0}, {y: '-2', x: '-50%', autoAlpha: 1});
					
				container.hoverIntent(function() {
					tl.timeScale(1).play();
				}, function() {
					tl.timeScale(1.5).reverse();
				});
			}
		},
		newsletterForm: {
			selector: '.newsletter-form',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.on('submit', function() {	
					$.post(themeajax.url, {
						action: 'thb_subscribe_emails',
						email: container.find('.widget_subscribe').val()
					}, function(data) {
						var d = $.parseHTML($.trim(data));
						container.next('.result').html(d).fadeIn(200).delay(3000).fadeOut(200);
					});
					return false;
				});
				
			}
		},
		paginationStyle2: {
			selector: '.pagination-style2',
			init: function() {
				var base = this,
						container = $(base.selector),
						load_more = $('.thb_load_more'),
						thb_loading = false,
						page = 2;
								
				load_more.on('click', function(){
					var _this = $(this),
							text = _this.text(),
							count = themeajax.settings.posts_per_page;
					
					if(thb_loading === false) {
						_this.html(themeajax.l10n.loading).addClass('loading');
						
						$.ajax( themeajax.url, {
							method : 'POST',
							data : {
								action: 'thb_blog_ajax',
								page : page++
							},
							beforeSend: function() {
								thb_loading = true;
							},
							success : function(data) {
								thb_loading = false;
								var d = $.parseHTML($.trim(data)),
										l = d ? d.length : 0;
									
								if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
									_this.html(themeajax.l10n.nomore).removeClass('loading').off('click');
								} else {
									
									$(d).appendTo(container).hide().imagesLoaded(function() {
										if (container.data('isotope')) {
											container.isotope('appended', $(d));
										}
										$(d).show();
										TweenMax.set($(d), {opacity: 0, y:30});
										TweenMax.staggerTo($(d), 0.5, { y: 0, opacity:1}, 0.25);
									});
									
									if (l < count){
										_this.html(themeajax.l10n.nomore).removeClass('loading');
									} else {
										_this.html(text).removeClass('loading');
									}
								}
							}
						});
					}
					return false;
				});
			}
		},
		paginationStyle3: {
			selector: '.pagination-style3',
			init: function() {
				var base = this,
						container = $(base.selector),
						page = 2,
						thb_loading = false,
						count = themeajax.settings.posts_per_page;
				
				var scrollFunction = _.debounce(function(){
					
					if (thb_loading === false) {
						container.addClass('thb-loading');
						$.ajax( themeajax.url, {
							method : 'POST',
							data : {
								action: 'thb_blog_ajax',
								page : page++
							},
							beforeSend: function() {
								thb_loading = true;
							},
							success : function(data) {
								thb_loading = false;
								container.removeClass('thb-loading');
								var d = $.parseHTML($.trim(data)),
										l = d ? d.length : 0;

								if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
									win.off('scroll', scrollFunction);
								} else {
									$(d).appendTo(container).hide().imagesLoaded(function() {
										if (container.data('isotope')) {
											container.isotope('appended', $(d));
										}
										$(d).show();
										TweenMax.set($(d), {opacity: 0, y:30});
										TweenMax.staggerTo($(d), 0.5, { y: 0, opacity:1}, 0.25);
									});
									
									if (l >= count) {
										win.on('scroll', scrollFunction);
									}
								}
							}
						});
					}
				}, 30);
				
				win.scroll(scrollFunction);
			}
		},
		shopSidebar: {
			selector: '#side-filters .widget',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var that = $(this),
							t = that.find('>h6');
					
					t.append($('<span/>')).on('click', function() {
						t.toggleClass('active');
						t.next().animate({
							height: "toggle",
							opacity: "toggle"
						}, 300);
					});
				});
				
				$('.widget_layered_nav span.count, .widget_product_categories span.count, .widget_tag_cloud .tag-link-count').each(function(){
					var count = $.trim($(this).html());
					count = count.substring(1, count.length-1);
					$(this).html(count);
				});
			}
		},
		shopLoading: {
			selector: '.post-type-archive-product ul.products.thb-main-products',
			thb_loading: false,
			scrollInfinite: false,
			href: false,
			init: function() {
				var base = this,
						container = $(base.selector),
						type = themeajax.settings.shop_product_listing_pagination;
						
				if ($('.woocommerce-pagination').length && body.hasClass('post-type-archive-product')) {
					if (type === 'style2') {
					 	base.loadButton(container);
					} else if (type === 'style3') {
					 	base.loadInfinite(container);
					}
				}
			},
			loadButton: function(container) {
				var base = this;
				
				$('.woocommerce-pagination').before('<div class="thb_load_more_container text-center"><a class="thb_load_more button">'+themeajax.l10n.loadmore+'</a></div>');
				
				if ($('.woocommerce-pagination a.next').length === 0) {
					$('.thb_load_more_container').addClass('is-hidden');
				}
				$('.woocommerce-pagination').hide();

				body.on('click', '.thb_load_more:not(.no-ajax)', function(e) {
					var _this = $(this);
					base.href = $('.woocommerce-pagination a.next').attr('href');
					
					
					if (base.thb_loading === false) {
						_this.html(themeajax.l10n.loading).addClass('loading');
						
						base.loadProducts(_this, container);
					}
					return false;
				});
			},
			loadInfinite: function(container) {
				var base = this;
				
				if ($('.woocommerce-pagination a.next').length === 0) {
					$('.thb_load_more_container').addClass('is-hidden');
				}
				$('.woocommerce-pagination').hide();
				
				base.scrollInfinite = _.debounce(function(){
					if ( (base.thb_loading === false ) && ( (win.scrollTop() + win.height() + 150) >= (container.offset().top + container.outerHeight()) ) ) {
						
						base.href = $('.woocommerce-pagination a.next').attr('href');
						base.loadProducts(false, container, true);
					}
				}, 30);
				
				win.on('scroll', base.scrollInfinite);
			},
			loadProducts: function(button, container, infinite) {
				var base = this;
				$.ajax( base.href, {
					method: 'GET',
					beforeSend: function() {
						base.thb_loading = true;
						
						if (infinite) {
							win.off('scroll', base.scrollInfinite);		
						}
					},
					success: function(response) {
						var resp = $(response),
								products = resp.find('ul.products.thb-main-products li'); 
						
						$('.woocommerce-pagination').html(resp.find('.woocommerce-pagination').html());
						
						if (button) {
						 	if( !resp.find('.woocommerce-pagination .next').length ) {
						 		button.html(themeajax.l10n.nomore_products).removeClass('loading').addClass('no-ajax');
						 	} else {
						 		button.html(themeajax.l10n.loadmore).removeClass('loading');	
						 	}
						} else if (infinite) {
							if( resp.find('.woocommerce-pagination .next').length ) {
								win.on('scroll', base.scrollInfinite);	
							}
						}
						if (products.length) {
							products.addClass('will-animate').appendTo(container);
							TweenMax.set(products, {opacity: 0, y:30});
							TweenMax.staggerTo(products, 0.3, { y: 0, opacity: 1 }, 0.15);
						}
						base.thb_loading = false;
					}
				});
			}
		},
		revslider: {
			selector: '[data-thb_revslider="thb_revslider_affect_headers"]',
			init: function() {
				var base = this,
						container = $(base.selector),
						revid = container.find('.rev_slider').attr('id'),
						revolution = $('#'+revid);


				if (revolution.length) {
					revolution.bind("revolution.slide.onloaded",function (e) {
						revolution.bind("revolution.slide.onafterswap",function (e,data) {
							var color = data.currentslide.data('param1');
							body.removeClass('light-title dark-title');
							if (color) {
								body.addClass(color);	
							}
						});
					});
					
					container.closest('.thb-arrow').each(function(){
						var _that = $(this),
								cursor_area = _that.parents('.thb-cursor-area');
						
						container.bind('mousemove', function(e){
							var offset = cursor_area.offset(),
									mouseX = Math.min(e.pageX - offset.left, cursor_area.width()),
									mouseY = e.pageY - offset.top;
							if (mouseX < 0) { mouseX = 0; }
							if (mouseY < 0) { mouseY = 0; }

							TweenMax.set(_that, {x:mouseX -25, y:mouseY -20, force3D:true});

						});
						cursor_area.on('click', function() {
							if (cursor_area.hasClass('left')) {
								revolution.revprev();
							} else {
								revolution.revnext();
							} 
						});
					});
				}
			}
		},
		onePage: {
			selector: '#thb_fullscreen_rows',
			init: function() {
				var base = this,
						container = $(base.selector),
						animationspeed = 1150,
						footer = $('.footer-container'),
						anchors = [];
				
				SITE.fullPageEnabled = true;
				if (footer.length) {
					footer.appendTo(container);
				}
				$('>.wpb_row', container).each(function() {
					var _this = $(this),
							anchor = _this.data('onepage-anchor') ? _this.data('onepage-anchor') : '';
					anchors.push(anchor);
				});
				container.fullpage({
					sectionSelector: '>.wpb_row',
					navigation: true,
					css3: true,
					scrollingSpeed: animationspeed,
					anchors: anchors,
					scrollOverflow: true,
					navigationPosition: 'left',
					afterLoad: function(anchorLink, index){ 
						var firstRow = $('.wpb_row.fp-section:nth-child('+index+')', container),
								color = firstRow.data('midnight');
								
						SITE.animation.container(firstRow);
						var ins = firstRow.data('vide');
						if ( ins) {
							ins.getVideoObject().play();
						}
						if (color &&!body.hasClass(color)) {
							body.removeClass('light-title dark-title').addClass(color);
						}
					},
					onLeave: function(index, nextIndex, direction){ 
						var currentRow = $('.wpb_row.fp-section:nth-child('+index+')', container),
								nextRow = $('.wpb_row.fp-section:nth-child('+nextIndex+')', container),
								color = nextRow.data('midnight'),
								dir = direction === 'down' ? 1 : -1;

						function animateSlide() {
							TweenMax
								.to(currentRow, (animationspeed/1000), { opacity: 0.8, y: (dir*50)+'%', ease: thb_ease, clearProps:"all"});
						}
						
						if ( currentRow.data('vide')) {
							currentRow.data('vide').getVideoObject().pause();
						}
						
						if (direction === 'down') {
							if ( !nextRow.hasClass('footer-container') ) {
								animateSlide();
							} else {
								currentRow.addClass('before-footer');	
							}
						} else {
							if (!nextRow.hasClass('before-footer')) {
								animateSlide();
							}
						}
						var ins = nextRow.data('vide');
						if ( ins ) {
							ins.resize();
						}
						_.delay(function() {
							SITE.animation.container(nextRow);
							currentRow.removeClass('active');
							
							if ( ins ) {
								ins.getVideoObject().play();
							}
						}, animationspeed);
						
						
					}
				});
			}
		},
		contact: {
			selector: '.contact_map',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				
				container.each(function() {
					var _this = $(this),
						mapzoom = _this.data('map-zoom'),
						mapstyle = _this.data('map-style'),
						mapType = _this.data('map-type'),
						panControl = _this.data('pan-control'),
						zoomControl = _this.data('zoom-control'),
						mapTypeControl = _this.data('maptype-control'),
						scaleControl = _this.data('scale-control'),
						streetViewControl = _this.data('streetview-control'),
						locations = _this.find('.thb-location'),
						once;
						
					var bounds = new google.maps.LatLngBounds();
					
					var mapOptions = {
						center: {
							lat: -34.397,
							lng: 150.644
						},
						styles: mapstyle,
						zoom: mapzoom,
						draggable: !("ontouchend" in document),
						scrollwheel: false,
						panControl: panControl,
						zoomControl: zoomControl,
						mapTypeControl: mapTypeControl,
						scaleControl: scaleControl,
						streetViewControl: streetViewControl,
						fullscreenControl: false,
						mapTypeId: mapType
					};

					var map = new google.maps.Map(_this[0], mapOptions);
					
					map.addListener('tilesloaded', function() {
						if (!once) {
							locations.each(function(i) {
								var location = $(this),
										options = location.data('option'),
										lat = options.latitude,
										long = options.longitude,
										latlng = new google.maps.LatLng(lat, long),
										marker = options.marker_image,
										marker_size = options.marker_size,
										retina = options.retina_marker,
										title = options.marker_title,
										desc = options.marker_description,
										pinimageLoad = new Image();
								
								bounds.extend(latlng);
								
								pinimageLoad.src = marker;
								
								$(pinimageLoad).on('load', function(){
									base.setMarkers(i, locations.length, map, lat, long, marker, marker_size, title, desc, retina);
								});
									once = true;
							});
							
							if(mapzoom > 0) {
								map.setCenter(bounds.getCenter());
								map.setZoom(mapzoom);
							} else {
								map.setCenter(bounds.getCenter());
								map.fitBounds(bounds);
							}
						}
					});
					
					win.on('resize', _.debounce(function(){
						map.setCenter(bounds.getCenter());
					}, 50) );
					
				});
			},
			setMarkers: function(i, count, map, lat, long, marker, marker_size, title, desc, retina) {
				
				function showPin (i) {

					var markerExt = marker.toLowerCase().split('.');
							markerExt = markerExt[markerExt.length - 1];
					
					if($.inArray(markerExt, ['svg']) || retina ) {
						 marker = new google.maps.MarkerImage(marker, null, null, null, new google.maps.Size(marker_size[0]/2, marker_size[1]/2));
					}
					var g_marker = new google.maps.Marker({
								position: new google.maps.LatLng(lat,long),
								map: map,
								animation: google.maps.Animation.DROP,
								icon: marker,
								optimized: false
							}),
							contentString = '<h3>'+title+'</h3>'+'<div>'+desc+'</div>';
					
					// info windows 
					var infowindow = new google.maps.InfoWindow({
							content: contentString
					});
					
					g_marker.addListener('click', function() {
				    infowindow.open(map, g_marker);
				  });
				}
				setTimeout(showPin, i * 250, i);
			}
		},
		iconbox: {
			selector: '.thb-iconbox',
			control: function(container, delay) {	
				if( container.data('thb-in-viewport') === undefined && !container.hasClass('animation-off')) {
					container.data('thb-in-viewport', true);
					
					var _this = container,
							animation_speed = _this.data('animation_speed') !== '' ? _this.data('animation_speed') : '1.5',
							svg = _this.find('svg'),
							img = _this.find('img'),
							el = svg.find('path, circle, rect, ellipse'),
							h = _this.find('h5'),
							p = _this.find('p'),
							tl = new TimelineMax({
								delay: delay,
								paused: true 
							}),
							all = h.add(p).add(img);
					
					tl
						.set(_this, { visibility: 'visible' })
						.set(svg, { display: 'block' })
						.staggerFrom(el, animation_speed, { drawSVG: "0%"}, 0.2, "s")
						.staggerFrom(all, (animation_speed / 2), { autoAlpha: 0, y: '20px'}, 0.1, "s+="+ (animation_speed / 2) );
					
					tl.play();
				}
			}
		},
		animation: {
			selector: '.animation, .thb-iconbox',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				if (!$('#thb_fullscreen_rows').length) {
					base.control(container, true);
	
					win.on('scroll', function(){
						base.control(container, true);
					}).trigger('scroll');
				}
			},
			container: function(container) {
				var base = this,
						element = $(base.selector, container);
						
				base.control(element, false);
			},
			control: function(element, filter) {
				var t = 0,
						el = filter ? element.filter(':in-viewport') : element;
				
				el.each(function() {
					var _this = $(this);

					if (_this.hasClass('thb-iconbox')) {
						SITE.iconbox.control(_this, t*0.3);
					} else if (_this.data('thb-animated') === undefined ) {
						_this.data('thb-animated', true);
						TweenMax.to(_this, 0.75, { autoAlpha: 1, x: 0, y: 0, scale: 1, delay: t * 0.2 });
					}
					
					t++;
				});
			}
		},
	};
	
	$doc.ready(function() {
		if ($('#vc_inline-anchor').length) {
			win.on('vc_reload', function() {
				SITE.init();
			});
		} else {
			SITE.init();
		}
	});

})(jQuery, this, _);