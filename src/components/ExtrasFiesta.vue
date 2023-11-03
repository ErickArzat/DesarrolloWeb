<template>
    <div id="component-5">
        <div class="title">
            <p>{{ $t("planeacion.extras.title") }}</p>
        </div>
        <div class="card__container">
            <div class="card" v-for="card in cards" :key="card.id">
                <input type="checkbox" :id="'card-' + card.id" v-model="selectedExtras" :value="card.id">
                <label :for="'card-' + card.id">
                    <div class="card-inner" :class="{ 'selected': selectedExtras.includes(card.id) }">
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

export default {
    data() {
        return {
            selectedExtras: [],
            cards: [
                {
                    id: 1,
                    text: this.$t('planeacion.extras.theme'),
                },
                {
                    id: 2,
                    text: this.$t('planeacion.extras.food'),
                },
                {
                    id: 3,
                    text: this.$t('planeacion.extras.animators'),
                },
                {
                    id: 4,
                    text: this.$t('planeacion.extras.candy'),
                },
                {
                    id: 5,
                    text: this.$t('planeacion.extras.invitations'),
                },
                {
                    id: 6,
                    text: this.$t('planeacion.extras.show'),
                },

            ],
        };
    },
    watch: {
    selectedExtras(newVal) {
      localStorage.setItem('selectedExtras', JSON.stringify(newVal));
    },
  },
  created() {
    const storedDecos = localStorage.getItem('selectedExtras');
    if (storedDecos) {
      this.selectedExtras = JSON.parse(storedDecos);
    }
  },
};
</script>
  
<style scoped>
.card-inner {
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
  