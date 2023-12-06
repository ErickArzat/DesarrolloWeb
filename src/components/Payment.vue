<template>
    <div id="component-3">
      <div class="title">
        <p>{{$t("payment.payment")}}</p>
      </div>
    </div>
    
    <div v-if="paidFor">
        <h1>Creaste una fiesta</h1>
    </div>
    <div class="paypal-container" >
        <div ref="paypal"></div>
    </div>
</template>
<script>
import axios from 'axios';

// import image from "../assets/lamp.png"
export default {
  name: "HelloWorld",

  data: function() {
    return {
      loaded: false,
      paidFor: false,
      product: {
        price: 777.77,
        description: "leg lamp from that one movie",
        img: "./assets/lamp.jpg"
      }
    };
  },
  mounted: function() {
    const script = document.createElement("script");
    script.src =
      "https://www.paypal.com/sdk/js?client-id=Aa7qCdr0JqwHcahakv1W0tn-FeFO4YvaU_CCdFJDTUYNU8oDfGyuLuCBsY4qP43mdh8KmRubblW9DltB";
    script.addEventListener("load", this.setLoaded);
    document.body.appendChild(script);
  },
  created(){
      this.selectedTipe = localStorage.getItem('selectedTipe');
      this.selectedColors = localStorage.getItem('selectedColors');
      this.selectedDecos = JSON.parse(localStorage.getItem('selectedDecos')) || [];
      this.selectedCake = localStorage.getItem('selectedCake');
      this.selectedExtras = JSON.parse(localStorage.getItem('selectedExtras')) || [];
      
    }, 
  methods: {
    setLoaded: function() {
      this.loaded = true;
      window.paypal
        .Buttons({
            createParty:() =>{

            },
          //  createOrder: (data, actions) => {
          //    return actions.order.create({
          //      purchase_units: [
          //        {
          //          description: this.product.description,
          //          amount: {
          //            currency_code: "USD",
          //            value: this.product.price
          //          }
          //        }
          //      ]
          //    });
          //  },
          onApprove: async (data, actions) => {
            const order = await actions.order.capture();
            this.paidFor = true;
            
            var datosEnviar = {
              amount: 20,
              status: "pagado",
              date_pay: new Date().toISOString()
            };
            
            fetch(`http://localhost/daw/DesarrolloWeb/src/sql/payment.php?insertar=1`, {
              method: "POST",
              body: JSON.stringify(datosEnviar)
            })
            .then(async response => {
              const responseData = await response.json();
              const { id_pay } = responseData;

              var datosFiestas = {
                type: this.selectedTipe,
                client: 1,
                palette: this.selectedColors,
                cake: this.selectedCake,
                payment: id_pay,
                id_staff: 1,
                date_party: new Date().toISOString()
              };
              
              fetch(`http://localhost/daw/DesarrolloWeb/src/sql/parties.php?insertar=1`, {
                method: "POST",
                body: JSON.stringify(datosFiestas)
              })
              .then(async responseFiesta => {
                const responseFiestaData = await responseFiesta.json();
                console.log(responseFiestaData); 
              })
              .catch(error => {
                console.error('Error al enviar datos de la fiesta:', error);
              });
            })
            .catch(error => {
              console.error('Error al enviar datos de pago:', error);
            });
          },
          onError: err => {
            console.log(err);
          }
        })
        .render(this.$refs.paypal);
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.paypal-container {
    display: flex;
    justify-content: center; 
  }
</style>