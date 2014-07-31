(function() {  
    tinymce.create('tinymce.plugins.googlemap', {  
        init : function(ed, url) {  
           
           ed.addCommand('googlemap_cmd', function() {
                ed.windowManager.open({
                    file : ajaxurl + '?action=bright-googlemap-shortcode-panel',
                    width : 850,
                    height : jQuery(window).height()-150,
                    inline : 1,
                    title: "Insert Google Map"
                }, {
                    plugin_url : url // Plugin absolute URL
                });
            });

            // Register example button
            ed.addButton('googlemap', {
                title : 'Google Map',
                cmd : 'googlemap_cmd',
                image : url + '/icon.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('googlemap', n.nodeName == 'IMG');
            });

        },  
        createControl : function(n, cm) {  
            return null;  
        },  
        getInfo : function() {
            return {
                longname  : 'googlemap',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        }
    });  
    tinymce.PluginManager.add('googlemap', tinymce.plugins.googlemap);  
})();  