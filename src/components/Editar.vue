<template>
    <div>
      <form @submit.prevent="guardarCambios">
        <div v-for="(cake, index) in cakes" :key="index">
          <label>Nombre del pastel:</label>
          <input type="text" v-model="cake.name_cake">
          <br>
          <label>Precio del pastel:</label>
          <input type="text" v-model="cake.price_cake">
          <br><br>
        </div>
        <button type="submit">Guardar Cambios</button>
        <button @click="cancelar">Cancelar</button>
      </form>
    </div>
  </template>

<script>
export default{
    data() {
      return {
        cakes: []
      };
    },
    created: function(){
      this.submitForm();
    },
    methods: {
      submitForm() {
        
        fetch('http://localhost/empleados-main/empleados-main/?consultar='+this.$route.params.id_cake)
        .then(response => response.json())
        .then(data => {
          console.log(data);
          this.cakes = data[0];
          if (data.success) {
            console.log(this.cakes);
            alert('Archivo subido con éxito. Enlace: ' + data.link);
          } else {
            alert('Error: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error al realizar la solicitud:', error);
        });
      },
        guardarCambios() {
          fetch('http://localhost/empleados-main/empleados-main/?actualizar=1', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.cakes)
          })
          .then(response => response.json())
          .then(data => {
            // Manejar la respuesta de la API
            if (data.success) {
              alert('Cambios guardados exitosamente');
              // Puedes realizar alguna acción adicional después de guardar los cambios
            } else {
              alert('Error al guardar los cambios: ' + data.message);
            }
          })
          .catch(error => {
            console.error('Error al enviar los datos:', error);
          });
        },
        cancelar() {
        console.log('Acción cancelada, regresando a la lista...');
    }
    }
}
</script>