<template>
  <div>
    <div class="title">
      <p>{{$t("planeacion.decoration.title")}}</p>
    </div>
    <div class="card__container">
      <div class="card" v-for="card in cards" :key="card.id_deco">
          <input type="checkbox" :id="'card-' + card.id_deco" v-model="selectedDecos" :value="card.id_deco">
          <label :for="'card-' + card.id_deco">
              <div class="card-inner" :class="{ 'selected': selectedDecos.includes(card.id_deco) }">
                <img :src="urlimage+card.img_deco" class="card-img-top" :alt="card.alt" />
                  <div class="card-body">
                      <p class="card-text">{{ card.name_deco }}</p>
                  </div>
              </div>
          </label>
      </div>
  </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      selectedDecos: [], 
      urlimage: "../src/assets/imagenes/",
      cards: [],
      
    };
},
  watch: {
    selectedDecos(newVal) {
      localStorage.setItem('selectedDecos', JSON.stringify(newVal));
    },
  },
  created() {
    this.consultar();
    const storedDecos = localStorage.getItem('selectedDecos');
    if (storedDecos) {
      this.selectedDecos = JSON.parse(storedDecos);
    }
  },
  methods:{
    consultar(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/decorations.php')
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        this.cards=[]
        if(typeof datosRespuesta[0].success==='undefined')
        {
          this.cards=datosRespuesta;
        }
      })
      .catch(console.log)
    }
  },
};
</script>-

<style scoped>

  .card-inner {
    border-radius: 10px;
    position: relative;
    width: 170px;
    overflow: hidden;
    box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .card img {
    width: 170px;
    height: 140px;
    object-fit: cover;
  }




  @media screen and (max-width: 340px) {
    .card-body {
      width: 200px;
      padding: 1rem;
    }
  }

  @media screen and (min-width: 768px) {
    .card__container {
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      column-gap: 1.5rem;
      border-radius: 5%;
    }
  }

  @media screen and (min-width: 1350px) {
   
    .card__container {
      grid-template-columns: repeat(5, 1fr);
    }
  }
</style>
