+function(t){"use strict";function e(e){return this.each(function(){var o=t(this),n=o.data("bs.button"),a="object"==typeof e&&e;n||o.data("bs.button",n=new s(this,a)),"toggle"==e?n.toggle():e&&n.setState(e)})}var s=function(e,o){this.$element=t(e),this.options=t.extend({},s.DEFAULTS,o),this.isLoading=!1};s.VERSION="3.3.4",s.DEFAULTS={loadingText:"loading..."},s.prototype.setState=function(e){var s="disabled",o=this.$element,n=o.is("input")?"val":"html",a=o.data();e+="Text",null==a.resetText&&o.data("resetText",o[n]()),setTimeout(t.proxy(function(){o[n](null==a[e]?this.options[e]:a[e]),"loadingText"==e?(this.isLoading=!0,o.addClass(s).attr(s,s)):this.isLoading&&(this.isLoading=!1,o.removeClass(s).removeAttr(s))},this),0)},s.prototype.toggle=function(){var t=!0,e=this.$element.closest('[data-toggle="buttons"]');if(e.length){var s=this.$element.find("input");"radio"==s.prop("type")&&(s.prop("checked")&&this.$element.hasClass("active")?t=!1:e.find(".active").removeClass("active")),t&&s.prop("checked",!this.$element.hasClass("active")).trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active"));t&&this.$element.toggleClass("active")};var o=t.fn.button;t.fn.button=e,t.fn.button.Constructor=s,t.fn.button.noConflict=function(){return t.fn.button=o,this},t(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(s){var o=t(s.target);o.hasClass("btn")||(o=o.closest(".btn")),e.call(o,"toggle"),s.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(e){t(e.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(e.type))})}(jQuery),function(t){t(document).ready(function(t){function e(){t.ajax({type:"post",dataType:"json",url:mZ_check_session_logged.ajaxurl,data:{action:"mz_mbo_check_session_logged"},success:function(e){"1"==e.logged_in?(t(".signup").text(mZ_check_session_logged.signup),t(".mz_add_to_class").prop("title",mZ_check_session_logged.signup),t(".mz_add_to_class").prop("id","mz_add_to_class"),t(".mz_add_to_class").removeAttr("href")):(t(".signup").text(mZ_check_session_logged.login),t(".mz_add_to_class").prop("title",mZ_check_session_logged.login_title))}})}e()})}(jQuery);
//# sourceMappingURL=ajax-mbo-check-logged.js.map