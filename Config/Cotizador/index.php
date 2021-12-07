<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<style type="text/css">
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

	*{
	margin:0;
	padding:0;
}

body{
	font:15px/1.3 'Open Sans', sans-serif;
	color: #5e5b64;
	text-align:center;
}

a, a:visited {
	outline:none;
	color:#389dc1;
}

a:hover{
	text-decoration:none;
}

section, footer, header, aside, nav{
	display: block;
}

/*-------------------------
	The menu
--------------------------*/

nav{
	display:inline-block;
	margin:10px auto 45px;
	background-color:#5597b4;
	box-shadow:0 1px 1px #ccc;
	border-radius:2px;
}

nav a{
	display:inline-block;
	padding: 18px 30px;
	color:#fff !important;
	font-weight:bold;
	font-size:12px;
	text-decoration:none !important;
	line-height:1;
	text-transform: uppercase;
	background-color:transparent;

	-webkit-transition:background-color 0.25s;
	-moz-transition:background-color 0.25s;
	transition:background-color 0.25s;
}

nav a:first-child{
	border-radius:2px 0 0 2px;
}

nav a:last-child{
	border-radius:0 2px 2px 0;
}

nav.home .home,
nav.salones .salones,
nav.exclusiones .exclusiones,
nav.base .base,
nav.complemento .complemento,
nav.config .config{
	background-color:#e35885;
}

p{
	font-size:22px;
	font-weight:bold;
	color:#7d9098;
}

p b{
	color:#ffffff;
	display:inline-block;
	padding:5px 10px;
	background-color:#c4d7e0;
	border-radius:2px;
	text-transform:uppercase;
	font-size:18px;
}
.resource {
  margin: 20px 0;
}


table {
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #42b983;
  color: rgba(255,255,255,0.66);
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th, td {
  min-width: 120px;
  padding: 10px 20px;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #fff;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #fff;
}
</style>
	<title>Cotizador VC Graduaciones</title>
</head>
<body>

<div id="main">
  <nav v-bind:class="active" v-on:click.prevent>
    <a href="#" class="home" v-on:click="makeActive('home')">Inicio</a>
    <a href="#" class="config" v-on:click="makeActive('config')">Ir a Configuraciones Villa Conin</a>
    <a href="#" class="base" v-on:click="makeActive('serviciosBase')">Servicios Base</a>
    <a href="#" class="complemento" v-on:click="makeActive('serviciosComplemento')">Servicios Complemento</a>
    <a href="#" class="salones" v-on:click="makeActive('salones')">Salones</a>
    <a href="#" class="exclusiones" v-on:click="makeActive('exclusiones')">Exclusiones</a>
  </nav>
  
  <p>You chose <b>{{ active }}</b></p>
  <div class="col-lg-6" style="height: 5em;"></div>
  <div class="col-lg-6">
  	 <form id="search">
	    Search <input name="query" v-model="searchQuery">
	  </form>
	  <demo-grid
	    :data="gridData"
	    :columns="gridColumns"
	    :filter-key="searchQuery">
	  </demo-grid>
  </div>
  <div >
  <button id="show-modal" @click="showModal = true">Show Modal</button>
  <!-- use the modal component, pass in the prop -->
  <modal v-if="showModal" @close="showModal = false">
    <!--
      you can use custom content here to overwrite
      default content
    -->
    <h3 slot="header">Modificar Elemento</h3>
  </modal>
</div>

</div>
</div>

<div class="col-lg-6" align="center">
	<!-- component template -->
	<script type="text/x-template" id="grid-template">
	  <table>
	    <thead>
	      <tr>
	        <th v-for="key in columns"
	          @click="sortBy(key)"
	          :class="{ active: sortKey == key }">
	          {{ key | capitalize }}
	          <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
	          </span>
	        </th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr v-for="entry in filteredData">
	        <td v-for="key in columns">
	          {{entry[key]}}
            <input v-if ="key === 'Modificar'" v-bind:id = "entry['Servicio']"  class="cantidades" type="button" v-bind:name="entry['Descripcion']" v-bind:title="entry['Precio']" value="Modificar" @click="showModal($event)">
	        </td>
	      </tr>
	    </tbody>
	  </table>
	</script>

<!-- template for the modal component -->
<script type="text/x-template" id="modal-template">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <input class="form-control servicio" type="text" id=""><br>
            <input class="form-control descripcion" type="text" id=""><br>
            <input class="form-control precio" type="text" id="">
          </div>

          <div class="modal-footer">
            <slot name="footer">
              default footer
              <button class="modal-default-button" @click="$emit('close')">
                OK
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</script>

<!-- app -->

 <script src="https://unpkg.com/vue"></script>

<script type="text/javascript">
	var xx = this;

	// register the grid component
Vue.component('demo-grid', {
  template: '#grid-template',
  props: {
    data: Array,
    columns: Array,
    filterKey: String
  },
  data: function () {
    var sortOrders = {}
    this.columns.forEach(function (key) {
      sortOrders[key] = 1
    })
    return {
      sortKey: '',
      sortOrders: sortOrders,
     // showModal: false
    }

  },
  computed: {
    filteredData: function () {
      var sortKey = this.sortKey
      var filterKey = this.filterKey && this.filterKey.toLowerCase()
      var order = this.sortOrders[sortKey] || 1
      var data = this.data
      if (filterKey) {
        data = data.filter(function (row) {
          return Object.keys(row).some(function (key) {
            return String(row[key]).toLowerCase().indexOf(filterKey) > -1
          })
        })
      }
      if (sortKey) {
        data = data.slice().sort(function (a, b) {
          a = a[sortKey]
          b = b[sortKey]
          return (a === b ? 0 : a > b ? 1 : -1) * order
        })
      }
      return data
    }
  },
  filters: {
    capitalize: function (str) {
      return str.charAt(0).toUpperCase() + str.slice(1)
    }
  },
  methods: {
    sortBy: function (key) {
      this.sortKey = key
      this.sortOrders[key] = this.sortOrders[key] * -1
    },
    showModal: function(e)
    {
      console.log(e.target.id);
     $(".servicio").val(e.target.id);
     $(".descripcion").val(e.target.name);
     $(".precio").val(e.target.title);
      demo.showModal = true;
    }
  }
});
Vue.component('modal', {
  template: '#modal-template'
})

// bootstrap the demo
var demo = new Vue({
  el: '#main',
  data: {
  	active: 'home',  	
    searchQuery: '',
    gridColumns: [],
    gridData: [
      { name: 'Chuck Norris', power: Infinity },
      { name: 'Bruce Lee', power: 9000 },
      { name: 'Jackie Chan', power: 7000 },
      { name: 'Jet Li', power: 8000 }
    ],
    showModal : false
  },
  methods: {
    addHeader: function(arrayHeader)
    {
      console.log("AddHeader:",arrayHeader);
      var th = this;
      $.each( arrayHeader, function( key, value ) {
        th.gridColumns.push(value);
      });
    },
    addRowServiciosBase: function(arrayData) // Servicios Base
    {

      var th = this;
     console.log("TamañoHeader: "+th.gridColumns.length);
     console.log("Tamaño: "+arrayData.length);
      if(arrayData.length > 0)
      {
        this.gridData = [];
        for (var i = 0; i < arrayData.length; i++) 
        {
          var dataRows = "";
          var tt = this;
          var datos = arrayData[i];
          //console.log(Datos);
          console.log("asd" ,dataRows);
          this.gridData.push({Servicio: datos.Servicio, Descripcion: datos.Descripcion,Precio: datos.Precio});
        }
      }
    },
  	makeActive: function(item){
      alert(item);
    	this.active = item;
      this.gridColumns = [];
      var th = this;
      var data = {                    
            "tipo": item
        };
        $.ajax({
            data:  data,
            url:   'ajax.php',
            type:  'post',
            beforeSend: function () {
            },
            success:  function (datos) {
             // console.log(datos);
              datos = JSON.parse(datos);
              console.log("Headers: ",datos);
              console.log(datos.contenido.infoProducts);
              var headers = datos.Headers;
              th.addHeader(headers);
              th.addRowServiciosBase(datos.contenido.infoProducts);
            } 
        });
    },
    ShowModal: function()
    {
      this.ShowModal = true;
    }
  }
});

</script>
</body>
</html>