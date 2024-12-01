// Star rating function for rating in posting page

let stars = document.getElementsByClassName("star-rating");
//let output = document.getElementById("output");
let rating = 1;

function gfg(n) {
    remove();
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

// Profile

// uploading images
document.getElementById("fileImg").onchange = function() {
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
}



