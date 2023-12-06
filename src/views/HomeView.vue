<script setup>
      const slides = [
        'src/assets/imagenes/image 1.png',
        'src/assets/imagenes/image 2.png',
        'src/assets/imagenes/grupo-amigos-divirtiendose-fiesta-blanca-bebidas 1.png',
        'src/assets/imagenes/grupo-ninos-pie-contra-pared-disfrutando-fiesta-cumpleanos 1.png',
        'src/assets/imagenes/nochebuena-amigos 1.png',
        'src/assets/imagenes/parejas-celebrando-cumpleanos 1.png',
        'src/assets/imagenes/retrato-nino-sonriente-regalo-cumpleanos-casa 1.png'
      ];
</script>
<template>
  <NavBar/>
  <div class="landing">
    <div class="landing_text">
      <h1 id="Tittle">{{ $t('landing.title') }}</h1>
      <p id="desc">{{ $t('landing.desc') }}</p>
      <a href="#planner"><button id="btn_start" onclick="planner()">{{ $t('landing.button') }}</button></a>
      
    </div>
    <img src="../assets/imagenes/HomeImg1.png" alt="">
  </div>
  <div class="services">
      <p>{{ $t('services.title') }}</p>
      <div class="ubication">
          <img src="src/assets/imagenes/7125203 1.png" alt="">
          <h4>{{ $t('services.title_ubication') }}</h4>
          <p>{{ $t('services.desc_ubication') }}</p>
      </div>
      <div class="decoration">
          <img src="src/assets/imagenes/7802380 1.png" alt="">
          <h4>{{ $t('services.title_decoration') }}</h4>
          <p>{{ $t('services.desc_decoration') }}</p>
      </div>
      <div class="music">
          <img src="src/assets/imagenes/7802400 1.png" alt="">
          <h4>{{ $t('services.title_music') }}</h4>
          <p>{{ $t('services.desc_music') }}</p>
      </div>
      <div class="food">
          <img src="src/assets/imagenes/5996669 1.png" alt="">
          <h4>{{ $t('services.title_food') }}</h4>
          <p>{{ $t('services.desc_food') }}</p>
      </div>
  </div>
  <div class="container-c" id="planner">
    <component :is="componenteActual"></component>
    <div class="error-message" v-if="showErrorMessage">{{ errorMessage }}</div>
    <div class="navigation">
        <button type="button"  v-if="contadorClicks > 0 && contadorClicks < 6"  class="boton-izquierda" @click="goForward">{{ $t('homeview.back') }}</button>
        <button type="button" class="boton-derecha"  @click="goBack" >{{ $t('homeview.next') }}</button>
    </div>
  </div>
  <div class="carousel">
    <h4>{{ $t('carousel.title') }}</h4>
      <Carousel :itemsToShow="3.95" :wrapAround="true" :transition="500" class="carousel_imgs">
          <Slide v-for="slide in slides" :key="slide" >
              <div class="carousel__item"><img :src="slide" alt=""></div>
          </Slide>
          <template #addons>
              <Navigation />
          </template>
      </Carousel>
  </div>
  <div id="aboutus" class="about">
    <h4>{{ $t('about.title') }}</h4>
    <p><span>{{ $t('about.desc_title') }}</span><br>{{ $t('about.desc1') }} <br> {{ $t('about.desc2') }}
    </p>
    <img src="src/assets/imagenes/Rectangle 21.png" alt="">
  </div>
<ContactUs/>


</template>
<script> 
// import { useCookies } from 'vue-cookies';
import ContactUs  from '../components/ContactUs.vue';
import NavBar from '../components/NavBar.vue'
import { defineComponent } from 'vue'
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Navigation } from 'vue3-carousel'
import TipoFiesta from '../components/TipoFiesta.vue';
import ExtrasFiesta from '../components/ExtrasFiesta.vue'
import ColorFiesta from '../components/ColorFiesta.vue';
import PastelFiesta from '../components/PastelFiesta.vue';
import Decoraciones from '../components/Decoraciones.vue';
import ResultadoFiesta from '../components/ResultadoFiesta.vue';
import Payment from '../components/Payment.vue'

export default {
  
  ...defineComponent({
    name: 'Autoplay',
    components: {
      Carousel,
      Slide,
      ContactUs,
      NavBar
    },
  }),
  data() {
    return {
      contadorClicks: 0,
      componentes: [
        TipoFiesta, 
        ColorFiesta, 
        Decoraciones,
        PastelFiesta, 
        ExtrasFiesta,
        ResultadoFiesta, 
        Payment,
      ],
      showErrorMessage: false,
      errorMessage: '',
    };
  },
  computed: {
    componenteActual() {
      return this.componentes[this.contadorClicks ];
      
    },
  },
  
  methods: {
    goForward() {
      if (this.contadorClicks > 0) {
        this.contadorClicks--;
      }
    },
    goBack() {
        if (this.contadorClicks === 0 && localStorage.getItem('selectedTipe') === null) {
          this.showErrorMessage = true;
          this.errorMessage = 'Please select a type first';
          return;
        }
        if (this.contadorClicks === 1 && localStorage.getItem('selectedColors') === null) {
          this.showErrorMessage = true;
          this.errorMessage = 'Please select a type first';
          return;
        }
        if (this.contadorClicks === 2 && localStorage.getItem('selectedDecos') === null) {
          this.showErrorMessage = true;
          this.errorMessage = 'Please select a type first';
          return;
        }
        if (this.contadorClicks === 3 && localStorage.getItem('selectedCake') === null) {
          this.showErrorMessage = true;
          this.errorMessage = 'Please select a type first';
          return;
        }
        if (this.contadorClicks === 4 && localStorage.getItem('selectedExtras') === null) {
          this.showErrorMessage = true;
          this.errorMessage = 'Please select a type first';
          return;
        }
        if (this.contadorClicks === 6) {
          if (confirm('¿Estás seguro de que quieres continuar?')) {
            this.contadorClicks = -1;
            localStorage.removeItem('selectedTipe');
            localStorage.removeItem('selectedColors');
            localStorage.removeItem('selectedDecos');
            localStorage.removeItem('selectedCake');
            localStorage.removeItem('selectedExtras');
          } else {
            return;
          }

        }
        this.showErrorMessage = false;
        this.contadorClicks++;
      }
    },
};
</script>

<style scoped>
*{
    font-family: "Poppins", sans-serif;
    color: #787878;

}
.boton-izquierda,
.boton-derecha {
  padding: 10px 20px;
  font-size: 16px;
  border: 1px solid #fff;
  border-radius: 5px;
  background-color: #5B83FF;
  color: #fff;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.error-message{
  color: red;
  display: flex;
  justify-content: center;
}
.boton-izquierda::before {
  content: '\2190'; 
  margin-right: 5px;
}

.boton-derecha::after {
  content: '\2192'; 
  margin-left: 5px;
}


.boton-izquierda:hover,
.boton-derecha:hover {
  background-color: #ddd;
  color: #333;
}
.landing{
    display: grid;
    align-items: center;
    justify-content: center;
    grid-template-columns: repeat(2,1fr);
    height: 85vh;
}

.landing_text{
  align-items: center;
  margin-left: 10%;
}

.landing_text #Tittle{
  font-weight: bold;
  font-size: 300%;
}

.landing_text #desc{
  font-size: 160%;
}

.landing img:nth-child(2){
    justify-self: center;
}

.landing #btn_start{
  background-color: #5B83FF;
  border: none;
  color: white;
  padding: 8px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  width: 35%;
  font-size: 130%;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 10px;
  border-radius: 10px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

.services{
    display: grid;
    justify-content: center;
    justify-items: center;
    grid-template-columns: repeat(4, 1fr);
    height: 80vh;
    
  }

.services p:first-child{
    grid-column: span 4;
    text-align: center;
    font-size: 180%;
    font-weight: bold;
}

.ubication, .decoration, .music, .food{
    grid-column: span 1;
    text-align: center;
    width: 75%;
    height: 65%;
}

.ubication img, .decoration img, .music img, .food img{
    width: 100%;
}

.carousel{
  overflow: visible;
}
.carousel_imgs{
  overflow: visible;

}

.carousel__slide img{
  width: auto;
  height: auto;
  overflow: visible;

}
.carousel h4{
  text-align: center;
  font-weight: bold;
  font-size: 180%;
  margin-bottom: 2%;
  overflow: visible;

}

.carousel__slide {
  padding: 5px;
}

.carousel__viewport {
  perspective: 2000px;
}

.carousel__track {
  transform-style: preserve-3d;
}

.carousel__slide--sliding {
  transition: 0.5s;
}

.carousel__slide {
  opacity: 0.7;
  transform: rotateY(-20deg) scale(0.9);

}

.carousel__slide--active ~ .carousel__slide {
  transform: rotateY(20deg) scale(0.9);
}

.carousel__slide--prev {
  opacity: 1;
  transform: translateX(-10px) rotateY(-15deg) scale(0.95);
}

.carousel__slide--next {
  opacity: 1;
  transform: rotateY(10deg) scale(0.95);
}

.carousel__slide--active {
  opacity: 1;
  transform: rotateY(0) scale(1);
}

.about{
  display: grid;
  justify-content: center;
  justify-items: center;
  grid-template-columns: repeat(2, 1fr);
  height: 80vh;
  align-items: center;
}

.about h4:first-child{
  margin-top: 10%;
  grid-column: span 2;
  text-align: center;
  font-weight: bold;
  font-size: 180%;
}

.about p{
  margin-left: 20%;
}

.about span{
  font-size: 180%;
  font-weight: bold;
}

.about img{
  width: 55%;
}

.contact{
  display: grid;
  justify-content: center;
  grid-template-columns: repeat(2, 1fr);
  height: 80vh;
  align-items: center;
}

.contact h4:first-child{
  grid-column: span 2;
  text-align: center;
  font-weight: bold;
  font-size: 180%;
}
.links{
  background-color: #5B83FF;
  border-top-left-radius: 50px;
  border-bottom-left-radius: 50px;
  height: 85%;
  width: 75%;
  justify-self: end;
  margin-bottom: 1%;
  text-align: end;
  display: flex;
  flex-direction: column; /* Alinea los elementos verticalmente */
  align-items: end;    /* Centra los elementos horizontalmente */
  justify-content: center; /* Centra los elementos verticalmente */
}

.links p{
  color: white !important; 
  margin-right: 15%;
  font-size: 150%;
  margin-bottom: 6%;
  font-weight:700;
}

.links p:first-child{
  font-size: 180% !important;
}

.links img{
  width: 15%;
  margin-right: 15%;
  margin-bottom: 6%;
}
.forma{
  display: flex;
  flex-direction: column; /* Alinea los elementos verticalmente */
  width: 75%;
  border: #787878 solid 2px;
  border-left: none;
  height: 75%;
  border-top-right-radius: 50px;
  border-bottom-right-radius: 50px;
}

.forma p{
  margin-top: 5%;
  margin-left: 5%;
  font-size: 150%;
  font-weight: bold;
}

.forma label{
  margin-left: 5%;
  font-size: 100%;
}
.forma input[type=text], .forma textarea{
  margin-left: 5%;
  background-color: rgba(128, 128, 128, 0.2);
  margin-bottom: 2%;
  width: 55%;
  border-radius: 3%;
  border: none;
  color: black;
  resize: none;
}

.forma input[type=text]:focus, .forma textarea:focus{
  outline: none;

}

.forma textarea{
  height: 30%;
  width: 75% !important;
}
.forma #button_send{
  background-color: #5B83FF;
  border: none;
  color: white;
  padding: 8px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 130%;
  width: 35%;
  border-radius: 5px 5px 5px 5px;
  margin-left: 5%;
  margin-bottom: 5%;
}


@media screen and (min-width: 340px) and (max-width: 767px) {
  .landing{
    display: grid;
    grid-template-columns: 1fr;
    height: 85vh;
    margin-bottom: calc(100vh - 88vh);
  }

  .landing_text{
    margin: auto;
  }

  .landing_text #desc{
    margin-top: 1em;
    margin-bottom: 1em;
  }
  .landing #btn_start{
    font-size: calc(50% + 9px);
    width: calc(50% - 20%);

  }

    .landing img{
      width: calc(70vw - 20px);
      margin: 5vh auto;
    }

    .landing_text{
      margin-top: 10%;
      margin-left: 5%;
      
    }

    .landing_text #Tittle{
      font-size: calc(100% + 20px);
    }

    .landing_text #desc{
      font-size: calc(100% + 10px);
    }

    .services{
      grid-template-columns: 1fr;
      height: 250vh;
    } 

    .services p:first-child{
      font-size: calc(120% + 20px);
      grid-column: span 1;
    }

    .services img{
      width: calc(50% - 20px);
    }

    .ubication, .decoration, .music, .food{
      font-size: calc(80% + 10px);
    }

    .ubication h4, .decoration h4, .music h4, .food h4{
      font-size: calc(80% + 10px);
    }

    .carousel__slide img{
      width: 100%;
      height: 100%;
    }

    .about{
      grid-template-columns: 1fr;
      height: 150vh;
    }

    .about h4:first-child{
      grid-column: span 1;
    }
    .about p{
      font-size: calc(35% + 10px);
      margin-right: 20%;
    }

    .about img{
      width: calc(50% - 20px);
    }
  }

  @media screen and (min-width: 768px) and (max-width: 1349px) {
    .landing #btn_start{
      font-size: 130%;
      width: 50%;
    }

    .landing img{
      width: 80%;
    }

    .carousel__slide img{
      width: 100%;
      height: 100%;
    }


    .about{
      font-size: calc(18% + 10px);
    }
    .about img{
      width: calc(60% + 20px);
    }
  }

  @media screen and (min-width: 1350px) {
    
  }
  
</style>
