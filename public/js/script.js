$(document).ready(function(){
  $( "#addButton" ).click(function() {
    $( "#create" ).toggle( "fold", 500 );
  });

  $("#create").hide();

  $('#content').on('click', '#deleteButton', function(){
    item = $(this).data('item');
    message = "Delete item № " + item + "?";

    $('<div></div>').html( message ).dialog({
      title: 'Delete',
      resizable: false,
      modal: true,
      buttons: {
        'Ok': function()  {
          $( this ).dialog( 'close' );
        }
      }
    });
  });

  axios.get('/items')
      .then(function (response) {
        let result = "";
        let items = response.data.items;

        items.forEach(function (item) {
          body = "<td>" + item.id + "</td>";
          body += "<td>" + item.name+ "</td>";
          body += "<td>" +item.secondname + "</td>";
          body += "<td>" + item.patr + "</td>";
          body += "<td>" + item.birthday +"</td>";
          body += "<td><button id=\"deleteButton\" data-item="+item.id +">DELETE</button></td>";

          result = "<tr>" + body + "</tr>";
          $("table").append(result);
        });
      })
      .catch(function (error) {
        console.log(error);
      });
});
