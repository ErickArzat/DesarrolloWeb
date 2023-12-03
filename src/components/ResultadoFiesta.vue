<template>
    <div>
      <div class="title">
        <p>{{$t("resume.title")}}</p>  
      </div>
      <div v-if="selectedTipe">
        <div class="card" :key="selectedTipe">
          <input type="radio" :id="'card-' + selectedTipe" v-model="selectedTipe" :value="selectedTipe">
          <label :for="'card-' + selectedTipe">
            <div class="card-inner">
              <img :src="card.image" class="card-img-top" :alt="card.alt" />
              <div class="card-body">
                <p class="card-text">{{ card.text }}</p>
              </div>
            </div>
          </label>
        </div>
      </div>
      <div v-if="selectedColors">
        <p>Colores seleccionados: {{ selectedColors }}</p>
      </div>
      <div v-if="selectedDecos.length > 0">
        <p>Decoraciones seleccionadas:</p>
        <ul>
          <li v-for="(deco, index) in selectedDecos" :key="index">{{ deco }}</li>
        </ul>
      </div>
      <div v-if="selectedCake">
        <p>Pastel seleccionado: {{ selectedCake }}</p>
      </div>
      <div v-if="selectedExtras.length > 0">
        <p>Extras seleccionadas:</p>
        <ul>
          <li v-for="(extra, index) in selectedExtras" :key="index">{{ extra }}</li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ShowSelectedCards',
    data() {
      return {
        selectedTipe: null,
        selectedColors: null,
        selectedDecos: [],
        selectedCake: null,
        selectedExtras: [],
      };
    },
    mounted() {
      this.selectedTipe = localStorage.getItem('selectedTipe');
      this.selectedColors = localStorage.getItem('selectedColors');
      this.selectedDecos = JSON.parse(localStorage.getItem('selectedDecos')) || [];
      this.selectedCake = localStorage.getItem('selectedCake');
      this.selectedExtras = JSON.parse(localStorage.getItem('selectedExtras')) || [];
      
    },
  };
  </script>
  