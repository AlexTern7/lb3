window.onload = () => {
    const group = document.getElementById("group");
    const auditorium = document.getElementById("auditorium");
    const teacher = document.getElementById("teacher");

    group.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisGroup = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "Lesson.php");
        xhr.responseType = 'text';
        xhr.send(thisGroup);

        xhr.onload = () => {
            document.getElementById("content").innerHTML = xhr.responseText;
        }
    })

    teacher.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisTeacher = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "Lesson.php");
        xhr.responseType = 'json';
        xhr.send(thisTeacher);

        xhr.onload = () => {
            document.getElementById("content").innerHTML = xhr.response;
        }
    })

    auditorium.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisAuditorium = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "Lesson.php");
        xhr.responseType = 'document';
        xhr.send(thisAuditorium);

        xhr.onload = () => {
            document.getElementById("content").innerHTML = xhr.responseXML.body.innerHTML;
        }
    })
}


