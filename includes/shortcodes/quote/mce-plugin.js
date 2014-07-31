(function() {  
    tinymce.create('tinymce.plugins.quote', {  
        init : function(ed, url) {  
           
           ed.addCommand('quote_cmd', function() {
                ed.windowManager.open({
                    file : ajaxurl + '?action=bright-quote-shortcode-panel',
                    width : 850,
                    height : jQuery(window).height()-150,
                    inline : 1,
                    title: "Insert Quote"
                }, {
                    plugin_url : url // Plugin absolute URL
                });
            });

            // Register example button
            ed.addButton('quote', {
                title : 'Quote',
                cmd : 'quote_cmd',
                image : url + '/icon.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('quote', n.nodeName == 'IMG');
            });

        },  
        createControl : function(n, cm) {  
            return null;  
        },  
        getInfo : function() {
            return {
                longname  : 'quote',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        }
    });  
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);  
})();  