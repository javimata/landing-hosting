/******************************************
    -   PREPARE PLACEHOLDER FOR SLIDER  -
******************************************/

jQuery(function($) {


    $("#banner-main").show().revolution({
        sliderType: "standard",
        sliderLayout: "fullwidth",
        scrollbarDrag: "true",
        dottedOverlay: "none",
        delay: 9000,
        navigation: {
            onHoverStop: "off",
        },
        parallax: {
            type: 'mouse+scroll',
            origo: 'slidercenter',
            speed: 400,
            levels: [5, 10, 15, 20, 25, 30, 35, 40,
                45, 46, 47, 48, 49, 50, 51, 55],
            disable_onmobile: 'on'
        },
        visibilityLevels: [1120, 1024, 778, 480],
        gridwidth: 1120,
        gridheight: 750,
        lazyType: "none",
        shadow: 0,
        spinner: "spinner4",
        stopLoop: "off",
        stopAfterLoops: -1,
        stopAtSlide: -1,
        shuffle: "off",
        autoHeight: "off",
        disableProgressBar: "on",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: false,
        fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false,
        }
    });


});