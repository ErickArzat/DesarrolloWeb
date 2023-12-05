<template>
    <div id="component-5">
        <div class="title">
            <p>{{ $t("planeacion.extras.title") }}</p>
        </div>
        <div class="card__container">
            <div class="card" v-for="card in cards" :key="card.id_extra">
                <input type="checkbox" :id="'card-' + card.id_extra" v-model="selectedExtras" :value="card.id_extra">
                <label :for="'card-' + card.id_extra">
                    <div class="card-inner" :class="{ 'selected': selectedExtras.includes(card.id_extra) }">
                        <div class="card-body">
                            <p class="card-text">{{ card.name_extra }}</p>
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
            selectedExtras: [],
            cards: []
        };
    },
    watch: {
    selectedExtras(newVal) {
      localStorage.setItem('selectedExtras', JSON.stringify(newVal));
    },
  },
  created() {
    this.consultar();
    const storedExtras = localStorage.getItem('selectedExtras');
    if (storedExtras) {
      this.selectedExtras = JSON.parse(storedExtras);
    }
  },
  methods:{
    consultar(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/extras.php')
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
        grid-template-columns: repeat(3, 1fr);
    }
}</style>
  