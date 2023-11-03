<template>
    <header class="header">
        <div class="name-holder">
            <h3>NAME HOLDER</h3>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Conócenos</a></li>
                <li><a href="#">Planea tu fiesta</a></li>
            </ul>
        </nav>
        <a class="btn" href=""><button>Inicia sesión</button></a>
    </header>
        
</template>

<style>
.header{
    background-color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 85px;
    padding: 5px 5%;
}
.header h3{
    color: rgb(75, 96, 255);
}
.header .nav-links{
    list-style: none;
}
.header .nav-links li{
    display: inline-block;
    padding: 12px 20px 0 20px;    
}
.header .nav-links a{
    font-size: 20px;
    color: #797474;
    text-decoration: none;    
}
.header .btn button{
    font-weight: 700;
    color: #000;
    padding: 9px 25px;
    border: 2px solid rgb(107, 115, 171);;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease 0s;
}
</style>