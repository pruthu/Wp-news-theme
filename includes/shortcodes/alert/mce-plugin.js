(function() {  
    tinymce.create('tinymce.plugins.alert', {  
        init : function(ed, url) {  
           
           ed.addCommand('alert_cmd', function() {
                ed.windowManager.open({
                    file : ajaxurl + '?action=bright-alert-shortcode-panel',
                    width : 850,
                    height : jQuery(window).height()-150,
                    inline : 1,
                    title: "Insert Alert"
                }, {
                    plugin_url : url // Plugin absolute URL
                });
            });

            // Register example button
            ed.addButton('alert', {
                title : 'Alert',
                cmd : 'alert_cmd',
                image : url + '/icon.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('alert', n.nodeName == 'IMG');
            });

        },  
        createControl : function(n, cm) {  
            return null;  
        },  
        getInfo : function() {
            return {
                longname  : 'alert',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        }
    });  
    tinymce.PluginManager.add('alert', tinymce.plugins.alert);  
})();  