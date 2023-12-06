

<style>
    #wrapper{
        padding:90px 15px;
        background: white;
        }

    .card{
        margin-bottom: 25px; 
        border-radius: 25px; 
        box-shadow: 0 3px 5px rgba(0,0,0,.1); 
        border-color: black}

    .card-title{ 
        font-size: 28px;}

    .addColor-title{
        font-size: 28px;
        margin-left: calc(1vw + 10px);
    }

    @media(min-width:992px) {
        #wrapper{
            padding: 90px 15px 15px 75px; }
    }
    a{
        text-decoration: none;
        color: white;
        transition: 1s;
      }

    a:hover{
      color: black;
    }
    
    .estado{
      border-radius: 25px;
      border-color: rgb(75, 96, 255);
    }
</style>

<template>
  <NavBar/>
 <div id="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.table.title') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.client') }}</th>
                    <th scope="col">{{ $t('admin.table.type') }}</th>
                    <th scope="col">{{ $t('admin.table.staff') }}</th>
                    <th scope="col">{{ $t('admin.table.date') }}</th>
                    <th scope="col">{{ $t('admin.table.total') }}</th>
                    <th scope="col">{{ $t('admin.table.status') }}</th>
                    <th scope="col">{{ $t('admin.table.details') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="party in parties" :key="party.id">
                    <td scope="row">{{party.id}}</td>
                    <td scope="row">{{party.client}}</td>
                    <td scope="row">{{party.type}}</td>
                    <td scope="row">{{party.staff}}</td>
                    <td scope="row">{{party.date}}</td>
                    <td scope="row">{{party.total}}</td>
                    <td>
                      <select class="status" v-model="party.status" @change="guardarSeleccion(party)">
                        <option value="opcion1">{{ $t('admin.status.waiting') }}</option>
                        <option value="opcion2">{{ $t('admin.status.inprogress') }}</option>
                        <option value="opcion3">{{ $t('admin.status.completed') }}</option>
                      </select>
                    </td>
                    <td>
                      <button id="myBtn" onclick="document.getElementById('myModal').style.display = 'block';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                        <i class="bi bi-plus-circle-fill"></i>
                      </button>
                      <div id="myModal" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModal').style.display = 'none';">&times;</span>
                            <h2>{{ $t('admin.modal.title') }}</h2>
                          </div>
                          <div class="modal-body">
                            <p>{{ $t('admin.modal.client') }}</p>
                            <p>{{ $t('admin.modal.type') }}</p>
                            <p>{{ $t('admin.modal.staff') }}</p>
                            <p>{{ $t('admin.modal.date') }}</p>
                            <p>{{ $t('admin.modal.total') }}</p>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.color') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="color in colors" :key="color.id">
                    <td scope="row">{{color.id}}</td>
                    <td scope="row">{{color.name}}</td>
                    <td scope="row">{{color.price}}</td>
                    <td><button class="btn btn-primary" role="button" id="btnEditar" onclick="document.getElementById('myModalAdd').style.display = 'block';">{{ $t('btn.edit') }}
                        <i class="bi bi-plus-circle-fill"></i>
                    </button></td>
                    <div id="myModalAdd" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAdd').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput">
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput">
                            <button class="btn btn-primary" id="btnAdd">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td><button class="btn btn-primary" role="button" id="btnBorrar">{{ $t('btn.delete') }}</button></td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                  <input type="text" class="" id="ColorNameInput">
                </div>
                <div>
                  <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                  <input type="text" class="" id="ColorPriceInput">
                </div>
                <div>
                  <label for="ColorNameInput" class="">{{ $t('addColor.imgLabel') }}:</label>
                  <input type="file" class="" id="ColorImgInput">
                </div>
                <button class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.type') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="type in Types" :key="type.id">
                    <td scope="row">{{type.id}}</td>
                    <td scope="row">{{type.name}}</td>
                    <td scope="row">{{type.price}}</td>
                    <td><button class="btn btn-primary" role="button" id="btnEditar" onclick="document.getElementById('myModalAdd').style.display = 'block';">{{ $t('btn.edit') }}
                        <i class="bi bi-plus-circle-fill"></i>
                    </button></td>
                    <div id="myModalAdd" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAdd').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput">
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput">
                            <button class="btn btn-primary" id="btnAdd">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td><button class="btn btn-primary" role="button" id="btnBorrar">{{ $t('btn.delete') }}</button></td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="TypeNameInput" class="">{{ $t('addType.nameLabel') }}:</label>
                  <input type="text" class="" id="TypeNameInput">
                </div>
                <div>
                  <label for="TypePriceInput" class="">{{ $t('addType.priceLabel') }}:</label>
                  <input type="text" class="" id="TypePriceInput">
                </div>
                <div>
                  <label for="TypeImgInput" class="">{{ $t('addType.imgLabel') }}:</label>
                  <input type="file" class="" id="TypeImgInput">
                </div>
                <button class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.decoration') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="decoration in Decorations" :key="decoration.id">
                    <td scope="row">{{decoration.id}}</td>
                    <td scope="row">{{decoration.name}}</td>
                    <td scope="row">{{decoration.price}}</td>
                    <td><button class="btn btn-primary" role="button" id="btnEditar" onclick="document.getElementById('myModalAdd').style.display = 'block';">{{ $t('btn.edit') }}
                        <i class="bi bi-plus-circle-fill"></i>
                    </button></td>
                    <div id="myModalAdd" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAdd').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput">
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput">
                            <button class="btn btn-primary" id="btnAdd">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td><button class="btn btn-primary" role="button" id="btnBorrar">{{ $t('btn.delete') }}</button></td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="DecorationNameInput" class="">{{ $t('addDecoration.nameLabel') }}:</label>
                  <input type="text" class="" id="DecorationNameInput">
                </div>
                <div>
                  <label for="DecorationPriceInput" class="">{{ $t('addDecoration.priceLabel') }}:</label>
                  <input type="text" class="" id="DecorationPriceInput">
                </div>
                <div>
                  <label for="DecorationImgInput" class="">{{ $t('addDecoration.imgLabel') }}:</label>
                  <input type="file" class="" id="DecorationImgInput">
                </div>
                <button class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.cake') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cake in Cakes" :key="cake.id">
                    <td scope="row">{{cake.id}}</td>
                    <td scope="row">{{cake.name}}</td>
                    <td scope="row">{{cake.price}}</td>
                    <td><button class="btn btn-primary" role="button" id="btnEditar" onclick="document.getElementById('myModalAdd').style.display = 'block';">{{ $t('btn.edit') }}
                        <i class="bi bi-plus-circle-fill"></i>
                    </button></td>
                    <div id="myModalAdd" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAdd').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput">
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput">
                            <button class="btn btn-primary" id="btnAdd">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td><button class="btn btn-primary" role="button" id="btnBorrar">{{ $t('btn.delete') }}</button></td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="CakeNameInput" class="">{{ $t('addCake.nameLabel') }}:</label>
                  <input type="text" class="" id="DecorationNameInput">
                </div>
                <div>
                  <label for="CakePriceInput" class="">{{ $t('addCake.priceLabel') }}:</label>
                  <input type="text" class="" id="CakePriceInput">
                </div>
                <div>
                  <label for="CakeImgInput" class="">{{ $t('addCake.imgLabel') }}:</label>
                  <input type="file" class="" id="CakeImgInput">
                </div>
                <button class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.extras') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="extra in Extras" :key="extra.id">
                    <td scope="row">{{extra.id}}</td>
                    <td scope="row">{{extra.name}}</td>
                    <td scope="row">{{extra.price}}</td>
                    <td><button class="btn btn-primary" role="button" id="btnEditar" onclick="document.getElementById('myModalAdd').style.display = 'block';">{{ $t('btn.edit') }}
                        <i class="bi bi-plus-circle-fill"></i>
                    </button></td>
                    <div id="myModalAdd" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAdd').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput">
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput">
                            <button class="btn btn-primary" id="btnAdd">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td><button class="btn btn-primary" role="button" id="btnBorrar">{{ $t('btn.delete') }}</button></td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="ExtraNameInput" class="">{{ $t('addExtras.nameLabel') }}:</label>
                  <input type="text" class="" id="ExtraNameInput">
                </div>
                <div>
                  <label for="ExtraPriceInput" class="">{{ $t('addExtras.priceLabel') }}:</label>
                  <input type="text" class="" id="ExtraPriceInput">
                </div>
                <div>
                  <label for="ExtraImgInput" class="">{{ $t('addExtras.imgLabel') }}:</label>
                  <input type="file" class="" id="ExtraImgInput">
                </div>
                <button class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

import NavBar from '../components/NavBar.vue'
export default {
  components:{ 
    NavBar
  },
  data() {
    return { 
      cake:{},
      cakename: '',
      colors:[
      {
          id: 1,
          name: "Color 1",
          price: "$",
        },
        {
          id: 2,
          name: "Color 2",
          price: "$",
        },
        {
          id: 3,
          name: "Color 3",
          price: "$",
        },
      ],
      parties: [
      {
          id: 1,
          client: "---",
          type:"---",
          staff: "---",
          date: "-/-/-",
          total: "$",
          status:"",
          details:"",
        },
        {
          id: 2,
          client: "---",
          type:"---",
          staff: "---",
          date: "-/-/-",
          total: "$",
          status:"",
          details:"",
        },
        {
          id: 3,
          client: "---",
          type:"---",
          staff: "---",
          date: "-/-/-",
          total: "$",
          status:"",
          details:"",
        },
      ],
      Cakes: [
      {
          id: 1,
          name: "Pastel 1",
          price: "$",
        },
        {
          id: 2,
          name: "Pastel 2",
          price: "$",
        },
        {
          id: 3,
          name: "Pastel 3",
          price: "$",
        },
      ],
      Decorations: [
      {
          id: 1,
          name: "Decoracion 1",
          price: "$",
        },
        {
          id: 2,
          name: "Decoracion 2",
          price: "$",
        },
        {
          id: 3,
          name: "Decoracion 3",
          price: "$",
        },
      ],
      Extras: [
      {
          id: 1,
          name: "Extra 1",
          price: "$",
        },
        {
          id: 2,
          name: "Extra 2",
          price: "$",
        },
        {
          id: 3,
          name: "Extra 3",
          price: "$",
        },
      ],
      Types: [
      {
          id: 1,
          name: "Tipo 1",
          price: "$",
        },
        {
          id: 2,
          name: "Tipo 2",
          price: "$",
        },
        {
          id: 3,
          name: "Tipo 3",
          price: "$",
        },
      ],
    };
  },
  methods: {
    guardarSeleccion(party) {
      localStorage.setItem('opcionSeleccionada_' + party.id, party.status);
    },
    onFileChange(event) {
      this.cake.img = event.target.files[0];
      this.cakename= this.cake.img.name;
    },
    addCakes(){
      //this.addFile();
      var datosEnviar={name:this.cake.name,img:this.cakename,price:this.cake.price};
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/cakes.php?insertar=1',{
        method:"POST",
        body:JSON.stringify(datosEnviar)
      })
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        console.log(datosRespuesta)
      })
      .catch(console.log)
    },
    addFile(){
      const formData = new FormData();
      formData.append('image', this.cake.img);
      axios.post('http://localhost/daw/DesarrolloWeb/src/sql/upload.php', formData)
      .then((datosRespuesta)=>{
        console.log(datosRespuesta.data)
      })
      .catch(console.log)
    },
  },
  mounted() {
    this.parties.forEach((party) => {
      const opcionAlmacenada = localStorage.getItem('opcionSeleccionada_' + party.id);
      party.status = opcionAlmacenada ? opcionAlmacenada : "Selecciona";
    });
  },
};
</script>

<style>
    #wrapper{
      padding: 100px 100px 100px 100px;
      background: white;
    }

    @media screen and (max-width: 340px) {
      #wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 10px 10px 10px 10px;
      }
    }

    @media screen and (max-width: 768px) {
      #wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 10px 10px 10px 10px;
      }
    }

    @media screen and (min-width: 1350px) {
      #wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 0px 100px 100px 100px;
      }
    }

    tbody{
      font-family:sans-serif;
    }

    .info-card{
        margin-bottom: 25px; 
        border-radius: 25px; 
        box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2); 
        border: 2px solid #5B83FF;
        background-color: white;    
    }

    .data-card {
        border-radius: 10px;
        justify-content: center;
        align-items: center;
        padding: 15px 15px 15px 15px;
        overflow-x:auto;
    }

    .name-card{ 
        font-size: 28px;
        color: black;
    }

    a{
        text-decoration: none;
        transition: 1s;
        color: black;
      }

    a:hover{
      color: #5B83FF;
    }
    
    .status{
      border-radius: 25px;
      border: 2px solid rgb(75, 96, 255);
      min-width: 120px;
      appearance: none;
      padding-left: 10px;
    }

    #myBtn{
      border: 0px solid white;
      background-color: white;
    }
    
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: 15% auto; /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
      -webkit-animation-name: animatetop;
      -webkit-animation-duration: 0.4s;
      animation-name: animatetop;
      animation-duration: 0.4s
    }

    .modal-header{
      padding: 2px 16px;
      background-color: #5B83FF;
      color: white;
    }

    #myModalAdd{
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    #myModalAdd .modal-body{
      display: flex;
      flex-direction: column;
    }

    #myModalAdd .modal-body input{
      height: 2rem;
      background: #D9D9D9;
      color: #000;
      font-size: 15px;
      border-radius: 8px;
      border: 1px solid #b3b3b3;
      outline: none;
      width: 30vw;
      margin-bottom: 1rem;
    }
    

    #myModalAdd .modal-body input:focus{
      background: #fff; /* Cambia el color de fondo al blanco cuando se enfoca */
      box-shadow: 0 0 0 2px #5B83FF; /* Cambia el color del borde al azul cuando se enfoca */
    }

    #myModalAdd .modal-body button{
      width: 15vw;
    }

    .modal-body {padding: 16px 16px;}

    .close {
      color: white;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
      transition: 1s;
    }

    #btnEditar, #btnBorrar{
      margin-right: 1rem;
      width: 8vw;
    }

    #btnAdd{
      margin-top: 1rem;
      width: 10vw;
    }
    
    @-webkit-keyframes animatetop {
      from {top:-300px; opacity:0} 
      to {top:0; opacity:1}
    }

    @keyframes animatetop {
      from {top:-300px; opacity:0}
      to {top:0; opacity:1}
    }
</style>
