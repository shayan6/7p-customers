const BASE_URL = "http://localhost/7pTestTask/backend/api.php";

// datepicker and search bar top
$(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
  
  $(".element-search input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".tbody .row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  // Handle events 
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
    Object.keys(data[0]).map((key) => ({ headingName: key }));
    $("#row-thead").html($("#theadTmpl").render(dataHeading));
    $("#tbody").html($("#tbodyTmpl").render(data));
  });
});

// edit from popup
function editRow(id) {
  $('#modalForm').modal('show');
  $('input[name$="FirstName"]').val( $(`${id} .col .row-FirstName`).text() );
  $('input[name$="LastName"]').val( $(`${id} .col .row-LastName`).text() );
  $('input[name$="Username"]').val( $(`${id} .col .row-Username`).text() );
  $("#datepicker").datepicker("setDate", $(`${id} .col .row-DateOfBirth`).text());
}

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


// // edit row wise
// function editRow(id) {
//   $(`${id} .col p`).each(function() {
//     $( this ).html(`<input type='text' class="form-control" value='${$(this).text().trim()}'/>`);
//   });
//   $(`${id} .col .btn-edit`).attr( 'class', 'btn btn-sm btn-success btn-save').attr( 'onclick', `saveRow('${id}')`).html( '<i class="fa fa-check"></i>');
// }

// function saveRow(id) {
//   $(`${id} .col p`).each(function() {
//     $( this ).html(`${$(this).find('input').val()}`);
//   });
//   $(`${id} .col .btn-save`).attr( 'class', 'btn btn-sm btn-warning btn-edit').attr( 'onclick', `editRow('${id}')`).html( '<i class="fa fa-pencil-square-o"></i>');
// }
