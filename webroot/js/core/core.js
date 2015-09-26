var Core =
{
    init: function()
    {
        tinymce.init({
            selector: ".hw-mce-advance",
            theme: "modern",
            relative_urls : false,
            document_base_url: BASE_URL,
            height: 400,
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager filemanager"
            ],
            skin : 'lightgray',
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview media fullpage | forecolor backcolor emoticons | responsivefilemanager | link unlink | image",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ],
            image_advtab: true ,
            external_filemanager_path: BASE_URL + "/filemanager/",
            filemanager_title: "HwCore Filemanager" ,
            external_plugins: { "filemanager" : BASE_URL + "filemanager/plugin.min.js"}
        });
        
        tinymce.init({
            selector: ".hw-mce-basic"
        });
        
        $(".hw-date").datepicker(
        {
            dateFormat: 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn'
            //,maxDate: '0d'
        }).keydown(false);
        
        $('.hw-tooltip').tooltip({position:{my: "center bottom-5",at: "center top"}}); // Setting jquery ui tooltip

        $('.hw-active').ajaxForm({
            dataType: 'JSON',
            type: 'POST',
            beforeSend: function(){
                Core.Loading.show();
            },
            success: function(response){
                if(response.status) {
                    Core.Loading.hide();
                }
            }
        });

        $('.hw-ajax').ajaxForm(
        {
            dataType: 'json',
            beforeSerialize : function(thisForm, options)
            {
                Core.Loading.show();
                var hid = thisForm.find('[name="ajax_form"]');
                if(hid.length == 0)
                {
                    hid = $('<input type="hidden" name="ajax_form" />');
                    thisForm.append(hid);
                }
                
                if(thisForm.attr('model'))
                {
                    var hidModel = thisForm.find('[name="model"]');
                    if(hidModel.length == 0)
                    {
                        hidModel = $('<input type="hidden" name="model" value='+thisForm.attr('model')+' />');
                        thisForm.append(hidModel);
                    }
                }
            },
            success : function(response,status,hxr,thisForm)
            {
                Core.Loading.hide();
                
                if(response.redirect)
                {
                    window.location.href = response.redirect;
                }
                
                if(response.status == 'error')
                {
                    // Show global error
                    if(response.error)
                    {
                        var divError = thisForm.find('.flash_error');
                        if(divError.length == 0)
                        {
                            divError = $('<div class="flash_error">')
                        }
                        divError.html('<p>'+response.error+'</p>');
                        thisForm.prepend(divError);
                    }
                    
                    // Show detail error
                    if(response.errors)
                    {
                        if(response.plugin == 'Admin')
                        {
                            $('.note-error').remove();
                            $('.state-error').removeClass('state-error');
                            
                            $.each(response.errors, function(field,msg)
                            {
                                var input = $('[name="'+field+'"]');
                                var divError = $('<div>').insertAfter(input);
                                divError.addClass('note').addClass('note-error').text(msg);
                                input.parent().addClass('state-error');
                            });
                        }
                        else
                        {
                            $('.error-message').remove();
                            $.each(response.errors, function(field,msg)
                            {
                                var input = $('[name="'+field+'"]');
                                var divError = $('<div>').insertAfter(input);
                                divError.addClass('error-message').text(msg);
                            });
                        }
                        
                    }
                }
                else if(response.status == 'success')
                {
                    location.reload();
                }
            }
        });

        // Init float overlay if not exist
        if($('#hw-floatbox-overlay').length == 0)
        {
            $('body').append('<div id="hw-floatbox-overlay">');
        }
        
        if($('#hw-loading').length == 0)
        {
            $('body').append('<div id="hw-loading"><img src ="'+BASE_URL+'img/core/hw-loading.gif" /></div>');
        }
    },
    
    scrollTo:function(select)
    {
        $("body").animate({ scrollTop: $(select).offset().top }, "slow");
    },

    Form:
    {
        validateFile: function() {
            $.each(IMAGE_FIELDS, function(key, value) {
                var inputField = $('[name="'+key+'"]');
                if (!inputField.length) {
                    return;
                }
                inputField.addClass('hw-file');
                $.each(value, function(rule, param) {
                    switch (rule) {
                        case 'size':
                            inputField.attr('hw-size', param);
                            break;
                        case 'extensions':
                            inputField.attr('hw-type', param.join('|').toLowerCase());
                            break;
                        case 'required':
                            inputField.attr('hw-required', param?1:0);
                            break;
                    }
                });
            });
            if (!$('.hw-file').length) {
                return;
            }
            $('[type="submit"]').click(function(event) {
                var form = $(this).parents('form');
                var inputFiles = form.find('.hw-file');
                inputFiles.each(function(i)
                {
                    var inputFile = $(this);
                    var nameField = inputFile.attr('name');
                    var maxSize = parseInt(inputFile.attr('hw-size'));
                    var types = [];
                    if (typeof inputFile.attr('hw-type') != 'undefined') {
                        types = inputFile.attr('hw-type').toLowerCase().split('|');
                    }
                    var inputError = $('<input class="hw_file_errors" name="hw_file_errors['+nameField+']" type="hidden">');
                        inputError.insertBefore(inputFile);
                    var typeError = false;
                    var required = inputFile.attr('hw-required');

                    if (inputFile.val())
                    {
                        if (this.files[0].size > maxSize)//validate size
                        {
                            typeError = FILE_ERROR_MAX_SIZE;
                        }

                        if (types.length) {//validate extension
                            var fileName = this.files[0].name;
                            var extension = fileName.substr( (fileName.lastIndexOf('.') +1) );
                            if ($.inArray(extension.toLowerCase(), types) == -1)
                            {
                                typeError = FILE_ERROR_EXTENSION;
                            }
                        }
                    } else {
                        //validate required
                        if (parseInt(required) || inputFile.attr('required') == 'required') {
                            typeError = FILE_ERROR_EMPTY;
                        }
                    }

                    if (typeError != false) {
                        inputError.val(typeError);
                        inputFile.attr('disabled', 'disabled');
                    }
                    inputFile.attr('name', nameField+'_tmp');
                });
            });
        },

        showImageWhenSelect: function() {
            var inputFiles = $('.hw-file');

            inputFiles.each(function() {
                var input = $(this);
                $('<div class="image-thumb-inputfile"></div>').insertBefore(input);
                var boxImage = input.prev();
                input.unbind('change').change(function() {
                    boxImage.html(null);
                    if (this.files && this.files[0] && this.files[0].type.indexOf('image') != -1) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            boxImage.html('<img src="'+ e.target.result+'" />');
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                })
            });
        }
    },

    FloatBox:
    {
        /* id of floatbox */
        show:function(id,overlayClick)
        {
            if($('#'+id).find('#hw-floatbox-close').length == 0)
            {
                var btnClose = $('<a href="" onclick="Core.FloatBox.hide(\''+id+'\');return false;" id="hw-floatbox-close"><img src="'+BASE_URL+'img/core/hw-floatbox-close.png" /></a>');
                $('#'+id).append(btnClose);
            }
            
            if(overlayClick && overlayClick == true)
            {
                $("#hw-floatbox-overlay").unbind("click").click(function()
                {
                    Core.FloatBox.hide(id);
                });
            }
            else
            {
                $("#hw-floatbox-overlay").unbind("click");
            }

            $('#'+id).show();
            $('#hw-floatbox-overlay').show();
            $('#'+id).css({'top':($(window).scrollTop()+30)+'px'});
        },

        /* id of floatbox */
        hide:function(id)
        {
            $('.error-message').remove();
            $('#'+id + ' .flash_error').remove();
            $('#'+id).hide();
            $('#hw-floatbox-overlay').hide();
        },
        
        /* msg : Message to alert */
        alert:function(msg,callback)
        {
            
        },
        /* msg : Message to confirm */
        confirm:function(msg,callback)
        {
            
        }
    },

    ShowImage:
    {
        initFancybox: function() {
            var fancyboxLink = $('.fancybox');
            fancyboxLink.each(function() {
                $(this).fancybox();
            })
        },

        initDeleteImage: function() {
            var links = $('.hw-delete-link');
            links.each(function() {
                var urlDelete = $(this).attr('href');
                $(this).unbind('click').click(function(e) {
                    $(this).parents('.hw-image').fadeOut();
                    e.preventDefault();
                })
            })
        }
    },

    Loading:
    {
        show:function()
        {
            $('#hw-loading').show();
        },
        hide:function()
        {
            $('#hw-loading').hide();
        }
    },
    
    buildHasMany: function(data)
    {
        var itemIndex = 0;
        var container = $(data.option.container);
        var tmpItem = $(data.option.container+' :first-child').first();
        tmpItem.addClass('hw-hasmany-item');
        container.empty();
                
        $.each(data.entities,function(index,item)
        {
            itemIndex = index;
            var newItem = tmpItem.clone();
            var arrInput = newItem.find('[name]');
            
            $.each(arrInput,function(subIndex,input)
            {
                var fieldName = $(input).attr('name');
                $(input).attr('name',data.name+'['+index+']['+fieldName+']');
                
                if($(input).attr('type') == 'checkbox') // Specific for Cake 3
                {
                    $(input).val(1);
                    $(input).prev('[type="hidden"]').val(0);
                    if(item['ent'][fieldName]) $(input).attr('checked',true);
                }
                else
                {
                    $(input).val(item['ent'][fieldName]);
                }
                
                $.each(item['errors'], function(field,msg)
                {
                    if(fieldName == field)
                    {
                        if(data.plugin == 'Admin')
                        {
                            var divError = $('<div>').insertAfter(input);
                            divError.addClass('note').addClass('note-error').text(msg);
                            $(input).parent().addClass('state-error');
                        }
                        else
                        {
                            var divError = $('<div>').insertAfter($(input));
                            divError.addClass('error-message').text(msg);
                        }
                    }
                });
                
            });
            
            container.append(newItem);
        });
        
        $(data.option.add).click(function() 
        {
            itemIndex++;
            
            var newItem = tmpItem.clone();
            var arrInput = newItem.find('[name]');
            
            // Set new index for input
            $.each(arrInput,function(subIndex,input)
            {
                var fieldName = $(input).attr('name');
                $(input).attr('name',data.name+'['+itemIndex+']['+fieldName+']');
                
                if($(input).attr('type') == 'checkbox') // Specific for Cake 3
                {
                    $(input).val(1);
                    $(input).prev('[type="hidden"]').val(0);
                }
                else
                {
                    $(input).val('');
                }
            });
            
            // Set event for delete button
            newItem.find(data.option.delete).click(function() 
            {
                $(this).closest('.hw-hasmany-item').remove();
                return false;
            });
            
            container.append(newItem);
            return false;
        });
        
        $(data.option.delete).click(function() 
        {
            $(this).closest('.hw-hasmany-item').remove();
            return false;
        });
    },
    
    buildAjaxMore : function(option)
    {
        $(option.link).attr('hw-model',option.model);
        $(option.link).attr('hw-element',option.element);
        $(option.link).attr('hw-page',option.page);
        $(option.link).attr('hw-page-count',option.pageCount);
        
        if(option.page == option.pageCount)
        {
            $(option.link).css('display','none');
        }
        
        $(option.link).click(function() 
        {
            var page = $(this).attr('hw-page');page++;
            var pageCount = $(this).attr('hw-page-count');
            
            var model = $(this).attr('hw-model');
            var element = $(this).attr('hw-element');                        
            var requestUrl = window.location.href + '?page='+page + '&ajax_more&model='+model+'&element='+element;
            
            $(option.link).addClass('disabled');
            $(option.link).attr('disabled',true);
            
            $.ajax
            ({
                type: "GET",
                dataType: 'text',
                contentType: 'json',
                url: requestUrl,
                success: function(r) 
                {
                    $(option.link).removeClass('disabled');
                    $(option.link).attr('disabled',false);
                    if(page == pageCount)
                    {
                        $(option.link).css('display','none');
                    }
                    $(option.link).attr('hw-page',page);
                    $(option.container).append(r);
                }
            });
            return false;
        });
    }        
};

$(document).ready(function()
{
    Core.init();
    Core.Form.validateFile();
    Core.Form.showImageWhenSelect();
    Core.ShowImage.initFancybox();
    Core.ShowImage.initDeleteImage();
});