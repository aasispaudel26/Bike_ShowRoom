function registration() {
    var Name = document.getElementById("Name").value;
    var Address = document.getElementById("Address").value;
    var phoneNumber = document.getElementById("phoneNumber").value;
    var Email = document.getElementById("Email").value;
    var userName = document.getElementById("userName").value;
    var Password = document.getElementById("Password").value;

    if (userName && Password) {
        let users = JSON.parse(localStorage.getItem("users")) || [];
        let existingUser = users.find(user => user.userName === userName);

        if (existingUser) {
            document.getElementById("error").innerText = "User already exists";
        } else {
            let user = {
                Name: Name,
                Address: Address,
                phoneNumber: phoneNumber,
                Email: Email,
                username: userName,
                Password: Password,
            };
            users.push(user);
            localStorage.setItem("users", JSON.stringify(users));
            window.location.href = "login.html";
            alert("Registration successfull");
        }
    }

}

function login() {
    let username = document.getElementById("userName").value;
    let password = document.getElementById("Password").value;

    if (username && password) {
        let users = JSON.parse(localStorage.getItem("users")) || [];
        let authuser = users.find(user => user.username === username && user.password === password);

        if (authuser) {
            localStorage.setItem("isLoggedIn", true);
            window.location.replace("seller.html");

        }
        else {
            document.getElementById("error").innerText = "Invalid login";
            // console.log("Invalid login");
        }

    } else {
        document.getElementById("error").innerText = "fill all details";
        // console.log("Fill all details");

        // window.alert("hello");

    }

}