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
              <form v-on:submit.prevent="addCakes" method="post" enctype="multipart/form-data">
                <div>
                  <label for="cakeName">Nombre del Pastel:</label>
                  <input type="text" v-model="cake.name" required>
                </div>
                <div>
                  <label for="cakePrice">Precio del Pastel:</label>
                  <input type="number" v-model="cake.price" required>
                </div>
                <div>
                  <label for="cakeImage">Imagen del Pastel:</label>
                  <input type="file" v-on:change="onFileChange" required>
                </div>
                <div>
                  <button type="submit">Guardar Pastel</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form @submit.prevent="consultarPasteles" method="post" enctype="multipart/form-data">
    <div>
      <label for="cakeName">Nombre del Pastel:</label>
      <input type="text" v-model="cakeName" required>
    </div>
    <div>
      <label for="cakePrice">Precio del Pastel:</label>
      <input type="number" v-model="cakePrice" required>
    </div>
    <div>
      <label for="cakeImage">Imagen del Pastel:</label>
      <input type="file" @change="onFileChange" required>
    </div>
    <div>
      <button type="submit">Guardar Pastel</button>
    </div>
  </form>
</template>
<script>
import axios from 'axios';

export default {
    data() {
    return { 
      cake:{},
      cakename: '',
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
    
    @-webkit-keyframes animatetop {
      from {top:-300px; opacity:0} 
      to {top:0; opacity:1}
    }

    @keyframes animatetop {
      from {top:-300px; opacity:0}
      to {top:0; opacity:1}
    }
</style>
