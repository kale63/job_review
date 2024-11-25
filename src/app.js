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

    document.getElementById("cancel").style.display = "block";
    document.getElementById("confirm").style.display = "block";

    document.getElementById("upload").style.display = "none";
}

var userImage = document.getElementById('edit-pic').src;
document.getElementById("cancel").onclick = function() {
    document.getElementById("edit-pic").src = userImage;

    document.getElementById("cancel").style.display = "none";
    document.getElementById("confirm").style.display = "none";

    document.getElementById("upload").style.display = "block";
}

