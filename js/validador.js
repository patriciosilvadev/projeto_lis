$(document).ready(function () {
  /* $("#cpf").mask("AAAAA"); */
  $("#cpf").mask("AAA.AAA.AAA-AA", {
    translation: {
      A: { pattern: /[Z0-9]/ },
    },
  });
  $("#rg").mask("AA.AAA.AAA-A", {
    translation: {
      A: { pattern: /[Z0-9]/ },
    },
  });
  

  $("#form").validate({
    rules: {},
    messages: {},
    submitHandler: function (form) {
      var dados = $(form).serialize();
      if (false) {
        $.ajax({
          url: "validar/validar.php?validar=9",
          type: "POST",
          beforeSend: function () {
            $(".hide").hide();
          },
          data: dados,
          success: function (data) {
            console.log(data);
            if (data == "erro_sem_exames") {
              /* erro */
              //$("#report_sistem").removeClass("").addClass("alert alert-warning").html("ERRO:  INSERT #002. <br> POR FAVOR, COMUNICAR AO DESENVOLVIMENTO!").show();
            } else {
              //$("#report_sistem").removeClass("").addClass("alert alert-info").html("CADASTRO COM SUCESSO: CAL " + data).show();
            }
          },
        });
      }

      return false;
    },
  });
/* env */
  $("#enviaf").click(function () {
    $("#cal").attr('readonly',false).attr('type', 'number');
    var dados = $("#form").serialize();
    $("#button_form").hide();
    $.ajax({
      url: "validar/validar.php?validar=9",
      type: "POST",
      beforeSend: function () {
        $("#carregamento").show();
      },
      AfterSend: function () {},
      data: dados,
      success: function (data) {
        console.log(data);

        $("#cal_etx").val(data);
        if (data == "erro_sem_exames") {
          /* erro */
          $("#report_sistem")
            .removeClass("")
            .addClass("alert alert-warning text-center")
            .html(
              "<strong>ERRO:</strong>  INSERT #002. <br> POR FAVOR, COMUNICAR AO DESENVOLVIMENTO!"
            )
            .show();
        } else {
          $("#report_sistem")
            .removeClass("")
            .addClass("alert alert-info text-center")
            .html(
              "<strong>CADASTRO COM SUCESSO:</strong> CAL " +
                data).show();
         
        }

        $.ajax({
          url: "etiqueta/gera_etq.php",
          type: "POST",
          data: { cal: data },
          success: function (data1) {
            $("#modalEtq").modal("show");
            $("#etiqueta").html(data1).show();
            $("#modalEtqLabelMsg").html("ETIQUETA CAL: " + data);
            /* limpa form */
            $(":input", "#form")
              .not(":button, :submit, :reset, :hidden")
              .val("");
            $("#convenio option").remove();
            $.ajax({
              url: "validar/validar.php?validar=12",
              type: "POST",
              success: function (data) {
                $("#tabelaMne").hide();
              },
            });
            /* fim limpa form */
          },
        });

        /* limpa form */
        $(":input", "#form").not(":button, :submit, :reset, :hidden").val("");
        $("#convenio option").remove();
        $.ajax({
          url: "validar/validar.php?validar=12",
          beforeSend: function () {
            
          },
          type: "POST",
          success: function (data) {
            $(".hide").hide();
          },
        });
        /* fim limpa form */
      },
    });
  });
  /* fim env */
  //>>>>>
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
  //>>>> exames.php
  $("#mne").keyup(function () {
    var mne = $(this).val();
    $.ajax({
      url: "validar/validar.php?validar=2",
      type: "POST",
      data: { mne: mne },
      success: function (data) {
        if (data == 1) {
        }
      },
    });
  });
  //>>>
  $("#mne").keyup(function (e) {
    $("#mne_nome").val("");
    $("#material").val("");
    $("#invalido").hide();
    $("#material").show();
    $("#get_material").hide();
    var mne = $(this).val();

    var priemiroChar = mne.substring(0, 1);
    var tecla = e.keyCode ? e.keyCode : e.which;
    if (tecla == 13) {
      if (priemiroChar == "%") {
        $("#mne").hide();
        $("#mne1").show();
        var mne1 = $("#mne1").val();
        $.ajax({
          url: "tabela/query_exame_cad_paciente.php",
          type: "POST",
          data: { mne: mne },
          success: function (data) {
            console.log(data);
            $("#get_exames").html(data);
          },
        });
      } else {
        var id_tb = $("#id_tb").val();
        $.ajax({
          url: "validar/validar.php?validar=5",
          type: "POST",
          data: { mne: mne, id_tb: id_tb },
          success: function (data) {
            console.log(data);

            var obj = JSON.parse(data);
            if (obj.valid == 1) {
              $("#mne_nome").val(obj.nome);
              $("#idtabela").val(obj.id);
              if (obj.material == "SEM") {
                $("#material").hide();
                $.ajax({
                  url: "tabela/query_material_cad_paciente.php",
                  success: function (data) {
                    console.log(data);
                    $("#get_material").show();
                    $("#get_material").html(data);
                  },
                });
              } else {
                $("#material").val(obj.material);
              }
              $("#material").focus();
            } else {
              $("#invalido").show();
            }

            console.log(obj);
          },
        });
      }
    }
  });

  $(document).on("click", "#material1", function () {
    var material = $(this).val();
    console.log("ok");
    if (material.length > 0) {
      $("#get_material").hide();
      $("#material").show().focus();
      $("#material").val(material);
    }
  });

  $(document).ready(function () {
    $(".toUpperCase").keyup(function () {
      $(this).val($(this).val().toUpperCase());
    });
  });

  $(document).on("dblclick", "#mne1", function () {
    console.log("1");
    $("#mne1").hide();
    $("#mne").show().focus();
    $("#mne").val("");
  });

  $(document).on("click", "#mne1", function () {
 
    var exame = $(this).val().split("_");
    if ($(this).val().length > 0) {
      $("#mne1").hide();
      $("#mne").show().focus();
      $("#mne").val(exame[0]);
      $("#id_tb").val(exame[1]);
    }
    console.log(exame[1]);
  });

  $("#material").keyup(function (e) {
    var material = $(this).val();
    var mne = $("#mne").val();
    var id_tb = $("#idtabela").val();
    //var mneId = $("#mne_id").val();
    var tecla = e.keyCode ? e.keyCode : e.which;
    if (tecla == 13) {
      $.ajax({
        url: "validar/validar.php?validar=6",
        type: "POST",
        data: { material: material, mne: mne, id_tb: id_tb },
        success: function (data) {
          console.log(data);
          $.ajax({
            url: "tabela/form_cad_paciente_exames.php",
            success: function (data) {
              $("#id_tb").val("");
              $("#tabelaMne").show().html(data);
              $("#mne").val("").focus();
              $("#material").val("");
              $("#mne_nome").val("");
            },
          });
        },
      });
    }
  });

  $(document).on("click", ".remover", function () {
    var remover = $(this).attr("id");
    $.ajax({
      url: "validar/validar.php?validar=4",
      type: "POST",
      data: { mne: remover },
      success: function (data) {
        $.ajax({
          url: "tabela/form_cad_paciente_exames.php",
          success: function (data) {
            $("#tabelaMne").html(data);
          },
        });
      },
    });
  });

  $("#cal").keyup(function (e) {
    var cal = $(this).val();
    
    var tecla = e.keyCode ? e.keyCode : e.which;
    if (tecla == 13) {
      $.ajax({
        url: "validar/validar.php?validar=7",
        type: "POST",
        data: { cal: cal },
        success: function (data) {
          var obj = JSON.parse(data);
          console.log(obj);
          $("#convenio option").remove();
          if (obj.valido == 1) {
            $("#button_form").show();
            $("#carregamento").hide();
            $("#cal").attr('type', 'text').val("AUTOMATICO").attr('readonly', true);
            $("#report_sistem").removeClass("").addClass("").html("").hide();
            $("#posto").val(obj.nome_posto);
            $("#cal_sistema").val(obj.cal);
            $("#id_posto").val(obj.id_posto);
            $(".hide").show();
            $("#dt_atendimento").val(obj.data_atual);
            $("#hr_atendimento").val(obj.hora_atual); /* data e hora */
            $("#convenio").append('<option value="">...</option>');
            $.each(obj.conveio, function (index, value) {
              /* alert( index + ": " + value['nome'] ); */
              $("#convenio").append(
                $("<option>", {
                  value: index + "*" + value["nome"],
                  text: index + " - " + value["nome"],
                })
              );
            });
            $("#nome_paciente").focus();
          } else {
            $("#report_sistem")
              .removeClass()
              .addClass("alert alert-warning text-center")
              .html("<strong>Mensagem:</strong> Posto inválida!")
              .show();
          }
        },
      });
    }
  });

  $("#convenio").change(function () {
    var convenio = $(this).val().split("*");
  
    if (convenio[0] != "NULL") {
      $("#nome_convenio").val(convenio[1]);
      $.ajax({
        url: "validar/validar.php?validar=8",
        type: "POST",
        data: { convenio: convenio[0] },
        success: function (data) {
          console.log(data);
        },
      });
    }
  });


  $(document).on("keyup", "#medico_id", function (e) {
    var id_medico = $(this).val();
    var tecla = e.keyCode ? e.keyCode : e.which;
    if (tecla == 13) {
      $.ajax({
        url: "validar/validar.php?validar=11",
        type: "POST",
        data: { id_medico: id_medico },
        success: function (data) {
          var obj = JSON.parse(data);
          if (obj.valido == 1) {
            $("#codGetMedico").hide();
            $("#medico_nome")
              .val(obj.nome)
              .attr("readonly", true)
              .removeClass("buscaMedico")
              .show()
              .focus();
            $("#erro_medico").html(" ");
          } else {
            $("#erro_medico").html("<small>Código não Encontrado</small>");
          }
        },
      });
    } else {
      $("#medico_nome").val("");
      $("#erro_medico").html(" ");
    }
  });

  $(document).on("dblclick", "#medico_nome", function () {
    $("#medico_nome")
      .attr("readonly", false)
      .addClass("buscaMedico")
      .removeClass("pula");
  });

  $(document).on("keyup", ".buscaMedico", function (e) {
    var tecla = e.keyCode ? e.keyCode : e.which;
    var buscaMEdico = $("#medico_nome").val();
    if (tecla == 13) {
      $("#medico_nome").hide();
      $.ajax({
        url: "tabela/tabela_medico_form.php",
        type: "POST",
        data: { buscaMEdico: buscaMEdico },
        success: function (data) {
          $("#getMedico").html(data).show();
        },
      });
    }
  });

  $(document).on("click", "#codGetMedico", function () {
    var medico = $(this).val();
    if ($(this).val().length > 0) {
      $("#getMedico").html("").hide();
      $("#medico_id").val(medico).focus();
      $("#medico_nome")
        .attr("readonly", true)
        .removeClass("buscaMedico")
        .addClass("pula")
        .val("")
        .show();
    }
  });

  $("#cancelar").click(function () {
    $(":input", "#form").not(":button, :submit, :reset, :hidden").val("");
    $("#convenio option").remove();
    var cal = "";
    $.ajax({
      url: "validar/validar.php?validar=12",
      type: "POST",
      data: { cal: cal },
      success: function (data) {
        $("#tabelaMne").hide();
        
      },
    });
    $("#cal").attr('readonly',false).attr('type', 'number');
    $(".hide").hide();
    $("#button_form").hide();
  });
}); //==END==