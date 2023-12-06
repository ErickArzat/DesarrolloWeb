

<style>
    #wrapper{
        padding:90px 15px;
        background: white;
        }

    .card{
        margin-bottom: 25px; 
        border-radius: 25px; 
        box-shadow: 0 3px 5px rgba(0,0,0,.1); 
        border-color: black}

    .card-title{ 
        font-size: 28px;}

    .addColor-title{
        font-size: 28px;
        margin-left: calc(1vw + 10px);
    }

    @media(min-width:992px) {
        #wrapper{
            padding: 90px 15px 15px 75px; }
    }
    a{
        text-decoration: none;
        color: white;
        transition: 1s;
      }

    a:hover{
      color: black;
    }
    
    .estado{
      border-radius: 25px;
      border-color: rgb(75, 96, 255);
    }
</style>

<template>
  <NavBar/>
 <div id="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.table.title') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.client') }}</th>
                    <th scope="col">{{ $t('admin.table.type') }}</th>
                    <th scope="col">{{ $t('admin.table.staff') }}</th>
                    <th scope="col">{{ $t('admin.table.date') }}</th>
                    <th scope="col">{{ $t('admin.table.total') }}</th>
                    <th scope="col">{{ $t('admin.table.status') }}</th>
                    <th scope="col">{{ $t('admin.table.details') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="party in parties" :key="party.id">
                    <td scope="row">{{party.id}}</td>
                    <td scope="row">{{party.client}}</td>
                    <td scope="row">{{party.type}}</td>
                    <td scope="row">{{party.staff}}</td>
                    <td scope="row">{{party.date}}</td>
                    <td scope="row">{{party.total}}</td>
                    <td>
                      <select class="status" v-model="party.status" @change="guardarSeleccion(party)">
                        <option value="opcion1">{{ $t('admin.status.waiting') }}</option>
                        <option value="opcion2">{{ $t('admin.status.inprogress') }}</option>
                        <option value="opcion3">{{ $t('admin.status.completed') }}</option>
                      </select>
                    </td>
                    <td>
                      <button id="myBtn" onclick="document.getElementById('myModal').style.display = 'block';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                        <i class="bi bi-plus-circle-fill"></i>
                      </button>
                      <div id="myModal" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModal').style.display = 'none';">&times;</span>
                            <h2>{{ $t('admin.modal.title') }}</h2>
                          </div>
                          <div class="modal-body">
                            <p>{{ $t('admin.modal.client') }}</p>
                            <p>{{ $t('admin.modal.type') }}</p>
                            <p>{{ $t('admin.modal.staff') }}</p>
                            <p>{{ $t('admin.modal.date') }}</p>
                            <p>{{ $t('admin.modal.total') }}</p>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <form v-on:submit.prevent="addCakes" method="post" enctype="multipart/form-data">
                <div>
                  <label for="cakeName">Nombre del Pastel:</label>
                  <input type="text" v-model="cake.name" required>
                </div>
                <div>
                  <label for="cakePrice">Precio del Pastel:</label>
                  <input type="number" v-model="cake.price" required>
                </div>
                <div>
                  <label for="cakeImage">Imagen del Pastel:</label>
                  <input type="file" v-on:change="onFileChange" required>
                </div>
                <div>
                  <button type="submit">Guardar Pastel</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <form class="addForm">
                <div>
                  <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                  <input type="text" class="" id="ColorNameInput">
                </div>
                <div>
                  <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                  <input type="text" class="" id="ColorPriceInput">
                </div>
                <div>
                  <label for="ColorNameInput" class="">{{ $t('addColor.imgLabel') }}:</label>
                  <input type="file" class="" id="ColorImgInput">
                </div>
                <button class="btn btn-primary">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <form class="addForm">
                <div>
                  <label for="TypeNameInput" class="">{{ $t('addType.nameLabel') }}:</label>
                  <input type="text" class="" id="TypeNameInput">
                </div>
                <div>
                  <label for="TypePriceInput" class="">{{ $t('addType.priceLabel') }}:</label>
                  <input type="text" class="" id="TypePriceInput">
                </div>
                <div>
                  <label for="TypeImgInput" class="">{{ $t('addType.imgLabel') }}:</label>
                  <input type="file" class="" id="TypeImgInput">
                </div>
                <button class="btn btn-primary">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <form class="addForm">
                <div>
                  <label for="DecorationNameInput" class="">{{ $t('addDecoration.nameLabel') }}:</label>
                  <input type="text" class="" id="DecorationNameInput">
                </div>
                <div>
                  <label for="DecorationPriceInput" class="">{{ $t('addDecoration.priceLabel') }}:</label>
                  <input type="text" class="" id="DecorationPriceInput">
                </div>
                <div>
                  <label for="DecorationImgInput" class="">{{ $t('addDecoration.imgLabel') }}:</label>
                  <input type="file" class="" id="DecorationImgInput">
                </div>
                <button class="btn btn-primary">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <form class="addForm">
                <div>
                  <label for="CakeNameInput" class="">{{ $t('addCake.nameLabel') }}:</label>
                  <input type="text" class="" id="DecorationNameInput">
                </div>
                <div>
                  <label for="CakePriceInput" class="">{{ $t('addCake.priceLabel') }}:</label>
                  <input type="text" class="" id="CakePriceInput">
                </div>
                <div>
                  <label for="CakeImgInput" class="">{{ $t('addCake.imgLabel') }}:</label>
                  <input type="file" class="" id="CakeImgInput">
                </div>
                <button class="btn btn-primary">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <form class="addForm">
                <div>
                  <label for="ExtraNameInput" class="">{{ $t('addExtras.nameLabel') }}:</label>
                  <input type="text" class="" id="ExtraNameInput">
                </div>
                <div>
                  <label for="ExtraPriceInput" class="">{{ $t('addExtras.priceLabel') }}:</label>
                  <input type="text" class="" id="ExtraPriceInput">
                </div>
                <div>
                  <label for="ExtraImgInput" class="">{{ $t('addExtras.imgLabel') }}:</label>
                  <input type="file" class="" id="ExtraImgInput">
                </div>
                <button class="btn btn-primary">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

import NavBar from '../components/NavBar.vue'
export default {
  components:{ 
    NavBar
  },
}
</script>