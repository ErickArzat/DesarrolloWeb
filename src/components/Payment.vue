<template>
    <div id="component-3">
      <div class="title">
        <p>{{$t("payment.payment")}}</p>
      </div>
    </div>
    
    <div v-if="paidFor">
        <h1 class="title" style="color: #5B83FF;">{{$t('payment.endMessage')}}</h1>
    </div>
    <div v-if="!paidFor">
      <div class="paypal-container" >
          <div ref="paypal"></div>
      </div>
    </div>
</template>
<script>
export default {
  name: "Payment",

  data: function() {
    return {
      loaded: false,
      paidFor: false,
      amountOrder: 100,
      
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
    calcPayment() {
      return Promise.all([
        fetch(`http://localhost/daw/DesarrolloWeb/src/sql/typesparties.php?consultar=${this.selectedTipe}`),
        fetch(`http://localhost/daw/DesarrolloWeb/src/sql/palettes.php?consultar=${this.selectedColors}`),
        fetch(`http://localhost/daw/DesarrolloWeb/src/sql/cakes.php?consultar=${this.selectedCake}`)
      ])
      .then(responses => Promise.all(responses.map(response => response.json())))
      .then(data => {
        let monto = 0;
        const [tipeResponse, colorsResponse, cakeResponse] = data;

        const precioTipe = parseInt(tipeResponse[0].price_type);
        console.log("Propiedades de tipo:", Object.keys(tipeResponse));
        const precioColors = parseInt(colorsResponse[0].price_pal);
        const precioCake = parseInt(cakeResponse[0].price_cake);
        console.log(precioTipe);
        monto += precioTipe;
        monto += precioColors
        monto += precioCake;
        this.amountOrder = amount;
        return monto;
      })
      .catch(error => {
        console.error('Error al calcular el monto:', error);
        return 0; 
      });
    },
    setLoaded: function() {
      this.loaded = true;
      window.paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [
                {
                  description: "Tu fiesta personalizada",
                  amount: {
                    currency_code: "USD",
                    value: this.amountOrder,
                  }
                }
              ]
            });
          },
          onApprove: async () => {
            const order = await actions.order.capture();
            const amount = await this.calcPayment(); 
            this.paidFor = true;
            
            var datosEnviar = {
              amount: amount,
              status: "pagado",
              date_pay: new Date().toISOString()
            };
            
            fetch(`http://localhost/daw/DesarrolloWeb/src/sql/payment.php?insertar=1`, {
              method: "POST",
              body: JSON.stringify(datosEnviar)
            })
            .then(async response => {
              const responseData = await response.json();
              const id_pay = responseData.id_pay;

              var datosFiestas = {
                type: this.selectedTipe,
                client: 1,
                palette: this.selectedColors,
                cake: this.selectedCake,
                payment: id_pay,
                staff: 1,
                date: new Date().toISOString(),
              };
              fetch(`http://localhost/daw/DesarrolloWeb/src/sql/parties.php?insertar`, {
                method: "POST",
                body: JSON.stringify(datosFiestas)
              })
              .then(async response =>{
                const responseData = await response.json();
                const id_party = responseData.id_party;
                var decoraciones = {
                  party: id_party,
                  decos: this.selectedDecos
                };
                fetch(`http://localhost/daw/DesarrolloWeb/src/sql/deco-party.php?insertar_multiples`, {
                method: "POST",
                body: JSON.stringify(decoraciones)
                })
                var extras = {
                  party: id_party,
                  extras: this.selectedExtras
                }; 
                fetch(`http://localhost/daw/DesarrolloWeb/src/sql/extra-party.php?insertar_multiples`, {
                method: "POST",
                body: JSON.stringify(extras)
                })
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
        localStorage.removeItem('selectedTipe');
        localStorage.removeItem('selectedColors');
        localStorage.removeItem('selectedDecos');
        localStorage.removeItem('selectedCake');
        localStorage.removeItem('selectedExtras');
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