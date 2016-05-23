if (typeof jQuery === 'undefined') {
  throw new Error('luffyUpload\'s JavaScript requires jQuery')
}

+function ($) {
  'use strict';
  var version = $.fn.jquery.split(' ')[0].split('.')
  if ((version[0] < 2 && version[1] < 9) || (version[0] == 1 && version[1] == 9 && version[2] < 1)) {
    throw new Error('luffyUpload\'s JavaScript requires jQuery version 1.9.1 or higher')
  }
}(jQuery);

+function ($) {
  'use strict';

  var luffyUploadPic = function (element,options) {
        var that = this;

        this.element = $(element);
        this.host = options.host || "/admin/upload/uploadpic";
        this.width = options.width || this.element.data('width') || 100;
        this.height = options.height || this.element.data('height') || 100;
        this.backCall = options.backCall || this.element.data('backCall') || undefined;
        this.defaultImg = options.defaultImg || this.element.data('defaultImg') || '/static/admin/images/default_head.gif';
        
        $('<iframe>',{
            width:this.width,
            height:this.height,
            scrolling:"no",
            frameborder:"0",
            border:"0",
            src:this.getUrl()
        }).insertAfter(element);
  };

  $.fn.luffyuploadpic = function (option) {
    if (typeof option == 'undefined'){
      option = {};
    }
    new luffyUploadPic(this,option);
  };

  luffyUploadPic.prototype = {
    getUrl : function () {
         return this.host + '?width=' + this.width + '&height=' + this.height + '&backCall='+ this.backCall + '&defaultImg=' + this.defaultImg;
    }
  };
}(jQuery);

