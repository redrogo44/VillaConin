(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["dynamicContent"],{"126d":function(n,t,e){var u=e("6da8"),f=e("aaec"),i=e("d094");function o(n){return f(n)?i(n):u(n)}n.exports=o},"2b10":function(n,t){function e(n,t,e){var u=-1,f=n.length;t<0&&(t=-t>f?0:f+t),e=e>f?f:e,e<0&&(e+=f),f=t>e?0:e-t>>>0,t>>>=0;var i=Array(f);while(++u<f)i[u]=n[u+t];return i}n.exports=e},"6da8":function(n,t){function e(n){return n.split("")}n.exports=e},8103:function(n,t,e){var u=e("d194"),f=u("toUpperCase");n.exports=f},aaec:function(n,t){var e="\\ud800-\\udfff",u="\\u0300-\\u036f",f="\\ufe20-\\ufe2f",i="\\u20d0-\\u20ff",o=u+f+i,c="\\ufe0e\\ufe0f",r="\\u200d",a=RegExp("["+r+e+o+c+"]");function s(n){return a.test(n)}n.exports=s},c32f:function(n,t,e){var u=e("2b10");function f(n,t,e){var f=n.length;return e=void 0===e?f:e,!t&&e>=f?n:u(n,t,e)}n.exports=f},cf45:function(n,t,e){"use strict";e.r(t);var u=function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{staticClass:"main-content"},[e("div",{staticClass:"main-content__top"},[e("h1",{staticClass:"main-content__title"},[n._v("\n        "+n._s(n.sectionName)+"\n      ")])]),e("div",{staticClass:"main-content__body"},[n._v("\n      This "),e("strong",[n._v(n._s(n.sectionName))]),n._v(" page, is dynamic for the sake of simplicity.\n  ")])])},f=[],i=e("e740"),o=e.n(i),c={name:"dynamicContent",computed:{sectionName:function(){return o()(this.$route.params.sectionSlug)}}},r=c,a=e("2877"),s=Object(a["a"])(r,u,f,!1,null,null,null);t["default"]=s.exports},d094:function(n,t){var e="\\ud800-\\udfff",u="\\u0300-\\u036f",f="\\ufe20-\\ufe2f",i="\\u20d0-\\u20ff",o=u+f+i,c="\\ufe0e\\ufe0f",r="["+e+"]",a="["+o+"]",s="\\ud83c[\\udffb-\\udfff]",d="(?:"+a+"|"+s+")",p="[^"+e+"]",v="(?:\\ud83c[\\udde6-\\uddff]){2}",l="[\\ud800-\\udbff][\\udc00-\\udfff]",m="\\u200d",_=d+"?",x="["+c+"]?",h="(?:"+m+"(?:"+[p,v,l].join("|")+")"+x+_+")*",b=x+_+h,g="(?:"+[p+a+"?",a,v,l,r].join("|")+")",w=RegExp(s+"(?="+s+")|"+g+b,"g");function C(n){return n.match(w)||[]}n.exports=C},d194:function(n,t,e){var u=e("c32f"),f=e("aaec"),i=e("126d"),o=e("76dd");function c(n){return function(t){t=o(t);var e=f(t)?i(t):void 0,c=e?e[0]:t.charAt(0),r=e?u(e,1).join(""):t.slice(1);return c[n]()+r}}n.exports=c},e740:function(n,t,e){var u=e("b20a"),f=e("8103"),i=u(function(n,t,e){return n+(e?" ":"")+f(t)});n.exports=i}}]);
//# sourceMappingURL=dynamicContent.7512b36a.js.map