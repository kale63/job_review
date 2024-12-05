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
    
    $(document).ready(function() {
        // Al hacer clic en el icono de filtro, mostrar u ocultar la lista de checkboxes
        $('#filter-icon').click(function() {
            $('#checkboxList').toggle(); // Cambia el estado de visibilidad
        });
    });
    
    $('.checkbox').on('change', function() {
        listarPostsInicio();  
    });

    $('#error-login').hide();
//let stars = document.getElementsByClassName("star-rating");
let stars = $(".star-rating");
//let output = document.getElementById("output");
let rating;
let sumGrades;
let average = 0;
let sumPosts;
let postBookmarked;

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
getUser(currentuser);

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
    listarPostsGuardados();
    listarPostsInicio();
    listarPostsPerfil();

    $('#login-form').submit(function(e){
        e.preventDefault();
        $('#error-login').hide();

        let email = $('#email').val();
        let password = $('#password').val();

        if (!email || !password) {
            alert('Completa todos los campos');
            return;
        }
        
        $.post(
            '../../backend/user-login.php',
            {email, password},
            function(response){
                let respuesta = JSON.parse(response);
                if (respuesta.status === 'success') {
                    window.location.href = 'index.php';
                    console.log(respuesta);
                } else {
                    $('#error-login').show();
                    $('#email').val(email);
                }
            }
        );
    });

    $('#signup-form').submit(function(e){
        e.preventDefault();

        signupJSON = {
            username: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            confirm: $('#password-confirm').val()
        };

        let errores = validarRegistro(signupJSON);

        // Mostrar errores
        if (errores.length > 0) {
            alert(errores.join('\n'));
            return; // Detener el envío del formulario si hay errores
        }
        JsonString = JSON.stringify(signupJSON,null,2);
        console.log(JsonString);
        $.post('../../backend/user-signup.php', JsonString, function(response) {
            let respuesta = JSON.parse(response);
            console.log(respuesta.message);
            if(respuesta.status === 'success'){
                window.location.href = '../../src/screens/signup-success.html';
                console.log(respuesta);
            }else{
                alert(respuesta.message);
            }
        });

    });

    $('#search-icon').keyup(function(e){
        if($('#search-icon').val()){
            let selectedGrades = [];
            $('.checkbox:checked').each(function() {
                let grade = $(this).parent().text().trim().length;
                selectedGrades.push(grade);
            });
            let search = $('#search-icon').val();
            $.ajax({
                url: '../../backend/post-search.php',
                type: 'GET',
                //data: {search: search} es lo mismo que
                data: { search },
                success: function(response){
                    let posts = JSON.parse(response);
                    let template = '';
                    let iconClass;
                    let iconElement;
                    //let template_bar = '';
                    posts.forEach(post => {
                        if(postBookmarked.includes(post.id)){
                            iconClass = 'bookmark-checked';
                            iconElement = '<i class="fa-solid fa-bookmark"></i>'
                        }else{
                            iconClass = 'bookmark-empty';
                            iconElement = '<i class="fa-regular fa-bookmark"></i>';
                        }
                        let postGrade = parseInt(post.grade);
                        if (selectedGrades.includes(postGrade)) {
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
                                            <div class="${iconClass}">
                                                ${iconElement}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    });
                    $('#content-post').html(template);
                }
            });
        }else{
            listarPostsInicio();
        }
    });

    function listarPostsInicio() {
        let selectedGrades = [];
        $('.checkbox:checked').each(function() {
            let grade = $(this).parent().text().trim().length;
            selectedGrades.push(grade);
        });
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
                    let iconClass;
                    let iconElement;
                    posts.forEach(post => {
                        if(postBookmarked.includes(post.id)){
                            iconClass = 'bookmark-checked';
                            iconElement = '<i class="fa-solid fa-bookmark"></i>'
                        }else{
                            iconClass = 'bookmark-empty';
                            iconElement = '<i class="fa-regular fa-bookmark"></i>';
                        }
                        console.log(post);
                        let postGrade = parseInt(post.grade);
                        if (selectedGrades.includes(postGrade)) {
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
                                            <div class="${iconClass}">
                                                ${iconElement}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    sumGrades += postGrade;
                    sumPosts++;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "posts"
                    $('#content-post').html(template);
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
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "posts"
                    $('#my-posts').html(template);
                }
            }
        });
    }

    function listarPostsGuardados() {
        postBookmarked = [];
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
                        postBookmarked.push(post.id);
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
                                        <div class="bookmark-checked">
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "posts"
                    $('#my-bookposts').html(template);
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
        
        var errores = validarPost(finalJSON);

        // Mostrar errores
        if (errores.length > 0) {
            alert(errores.join('\n'));
            return; // Detener el envío del formulario si hay errores
        }
        postJsonString = JSON.stringify(finalJSON,null,2);
        console.log(postJsonString);
        let url = edit === false ? '../../backend/post-add.php' : '../../backend/post-edit.php';
        $.post(url, postJsonString, function(response) {
            let respuesta = JSON.parse(response);
            console.log(respuesta.message);
            if(respuesta.status === 'success'){
                //listarposts();
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
                element.remove();
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
                form.action = 'http://penguin.linux.test/proyecto-tecweb/job_review/src/screens/post-something.php';
                //form.action = '../../backend/post-something.php';  

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
                listarPostsGuardados();
                element.find('.bookmark').removeClass('bookmark-empty').addClass('bookmark-checked')
                .html('<i class="fa-solid fa-bookmark"></i>');
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
            $.post('../../backend/bookmarked-delete.php', finalJSON, (response) => {
                //$('#my-posts').hide();
                listarPostsGuardados();
                element.find('.bookmark').removeClass('bookmark-checked').addClass('bookmark-empty').html('<i class="fa-regular fa-bookmark"></i>');
                console.log(response);
            });
        }
    });

    function getUser(userId){
        $.ajax({
            url: '../../backend/user-get.php',
            data: { userId: userId },
            method: 'POST',
            success: function(response) {
                console.log(response);
                let user = JSON.parse(response);
                    // Actualizar imagen de perfil, nombre y biografía
                    $('#profilePic').attr('src', '../img/' + user.image);
                    $('#username').text(user.username);
                    $('#bio').text(user.info);
    
                    // Prellenar el formulario de edición con los datos actuales
                    $('#edit-pic').attr('src', '../img/' + user.image);
                    $('#bio-edit').val(user.info);
            }
        });
    }

    // Enviar cambios de perfil
    $('#editProfileForm').submit(function(e) {
        e.preventDefault();  // Evitar el envío por defecto del formulario
        var formData = new FormData();
        var file = $('#fileImg')[0].files[0];
        if (file) {
            formData.append('file', file);
        }
        var desc = $('#bio-edit').val();
        if (desc) {
            formData.append('bio', desc);
        }
        formData.append('id', currentuser);
        console.log("id: " + formData.get('id'));  // Muestra el ID
        console.log("bio: " + formData.get('bio'));  // Muestra la bio
        console.log("image: " + (file ? file.name : "No se ha seleccionado imagen"));
        $.ajax({
            url: '../../backend/user-set.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                console.log(response);
                getUser(currentuser);
            }
        });
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
            $('#rating').text(average.toFixed(2)+"/5");
        }
    }
});

function validarPost(post) {
    
    var errores = [];

    // Validación de title
    if (!post.title) {
        errores.push('El título es requerido.');
    }

    if(post.title.length > 100){
        errores.push('El título no debe exceder los 100 caracteres.');
    }

    // Validación de company
    if (!post.company) {
        errores.push('El nombre de la empresa es requerido.');
    }

    if(post.company.length > 100){
        errores.push('El nombre de la empresa no debe exceder los 100 caracteres.');
    }

    // Validación de la descripción
    if(post.description.length > 250){
        errores.push('La descripción no debe exceder los 250 caracteres.');
    }

    return errores;
}

function validarRegistro(usuario) {
    var errores = [];

    // Validación de username
    if (!usuario.username || usuario.username.trim() === "") {
        errores.push('El nombre de usuario es obligatorio.');
    }

    // Validación de email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!usuario.email || !emailRegex.test(usuario.email)) {
        errores.push('Se necesita un email válido.');
    }

    // Validación de password
    if (usuario.password.length < 8) {
        errores.push('La contraseña debe ser de al menos 8 caracteres.');
    }

    if (!/[a-z]/i.test(usuario.password)) {
        errores.push('La contraseña debe incluir al menos una letra.');
    }

    if (!/[0-9]/.test(usuario.password)) {
        errores.push('La contraseña debe incluir al menos un número.');
    }

    // Validación de password-confirm
    if (usuario.password !== usuario.confirm) {
        errores.push('Las contraseñas deben coincidir.');
    }

    return errores;
}
