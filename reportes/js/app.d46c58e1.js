(function(t){function e(e){for(var a,r,i=e[0],c=e[1],l=e[2],u=0,f=[];u<i.length;u++)r=i[u],o[r]&&f.push(o[r][0]),o[r]=0;for(a in c)Object.prototype.hasOwnProperty.call(c,a)&&(t[a]=c[a]);d&&d(e);while(f.length)f.shift()();return s.push.apply(s,l||[]),n()}function n(){for(var t,e=0;e<s.length;e++){for(var n=s[e],a=!0,r=1;r<n.length;r++){var c=n[r];0!==o[c]&&(a=!1)}a&&(s.splice(e--,1),t=i(i.s=n[0]))}return t}var a={},o={app:0},s=[];function r(t){return i.p+"js/"+({dynamicContent:"dynamicContent"}[t]||t)+"."+{dynamicContent:"7512b36a"}[t]+".js"}function i(e){if(a[e])return a[e].exports;var n=a[e]={i:e,l:!1,exports:{}};return t[e].call(n.exports,n,n.exports,i),n.l=!0,n.exports}i.e=function(t){var e=[],n=o[t];if(0!==n)if(n)e.push(n[2]);else{var a=new Promise(function(e,a){n=o[t]=[e,a]});e.push(n[2]=a);var s,c=document.createElement("script");c.charset="utf-8",c.timeout=120,i.nc&&c.setAttribute("nonce",i.nc),c.src=r(t),s=function(e){c.onerror=c.onload=null,clearTimeout(l);var n=o[t];if(0!==n){if(n){var a=e&&("load"===e.type?"missing":e.type),s=e&&e.target&&e.target.src,r=new Error("Loading chunk "+t+" failed.\n("+a+": "+s+")");r.type=a,r.request=s,n[1](r)}o[t]=void 0}};var l=setTimeout(function(){s({type:"timeout",target:c})},12e4);c.onerror=c.onload=s,document.head.appendChild(c)}return Promise.all(e)},i.m=t,i.c=a,i.d=function(t,e,n){i.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},i.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},i.t=function(t,e){if(1&e&&(t=i(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(i.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var a in t)i.d(n,a,function(e){return t[e]}.bind(null,a));return n},i.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="/",i.oe=function(t){throw console.error(t),t};var c=window["webpackJsonp"]=window["webpackJsonp"]||[],l=c.push.bind(c);c.push=e,c=c.slice();for(var u=0;u<c.length;u++)e(c[u]);var d=l;s.push([0,"chunk-vendors"]),n()})({0:function(t,e,n){t.exports=n("56d7")},4678:function(t,e,n){var a={"./af":"2bfb","./af.js":"2bfb","./ar":"8e73","./ar-dz":"a356","./ar-dz.js":"a356","./ar-kw":"423e","./ar-kw.js":"423e","./ar-ly":"1cfd","./ar-ly.js":"1cfd","./ar-ma":"0a84","./ar-ma.js":"0a84","./ar-sa":"8230","./ar-sa.js":"8230","./ar-tn":"6d83","./ar-tn.js":"6d83","./ar.js":"8e73","./az":"485c","./az.js":"485c","./be":"1fc1","./be.js":"1fc1","./bg":"84aa","./bg.js":"84aa","./bm":"a7fa","./bm.js":"a7fa","./bn":"9043","./bn.js":"9043","./bo":"d26a","./bo.js":"d26a","./br":"6887","./br.js":"6887","./bs":"2554","./bs.js":"2554","./ca":"d716","./ca.js":"d716","./cs":"3c0d","./cs.js":"3c0d","./cv":"03ec","./cv.js":"03ec","./cy":"9797","./cy.js":"9797","./da":"0f14","./da.js":"0f14","./de":"b469","./de-at":"b3eb","./de-at.js":"b3eb","./de-ch":"bb71","./de-ch.js":"bb71","./de.js":"b469","./dv":"598a","./dv.js":"598a","./el":"8d47","./el.js":"8d47","./en-SG":"cdab","./en-SG.js":"cdab","./en-au":"0e6b","./en-au.js":"0e6b","./en-ca":"3886","./en-ca.js":"3886","./en-gb":"39a6","./en-gb.js":"39a6","./en-ie":"e1d3","./en-ie.js":"e1d3","./en-il":"7333","./en-il.js":"7333","./en-nz":"6f50","./en-nz.js":"6f50","./eo":"65db","./eo.js":"65db","./es":"898b","./es-do":"0a3c","./es-do.js":"0a3c","./es-us":"55c9","./es-us.js":"55c9","./es.js":"898b","./et":"ec18","./et.js":"ec18","./eu":"0ff2","./eu.js":"0ff2","./fa":"8df4","./fa.js":"8df4","./fi":"81e9","./fi.js":"81e9","./fo":"0721","./fo.js":"0721","./fr":"9f26","./fr-ca":"d9f8","./fr-ca.js":"d9f8","./fr-ch":"0e49","./fr-ch.js":"0e49","./fr.js":"9f26","./fy":"7118","./fy.js":"7118","./ga":"5120","./ga.js":"5120","./gd":"f6b4","./gd.js":"f6b4","./gl":"8840","./gl.js":"8840","./gom-latn":"0caa","./gom-latn.js":"0caa","./gu":"e0c5","./gu.js":"e0c5","./he":"c7aa","./he.js":"c7aa","./hi":"dc4d","./hi.js":"dc4d","./hr":"4ba9","./hr.js":"4ba9","./hu":"5b14","./hu.js":"5b14","./hy-am":"d6b6","./hy-am.js":"d6b6","./id":"5038","./id.js":"5038","./is":"0558","./is.js":"0558","./it":"6e98","./it-ch":"6f12","./it-ch.js":"6f12","./it.js":"6e98","./ja":"079e","./ja.js":"079e","./jv":"b540","./jv.js":"b540","./ka":"201b","./ka.js":"201b","./kk":"6d79","./kk.js":"6d79","./km":"e81d","./km.js":"e81d","./kn":"3e92","./kn.js":"3e92","./ko":"22f8","./ko.js":"22f8","./ku":"2421","./ku.js":"2421","./ky":"9609","./ky.js":"9609","./lb":"440c","./lb.js":"440c","./lo":"b29d","./lo.js":"b29d","./lt":"26f9","./lt.js":"26f9","./lv":"b97c","./lv.js":"b97c","./me":"293c","./me.js":"293c","./mi":"688b","./mi.js":"688b","./mk":"6909","./mk.js":"6909","./ml":"02fb","./ml.js":"02fb","./mn":"958b","./mn.js":"958b","./mr":"39bd","./mr.js":"39bd","./ms":"ebe4","./ms-my":"6403","./ms-my.js":"6403","./ms.js":"ebe4","./mt":"1b45","./mt.js":"1b45","./my":"8689","./my.js":"8689","./nb":"6ce3","./nb.js":"6ce3","./ne":"3a39","./ne.js":"3a39","./nl":"facd","./nl-be":"db29","./nl-be.js":"db29","./nl.js":"facd","./nn":"b84c","./nn.js":"b84c","./pa-in":"f3ff","./pa-in.js":"f3ff","./pl":"8d57","./pl.js":"8d57","./pt":"f260","./pt-br":"d2d4","./pt-br.js":"d2d4","./pt.js":"f260","./ro":"972c","./ro.js":"972c","./ru":"957c","./ru.js":"957c","./sd":"6784","./sd.js":"6784","./se":"ffff","./se.js":"ffff","./si":"eda5","./si.js":"eda5","./sk":"7be6","./sk.js":"7be6","./sl":"8155","./sl.js":"8155","./sq":"c8f3","./sq.js":"c8f3","./sr":"cf1e","./sr-cyrl":"13e9","./sr-cyrl.js":"13e9","./sr.js":"cf1e","./ss":"52bd","./ss.js":"52bd","./sv":"5fbd","./sv.js":"5fbd","./sw":"74dc","./sw.js":"74dc","./ta":"3de5","./ta.js":"3de5","./te":"5cbb","./te.js":"5cbb","./tet":"576c","./tet.js":"576c","./tg":"3b1b","./tg.js":"3b1b","./th":"10e8","./th.js":"10e8","./tl-ph":"0f38","./tl-ph.js":"0f38","./tlh":"cf75","./tlh.js":"cf75","./tr":"0e81","./tr.js":"0e81","./tzl":"cf51","./tzl.js":"cf51","./tzm":"c109","./tzm-latn":"b53d","./tzm-latn.js":"b53d","./tzm.js":"c109","./ug-cn":"6117","./ug-cn.js":"6117","./uk":"ada2","./uk.js":"ada2","./ur":"5294","./ur.js":"5294","./uz":"2e8c","./uz-latn":"010e","./uz-latn.js":"010e","./uz.js":"2e8c","./vi":"2921","./vi.js":"2921","./x-pseudo":"fd7e","./x-pseudo.js":"fd7e","./yo":"7f33","./yo.js":"7f33","./zh-cn":"5c3a","./zh-cn.js":"5c3a","./zh-hk":"49ab","./zh-hk.js":"49ab","./zh-tw":"90ea","./zh-tw.js":"90ea"};function o(t){var e=s(t);return n(e)}function s(t){var e=a[t];if(!(e+1)){var n=new Error("Cannot find module '"+t+"'");throw n.code="MODULE_NOT_FOUND",n}return e}o.keys=function(){return Object.keys(a)},o.resolve=s,t.exports=o,o.id="4678"},"56d7":function(t,e,n){"use strict";n.r(e);n("cadf"),n("551c"),n("f751"),n("097d");var a,o,s,r,i,c,l,u,d=n("2b0e"),f=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{class:t.wrapperClass,attrs:{id:"wrapper"}},[n("MenuToggleBtn"),n("Menu"),n("ContentOverlay"),n("router-view")],1)},h=[],p=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("a",{staticClass:"btn menu-toggle-btn",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.toggleMenu(e)}}},[n("i",{staticClass:"fa fa-bars",attrs:{"aria-hidden":"true"}})])},m=[],b={methods:{toggleMenu:function(){window.bus.$emit("menu/toggle")}}},v=b,j=n("2877"),g=Object(j["a"])(v,p,m,!1,null,null,null),_=g.exports,y=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"menu-container"},[n("ul",{staticClass:"menu"},[n("li",{staticClass:"menu__top"},[n("router-link",{staticClass:"menu__logo",attrs:{to:"/"}},[n("img",{attrs:{src:"/icon-32.png",alt:"icon"}})]),n("a",{staticClass:"menu__title",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.openProjectLink(e)}}},[t._v("\n       Villa Conin Reportes\n      ")])],1),n("li",[n("a",{class:t.highlightSection("home"),attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.updateMenu("home")}}},[n("i",{staticClass:"fa fa-home menu__icon",attrs:{"aria-hidden":"true"}}),t._v("\n          Home\n      ")])]),n("li",[n("a",{class:t.highlightSection("products"),attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.updateMenu("products")}}},[n("i",{staticClass:"fa fa-tag menu__icon",attrs:{"aria-hidden":"true"}}),t._v("\n        Products\n        "),n("i",{staticClass:"fa fa-chevron-right menu__arrow-icon",attrs:{"aria-hidden":"true"}})])]),n("li",[n("a",{class:t.highlightSection("comensales"),attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.updateMenu("comensales")}}},[n("i",{staticClass:"fa fa-tag menu__icon",attrs:{"aria-hidden":"true"}}),t._v("\n        Comensales\n        "),n("i",{staticClass:"fa fa-chevron-right menu__arrow-icon",attrs:{"aria-hidden":"true"}})])]),n("li",[n("a",{class:t.highlightSection("eventos"),attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.updateMenu("eventos")}}},[n("i",{staticClass:"fa fa-home menu__icon",attrs:{"aria-hidden":"true"}}),t._v("\n          Eventos\n      ")])]),n("li",[n("a",{class:t.highlightSection("customers"),attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.updateMenu("customers")}}},[n("i",{staticClass:"fa fa-users menu__icon",attrs:{"aria-hidden":"true"}}),t._v("\n        Customers\n        "),n("i",{staticClass:"fa fa-chevron-right menu__arrow-icon",attrs:{"aria-hidden":"true"}})])]),n("li",[n("a",{class:t.highlightSection("account"),attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.updateMenu("account")}}},[n("i",{staticClass:"fa fa-user menu__icon",attrs:{"aria-hidden":"true"}}),t._v("\n        Account\n        "),n("i",{staticClass:"fa fa-chevron-right menu__arrow-icon",attrs:{"aria-hidden":"true"}})])])]),n("transition",{attrs:{name:"slide-fade"}},[n("div",{directives:[{name:"show",rawName:"v-show",value:t.showContextMenu,expression:"showContextMenu"}],staticClass:"context-menu-container"},[n("ul",{staticClass:"context-menu"},t._l(t.menuItens,function(e,a){return n("li",{key:a},["title"===e.type?n("h5",{staticClass:"context-menu__title"},[n("i",{class:e.icon,attrs:{"aria-hidden":"true"}}),t._v("\n\n            "+t._s(e.txt)+"\n\n            "),0===a?n("a",{staticClass:"context-menu__btn-close",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.closeContextMenu(e)}}},[n("i",{staticClass:"fa fa-window-close",attrs:{"aria-hidden":"true"}})]):t._e()]):n("a",{class:t.subMenuClass(e.txt),attrs:{href:"#"},on:{click:function(n){return n.preventDefault(),t.openSection(e)}}},[t._v("\n            "+t._s(e.txt)+"\n          ")])])}),0)])])],1)},F=[],k=(n("b54a"),{home:[],comensales:[{type:"title",txt:"Comensales",icon:"fa fa-tag context-menu__title-icon"},{type:"link",txt:"Anual",link:"/comensales"}],eventos:[],products:[{type:"title",txt:"Products",icon:"fa fa-tag context-menu__title-icon"},{type:"link",txt:"List Products",link:"/page"},{type:"link",txt:"Add New Product",link:"/page"},{type:"link",txt:"Manage Categories",link:"/page"}],customers:[{type:"title",txt:"Customers",icon:"fa fa-users context-menu__title-icon"},{type:"link",txt:"List Customers",link:"/page"},{type:"link",txt:"List Contacts",link:"/page"},{type:"link",txt:"List Newsletters",link:"/page"}],account:[{type:"title",txt:"My Account",icon:"fa fa-user context-menu__title-icon"},{type:"link",txt:"Change Password",link:"/page"},{type:"link",txt:"Change Settings",link:"/page"},{type:"link",txt:"Logout",link:"/page"},{type:"title",txt:"Change Subscription",icon:"fa fa-credit-card context-menu__title-icon"},{type:"link",txt:"Plans",link:"/page"},{type:"link",txt:"Payment Settings",link:"/page"},{type:"link",txt:"Payment History",link:"/page"}]}),C=n("375a"),w=n.n(C),x={name:"Menu",data:function(){return{contextSection:"",menuItens:[],menuData:k,activeSubMenu:""}},methods:{openProjectLink:function(){alert("You could open the project frontend in another tab here, so the logged admin could see changes made to the project ;)")},updateMenu:function(t){this.contextSection=t,this.menuItens=this.menuData[t],"home"===t&&(this.$router.push("/"),window.bus.$emit("menu/closeMobileMenu")),"eventos"===t&&(this.$router.push("/reportes/eventos"),window.bus.$emit("menu/closeMobileMenu"))},highlightSection:function(t){return{menu__link:!0,"menu__link--active":t===this.contextSection}},subMenuClass:function(t){return{"context-menu__link":!0,"context-menu__link--active":this.activeSubMenu===t}},closeContextMenu:function(){this.contextSection="",this.menuItens=[]},openSection:function(t){this.activeSubMenu=t.txt,this.$router.push(this.getUrl(t)),window.bus.$emit("menu/closeMobileMenu")},getUrl:function(t){var e=w()(t.txt);return"".concat(t.link,"/").concat(e)}},computed:{showContextMenu:function(){return this.menuItens.length}}},M=x,D=Object(j["a"])(M,y,F,!1,null,null,null),S=D.exports,O=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"content-overlay",on:{click:function(e){return e.preventDefault(),t.closeMobileMenu(e)}}})},E=[],z={methods:{closeMobileMenu:function(){window.bus.$emit("menu/toggle")}}},P=z,$=Object(j["a"])(P,O,E,!1,null,null,null),B=$.exports,T={components:{MenuToggleBtn:_,Menu:S,ContentOverlay:B},created:function(){var t=this;window.bus.$on("menu/toggle",function(){window.setTimeout(function(){t.isOpenMobileMenu=!t.isOpenMobileMenu},200)}),window.bus.$on("menu/closeMobileMenu",function(){t.isOpenMobileMenu=!1})},data:function(){return{isOpenMobileMenu:!1}},computed:{wrapperClass:function(){return{toggled:!0===this.isOpenMobileMenu}}}},A=T,L=(n("5c0b"),Object(j["a"])(A,f,h,!1,null,null,null)),q=L.exports,H=n("8c4f"),I=function(){var t=this,e=t.$createElement;t._self._c;return t._m(0)},N=[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"main-content"},[n("div",{staticClass:"main-content__top"},[n("h1",{staticClass:"main-content__title"},[t._v("\n          Home\n      ")])]),n("div",{staticClass:"main-content__body"},[n("p",[t._v("\n      Hi! This is a simplified version of the responsive menu I implemented in the\n      Admin Panel of a project some time ago. Maybe it can help newcomers to\n      "),n("a",{attrs:{href:"https://vuejs.org/"}},[t._v("Vue.js")]),t._v(" and "),n("a",{attrs:{href:"https://router.vuejs.org/"}},[t._v("Vue Router")]),t._v("\n      to have some ideas of how to start puting the framework, router, styles\n      and other concepts together.\n    ")]),n("p",[t._v("\n      You can find the Github Repository of this menu\n      "),n("a",{attrs:{href:"https://github.com/daniel-cintra/vue-menu"}},[t._v("here")]),t._v(".\n    ")]),n("p",[t._v("\n      The menu can be easily customized changing:\n    ")]),n("ol",[n("li",[n("strong",[t._v("src/components/Menu.vue")]),t._v("\n        where the root level itens can be found.\n      ")]),n("li",[n("strong",[t._v("src/components/support/menu-data.js")]),t._v("\n        where the childs of root level itens can be found.\n      ")]),n("li",[n("strong",[t._v("src/router.js")]),t._v("\n        where each route can be mapped to load the correspondent component.\n        For the sake of simplicity, with exception of the "),n("strong",[t._v("home route")]),t._v(", the\n        sections are loaded dynamically in this example.\n      ")])])])])}],G={name:"home"},J=G,U=Object(j["a"])(J,I,N,!1,null,null,null),R=U.exports,V=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"main-content"},[n("div",{staticClass:"main-content__top"},[n("h1",{staticClass:"main-content__title"},[t._v("\n          Eventos "+t._s(t.selected)+"\n      ")])]),n("div",{staticClass:"main-content__body"},[n("b-form-select",{attrs:{options:t.options},model:{value:t.selected,callback:function(e){t.selected=e},expression:"selected"}}),n("BarComensales",{attrs:{width:300,height:300,evento:t.valueChart}}),n("BarDinero",{attrs:{width:300,height:300,evento:t.valueChart}}),n("BarDineroEjecucion",{attrs:{width:300,height:300,evento:t.valueChart}}),n("Bar")],1)])},Y=[],K=(n("ac6a"),n("1fca")),Q=n("bc3a"),W=n("2ef0"),X={extends:K["a"],props:{evento:{type:String}},data:function(){return{dat:[],label:[]}},watch:{evento:function(t){var e=this;this.label=[],this.dat=[];var n={opcion:"eventos",tipo:t},a=this.toFormData(n);Q.post("./mysqli.php",a).then(function(n){W.forEach(n.data,function(t,n){e.dat.push(t),e.label.push(n)}),e.renderChart({labels:e.label,datasets:[{label:t,backgroundColor:["#f87979","#FF5733","#FFBB33","#71FF33","#33FFE3","#3380FF","#4F33FF","#9633FF","#FF33F0","#FF33AF","#FF3364"],data:e.dat}]})}).catch(function(t){console.log(t),e.errored=!0}).finally(function(){return e.loading=!1})}},mounted:function(){},methods:{toFormData:function(t){var e=new FormData;for(var n in t)e.append(n,t[n]);return e}}},Z=X,tt=Object(j["a"])(Z,a,o,!1,null,null,null),et=tt.exports,nt=n("bc3a"),at=n("2ef0"),ot={extends:K["a"],props:{evento:{type:String}},data:function(){return{dat:[],label:[]}},watch:{evento:function(t){var e=this;this.label=[],this.dat=[];var n={opcion:"eventosDiaFirma",tipo:t},a=this.toFormData(n);nt.post("./mysqli.php",a).then(function(n){at.forEach(n.data,function(t,n){e.dat.push(t),e.label.push(n)}),e.renderChart({labels:e.label,datasets:[{label:"Firma de contrato: "+t,backgroundColor:["#f87979","#FF5733","#FFBB33","#71FF33","#33FFE3","#3380FF","#4F33FF","#9633FF","#FF33F0","#FF33AF","#FF3364"],data:e.dat}]})}).catch(function(t){console.log(t),e.errored=!0}).finally(function(){return e.loading=!1})}},mounted:function(){},methods:{toFormData:function(t){var e=new FormData;for(var n in t)e.append(n,t[n]);return e}}},st=ot,rt=Object(j["a"])(st,s,r,!1,null,null,null),it=rt.exports,ct=n("bc3a"),lt=n("2ef0"),ut={extends:K["a"],props:{evento:{type:String}},data:function(){return{dat:[],label:[]}},watch:{evento:function(t){var e=this;this.label=[],this.dat=[];var n={opcion:"eventosDiaEjecucion",tipo:t},a=this.toFormData(n);ct.post("./mysqli.php",a).then(function(n){lt.forEach(n.data,function(t,n){e.dat.push(t),e.label.push(n)}),e.renderChart({labels:e.label,datasets:[{label:"Dia de Ejecución: "+t,backgroundColor:["#f87979","#FF5733","#FFBB33","#71FF33","#33FFE3","#3380FF","#4F33FF","#9633FF","#FF33F0","#FF33AF","#FF3364"],data:e.dat}]})}).catch(function(t){console.log(t),e.errored=!0}).finally(function(){return e.loading=!1})}},mounted:function(){},methods:{toFormData:function(t){var e=new FormData;for(var n in t)e.append(n,t[n]);return e}}},dt=ut,ft=Object(j["a"])(dt,i,c,!1,null,null,null),ht=ft.exports,pt=n("bc3a"),mt={name:"eventos",components:{BarComensales:et,BarDinero:it,BarDineroEjecucion:ht},data:function(){return{payload:{opcion:"eventos",tipo:""},selected:null,options:[{value:null,text:"Por favor seleccione un tipo de evento"}],valueChart:""}},mounted:function(){var t=this,e=this.toFormData({opcion:"tipo_evento"});pt.post("./mysqli.php",e).then(function(e){e.data.forEach(function(e){t.options.push({value:e,text:e})})}).catch(function(e){console.log(e),t.errored=!0}).finally(function(){return t.loading=!1})},watch:{selected:function(t){this.valueChart=t,console.log(t)}},methods:{changeSelected:function(){console.log("SELECTED",this.selected),this.payload.tipo=this.selected,this.payload.opcion="eventos",this.valueChart=this.payload},getDataChart:function(){var t=this,e=this.toFormData(this.payload);console.log("personForm",e),pt.post("./mysqli.php",e).then(function(e){console.log(e),t.valueChart=e.data}).catch(function(e){console.error(e),t.errored=!0}).finally(function(){return t.loading=!1})},toFormData:function(t){var e=new FormData;for(var n in t)e.append(n,t[n]);return e}},created:function(){}},bt=mt,vt=Object(j["a"])(bt,V,Y,!1,null,null,null),jt=vt.exports,gt=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("comensales")],1)},_t=[],yt=n("bc3a"),Ft=n.n(yt),kt={extends:K["b"],data:function(){return{payload:{opcion:"contratos"}}},mounted:function(){this.loadData()},methods:{loadData:function(){var t=this,e=this.toFormData(this.payload);console.log("payload",this.febrero),Ft.a.post("./mysqli.php",e).then(function(t){console.log(t)}).catch(function(e){console.error(e),t.errored=!0}).finally(function(){return t.loading=!1}),this.renderChart({labels:["January","February","March","April","May","June","July","August","September","October","November","December"],datasets:[{label:"GitHub Commits",backgroundColor:"#f87979",data:[40,20,12,39,10,40,39,80,40,20,12,11]},{label:"GitHub Commits",backgroundColor:"#f00",data:[20,23,42,19,60,50,19,20,40,25,16,1]}]})},toFormData:function(t){var e=new FormData;for(var n in t)e.append(n,t[n]);return e}}},Ct=kt,wt=Object(j["a"])(Ct,l,u,!1,null,null,null),xt=wt.exports,Mt={components:{comensales:xt}},Dt=Mt,St=Object(j["a"])(Dt,gt,_t,!1,null,null,null),Ot=St.exports;d["a"].use(H["a"]);var Et=new H["a"]({mode:"history",routes:[{path:"/reportes/",name:"home",component:R},{path:"/reportes/eventos/:evento",name:"evento",component:jt},{path:"/reportes/eventos/",name:"charts Events",component:jt},{path:"/reportes/comensales/anual",name:"Comensales",component:Ot},{path:"/page/:sectionSlug",name:"dynamicContent",component:function(){return n.e("dynamicContent").then(n.bind(null,"cf45"))}}]}),zt=n("9f7b"),Pt=n.n(zt);n("f9e3"),n("2dd8");n.d(e,"EventBus",function(){return $t}),d["a"].use(Pt.a);var $t=new d["a"];d["a"].config.productionTip=!1,window.bus=new d["a"],new d["a"]({router:Et,EventBus:$t,render:function(t){return t(q)}}).$mount("#app")},"5c0b":function(t,e,n){"use strict";var a=n("5e27"),o=n.n(a);o.a},"5e27":function(t,e,n){}});
//# sourceMappingURL=app.d46c58e1.js.map