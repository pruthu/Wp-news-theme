(function() {  
    tinymce.create('tinymce.plugins.slider', {  
        init : function(ed, url) {  
           
           ed.addCommand('slider_cmd', function() {
                ed.windowManager.open({
                    file : ajaxurl + '?action=bright-slider-shortcode-panel',
                    width : 850,
                    height : jQuery(window).height()-150,
                    inline : 1,
                    title: "Insert Slideshow Image"
                }, {
                    plugin_url : url // Plugin absolute URL
                });
            });

            // Register example button
            ed.addButton('slider', {
                title : 'Slideshow',
                cmd : 'slider_cmd',
                image : url + '/icon.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('slider', n.nodeName == 'IMG');
            });

        },  
        createControl : function(n, cm) {  
            return null;  
        },  
        getInfo : function() {
            return {
                longname  : 'slider',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        }
    });  
    tinymce.PluginManager.add('slider', tinymce.plugins.slider);  
})();  