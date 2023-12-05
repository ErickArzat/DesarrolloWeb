<template>

<div id="component-4">
  <div class="title">
    <p>{{$t("planeacion.cake.title")}}</p>
  </div>
    <div class="card__container">
        <div class="card" v-for="card in cards" :key="card.id_cake">
            <input type="radio" :id="'card-' + card.id_cake" v-model="selectedCake" :value="card.id_cake">
            <label :for="'card-' + card.id_cake">
                <div class="card-inner">
                    <img :src="urlimage+card.img_cake" class="card-img-top" :alt="card.alt" />
                    <div class="card-body">
                        <p class="card-text">{{ card.name_cake }}</p>
                    </div>
                </div>
            </label>
        </div>
    </div>
</div>

  </template>
  
  <script>
  import img3 from "../assets/imagenes/Chocolate.jpg";
  import img5 from "../assets/imagenes/ConfettiTradicional.jpg";
<<<<<<< HEAD
  import img6 from "../assets/imagenes/Cupcake.jpg";
 
=======

>>>>>>> aguilarian
  export default {
    data() {
      return {
        selectedCake: null, 
        urlimage: "../src/assets/imagenes/",
        cards: []
      };
    },
    watch: {
    selectedCake(newVal) {
      localStorage.setItem('selectedCake', newVal);
    },
  },
  created() {
    this.consultar();
    const storedTipe = localStorage.getItem('selectedCake');
    if (storedTipe) {
      this.selectedCake = parseInt(storedTipe);
    }
  },
  methods:{
    consultar(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/cakes.php')
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
  width: 130px;
  overflow: hidden;
  box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s, box-shadow 0.3s;
}

.card img {
  width: 130px;
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

@media screen and (min-width: 1120px) {
  .card__container {
    grid-template-columns: repeat(6, 1fr);
  }
}
</style>
  