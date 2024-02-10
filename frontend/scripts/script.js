const BASE_URL = "http://localhost/7pTestTask/backend/api.php";

$(function () {

  $("#datepicker").datepicker({
    autoclose: true,
    todayHighlight: true
  }).datepicker('update', new Date());

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

  // Load customers when the page is loaded
  loadCustomers();

  // Add Customer
  $("#modalForm").submit(function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    console.log(formData);
    $.post(
      BASE_URL,
      formData,
      function (response) {
        alert(response.message);
        loadCustomers();
      },
      "json"
    );
  });

  // Update Customer
  $("#updateCustomerForm").submit(function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: BASE_URL,
      type: "PUT",
      data: formData,
      success: function (response) {
        alert(response.message);
        loadCustomers();
      },
      dataType: "json",
    });
  });

  // edit from popup
  function editRow(id) {
    $('#modalForm').modal('show');
    $('input[name$="FirstName"]').val($(`${id} .col .row-FirstName`).text());
    $('input[name$="LastName"]').val($(`${id} .col .row-LastName`).text());
    $('input[name$="Username"]').val($(`${id} .col .row-Username`).text());
    $("#datepicker").datepicker("setDate", $(`${id} .col .row-DateOfBirth`).text());
  }

  // Delete Customer
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

function applyFilters() {
  // Gather selected options
  var sortField = $("#sortField").val();
  var sortOrder = $("#sortOrder").val();
  var perPage = $("#perPage").val();
  var filter = $(".element-search input").val().trim();

  // Send AJAX request to backend API with selected filters
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
