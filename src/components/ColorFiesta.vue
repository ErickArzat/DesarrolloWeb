<template>
  
<div id="component-2">
<div class="title">
  <p>{{$t("planeacion.color.title")}}</p>
</div>
    <div class="card__container">
      <div class="card" v-for="card in cards" :key="card.id_pal">
        <input type="radio" :id="'card-' + card.id_pal" v-model="selectedColors" :value="card.id_pal">
        <label :for="'card-' + card.id_pal">
          <div class="card-inner">
            <img :src="urlimage+card.img_pal" class="card-img-top" :alt="card.alt" />
          </div>
        </label>
      </div>
    </div>
    
</div>
</template>
<script>
import img7 from "../assets/imagenes/Paleta7.jpg";
import img10 from "../assets/imagenes/Paleta10.jpg";

export default {
  data() {
    return {
      selectedColors: null, 
      urlimage: "../src/assets/imagenes/",
      cards: [],
    };
  },
  watch: {
    selectedColors(newVal) {
      localStorage.setItem('selectedColors', newVal);
    },
  },
  created() {
    this.consultar();
    const storedTipe = localStorage.getItem('selectedColors');
    if (storedTipe) {
      this.selectedColors = parseInt(storedTipe);
    }
  },
  methods:{
    consultar(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/palettes.php')
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
  .card-inner {
    border-radius: 10px;
    position: relative;
    width: 200px;
    overflow: hidden;
    box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .card img {
    width: 200px;
    height: 70px;
    object-fit: cover;
  }
  
  .card input[type="radio"]:checked + label {
    border: 4px solid #5B83FF;
  }
  .card { 
    background-color: #fff;
  }
  /* For medium devices */
  @media screen and (min-width: 768px) {
    .card__container {
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      column-gap: 1.5rem;
      border-radius: 5%;
    }
  }
  
  /* For large devices */
  @media screen and (min-width: 1120px) {
        .card__container {
        grid-template-columns: repeat(4, 1fr);
      }
  }
</style>