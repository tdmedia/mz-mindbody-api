+function(t){"use strict";function e(e){return this.each(function(){var i=t(this),s=i.data("bs.button"),n="object"==typeof e&&e;s||i.data("bs.button",s=new o(this,n)),"toggle"==e?s.toggle():e&&s.setState(e)})}var o=function(e,i){this.$element=t(e),this.options=t.extend({},o.DEFAULTS,i),this.isLoading=!1};o.VERSION="3.3.4",o.DEFAULTS={loadingText:"loading..."},o.prototype.setState=function(e){var o="disabled",i=this.$element,s=i.is("input")?"val":"html",n=i.data();e+="Text",null==n.resetText&&i.data("resetText",i[s]()),setTimeout(t.proxy(function(){i[s](null==n[e]?this.options[e]:n[e]),"loadingText"==e?(this.isLoading=!0,i.addClass(o).attr(o,o)):this.isLoading&&(this.isLoading=!1,i.removeClass(o).removeAttr(o))},this),0)},o.prototype.toggle=function(){var t=!0,e=this.$element.closest('[data-toggle="buttons"]');if(e.length){var o=this.$element.find("input");"radio"==o.prop("type")&&(o.prop("checked")&&this.$element.hasClass("active")?t=!1:e.find(".active").removeClass("active")),t&&o.prop("checked",!this.$element.hasClass("active")).trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active"));t&&this.$element.toggleClass("active")};var i=t.fn.button;t.fn.button=e,t.fn.button.Constructor=o,t.fn.button.noConflict=function(){return t.fn.button=i,this},t(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(o){var i=t(o.target);i.hasClass("btn")||(i=i.closest(".btn")),e.call(i,"toggle"),o.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(e){t(e.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(e.type))})}(jQuery),+function(t){"use strict";function e(e,i){return this.each(function(){var s=t(this),n=s.data("bs.modal"),a=t.extend({},o.DEFAULTS,s.data(),"object"==typeof e&&e);n||s.data("bs.modal",n=new o(this,a)),"string"==typeof e?n[e](i):a.show&&n.show(i)})}var o=function(e,o){this.options=o,this.$body=t(document.body),this.$element=t(e),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,t.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};o.VERSION="3.3.4",o.TRANSITION_DURATION=300,o.BACKDROP_TRANSITION_DURATION=150,o.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},o.prototype.toggle=function(t){return this.isShown?this.hide():this.show(t)},o.prototype.show=function(e){var i=this,s=t.Event("show.bs.modal",{relatedTarget:e});this.$element.trigger(s),this.isShown||s.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',t.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){i.$element.one("mouseup.dismiss.bs.modal",function(e){t(e.target).is(i.$element)&&(i.ignoreBackdropClick=!0)})}),this.backdrop(function(){var s=t.support.transition&&i.$element.hasClass("fade");i.$element.parent().length||i.$element.appendTo(i.$body),i.$element.show().scrollTop(0),i.adjustDialog(),s&&i.$element[0].offsetWidth,i.$element.addClass("in").attr("aria-hidden",!1),i.enforceFocus();var n=t.Event("shown.bs.modal",{relatedTarget:e});s?i.$dialog.one("bsTransitionEnd",function(){i.$element.trigger("focus").trigger(n)}).emulateTransitionEnd(o.TRANSITION_DURATION):i.$element.trigger("focus").trigger(n)}))},o.prototype.hide=function(e){e&&e.preventDefault(),e=t.Event("hide.bs.modal"),this.$element.trigger(e),this.isShown&&!e.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),t(document).off("focusin.bs.modal"),this.$element.removeClass("in").attr("aria-hidden",!0).off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),t.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",t.proxy(this.hideModal,this)).emulateTransitionEnd(o.TRANSITION_DURATION):this.hideModal())},o.prototype.enforceFocus=function(){t(document).off("focusin.bs.modal").on("focusin.bs.modal",t.proxy(function(t){this.$element[0]===t.target||this.$element.has(t.target).length||this.$element.trigger("focus")},this))},o.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",t.proxy(function(t){27==t.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},o.prototype.resize=function(){this.isShown?t(window).on("resize.bs.modal",t.proxy(this.handleUpdate,this)):t(window).off("resize.bs.modal")},o.prototype.hideModal=function(){var t=this;this.$element.hide(),this.backdrop(function(){t.$body.removeClass("modal-open"),t.resetAdjustments(),t.resetScrollbar(),t.$element.trigger("hidden.bs.modal")})},o.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},o.prototype.backdrop=function(e){var i=this,s=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var n=t.support.transition&&s;if(this.$backdrop=t('<div class="modal-backdrop '+s+'" />').appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",t.proxy(function(t){return this.ignoreBackdropClick?void(this.ignoreBackdropClick=!1):void(t.target===t.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide()))},this)),n&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!e)return;n?this.$backdrop.one("bsTransitionEnd",e).emulateTransitionEnd(o.BACKDROP_TRANSITION_DURATION):e()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var a=function(){i.removeBackdrop(),e&&e()};t.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",a).emulateTransitionEnd(o.BACKDROP_TRANSITION_DURATION):a()}else e&&e()},o.prototype.handleUpdate=function(){this.adjustDialog()},o.prototype.adjustDialog=function(){var t=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&t?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!t?this.scrollbarWidth:""})},o.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},o.prototype.checkScrollbar=function(){var t=window.innerWidth;if(!t){var e=document.documentElement.getBoundingClientRect();t=e.right-Math.abs(e.left)}this.bodyIsOverflowing=document.body.clientWidth<t,this.scrollbarWidth=this.measureScrollbar()},o.prototype.setScrollbar=function(){var t=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"",this.bodyIsOverflowing&&this.$body.css("padding-right",t+this.scrollbarWidth)},o.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)},o.prototype.measureScrollbar=function(){var t=document.createElement("div");t.className="modal-scrollbar-measure",this.$body.append(t);var e=t.offsetWidth-t.clientWidth;return this.$body[0].removeChild(t),e};var i=t.fn.modal;t.fn.modal=e,t.fn.modal.Constructor=o,t.fn.modal.noConflict=function(){return t.fn.modal=i,this},t(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(o){var i=t(this),s=i.attr("href"),n=t(i.attr("data-target")||s&&s.replace(/.*(?=#[^\s]+$)/,"")),a=n.data("bs.modal")?"toggle":t.extend({remote:!/#/.test(s)&&s},n.data(),i.data());i.is("a")&&o.preventDefault(),n.one("show.bs.modal",function(t){t.isDefaultPrevented()||n.one("hidden.bs.modal",function(){i.is(":visible")&&i.trigger("focus")})}),e.call(n,a,this)})}(jQuery),function(t){t(document).ready(function(t){t("a[data-target=#mzModal]").click(function(e){e.preventDefault();var o=t(this).attr("href"),i=t(this).attr("data-maincontent");t("#mzModal").load(o,function(){t("#mzModal").modal({show:!0}),t(".modal-body span").html(decodeURIComponent(i))}),t("body").on("hidden.bs.modal","#mzModal",function(){t(this).removeData("bs.modal")})})}),t(document).ready(function(t){t("a[data-target=#mzStaffModal]").click(function(e){e.preventDefault();{var o=t(this).attr("href");t(this).attr("data-maincontent")}t("#mzStaffModal").load(o,function(){t("#mzStaffModal").modal({show:!0}),t("#staffBio").innerHTML=staffBio}),t("body").on("hidden.bs.modal","#mzStaffModal",function(){t(this).removeData("bs.modal")})})})}(jQuery);
//# sourceMappingURL=main.js.map