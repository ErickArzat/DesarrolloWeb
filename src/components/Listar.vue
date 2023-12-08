<template>
    
    <div>
      
    <ul v-if="cakes.length">
      <li v-for="(cake, index) in cakes" :key="index">
        <!-- <p>Nombre: {{ cake.img_cake }}</p> -->
        
        <p>Nombre: {{ cake.name_cake }}</p>
        <p>Precio: {{ cake.price_cake }}</p>
        <button type="button" class="btn btn-primary" role="button" @click="irAEditar(cake.id_cake)">Editar</button>
        <button type="button" v-on:click="borrarPastel(cake.id_cake)" class="btn btn-primary" role="button">Borrar</button>
      </li>
    </ul>
    <p v-else>No hay pasteles para mostrar</p>
  </div>
  </template>
  
  <script >
  export default {
    data() {
      return {
        cakeName: '',
        cakePrice: '',
        cakeImage: null,
        cakes: []
      };
    },
    created: function(){
      this.submitForm();
    },
    methods: {
      submitForm() {
        
        fetch('http://localhost/empleados-main/empleados-main/')
        .then(response => response.json())
        .then(data => {
          console.log(data);
          this.cakes = data;
          if (data.success) {
            alert('Archivo subido con éxito. Enlace: ' + data.link);
          } else {
            alert('Error: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error al realizar la solicitud:', error);
        });
      },
      handleFileUpload(event) {
        this.cakeImage = event.target.files[0];
      },
      borrarPastel(id){
        fetch('http://localhost/empleados-main/empleados-main/?borrar='+ id)
        .then(response => response.json())
        .then(data => {
          console.log(data);
          window.location.href="listar"
        })
        .catch(error => {
          console.error('Error al realizar la solicitud:', error);
        });
      },
      irAEditar(id_cake) {   
        this.$router.push({ name: 'Editar', params: { id_cake } });       
      }
    }
  };
  </script>

  <style scoped>
    p{
      color: black;
    }
  </style>