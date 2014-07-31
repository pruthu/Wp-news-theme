(function() {  
    tinymce.create('tinymce.plugins.column', {  
        init : function(ed, url) {  
           
           ed.addCommand('column_cmd', function() {
                ed.windowManager.open({
                    file : ajaxurl + '?action=bright-column-shortcode-panel',
                    width : 830,
                    height : jQuery(window).height()-150,
                    inline : 1,
                    title: "Insert Grid/Column"
                }, {
                    plugin_url : url // Plugin absolute URL
                });
            });

            // Register example button
            ed.addButton('column', {
                title : 'Grid/Column',
                cmd : 'column_cmd',
                image : url + '/icon.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('column', n.nodeName == 'IMG');
            });

        },  
        createControl : function(n, cm) {  
            return null;  
        },  
        getInfo : function() {
            return {
                longname  : 'column',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        }
    });  
    tinymce.PluginManager.add('column', tinymce.plugins.column);  
})();  