
// $(document).ready(function() {
// 	$('.tags').tagsinput('add', 'hello');
//   });






// submit form
function submitform() {

	 // var formdata = $( "#postform" ).serializeArray();
	 var tags = $("#tags").tagsinput('items');

	 var subject = $("input[name=subject]").val();
	 var description = $("textarea[name=description]").val();

	
	 $.ajax({
             url: 'posts',
             data: {subject:subject,description:description,tags:tags},
             type: 'POST',
             datatype: 'JSON',
             success: function (response) {
             	$('#myModal').modal('show');
             	// location.reload();
             },
             error: function (response) {

             }
         });
}

$('#myModal').on('hidden.bs.modal', function () {
 location.reload();
 // $('#tags_edit').tagsinput('removeAll');

})

$('#exampleModal').on('hidden.bs.modal', function () {
 // location.reload();
 $('#tags_edit').tagsinput('removeAll');

$('#posteditform').trigger("reset");
})


// show for edit the form
function viewforEdit(id) {
	// var id = $(this).attr("data-id");
	 $.ajax({
             url: 'posts/'+id,
             data: {id:id},
             type: 'GET',
             datatype: 'JSON',
             success: function (response) {
             	$('#exampleModal').modal('show');
             	console.log(response);
             	// $('#tags_edit').tagsinput('add', 'some tag');
             	$('#subject_edit').val(response.subject);
             	$('#description_edit').val(response.description);
             	$('#id').val(response.id);

             	$("#editformcontent").val(response);
             	for (var i = response.posttags.length - 1; i >= 0; i--) {
             		
             		$('#tags_edit').tagsinput('add', response.posttags[i].tags.name);
             	}
             	
             	// $('.tags').tagsinput('add', 'hello');
             	// location.reload();
             },
             error: function (response) {

             }
         });
}

function submitEditForm() {
	var tags = $("#tags_edit").tagsinput('items');
	var id = $("#id").val();
	 var subject = $("input[name=subject_edit]").val();
	 var description = $("textarea[name=description_edit]").val();

	$.ajax({
             url: 'posts/'+id,
             data: {id:id,subject:subject,description:description,tags:tags},
             type: 'PUT',
             datatype: 'JSON',
             success: function (response) {
             	$('#exampleModal').modal('hide');
             	$('#myModal').modal('show');
             	// location.reload();
             },
             error: function (response) {

             }
         });
}

function deletePost(id) {
	$.ajax({
             url: 'posts/'+id,
             data: {id:id},
             type: 'DELETE',
             datatype: 'JSON',
             success: function (response) {
             	$('#exampleModal').modal('hide');
             	$('#myModal').modal('show');
             	// location.reload();
             },
             error: function (response) {

             }
         });
}