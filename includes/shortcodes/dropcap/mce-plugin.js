(function() {  
    tinymce.create('tinymce.plugins.dropcap', {  
        init : function(ed, url) {  
            ed.addButton('dropcap', {  
                title : 'Dropcap',  
                image : url+'/icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[dropcap]' + ed.selection.getContent() + '[/dropcap]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },
        getInfo : function() {
            return {
                longname  : 'dropcap',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        }
    });  
    tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);  
})();  