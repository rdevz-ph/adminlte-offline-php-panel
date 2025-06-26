<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/dist/js/adminlte.min.js"></script>


<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const icon = document.getElementById("toggleIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-lock");
            icon.classList.add("fa-unlock");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-unlock");
            icon.classList.add("fa-lock");
        }
    }
</script>

</body>

</html>