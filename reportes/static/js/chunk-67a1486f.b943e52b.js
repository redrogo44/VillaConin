(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-67a1486f"],{"73e4":function(t,e,r){"use strict";r.r(e);var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"app-container"},[t.add?r("el-alert",{attrs:{title:"Comentario agregado",type:"success",description:"El comnetario fue agregado correctamente","show-icon":""}}):t._e(),t._v(" "),r("el-form",{ref:"form",staticStyle:{width:"100%"},attrs:{"label-width":"120px"}},[r("div",{staticClass:"sub-title"},[t._v("Buscar producto:")]),t._v(" "),r("el-autocomplete",{staticClass:"inline-input",staticStyle:{width:"100%"},attrs:{"fetch-suggestions":t.querySearch,placeholder:"Please Input"},on:{select:t.handleSelect},model:{value:t.state1,callback:function(e){t.state1=e},expression:"state1"}})],1),t._v(" "),t._m(0),t._v(" "),r("el-table",{staticStyle:{width:"100%","margin-top":"3rem"},attrs:{data:t.tableData.filter((function(e){return!t.search||e.name.toLowerCase().includes(t.search.toLowerCase())}))}},[r("el-table-column",{attrs:{label:"Producto",prop:"value"}}),t._v(" "),r("el-table-column",{attrs:{label:"Descripcion",prop:"producto_descripcion"}}),t._v(" "),r("el-table-column",{attrs:{label:"Categoria",prop:"categoria"}}),t._v(" "),r("el-table-column",{attrs:{label:"Descripcion de Categoria",prop:"descripcion_categoria"}}),t._v(" "),r("el-table-column",{attrs:{label:"Subcategoria",prop:"subcategoria"}}),t._v(" "),r("el-table-column",{attrs:{label:"Descripcion de Subcategoria",prop:"descripcion_subcategoria"}})],1),t._v(" "),t._m(1),t._v(" "),r("el-input",{attrs:{type:"textarea"},model:{value:t.comment,callback:function(e){t.comment=e},expression:"comment"}}),t._v(" "),0!==t.id_producto?r("div",{staticClass:"sub-title text-center",staticStyle:{"margin-top":"3rem"}},[r("el-button",{attrs:{type:"primary"},on:{click:t.addCommnet}},[t._v("Agregar comentario")])],1):t._e()],1)},n=[function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"sub-title text-center",staticStyle:{"margin-top":"3rem"}},[r("h2",[r("b",[t._v("Datos generales del producto:")])])])},function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"sub-title text-center",staticStyle:{"margin-top":"3rem"}},[r("h3",[r("b",[t._v("Ingrese el comentario corespondiente al producto.")])])])}],o=(r("96cf"),r("3b8d")),c=r("a1bc"),i=r("bc3a"),s=r.n(i),l=r("2ef0"),u={data:function(){return{add:!1,id_producto:0,comment:"",links:[],state1:"",tableData:[],search:""}},mounted:function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.links=[],t.next=3,this.getProducts("getProducts");case 3:this.links=t.sent;case 4:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),methods:{onSubmit:function(){console.log("submit!")},querySearch:function(t,e){var r=this.links,a=t?r.filter(this.createFilter(t)):r;e(a)},createFilter:function(t){return function(e){return 0===e.value.toLowerCase().indexOf(t.toLowerCase())}},handleSelect:function(t){console.log(t),this.comment=t.comment,this.id_producto=t.id_producto,this.tableData=[],this.tableData.push(t)},getProducts:function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(e,r,a){var n=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return console.log("GETPRODUCTS",r,a),t.abrupt("return",new Promise((function(t,o){try{var i={};i.opcion=e,l.isEmpty(r)||(i.id_producto=r),l.isEmpty(a)||(i.comment=a),console.log(c["a"],i);var u=n.toFormData(i);s.a.post(c["a"].vc.url_costo_promedio,u).then((function(e){console.log("response",e.data.length,e.data),e.data.length>0||e.data>0?t(e.data):t([])})).catch((function(t){n.errored=!0,console.log(t)}))}catch(p){o(p)}})));case 2:case"end":return t.stop()}}),t)})));function e(e,r,a){return t.apply(this,arguments)}return e}(),toFormData:function(t){var e=new FormData;for(var r in t)e.append(r,t[r]);return e},addCommnet:function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(){var e,r,a=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!l.isEmpty(this.comment)){t.next=5;break}e=this.$createElement,this.$message({message:e("p",null,[e("i",{style:"color: red"},"Error: "),e("span",null,"Ingrese un comentario para el producto.")])}),t.next=10;break;case 5:return console.log("ADD COMMENT ",this.id_producto,this.comment),t.next=8,this.getProducts("addComment",this.id_producto,this.comment);case 8:r=t.sent,r&&(this.add=!0,setTimeout((function(){a.add=!1}),3e3));case 10:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}()}},p=u,d=r("2877"),m=Object(d["a"])(p,a,n,!1,null,null,null);e["default"]=m.exports},a1bc:function(t,e,r){"use strict";e["a"]={app:{env:"production"},vc:{url:"https://villaconin.mx/",url_costo_promedio:"https://villaconin.mx/reportes/costoPromedio2.php"}}}}]);