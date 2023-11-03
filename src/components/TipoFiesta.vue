<template>
  <div id="component-3">
    <div class="title">
      <p>{{$t("planeacion.tipe.title")}}</p>
    </div>
    <div class="card__container">
      <div class="card" v-for="card in cards" :key="card.id">
        <input type="radio" :id="'card-' + card.id" v-model="selectedTipe" :value="card.id">
        <label :for="'card-' + card.id">
          <div class="card-inner" >
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

import img1 from "../assets/imagenes/juvenil.webp";
import img2 from "../assets/imagenes/cumpleaños.webp";
import img3 from "../assets/imagenes/graduaciónjpg.jpg";
import img4 from "../assets/imagenes/boda.jpeg";
import img5 from "../assets/imagenes/BabyShower.jpg";
import img6 from  "../assets/imagenes/bautizo.jpg";
import img7 from "../assets/imagenes/funeral.jpg";
export default {
  data() {
    return {
      selectedTipe: null, 
      cards: [
        {
          id: 1,
          image: img1,
          alt: this.$t('planeacion.tipe.young'),
          text: this.$t('planeacion.tipe.young'),
        },
        {
          id: 2,
          image: img2,
          alt: this.$t('planeacion.tipe.birthday'),
          text: this.$t('planeacion.tipe.birthday'),
        },
        {
          id: 3,
          image: img3,
          alt: this.$t('planeacion.tipe.graduation'),
          text: this.$t('planeacion.tipe.graduation'),
        },
        {
          id: 4,
          image: img4,
          alt: this.$t('planeacion.tipe.wedding'),
          text: this.$t('planeacion.tipe.wedding'),
        },
        {
          id: 5,
          image: img5,
          alt: this.$t('planeacion.tipe.babyShower'),
          text: this.$t('planeacion.tipe.babyShower'),
        },
        {
          id: 6,
          image: img6,
          alt: this.$t('planeacion.tipe.christening'),
          text: this.$t('planeacion.tipe.christening'),
        },
        {
          id: 7,
          image: img7,
          alt: this.$t('planeacion.tipe.visitation'),
          text: this.$t('planeacion.tipe.visitation'),
        },
      ],
    };
  },
  watch: {
    selectedTipe(newVal) {
      localStorage.setItem('selectedTipe', newVal);
    },
  },
  created() {
    const storedTipe = localStorage.getItem('selectedTipe');
    if (storedTipe) {
      this.selectedTipe = parseInt(storedTipe);
    }
  },
};

</script>
<style scoped>
  .card-inner {
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
      grid-template-columns: repeat(7, 1fr);
    }
  }
</style>
