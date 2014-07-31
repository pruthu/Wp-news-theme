(function() {  
    tinymce.create('tinymce.plugins.qa', {  
        init : function(ed, url) {  
            ed.addButton('qa', {  
                title : 'Question Answer',  
                image : url+'/icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[qa question="The question goes here?"]\nThe answer goes here.[/qa]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },
        getInfo : function() {
            return {
                longname  : 'qa',
                author    : 'Feriy',
                authorurl : 'http://www.bright-theme.com',
                infourl   : 'http://www.bright-theme.com',
                version   : "1.0"
            };
        } 
    });  
    tinymce.PluginManager.add('qa', tinymce.plugins.qa);  
})();  