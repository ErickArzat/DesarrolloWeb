<template>
  <div id="wrapper">
     <div class="container-fluid">
       <div class="row">
         <div class="col">
           <div class="info-card">
             <div class="data-card">
               <h5 class="name-card">{{ $t('admin.table.titleP') }}</h5>
               <table class="table">
                >
                 <thead>
                   <tr>
                     <th scope="col">{{ $t('admin.table.id') }}</th>
                     <th scope="col">{{ $t('admin.table.client') }}</th>
                     <th scope="col">{{ $t('admin.table.type') }}</th>
                     <th scope="col">{{ $t('admin.table.staff') }}</th>
                     <th scope="col">{{ $t('admin.table.date') }}</th>
                     <th scope="col">{{ $t('admin.table.total') }}</th>
                     <th scope="col">{{ $t('admin.table.status') }}</th>
                     <th scope="col">{{ $t('admin.table.edit') }}</th>
                     <th scope="col">{{ $t('admin.table.delete') }}</th>
                   </tr>
                 </thead>
                 
                 <tbody>
                   <tr v-for="party in parties" :key="party.id_party">
                     <td scope="row">{{party.id_party}}</td>
                     <td scope="row">{{party.id_clnt}}{{ this.clientParty[party.id_party] }}</td>
                     <td scope="row">{{party.id_type}}{{ this.typeParty[party.id_party] }}</td>
                     <td scope="row">{{party.id_staff}}{{ this.staffParty[party.id_party] }}</td>
                     <td scope="row">{{party.date_party}}</td>
                     <td scope="row">{{totalParty[party.id_party]}}</td>
                     <td>
                       <select class="status" v-model="status[party.id_party]" @change="saveSelection(party)">
                         <option value="opcion1">{{ $t('admin.status.waiting') }}</option>
                         <option value="opcion2">{{ $t('admin.status.inprogress') }}</option>
                         <option value="opcion3">{{ $t('admin.status.completed') }}</option>
                       </select>
                     </td>
                     <td>
                       <button class="myBtn" @click="selectionParty(party)" onclick="document.getElementById('myModal').style.display = 'block';"  >
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                         </svg>
                       </button>
                       <div id="myModal" class="modal" aria-hidden="true">
                         <div class="modal-content">
                           <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModal').style.display = 'none';">&times;</span>
                             <h2>{{ $t('admin.modal.title') }}</h2>
                           </div>
                           <div class="modal-body">
                            <form >
                               <table>
                                 <tr>
                                   <td>{{ $t('admin.modal.type') }}</td>
                                   <select class="status" id="typeModal" v-model="selectedParty.id_type">
                                      <option v-for="typeparty in typesparties" :key="typeparty.id_type" :value="typeparty.id_type">
                                        {{ typeparty.name_type }}
                                      </option>
                                    </select>
                                 </tr>
                                 <tr>
                                   <td>{{ $t('admin.modal.staff') }}</td>
                                   <td>
                                    <select class="status" id="staffModal" v-model="selectedParty.id_staff">
                                      <option v-for="staff in staffs" :key="staff.id_staff" :value="staff.id_staff">
                                        {{ staff.user_staff }}
                                      </option>
                                    </select>
                                   </td>
                                 </tr>
                                 <tr>
                                  <td>{{ $t('admin.modal.cake') }}</td>
                                   <td>
                                      <select class="status" id="cakeModal" v-model="selectedParty.id_cake">
                                        <option v-for="cake in cakes" :key="cake.id_cake" :value="cake.id_cake">
                                          {{ cake.name_cake }}
                                        </option>
                                      </select>
                                   </td>
                                 </tr> 
                                 <tr>
                                  <td>{{ $t('admin.modal.palette') }}</td>
                                   <td>
                                      <select class="status" id="palModal" v-model="selectedParty.id_pal">
                                        <option v-for="pal in palettes" :key="pal.id_pal" :value="pal.id_pal">
                                          {{ pal.name_pal }}
                                        </option>
                                      </select>
                                   </td>
                                 </tr>
                                 <tr>
                                   <td>{{ $t('admin.modal.decos') }}</td>
                                   <td>
                                      <select class="status" id="decoModal" v-model="selectedParty.id_deco">
                                        <option v-for="deco in decos" :key="deco.id_deco" :value="deco.id_deco">
                                          {{ deco.name_deco }}
                                        </option>
                                      </select>
                                   </td>
                                 </tr>   
                                 <tr>
                                   <td>{{ $t('admin.modal.extra') }}</td>
                                   <td>
                                      <select class="status" id="extraModal" v-model="selectedParty.id_extra">
                                        <option v-for="extra in extras" :key="extra.id_extra" :value="extra.id_extra">
                                          {{ extra.name_extra }}
                                        </option>
                                      </select>
                                   </td>
                                 </tr>  
                                 <tr>
                                   <td>{{ $t('admin.modal.date') }}</td>
                                   <td>      
                                       <input type="date" id="dateModal" autocomplete="off" v-model="selectedParty.date_party">
                                   </td>
                                 </tr> 
                                 <tr align="center">
                                   <td colspan="2" >      
                                       <br><input type="submit" class="btnSave" value="Guardar Cambios" @click="saveAllEdit(selectedParty)">
                                   </td>
                                 </tr>
                               </table>
                              </form>
                              
                           </div>
                         </div>
                       </div>
                     </td>
                     <td>
                       <button class="myBtn" @click="deleteParty(party)">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                         </svg>
                       </button>
                     </td>
                   </tr>
                 </tbody>
                 <a href="http://localhost/daw/DesarrolloWeb/src/sql/descargar_fiestas.php" target="_blank">Descargar Fiestas</a><br>
              <a href="http://localhost/daw/DesarrolloWeb/src/sql/descargar_payment.php" target="_blank">Descargar Pagos</a>
               </table>
             </div>
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col">
           <div class="info-card">
             <div class="data-card">
               <h5 class="name-card">{{ $t('admin.table.titleD') }}</h5>
               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">{{ $t('admin.table.id') }}</th>
                     <th scope="col">{{ $t('admin.table.deco') }}</th>
                     <th scope="col">{{ $t('admin.table.delete') }}</th>
                   </tr>
                 </thead>
                 <tbody>
                   <tr v-for="deco in decosParty" :key="deco.id_deco">
                     <td scope="row">{{deco.id_party}}</td>
                     <td scope="row">{{deco.id_deco}}{{this.nameDeco[deco.id_deco]}}</td>
                     <td>
                       <button class="myBtn" @click="deleteDeco(deco)">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                         </svg>
                       </button>
                     </td>
                   </tr>

                 </tbody>
               </table>
             </div>
           </div>
         </div>
         <div class="col">
           <div class="info-card">
             <div class="data-card">
               <h5 class="name-card">{{ $t('admin.table.titleE') }}</h5>
               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">{{ $t('admin.table.id') }}</th>
                     <th scope="col">{{ $t('admin.table.extra') }}</th>
                     <th scope="col">{{ $t('admin.table.delete') }}</th>
                   </tr>
                 </thead>
                 <tbody>
                  <tr v-for="extra in extrasParty" :key="extra.id_extra">
                     <td scope="row">{{extra.id_party}}</td>
                     <td scope="row">{{extra.id_extra}}{{this.nameExtra[extra.id_extra]}}</td>
                     <td>
                       <button class="myBtn" @click="deleteExtra(extra)">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                         </svg>
                       </button>
                     </td>
                   </tr>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
       <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.color') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col">{{ $t('admin.table.edit') }}</th>
                    <th scope="col">{{ $t('admin.table.delete') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="color in colors" :key="color.id">
                    <td scope="row">{{color.id_pal}}</td>
                    <td scope="row">{{color.name_pal}}</td>
                    <td scope="row">{{color.price_pal}}</td>
                    <td>
                      <button class="myBtn" role="button" @click="selectionParty(color)"  onclick="document.getElementById('myModalAdd').style.display = 'block';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                      </button>
                    </td>
                    <div id="myModalAdd" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAdd').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput" v-model="selectedPartyAdd.name" required><br>
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput" v-model="selectedPartyAdd.price">
                            <button class="btnSave" type="submit" @click="guardarConId(this.selectedParty)">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td>
                      <button class="myBtn" v-on:click="borrarColor(color.id_pal)" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                         </svg>  
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm" @submit.prevent="agregarColor" method="post" enctype="multipart/form-data">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                  <input type="text" class="" id="ColorNameInput" v-model="color.name_pal" required>
                </div>
                <div>
                  <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                  <input type="text" class="" id="ColorPriceInput" v-model="color.price_pal" required>
                </div>
                <div>
                  <label for="ColorNameInput" class="">{{ $t('addColor.imgLabel') }}:</label>
                  <input type="file" class="" id="ColorImgInput" @change="onFileChange" required>
                </div>
                <button type="submit" class="btn btn-primary" id="btnAdd" >{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.type') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col">{{ $t('admin.table.edit') }}</th>
                    <th scope="col">{{ $t('admin.table.delete') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="type in Types" :key="type.id_type">
                    <td scope="row">{{type.id_type}}</td>
                    <td scope="row">{{type.name_type}}</td>
                    <td scope="row">{{type.price_type}}</td>
                    <td><button class="myBtn" role="button" @click="selectionParty(type)" onclick="document.getElementById('myModalAddTipo').style.display = 'block';">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                      </button>
                    </td>
                    <div id="myModalAddTipo" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAddTipo').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput" v-model="selectedPartyAdd.name"><br>
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput" v-model="selectedPartyAdd.price">
                            <button class="btnSave" type="submit" @click="guardarTipoConId(this.selectedParty)">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td>
                      <button class="myBtn" role="button" v-on:click="borrarTipo(type.id_type)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                         </svg>  
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm" @submit.prevent="agregarTipo" method="post" enctype="multipart/form-data">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="TypeNameInput" class="">{{ $t('addType.nameLabel') }}:</label>
                  <input type="text" class="" id="TypeNameInput" v-model="color.name_pal" required>
                </div>
                <div>
                  <label for="TypePriceInput" class="">{{ $t('addType.priceLabel') }}:</label>
                  <input type="text" class="" id="TypePriceInput" v-model="color.price_pal" required>
                </div>
                <div>
                  <label for="TypeImgInput" class="">{{ $t('addType.imgLabel') }}:</label>
                  <input type="file" class="" id="TypeImgInput"  @change="onFileChange" required>
                </div>
                <button type="submit" class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.decoration') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col">{{ $t('admin.table.edit') }}</th>
                    <th scope="col">{{ $t('admin.table.delete') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="decoration in Decorations" :key="decoration.id_deco">
                    <td scope="row">{{decoration.id_deco}}</td>
                    <td scope="row">{{decoration.name_deco}}</td>
                    <td scope="row">{{decoration.price_deco}}</td>
                    <td><button class="myBtn" role="button" @click="selectionParty(decoration)" onclick="document.getElementById('myModalAddDeco').style.display = 'block';">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                      </button>
                    </td>
                    <div id="myModalAddDeco" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAddDeco').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput" v-model="selectedPartyAdd.name"><br>
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput" v-model="selectedPartyAdd.price">
                            <button type="submit" class="btnSave" @click="guardarDecoConId(this.selectedParty)">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td>
                      <button class="myBtn" role="button" v-on:click="borrarDeco(decoration.id_deco)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                         </svg>  
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm" @submit.prevent="agregarDeco" method="post" enctype="multipart/form-data">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="DecorationNameInput" class="">{{ $t('addDecoration.nameLabel') }}:</label>
                  <input type="text" class="" id="DecorationNameInput" v-model="color.name_pal" required>
                </div>
                <div>
                  <label for="DecorationPriceInput" class="">{{ $t('addDecoration.priceLabel') }}:</label>
                  <input type="text" class="" id="DecorationPriceInput" v-model="color.price_pal" required>
                </div>
                <div>
                  <label for="DecorationImgInput" class="">{{ $t('addDecoration.imgLabel') }}:</label>
                  <input type="file" class="" id="DecorationImgInput" @change="onFileChange" required>
                </div>
                <button class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
              <a href="http://localhost/daw/DesarrolloWeb/src/sql/descargar_fiestas.php" target="_blank">Descargar Fiestas</a>
              <a href="http://localhost/daw/DesarrolloWeb/src/sql/descargar_payment.php" target="_blank">Descargar Pagos</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.cake') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col">{{ $t('admin.table.edit') }}</th>
                    <th scope="col">{{ $t('admin.table.delete') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cake in Cakes" :key="cake.id_cake">
                    <td scope="row">{{cake.id_cake}}</td>
                    <td scope="row">{{cake.name_cake}}</td>
                    <td scope="row">{{cake.price_cake}}</td>
                    <td><button class="myBtn" role="button" @click="selectionParty(cake)" onclick="document.getElementById('myModalAddCake').style.display = 'block';">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                      </button>
                    </td>
                    <div id="myModalAddCake" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAddCake').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput" v-model="selectedPartyAdd.name"><br>
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput" v-model="selectedPartyAdd.price" required>
                            <button type="submit" class="btnSave" @click="guardarPastelConId(this.selectedParty)">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td><button class="myBtn" v-on:click="borrarPastel(cake.id_cake)" role="button" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                         </svg>  
                      </button>  
                    </td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm" @submit.prevent="agregarPastel" method="post" enctype="multipart/form-data">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="CakeNameInput" class="">{{ $t('addCake.nameLabel') }}:</label>
                  <input type="text" class="" id="CakeNameInput"  v-model="color.name_pal" required>
                </div>
                <div>
                  <label for="CakePriceInput" class="">{{ $t('addCake.priceLabel') }}:</label>
                  <input type="text" class="" id="CakePriceInput" v-model="color.price_pal" required>
                </div>
                <div>
                  <label for="CakeImgInput" class="">{{ $t('addCake.imgLabel') }}:</label>
                  <input type="file" class="" id="CakeImgInput"  @change="onFileChange" required>
                </div>
                <button class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="info-card">
            <div class="data-card">
              <h5 class="name-card">{{ $t('admin.titles.extras') }}</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">{{ $t('admin.table.id') }}</th>
                    <th scope="col">{{ $t('admin.table.name') }}</th>
                    <th scope="col">{{ $t('admin.table.price') }}</th>
                    <th scope="col">{{ $t('admin.table.edit') }}</th>
                    <th scope="col">{{ $t('admin.table.delete') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="extra in Extras" :key="extra.id">
                    <td scope="row">{{extra.id_extra}}</td>
                    <td scope="row">{{extra.name_extra}}</td>
                    <td scope="row">{{extra.price_extra}}</td>
                    <td><button class="myBtn" role="button" @click="selectionParty(extra)" onclick="document.getElementById('myModalAddExtra').style.display = 'block';">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                      </button>
                    </td>
                    <div id="myModalAddExtra" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModalAddExtra').style.display = 'none';">&times;</span>
                            <h2>{{ $t('btn.edit') }}</h2>
                          </div>
                          <div class="modal-body">
                            <label for="ColorNameInput" class="">{{ $t('addColor.nameLabel') }}:</label>
                            <input type="text" class="" id="ColorNameInput" v-model="selectedPartyAdd.name">
                            <br>
                            <label for="ColorPrice Input" class="">{{ $t('addColor.priceLabel') }}:</label>
                            <input type="text" class="" id="ColorPriceInput" v-model="selectedPartyAdd.price" required>
                            <button type="submit" class="btnSave" @click="guardarExtraConId(this.selectedParty)">{{ $t('btn.save') }}</button>
                          </div>
                        </div>
                      </div>
                    <td>
                      <button class="myBtn" role="button" v-on:click="borrarExtra(extra.id_extra)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#5B83FF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                         </svg>  
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <form class="addForm"  @submit.prevent="agregarExtra" method="post" enctype="multipart/form-data">
                <h5 class="name-card">{{ $t('btn.add') }}</h5>
                <div>
                  <label for="ExtraNameInput" class="">{{ $t('addExtras.nameLabel') }}:</label>
                  <input type="text" class="" id="ExtraNameInput"  v-model="color.name_pal" required>
                </div>
                <div>
                  <label for="ExtraPriceInput" class="">{{ $t('addExtras.priceLabel') }}:</label>
                  <input type="text" class="" id="ExtraPriceInput" v-model="color.price_pal" required>
                </div>
                <button class="btn btn-primary" id="btnAdd">{{ $t('btn.add') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
 </template>
 <script>
 import axios from 'axios';
  import NavBar from '../components/NavBar.vue';
 
 export default {
    components: {
      NavBar
    },
    data() {
    return { 
      status:[],
      selectedParty: [],
      cakes:[],
      cakename: '',
      typesparties:[],
      palettes:[],
      staffs:[],
      decos:[],
      extras:[],
      parties: [],
      typeParty:[],
      clientParty:[],
      staffParty:[],
      totalParty:[],
      decosParty:[],
      nameDeco:[],
      extrasParty:[],
      nameExtra:[],
      color: {
            name_pal: '',
            price_pal: '',
        },
      cake:{},
      selectedPartyAdd: {
            name: '',
            price: '',
      },
      colors:[],
      parties: [],
      Cakes: [],
      Decorations: [],
      Extras: [],
      Types: [],
      file: []
    };
  },
  created() {
    const userToken = localStorage.getItem('userToken');
    if (userToken) {
      console.log('Token encontrado:', userToken);
      const data = {
          token: userToken
        };
        const config = {
          method: 'POST', 
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        };
        this.validarAdmin(config)
    } else {
      console.log('No se encontró ningún token o el valor es nulo.');
      this.$router.push('/');
    }
    this.consultarColores();
    this.consultarTipos();
    this.consultarDecoraciones();
    this.consultarPasteles();
    this.consultarExtras();
  },
   mounted() {
    this.allData();
   },
   methods: {
    selectionParty(party) {
      this.selectedParty=party;
    },
    loadFromLocalStorage(party) {
      this.status[party.id_party] = this.loadSelection('optionSelect_', party.id_party);
    },
    loadSelection(keyPrefix, id) {
      const storedValue = localStorage.getItem(keyPrefix + id);
      return storedValue ? storedValue : "";
    },
     saveSelection(party) {
       localStorage.setItem('optionSelect_' + party.id_party, this.status[party.id_party]);
     },
     onFileChange(event) {
       this.cake.img = event.target.files[0];
       this.cakename= this.cake.img.name;
     },
     deleteParty(party){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?delete='+party.id_party)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         console.log(datosRespuesta)
       })
       .catch(console.log)
     },
     deleteDeco(deco){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/deco-party.php?delete='+deco.id_deco)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         console.log(datosRespuesta)
       })
       .catch(console.log)
     },
     deleteExtra(extra){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/extra-party.php?delete='+extra.id_extra)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         console.log(datosRespuesta)
       })
       .catch(console.log)
     },
    saveAllEdit(party){
      var datosEnviar={type:party.id_type, clnt:party.id_clnt, pal:party.id_pal, cake:party.id_cake, pay:party.id_pay, staff:party.id_staff};
      console.log(datosEnviar);
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?update='+party.id_party,{
        method:"POST",
        body:JSON.stringify(datosEnviar)
      })
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        console.log(datosRespuesta)
      })
      .catch(console.log);
      if(party.id_deco===undefined){console.log("Undefined Value: party.id_deco="+party.id_deco);}
      else{
      var datosDecos={id:party.id_party,deco:party.id_deco};
      console.log(datosDecos);
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?insertDeco',{
        method:"POST",
        body:JSON.stringify(datosDecos)
      })
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        console.log(datosRespuesta);
      })
      .catch(console.log);
      }
      if(party.id_extra===undefined){console.log("Undefined Value: party.id_extra="+party.id_extra);}
      else{
      var datosExtra={id:party.id_party,extra:party.id_extra};
      console.log(datosDecos);
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?insertExtra',{
        method:"POST",
        body:JSON.stringify(datosExtra)
      })
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        console.log(datosRespuesta);
      })
      .catch(console.log);
      }
    },
     addCakes(){
       //this.addFile();
       var datosEnviar={name:this.cake.name,img:this.cakename,price:this.cake.price};
       fetch('http://localhost/daw/DesarrolloWeb/src/sql/cakes.php?insertar=1',{
         method:"POST",
         body:JSON.stringify(datosEnviar)
       })
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         console.log(datosRespuesta)
       })
       .catch(console.log)
     },
     addFile(){
       const formData = new FormData();
       formData.append('image', this.cake.img);
       axios.post('http://localhost/daw/DesarrolloWeb/src/sql/upload.php', formData)
       .then((datosRespuesta)=>{
         console.log(datosRespuesta.data)
       })
       .catch(console.log)
     },
     dataParties(party){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?nameTP='+party.id_type)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.typeParty[party.id_party]=datosRespuesta;
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?nameCP='+party.id_clnt)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         if(typeof datosRespuesta[0].success==='undefined')
         {
          this.clientParty[party.id_party]=datosRespuesta;
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?nameSP='+party.id_staff)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         if(typeof datosRespuesta[0].success==='undefined')
         {
          this.staffParty[party.id_party]=datosRespuesta;
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?total='+party.id_pay)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         if(typeof datosRespuesta[0].success==='undefined')
         {
          this.totalParty[party.id_party]=datosRespuesta;
         }
       })
       .catch(console.log);
     },
     dataDecorations(deco){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/deco-party.php?name='+deco.id_deco)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.nameDeco[deco.id_deco]=datosRespuesta;
         }
       })
       .catch(console.log);
     },
     dataExtras(extra){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/extra-party.php?name='+extra.id_extra)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.nameExtra[extra.id_extra]=datosRespuesta;
         }
       })
       .catch(console.log);
     },
     allData(){
       fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.parties=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.parties=datosRespuesta;
           this.parties.forEach((party) => {
            this.dataParties(party);
            this.loadFromLocalStorage(party);
          });
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/typesparties.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.typesparties=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
          this.typesparties=datosRespuesta; 
         }
       })
       .catch(console.log);
 
       fetch('http://localhost/daw/DesarrolloWeb/src/sql/staff.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.staffs=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.staffs=datosRespuesta;
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/decorations.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.decos=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.decos=datosRespuesta;
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/extras.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.extras=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.extras=datosRespuesta;
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/cakes.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.cakes=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.cakes=datosRespuesta;
         }
       })
       .catch(console.log); 

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/palettes.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.palettes=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.palettes=datosRespuesta;
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/deco-party.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.decosParty=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.decosParty=datosRespuesta;
           this.decosParty.forEach((deco) => {
            this.dataDecorations(deco);
          });
         }
       })
       .catch(console.log);

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/extra-party.php')
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         this.extrasParty=[]
         if(typeof datosRespuesta[0].success==='undefined')
         {
           this.extrasParty=datosRespuesta;
           this.extrasParty.forEach((extra) => {
            this.dataExtras(extra);
          });
         }
       })
       .catch(console.log);
     },
    validarAdmin(config){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/validarAdmin.php', config)
      .then(response => response.json())
          .then(data => {
            console.log('Datos recibidos:', data);
            if(!data.access){
              this.$router.push('/');
            }
          })
          .catch(error => {
            console.error('Error en la solicitud a la API:', error);
          });
    },
    consultarColores(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/palettes.php')
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        this.colors=[]
        if(typeof datosRespuesta[0].success==='undefined')
        {
          this.colors=datosRespuesta;
        }
      })
      .catch(console.log);
    },
    agregarColor() {
      this.addFile();
      var datosEnviar={name:this.color.name_pal,img:this.file.name,price:this.color.price_pal}
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/palettes.php?insertar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color agregado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    borrarColor(id){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/palettes.php?borrar='+ id)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        window.location.href="admin"
      })
      .catch(error => {
        console.error('Error al realizar la solicitud:', error);
      });
    },
    guardarConId(data) {
      var datosEnviar = {name: this.selectedPartyAdd.name,id: data.id_pal,price: this.selectedPartyAdd.price};
      console.log(datosEnviar);
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/palettes.php?actualizar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color modificado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    consultarTipos(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/typesparties.php')
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        this.Types=[]
        if(typeof datosRespuesta[0].success==='undefined')
        {
          this.Types=datosRespuesta;
        }
      })
      .catch(console.log)
    },
    agregarTipo() {
      this.addFile();
      var datosEnviar={name:this.color.name_pal,img:this.file.name,price:this.color.price_pal}
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/typesparties.php?insertar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color agregado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    borrarTipo(id){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/typesparties.php?borrar='+ id)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        window.location.href="admin"
      })
      .catch(error => {
        console.error('Error al realizar la solicitud:', error);
      });
    },
    guardarTipoConId(data) {
      var datosEnviar = {name: this.selectedPartyAdd.name,id: data.id_type,price: this.selectedPartyAdd.price};
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/typesparties.php?actualizar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color modificado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    consultarDecoraciones(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/decorations.php')
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        this.Decorations=[]
        if(typeof datosRespuesta[0].success==='undefined')
        {
          this.Decorations=datosRespuesta;
        }
      })
      .catch(console.log)
    },
    agregarDeco() {
      this.addFile();
      var datosEnviar={name:this.color.name_pal,img:this.file.name,price:this.color.price_pal}
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/decorations.php?insertar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color agregado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    borrarDeco(id){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/decorations.php?borrar='+ id)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        window.location.href="admin"
      })
      .catch(error => {
        console.error('Error al realizar la solicitud:', error);
      });
    },
    guardarDecoConId(data) {
      var datosEnviar = {name: this.selectedPartyAdd.name,id: data.id_deco,price: this.selectedPartyAdd.price};
      console.log(datosEnviar);
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/decorations.php?actualizar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color modificado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    consultarPasteles(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/cakes.php')
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        this.Cakes=[]
        if(typeof datosRespuesta[0].success==='undefined')
        {
          this.Cakes=datosRespuesta;
        }
      })
      .catch(console.log)
    },
    agregarPastel() {
      this.addFile();
      console.log(this.file.name);
      var datosEnviar={name:this.color.name_pal,img:this.file.name,price:this.color.price_pal}
      console.log(datosEnviar);
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/cakes.php?insertar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color agregado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    borrarPastel(id){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/cakes.php?borrar='+ id)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        window.location.href="admin"
      })
      .catch(error => {
        console.error('Error al realizar la solicitud:', error);
      });
    },
    guardarPastelConId(data) {
      var datosEnviar = {name: this.selectedPartyAdd.name,id: data.id_cake,price: this.selectedPartyAdd.price};
      console.log(datosEnviar);
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/cakes.php?actualizar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color modificado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    consultarExtras(){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/extras.php')
      .then(response=>response.json())
      .then((datosRespuesta)=>{
        this.Extras=[]
        if(typeof datosRespuesta[0].success==='undefined')
        {
          this.Extras=datosRespuesta;
        }
      })
      .catch(console.log)
    },
    agregarExtra() {
      var datosEnviar={name:this.color.name_pal,price:this.color.price_pal}
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/extras.php?insertar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color agregado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
    borrarExtra(id){
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/extras.php?borrar='+ id)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        window.location.href="admin"
      })
      .catch(error => {
        console.error('Error al realizar la solicitud:', error);
      });
    },
    guardarExtraConId(data) {
      var datosEnviar = {name: this.selectedPartyAdd.name,id: data.id_extra,price: this.selectedPartyAdd.price};
      console.log(datosEnviar);
      fetch('http://localhost/daw/DesarrolloWeb/src/sql/extras.php?actualizar=1', {
        method: 'POST',
        body:JSON.stringify(datosEnviar),
      })
      .then(response => response.json())
        .then(data => {
          console.log('Color modificado:', data);
          window.location.href="admin"
        })
        .catch(error => {
        console.error('Error al agregar color:', error);
        });
    },
  },
};
</script>
 
<style scoped>
#wrapper{
  padding: 100px 100px 100px 100px;
  background: white;
}

@media screen and (max-width: 340px) {
  #wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 10px 10px 10px 10px;
  }
}

@media screen and (max-width: 768px) {
  #wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 10px 10px 10px 10px;
  }
}

@media screen and (min-width: 1350px) {
  #wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 0px 100px 100px 100px;
  }
}

tbody{
  font-family:sans-serif;
}

.info-card{
    margin-bottom: 25px; 
    border-radius: 25px; 
    box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2); 
    border: 2px solid #5B83FF;
    background-color: white;    
}

.data-card {
    border-radius: 10px;
    justify-content: center;
    align-items: center;
    padding: 15px 15px 15px 15px;
    overflow-x:auto;
}

.name-card{ 
    font-size: 28px;
    color: black;
}

a{
    text-decoration: none;
    transition: 1s;
    color: black;
  }

a:hover{
  color: #5B83FF;
}

.status{
  border-radius: 25px;
  border: 2px solid rgb(75, 96, 255);
  min-width: 120px;
  appearance: none;
  padding-left: 10px;
}

.myBtn{
  border: 0px solid white;
  background-color: white;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

.modal-header{
  padding: 2px 16px;
  background-color: #5B83FF;
  color: white;
}

.modal-body {
  padding: 16px 16px;
  align-self: center;
}

.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
  transition: 1s;
}

@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}
  
input[type=submit]:focus{
  background-color: #fff;
  color: #5B83FF;
}

.btnSave{
  background-color: #5B83FF;
  color: #fff;
  border-radius: 25px;
  border: 2px solid black;
  width: 60%;
}

#btnEditar, #btnBorrar{
  margin-right: 1rem;
  width: 8vw;
}

#btnAdd{
  margin-top: 1rem;
  width: 10vw;
}

@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

</style>
