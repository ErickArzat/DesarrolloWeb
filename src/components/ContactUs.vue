
<template>
    <div class="container">
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
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <p class="my-custom-font-size mb-2">{{ $t('websites.instagram') }}</p>
                  </div>
                  <div class="content">
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <p class="my-custom-font-size">{{ $t('websites.facebook') }}</p>
                  </div>
              </div>
            </div>
            <div class="col-md-7 grow-on-hover">
              <h4 class="title-message">{{ $t('contact.form_title') }}</h4>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">{{ $t('contact.name_label') }}</label>
                    <input type="text" class="form-control" id="formGroupExampleInput">
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">{{ $t('contact.email_label') }}</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">{{ $t('contact.message') }}</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                  <button class="btn btn-primary">{{ $t('btn.submit') }}</button>
            </div>
        </div>
    </div>
</template>

<style>
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