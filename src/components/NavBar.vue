<template>    
    <header class="header">
        <input type="checkbox" name="" id="check" v-model="showMenu">
        
        
        <div class="name-holder">
            <a href=""><h3>NAME HOLDER</h3></a>
        </div>
        <nav class="nav" >
            <ul class="nav-links">
                <li @click="handleNavigation('aboutus')"><a href="#aboutus">{{ $t('nav.meetus') }}</a></li>
                <li @click="handleNavigation('planner')"><a href="#planner">{{ $t('nav.plan') }}</a></li>
                <li @click="handleNavigation('contactus')"><a href="#contactus">{{ $t('nav.contactus') }}</a></li>
                <li id="btnLogIn"><a href="#">{{ $t('btn.login') }}</a></li>
            </ul>
        </nav>
        <div class="lan-div">
            <div class="form-check form-switch">
                <img id="lang-img" src="../assets/imagenes/idioma.png" alt="">
                <input class="form-check-input custom-switch custom-control-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" @click="toggleLocale">
                <a class="btn" href="/login"><button>{{ $t('btn.login') }}</button></a>
                <label for="check" class="checkbtn">
                    <i class="bi bi-list"></i>
                </label>
            </div>
            
        </div>
    </header>     
</template>

<script>
    export default {
        name: "MenuNav",
        data() {
            return {
                locale: this.$i18n.locale,
                showMenu: false,
            };
        },
        computed: {

        },
        methods: {
            toggleLocale() {
                this.$i18n.locale = this.$i18n.locale === 'en' ? 'es' : 'en';
                localStorage.setItem('selectedLocale', this.$18n.locale);
            },
            handleNavigation(sectionId) {
                this.showMenu = false;
            },
        },
     }
</script>
<style>

@media screen and (min-width: 934px) { 
    .header .nav-links #btnLogIn {
        display: none; 
    }
    .header .nav{
        transition: none;
    }
    .header .btn{
        display: block; 
    }

    .checkbtn {
        display: none; 
    }
    .header .nav-links a {
        transition: none;
        color: #797474; 
    }
    .header .nav-links li a:hover{
        font-size: 18px;
    }

    .header h3{
        font-size: 25px;
    }
    .header .nav{
        width: auto;
        height: 75px;
        left: 0;
        margin-top: 18px;
        position: static;
        background: none;
    }
    .header .nav-links li{
        display: inline-block;
        margin-top: 15px;
        padding: 0 20px; 
    }
    .header .btn button{
        font-size: 15px;
    }
}

@media screen and (min-width: 1206px){ 
    .header h3{
        font-size: 28px;
    }
    .header .nav{
        height: 100px;
    }
    .header .nav-links a{
        font-size: 20px;
    }
    .header .nav-links li a:hover{
        font-size: 24px;
        transition: 0.5s ease;
    }
    .header .nav-links li{
        padding: 12px 40px 0 40px;    
    }
    .header .btn button{
        font-size: 18px;
    }
}
</style>