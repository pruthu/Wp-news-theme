(function() {  
    tinymce.create('tinymce.plugins.accordion', {  
        init : function(ed, url) {  
           
           ed.addCommand('accordion_cmd', function() {
                ed.windowManager.open({
                    file : ajaxurl + '?action=bright-accordion-shortcode-panel',
                    width : 850,
                    height : jQuery(window).height()-150,
                    inline : 1,
                    title: "Insert Accordion"
                }, {
                    plugin_url : url // Plugin absolute URL
                });
            });

            // Register example button
            ed.addButton('accordion', {
                title : 'Accordion',
                cmd : 'accordion_cmd',
                image : url + '/icon.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('accordion', n.nodeName == 'IMG');
            });

        },  
        createControl : function(n, cm) {  
            return null;  
        },  
        getInfo : function() {
            return {
                longname  : 'accordion',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        }
    });  
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);  
})();  