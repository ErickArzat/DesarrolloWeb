<template>
  <div id="component-3">
    <div class="title">
      <p>{{$t("planeacion.tipe.title")}}</p>
    </div>
    <div class="card__container">
      <div class="card" v-for="card in cards" v-bind:key="card.id_type">
        <input type="radio" :id="'card-' + card.id_type" v-model="selectedTipe" :value="card.id_type">
        <label :for="'card-' + card.id_type">
          <div class="card-inner">
            <img :src="urlimage+card.img_type" class="card-img-top" :alt="card.alt" />
            <div class="card-body">
              <p class="card-text">{{ card.name_type }}</p>
            </div>
          </div>
        </label>
      </div>
    </div>
  </div>
</template>

<script>
import img7 from "../assets/imagenes/funeral.jpg";

export default {
  data() {
    return {
      urlimage: "../src/assets/imagenes/",
      cards: [],
      selectedTipe: null,
    };
  },
  watch: {
    selectedTipe(newVal) {
      localStorage.setItem('selectedTipe', newVal);
    },
  },
  created() {
    this.consultar();
    const storedTipe = localStorage.getItem('selectedTipe');
    if (storedTipe) {
      this.selectedTipe = parseInt(storedTipe);
    }
  },
  methods:{
    consultar(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/typesparties.php')
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

</script>
<style scoped>
@import '../assets/main.css';
  .card-inner {
    border-radius: 10px;
    position: relative;
    width: 140px;
    overflow: hidden;
    box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card img {
    width: 140px;
    height: 160px;
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
      grid-template-columns: repeat(7, 1fr);
    }
  }
  
</style>
