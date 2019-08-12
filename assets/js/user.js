// $(document).ready( function () {
//     $('#myTable').DataTable();
// } );
toastr.options.progressBar = true;
$(document).ready( function () {
   var SSPEnable = true
    var opt = {
        processing: true,
        serverSide: true,
        ajax:{
        url:'users-all',
        type:'POST',
        dataType: 'JSON',
        beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization');
    }
    },
    columns:[
        {data: 'id' , name: 'id',"visible": true,orderable: true},
        // {data: 'image' , name: 'image'},
        {data: 'name' , name: 'name'},
        {data: 'email' , name: 'email'},
        // {data: 'email' , name: 'email'},
        // {data: 'lease_amount' , name: 'lease_amount'},
        // {data: 'approve' , name: 'approve'},
        // {data: 'created_at' , name: 'created_at'},
        // {data: "response",orderable: false, searchable: false},
        // {data: "close",name: 'close'},
        {data: "action",orderable: false, searchable: false},

    ],
    }

    $(function () {
      datatabel = $('#myTable').DataTable(opt);
      // alert(1);
    });

} );

$(document).on("click", ".btn-info", function(){
  
  var id = $(this).data("id");
  $.ajax({
             url: 'user/'+id,
             data: {id:id},
             type: 'GET',
             datatype: 'JSON',
             success: function (response) {
             	$('#exampleModal').modal('show');
             	console.log(response);
             	// $('#tags_edit').tagsinput('add', 'some tag');
             	$('#name').val(response.name);
             	$('#email').val(response.email);
             	$('#id').val(response.id);

             	// $("#editformcontent").val(response);
             	// for (var i = response.posttags.length - 1; i >= 0; i--) {
             		
             	// 	$('#tags_edit').tagsinput('add', response.posttags[i].tags.name);
             	// }
             	
             	// $('.tags').tagsinput('add', 'hello');
             	// location.reload();
             },
             error: function (response) {

             }
         });
});

function submitUserEditForm() {
	var id = $("#id").val();
	var name = $("#name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var confirm_password = $("#confirm_password").val();

	 

	$.ajax({
             url: 'user/'+id,
             data: {id:id,name:name,email:email,password:password,confirm_password:confirm_password},
             type: 'PUT',
             datatype: 'JSON',
             success: function (response) {
             	$('#exampleModal').modal('hide');
             	toastr["success"](response.msg);
             	$('#myTable').DataTable().ajax.reload();
             	// $('#myModal').modal('show');
             	// location.reload();
             },
             error: function (response) {
             	console.log(response.responseJSON);
             		   $.each(response.responseJSON, function(key,value) {
     				toastr["error"](value);
 }); 
             }
         });
}

function deleteUser(id) {
	$.ajax({
             url: 'user/'+id,
             data: {id:id},
             type: 'DELETE',
             datatype: 'JSON',
             success: function (response) {
             	$('#exampleModal').modal('hide');
             	// $('#myModal').modal('show');
             	location.reload();
             },
             error: function (response) {

             }
         });
}


$('#exampleModal').on('hidden.bs.modal', function () {
    $('#usereditform').trigger("reset");
});