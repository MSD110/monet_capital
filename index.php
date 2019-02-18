<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Development</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Material design icons imported for regular usage. -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>

    <body>
        <div id="app"></div>
    <script type="text/javascript" src="http://localhost:9080/monetcap/Title_files/app.bundle.js"></script>
    <script type="text/javascript" src="http://localhost:9080/monetcap/Title_files/jquery-3.3.1.js"></script>
    <script>
      var method = $('#sign_form_id').attr('method');
      $('#sign_form_id button').click(function(e){
        e.preventDefault();
        var link = $('#sign_form_id').attr('action');
        $.ajax({url: link, type: "POST", data: $('#sign_form_id').serialize(), success: function(result){
          alert(result);
          $('#sign_form_id')[0].reset();
          //$('body').append('<div id="psf-success-modal" data-uk-modal="true" class="uk-modal uk-open" style="display: block;"><div class="uk-modal-dialog uk-padding-large"><h2 class="monet-text-gold">Submitted</h2><p>Thank you for choosing Monet Capital! We will be in touch within 24 hours. We look forward to partnering with you!</p></div></div>');
        }});
      });
      $('.uk-button.uk-button-primary.uk-flex-').click(function(){
        var price_option = $('.uk-select.uk-width-expand').val();
        $('#msf-modal').addClass('uk-open');
        $('#msf-modal').show();
      });

      var mouse_is_inside = false;

      $(document).ready(function()
      {
          $('.multistepform.uk-box-shadow-medium.uk-flex').hover(function(){
              mouse_is_inside=true;
          }, function(){
              mouse_is_inside=false;
          });

          $("body").mouseup(function(){
              if(! mouse_is_inside) {
                $('#msf-modal').removeClass('uk-open');
                $('#msf-modal').hide();
              }
          });
      });
      $('.uk-background-default.uk-padding.uk-width-expand.uk-position-relative .uk-button.uk-button-default').click(function(){
        var how_much = $('.form-switcher.uk-switcher li:first-child h2').text();
        var how_soon = $('input[name="soonSelect"]:checked').val();
        var years_business = $('input[name="yearSelect"]:checked').val();
        var monthly_revenue = $('input[name="revenueSelect"]:checked').val();
        var industry = $('select[name="industrySelect"]').val();
        var first_name = $('.form-switcher.uk-switcher li:last-child input[name="firstName"]').val();
        var last_name = $('.form-switcher.uk-switcher li:last-child input[name="lastName"]').val();
        var email_address = $('.form-switcher.uk-switcher li:last-child input[name="email"]').val();
        var phone_number = $('.form-switcher.uk-switcher li:last-child input[name="phone"]').val();
        var business_name = $('.form-switcher.uk-switcher li:last-child input[name="businessName"]').val();

        var link = $('#sign_form_id').attr('action');
        var data = 'how_much=' + how_much + '&how_soon=' + how_soon + '&years_business=' + years_business + '&monthly_revenue=' + monthly_revenue + '&industry=' + industry + '&first_name=' + first_name + '&last_name=' + last_name + '&email_address=' + email_address + '&phone_number=' + phone_number + '&business_name=' + business_name;
        $.ajax({url: link, type: "POST", data: data, success: function(result){
            alert(result);
          //$('.uk-background-default.uk-padding.uk-width-expand.uk-position-relative form')[0].reset();
            $('#msf-modal').removeClass('uk-open');
            $('#msf-modal').hide();
        }});
      });
    </script>
  </body>
</html>
