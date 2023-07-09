function resetPassword(id) {
  if (confirm("Êtes-vous sûr de vouloir réinitialiser le mot de passe de ce compte ?")) {
    // Envoie de la requête AJAX pour réinitialiser le mot de passe
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "admin_accounts.php?id=" + id + "&action=reset", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        location.reload(); // Rafraîchir la page pour afficher les changements
      }
    };
    xhr.send();
  }
}

function deleteAccount(id) {
  if (confirm("Êtes-vous sûr de vouloir supprimer ce compte ?")) {
    // Envoie de la requête AJAX pour supprimer le compte
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "admin_accounts.php?id=" + id + "&action=delete", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        location.reload(); // Rafraîchir la page pour afficher les changements
      }
    };
    xhr.send();
  }
}

function validateAccount(id) {
  if (confirm("Êtes-vous sûr de vouloir valider ce compte ?")) {
    // Envoie de la requête AJAX pour valider le compte
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "admin_accounts.php?id=" + id + "&action=validate", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        location.reload(); // Rafraîchir la page pour afficher les changements
      }
    };
    xhr.send();
  }
}
