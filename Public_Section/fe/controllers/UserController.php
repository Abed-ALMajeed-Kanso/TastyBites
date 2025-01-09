<?php
function ScriptLogin_index(){
    // Script responsible for sending login data to be/controllers. The script check errors before sending the data.
    ?>
    <script>
        (function() {
            var script = document.createElement('script');
            script.type = 'text/javascript';

            if (window.location.pathname.endsWith("index.php")) {
                script.src = "vendor/jquery/jquery-3.6.0.min.js";
            } else {
                script.src = "../../vendor/jquery/jquery-3.6.0.min.js";
            }

            document.head.appendChild(script);
        })();
    </script>
    <script>
        $(document).ready(function () {
            const createErrorMessage = (message) => {
                return $('<p>', {
                    class: 'alert alert-danger',
                    role: 'alert',
                    text: message,
                    style: 'background-color: red; color: white;'
                });
            };

            var modal = document.getElementById("myModal");

            var btn = document.getElementById("SignIn");
            btn.onclick = function () {
                modal.style.display = "block";
            };

            var btn3 = document.getElementById("SignIn5");
            btn3.onclick = function () {
                var modal3 = document.getElementById("myModal5");
                modal3.style.display = "none";
                modal.style.display = "block";
            };

            var btn2 = document.getElementById("SignIn3");
            btn2.onclick = function () {
                var modal2 = document.getElementById("myModal3");
                document.querySelector(".Error-Message2").textContent = '';
                document.getElementById("Customer_username2").value = "";
                document.getElementById("Customer_fullname").value = "";
                document.getElementById("Customer_password2").value = "";
                document.getElementById("Customer_number").value = "";
                document.getElementById("Customer_email").value = "";
                document.getElementById("check_password").value = "";
                modal2.style.display = "none";
                modal.style.display = "block";
            };

            var span = modal.querySelector(".close");
            span.onclick = function () {
                const errorMessageElement = document.querySelector(".Error-Message");
                modal.style.display = "none";
                document.getElementById("Customer_username").value = "";
                document.getElementById("Customer_password").value = "";
                errorMessageElement.style.display = "none";
            };

            $("#myForm").submit(function (e) {
                e.preventDefault();
                const errorMessageElement = document.querySelector(".Error-Message");

                if (document.getElementById("Customer_password").value === "" || document.getElementById("Customer_username").value === "") {
                    var errorMessage = createErrorMessage('Please fill in all fields.');
                    $('.Error-Message').empty().append(errorMessage);
                    return;
                } else {
                    errorMessageElement.style.display = "none";
                }

                let url;
                if (window.location.pathname.endsWith("index.php")) {
                    url = "be/controllers/UserControllers.php";
                } else {
                    url = "../../be/controllers/UserControllers.php";
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $(this).serialize(),
                    success: function (response) {
                        $("#responseMsg").html(response);
                        if (response.trim() === "success") {
                            const successText = document.getElementById("successText");
                            successText.style.display = "block";
                            errorMessageElement.style.display = "none";
                            document.getElementById("Customer_username").value = "";
                            document.getElementById("Customer_password").value = "";
                            var element = document.querySelector(".modal-content");
                            element.style.display = "none";
                            modal.style.display = "none";
                            setTimeout(function() {
                                successText.style.display = "none";
                                window.location.reload();
                            }, 2000);
                        } else if (response.trim() === "faile") {
                            var errorMessage2 = createErrorMessage('Invalid Username or password.');
                            errorMessageElement.style.display = "block";
                            $('.Error-Message').empty().append(errorMessage2);
                            return;
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Ajax request failed:", error);
                    }
                });
            });
        });
</script>

<?php
} 
?>

<?php
function ScriptSignUp_index() {
    // Script responsible for sending Sign Up data to be/controllers. The script check errors before sending the data.
    ?>
        <script>
        (function() {
            var script = document.createElement('script');
            script.type = 'text/javascript';

            if (window.location.pathname.endsWith("index.php")) {
                script.src = "vendor/jquery/jquery-3.6.0.min.js";
            } else {
                script.src = "../../vendor/jquery/jquery-3.6.0.min.js";
            }

            document.head.appendChild(script);
        })();
    </script>
    <script>
    $(document).ready(function () {
        const createErrorMessage = (message) => {
            return $('<p>', {
                class: 'alert alert-danger',
                role: 'alert',
                text: message,
                style: 'background-color: red; color: white;'
            });
        };
        const createErrorMessage2 = (message) => {
            return $('<p>', {
                class: 'alert alert-danger',
                role: 'alert',
                text: message,
                style: 'background-color: #0071f8; color: white;'
            });
        };

        var modal = document.getElementById("myModal3");
        var cont = modal.querySelector(".modal-content");

        var btn = document.getElementById("SignUp");
        btn.onclick = function () {
            var modal2 = document.getElementById("myModal");
            modal2.style.display = "none";
            document.querySelector(".Error-Message").textContent = '';
            document.getElementById("Customer_username").value = "";
            document.getElementById("Customer_password").value = "";
            cont.style.top = '-27.5%';
            modal.style.display = "block";
        };

        var span = modal.querySelector(".close");
        span.onclick = function () {
            modal.style.display = "none";
            document.getElementById("Customer_username2").value = "";
            document.getElementById("Customer_fullname").value = "";
            document.getElementById("Customer_password2").value = "";
            document.getElementById("Customer_number").value = "";
            document.getElementById("Customer_email").value = "";
            document.getElementById("check_password").value = "";
            const errorMessageElement = document.querySelector(".Error-Message2");
            errorMessageElement.style.display = "none";
        };

        $("#myForm3").submit(function (e) {
            e.preventDefault();
            var name = document.getElementById("Customer_fullname").value;
            var un = document.getElementById("Customer_username2").value;
            var nb = document.getElementById("Customer_number").value;
            var email = document.getElementById("Customer_email").value;
            var pass = document.getElementById("Customer_password2").value;
            var check_pass = document.getElementById("check_password").value;

            if (un === "" || pass === "" || name === "" || check_pass === "" || nb === "" || email === "") {
                var errorMessage = createErrorMessage('Please fill in all fields.');
                $('.Error-Message2').empty().append(errorMessage);
                return;
            } else if (pass.length < 8) {
                var errorMessage = createErrorMessage('Password must be at least 8 characters.');
                $('.Error-Message2').empty().append(errorMessage);
                return;
            } else if (pass !== check_pass) {
                var errorMessage = createErrorMessage('Passwords are not the same.');
                $('.Error-Message2').empty().append(errorMessage);
                return;
            } else {
                const errorMessageElement = document.querySelector(".Error-Message2");
                errorMessageElement.textContent = '';
            }

            let url;
            if (window.location.pathname.endsWith("index.php")) {
                url = "be/controllers/UserControllers.php";
            } else {
                url = "../../be/controllers/UserControllers.php";
            }

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (response) {
                    $("#responseMsg").html(response);
                    if (response.trim() === "success") {
                        const successText = document.getElementById("successText");
                        successText.style.display = "block";
                        successText.querySelector('p').textContent = 'Account Created Successfully';
                        const errorMessageElement = document.querySelector(".Error-Message2");
                        errorMessageElement.style.display = "none";
                        modal.style.display = "none";
                        document.getElementById("Customer_username2").value = "";
                        document.getElementById("Customer_fullname").value = "";
                        document.getElementById("Customer_password2").value = "";
                        document.getElementById("Customer_number").value = "";
                        document.getElementById("Customer_email").value = "";
                        document.getElementById("check_password").value = "";
                        setTimeout(function () {
                            successText.style.display = "none";
                            window.location.reload();
                        }, 2000);
                    } else if (response.trim() === "usernameExists" || response.trim() === "passwordExists" || response.trim() === "emailExists") {
                        const errorMessage2 = createErrorMessage2(
                            (response.trim() === "usernameExists") ? 'Username already taken, please choose another username.' :
                            (response.trim() === "passwordExists") ? 'Password already taken, please choose another password.' :
                            'Email already in the records, please choose another email.'
                        );
                        const errorMessageElement = document.querySelector(".Error-Message2");
                        errorMessageElement.style.display = "block";
                        $('.Error-Message2').empty().append(errorMessage2);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                }
            });
        });
    });
    </script>
    <?php
}
?>


<?php
    function ScriptBookTable_index() {
        // Script responsible for sending Reservation data to be/controllers. The script check errors before sending the data.
        ?>
        <script>
            (function() {
                var script = document.createElement('script');
                script.type = 'text/javascript';

                if (window.location.pathname.endsWith("index.php")) {
                    script.src = "vendor/jquery/jquery-3.6.0.min.js";
                } else {
                    script.src = "../../vendor/jquery/jquery-3.6.0.min.js";
                }

                document.head.appendChild(script);
            })();
        </script>
       <script>

            $(document).ready(function () {
            const createErrorMessage = (message) => {
                return $('<p>', {
                    class: 'alert alert-danger',
                    role: 'alert',
                    text: message,
                    style: 'background-color: red; color: white;'
                });
            };
            const createErrorMessage2 = (message) => {
                return $('<p>', {
                    class: 'alert alert-danger',
                    role: 'alert',
                    text: message,
                    style: 'background-color: #0071f8; color: white;'
                });
            };

            var modal = document.getElementById("myModal7");
            var cont = modal.querySelector(".modal-content");
            const errorMessageElement = document.querySelector(".Error-Message4");
            var btn = document.getElementById("Book");
            btn.onclick = function () {
                cont.style.top = '-23.5%';
                modal.style.display = "block";
            };

            var span = modal.querySelector(".close");
            span.onclick = function () {
                modal.style.display = "none";
                document.getElementById("appointment_date").value = "";
                document.getElementById("time_slot").value = "";
                document.getElementById("People_number").value = "";
                document.getElementById("Reservation_message").value = "";
                errorMessageElement.textContent = '';
            }

            $("#myForm7").submit(function (e) {
                e.preventDefault();
                var date = document.getElementById("appointment_date").value;
                var time = document.getElementById("time_slot").value;
                var people = document.getElementById("People_number").value;

                if (date === "" || time === "" || people === "") {
                    var errorMessage = createErrorMessage('Please fill in all fields.');
                    $('.Error-Message4').empty().append(errorMessage);
                    return;
                } else {
                    errorMessageElement.textContent = '';
                }

                let url;
                if (window.location.pathname.endsWith("index.php")) {
                    url = "be/controllers/UserControllers.php";
                } else {
                    url = "../../be/controllers/UserControllers.php";
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $(this).serialize(),
                    success: function (response) {
                        $("#responseMsg").html(response);
                        if (response.trim() === "success") {
                            const successText = document.getElementById("successText");
                            successText.style.display = "block";
                            successText.querySelector('p').textContent = 'Table Booked Successfully!';
                            const errorMessageElement = document.querySelector(".Error-Message4");
                            errorMessageElement.style.display = "none";
                            modal.style.display = "none";
                            document.getElementById("appointment_date").value = "";
                            document.getElementById("time_slot").value = "";
                            document.getElementById("People_number").value = "";
                            document.getElementById("Reservation_message").value = "";
                            setTimeout(function () {
                                successText.style.display = "none";
                                window.location.reload();
                            }, 2000);
                        } else if (response.trim() === "Allreserved") {
                            const errorMessage2 = createErrorMessage2('All tables are taken, Please choose another time slot.');
                            const errorMessageElement = document.querySelector(".Error-Message4");
                            errorMessageElement.style.display = "block";
                            $('.Error-Message4').empty().append(errorMessage2);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Ajax request failed:", error);
                    }
                });
            });
        });
    </script>

    <?php
        }
    ?>

<?php

function ScriptLogOut_index(){
    // Script responsible for the Log Out process.
    ?>
    <script>
    $(document).ready(function () {
        var logout = document.getElementById("LogOut");
        logout.addEventListener('click', function() {
            let url;
            if (window.location.pathname.endsWith("index.php")) {
                url = "be/controllers/UserControllers.php";
            } else {
                url = "../../be/controllers/UserControllers.php";
            }
            setTimeout(function () {
                successText.style.display = "none";
            }, 2000); 
            $.ajax({
                type: "POST",
                url: url, 
                data: { action: "LOGOUT" }, 
                success: function(response) {
                    if (response.trim() === "success") {
                        const successText = document.getElementById("successText");
                        successText.style.display = "block";
                        successText.querySelector('p').textContent = 'User Loged Out Successfully!';
                        setTimeout(function () {
                            successText.style.display = "none";
                            window.location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request failed:", error);
                }
            });
        });
    });
    </script>
<?php
} 
 
function ScriptDontBookTable_index(){
    // Script responsible for the directing the user to Sign In if he want to Book a Table and he is not Authenticated yet.
    ?>
        <script>
        (function() {
            var script = document.createElement('script');
            script.type = 'text/javascript';

            if (window.location.pathname.endsWith("index.php")) {
                script.src = "vendor/jquery/jquery-3.6.0.min.js";
            } else {
                script.src = "../../vendor/jquery/jquery-3.6.0.min.js";
            }

            document.head.appendChild(script);
        })();
    </script>
    <script>
        $(document).ready(function () {
            var modal = document.getElementById("myModal5");
            var btn = document.getElementById("DontBook");
            btn.onclick = function () {
                modal.style.display = "block";
            }

            var span = modal.querySelector(".close");
                span.onclick = function () {
                    modal.style.display = "none";
                }   
        });
    </script> 
<?php
} 
?>

<?php
function ScriptViewItem(){ 
    // Script responsible for openning the modal displaying each platter information.
    ?>
    <script>
    (function() {
        var script = document.createElement('script');
        script.type = 'text/javascript';

        if (window.location.pathname.endsWith("index.php")) {
            script.src = "vendor/jquery/jquery-3.6.0.min.js";
        } else {
            script.src = "../../vendor/jquery/jquery-3.6.0.min.js";
        }

        document.head.appendChild(script);
    })();
    </script> 
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        function openModal(platterId) {
            var modal = document.getElementById("platterModal_" + platterId);
            var cont = modal.querySelector(".modal-content");
            cont.style.overflow = 'hidden';
            cont.style.height = '70%';
            cont.style.backgroundColor = "#eeeeee";
            modal.style.backgroundColor = "transparent";
            modal.style.top = '-10%';
            modal.style.display = "block";
            
        }

        function closeModal(platterId) {
            var modal = document.getElementById("platterModal_" + platterId);
            modal.style.display = "none";
        }

        document.querySelectorAll('.Open_platterModal').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const platterId = item.getAttribute('data-id');
                openModal(platterId);
            });
        });

        document.querySelectorAll('.modal .close').forEach(item => {
            item.addEventListener('click', event => {
                const modal = item.closest('.modal');
                const platterId = modal.getAttribute('id').split('_')[1];
                closeModal(platterId);
            });
        });

        document.querySelectorAll('.modal #DontBook3').forEach(item => {
            item.addEventListener('click', event => {
                const modal = item.closest('.modal');
                const platterId = modal.getAttribute('id').split('_')[1];
                closeModal(platterId);            
                var modal5 = document.getElementById("myModal5");
                modal5.style.display = "block";
            });
        });

        document.querySelectorAll('.modal #Book3').forEach(item => {
            item.addEventListener('click', event => {
                const modal = item.closest('.modal');
                const platterId = modal.getAttribute('id').split('_')[1];
                closeModal(platterId);
                var modal7 = document.getElementById("myModal7");
                modal7.style.display = "block";
            });
        });

    }); 
    </script>
<?php } ?>


<?php
function ScriptContactUs(){ 
    // Script responsible for validating the contact information.
    ?>
    <script>
        (function() {
            var script = document.createElement('script');
            script.type = 'text/javascript';

            if (window.location.pathname.endsWith("index.php")) {
                script.src = "vendor/jquery/jquery-3.6.0.min.js";
            } else {
                script.src = "../../vendor/jquery/jquery-3.6.0.min.js";
            }

            document.head.appendChild(script);
        })();
    </script>
    <script>
        
    $(document).ready(function() {
        $('#contact-form').submit(function(event) {
            event.preventDefault(); 

            // Collect form data
            var name = $("#Contact_name").val().trim();
            var number = $("#Contact_number").val().trim();
            var email = $("#Contact_email").val().trim();
            var subject = $("#Contact_subject").val().trim();
            var message = $("#Contact_message").val().trim();

            var errorMessage = $('<p>', {
                class: 'alert alert-danger',
                role: 'alert',
                style: 'background-color: red; color: white;'
            });

            // Validate fields
            if (!name) {
                errorMessage.text('Please enter your full name.');
                $('.Error-Message3').empty().append(errorMessage);
                return;
            }
            if (!number) {
                errorMessage.text('Please enter your number.');
                $('.Error-Message3').empty().append(errorMessage);
                return;
            }
            if (!email) {
                errorMessage.text('Please enter your email.');
                $('.Error-Message3').empty().append(errorMessage);
                return;
            }
            if (!subject) {
                errorMessage.text('Please enter the subject.');
                $('.Error-Message3').empty().append(errorMessage);
                return;
            }
            if (!message) {
                errorMessage.text('Please enter the message body.');
                $('.Error-Message3').empty().append(errorMessage);
                return;
            }

            // Clear any previous error messages
            $('.Error-Message3').empty();

            // Make AJAX request
            $.ajax({
                type: "POST",
                url: "../../be/controllers/UserControllers.php", // Make sure this URL is correct
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    response = response.trim(); // Trim spaces from response

                    if (response === "success") {
                        const successText = $("#successText");
                        successText.css({left: '35%', display: "block"});
                        successText.find('p').text('We received your message. Thanks for contacting us!');
                        
                        // Clear form fields
                        $("#Contact_name").val("");
                        $("#Contact_number").val("");
                        $("#Contact_email").val("");
                        $("#Contact_subject").val(""); 
                        $("#Contact_message").val("");

                        // Hide success message after 2 seconds
                        setTimeout(function() {
                            successText.hide();
                        }, 2000);
                    } else {
                        // Handle error response from the server
                        errorMessage.text('Insert error. Please try again.');
                        $('.Error-Message3').empty().append(errorMessage);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    errorMessage.text('An error occurred while sending your message. Please try again later.');
                    $('.Error-Message3').empty().append(errorMessage);
                }
            });
        });
    });

    </script>
<?php } ?>