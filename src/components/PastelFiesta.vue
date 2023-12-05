<template>

<div id="component-4">
  <div class="title">
    <p>{{$t("planeacion.cake.title")}}</p>
  </div>
    <div class="card__container">
        <div class="card" v-for="card in cards" :key="card.id">
            <input type="radio" :id="'card-' + card.id" v-model="selectedCake" :value="card.id">
            <label :for="'card-' + card.id">
                <div class="card-inner">
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
  import img1 from "../assets/imagenes/none1.gif"
  import img2 from "../assets/imagenes/Aesthetic.jpg";
  import img4 from "../assets/imagenes/Cheesecake.jpg";
  import img3 from "../assets/imagenes/Chocolate.jpg";
  import img5 from "../assets/imagenes/ConfettiTradicional.jpg";
  import img6 from "../assets/imagenes/Cupcake.jpg";
 
  export default {
    data() {
      return {
        selectedCake: null, 
        cards: [
          {
            id: 1,
            image: img1,
            alt: this.$t('planeacion.cake.none'),
            text: this.$t('planeacion.cake.none'),
          },
          {
            id: 2,
            image: img2,
            alt: this.$t('planeacion.cake.aesthetic'),
            text: this.$t('planeacion.cake.aesthetic'),
          },
          {
            id: 3,
            image: img3,
            alt: this.$t('planeacion.cake.chocolate'),
            text: this.$t('planeacion.cake.chocolate'),
          },
          {
            id: 4,
            image: img4,
            alt: this.$t('planeacion.cake.cheesecake'),
            text: this.$t('planeacion.cake.cheesecake'),
          },
          {
            id: 5,
            image: img5,
            alt: this.$t('planeacion.cake.confetti'),
            text: this.$t('planeacion.cake.confetti'),
          },
          {
            id: 6,
            image: img6,
            alt: this.$t('planeacion.cake.cupcakes'),
            text: this.$t('planeacion.cake.cupcakes'),
          },
          
        ],
      };
    },
    watch: {
    selectedCake(newVal) {
      localStorage.setItem('selectedCake', newVal);
    },
  },
  created() {
    const storedTipe = localStorage.getItem('selectedCake');
    if (storedTipe) {
      this.selectedCake = parseInt(storedTipe);
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
  