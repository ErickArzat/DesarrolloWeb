<template>
<div style="padding-top: 5%; ">
    <div class="title">
        <p>{{$t("map.message")}}</p>
      </div>
    
</div>
<div id="map"></div>
    
</template>

<script>
export default {
    mounted() {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap`;
        script.defer = true;
        script.async = true;

        script.onload = () => {
            this.initMap();
        };

        // Agrega el script al body del documento
        document.body.appendChild(script);
    },
    methods: {
        initMap() {
            var coord = {lat:21.0483884 ,lng: -89.6473219};
            const map = new google.maps.Map(document.getElementById('map'), {
                
                zoom: 10,
                center: coord
                
            });
            var marker = new google.maps.Marker({
            position: coord,
            map: map
            });
        }
    }
};
</script>
<style scoped>
#map {
	height: 500px;
	width: 100%;
}
</style>