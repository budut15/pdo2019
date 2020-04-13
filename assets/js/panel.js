
+function($, window, document, undefined){
  var container = '<div class="toast-wrap2"></div>';
  var context = '<div class="toast-content2"></div>';
  var wrapSelector = ".toast-wrap2";
  var toastSelector = ".toast-content2";
  var styles = '.toast-wrap2{position: absolute;left:0;top:0;right:0;bottom:0;z-index:2;background-color: rgba(255,255,255,0.8);}.toast-content2{position: absolute;transform: translateY(-50%);-webkit-transform: translateY(-50%);-ms-transform: translateY(-50%);top: 50%;left: 0;right: 0;text-align: center;color: #555;}.toast-img{display:block;max-width: 100px;max-height: 100px;margin: 0 auto 5px;}.success{display:block;width: 12px;height: 20px;border-right:6px solid #fff;border-bottom: 8px solid #fff;transform: rotate(45deg);-webkit-transform:rotate(45deg);margin: 0 auto 5px;}.error{display:block;width: 24px;height: 24px;font-size: 20px;color:rgba(255,255,255,.8);border:2px solid rgba(255,255,255,.8);border-radius: 50%;-webkit-border-radius: 50%;margin: 0 auto 5px;line-height:20px;text-align: center}.loading{position:relative;margin: 0 auto 5px;display:block;width:20px;height: 20px;border: 2px solid #fff;border-radius: 50%;-webkit-border-radius: 50%;animation: loading 1s linear infinite;}.loading:before{content: "";display: block;position: absolute;top: -5px;left: 0;width: 10px;height: 10px;background: #fff;border-radius: 50%; }@keyframes loading{0%{transform: rotate(0deg);}50%{transform: rotate(180deg);}100%{transform: rotate(360deg);}}@-webkit-keyframes loading{0%{-webkit-transform: rotate(0deg);}50%{-webkit-transform: rotate(180deg);}100%{-webkit-transform: rotate(360deg);}}';

  var Toast2 = {
    default : {
      "title": "Loading...", // <String>提示的内容，默认："加载中..."
      "icon": "loading", // <String>图标，有效值 "success", "loading", "none", "error"，默认"loading"
      "image": "", // <String>自定义图标的本地路径，image 的优先级高于 icon
      "kelas": "", // <String>自定义图标的本地路径，image 的优先级高于 icon
      "duration": 1500, // <Number>提示的延迟时间，单位毫秒，默认：1500(设置为0时不自动关闭)
    },
    showToast: function(opt){
      var _this = this;
      this.options = $.extend({}, this.default, opt);
	  $(wrapSelector).empty().remove();
	  $(this.options.kelas).append(container);
      $(wrapSelector).append(context);
      $("<style></style>").text(styles).appendTo($(wrapSelector));
      if(this.options.image !== ""){
        $(toastSelector).append('<img src="'+this.options.image+'" class="toast-img" alt="toast...">');
      } else {
        $(toastSelector).append('<span class="toast-icon"></span>');
        switch(this.options.icon){
          case "success":
            $(".toast-icon").addClass('success');
            break;
          case "error":
            $(".toast-icon").addClass('error');
            $(".toast-icon").html("&times;");
            break;
          case "none":
            $(".toast-icon").remove();
            break;
          default:
            $(".toast-icon").addClass('loading');
            break;
        }
      }
      $(toastSelector).append('<p></p>').find('p').html(this.options.title);
      if(this.options.duration>0){
        setTimeout(function(){
          _this.hideToast();
        }, this.options.duration);
      }
    },
    hideToast: function(){
      if($(wrapSelector).length){
        $(wrapSelector).fadeOut(500);
        setTimeout(function(){
          $(wrapSelector).empty().remove();
        },1000);
      } else {
        return;
      }
    }
  };
  $.Toast2 = Toast2;
}(jQuery, window, document);
