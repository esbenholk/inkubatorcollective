function hexToRgb(o){var e=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(o);return e?{r:parseInt(e[1],16),g:parseInt(e[2],16),b:parseInt(e[3],16)}:null}!function($){wp.customize("blogname",function(o){o.bind(function(o){$(".site-title a").text(o)})}),wp.customize("blogdescription",function(o){o.bind(function(o){$(".site-description").text(o)})}),wp.customize("inku_logo",function(o){o.bind(function(o){if(""!=o){var e='<img src="'+o+'" />';$(".logo_container .ql_logo").html(e)}else $(".logo_container .ql_logo").text(wp_customizer.site_name)})}),wp.customize("display_header_text",function(o){o.bind(function(o){"blank"===o?$(".site-title a, .site-description").css({clip:"rect(1px, 1px, 1px, 1px)",position:"absolute"}):$(".site-description, #jqueryslidemenu a, .inku-login-btn, .ql_cart-btn, .top-bar").css({clip:"auto",color:o,position:"relative"})})}),wp.customize("inku_hero_color",function(o){o.bind(function(o){$(".btn-ql, .pagination li.active a, .pagination li.active a:hover, .wpb_wrapper .products .product-category h3, .btn-ql:active, .btn-ql.alternative:hover, .btn-ql.alternative-white:hover, .btn-ql.alternative-gray:hover, .hero_bck, .inku-nav-btn:hover, .inku-nav-btn:active, .cd-popular .cd-select, .no-touch .cd-popular .cd-select:hover, .pace .pace-progress, .woocommerce .products .product .add_to_cart_button:hover, #ql_woo_cart .widget_shopping_cart_content a.button.checkout").css({"background-color":o}),$(".btn-ql, .pagination li.active a, .pagination li.active a:hover, .btn-ql:active, .btn-ql.alternative, .btn-ql.alternative:hover, .btn-ql.alternative-white:hover, .btn-ql.alternative-gray:hover, .hero_border, .pace .pace-activity, #ql_woo_cart .widget_shopping_cart_content a.button.checkout").css({"border-color":o}),$(".pagination .current, .pagination a:hover, .widget_recent_posts ul li h6 a, .widget_popular_posts ul li h6 a, .read-more, .read-more i, .btn-ql.alternative, .hero_color, .cd-popular .cd-pricing-header, .cd-popular .cd-currency, .cd-popular .cd-duration, #sidebar .widget ul li > a:hover, #sidebar .widget_recent_comments ul li a:hover").css({color:o})})}),wp.customize("inku_headings_color",function(o){o.bind(function(o){$("h1:not(.site-title), h2, h3, h4, h5, h6, h1 a, h2, a, h3 a, h4 a, h5 a, h6 a").css({color:o})})}),wp.customize("inku_logo_color",function(o){o.bind(function(o){$(".logo_container .ql_logo").css({color:o})})}),wp.customize("inku_text_color",function(o){o.bind(function(o){$("body").css({color:o})})}),wp.customize("inku_link_color",function(o){o.bind(function(o){$("a").css({color:o})})}),wp.customize("inku_content_background_color",function(o){o.bind(function(o){$(".ql_background_padding, .product_text, .blog article, search article, archive article, .woocommerce .product .summary .summary-top, .woocommerce .product .summary .entry, .woocommerce .product .summary .summary-bottom, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, #ql_load_more").css({"background-color":o})})}),wp.customize("inku_footer_background",function(o){o.bind(function(o){$("#footer, .footer-wrap").css({"background-color":o}),$(".footer-top ul li").css({"border-bottom-color":o})})}),wp.customize("inku_header_bck_color",function(o){o.bind(function(o){$("#header, .single-product #header, .inku-sidenav #header, .top-bar, .single-product .top-bar").css({"background-color":o})})}),wp.customize("inku_header_lines_color",function(o){o.bind(function(o){$(".inku-sidenav #header .ql_cart-btn, #jqueryslidemenu ul.nav > li, .inku-sidenav #header .logo_container, .ql_cart-btn, #header, .single-product #header, .top-bar, .inku-sidenav #header, .logo_container::before, .inku-header-2 #header .logo_container::before, .inku-header-2 #header #ql_nav_collapse #jqueryslidemenu ul.nav > li, .inku-header-2 #header #ql_nav_collapse #jqueryslidemenu ul.nav > li:last-child, .inku-header-2 #header .ql_cart-btn").css({"border-color":o})})}),wp.customize("inku_shop_layout",function(o){o.bind(function(o){"masonry"==o?$container_isotope.isotope(args_isotope):$container_isotope.isotope("destroy")})}),wp.customize("inku_shop_columns",function(o){o.bind(function(o){$(".products").removeClass("layout-4-columns layout-2-columns layout-3-columns"),$(".products").addClass("layout-"+o+"-columns"),setTimeout(function(){$container_isotope.isotope("layout")},301)})}),wp.customize("inku_site_background_color",function(o){o.bind(function(o){$("body").css({"background-color":o})})})}(jQuery);