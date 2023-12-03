<template>
  <div id="component-3">
    <div class="title">
      <p>{{$t("planeacion.decoration.title")}}</p>
    </div>
    <div class="card__container">
      <div class="card" v-for="card in cards" :key="card.id">
        <input type="checkbox" :id="'card-' + card.id" v-model="selectedDecos" :value="card.id">
        <label :for="'card-' + card.id">
          <div class="card-inner" :class="{ 'selected': selectedDecos.includes(card.id) }">
            <img :src="card.image" class="card-img-top" :alt="card.alt" />
            <div class="card-body">
              <p class="card-text">{{ card.text }}</p>
            </div>
          </div>
        </label>
      </div>
    </div>
  </div>
</template>

<script>
import img1 from "../assets/imagenes/Globos.jpg"
import img2 from "../assets/imagenes/Confetti.jpg";
import img4 from "../assets/imagenes/Cortina.jpg";
import img3 from "../assets/imagenes/ArcoGlobos.jpg";
import img5 from "../assets/imagenes/Luces.jpg";
import img6 from "../assets/imagenes/Piñata.jpg";
import img7 from "../assets/imagenes/Sombreros.jpg";
import img8 from "../assets/imagenes/Recuerdos.jpg";
import img9 from "../assets/imagenes/Disco.jpg";
import img10 from "../assets/imagenes/Letras.jpg";

export default {
  data() {
    return {
      selectedDecos: [], 
      cards: [
        {
            id: 1,
            image: img1,
            alt: this.$t('planeacion.decoration.balloons'),
            text: this.$t('planeacion.decoration.balloons'),
          },
          {
            id: 2,
            image: img2,
            alt: this.$t('planeacion.decoration.confetti'),
            text: this.$t('planeacion.decoration.confetti'),
          },
          {
            id: 3,
            image: img3,
            alt: this.$t('planeacion.decoration.balloonarch'),
            text: this.$t('planeacion.decoration.balloonarch'),
          },
          {
            id: 4,
            image: img4,
            alt: this.$t('planeacion.decoration.curtain'),
            text: this.$t('planeacion.decoration.curtain'),
          },
          {
            id: 5,
            image: img5,
            alt: this.$t('planeacion.decoration.lights'),
            text: this.$t('planeacion.decoration.lights'),
          },
          {
            id: 6,
            image: img6,
            alt: this.$t('planeacion.decoration.piniata'),
            text: this.$t('planeacion.decoration.piniata'),
          },
          {
            id: 7,
            image: img7,
            alt: this.$t('planeacion.decoration.hats'),
            text: this.$t('planeacion.decoration.hats'),
          },
          {
            id: 8,
            image: img8,
            alt: this.$t('planeacion.decoration.recuerdos'),
            text: this.$t('planeacion.decoration.recuerdos'),
          },
          {
            id: 9,
            image: img9,
            alt: this.$t('planeacion.decoration.ball'),
            text: this.$t('planeacion.decoration.ball'),
          },
          {
            id: 10,
            image: img10,
            alt: this.$t('planeacion.decoration.letters'),
            text: this.$t('planeacion.decoration.letters'),
          },
          
      ],
    };
},
  watch: {
    selectedDecos(newVal) {
      localStorage.setItem('selectedDecos', JSON.stringify(newVal));
    },
  },
  created() {
    const storedDecos = localStorage.getItem('selectedDecos');
    if (storedDecos) {
      this.selectedDecos = JSON.parse(storedDecos);
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
