const BASE_URL = "http://localhost/7pTestTask/backend/api.php";

function debounce(func, delay) {
  let timeoutId;
  return function () {
    const context = this;
    const args = arguments;
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      func.apply(context, args);
    }, delay);
  };
}

const debouncedApplyFilters = debounce(applyFilters, 300); // 300 milliseconds debounce delay


// ##################################################################
// Function to load customers data
// ##################################################################
function loadCustomers() {
  // Show loader
  $('#loader').show();

  $.get(`${BASE_URL}?action=get_all_customers`, function (response) {
    const data = JSON.parse(response);
    const dataHeading = [
      { headingName: "Image" },
      { headingName: "FirstName" },
      { headingName: "LastName" },
      { headingName: "DateOfBirth" },
      { headingName: "Username" },
      { headingName: "CreatedAt" },
      { headingName: "UpdatedAt" },
      { headingName: "Status" },
      { headingName: "Action" },
    ];
    $("#row-thead").html($("#theadTmpl").render(dataHeading));
    $("#tbody").html($("#tbodyTmpl").render(data));
  });

  // Hide loader after 0.5 second
  setTimeout(function () {
    $('#loader').hide();
  }, 500);
}

function addData() {
  $("form")[0].reset();
  $("#modalLabel").text("Add data");
}

// ##################################################################
// Apply filters for retriving the customers data
// ##################################################################
function applyFilters() {
  var sortField = $("#sortField").val();
  var sortOrder = $("#sortOrder").val();
  var perPage = $("#perPage").val();
  var filter = $(".element-search input").val().trim();

  $.get(`${BASE_URL}?action=get_all_customers`, {
    sort: sortField,
    order: sortOrder,
    per_page: perPage,
    filter: filter
  }, function (response) {
    const data = JSON.parse(response);
    const dataHeading = [
      { headingName: "Image" },
      { headingName: "FirstName" },
      { headingName: "LastName" },
      { headingName: "DateOfBirth" },
      { headingName: "Username" },
      { headingName: "CreatedAt" },
      { headingName: "UpdatedAt" },
      { headingName: "Status" },
      { headingName: "Action" },
    ];
    Object.keys(data[0]).map((key) => ({ headingName: key }));
    $("#row-thead").html($("#theadTmpl").render(dataHeading));
    $("#tbody").html($("#tbodyTmpl").render(data));
  });
}


// ##################################################################
// Update Customer
// ##################################################################
function updateCustomer(formData) {
  $.ajax({
    url: `${BASE_URL}?action=update_customer`,
    type: "PUT",
    data: formData,
    success: function (response) {
      alert(response.message);
      loadCustomers();
    },
    dataType: "json",
  });

  $('#modalForm').modal('hide');
};

// ##################################################################
// edit from popup
// ##################################################################
function editRow(id) {
  $('#modalForm').modal('show');
  $('input[name$="ID"]').val(id);
  $('input[name$="FirstName"]').val($(`.row-${id} .col .row-FirstName`).text());
  $('input[name$="LastName"]').val($(`.row-${id} .col .row-LastName`).text());
  $('input[name$="Username"]').val($(`.row-${id} .col .row-Username`).text());
  $('input[name$="Password"]').val($(`.row-${id} .col .row-Username`).text());
  $("#datepicker").datepicker("setDate", $(`.row-${id} .col .row-DateOfBirth`).text());
  $('#modalLabel').text('Edit data');
}

// ##################################################################
// Delete Customer
// ##################################################################
function deleteCustomer(id) {
  $.ajax({
    url: `${BASE_URL}?action=delete_customer`,
    type: "DELETE",
    data: { id: id },
    success: function (response) {
      alert(response.message);
      loadCustomers();
    },
    dataType: "json",
  });
}

// ##################################################################
// Handle event
// ##################################################################
$(function () {

  // Load customers when the page is loaded
  loadCustomers();

  $("#datepicker").datepicker({
    autoclose: true,
    todayHighlight: true
  }).datepicker('update', new Date());

  $(".element-search input").on("keyup", function () {
    debouncedApplyFilters();
  });

  // Add Customer
  $("#dataForm").submit(function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    const id = $('input[name$="ID"]').val();
    if (id) {
      return updateCustomer(formData);
    }

    $.post(
      `${BASE_URL}?action=add_customer`,
      formData,
      function (response) {
        alert(response.message);
        loadCustomers();
      },
      "json"
    );

    $('#modalForm').modal('hide');
  });

  $("#tbody").on("click", ".btn-edit", function () {
    const id = $(this).closest(".row").attr("id");
    editRow(id);
  });

  $("#tbody").on("click", ".btn-delete", function () {
    const id = $(this).closest(".row").attr("id");
    if (confirm("Are you sure you want to delete this customer?")) {
      deleteCustomer(id);
    }
  });
});
