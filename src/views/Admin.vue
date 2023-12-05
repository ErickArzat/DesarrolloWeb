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
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ganancias Anuales</h5>
              <h6 class="card-subtitle mb-2 text-muted">$150K</h6>
              <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
              <a href="#" class="card-link">Detalles</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ganancias Mensuales</h5>
              <h6 class="card-subtitle mb-2 text-muted">$12.5k</h6>
              <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
              <a href="#" class="card-link">Detalles</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Fiestas</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark Otto</td>
                    <td>Infantil</td>
                    <td>-/-/-</td>
                    <td>---</td>
                    <td>$</td>
                    <td><button class="estado">Completado</button></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob  Thompson</td>
                    <td>Boda</td>
                    <td>-/-/-</td>
                    <td>---</td>
                    <td>$</td>
                    <td><button class="estado">Pendiente</button></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry Bruyne</td>
                    <td>Graduación</td>
                    <td>-/-/-</td>
                    <td>---</td>
                    <td>$</td>
                    <td><button class="estado">En proceso</button></td>
                  </tr>
                </tbody>
              </table>
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

import NavBar from '../components/NavBar.vue'
export default {
  data() {
    return {
      cakeName: '',
      cakePrice: '',
      cakeImage: null
    };
  },
  components:{ 
    NavBar
  },
  created() {
    const token = localStorage.getItem('token');

    if (token) {
      this.enviarTokenAlServidor(token);
    } else {
      localStorage.setItem('message', 'Debes iniciar sesión para acceder a esta página.');
      this.$router.push({ name: 'login' });
    }
  },
  methods: {
    enviarTokenAlServidor(token) {
      fetch('http://localhost/empleados-main/empleados-main/sesiones/verificarCredenciales.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          token: token
        })
      })
      .then(response => response.json())
      .then(data => {
        console.log(data);
        if(!data.access){
          localStorage.setItem('message', 'Debes ser admin para acceder a esta página.');
          this.$router.push({ name: 'login' });
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    }
    // methods:{
    //   onFileChange(event) {
    //     this.cakeImage = event.target.files[0];
    //   },
    //   consultarPasteles(){
    //     const formData = new FormData();
    //     formData.append('cakeName', this.cakeName);
    //     formData.append('cakePrice', this.cakePrice);
    //     formData.append('cakeImage', this.cakeImage);

    //     fetch('http://localhost/empleados-main/empleados-main/?insertar=1',{
    //       method: "POST",
    //       formData 
    //     })
    //     .then(response => response.json())
    //     .then((datos)=>{
    //       console.log(datos);
    //     })
    //     .catch(error => {
    //       console.error('Error:', error);
    //     });
    //   }
    }
  }
</script>