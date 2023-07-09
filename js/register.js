$(document).ready(function() {
    $("#email").on("input", function() {
      var email = $(this).val();
  
      $.ajax({
        url: "check_email.php",
        method: "POST",
        data: { email: email },
        dataType: "json",
        success: function(response) {
          if (response.exists) {
            $("#email-error-message").text("L'adresse e-mail est déjà utilisée.");
          } else {
            $("#email-error-message").empty();
          }
        },
        error: function() {
          alert("Une erreur est survenue lors de la vérification de l'adresse e-mail.");
        }
      });
    });
  });
  