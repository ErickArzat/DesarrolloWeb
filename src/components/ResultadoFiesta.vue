<template>
    <div>
      <div class="title">
        <p>{{$t("resume.title")}}</p>  
      </div>
      <div class="container">
        <div v-if="Type">
          <div class="card__container">
            <div class="card" :key="Type.id_type">
              <label :for="'card-' + Type.id_type">
                <div class="card-inner">
                  <img :src="urlimage+Type.img_type" class="card-img-top" :alt="Type.alt" />
                  <div class="card-body">
                    <p class="card-text">{{ Type.name_type }}</p>
                  </div>
                </div>
              </label>
            </div>
          </div>
        </div>
        <div v-if="Colors">
          <div class="card__container">
            <div class="card" :key="Colors.id_pal">
              <label :for="'card-' + Colors.id_pal">
                <div class="card-inner">
                  <img :src="urlimage+Colors.img_pal" class="card-img-top" :alt="Colors.alt" />
                </div>
              </label>
            </div>
          </div>
        </div>
        <div v-if="Decos && Decos.length > 0">
          <div class="card__container">
            <div class="card" v-for="Deco in Decos" :key="Decos.id_deco">
              <label :for="'card-' + Deco.id_cake">
                <div class="card-inner">
                    <img :src="urlimage+Deco.img_deco" class="card-img-top" :alt="Deco.alt" />
                    <div class="card-body">
                        <p class="card-text">{{ Deco.name_deco }}</p>
                    </div>
                </div>
            </label>
            </div>
          </div>
        </div>
        <div v-if="Cake">
          <div class="card__container">
            <div class="card" :key="Cake.id_cake">
              <label :for="'card-' + Cake.id_cake">
                  <div class="card-inner">
                      <img :src="urlimage+Cake.img_cake" class="card-img-top" :alt="Cake.alt" />
                      <div class="card-body">
                          <p class="card-text">{{ Cake.name_cake }}</p>
                      </div>
                  </div>
              </label>
            </div>
          </div>
        </div>
        <div v-if="Extras && Extras.length > 0">
          <div class="card__container">
            <div class="card" v-for="Extra in Extras" :key="Extra.id_extra">
                <label :for="'card-' + Extra.id_extra">
                    <div class="card-inner" >
                        <div class="card-body">
                            <p class="card-text"></p>
                        </div>
                    </div>
                </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        urlimage: "../src/assets/imagenes/",
        Type: null,
        Colors: null,
        Decos: [],
        Cake: null,
        Extras: [],
        nameExtra:[]
      };
    },
    mounted() {
      
    },
    created(){
      this.selectedTipe = localStorage.getItem('selectedTipe');
      this.selectedColors = localStorage.getItem('selectedColors');
      this.selectedDecos = JSON.parse(localStorage.getItem('selectedDecos')) || [];
      this.selectedCake = localStorage.getItem('selectedCake');
      this.selectedExtras = JSON.parse(localStorage.getItem('selectedExtras')) || [];
      
      this.consultarType();
      this.consultarColor();
      this.consultarDecos();
      this.consultarCake();
      this.consultarExtras();
    }, 
    methods:{
      
      consultarType(){
        fetch(`http://localhost/daw/DesarrolloWeb/src/sql/typesparties.php?consultar=${this.selectedTipe}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.length > 0) {
            this.Type = data[0]; 
          }
        })
        .catch(error => {
          console.error('Error al consultar el type_party:', error);
        });
      },
      consultarColor(){
        fetch(`http://localhost/daw/DesarrolloWeb/src/sql/palettes.php?consultar=${this.selectedColors}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.length > 0) {
            this.Colors = data[0]; 
          }
        })
        .catch(error => {
          console.error('Error al consultar el Color:', error);
        });
      }, 
      consultarCake(){
        fetch(`http://localhost/daw/DesarrolloWeb/src/sql/cakes.php?consultar=${this.selectedCake}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.length > 0) {
            this.Cake = data[0]; 
          }
        })
        .catch(error => {
          console.error('Error al consultar el Cake:', error);
        });
      }, 
  },
};
  </script>
<style scoped>
.card-inner {
  border-radius: 10px;
  position: relative;
  width: 100px;
  overflow: hidden;
  box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s, box-shadow 0.3s;
}
.card__container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around; 
  align-items: flex-start; 
  margin: 10px; 
  padding: 2%;
}
.card img {
  width: 100px;
  height: 100px;
  object-fit: cover;
}

.container{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around; 
  align-items: flex-start;
}
</style>
  