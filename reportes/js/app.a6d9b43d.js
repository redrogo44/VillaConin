(function(e){function t(t){for(var a,r,i=t[0],c=t[1],u=t[2],l=0,d=[];l<i.length;l++)r=i[l],s[r]&&d.push(s[r][0]),s[r]=0;for(a in c)Object.prototype.hasOwnProperty.call(c,a)&&(e[a]=c[a]);f&&f(t);while(d.length)d.shift()();return o.push.apply(o,u||[]),n()}function n(){for(var e,t=0;t<o.length;t++){for(var n=o[t],a=!0,r=1;r<n.length;r++){var c=n[r];0!==s[c]&&(a=!1)}a&&(o.splice(t--,1),e=i(i.s=n[0]))}return e}var a={},s={app:0},o=[];function r(e){return i.p+"js/"+({dynamicContent:"dynamicContent"}[e]||e)+"."+{dynamicContent:"7512b36a"}[e]+".js"}function i(t){if(a[t])return a[t].exports;var n=a[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,i),n.l=!0,n.exports}i.e=function(e){var t=[],n=s[e];if(0!==n)if(n)t.push(n[2]);else{var a=new Promise(function(t,a){n=s[e]=[t,a]});t.push(n[2]=a);var o,c=document.createElement("script");c.charset="utf-8",c.timeout=120,i.nc&&c.setAttribute("nonce",i.nc),c.src=r(e),o=function(t){c.onerror=c.onload=null,clearTimeout(u);var n=s[e];if(0!==n){if(n){var a=t&&("load"===t.type?"missing":t.type),o=t&&t.target&&t.target.src,r=new Error("Loading chunk "+e+" failed.\n("+a+": "+o+")");r.type=a,r.request=o,n[1](r)}s[e]=void 0}};var u=setTimeout(function(){o({type:"timeout",target:c})},12e4);c.onerror=c.onload=o,document.head.appendChild(c)}return Promise.all(t)},i.m=e,i.c=a,i.d=function(e,t,n){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},i.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(i.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)i.d(n,a,function(t){return e[t]}.bind(null,a));return n},i.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="/",i.oe=function(e){throw console.error(e),e};var c=window["webpackJsonp"]=window["webpackJsonp"]||[],u=c.push.bind(c);c.push=t,c=c.slice();for(var l=0;l<c.length;l++)t(c[l]);var f=u;o.push([0,"chunk-vendors"]),n()})({0:function(e,t,n){e.exports=n("56d7")},4678:function(e,t,n){var a={"./af":"2bfb","./af.js":"2bfb","./ar":"8e73","./ar-dz":"a356","./ar-dz.js":"a356","./ar-kw":"423e","./ar-kw.js":"423e","./ar-ly":"1cfd","./ar-ly.js":"1cfd","./ar-ma":"0a84","./ar-ma.js":"0a84","./ar-sa":"8230","./ar-sa.js":"8230","./ar-tn":"6d83","./ar-tn.js":"6d83","./ar.js":"8e73","./az":"485c","./az.js":"485c","./be":"1fc1","./be.js":"1fc1","./bg":"84aa","./bg.js":"84aa","./bm":"a7fa","./bm.js":"a7fa","./bn":"9043","./bn.js":"9043","./bo":"d26a","./bo.js":"d26a","./br":"6887","./br.js":"6887","./bs":"2554","./bs.js":"2554","./ca":"d716","./ca.js":"d716","./cs":"3c0d","./cs.js":"3c0d","./cv":"03ec","./cv.js":"03ec","./cy":"9797","./cy.js":"9797","./da":"0f14","./da.js":"0f14","./de":"b469","./de-at":"b3eb","./de-at.js":"b3eb","./de-ch":"bb71","./de-ch.js":"bb71","./de.js":"b469","./dv":"598a","./dv.js":"598a","./el":"8d47","./el.js":"8d47","./en-SG":"cdab","./en-SG.js":"cdab","./en-au":"0e6b","./en-au.js":"0e6b","./en-ca":"3886","./en-ca.js":"3886","./en-gb":"39a6","./en-gb.js":"39a6","./en-ie":"e1d3","./en-ie.js":"e1d3","./en-il":"7333","./en-il.js":"7333","./en-nz":"6f50","./en-nz.js":"6f50","./eo":"65db","./eo.js":"65db","./es":"898b","./es-do":"0a3c","./es-do.js":"0a3c","./es-us":"55c9","./es-us.js":"55c9","./es.js":"898b","./et":"ec18","./et.js":"ec18","./eu":"0ff2","./eu.js":"0ff2","./fa":"8df4","./fa.js":"8df4","./fi":"81e9","./fi.js":"81e9","./fo":"0721","./fo.js":"0721","./fr":"9f26","./fr-ca":"d9f8","./fr-ca.js":"d9f8","./fr-ch":"0e49","./fr-ch.js":"0e49","./fr.js":"9f26","./fy":"7118","./fy.js":"7118","./ga":"5120","./ga.js":"5120","./gd":"f6b4","./gd.js":"f6b4","./gl":"8840","./gl.js":"8840","./gom-latn":"0caa","./gom-latn.js":"0caa","./gu":"e0c5","./gu.js":"e0c5","./he":"c7aa","./he.js":"c7aa","./hi":"dc4d","./hi.js":"dc4d","./hr":"4ba9","./hr.js":"4ba9","./hu":"5b14","./hu.js":"5b14","./hy-am":"d6b6","./hy-am.js":"d6b6","./id":"5038","./id.js":"5038","./is":"0558","./is.js":"0558","./it":"6e98","./it-ch":"6f12","./it-ch.js":"6f12","./it.js":"6e98","./ja":"079e","./ja.js":"079e","./jv":"b540","./jv.js":"b540","./ka":"201b","./ka.js":"201b","./kk":"6d79","./kk.js":"6d79","./km":"e81d","./km.js":"e81d","./kn":"3e92","./kn.js":"3e92","./ko":"22f8","./ko.js":"22f8","./ku":"2421","./ku.js":"2421","./ky":"9609","./ky.js":"9609","./lb":"440c","./lb.js":"440c","./lo":"b29d","./lo.js":"b29d","./lt":"26f9","./lt.js":"26f9","./lv":"b97c","./lv.js":"b97c","./me":"293c","./me.js":"293c","./mi":"688b","./mi.js":"688b","./mk":"6909","./mk.js":"6909","./ml":"02fb","./ml.js":"02fb","./mn":"958b","./mn.js":"958b","./mr":"39bd","./mr.js":"39bd","./ms":"ebe4","./ms-my":"6403","./ms-my.js":"6403","./ms.js":"ebe4","./mt":"1b45","./mt.js":"1b45","./my":"8689","./my.js":"8689","./nb":"6ce3","./nb.js":"6ce3","./ne":"3a39","./ne.js":"3a39","./nl":"facd","./nl-be":"db29","./nl-be.js":"db29","./nl.js":"facd","./nn":"b84c","./nn.js":"b84c","./pa-in":"f3ff","./pa-in.js":"f3ff","./pl":"8d57","./pl.js":"8d57","./pt":"f260","./pt-br":"d2d4","./pt-br.js":"d2d4","./pt.js":"f260","./ro":"972c","./ro.js":"972c","./ru":"957c","./ru.js":"957c","./sd":"6784","./sd.js":"6784","./se":"ffff","./se.js":"ffff","./si":"eda5","./si.js":"eda5","./sk":"7be6","./sk.js":"7be6","./sl":"8155","./sl.js":"8155","./sq":"c8f3","./sq.js":"c8f3","./sr":"cf1e","./sr-cyrl":"13e9","./sr-cyrl.js":"13e9","./sr.js":"cf1e","./ss":"52bd","./ss.js":"52bd","./sv":"5fbd","./sv.js":"5fbd","./sw":"74dc","./sw.js":"74dc","./ta":"3de5","./ta.js":"3de5","./te":"5cbb","./te.js":"5cbb","./tet":"576c","./tet.js":"576c","./tg":"3b1b","./tg.js":"3b1b","./th":"10e8","./th.js":"10e8","./tl-ph":"0f38","./tl-ph.js":"0f38","./tlh":"cf75","./tlh.js":"cf75","./tr":"0e81","./tr.js":"0e81","./tzl":"cf51","./tzl.js":"cf51","./tzm":"c109","./tzm-latn":"b53d","./tzm-latn.js":"b53d","./tzm.js":"c109","./ug-cn":"6117","./ug-cn.js":"6117","./uk":"ada2","./uk.js":"ada2","./ur":"5294","./ur.js":"5294","./uz":"2e8c","./uz-latn":"010e","./uz-latn.js":"010e","./uz.js":"2e8c","./vi":"2921","./vi.js":"2921","./x-pseudo":"fd7e","./x-pseudo.js":"fd7e","./yo":"7f33","./yo.js":"7f33","./zh-cn":"5c3a","./zh-cn.js":"5c3a","./zh-hk":"49ab","./zh-hk.js":"49ab","./zh-tw":"90ea","./zh-tw.js":"90ea"};function s(e){var t=o(e);return n(t)}function o(e){var t=a[e];if(!(t+1)){var n=new Error("Cannot find module '"+e+"'");throw n.code="MODULE_NOT_FOUND",n}return t}s.keys=function(){return Object.keys(a)},s.resolve=o,e.exports=s,s.id="4678"},"56d7":function(e,t,n){"use strict";n.r(t);n("cadf"),n("551c"),n("f751"),n("097d");var a,s,o,r,i=n("2b0e"),c=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{class:e.wrapperClass,attrs:{id:"wrapper"}},[n("MenuToggleBtn"),n("Menu"),n("ContentOverlay"),n("router-view")],1)},u=[],l=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("a",{staticClass:"btn menu-toggle-btn",attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.toggleMenu(t)}}},[n("i",{staticClass:"fa fa-bars",attrs:{"aria-hidden":"true"}})])},f=[],d={methods:{toggleMenu:function(){window.bus.$emit("menu/toggle")}}},h=d,p=n("2877"),m=Object(p["a"])(h,l,f,!1,null,null,null),b=m.exports,v=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"menu-container"},[n("ul",{staticClass:"menu"},[n("li",{staticClass:"menu__top"},[n("router-link",{staticClass:"menu__logo",attrs:{to:"/"}},[n("img",{attrs:{src:"/icon-32.png",alt:"icon"}})]),n("a",{staticClass:"menu__title",attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.openProjectLink(t)}}},[e._v("\n       Villa Conin Reportes\n      ")])],1),n("li",[n("a",{class:e.highlightSection("home"),attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.updateMenu("home")}}},[n("i",{staticClass:"fa fa-home menu__icon",attrs:{"aria-hidden":"true"}}),e._v("\n          Home\n      ")])]),n("li",[n("a",{class:e.highlightSection("products"),attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.updateMenu("products")}}},[n("i",{staticClass:"fa fa-tag menu__icon",attrs:{"aria-hidden":"true"}}),e._v("\n        Products\n        "),n("i",{staticClass:"fa fa-chevron-right menu__arrow-icon",attrs:{"aria-hidden":"true"}})])]),n("li",[n("a",{class:e.highlightSection("comensales"),attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.updateMenu("comensales")}}},[n("i",{staticClass:"fa fa-tag menu__icon",attrs:{"aria-hidden":"true"}}),e._v("\n        Comensales\n        "),n("i",{staticClass:"fa fa-chevron-right menu__arrow-icon",attrs:{"aria-hidden":"true"}})])]),n("li",[n("a",{class:e.highlightSection("eventos"),attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.updateMenu("eventos")}}},[n("i",{staticClass:"fa fa-home menu__icon",attrs:{"aria-hidden":"true"}}),e._v("\n          Eventos\n      ")])]),n("li",[n("a",{class:e.highlightSection("customers"),attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.updateMenu("customers")}}},[n("i",{staticClass:"fa fa-users menu__icon",attrs:{"aria-hidden":"true"}}),e._v("\n        Customers\n        "),n("i",{staticClass:"fa fa-chevron-right menu__arrow-icon",attrs:{"aria-hidden":"true"}})])]),n("li",[n("a",{class:e.highlightSection("account"),attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.updateMenu("account")}}},[n("i",{staticClass:"fa fa-user menu__icon",attrs:{"aria-hidden":"true"}}),e._v("\n        Account\n        "),n("i",{staticClass:"fa fa-chevron-right menu__arrow-icon",attrs:{"aria-hidden":"true"}})])])]),n("transition",{attrs:{name:"slide-fade"}},[n("div",{directives:[{name:"show",rawName:"v-show",value:e.showContextMenu,expression:"showContextMenu"}],staticClass:"context-menu-container"},[n("ul",{staticClass:"context-menu"},e._l(e.menuItens,function(t,a){return n("li",{key:a},["title"===t.type?n("h5",{staticClass:"context-menu__title"},[n("i",{class:t.icon,attrs:{"aria-hidden":"true"}}),e._v("\n\n            "+e._s(t.txt)+"\n\n            "),0===a?n("a",{staticClass:"context-menu__btn-close",attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.closeContextMenu(t)}}},[n("i",{staticClass:"fa fa-window-close",attrs:{"aria-hidden":"true"}})]):e._e()]):n("a",{class:e.subMenuClass(t.txt),attrs:{href:"#"},on:{click:function(n){return n.preventDefault(),e.openSection(t)}}},[e._v("\n            "+e._s(t.txt)+"\n          ")])])}),0)])])],1)},j=[],g=(n("b54a"),{home:[],comensales:[{type:"title",txt:"Comensales",icon:"fa fa-tag context-menu__title-icon"},{type:"link",txt:"Anual",link:"/comensales"}],eventos:[],products:[{type:"title",txt:"Products",icon:"fa fa-tag context-menu__title-icon"},{type:"link",txt:"List Products",link:"/page"},{type:"link",txt:"Add New Product",link:"/page"},{type:"link",txt:"Manage Categories",link:"/page"}],customers:[{type:"title",txt:"Customers",icon:"fa fa-users context-menu__title-icon"},{type:"link",txt:"List Customers",link:"/page"},{type:"link",txt:"List Contacts",link:"/page"},{type:"link",txt:"List Newsletters",link:"/page"}],account:[{type:"title",txt:"My Account",icon:"fa fa-user context-menu__title-icon"},{type:"link",txt:"Change Password",link:"/page"},{type:"link",txt:"Change Settings",link:"/page"},{type:"link",txt:"Logout",link:"/page"},{type:"title",txt:"Change Subscription",icon:"fa fa-credit-card context-menu__title-icon"},{type:"link",txt:"Plans",link:"/page"},{type:"link",txt:"Payment Settings",link:"/page"},{type:"link",txt:"Payment History",link:"/page"}]}),_=n("375a"),y=n.n(_),k={name:"Menu",data:function(){return{contextSection:"",menuItens:[],menuData:g,activeSubMenu:""}},methods:{openProjectLink:function(){alert("You could open the project frontend in another tab here, so the logged admin could see changes made to the project ;)")},updateMenu:function(e){this.contextSection=e,this.menuItens=this.menuData[e],"home"===e&&(this.$router.push("/"),window.bus.$emit("menu/closeMobileMenu")),"eventos"===e&&(this.$router.push("/reportes/eventos"),window.bus.$emit("menu/closeMobileMenu"))},highlightSection:function(e){return{menu__link:!0,"menu__link--active":e===this.contextSection}},subMenuClass:function(e){return{"context-menu__link":!0,"context-menu__link--active":this.activeSubMenu===e}},closeContextMenu:function(){this.contextSection="",this.menuItens=[]},openSection:function(e){this.activeSubMenu=e.txt,this.$router.push(this.getUrl(e)),window.bus.$emit("menu/closeMobileMenu")},getUrl:function(e){var t=y()(e.txt);return"".concat(e.link,"/").concat(t)}},computed:{showContextMenu:function(){return this.menuItens.length}}},C=k,w=Object(p["a"])(C,v,j,!1,null,null,null),x=w.exports,M=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"content-overlay",on:{click:function(t){return t.preventDefault(),e.closeMobileMenu(t)}}})},D=[],O={methods:{closeMobileMenu:function(){window.bus.$emit("menu/toggle")}}},S=O,z=Object(p["a"])(S,M,D,!1,null,null,null),P=z.exports,$={components:{MenuToggleBtn:b,Menu:x,ContentOverlay:P},created:function(){var e=this;window.bus.$on("menu/toggle",function(){window.setTimeout(function(){e.isOpenMobileMenu=!e.isOpenMobileMenu},200)}),window.bus.$on("menu/closeMobileMenu",function(){e.isOpenMobileMenu=!1})},data:function(){return{isOpenMobileMenu:!1}},computed:{wrapperClass:function(){return{toggled:!0===this.isOpenMobileMenu}}}},E=$,F=(n("5c0b"),Object(p["a"])(E,c,u,!1,null,null,null)),A=F.exports,J=n("8c4f"),T=function(){var e=this,t=e.$createElement;e._self._c;return e._m(0)},L=[function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"main-content"},[n("div",{staticClass:"main-content__top"},[n("h1",{staticClass:"main-content__title"},[e._v("\n          Home\n      ")])]),n("div",{staticClass:"main-content__body"},[n("p",[e._v("\n      Hi! This is a simplified version of the responsive menu I implemented in the\n      Admin Panel of a project some time ago. Maybe it can help newcomers to\n      "),n("a",{attrs:{href:"https://vuejs.org/"}},[e._v("Vue.js")]),e._v(" and "),n("a",{attrs:{href:"https://router.vuejs.org/"}},[e._v("Vue Router")]),e._v("\n      to have some ideas of how to start puting the framework, router, styles\n      and other concepts together.\n    ")]),n("p",[e._v("\n      You can find the Github Repository of this menu\n      "),n("a",{attrs:{href:"https://github.com/daniel-cintra/vue-menu"}},[e._v("here")]),e._v(".\n    ")]),n("p",[e._v("\n      The menu can be easily customized changing:\n    ")]),n("ol",[n("li",[n("strong",[e._v("src/components/Menu.vue")]),e._v("\n        where the root level itens can be found.\n      ")]),n("li",[n("strong",[e._v("src/components/support/menu-data.js")]),e._v("\n        where the childs of root level itens can be found.\n      ")]),n("li",[n("strong",[e._v("src/router.js")]),e._v("\n        where each route can be mapped to load the correspondent component.\n        For the sake of simplicity, with exception of the "),n("strong",[e._v("home route")]),e._v(", the\n        sections are loaded dynamically in this example.\n      ")])])])])}],q={name:"home"},N=q,H=Object(p["a"])(N,T,L,!1,null,null,null),I=H.exports,B=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"main-content"},[e._m(0),n("div",{staticClass:"main-content__body"},[n("b-form-select",{attrs:{options:e.options},model:{value:e.selected,callback:function(t){e.selected=t},expression:"selected"}}),n("Bar",{attrs:{dataChart:e.valueChart}}),n("Bar")],1)])},G=[function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"main-content__top"},[n("h1",{staticClass:"main-content__title"},[e._v("\n          Eventos\n      ")])])}],U=(n("ac6a"),n("774e")),R=n.n(U),V=n("1fca"),Y=n("bc3a"),K=n("2ef0"),Q={extends:V["a"],props:{dataChart:{type:String,required:!0}},data:function(){return{token:"",valueData:[],newUser:[],sessions:[],duration:[],labels:[],datasets:[],contador:0}},mounted:function(){this.renderChart({labels:["January","February","March","April","May","June","July","August","September","October","November","December"],datasets:this.datasets})},watch:{dataChart:function(e){this.getDataChart(e)}},methods:{render:function(){this.renderChart({labels:["January","February","March","April","May","June","July","August","September","October","November","December"],datasets:this.datasets})},getDataChart:function(e){var t=this,n=this.toFormData(e);console.log("personForm",n),Y.post("./mysqli.php",n).then(function(e){console.log(e.data),console.log(R()(e.data)),K.forEach(e.data,function(e,n){console.log(e,n),t.datasets.push({label:n,backgroundColor:"#f87979",data:e})}),t.render()}).catch(function(e){console.error(e),t.errored=!0}).finally(function(){return t.loading=!1})},toFormData:function(e){var t=new FormData;for(var n in e)t.append(n,e[n]);return t}},created:function(){console.log("Created",this.dataChart)}},W=Q,X=Object(p["a"])(W,a,s,!1,null,null,null),Z=X.exports,ee=n("bc3a"),te={name:"eventos",components:{Bar:Z},data:function(){return{payload:{opcion:"eventos",tipo:""},selected:null,options:[{value:null,text:"Por favor seleccione un tipo de evento"}],valueChart:""}},mounted:function(){var e=this,t=this.toFormData({opcion:"tipo_evento"});ee.post("./mysqli.php",t).then(function(t){t.data.forEach(function(t){e.options.push({value:t,text:t})})}).catch(function(t){e.errored=!0}).finally(function(){return e.loading=!1})},watch:{selected:function(e){this.payload.tipo=e,this.payload.opcion="eventos",this.valueChart=this.payload}},methods:{getDataChart:function(){var e=this,t=this.toFormData(this.payload);console.log("personForm",t),ee.post("./mysqli.php",t).then(function(t){console.log(t),e.valueChart=t.data}).catch(function(t){console.error(t),e.errored=!0}).finally(function(){return e.loading=!1})},toFormData:function(e){var t=new FormData;for(var n in e)t.append(n,e[n]);return t}}},ne=te,ae=Object(p["a"])(ne,B,G,!1,null,null,null),se=ae.exports,oe=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("comensales")],1)},re=[],ie=n("bc3a"),ce=n.n(ie),ue={extends:V["b"],data:function(){return{payload:{opcion:"contratos"}}},mounted:function(){this.loadData()},methods:{loadData:function(){var e=this,t=this.toFormData(this.payload);console.log("payload",this.febrero),ce.a.post("./mysqli.php",t).then(function(e){console.log(e)}).catch(function(t){console.error(t),e.errored=!0}).finally(function(){return e.loading=!1}),this.renderChart({labels:["January","February","March","April","May","June","July","August","September","October","November","December"],datasets:[{label:"GitHub Commits",backgroundColor:"#f87979",data:[40,20,12,39,10,40,39,80,40,20,12,11]},{label:"GitHub Commits",backgroundColor:"#f00",data:[20,23,42,19,60,50,19,20,40,25,16,1]}]})},toFormData:function(e){var t=new FormData;for(var n in e)t.append(n,e[n]);return t}}},le=ue,fe=Object(p["a"])(le,o,r,!1,null,null,null),de=fe.exports,he={components:{comensales:de}},pe=he,me=Object(p["a"])(pe,oe,re,!1,null,null,null),be=me.exports;i["a"].use(J["a"]);var ve=new J["a"]({mode:"history",routes:[{path:"/reportes/",name:"home",component:I},{path:"/reportes/eventos",name:"charts Events",component:se},{path:"/reportes/comensales/anual",name:"Comensales",component:be},{path:"/page/:sectionSlug",name:"dynamicContent",component:function(){return n.e("dynamicContent").then(n.bind(null,"cf45"))}}]}),je=n("9f7b"),ge=n.n(je);n("f9e3"),n("2dd8");i["a"].use(ge.a),i["a"].config.productionTip=!1,window.bus=new i["a"],new i["a"]({router:ve,render:function(e){return e(A)}}).$mount("#app")},"5c0b":function(e,t,n){"use strict";var a=n("5e27"),s=n.n(a);s.a},"5e27":function(e,t,n){}});
//# sourceMappingURL=app.a6d9b43d.js.map