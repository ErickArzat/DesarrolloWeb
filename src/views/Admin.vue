

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
 <div id="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ganancias Anuales</h5>
              <h6 class="card-subtitle mb-2 text-muted">$150K</h6>
              <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
              <a href="#" class="card-link">Detalles</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ganancias Mensuales</h5>
              <h6 class="card-subtitle mb-2 text-muted">$12.5k</h6>
              <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
              <a href="#" class="card-link">Detalles</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Fiestas</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark Otto</td>
                    <td>Infantil</td>
                    <td>-/-/-</td>
                    <td>---</td>
                    <td>$</td>
                    <td><button class="estado">Completado</button></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob  Thompson</td>
                    <td>Boda</td>
                    <td>-/-/-</td>
                    <td>---</td>
                    <td>$</td>
                    <td><button class="estado">Pendiente</button></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry Bruyne</td>
                    <td>Graduación</td>
                    <td>-/-/-</td>
                    <td>---</td>
                    <td>$</td>
                    <td><button class="estado">En proceso</button></td>
                  </tr>
                </tbody>
              </table>
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