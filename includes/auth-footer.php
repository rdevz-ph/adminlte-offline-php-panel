<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/dist/js/adminlte.min.js"></script>

<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('../service-worker.js')
            .then(() => console.log("Service Worker registered"))
            .catch(err => console.error("SW registration failed", err));
    }

    let deferredPrompt;

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;

        const installBtn = document.getElementById('installBtn');
        if (installBtn) {
            installBtn.style.display = 'inline-block';
        }
    });

    document.getElementById('installBtn')?.addEventListener('click', () => {
        if (deferredPrompt) {
            deferredPrompt.prompt();
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                }
                deferredPrompt = null;
            });
        }
    });

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