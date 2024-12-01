// uploading images
/*document.getElementById("fileImg").onchange = function() {
    document.getElementById("edit-pic").src = URL.createObjectURL(fileImg.files[0]);

    document.getElementById("cancel").style.visibility = "visible";
    document.getElementById("confirm").style.visibility = "visible";

    document.getElementById("upload").style.visibility = "hidden";
}

var userImage = document.getElementById('edit-pic').src;
document.getElementById("cancel").onclick = function() {
    document.getElementById("edit-pic").src = userImage;

    document.getElementById("cancel").style.visibility = "hidden";
    document.getElementById("confirm").style.visibility = "hidden";

    document.getElementById("upload").style.visibility = "visible";
}

//eidtar post

function editPost(postId) {
    window.location.href = `edit-post.php?post_id=${postId}`;
}

//borrar post

function confirmDelete(postId) {
    const confirmation = confirm("¿Estás seguro de que deseas eliminar esta publicación?");
    
    if (confirmation) {
        fetch(`delete-post.php`, { //o como se llame
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `post_id=${postId}`
        })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                alert("Error al eliminar la publicación.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Hubo un problema al intentar eliminar la publicación.");
        });
    }
}*/

$(document).ready(function(){

    // Active search bar
    /*$('#search-icon').on('click', function () {
        $('#search-bar').show();
        $('#search-icon').hide();
    });*/

    // Not bookmarked post
    $('#bookmark-empty').on('click', function () {
        $('#bookmark-checked').show();
        $('#bookmark-empty').hide();
    });

    // Bookmarked post
    $('#bookmark-checked').on('click', function () {
        $('#bookmark-empty').show();
        $('#bookmark-checked').hide();
    });
    

    // Star rating function for rating in posting page

//let stars = document.getElementsByClassName("star-rating");
let stars = $(".star-rating");
//let output = document.getElementById("output");
let rating;
let sumGrades;
let average = 0;
let sumPosts;

if($('#grade-post').val()){
    rating = $('#grade-post').val();
}else{
    rating = 1;
}

let isthere = $('#postId').val();
let edit;
if(isthere == ''){
    edit = false;
}else{
    edit = true;
}

let currentuser = $('#current-user').data('id-user');
console.log(currentuser);

stars.click(function() {
    var index = $(this).index(); 
    gfg(index);
});

function gfg(n) {
    remove();
    let cls = '';
    for (let i = 0; i < n; i++) {
        if (n == 1) cls = "one";
        else if (n == 2) cls = "two";
        else if (n == 3) cls = "three";
        else if (n == 4) cls = "four";
        else if (n == 5) cls = "five";
        stars[i].className = "star-rating " + cls;
    }

    rating = n;
    //output.innerText = "Rating is: " + rating + "/5";
}

function remove() {
    let i = 0;
    while (i < 5) {
        stars[i].className = "star-rating";
        i++;
    }
}

botonAddEdit();

function botonAddEdit(){
    console.log(edit);
    if(edit){
        $('#add-edit').text('Editar');
    }else{
        $('#add-edit').text('Publicar');
    }
}
// Profile

// uploading images
$('#fileImg').on('change', function() {
    $("#edit-pic").attr("src", URL.createObjectURL(fileImg.files[0]));

    $("#cancel").show();
    $("#confirm").show();

    $("#upload").hide();

});


var userImage = $('#edit-pic').attr('src');

$('#cancel').click(function() {
    $('#edit-pic').attr('src', userImage);
    $('#cancel, #confirm').hide();
    $('#upload').show();
});
    listarPostsInicio();
    listarPostsPerfil();
    listarPostsGuardados();

    $('#search-icon').keyup(function(e){
        if($('#search-icon').val()){
            let search = $('#search-icon').val();
            $.ajax({
                url: '../../backend/post-search.php',
                type: 'GET',
                //data: {search: search} es lo mismo que
                data: { search },
                success: function(response){
                    let posts = JSON.parse(response);
                    let template = '';
                    //let template_bar = '';
                    posts.forEach(post => {
                        template += `
                        <div id="${post.id}"class="card bg-secondary mb-3" style="max-width: 31%;">
                            <div class="card-header ">
                                <h4 class="card-title">${post.title}</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-top d-flex flex-row w-100 justify-content-around">
                                    <h3>${post.grade}/5</h3>   
                                    <p>${post.company}</p>
                                </div>
                                <p class="card-text">${post.description}</p>
                                <div class="bookmark justify-content-end w-100">
                                    <div class="bookmark-empty">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </div>
                                    <div class="bookmark-checked">
                                        <i class="fa-solid fa-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    });
                    $('#content-post').html(template);
                }
            });
        }else{
            listarPostsInicio();
        }
    });

    function listarPostsInicio() {
        $.ajax({
            url: '../../backend/post-list.php',
            type: 'GET',
            success: function(response) {
                console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const posts = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(posts).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';
                    sumGrades = 0;
                    sumPosts = 0;

                    posts.forEach(post => {
                        console.log(post);
                        template += `
                        <div post-id="${post.id}"class="card bg-secondary mb-3" style="max-width: 31%;">
                            <div class="card-header ">
                                <h4 class="card-title">${post.title}</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-top d-flex flex-row w-100 justify-content-around">
                                    <h3>${post.grade}/5</h3>   
                                    <p>${post.company}</p>
                                </div>
                                <p class="card-text">${post.description}</p>
                                <div class="bookmark justify-content-end w-100">
                                    <div class="bookmark-empty">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </div>
                                    <div class="bookmark-checked">
                                        <i class="fa-solid fa-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    sumGrades += parseInt(post.grade);
                    sumPosts++;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#content-post').html(template);
                    $('.bookmark-checked').hide();
                    aveGrade();
                }
            }
        });
    }

    function listarPostsPerfil() {
        $.ajax({
            url: '../../backend/post-listsingle.php',
            data: {currentuser},
            type: 'POST',
            success: function(response) {
                console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const posts = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(posts).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    posts.forEach(post => {
                        template += `
                            <div post-id="${post.id}" class="card border-light-subtle bg-dark-subtle mb-3" style="max-width: 48%;">
                                <div class="card-header ">
                                    <h4 class="card-title">${post.title}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-top d-flex flex-row w-100 justify-content-around">
                                        <h3>${post.grade}/5</h3>   
                                        <p>${post.company}</p>
                                    </div>
                                    <p class="card-text">${post.description}</p>
                                    <div class="posts-btn-div d-flex flex-row justify-content-around w-100">
                                        <div class="edit">
                                            <button class="btn edit-btn btn-outline-secondary">Editar</button>
                                        </div>
                                        <div class="delete">
                                            <button class="btn delete-btn btn-outline-secondary">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#my-posts').html(template);
                }
            }
        });
    }

    function listarPostsGuardados() {
        $.ajax({
            url: '../../backend/post-listbook.php',
            data: {currentuser},
            type: 'POST',
            success: function(response) {
                console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const posts = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(posts).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    posts.forEach(post => {
                        template += `
                            <div post-id="${post.id}" class="card border-light-subtle bg-dark-subtle mb-3" style="max-width: 48%;">
                                <div class="card-header ">
                                    <h4 class="card-title">${post.title}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-top d-flex flex-row w-100 justify-content-around">
                                        <h3>${post.grade}/5</h3>   
                                        <p>${post.company}</p>
                                    </div>
                                    <p class="card-text">${post.description}</p>
                                    <div class="bookmark justify-content-end w-100">
                                        <div class="bookmark-empty">
                                            <i class="fa-regular fa-bookmark"></i>
                                        </div>
                                        <div class="bookmark-checked">
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#my-bookposts').html(template);
                    $('.bookmark-empty').hide();
                }
            }
        });
    }

    $(document).on('click', '#publicar', (e)=>{
        edit = false;
        botonAddEdit();
    });

    $('#post-form').submit(function(e){
        e.preventDefault();
        console.log(edit);
        let finalJSON = 
            {   
                id: $('#postId').val(),
                title: $('#title').val(),
                user: currentuser,
                company: $('#company').val(),
                grade: rating,
                description: $('#description').val()
            };
        
        var errores = validarProducto(finalJSON);

        // Mostrar errores
        if (errores.length > 0) {
            alert(errores.join('\n'));
            return; // Detener el envío del formulario si hay errores
        }
        productoJsonString = JSON.stringify(finalJSON,null,2);
        console.log(productoJsonString);
        let url = edit === false ? '../../backend/post-add.php' : '../../backend/post-edit.php';
        $.post(url, productoJsonString, function(response) {
            let respuesta = JSON.parse(response);
            console.log(respuesta.message);
            if(respuesta.status === 'success'){
                //listarProductos();
                $('#post-form').trigger('reset');
                edit = false;
                botonAddEdit();
                alert(respuesta.message);
            }
        });
    });

    $(document).on('click', '.delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el post?')) {
            const element = $(e.currentTarget).closest('.card'); 
            const id = $(element).attr('post-id');
            $.post('../../backend/post-delete.php', {id}, (response) => {
                //$('#my-posts').hide();
                listarPostsPerfil();
            });
        }
    });
    
    $(document).on('click', '.edit', (e) => {
        e.preventDefault();
        const element = $(e.currentTarget).closest('.card'); 
        const id = $(element).attr('post-id');
        edit = true;
        botonAddEdit();
        $.post('../../backend/post-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let post = JSON.parse(response);
            var form = document.createElement("form");

				var idIn = document.createElement("input");
				idIn.type = 'hidden';
				idIn.name = 'id';
				idIn.value = post.id;
				form.appendChild(idIn);

                var titleIn = document.createElement("input");
                titleIn.type = 'text';
                titleIn.name = 'title';
                titleIn.value = post.title;
                form.appendChild(titleIn);

				var companyIn = document.createElement("input");
                companyIn.type = 'text';
                companyIn.name = 'company';
                companyIn.value = post.company;
                form.appendChild(companyIn);

                var gradeIn = document.createElement("input");
				gradeIn.type = 'hidden';
				gradeIn.name = 'grade';
				gradeIn.value = post.grade;
				form.appendChild(gradeIn);

				var descIn = document.createElement("input");
                descIn.type = 'text';
                descIn.name = 'description';
                descIn.value = post.description;
                form.appendChild(descIn);	

                form.method = 'POST';
                //form.action = 'http://penguin.linux.test/proyecto-tecweb/job_review/src/screens/post-something.php';
                form.action = '../../backend/post-something.php';  

                document.body.appendChild(form);
                form.submit();

        });
        console.log(edit);
    }); 
    
    $(document).on('click', '.bookmark-empty', (e) => {
        if(confirm('¿Deseas guardar el post?')) {
            const element = $(e.currentTarget).closest('.card'); 
            let DataJSON = 
            {   
                user: currentuser,
                post: parseInt(element.attr('post-id'))
            };
            console.log(DataJSON);
            let finalJSON = JSON.stringify(DataJSON,null,2);
            console.log(finalJSON);
            $.post('../../backend/bookmarked-add.php', finalJSON, (response) => {
                //$('#my-posts').hide();
                element.find('.bookmark-checked').show();
                element.find('.bookmark-empty').hide();
                listarPostsGuardados();
                console.log(response);
            });
        }
    });

    $(document).on('click', '.bookmark-checked', (e) => {
        if(confirm('¿Deseas dejar de guardar el post?')) {
            const element = $(e.currentTarget).closest('.card'); 
            let DataJSON = 
            {   
                user: currentuser,
                post: parseInt(element.attr('post-id'))
            };
            let finalJSON = JSON.stringify(DataJSON,null,2);
            $.post('../../backend/bookmarked-delete.php', {finalJSON}, (response) => {
                //$('#my-posts').hide();
                listarPostsGuardados();
                console.log(response);
            });
        }
    });

    function aveGrade(){
        console.log(sumPosts);
        console.log(sumGrades);
        if(sumPosts > 0){
            average = sumGrades / sumPosts;
            console.log(average);
            let rounded = Math.round(average);
            let cls = '';
            starAverage = '';
            for(let i = 0; i < 5; i++){
                if(i < rounded){
                    if (rounded == 1) cls = "one";
                    else if (rounded == 2) cls = "two";
                    else if (rounded == 3) cls = "three";
                    else if (rounded == 4) cls = "four";
                    else if (rounded == 5) cls = "five";
                    starAverage += "<span class='star-rating " + cls + "'>★</span>";
                }else{
                    starAverage += "<span class='star-rating'>★</span>";
                }
            }
            $('#rating-average').html(starAverage);
            $('#rating').text(average+"/5");
        }
    }
});

function validarProducto(producto) {
    
    var errores = [];

    // Validación de title
    if (!producto.title) {
        errores.push('El título es requerido.');
    }

    if(producto.title.length > 100){
        errores.push('El título no debe exceder los 100 caracteres.');
    }

    // Validación de company
    if (!producto.company) {
        errores.push('El nombre de la empresa es requerido.');
    }

    if(producto.company.length > 100){
        errores.push('El nombre de la empresa no debe exceder los 100 caracteres.');
    }

    // Validación de la descripción
    if(producto.description.length > 250){
        errores.push('La descripción no debe exceder los 250 caracteres.');
    }

    return errores;
}

