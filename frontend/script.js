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
});

// edit from popup
function editRow(id) {
  $('#modalForm').modal('show');
  $('input[name$="name"]').val( $(`${id} .col .row-name`).text() );
  $('input[name$="image"]').val( $(`${id} .col .row-profile`).attr('src') );
  $("#datepicker").datepicker("setDate", $(`${id} .col .row-date`).text());
  $('input[name$="category"]').val( $(`${id} .col .row-category`).text() );
  $('input[name$="quantity"]').val( $(`${id} .col .row-quantity`).text() );
  $('select[name$="unit"]').val( $(`${id} .col .row-unit`).text() );
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
