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
  const username = $("#username").val();

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/auth/register.php",
    method: "POST",

    data: {
      username: username,
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
  const username = $("#username").val();
  const password = $("#password").val();

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/auth/login.php",
    method: "POST",

    data: {
      username: username,
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
        window.location.reload();
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

function editBrand(brandId) {
  const dataForm = new FormData();

  const name = $("#name").val();
  const description = $("#description").val();
  const logoImage = $("#logoImage")[0].files[0];
  const websiteURL = $("#websiteURL").val();
  const yearFounded = $("#yearFounded").val();
  const countryOfOrigin = $("#countryOfOrigin").val();

  dataForm.append("id", brandId);
  dataForm.append("name", name);
  dataForm.append("description", description);
  dataForm.append("logoImage", logoImage);
  dataForm.append("websiteURL", websiteURL);
  dataForm.append("yearFounded", yearFounded);
  dataForm.append("countryOfOrigin", countryOfOrigin);

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/brands/edit.php",
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

function deleteBrand(id) {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/brands/delete.php",
    method: "POST",

    data: {
      id: id,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      }
    },
  });
}

function createVehicle() {
  const dataForm = new FormData();

  const brandId = $("#brand").val();
  const model = $("#model").val();
  const year = $("#year").val();
  const image = $("#Image")[0].files[0];
  const description = $("#description").val();
  const engine = $("#engine").val();
  const speed = $("#speed").val();
  const height = $("#height").val();
  const width = $("#width").val();
  const length = $("#length").val();
  const consumption = $("#consumption").val();
  const fuel_type = $("#fuel_type").val();
  const version = $("#version").val();
  const pricing_range_from = $("#pricing_range_from").val();
  const pricing_range_to = $("#pricing_range_to").val();
  const acceleration = $("#acceleration").val();

  dataForm.append("brand_id", brandId);
  dataForm.append("model", model);
  dataForm.append("year", year);
  dataForm.append("Image", image);
  dataForm.append("description", description);
  dataForm.append("engine", engine);
  dataForm.append("speed", speed);
  dataForm.append("height", height);
  dataForm.append("width", width);
  dataForm.append("length", length);
  dataForm.append("consumption", consumption);
  dataForm.append("fuel_type", fuel_type);
  dataForm.append("version", version);
  dataForm.append("pricing_range_from", pricing_range_from);
  dataForm.append("pricing_range_to", pricing_range_to);
  dataForm.append("acceleration", acceleration);

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/create.php",
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

function editVehicle(vehicleId) {
  const dataForm = new FormData();

  const brandId = $("#brand").val();
  const model = $("#model").val();
  const year = $("#year").val();
  const image = $("#Image")[0].files[0];
  const description = $("#description").val();
  const engine = $("#engine").val();
  const speed = $("#speed").val();
  const height = $("#height").val();
  const width = $("#width").val();
  const length = $("#length").val();
  const consumption = $("#consumption").val();
  const fuel_type = $("#fuel_type").val();
  const version = $("#version").val();
  const pricing_range_from = $("#pricing_range_from").val();
  const pricing_range_to = $("#pricing_range_to").val();
  const acceleration = $("#acceleration").val();

  dataForm.append("id", vehicleId);
  dataForm.append("brand_id", brandId);
  dataForm.append("model", model);
  dataForm.append("year", year);
  dataForm.append("Image", image);
  dataForm.append("description", description);
  dataForm.append("engine", engine);
  dataForm.append("speed", speed);
  dataForm.append("height", height);
  dataForm.append("width", width);
  dataForm.append("length", length);
  dataForm.append("consumption", consumption);
  dataForm.append("fuel_type", fuel_type);
  dataForm.append("version", version);
  dataForm.append("pricing_range_from", pricing_range_from);
  dataForm.append("pricing_range_to", pricing_range_to);
  dataForm.append("acceleration", acceleration);

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/edit.php",
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

function deleteVehicle(id) {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/delete.php",
    method: "POST",

    data: {
      id: id,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      }
    },
  });
}

function acceptUser(id) {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/users/accept.php",
    method: "POST",

    data: {
      id: id,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function rejectUser(id) {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/users/reject.php",
    method: "POST",

    data: {
      id: id,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function blockUser(id) {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/users/block.php",
    method: "POST",

    data: {
      id: id,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function activateUser(id) {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/users/activate.php",
    method: "POST",

    data: {
      id: id,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function onBrandChange(formIndex) {
  const brandId = $(`#brand-${formIndex}`).val();

  $(`#version-${formIndex}`).html(`<option value="">Select Version</option>`);
  $(`#version-${formIndex}`).attr("disabled", "disabled");

  $(`#vehicle-${formIndex}`).html(`<option value="">Select Year</option>`);
  $(`#vehicle-${formIndex}`).attr("disabled", "disabled");

  if (brandId === "") {
    $(`#model-${formIndex}`).html(`<option value="">Select Model</option>`);
    $(`#model-${formIndex}`).attr("disabled", "disabled");

    return;
  }

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/get-vehicles-by-brand.php",
    method: "GET",

    data: {
      brandId: brandId,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        let options = "<option value=''>Select Model</option>";

        const models = new Set();
        response.data.forEach((vehicle) => {
          models.add(vehicle.model);
        });

        models.forEach((model) => {
          options += `<option value="${model}">${model}</option>`;
        });

        $(`#model-${formIndex}`).html(options);

        $(`#model-${formIndex}`).removeAttr("disabled");
      }
    },
  });
}

function onModelChange(formIndex) {
  const brandId = $(`#brand-${formIndex}`).val();

  const model = $(`#model-${formIndex}`).val();

  $(`#vehicle-${formIndex}`).html(`<option value="">Select Year</option>`);
  $(`#vehicle-${formIndex}`).attr("disabled", "disabled");

  if (model === "") {
    $(`#version-${formIndex}`).html(`<option value="">Select Version</option>`);
    $(`#version-${formIndex}`).attr("disabled", "disabled");
    return;
  }

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/get-vehicles-by-brand.php",
    method: "GET",

    data: {
      brandId: brandId,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        let options = "<option value=''>Select Version</option>";

        const versions = new Set();
        response.data.forEach((vehicle) => {
          if (vehicle.model === model) versions.add(vehicle.version);
        });

        versions.forEach((version) => {
          options += `<option value="${version}">${version}</option>`;
        });
        $(`#version-${formIndex}`).html(options);

        $(`#version-${formIndex}`).removeAttr("disabled");
      }
    },
  });
}

function onVersionChange(formIndex) {
  const brandId = $(`#brand-${formIndex}`).val();

  const model = $(`#model-${formIndex}`).val();

  const version = $(`#version-${formIndex}`).val();

  if (version === "") {
    $(`#vehicle-${formIndex}`).html(`<option value="">Select Year</option>`);
    $(`#vehicle-${formIndex}`).attr("disabled", "disabled");
    return;
  }

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/get-vehicles-by-brand.php",
    method: "GET",

    data: {
      brandId: brandId,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        let options = "<option value=''>Select Year</option>";
        response.data.forEach((vehicle) => {
          if (vehicle.model === model && vehicle.version === version) {
            options += `<option value="${vehicle.id}">${vehicle.year}</option>`;
          }
        });
        $(`#vehicle-${formIndex}`).html(options);

        $(`#vehicle-${formIndex}`).removeAttr("disabled");
      }
    },
  });
}

function onCompareClick() {
  const vehicle1 = $("#vehicle-1").val();
  const vehicle2 = $("#vehicle-2").val();
  const vehicle3 = $("#vehicle-3").val();
  const vehicle4 = $("#vehicle-4").val();

  const selectedVehicles = [];

  vehicle1 &&
    selectedVehicles.indexOf(vehicle1) === -1 &&
    selectedVehicles.push(vehicle1);

  vehicle2 &&
    selectedVehicles.indexOf(vehicle2) === -1 &&
    selectedVehicles.push(vehicle2);

  vehicle3 &&
    selectedVehicles.indexOf(vehicle3) === -1 &&
    selectedVehicles.push(vehicle3);

  vehicle4 &&
    selectedVehicles.indexOf(vehicle4) === -1 &&
    selectedVehicles.push(vehicle4);

  if (selectedVehicles.length < 2) {
    $("#message").html(`<div class="alert alert-danger" role="alert">
    Please select at least 2 different vehicles to compare
  </div>`);
    return;
  }

  const url = new URL(
    "/cars-comparer-2cs-project/compare/",
    window.location.href
  );

  selectedVehicles.forEach((vehicleId) => {
    url.searchParams.append("id[]", vehicleId);
  });

  window.location.href = url.href;
}

function onYearChange(formIndex) {
  const vehicleId = $(`#vehicle-${formIndex}`).val();

  // get the vehicle then set the image src
  if (!vehicleId) {
    $(`#vehicle-image-${formIndex}`).attr(
      "src",
      "/cars-comparer-2cs-project/assets/images/vehicle-placeholder.png"
    );
    return;
  }

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/get-by-id.php",
    method: "GET",

    data: {
      id: vehicleId,
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status === 200) {
        $(`#vehicle-image-${formIndex}`).attr(
          "src",
          "/cars-comparer-2cs-project" + response.data.ImageURL
        );
      } else {
        $(`#vehicle-image-${formIndex}`).attr(
          "src",
          "/cars-comparer-2cs-project/assets/images/vehicle-placeholder.png"
        );
      }
    },
  });
}

function createNews() {
  const dataForm = new FormData();

  const title = $("#title").val();
  const description = $("#description").val();
  const image = $("#Image")[0].files[0];

  dataForm.append("title", title);
  dataForm.append("description", description);
  dataForm.append("Image", image);

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/news/create.php",
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

function editNews(newsId) {
  const dataForm = new FormData();

  const title = $("#title").val();
  const description = $("#description").val();
  const image = $("#Image")[0].files[0];

  dataForm.append("id", newsId);
  dataForm.append("title", title);
  dataForm.append("description", description);
  dataForm.append("Image", image);

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/news/edit.php",
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

function deleteNewsById(id) {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/news/delete.php",
    method: "POST",

    data: {
      id: id,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      }
    },
  });
}

function updateStyles() {
  startLoading();

  const dataForm = new FormData();

  const logo = $("#logo")[0].files[0];
  const favicon = $("#favicon")[0].files[0];
  const primaryColor = $("#primaryColor").val();

  dataForm.append("logo", logo);
  dataForm.append("favicon", favicon);
  dataForm.append("primaryColor", primaryColor);

  $.ajax({
    url: "/cars-comparer-2cs-project/api/settings/styles/update.php",
    method: "POST",
    data: dataForm,
    contentType: false,
    processData: false,
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);

      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function updateContact() {
  startLoading();

  const email = $("#email").val();
  const phoneNumber = $("#phone_number").val();
  const address = $("#address").val();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/settings/contact/update.php",
    method: "POST",
    data: {
      email: email,
      phoneNumber: phoneNumber,
      address: address,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);

      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function updateContent() {
  startLoading();

  const title = $("#title").val();
  const description = $("#description").val();
  const buyingGuide = $("#buying_guide").val();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/settings/content/update.php",
    method: "POST",
    data: {
      title: title,
      description: description,
      buyingGuide: buyingGuide,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);

      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function addDiaporama() {
  startLoading();

  const dataForm = new FormData();

  const url = $("#url").val();
  const image = $("#Image")[0].files[0];
  const title = $("#diaporama-title").val();

  dataForm.append("url", url);
  dataForm.append("image", image);
  dataForm.append("title", title);

  $.ajax({
    url: "/cars-comparer-2cs-project/api/settings/diaporama/create.php",
    method: "POST",
    data: dataForm,
    contentType: false,
    processData: false,
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);

      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
          ${response.message}
        </div>`);
      }
    },
  });
}

function deleteDiaporamaItem(id) {
  startLoading();
  $.ajax({
    url: "/cars-comparer-2cs-project/api/settings/diaporama/delete.php",
    method: "POST",

    data: {
      id: id,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) window.location.reload();
    },
  });
}

function addVehicleReview(vehicleId) {
  const review = $("#review").val();
  const rate = $("#rate").val();

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/reviews/create.php",
    method: "POST",
    data: {
      vehicleId: vehicleId,
      review: review,
      rate: rate,
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

function acceptVehicleReview(vehicleId, userId) {
  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/reviews/accept.php",
    method: "POST",
    data: {
      vehicleId: vehicleId,
      userId: userId,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function blockVehicleReview(vehicleId, userId) {
  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/reviews/block.php",
    method: "POST",
    data: {
      vehicleId: vehicleId,
      userId: userId,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function activateVehicleReview(vehicleId, userId) {
  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/vehicles/reviews/activate.php",
    method: "POST",
    data: {
      vehicleId: vehicleId,
      userId: userId,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function addBrandReview(brandId) {
  const review = $("#review").val();
  const rate = $("#rate").val();

  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/brands/reviews/create.php",
    method: "POST",
    data: {
      brandId: brandId,
      review: review,
      rate: rate,
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

function acceptBrandReview(brandId, userId) {
  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/brands/reviews/accept.php",
    method: "POST",
    data: {
      brandId: brandId,
      userId: userId,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function blockBrandReview(brandId, userId) {
  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/brands/reviews/block.php",
    method: "POST",
    data: {
      brandId: brandId,
      userId: userId,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}

function activateBrandReview(brandId, userId) {
  startLoading();

  $.ajax({
    url: "/cars-comparer-2cs-project/api/brands/reviews/activate.php",
    method: "POST",
    data: {
      brandId: brandId,
      userId: userId,
    },
    success: function (response) {
      stopLoading();
      response = JSON.parse(response);
      if (response.status === 200) {
        window.location.reload();
      } else {
        $("#message").html(`<div class="alert alert-danger" role="alert">
        ${response.message}
      </div>`);
      }
    },
  });
}
