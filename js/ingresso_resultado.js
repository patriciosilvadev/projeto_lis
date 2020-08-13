$(document).ready(function () {

    $( function() {
        var $signupForm = $( '#SignupForm' );
      
        $signupForm.validate({errorElement: 'em'});
      
        $signupForm.formToWizard({
          submitButton: 'SaveAccount',
          nextBtnClass: 'btn btn-primary next',
          prevBtnClass: 'btn  prev',
          buttonTag:    'button',
          validateBeforeNext: function(form, step) {
            var stepIsValid = true;
            var validator = form.validate();
            $(':input', step).each( function(index) {
              var xy = validator.element(this);
              stepIsValid = stepIsValid && (typeof xy == 'undefined' || xy);
            });
            return stepIsValid;
          },
          progress: function (i, count) {
            $('#progress-complete').width(''+(i/count*100)+'%');
          }
        });
      });

     

      $(".pula").keypress(function (e) {
        var tecla = e.keyCode ? e.keyCode : e.which;
        if (tecla == 13) {
          campo = $(".pula");
          indice = campo.index(this);
          e.preventDefault(e);
          if (campo[indice + 1] != null) {
            proximo = campo[indice + 1];
            proximo.focus();
          }
        }
      });

      $("#calIngresso").keyup( function(e){
        var cal = $(this).val();
        $("#ingresso").html("<br>").hide();
        var tecla = e.keyCode ? e.keyCode : e.which;
       
        if(tecla == 13){
          $.ajax({
            url: "ingresso_resultado.php",
            type: "POST",
            data: {cal: cal},
            success: function(data){
              $("#calIngresso").val(' ');
              $("#ingresso").html(data).show();
            }
          })
        }
       
      })

      $(document).on('click','#finalizar',function(){
        var form = $("#SignupForm").serialize();
        $.ajax({
          url: "validar/validar.php?validar=10",
          type: "POST",
          data: form,
          success: function (data) {
            console.log(data);
            if(data == 1){
              $("#ingresso").hide();
              $("#calIngresso").focus();
            }
          },
        });
      });
}); //==END==
  