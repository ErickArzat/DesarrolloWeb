<template>

<div class="container">
    <component :is="componenteActual"></component>
    <div class="navigation">
        <button type="button" class="btn btn-outline-dark"  @click="goBack" >Atrás</button>
        <button type="button" class="btn btn-outline-dark" @click="goForward">Siguiente</button>
    </div>
</div>

</template>
<script> 
import TipoFiesta from '../components/TipoFiesta.vue';
import ExtrasFiesta from '../components/ExtrasFiesta.vue'
import ColorFiesta from '../components/ColorFiesta.vue';
import PastelFiesta from '../components/PastelFiesta.vue';
import Decoraciones from '../components/Decoraciones.vue';

export default {
  data() {
    return {
      contadorClicks: 0,
      componentes: [
        TipoFiesta, 
        ColorFiesta, 
        Decoraciones,
        PastelFiesta, 
        ExtrasFiesta],
    };
  },
  computed: {
    componenteActual() {
      return this.componentes[this.contadorClicks % this.componentes.length];
    },
  },
  methods: {
    goForward() {
      this.contadorClicks++;
    },
    goBack() {
      this.contadorClicks--;
    },
  },
};
</script>