const startLoading = () => {
  $("#loader").css("display", "flex");
};

const stopLoading = () => {
  $("#loader").css("display", "none");
};

function register() {
  const firstName = $("#firstName").val();
  const lastName = $("#lastName").val();
  const email = $("#email").val();
  const password = $("#password").val();
  const birthDate = $("#birthDate").val();
  const gender = $("#gender").val();

  startLoading();

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
      stopLoading();
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

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/auth/login.php",
    method: "POST",
    data: {
      email: email,
      password: password,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        if (response.user.role === "admin")
          window.location.href = "/cars-comparer-2cs-project/admin/";
        else window.location.href = "/cars-comparer-2cs-project/";
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function logout() {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/auth/logout.php",
    method: "GET",
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.href = "/cars-comparer-2cs-project/auth/login";
      }
    },
  });
}

function createBrand() {
  const dataForm = new FormData();

  const name = $("#name").val();
  const description = $("#description").val();
  const logoImage = $("#logoImage")[0].files[0];
  const websiteURL = $("#websiteURL").val();
  const yearFounded = $("#yearFounded").val();
  const countryOfOrigin = $("#countryOfOrigin").val();

  dataForm.append("name", name);
  dataForm.append("description", description);
  dataForm.append("logoImage", logoImage);
  dataForm.append("websiteURL", websiteURL);
  dataForm.append("yearFounded", yearFounded);
  dataForm.append("countryOfOrigin", countryOfOrigin);

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/brands/create.php",
    method: "POST",
    data: dataForm,
    contentType: false,
    processData: false,
    success: function (response) {
      stopLoading();
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
