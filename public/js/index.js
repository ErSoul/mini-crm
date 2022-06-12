$(document).ready(function(){

    var currentURL = $(location).attr("href");
    var url_route;

    if(currentURL.indexOf('users') > -1) {
        url_route = "users/delete";  
    } else if(currentURL.indexOf('roles') > -1){
        url_route = "roles/delete";
    } else if(currentURL.indexOf('permissions') > -1){
        url_route = "permissions/delete";
    } else if(currentURL.indexOf('flowers') > -1){
        url_route = "flowers/delete";
    } else if(currentURL.indexOf('partners') > -1){
        url_route = "partners/delete";
    } else if(currentURL.indexOf('links') > -1){
        url_route = "links/delete";
    } else if(currentURL.indexOf('guides') > -1){
        url_route = "guides/delete";
    } else if(currentURL.indexOf('partner_discounts') > -1){
        url_route = "partner_discounts/delete";
    } else if(currentURL.indexOf('obituaries') > -1){
        url_route = "obituaries/delete";
    } else if(currentURL.indexOf('mortuaries') > -1){
        url_route = "mortuaries/delete";
    } else if(currentURL.indexOf('condolences') > -1){
        url_route = "condolences/delete";
    } else if(currentURL.indexOf('companies') > -1){
        url_route = "companies/delete";
    } else if(currentURL.indexOf('discounts') > -1){
        url_route = "discounts/delete";
    }

    $('.deleteAll').click(function(){
        var ids = [];

        $("input[type=checkbox]:checked").each(function(){
            ids.push($(this).val());
        }); 

        //Validate is selected rows
        if(ids.length <= 0) {    
            alert("¡Por favor selecciona al menos una columna!");    
        }  else {

            var url = url_route;
            var check_deleted = confirm("¿Seguro que deseas eliminar estos elementos?");   
                
            //Confirm delete rows 
            if(check_deleted == true){ 
                $.ajax({
                    url: url,
                    type: 'POST',                       
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { ids: ids },               
                    success: function (data) {

                        setTimeout(() => {
                            toastr.success(data.message, data.title);
                        },500);

                        $('#kt_datatable_example_1').DataTable().draw();
                    }
                });
            }   
        }
    });
});  