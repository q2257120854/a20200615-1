
(function($) {
    "use strict";

    /**
     *  [ 1 ] - On ready, load, resize and scroll
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    // On ready
    $(document).on("ready", function() {
        // BGVideoYTPlayer();
        headerSlider();
        // stickyNav();
        // navScrollTo();
        parallaxStellar();
        // funFactCounter();
        // clientsCarousel();
        // headerFormValidation();
    });
    // On load
    $(window).on("load", function() {
        websiteLoading();
        FetImgWidth();
        // WOWAnimation();
    });
    // On resize
    $(window).on("resize", function() {
        fullscreenSection();
        leadgenWithSlider();
        FetImgWidth();
    });
    // On scroll
    $(window).on("scroll", function() {
        // headerContentAnimated();
    });
    /**
     *  [ 2 ] - jQuery noConflict
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    var $ = jQuery.noConflict();
    /**
     *  [ 3 ] - Fullscreen Elements
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    function fullscreenSection() {
        $("#header-featured-content-outer, .fullscreen, .header-slider li, .header-center-box-content").css("height", $(window).height());
    }
    fullscreenSection();
    /**
     *  [ 4 ] - Background Video
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    // function BGVideoYTPlayer() {
    // 	$(".background-video-inner").YTPlayer({
    // 		mute: false,
    // 		autoPlay: true,
    // 		opacity: 1,
    // 		containment: ".background-video",
    // 		showControls: false,
    // 		startAt: 0,
    // 		addRaster: true,
    // 		showYTLogo: false,
    // 		stopMovieOnBlur: false
    // 	});	
    // }
    /**
     *  [ 5 ] - Website Loading
     *	~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    function websiteLoading() {
        $(".loading-effect").delay(0).fadeOut(500);
        $("#website-loading").delay(500).fadeOut(300);
    }
    /**
     *  [ 6 ] - Header Scroll Content Animation
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    var featuredTitleMarginTop = parseInt($(".header-center-box").css("margin-top"), 10);

    function headerContentAnimated() {
        var scrollingDistance = $(window).scrollTop();
        $(".header-center-box").css({
            "top": featuredTitleMarginTop + (scrollingDistance * 0.1),
            "opacity": 1 - (scrollingDistance / 200)
            
        });
    }
    /**
     *	-------------------------------------------------------------------------------
     *	( 02 ) - Header Slider
     *	-------------------------------------------------------------------------------
     *
     *  This section is for the header slider. It's based on owl carousel.
     *	
     *	------
     *	
     *  Header Slider is divided to the following sections:
     *	
     */
    function headerSlider() {
        var owlHS = $(".header-slider");
        $(".header-slider").owlCarousel({
            // Most important owl features
            items: 5, // Items number appeared
            singleItem: true, // Making only 1 item appearing
            //Basic Speeds
            slideSpeed: owlPagiSpeed,
            paginationSpeed: owlPagiSpeed, // Pagination speed
            rewindSpeed: 1000, // Rewind speed
            //Autoplay
            autoPlay: (owlHS.data("hs-autoplay-time")) ? (owlHS.data("hs-autoplay-time")) : false,
            // Integer means autoplay equal to the value. True means autoplay with 5 seconds. False means no autoplay
            stopOnHover: false,
            // Navigation
            navigation: false, // Display "next" and "prev" buttons
            navigationText: ["<i class=\"fa fa-long-arrow-left\"></i>", "<i class=\"fa fa-long-arrow-right\"></i>"],
            rewindNav: true, // Slide to first item
            //Pagination
            pagination: false, // Show pagination
            paginationNumbers: false, // Show numbers inside pagination buttons
            //Transitions
            transitionStyle: (owlHS.data("hs-transition-style")) ? (owlHS.data("hs-transition-style")) : false,
            // "fade", "backSlide", "goDown" and "fadeUp". false = slide
            //Auto height
            autoHeight: true,
            // Other
            addClassActive: true, // Add "active" classes on visible items
            mouseDrag: false, // Disabling sliding using mouse drag
            touchDrag:false,
            beforeMove: beforeMoveAction,
            beforeUpdate: hideSliderHeadlines,
            afterUpdate: showSliderHeadlines,
            // startDragging: showSliderHeadlines,
            afterMove: showSliderHeadlines,
            // afterAction: showSliderHeadlines,
            beforeInit: hideBeforeSliderHeadlines,
            afterInit: showSliderHeadlines
        });
    }


    // Making header slider images appearing as background, not images
    $(".header-slider li").each(function() {
        var imgSrc = $(this).children("img").attr("src");
        $(this).css("background-image", "url('" + imgSrc + "')");
        $(this).children("img").css("display", "none");
    });
    // Fixing vertical featured image container width [ That appears in Firefox! ]
    function FetImgWidth() {
        $("header .vertical-featured-image-container").each(function() {
            var getWidth = $(this).closest("[class*='col-']").width();
            $(this).width(getWidth);
        });
    }

    /**
     *  [ 1 ] - Pattern Overlay Options
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    // Custom pattern overlay darkness opacity
    $("*[data-pattern-overlay-darkness-opacity]").each(function() {
        // 0 value is not read by jquery, but 0.0 is read! in case of making condition "if"
        var patternOverlayDarknessOpacity = $(this).data("pattern-overlay-darkness-opacity");
        $(this).css("background-color", convertHex("#000000", patternOverlayDarknessOpacity));
    });
    // disable pattern overlay background image [ dots only ]
    $("*[data-pattern-overlay-background-image]").each(function() {
        if ($(this).data("pattern-overlay-background-image") == "none") {
            $(this).css("background-image", "none");
        } else if ($(this).data("pattern-overlay-background-image") == "yes") {
            $(this).css("background-image");
        }
    });
    // remove pattern overlay
    $("*[data-remove-pattern-overlay]").each(function() {
        if ($(this).data("remove-pattern-overlay") == "yes") {
            $(this).css("background", "none");
            /**
             *  In HTML, add expressive word like "none" to know what this option indicates for.  
             *	Using this word has no direct effect or any another word, it's only word with meaning 
             *	to help to know what this attribute value is doing.
             */
        }
    });
    /**
     *  [ 2 ] - Padding Options
     *	~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    // Custom padding top bottom
    $("*[data-padding-top-bottom]").each(function() {
        var customPaddingTopBottom = $(this).data("padding-top-bottom");
        $(this).css({
            "padding-top": customPaddingTopBottom,
            "padding-bottom": customPaddingTopBottom
        });
    });
    // Custom padding top
    $("*[data-padding-top]").each(function() {
        var customPaddingTop = $(this).data("padding-top");
        $(this).css("padding-top", customPaddingTop);
    });
    // Custom padding bottom
    $("*[data-padding-bottom]").each(function() {
        var customPaddingBottom = $(this).data("padding-bottom");
        $(this).css("padding-bottom", customPaddingBottom);
    });
    // Custom padding left right
    $("*[data-padding-left-right]").each(function() {
        var customPaddingLeftRight = $(this).data("padding-left-right");
        $(this).css({
            "padding-left": customPaddingLeftRight,
            "padding-right": customPaddingLeftRight
        });
    });
    // Custom padding left
    $("*[data-padding-left]").each(function() {
        var customPaddingLeft = $(this).data("padding-left");
        $(this).css("padding-left", customPaddingLeft);
    });
    // Custom padding right
    $("*[data-padding-right]").each(function() {
        var customPaddingRight = $(this).data("padding-right");
        $(this).css("padding-right", customPaddingRight);
    });
    /**
     *  [ 3 ] - Margin Options
     *	~~~~~~~~~~~~~~~~~~~~~~~~
     */
    // Custom margin top bottom
    $("*[data-margin-top-bottom]").each(function() {
        var customMarginTopBottom = $(this).data("margin-top-bottom");
        $(this).css({
            "margin-top": customMarginTopBottom,
            "margin-bottom": customMarginTopBottom
        });
    });
    // Custom margin top
    $("*[data-margin-top]").each(function() {
        var customMarginTop = $(this).data("margin-top");
        $(this).css("margin-top", customMarginTop);
    });
    // Custom margin bottom
    $("*[data-margin-bottom]").each(function() {
        var customMarginBottom = $(this).data("margin-bottom");
        $(this).css("margin-bottom", customMarginBottom);
    });
    // Custom margin left right
    $("*[data-margin-left-right]").each(function() {
        var customMarginLeftRight = $(this).data("margin-left-right");
        $(this).css({
            "margin-left": customMarginLeftRight,
            "margin-right": customMarginLeftRight
        });
    });
    // Custom margin left
    $("*[data-margin-left]").each(function() {
        var customMarginLeft = $(this).data("margin-left");
        $(this).css("margin-left", customMarginLeft);
    });
    // Custom margin right
    $("*[data-margin-right]").each(function() {
        var customMarginRight = $(this).data("margin-right");
        $(this).css("margin-right", customMarginRight);
    });
    /**
     *  [ 4 ] - Width Options
     *	~~~~~~~~~~~~~~~~~~~~~~~
     */
    // Custom width
    $("*[data-width]").each(function() {
        var customWidth = $(this).data("width");
        $(this).css("width", customWidth);
    });
    // Custom min width
    $("*[data-min-width]").each(function() {
        var customMinWidth = $(this).data("min-width");
        $(this).css("min-width", customMinWidth);
    });
    // Custom max width
    $("*[data-max-width]").each(function() {
        var customMaxWidth = $(this).data("max-width");
        $(this).css("max-width", customMaxWidth);
    });
    /**
     *  [ 5 ] - Height Options
     *	~~~~~~~~~~~~~~~~~~~~~~~~
     */
    // Custom height
    $("*[data-height]").each(function() {
        var customHeight = $(this).data("height");
        $(this).css("height", customHeight);
    });
    // Custom min height
    $("*[data-min-height]").each(function() {
        var customMinHeight = $(this).data("min-height");
        $(this).css("min-height", customMinHeight);
    });
    // Custom max height
    $("*[data-max-height]").each(function() {
        var customMaxHeight = $(this).data("max-height");
        $(this).css("max-height", customMaxHeight);
    });
    /**
     *  [ 6 ] - Background Options
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    // Custom background color
    $("*[data-background-color]").each(function() {
        var customBackgroundColor = $(this).data("background-color");
        $(this).css("background-color", customBackgroundColor);
    });
    // Custom background color opacity
    $("*[data-background-color-opacity]").each(function() {
        var customBackgroundColorOpacity = $(this).data("background-color-opacity"),
            backgroundColor = $(this).css("background-color");
        // Conversion of rgb to rgba
        var rgbaBackgroundColor = backgroundColor.replace("rgb", "rgba").replace(")", ", " + customBackgroundColorOpacity + ")");
        $(this).css("background-color", rgbaBackgroundColor);
    });
    // Custom background image
    $("*[data-background-image]").each(function() {
        var customBackgroundImage = $(this).data("background-image");
        $(this).css("background-image", "url('" + customBackgroundImage + "')");
    });
    // Custom parallax background image
    $("*[data-parallax-background-image]").each(function() {
        var customParallaxBackgroundImage = $(this).data("parallax-background-image");
        $(this).css("background-image", "url('" + "./images/files/parallax-background-images/" + customParallaxBackgroundImage + "')");
    });
    // Custom background repeat
    $("*[data-background-repeat]").each(function() {
        var customBackgroundRepeat = $(this).data("background-repeat");
        $(this).css("background-repeat", customBackgroundRepeat);
    });
    // Custom background position
    $("*[data-background-position]").each(function() {
        var customBackgroundPosition = $(this).data("background-position");
        $(this).css("background-position", customBackgroundPosition);
    });
    // Custom background attachment
    $("*[data-background-attachment]").each(function() {
        var customBackgroundAttachment = $(this).data("background-attachment");
        $(this).css("background-attachment", customBackgroundAttachment);
    });
    // Custom background size
    $("*[data-background-size]").each(function() {
        var customBackgroundSize = $(this).data("background-size");
        $(this).css("background-size", customBackgroundSize);
    });
    /**
     *  [ 7 ] - Font Options
     *	~~~~~~~~~~~~~~~~~~~~~~
     */
    // Custom font size
    $("*[data-font-size]").each(function() {
        var customFontSize = $(this).data("font-size");
        $(this).css("font-size", customFontSize);
    });
    // Custom font color
    $("*[data-font-color]").each(function() {
        var customFontColor = $(this).data("font-color");
        $(this).css("color", customFontColor);
    });
    // Custom font weight
    $("*[data-font-weight]").each(function() {
        var customFontWeight = $(this).data("font-weight");
        $(this).css("font-weight", customFontWeight);
    });
    // Custom font family
    $("*[data-font-family]").each(function() {
        var customFontFamily = $(this).data("font-family");
        $(this).css("font-family", customFontFamily);
    });
    // Custom letter spacing
    $("*[data-letter-spacing]").each(function() {
        var customLetterSpacing = $(this).data("letter-spacing");
        $(this).css("letter-spacing", customLetterSpacing);
    });
    // Custom text transform
    $("*[data-text-transform]").each(function() {
        var customTextTransform = $(this).data("text-transform");
        $(this).css("text-transform", customTextTransform);
    });
    // Custom font style
    $("*[data-font-style]").each(function() {
        var customFontStyle = $(this).data("font-style");
        $(this).css("font-style", customFontStyle);
    });
    /**
     *  [ 8 ] - Different Options
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    // Custom divider space 
    $("*[data-divider-space]").each(function() {
        var customDividerSpaceHeight = $(this).data("divider-space");
        $(this).css("height", parseInt(customDividerSpaceHeight, 10));
    });
    // Custom divider space with line
    $("*[data-divider-space-with-line]").each(function() {
        var customDividerSpaceWithLineHeight = $(this).data("divider-space-with-line");
        $(this).css({
            "margin-bottom": parseInt(customDividerSpaceWithLineHeight, 10) + 25,
            "top": parseInt(customDividerSpaceWithLineHeight, 10) + 15
        });
        $(this).parent(".divider-space-container").css("padding-bottom", parseInt(customDividerSpaceWithLineHeight, 10));
    });
    // Custom divider space with 2 lines
    $("*[data-divider-space-with-two-lines]").each(function() {
        var customDividerSpaceWithLineHeight = $(this).data("divider-space-with-two-lines");
        $(this).css({
            "margin-bottom": parseInt(customDividerSpaceWithLineHeight, 10) + 25,
            "top": parseInt(customDividerSpaceWithLineHeight, 10) + 15
        });
        $(this).parent(".divider-space-container").css("padding-bottom", parseInt(customDividerSpaceWithLineHeight, 10));
    });
    /**
     *	-------------------------------------------------------------------------------
     *	( 07 ) - Stellar Parallax
     *	-------------------------------------------------------------------------------
     *
     *  This part contains the codes of the parallax effect using Stellar jquery
     *  plugin. It's applied here on header and parallax sections.
     *
     *	------
     *
     *  It has the following code:
     *
     */
    function parallaxStellar() {
        $(function() {
            $.stellar({
                horizontalScrolling: false, // don't change this option
                // verticalScrolling: false,
                verticalOffset: 0,
                responsive: true, // false
            });
        });
    }
    /**
     *	-------------------------------------------------------------------------------
     *	( 08 ) - Count Up
     *	-------------------------------------------------------------------------------
     *
     *  This part contains the codes of the count up plugin
     *
     *	------
     *
     *  It has the following code:
     *
     */
    function funFactCounter() {
        $('.fun-facts-box .info-box-content span').counterUp({
            delay: 10,
            time: 1500
        });
    }
    /**
     *	-------------------------------------------------------------------------------
     *	( 09 ) - Carousels
     *	-------------------------------------------------------------------------------
     *
     *  This part contains the codes of carousels used like clients and testmonials
     *
     *	------
     *
     *  It has the following code:
     *
     *	   |
     *	   |-->  [ 1 ] - Clients Carousel
     *	   |-->  [ 2 ] - Testmonial Carousel
     *
     */
    /**
     *  [ 1 ] - Clients Carousel
     *	~~~~~~~~~~~~~~~~~~~~~~~~~~
     */
    function clientsCarousel() {
        $(".clients-carousel").owlCarousel({
            // Most important owl features
            items: 5, // Items number appeared
            itemsCustom: false, // Custom responsive widths
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [979, 3],
            itemsTablet: [768, 2],
            itemsTabletSmall: false,
            itemsMobile: [479, 1],
            singleItem: false, // Making only 1 item appearing
            //Basic Speeds
            slideSpeed: 200,
            paginationSpeed: 800, // Pagination speed
            rewindSpeed: 1000, // Rewind speed
            //Autoplay
            autoPlay: 10000, // Integer means autoplay equal to the value. True means autoplay with 5 seconds
            stopOnHover: false,
            // Navigation
            navigation: false, // Display "next" and "prev" buttons
            navigationText: ["<i class=\"fa fa-angle-left\"></i>", "<i class=\"fa fa-angle-right\"></i>"],
            rewindNav: true, // Slide to first item
            //Pagination
            pagination: true, // Show pagination
            paginationNumbers: false, // Show numbers inside pagination buttons
            // Responsive 
            responsive: true,
            //Auto height
            autoHeight: false,
            //Transitions
            transitionStyle: false // "fade", "backSlide", "goDown" and "fadeUp"
        });
    }

 
})(jQuery);

function convertHex(hex, opacity) {
    // "use strict";
    // var r, g, b, result;
    hex = hex.replace('#', '');
    r = parseInt(hex.substring(0, 2), 16);
    g = parseInt(hex.substring(2, 4), 16);
    b = parseInt(hex.substring(4, 6), 16);
    result = 'rgba(' + r + ', ' + g + ', ' + b + ', ' + opacity + ')';
    return result;
}
var $ = jQuery.noConflict();

function hideSliderHeadlines() {
    $(hsOptions).animate({
        opacity: 0
    }, 300)
}

function beforeMoveAction() {
    $(hsOptions).animate({
        opacity: 0
    }, 300);
    $('.progressBar a').animate({ width: "100%"}, 7000 , 'linear', function(){
        $(this).css('width','0');
    });
}

function showSliderHeadlines() {
    setTimeout(function() {
        
        $(".active").siblings().find($(".animated")).removeClass("fadeInRightBig");
        $(".active").find($(".animated")).addClass("fadeInRightBig");

        var t = "*[data-hs-from-top], *[data-hs-top-distance-duration], *[data-hs-top-fade-duration], *[data-hs-top-easing], *[data-hs-top-delay]";
        $(t).each(function() {
            var t = $(this).data("hs-from-top") ? $(this).data("hs-from-top") : "-50px",
                a = $(this).data("hs-top-distance-duration") ? $(this).data("hs-top-distance-duration") : 500,
                i = $(this).data("hs-top-fade-duration") ? $(this).data("hs-top-fade-duration") : 300,
                s = $(this).data("hs-top-easing") ? $(this).data("hs-top-easing") : "easeOutExpo",
                d = $(this).data("hs-top-delay") ? $(this).data("hs-top-delay") : 0,
                o = $(".active").find(this);
            setTimeout(function() {
                o.css("top", t).animate({
                    opacity: 1
                }, {
                    duration: i,
                    queue: !1
                }).animate({
                    top: "0"
                }, {
                    duration: a,
                    easing: s,
                    queue: !1
                })
            }, d)
        });
        var a = "*[data-hs-from-bottom], *[data-hs-bottom-distance-duration], *[data-hs-bottom-fade-duration], *[data-hs-bottom-easing], *[data-hs-bottom-delay]";
        $(a).each(function() {
            var t = $(this).data("hs-from-bottom") ? $(this).data("hs-from-bottom") : "-50px",
                a = $(this).data("hs-bottom-distance-duration") ? $(this).data("hs-bottom-distance-duration") : 500,
                i = $(this).data("hs-bottom-fade-duration") ? $(this).data("hs-bottom-fade-duration") : 300,
                s = $(this).data("hs-bottom-easing") ? $(this).data("hs-bottom-easing") : "easeOutExpo",
                d = $(this).data("hs-bottom-delay") ? $(this).data("hs-bottom-delay") : 0,
                o = $(".active").find(this);
            setTimeout(function() {
                o.css("bottom", t).animate({
                    opacity: 1
                }, {
                    duration: i,
                    queue: !1
                }).animate({
                    bottom: "0"
                }, {
                    duration: a,
                    easing: s,
                    queue: !1
                })
            }, d)
        });
        var i = "*[data-hs-from-left], *[data-hs-left-distance-duration], *[data-hs-left-fade-duration], *[data-hs-left-easing], *[data-hs-left-delay]";
        $(i).each(function() {
            var t = $(this).data("hs-from-left") ? $(this).data("hs-from-left") : "-50px",
                a = $(this).data("hs-left-distance-duration") ? $(this).data("hs-left-distance-duration") : 500,
                i = $(this).data("hs-left-fade-duration") ? $(this).data("hs-left-fade-duration") : 300,
                s = $(this).data("hs-left-easing") ? $(this).data("hs-left-easing") : "easeOutExpo",
                d = $(this).data("hs-left-delay") ? $(this).data("hs-left-delay") : 0,
                o = $(".active").find(this);
            setTimeout(function() {
                o.css("left", t).animate({
                    opacity: 1
                }, {
                    duration: i,
                    queue: !1
                }).animate({
                    left: "0"
                }, {
                    duration: a,
                    easing: s,
                    queue: !1
                })
            }, d)
        });
        var s = "*[data-hs-from-right], *[data-hs-right-distance-duration], *[data-hs-right-fade-duration], *[data-hs-right-easing], *[data-hs-right-delay]";
        $(s).each(function() {
            var t = $(this).data("hs-from-right") ? $(this).data("hs-from-right") : "-50px",
                a = $(this).data("hs-right-distance-duration") ? $(this).data("hs-right-distance-duration") : 500,
                i = $(this).data("hs-right-fade-duration") ? $(this).data("hs-right-fade-duration") : 300,
                s = $(this).data("hs-right-easing") ? $(this).data("hs-right-easing") : "easeOutExpo",
                d = $(this).data("hs-right-delay") ? $(this).data("hs-right-delay") : 0,
                o = $(".active").find(this);
            setTimeout(function() {
                o.css("right", t).animate({
                    opacity: 1
                }, {
                    duration: i,
                    queue: !1
                }).animate({
                    right: "0"
                }, {
                    duration: a,
                    easing: s,
                    queue: !1
                })
            }, d)
        })
    },0)
}


function hideBeforeSliderHeadlines() {
    $(hsOptions).css("opacity", 0);
    $('.progressBar a').animate({ width: "100%"}, 7000 , 'linear', function(){
        $(this).css('width','0');
    });

}
var owlPagiSpeed = 800,
    hsOptions = "*[data-hs-from-top], *[data-hs-top-distance-duration], *[data-hs-top-fade-duration], *[data-hs-top-easing], *[data-hs-top-delay], *[data-hs-from-bottom], *[data-hs-bottom-distance-duration], *[data-hs-bottom-fade-duration], *[data-hs-bottom-easing], *[data-hs-from-left], *[data-hs-left-distance-duration], *[data-hs-left-fade-duration], *[data-hs-left-easing], *[data-hs-from-right], *[data-hs-right-distance-duration], *[data-hs-right-fade-duration], *[data-hs-right-easing]";
$(hsOptions).css("position", "relative");