function register() {
  const firstName = $("#firstName").val();
  const lastName = $("#lastName").val();
  const email = $("#email").val();
  const password = $("#password").val();
  const birthDate = $("#birthDate").val();
  const gender = $("#gender").val();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/auth/register.php",
    method: "POST",
    data: {
      firstName: firstName,
      lastName: lastName,
      email: email,
      password: password,
      birthDate: birthDate,
      gender: gender,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        $("#message").html(`<div class="alert alert-success" role="alert">
        ${response.message}
      </div>`);
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function login() {
  const email = $("#email").val();
  const password = $("#password").val();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/auth/login.php",
    method: "POST",
    data: {
      email: email,
      password: password,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        $("#message").html(`<div class="alert alert-success" role="alert">
        ${response.message}
      </div>`);
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}
