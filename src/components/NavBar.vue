<template>    
    <header class="header">
        <input type="checkbox" name="" id="check">
        <label for="check" class="checkbtn">
            <i class="bi bi-list"></i>
        </label>
        
        <div class="name-holder">
            <h3>NAME HOLDER</h3>
        </div>
        <nav class="nav">
            <ul class="nav-links">
                <li><a href="#"><!--{{ $t('nav.meetus') }}--></a></li>
                <li><a href="#"><!--{{ $t('nav.plan') }}--></a></li>
                <li id="btnLogIn"><a href="#"><!--{{ $t('btn.login') }}--></a></li>
            </ul>
        </nav>
        <a class="btn" href=""><button><!--{{ $t('btn.login') }}--></button></a>
    </header>     
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap');

@media screen and (min-width: 744px) { /**Pantalla mas chica --> Pantalla Mediana*/ 
    .header .nav-links #btnLogIn {
        display: none; /**Block -> None */ 
    }
    .header .nav{
        transition: none;
    }
    .header .btn button {
        display: block;  /**None -> Block*/ 
    }

    .checkbtn {
        display: none; /**Block -> None */ 
    }
    .header .nav-links a {
        transition: none;
        color: #797474; /**Cambio de color*/ 
    }
    .header .nav-links li a:hover{
        font-size: 15px;
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

@media screen and (min-width: 953px){ /**Pantalla mediana --> Pantalla Grande*/
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
        font-size: 20px;
    }
    .header .nav-links li{
        padding: 12px 40px 0 40px;    
    }
    .header .btn button{
        font-size: 18px;
    }
}
</style>