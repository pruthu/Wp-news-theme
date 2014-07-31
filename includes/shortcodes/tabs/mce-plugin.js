(function() {  
    tinymce.create('tinymce.plugins.tabs', {  
        init : function(ed, url) {  
           
           ed.addCommand('tabs_cmd', function() {
                ed.windowManager.open({
                    file : ajaxurl + '?action=bright-tabs-shortcode-panel',
                    width : 850,
                    height : jQuery(window).height()-150,
                    inline : 1,
                    title: "Insert Tabs"
                }, {
                    plugin_url : url // Plugin absolute URL
                });
            });

            // Register example button
            ed.addButton('tabs', {
                title : 'Tabs',
                cmd : 'tabs_cmd',
                image : url + '/icon.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('tabs', n.nodeName == 'IMG');
            });

        },  
        createControl : function(n, cm) {  
            return null;  
        },  
        getInfo : function() {
            return {
                longname  : 'tabs',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        }
    });  
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
})();  