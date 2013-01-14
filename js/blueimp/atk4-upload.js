
$.widget("ui.atk4_blueimp_uploader", {
    options: {
		'progressbar': false,
		'input': false,
		'fieldname': false
    },
    _create: function(){

        var self=this;

        this.element.fileupload({
            dataType: 'json',
            done: function (e, data){
                console.log("done ",e,data);
                if(self.options.input && data.result.id){
                    $(self.options.input).val(data.result.id);
                }else if(data.result.error){
                    console.log(self.options.fieldname);
                    $(self.options.input).closest('.atk-form').atk4_form(
                        'fieldError',
                        self.options.fieldname,
                        data.result.error
                    );
                }
                if(data.result.callback){
                    eval(data.result.callback);
                }
            },
            progressall: function (e, data) {
                if(self.options.progressbar){
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $(self.options.progressbar).progressbar('value',progress);
                }
            },
            add: function (e, data) {
                console.log("added ",e,data);
                data.submit();
            }
        });
    }
});
