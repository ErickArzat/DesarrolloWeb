
<template>
  <div class="container" id="contactus">
    <h3 class="text-center mb-5">{{ $t('contact.title') }}</h3>
      <div class="row">
          <div class="col-md-5">
            <div class="content">
              <h4 class="title-contactUs mb-4">{{ $t('contact.contact_title') }}</h4>
            </div>
            <div class="mt-4">
                <div class="content">
                  <i class="bi bi-telephone-fill"></i>
                  <p class="mb-5">{{ $t('contact.phone') }}</p>
                </div>
                <div class="content">
                  <a href=""><i class="bi bi-envelope-fill"></i></a>
                  <p class="my-custom-font-size mb-5">{{ $t('contact.email') }}</p>
                </div>
                <div class="content">
                  <a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                  <p class="my-custom-font-size mb-2">{{ $t('websites.instagram') }}</p>
                </div>
                <div class="content">
                  <a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                  <p class="my-custom-font-size">{{ $t('websites.facebook') }}</p>
                </div>
            </div>
          </div>
          <div class="col-md-7 grow-on-hover">
            <h4 class="title-message">{{ $t('contact.form_title') }}</h4>
            <form @submit.prevent="submitForm">
              <div class="mb-3">
                <label for="user_name" class="form-label">{{ $t('contact.name_label') }}</label>
                <input type="text" class="form-control" v-model="formData.user_name" id="user_name">
                <span v-if="formSubmitted && !formData.user_name" class="text-danger">Por favor, ingresa tu nombre</span>
              </div>
              <div class="mb-3">
                <label for="user_email" class="form-label">{{ $t('contact.email_label') }}</label>
                <input type="email" class="form-control" v-model="formData.user_email" id="user_email">
                <span v-if="formSubmitted && !isValidEmail(formData.user_email)" class="text-danger">Por favor, ingresa un correo electrónico válido</span>
              </div>
              <div class="mb-3">
                <label for="user_message" class="form-label">{{ $t('contact.message') }}</label>
                <textarea class="form-control" v-model="formData.user_message" id="user_message" rows="3"></textarea>
                <span v-if="formSubmitted && !formData.user_message" class="text-danger">Por favor, ingresa un mensaje</span>
              </div>
              <button type="submit" class="btn btn-primary">{{ $t('btn.submit') }}</button>
            </form>
          </div>
          <div class="mt-3" v-if="apiResponse || apiError">
              <div class="card-body">
                <h5 class="card-title">{{apiResponse}}</h5>
              </div>
            </div>
      </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      formData: {
        user_name: '',
        user_email: '',
        user_message: '',
      },
      formSubmitted: false,
      apiResponse: '',
      apiError: '',
    };
  },
  methods: {
    submitForm() {
      this.formSubmitted = true;
      if (this.formData.user_name && this.isValidEmail(this.formData.user_email) && this.formData.user_message) {
        fetch('http://localhost/daw/DesarrolloWeb/src/sql/Validaciones/correo/enviarCorreo.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.formData),
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Error en la solicitud');
            }
            return response.json();
          })
          .then(data => {
            if (data) {
              this.apiResponse = data.token.message;
              this.apiError = '';
            } else {
              this.apiResponse = '';
              this.apiError = 'Hubo un error al procesar la solicitud';
            }
          })
          .catch(error => {
            console.error('Error al enviar datos:', error);
          });
      } else {
        console.log('Formulario inválido. Revisa los campos.');
      }
    },
    isValidEmail(email) {
      return /\S+@\S+\.\S+/.test(email);
    },
  },
};
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

@media only screen and (min-width:744px){

.row{
  flex-direction:row;
}
.col-md-7{
  border-radius: 0 60px 60px 0;
  }
.col-md-5{
  border-radius: 60px 0 0 60px;
  padding-right: 45px;
}
.content{
  justify-content: end;
}
.d-flex p{
  font-size: 17px;
}
.grow-on-hover:hover {
  transform: scale(1.1);
}

}

@media only screen and (min-width:855px){
.content p{
  font-size: 20px;
}
.title-contactUs{
  font-size: 30px;
}
.form-control{
  font-size: 14px;
}
}
</style>