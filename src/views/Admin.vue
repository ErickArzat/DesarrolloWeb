<template>
  <div id="wrapper">
     <div class="container-fluid">
       <div class="row">
         <div class="col">
           <div class="info-card">
             <div class="data-card">
               <h5 class="name-card">{{ $t('admin.table.titleP') }}</h5>
               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">{{ $t('admin.table.id') }}</th>
                     <th scope="col">{{ $t('admin.table.client') }}</th>
                     <th scope="col">{{ $t('admin.table.type') }}</th>
                     <th scope="col">{{ $t('admin.table.staff') }}</th>
                     <th scope="col">{{ $t('admin.table.cake') }}</th>
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
                     <td scope="row">{{party.id_cake}}{{ this.cakeParty[party.id_party] }}</td>
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
                         <i class="bi bi-plus-circle-fill"></i>
                       </button>
                       <div id="myModal" class="modal" aria-hidden="true">
                         <div class="modal-content">
                           <div class="modal-header">
                            <span class="close" onclick="document.getElementById('myModal').style.display = 'none';">&times;</span>
                             <h2>{{ $t('admin.modal.title') }}</h2>
                           </div>
                           <div class="modal-body">
                               <table>
                                 <tr>
                                   <td>{{ $t('admin.modal.type') }}</td>
                                   <select class="status" v-model="selectedParty.type_party" @change="saveType(selectedParty)">
                                      <option v-for="typeparty in typesparties" :key="typeparty.id_type" :value="typeparty.id_type">
                                        {{ typeparty.name_type }}
                                      </option>
                                    </select>
                                 </tr>
                                 <tr>
                                   <td>{{ $t('admin.modal.staff') }}</td>
                                   <td>
                                    <select class="status" v-model="selectedParty.staff_party" @change="saveStaff(selectedParty)">
                                      <option v-for="staff in staffs" :key="staff.id_staff" :value="staff.id_staff">
                                        {{ staff.user_staff }}
                                      </option>
                                    </select>
                                   </td>
                                 </tr>
                                 <tr>
                                  <td>{{ $t('admin.modal.cake') }}</td>
                                   <td>
                                      <select class="status" v-model="selectedParty.cake_party" @change="saveCake(selectedParty)">
                                        <option v-for="cake in cakes" :key="cake.id_cake" :value="cake.id_cake">
                                          {{ cake.name_cake }}
                                        </option>
                                      </select>
                                   </td>
                                 </tr> 
                                 <tr>
                                   <td>{{ $t('admin.modal.decos') }}</td>
                                   <td>
                                      <select class="status" v-model="selectedParty.deco_party" @change="saveDeco(selectedParty)">
                                        <option v-for="deco in decos" :key="deco.id_deco" :value="deco.id_deco">
                                          {{ deco.name_deco }}
                                        </option>
                                      </select>
                                   </td>
                                 </tr>   
                                 <tr>
                                   <td>{{ $t('admin.modal.extra') }}</td>
                                   <td>
                                      <select class="status" v-model="selectedParty.extra_party" @change="saveExtra(selectedParty)">
                                        <option v-for="extra in extras" :key="extra.id_extra" :value="extra.id_extra">
                                          {{ extra.name_extra }}
                                        </option>
                                      </select>
                                   </td>
                                 </tr>  
                                 <tr>
                                   <td>{{ $t('admin.modal.date') }}</td>
                                   <td>      
                                       <input type="date" id="date" autocomplete="off" v-model="selectedParty.date_party" @change="saveDate(selectedParty)">
                                   </td>
                                 </tr> 
                                 <tr align="center">
                                   <td colspan="2" >      
                                       <br><input type="submit" id="btnSave" value="Guardar" @onclick="saveAllEdit(selectedParty)">
                                   </td>
                                 </tr>
                               </table>
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
     </div>
   </div>
 </template>
 <script>
 import axios from 'axios';
 
 export default {
    data() {
    return { 
      status:[],
      selectedParty: [],
      cakes:[],
      cakename: '',
      typesparties:[],
      staffs:[],
      decos:[],
      extras:[],
      parties: [],
      typeParty:[],
      clientParty:[],
      staffParty:[],
      totalParty:[],
      cakeParty:[],
      decosParty:[],
      nameDeco:[],
      extrasParty:[],
      nameExtra:[],
    };
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
      var datosEnviar={type:2, clnt:1, pal:1, cake:1, pay:1, staff:1};
       fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?update='+party.id_party,{
         method:"POST",
         body:JSON.stringify(datosEnviar)
       })
       .then(response=>response.json())
       .then((datosRespuesta)=>{
         console.log(datosRespuesta)
       })
       .catch(console.log)
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

       fetch('http://localhost/daw/DesarrolloWeb/src/sql/parties.php?nameCake='+party.id_cake)
       .then(response=>response.text())
       .then((datosRespuesta)=>{
         if(typeof datosRespuesta[0].success==='undefined')
         {
          this.cakeParty[party.id_party]=datosRespuesta;
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
     }
   },
 };
 </script>
 
 <style>
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
  
  input[type=submit]{
    background-color: #5B83FF;
    color: #fff;
    border-radius: 25px;
    border: 2px solid black;
    width: 50%;
  }
 </style>