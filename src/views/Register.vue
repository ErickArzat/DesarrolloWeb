<template>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2></h2>
      <!-- Icon -->
      <div class="fadeIn first">
      <!--  <img src="@/assets/logo.svg" id="icon" alt="User Icon" /> Aqui va a ir el logo de la app-->
      </div>

      <!-- Login Form -->
      <form @submit.prevent="validateForm">
        <input type="text" id="name" v-model="form.name" placeholder="Name" autocomplete="off">
        <input type="text" id="lastname" v-model="form.lastname" placeholder="LastName" autocomplete="off">
        <input type="text" id="email" v-model="form.email" placeholder="Email" autocomplete="off">
        <input type="text" id="user" v-model="form.user" placeholder="user" autocomplete="off">
        <input type="password" id="password" v-model="form.password" placeholder="password" autocomplete="off">
        <input type="password" id="confirmPassword" v-model="form.confirmPassword" placeholder="Confirm Password" autocomplete="off">
        <input type="submit" value="Register">
      </form>

      <div class="alert red-text">
        {{ errorMessage }}
      </div>
      <div class="account_manager">
        <p>{{$t('register.existing_account')}}</p><a class="underlineHover" href="/login">LogIn</a>
      </div>
    </div>
  </div>
</template>
<script>
export default {
name: 'Register',
data () {
  return {
    errorMessage: '',
    form: {
      name: '',
      lastname: '',
      email: '',
      user: '',
      password: '',
      confirmPassword: ''
    }
  }
},
methods: {
  
validateEmail(email){
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(String(email).toLowerCase());
},


validatePasswords(password, confirmPassword){
  return password === confirmPassword;
},

validateForm(){

  if (!this.form.name|| !this.form.lastname || !this.form.email || !this.form.user || !this.form.password || !this.form.confirmPassword) {
    console.log(name);
    console.log(lastname);
    console.log(email);
    console.log(user);
    console.log(password);
    console.log(confirmPassword);
    console.log("Faltan campos");
    return;
  }
  else if (!this.validateEmail(this.form.email)) {
    console.log("Email no valido");
    return;
  }

  else if (!this.validatePasswords(this.form.password, this.form.confirmPassword)) {
    console.log("Las contraseñas no coinciden");
    return;
  }
  else{
    this.guardarUsuarios();
  }
},
guardarUsuarios(){
  const userData = {
    name: this.form.name,
    lastname: this.form.lastname,
    email: this.form.email,
    user: this.form.user,
    pass: this.form.password
  };
  console.log(userData);
  fetch("http://localhost/daw/DesarrolloWeb/src/sql/guardarUsuario.php?guardar",{
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(userData)
  })
    .then(response =>{
      response.text().then(text => console.log(text));
      return response.json();
    }) 
    .then(data => {
      console.log(data);
      if(data.success){
        console.log("Usuario registrado exitosamente");
      }
      else{
        console.log("Error al registrar usuario");
      }
    })
    .catch((error) => {
      console.error('Error:', error);
    });
}
}
}
</script>
<style scoped>


body {
  font-family: "Poppins", sans-serif;
  height: 100vh;
}

a {
  color: #5B83FF;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}

.alert {
  margin-bottom: 10px;
  text-align: left;
}

.red-text {
  color: red;
  font-size: 14px;
  margin-top: 0;
  margin-bottom: 5px;
}

/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
  
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5B83FF;
}



/* FORM TYPOGRAPHY*/


input[type=submit]:focus{
  background-color: #fff;
  color: #5B83FF;
}

input[type=submit]{
  background-color: #5B83FF;
  color: #fff;
}

input {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input:focus {
  background-color: #fff;
  border-bottom: 2px solid #5B83FF;
}

input:placeholder {
  color: #cccccc;
}



/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #5B83FF;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}



/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
  width:60%;
}

footer{
  visibility: hidden;
}

</style>